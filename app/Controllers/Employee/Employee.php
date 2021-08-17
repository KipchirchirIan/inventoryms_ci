<?php

namespace App\Controllers\Employee;

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
    }

    public function index()
    {
        $data['employees'] = [];

        if (!$this->session->has('ims_logged_in')) {
            return redirect()->to('employee/login');
        }

        helper('html');

        $sub = $this->session->get('ims_email');
        $obj = 'employees';
        $action = 'read';

        try {
            if ($this->e->enforce($sub, $obj, $action) === true) {
                $employees = $this->employeeModel->findAll();

                $data['employees'] = $employees;

                return view('employee/employee/index', $data);
            }

            throw new \Exception('Request Denied!', 403);
        } catch (CasbinException | \Exception $e) {
            echo $e->getMessage();
        }

        return view('employee/employee/index', $data);
    }

    public function show($id)
    {
        $data = array();
        // Check if logged in
        if (!$this->session->has('ims_logged_in')) {
            return redirect()->to('employee/login');
        }

        // Validate $id - required & natural number except 0
//        if (! $this->validator->check($id, 'required|is_natural_no_zero')) {
//            $this->session->setFlashdata('error_message', 'Invalid/Missing ID');
//
//            return redirect()->back();
//        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Invalid/Missing ID');

            return redirect()->back();
        }

        // Look up for employee record in database
        $employee = $this->employeeModel->find($id);

        // Check if record exists
        if (! $employee) {
            $this->session->setFlashdata('error_message', 'Record does not exist');
            return redirect()->back();
        }

        $data['employee'] = $employee;

        return view("employee/employee/show", $data);
    }
}
