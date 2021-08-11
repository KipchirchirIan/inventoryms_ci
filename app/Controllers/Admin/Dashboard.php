<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\EmployeeModel;
use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->session = \Config\Services::session();
        $this->e = new Enforcer(APPPATH . 'model.conf', WRITEPATH . 'casbin/policy.csv');
    }

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        helper('html');

        $data = [
            'page_title' => 'Dashboard',
        ];

        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        return view('admin/dashboard', $data);
    }

    public function login()
    {
        helper('html');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $validated = $this->validate([
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
            ]);

            if ($validated) {
                $user = $this->authenticateUser($email, $password, $this->adminModel);

                if ($user) {
                    // Authentication successful
                    // Set session
                    $this->session->set([
                        'imsa_id' => $user['admin_id'],
                        'imsa_email' => $user['email'],
                        'imsa_fname' => $user['first_name'],
                        'imsa_logged_in' => true,
                    ]);

                    return redirect()->to('admin/dashboard');
                }

                $this->session->setFlashdata('error_message', 'Wrong Email/Password Combination!');

                return view('admin/login');
            }

            $data = [
                'admin' => [
                    'email' => $this->request->getPost('email'),
                ],
                'validation' => $this->validator,
            ];

            return view('admin/login', $data);
        }

        if ($this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/dashboard');
        }

        return view('admin/login');
    }


    public function logout()
    {
        $this->session->destroy();

        return view('admin/login');
    }

    public function authenticateUser($email, $password, $model)
    {
        if ($user = $model->getSingle($email)) {
            // Check password
            if (password_verify($password, $user['password'])) {
                return $user;
            }

            return false;
        }

        return false;
    }
}
