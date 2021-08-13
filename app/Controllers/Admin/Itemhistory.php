<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\EmployeeModel;
use App\Models\ItemHistoryModel;
use App\Models\ItemModel;
use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;

class Itemhistory extends BaseController
{
    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->itemHistoryModel = new ItemHistoryModel();
        $this->employeeModel = new EmployeeModel();
        $this->adminModel = new AdminModel();
        $this->session = \Config\Services::session();
        $this->e = new Enforcer(APPPATH . 'model.conf', WRITEPATH . 'casbin/policy.csv');

        helper('html');
        helper('inflector');
    }

    public function index()
	{
        $data = array();
        if (!$this->session->has('imsa_logged_in')) {
            return redirect('admin/login');
        }

        try {
            $sub = $this->session->get('imsa_email');
            $obj = 'items_history';
            $action = 'read';

            if ($this->e->enforce($sub, $obj, $action) === true) {
                $data['items'] = $this->itemHistoryModel->findAll(50, 0);
            }

            throw new \Exception('Request Denied!', 403);
        } catch (CasbinException|\Exception $e) {
            echo $e->getMessage();
        }

        return view('admin/item/history', $data);
	}
}
