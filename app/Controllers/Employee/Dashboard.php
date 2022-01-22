<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use Casbin\Enforcer;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
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

        if (!$this->session->has('ims_logged_in')) {
            return redirect()->to('employee/login');
        }

        return view('employee/dashboard', $data);
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
                $user = $this->authenticateUser($email, $password, $this->employeeModel);

                if ($user) {
                    // Authentication successful
                    // Set session
                    $this->session->set([
                        'ims_id' => $user['emp_id'],
                        'ims_email' => $user['email'],
                        'ims_fname' => $user['first_name'],
                        'ims_logged_in' => true,
                    ]);

                    return redirect()->to('employee/dashboard');
                }

                $this->session->setFlashdata('error_message', 'Wrong Email/Password Combination!');

                return redirect()->back();
            }

            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        if ($this->session->has('ims_logged_in')) {
            return redirect()->to('employee/dashboard');
        }

        if ($this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/dashboard');
        }

        return view('employee/login');
    }

    public function logout()
    {
        $this->session->destroy();

        return view('employee/login');
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
