<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
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
}
