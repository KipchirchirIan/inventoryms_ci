<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;

class Employee extends BaseController
{
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->session = \Config\Services::session();
        $this->e = new Enforcer(APPPATH . 'model.conf', WRITEPATH . 'casbin/policy.csv');

        helper('html');
    }

    public function index()
    {
        $data['employees'] = [];

        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        helper('html');

        $sub = $this->session->get('imsa_email');
        $obj = 'employees';
        $action = 'read';

        try {
            if ($this->e->enforce($sub, $obj, $action) === true) {
                $employees = $this->employeeModel->findAll();

                $data['employees'] = $employees;

                return view('admin/employee/index', $data);
            }

            throw new \Exception('Request Denied!', 403);
        } catch (CasbinException | \Exception $e) {
            echo $e->getMessage();
        }

        return view('admin/employee/index', $data);
    }

    public function create()
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        helper('html');

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
                'added_by' => $this->session->get('imsa_id'),
            ];

            $validated = $this->validate([
                'first_name' => ['label' => 'First Name', 'rules' => 'required|alpha'],
                'last_name' => ['label' => 'Last Name', 'rules' => 'required|alpha'],
                'position' => ['label' => 'Position', 'rules' => 'alpha_space|permit_empty'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'password' => ['label' => 'Password', 'rules' => 'required|min_length[8]'],
            ]);

            if ($validated) {
                $sub = $this->session->get('imsa_email');
                $obj = 'employees';
                $action = 'write';
                try {
                    if ($this->e->enforce($sub, $obj, $action) === true) {
                        $employeeId = $this->employeeModel->insert($post_data);

                        if ($employeeId) {
                            $this->e->addRoleForUser($email, "user_group_emp");
                            $this->e->savePolicy();

                            $this->session->setFlashdata('success_message', 'Employee added successfully');

                            return redirect()->to('admin/employee/create');
                        }

                        $this->session->setFlashdata('error_message', 'Failed to add employee');

                        return redirect()->to('admin/employee/create');

                    }

                    throw new CasbinException('Request Denied!', 403);

                } catch (CasbinException | \Exception $e) {
                    echo $e->getMessage();
                }
            }

            $data['employee'] = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'position' => $this->request->getPost('position'),
                'email' => $this->request->getPost('email'),
            ];
            $data['validation'] = $this->validator;

            return view('admin/employee/create', $data);
        }

        $data = [
            'first_name' => '',
            'last_name' => '',
            'position' => '',
            'email' => '',
        ];

        return view('admin/employee/create', $data);
    }

    public function edit($id)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        // Todo: Perhaps we need to check here if the record with $id exists

        $data = [
            'employee' => $this->employeeModel->find($id),
        ];

        return view("admin/employee/edit", $data);
    }

    public function update($id)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid employee ID');
            return redirect()->to("admin/employee/edit/{$id}");
        }

        helper('html');

        $sub = $this->session->get('imsa_email');
        $obj = 'employees';
        $action = 'write';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fname = $this->request->getPost('first_name');
            $lname = $this->request->getPost('last_name');
            $position = $this->request->getPost('position');
            $email = $this->request->getPost('email');

            $new_data = [
                'first_name' => $fname,
                'last_name' => $lname,
                'position' => $position,
                'email' => $email,
            ];

            $validated = $this->validate([
                'first_name' => ['label' => 'First Name', 'rules' => 'required|alpha'],
                'last_name' => ['label' => 'Last Name', 'rules' => 'required|alpha'],
                'position' => ['label' => 'Position', 'rules' => 'alpha_space|permit_empty'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
            ]);

            if ($validated) {

                try {
                    if ($this->e->enforce($sub, $obj, $action) === true) {
                        $result = $this->employeeModel->update($id, $new_data);

                        if ($result) {
                            $this->session->setFlashdata('success_message', 'Employee updated successfully');

                            return redirect()->to("admin/employee/edit/{$id}");
                        }

                        $this->session->setFlashdata('error_message', 'Failed to add employee');

                        return redirect()->to("admin/employee/edit/{$id}");

                    }

                    throw new \Exception('Request Denied!', 403);
                } catch (CasbinException | \Exception $e) {
                    echo $e->getMessage();
                }
            }

            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }


        $data = [
            'employee' => $this->employeeModel->find($id),
        ];

        return view("admin/employee/edit/{$id}", $data);

    }

    public function delete($id)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid employee ID');
            return redirect()->back();
        }

        helper('html');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $sub = $this->session->get('imsa_email');
                $obj = 'employees';
                $action = 'write';
                if ($this->e->enforce($sub, $obj, $action) === true) {
                    $result = $this->employeeModel->delete($id);

                    if ($result) {
                        $this->session->setFlashdata('success_message', 'Record deleted successfully');

                        return redirect()->back();
                    }

                    $this->session->setFlashdata('error_message', 'Failed to delete record!');

                    return redirect()->back();
                }

                throw new \Exception('Request Denied!', 403);
            } catch (CasbinException | \Exception $e) {
                echo $e->getMessage();
            }
        }

        return redirect()->back();
    }

    public function logout()
    {
        $this->session->destroy();

        return redirect('admin/login');
    }

}