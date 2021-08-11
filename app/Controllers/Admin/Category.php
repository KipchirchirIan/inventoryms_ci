<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

class Category extends BaseController
{
    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->session = \Config\Services::session();
        $this->e = new Enforcer(APPPATH . 'model.conf', WRITEPATH . 'casbin/policy.csv');

        helper('html');
    }

	public function index()
	{
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $data = [
            'categories' => $this->categoryModel->findAll(),
        ];

        return view('admin/category/index', $data);
	}

	public function create()
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $data = [
            'category_name' => '',
            'category_description' => ''
        ];

        return view('admin/category/create', $data);
    }

    public function store()
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $this->request->getPost('category_name');
            $description = $this->request->getPost('category_description');

            $post_data = [
                'category_name' => $name,
                'category_description' => $description,
                'added_by' => $this->session->get('imsa_id'),
            ];

            $validated = $this->validate([
                'category_name' => ['label' => 'Category name', 'rules' => 'required|alpha_space'],
                'category_description' => ['label' => 'Category description', 'rules' => 'max_length[140]|permit_empty'],
            ]);

            if ($validated) {
                try {
                    $sub = $this->session->get('imsa_email');
                    $obj = 'item_categories';
                    $action = 'write';

                    if ($this->e->enforce($sub, $obj, $action) === true) {
                        $category_id = $this->categoryModel->insert($post_data, true);

                        if ($category_id) {
                            $this->session->setFlashdata('success_message', 'Record added successfully');

                            return redirect()->to('admin/category/index');
                        }

                        $this->session->setFlashdata('error_message', 'Failed to add!');

                        return redirect()->to('admin/category/create');
                    }

                    throw new \Exception('Request Denied!', 403);
                } catch (CasbinException | \ReflectionException $e) {
                    echo $e->getMessage();
                }
            }

            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        return redirect()->back();
    }

    public function edit($id = 0)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid ID');
            return redirect()->back();
        }

        if (!$this->categoryModel->find($id)) {
            $this->session->setFlashdata('error_message', 'Record does not exist!');
            return redirect()->back();
        }

        $data = [
            'category' => $this->categoryModel->find($id),
        ];

        return view('admin/category/edit', $data);
    }

    /**
     * @param $id
     * @return \CodeIgniter\HTTP\RedirectResponse
     * @throws \ReflectionException|\ArgumentCountError
     */
    public function update($id = 0)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid ID');
            return redirect()->back();
        }

        if (!$this->categoryModel->find($id)) {
            $this->session->setFlashdata('error_message', 'Record does not exist!');
            return redirect()->back();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $this->request->getPost('category_name');
            $description = $this->request->getPost('category_description');

            $new_data = [
                'category_name' => $name,
                'category_description' => $description,
            ];

            $validated = $this->validate([
                'category_name' => ['label' => 'Category name', 'rules' => 'required|alpha_space'],
                'category_description' => ['label' => 'Category description', 'rules' => 'max_length[140]|permit_empty'],
            ]);

            if ($validated) {
                try {
                    $sub = $this->session->get('imsa_email');
                    $obj = 'item_categories';
                    $action = 'write';

                    if ($this->e->enforce($sub, $obj, $action) === true) {
                        $result = $this->categoryModel->update($id, $new_data);

                        if ($result) {
                            $this->session->setFlashdata('success_message', 'Record updated successfully');

                            return redirect()->back();
                        }

                        $this->session->setFlashdata('error_message', 'Failed to update record');

                        return redirect()->back();
                    }

                    throw new \Exception('Request Denied!', 403);
                } catch (CasbinException $e) {
                    echo $e->getMessage();
                }
            }

            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        return redirect()->back();
    }

    public function delete($id = 0)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid ID');
            return redirect()->back();
        }

        if (!$this->categoryModel->find($id)) {
            $this->session->setFlashdata('error_message', 'Record does not exist!');
            return redirect()->back();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $sub = $this->session->get('imsa_email');
                $obj = 'item_categories';
                $action = 'write';

                if ($this->e->enforce($sub, $obj, $action) === true) {
                    $result = $this->categoryModel->delete($id);

                    if ($result) {
                        $this->session->setFlashdata('success_message', 'Record deleted successfully');

                        return redirect()->back();
                    }

                    $this->session->setFlashdata('error_message', 'Failed to delete record');

                    return redirect()->back();
                }

                throw new \Exception('Request Denied!', 403);
            } catch (CasbinException $e) {
                echo $e->getMessage();
            }
        }

        return redirect()->back();
    }
}
