<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UomModel;
use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;

class Uom extends BaseController
{
    public function __construct()
    {
        $this->uomModel = new UomModel();
        $this->session = \Config\Services::session();
        $this->e = new Enforcer(APPPATH . 'model.conf', WRITEPATH . 'casbin/policy.csv');

        helper('html');
    }

    public function index()
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $data['uoms'] = [];

        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $sub = $this->session->get('imsa_email');
        $obj = 'uoms';
        $action = 'read';

        try {
            if ($this->e->enforce($sub, $obj, $action) === true) {
                $uoms = $this->uomModel->findAll();

                $data['uoms'] = $uoms;

                return view('admin/uom/index', $data);
            }

            throw new \Exception('Request Denied!', 403);
        } catch (CasbinException | \Exception $e) {
            echo $e->getMessage();
        }

        return view('admin/uom/index', $data);
    }

    public function show($id = 0)
    {
        $data = array();
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $filter_options = array(
            'options' => array( 'min_range' => 0)
        );

        if (! filter_var($id, FILTER_VALIDATE_INT, $filter_options)) {
            return redirect()->back()->with('error_message', 'Invalid/Missing ID!');
        }

        $uom = $this->uomModel->find($id);

        if (!$uom) {
            return redirect()->back()->with('error_message', 'Record does not exist!');
        }

        try {
            $sub = $this->session->get('imsa_email');
            $obj = 'uoms';
            $action = 'read';

            if ($this->e->enforce($sub, $obj, $action) === true) {
                $data['uom'] = $uom;

                return view('admin/uom/show', $data);
            }

            throw new \Exception('Request Denied!', 403);
        } catch (CasbinException|\Exception $e) {
            echo $e->getMessage();
        }

        return redirect()->back();
    }

    public function create()
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $data = [
            'uom_short' => '',
            'uom_full' => '',
            'uom_description' => '',
        ];

        return view('admin/uom/create', $data);
    }

    public function store()
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uom_short = $this->request->getPost('uom_short');
            $uom_full = $this->request->getPost('uom_full');
            $uom_description = $this->request->getPost('uom_description');

            $post_data = [
                'uom_short' => $uom_short,
                'uom_full' => $uom_full,
                'uom_description' => $uom_description,
                'added_by' => $this->session->get('imsa_id'),
            ];

            $validated = $this->validate([
                'uom_short' => ['label' => 'Unit of measurement(short)', 'rules' => 'alpha|permit_empty'],
                'uom_full' => ['label' => 'Unit of measurement(full)', 'rules' => 'required|alpha'],
            ]);

            if ($validated) {
                try {
                    $sub = $this->session->get('imsa_email');
                    $obj = 'uoms';
                    $action = 'write';

                    if ($this->e->enforce($sub, $obj, $action) === true) {
                        $uom_id = $this->uomModel->insert($post_data, true);

                        if ($uom_id) {
                            $this->session->setFlashdata('success_message', 'UoM added successfully');

                            return redirect()->to('admin/uom/create');
                        }

                        $this->session->setFlashdata('error_message', 'Failed to add UoM');

                        return redirect()->to('admin/uom/create');
                    }
                } catch (CasbinException|\ReflectionException $e) {
                    echo $e->getMessage();
                }

            }

            $data = [
                'uom' => [
                    'uom_short' => $this->request->getPost('uom_short'),
                    'uom_full' => $this->request->getPost('uom_full'),
                    'uom_description' => $this->request->getPost('uom_description'),
                ],
                'validation' => $this->validator,
            ];

            return view('admin/uom/create', $data);
        }

        $data = [
            'uom_short' => '',
            'uom_full' => '',
            'uom_description' => '',
        ];

        return view('admin/uom/create', $data);
    }

    public function edit($id = 0)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $uom = $this->uomModel->find($id);

        if (!$uom) {
            return redirect()->back()->with('error_message', 'Record does not exist!');
        }

        $data = [
            'uom' => $uom,
        ];

        return view('admin/uom/edit', $data);
    }

    public function update($id = 0)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid UoM ID');
            return redirect()->to("admin/uom/index");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uom_short = $this->request->getPost('uom_short');
            $uom_full = $this->request->getPost('uom_full');
            $uom_description = $this->request->getPost('uom_description');

            $new_data = [
                'uom_short' => $uom_short,
                'uom_full' => $uom_full,
                'uom_description' => $uom_description,
            ];

            $validated = $this->validate([
                'uom_short' => ['label' => 'Unit of measurement(short)', 'rules' => 'alpha|permit_empty'],
                'uom_full' => ['label' => 'Unit of measurement(full)', 'rules' => 'required|alpha'],
            ]);

            if ($validated) {
                try {
                    $sub = $this->session->get('imsa_email');
                    $obj = 'uoms';
                    $action = 'write';

                    if ($this->e->enforce($sub, $obj, $action) === true) {
                        $result = $this->uomModel->update($id, $new_data);

                        if ($result) {
                            $this->session->setFlashdata('success_message', 'UoM updated successfully');

                            return redirect()->back();
                        }

                        $this->session->setFlashdata('error_message', 'Failed to update UoM');

                        return redirect()->back();
                    }

                    throw new \Exception('Request Denied!', 403);
                } catch (CasbinException | \ReflectionException $e) {
                    echo $e->getMessage();
                }
            }

            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        $data = [
            'uom' => $this->uomModel->find($id),
        ];

        return view('admin/uom/edit', $data);
    }

    public function delete($id = 0)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid UoM ID');
            return redirect()->back();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $sub = $this->session->get('imsa_email');
                $obj = 'uoms';
                $action = 'write';
                if ($this->e->enforce($sub, $obj, $action) === true) {
                    $result = $this->uomModel->delete($id);

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
}
