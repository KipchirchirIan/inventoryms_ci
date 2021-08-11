<?php

namespace App\Controllers\Superadmin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use Casbin\Enforcer;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->session = \Config\Services::session();
        $this->e = new Enforcer(APPPATH . 'model.conf', WRITEPATH . 'casbin/policy.csv');

        helper('html');
    }

    public function index()
	{
        if (!$this->session->get('sa_logged_in')) {
            return redirect()->to('superadmin/login');
        }

        $data = [
            'admins' => $this->adminModel->findAll(),
        ];

        return view('superadmin/admin/index', $data);
	}

	public function create()
    {
        if (!$this->session->get('sa_logged_in')) {
            return redirect()->to('superadmin/login');
        }

        $data = [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'position' => '',
        ];

        return view('superadmin/admin/create', $data);
    }

    public function store()
    {
        if (!$this->session->get('sa_logged_in')) {
            return redirect()->to('superadmin/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fname = $this->request->getPost('first_name');
            $lname = $this->request->getPost('last_name');
            $position = $this->request->getPost('position');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $post_data = [
                'first_name' => $fname,
                'last_name' => $lname,
                'position' => $position,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];

            $validated = $this->validate([
                'first_name' => ['label' => 'First Name', 'rules' => 'required|alpha'],
                'last_name' => ['label' => 'Last Name', 'rules' => 'required|alpha'],
                'position' => ['label' => 'Position', 'rules' => 'alpha_space|permit_empty'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'password' => ['label' => 'Password', 'rules' => 'required|min_length[8]'],
            ]);

            if ($validated) {
                $adminId = $this->adminModel->insert($post_data, true);

                if ($adminId) {
                    $this->e->addRoleForUser($email, "user_group_admin");
                    $this->e->savePolicy();

                    $this->session->setFlashdata('success_message', 'Administrator added successfully');
                    return redirect()->back();
                }

                $this->session->setFlashdata('error_message', 'Failed to add administrator');
                return redirect()->back();
            }

            $data['admin'] = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'position' => $this->request->getPost('position'),
                'email' => $this->request->getPost('email'),
            ];
            $data['validation'] = $this->validator;

            return view('superadmin/admin/create', $data);
        }

        return redirect()->back();
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }


    public function view_admins()
    {

    }
}
