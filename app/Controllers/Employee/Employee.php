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

    }
}
