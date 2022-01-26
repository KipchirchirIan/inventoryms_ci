<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Casbin\Enforcer;
use CodeIgniter\Exceptions\PageNotFoundException;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->adminModel = model('AdminModel');
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->e = new Enforcer(APPPATH . 'model.conf', WRITEPATH . 'casbin/policy.csv');

        helper('html');
    }

    public function index()
    {
        // Check if logged in
        if (! $this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        // Look up data for logged in user
        $id = (int) $this->session->get('imsa_id');
        $admin = $this->adminModel->find($id);

        // Check if record exists
        if (! $admin) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = [
            'page_title' => 'My Profile',
            'admin' => $admin,
        ];

        return view('admin/profile/index', $data);
    }

    public function changePassword()
    {
        // Check if logged in
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $id = $this->session->get('imsa_id');

        // Validate URL parameters
        $filter_options = array(
            'options' => array( 'min_range' => 0)
        );

        if (! filter_var($id, FILTER_VALIDATE_INT, $filter_options)) {
            return redirect()->back()->with('error_message', 'Invalid/Missing ID!');
        }

        // Check if admin exists
        $admin = $this->adminModel->find($id);

        if (! $admin) {
            $this->session->setFlashdata('error_message', 'Record does not exist');
            return redirect()->back();
        }

        return view('admin/profile/change_password');
    }

    /**
     * @throws \ReflectionException
     */
    public function attemptChangePassword()
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $id = (int) $this->session->get('imsa_id');

        $filter_options = array(
            'options' => array( 'min_range' => 0)
        );

        if (! filter_var($id, FILTER_VALIDATE_INT, $filter_options)) {
            return redirect()->back()->with('error_message', 'Invalid/Missing ID!');
        }

        // Check if admin exists
        $admin = $this->adminModel->find($id);

        if (! $admin) {
            $this->session->setFlashdata('error_message', 'Record does not exist');
            return redirect()->back();
        }

        $rules = [
            'old_password' => ['label' => 'Old password', 'rules' => 'required'],
            'new_password' => ['label' => 'New password', 'rules' => 'required|min_length[8]'],
            'confirm_password' => ['label' => 'Confirm password', 'rules' => 'matches[new_password]'],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $old_password = $this->request->getPost('old_password');

        if (! password_verify($old_password, $admin['password'])) {
            return redirect()->back()->with('error_message', 'Old password is incorrect');
        }

        $new_password = $this->request->getPost('new_password');
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $new_data = [
            'password' => $hashed_password,
        ];

        if ($id !== (int) $admin['admin_id']) {
            throw new \RuntimeException('Permission denied!', 401);
        }

        try {
            $result = $this->adminModel->update($id, $new_data);

            if ($result) {
                // Clear Login session data only
                $this->session->remove('imsa_id');
                $this->session->remove('imsa_fname');
                $this->session->remove('imsa_email');
                $this->session->remove('imsa_logged_in');

                return  redirect()->to('admin/login')->with('success_message', 'Password changed successfully! Please log in again.');
            }

        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
        }

        return redirect()->back();
    }
}
