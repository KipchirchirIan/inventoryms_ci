<?php

namespace App\Controllers\Superadmin;

use App\Controllers\BaseController;
use App\Models\SuperAdminModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->superAdminModel = new SuperAdminModel();
        $this->session = \Config\Services::session();

        helper('html');
    }

    public function index()
    {
        if (!$this->session->get('sa_logged_in')) {
            return redirect()->to('superadmin/login');
        }

        $data = [
            'email' => $this->session->get('ims_email'),
            'name' => $this->session->get('ims_name'),
        ];

        return view('superadmin/dashboard', $data);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $validated = $this->validate([
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
            ]);

            if ($validated) {
                if ($sadmin = $this->superAdminModel->getSingle($email)) {

                    // Do a password check
                    if (password_verify($password, $sadmin['password'])) {
                        // Login sucessfull
                        $this->session->set([
                            'ims_email' => $sadmin['email'],
                            'ims_said' => $sadmin['sadmin_id'],
                            'ims_name' => $sadmin['first_name'],
                            'sa_logged_in' => true,
                        ]);

                        return redirect()->to('superadmin/dashboard');
                    }

                    $data = [
                        'sadmin' => [
                            'email' => $this->request->getPost('email'),
                        ],
                    ];

                    $this->session->setFlashdata('error_message', 'Wrong email/password!');

                    return view('superadmin/login', $data);
                }

                $data = [
                    'sadmin' => [
                        'email' => $this->request->getPost('email'),
                    ],
                ];

                // User does not exist
                $this->session->setFlashdata('error_message', 'Email does not exist');

                return view('superadmin/login', $data);
            }

            $data = [
                'sadmin' => [
                    'email' => $this->request->getPost('email'),
                ],
                'validation' => $this->validator,
            ];

            return view('superadmin/login', $data);
        }

        if ($this->session->get('sa_logged_in')) {
            return redirect('superadmin');
        }

        return view('superadmin/login');
    }

    public function logout()
    {
        $this->session->destroy();

        return redirect('superadmin/login');
    }
}
