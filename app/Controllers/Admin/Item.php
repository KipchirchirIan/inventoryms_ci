<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ItemHistoryModel;
use App\Models\ItemModel;
use App\Models\UomModel;
use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;
use CodeIgniter\I18n\Time;
use CodeIgniter\View\Table;
use Config\Services;

class Item extends BaseController
{
    /**
     * @throws CasbinException
     */
    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->itemsHistoryModel = new ItemHistoryModel();
        $this->uomModel = new UomModel();
        $this->categoryModel = new CategoryModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->e = new Enforcer(APPPATH . 'model.conf', WRITEPATH . 'casbin/policy.csv');
        $this->e->loadPolicy();

        helper('html');
        helper('inflector');
        helper('uom');
    }

    public function index()
    {
        $data = array();
        if (!$this->session->has('imsa_logged_in')) {
            return redirect('admin/login');
        }

        try {
            $sub = $this->session->get('imsa_email');
            $obj = 'items';
            $action = 'read';

            if ($this->e->enforce($sub, $obj, $action) === true) {
                $data['items'] = $this->itemModel->join('uoms', 'uoms.uom_id = items.uom_id')
                    ->findAll();
            } else {
                throw new \Exception('Request Denied!', 403);
            }
        } catch (CasbinException $e) {
            echo $e->getMessage();
        }

        return view('admin/item/index', $data);
    }

    public function show($id = 0)
    {
        $data = array();

        // Check if user is logged in
        if (!$this->session->has('imsa_logged_in')) {
            return redirect('admin/login');
        }

        // Validate $id - required, natural number except 0
        if (!$this->validation->check($id, 'required|is_natural_no_zero')) {
            return redirect()->back()->with('error_message', 'Missing/Invalid ID');
        }

        $item = $this->itemModel->join('uoms', 'uoms.uom_id = items.uom_id')
            ->join('item_categories', 'items.category_id = item_categories.category_id')
            ->find($id);

        if (!$item) {
            return redirect()->back()->with('error_message', 'Record does not exist!');
        }

        try {
            $sub = $this->session->get('imsa_email');
            $obj = 'items';
            $action = 'read';

            if ($this->e->enforce($sub, $obj, $action) === true) {
                $data['item'] = $item;

                return view('admin/item/show', $data);
            }

            throw new \Exception('Request Denied!', 403);
        } catch (CasbinException $e) {
            echo $e->getMessage();
        }

        return redirect()->back();
    }

    public function create()
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect('admin/login');
        }

        $data = [
            'item_name' => '',
            'item_description' => '',
            'quantity' => 0,
            'note' => '',
            'uoms' => $this->uomModel->findAll(),
            'categories' => $this->categoryModel->findAll(),
        ];

        return view('admin/item/create', $data);
    }

    public function store()
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect('admin/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $this->request->getPost('item_name');
            $description = $this->request->getPost('item_description');
            $qty = $this->request->getPost('quantity');
            $uom = $this->request->getPost('uom');
            $category = $this->request->getPost('category');
            $note = $this->request->getPost('note');

            $post_data = [
                'item_name' => $name,
                'item_description' => $description,
                'quantity' => $qty,
                'uom_id' => $uom,
                'category_id' => $category,
                'note' => $note,
                'added_by' => $this->session->get('imsa_email'),
                'last_modified_by' => $this->session->get('imsa_email'),
            ];

            $validated = $this->validate([
                'item_name' => ['label' => 'Item name', 'rules' => 'required'],
                'quantity' => ['label' => 'Quantity', 'rules' => 'required|numeric|greater_than_equal_to[0]'],
                'uom' => ['label' => 'Unit of measurement', 'rules' => 'required'],
                'category' => ['label' => 'Category', 'rules' => 'required|is_natural']
            ]);

            if ($validated) {
                try {
                    $sub = $this->session->get('imsa_email');
                    $obj = 'items';
                    $action = 'write';

                    if ($this->e->enforce($sub, $obj, $action) === true) {
                        $itemId = $this->itemModel->insert($post_data, true);

                        if ($itemId) {
                            $this->session->setFlashdata('success_message', 'Record added successfully');
                            return redirect()->to('admin/item/index');
                        }

                        $this->session->setFlashdata('error_message', 'Failed to add record');
                        return redirect()->back();
                    }

                    throw new \Exception('Request Denied!', 403);
                } catch (\Exception $e) {
                    log_message('info', "Request from: {$sub}");
                    log_message('error', $e->getMessage());
                }
            }

            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        return redirect()->back();
    }

    public function edit($id = 0)
    {
        $data = array();
        $data['categories'] = $this->categoryModel->findAll();
        $data['uoms'] = $this->uomModel->findAll();

        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $filter_options = array(
            'options' => array( 'min_range' => 0)
        );

        if (! filter_var($id, FILTER_VALIDATE_INT, $filter_options)) {
            return redirect()->back()->with('error_message', 'Invalid/Missing ID!');
        }

        $item = $this->itemModel->find($id);

        if (!$item) {
            $this->session->setFlashdata('error_message', 'Record does not exist!');
            return redirect()->back();
        }

        $sub = $this->session->get('imsa_email');
        $obj = 'items';
        $action = 'read';

        try {
            if ($this->e->enforce($sub, $obj, $action) === true) {
                $data['item'] = $item;
            } else {
                throw new \Exception('Request Denied!', 403);
            }
        } catch (CasbinException $e) {
            echo $e->getMessage();
        }

        return view("admin/item/edit", $data);
    }

    /**
     * @param $id int
     * @return \CodeIgniter\HTTP\RedirectResponse
     * @throws \ReflectionException
     */
    public function update($id = 0)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $filter_options = array(
            'options' => array( 'min_range' => 0)
        );

        if (! filter_var($id, FILTER_VALIDATE_INT, $filter_options)) {
            return redirect()->back()->with('error_message', 'Invalid/Missing ID!');
        }

        if (!$this->itemModel->find($id)) {
            return redirect()->back()->with('error_message', 'Record does not exist!');
        }

        $rules = [
            'item_name' => ['label' => 'Item name', 'rules' => 'required'],
            'uom' => ['label' => 'Unit of measurement', 'rules' => 'required'],
            'category' => ['label' => 'Category', 'rules' => 'required|is_natural']
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $this->request->getPost('item_name');
            $description = $this->request->getPost('item_description');
            $category = $this->request->getPost('category');
            $uom = $this->request->getPost('uom');
            $note = $this->request->getPost('note');

            $new_data = [
                'item_name' => $name,
                'item_description' => $description,
                'category_id' => $category,
                'uom_id' => $uom,
                'note' => $note,
                'last_modified_by' => $this->session->get('imsa_email'),
            ];

            try {
                $sub = $this->session->get('imsa_email');
                $obj = 'items';
                $action = 'write';

                if ($this->e->enforce($sub, $obj, $action) === true) {
                    $result = $this->itemModel->update($id, $new_data);

                    if ($result) {
                        return redirect()->back()->with('success_message', 'Record updated successfully!');
                    }

                    return redirect()->back()->with('error_message', 'Failed to update record.');
                }

                throw new \Exception('Request Denied!', 403);
            } catch (CasbinException $e) {
                echo $e->getMessage();
            }
        }

        return redirect()->to('admin/item/index');
    }

    public function delete($id = 0)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        $filter_options = array(
            'options' => array( 'min_range' => 0)
        );

        if (! filter_var($id, FILTER_VALIDATE_INT, $filter_options)) {
            return redirect()->back()->with('error_message', 'Invalid/Missing ID!');
        }

        if (!$this->itemModel->find($id)) {
            return redirect()->back()->with('error_message', 'Record does not exist!');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $sub = $this->session->get('imsa_email');
                $obj = 'items';
                $action = 'write';

                if ($this->e->enforce($sub, $obj, $action) === true) {
                    $result = $this->itemModel->delete($id);

                    if ($result) {
                        return redirect()->back()->with('success_message', 'Record deleted successfully!');
                    }

                    return redirect()->back()->with('error_message', 'Failed to delete record.');
                }

                throw new \Exception('Request Denied!', 403);
            } catch (CasbinException $e) {
                echo $e->getMessage();
            }
        }

        return redirect()->back();
    }

    public function checkInOut()
    {
        $data = array();
        if (!$this->session->has('imsa_logged_in')) {
            return redirect('admin/login');
        }

        try {
            $sub = $this->session->get('imsa_email');
            $obj = 'items';
            $action = 'read';

            if ($this->e->enforce($sub, $obj, $action) === true) {
                $data['items'] = $this->itemModel->join('uoms', 'uoms.uom_id = items.uom_id')
                    ->findAll();
            } else {
                throw new \Exception('Request Denied!', 403);
            }
        } catch (CasbinException $e) {
            echo $e->getMessage();
        }

        return view('admin/item/checkInOut', $data);
    }

    public function checkIn($id = 0)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect('admin/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid ID');
            return redirect()->back();
        }

        $item = $this->itemModel->join('uoms', 'uoms.uom_id = items.uom_id')->find($id);

        if (!$item) {
            $this->session->setFlashdata('error_message', 'Record does not exist!');
            return redirect()->back();
        }

        $data = [
            'item' => $item,
        ];

        return view('admin/item/checkIn', $data);
    }

    public function updateCheckIn($id = 0)
    {
        $item = $this->itemModel->find($id);

        if (!$this->session->has('imsa_logged_in')) {
            return redirect('admin/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid ID');
            return redirect()->back();
        }

        if (!$item) {
            $this->session->setFlashdata('error_message', 'Record does not exist!');
            return redirect()->back();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $checkin_qty = $this->request->getPost('checkin_qty');

            $validated = $this->validate([
                'checkin_qty' => ['label' => 'Check in quantity', 'rules' => 'required|numeric|greater_than_equal_to[0]'],
            ]);

            $insert_data = [
                'item_id' => $item['item_id'],
                'check_in' => $checkin_qty,
                'check_out' => 0.0,
                'checked_by' => $this->session->get('imsa_email'),
            ];

            if ($validated) {
                try {
                    $sub = $this->session->get('imsa_email');
                    $obj = 'items_history';
                    $action = 'write';

                    if ($this->e->enforce($sub, $obj, $action) === true) {
                        $result = $this->updateQty($id, $checkin_qty, 'add');

                        if ($result) {
                            // Todo: Perhaps use transactions here
                            if ($this->itemsHistoryModel->insert($insert_data)) {
                                $this->session->setFlashdata('success_message', 'Record updated successfully');
                                return redirect()->back();
                            }

                            $this->session->setFlashdata('error_message', 'Failed to update record');
                            return redirect()->back();
                        }

                        $this->session->setFlashdata('error_message', 'Failed to update record');
                        return redirect()->back();
                    }
                    throw new \Exception('Request Denied!', 403);
                } catch (CasbinException | \Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        return redirect()->back();
    }

    public function updateQty($id = 0, $quantity = 0.0, $action = "")
    {
        try {
            $sub = $this->session->get('imsa_email');
            $obj = 'items';
            $act = 'write';

            if ($this->e->enforce($sub, $obj, $act) === true) {

                if ($action === 'add') {
                    $result = $this->itemModel->addQty($id, $quantity, $sub);
                } elseif ($action === 'subtract') {
                    $result = $this->itemModel->subtractQty($id, $quantity, $sub);
                } else {
                    return false;
                }

                if ($result) {
                    return true;
                }

                return false;
            }
            throw new \Exception('Request Denied!', 403);
        } catch (CasbinException $e) {
            echo $e->getMessage();
        }

        return false;
    }

    public function checkOut($id = 0)
    {
        if (!$this->session->has('imsa_logged_in')) {
            return redirect('admin/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid ID');
            return redirect()->back();
        }

        $item = $this->itemModel->join('uoms', 'uoms.uom_id = items.uom_id')->find($id);

        if (!$item) {
            $this->session->setFlashdata('error_message', 'Record does not exist!');
            return redirect()->back();
        }

        $data = [
            'item' => $item,
        ];

        return view('admin/item/checkOut', $data);
    }

    public function updateCheckOut($id = 0)
    {
        $item = $this->itemModel->find($id);

        if (!$this->session->has('imsa_logged_in')) {
            return redirect('admin/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid ID');
            return redirect()->back();
        }

        if (!$item) {
            $this->session->setFlashdata('error_message', 'Record does not exist!');
            return redirect()->back();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $checkout_qty = $this->request->getPost('checkout_qty');

            $validated = $this->validate([
                'checkout_qty' => ['label' => 'Check out quantity', 'rules' => 'required|numeric|greater_than_equal_to[0]'],
            ]);

            if ($checkout_qty > $item['quantity']) {
                return redirect()->back()->with('error_message', 'Checkout quantity exceeds item quantity!');
            }

            $insert_data = [
                'item_id' => $item['item_id'],
                'check_in' => 0.0,
                'check_out' => $checkout_qty,
                'checked_by' => $this->session->get('imsa_email'),
            ];

            if ($validated) {
                try {
                    $sub = $this->session->get('imsa_email');
                    $obj = 'items_history';
                    $action = 'write';

                    if ($this->e->enforce($sub, $obj, $action) === true) {
                        $result = $this->updateQty($id, $checkout_qty, 'subtract');

                        if ($result) {
                            // Todo: Perhaps use transactions here
                            if ($this->itemsHistoryModel->insert($insert_data)) {
                                $this->session->setFlashdata('success_message', 'Record updated successfully');
                                return redirect()->back();
                            }

                            $this->session->setFlashdata('error_message', 'Failed to update record');
                            return redirect()->back();
                        }

                        $this->session->setFlashdata('error_message', 'Failed to update record');
                        return redirect()->back();
                    }
                    throw new \Exception('Request Denied!', 403);
                } catch (CasbinException | \Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        return redirect()->back();
    }

    public function history()
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
                $data['items'] = $this->itemsHistoryModel->findAll(50, 0);
            } else {
                throw new \Exception('Request Denied!', 403);
            }
        } catch (CasbinException | \Exception $e) {
            echo $e->getMessage();
        }

        return view('admin/item/history', $data);
    }

    public function checkoutDataByMonthYear($monthNum)
    {
        $month = $monthNum;

        if (empty($monthNum) || !is_numeric($monthNum) || $monthNum < 1 || $monthNum > 12) {
            $month = Time::now()->month;
        }

        $year = Time::now()->getYear();

        $itemModel = model('ItemModel');
        $items = $itemModel->getChekoutDataByMonthYear($month, $year);
//        $fmtItems = [];
//
//        if ($items) {
//            foreach ($items as $item) {
//                $fmtItems['item_id'] = $item['item_id'];
//                $fmtItems['item_name'] = $item['item_name'];
//                $fmtItems['qty_utilized'] = $item['checkout_count'] . " " . uom_formatter($item['item_name'], $item['checkout_count'], $item['uom_full']);
//            }
//        }


        if ($items) {
            $customSettings = ['table_open' => '<table class="table table-bordered table-md datatable-lize">'];
        } else {
            $customSettings = ['table_open' => '<table class="table table-bordered table-md">'];
        }

        $table = new Table($customSettings);
        $table->setHeading('#', 'Item', 'Qty Utilized');

        if (!$items) {
            $table->addRow(['data' => '0 records found', 'colspan' => 8, 'class' => 'text-center']);
        } else {
            foreach ($items as $item) {
                $table->addRow(
                    [
                        $item['item_id'],
                        $item['item_name'],
                        $item['checkout_count'] . " " . uom_formatter($item['item_name'], $item['checkout_count'], $item['uom_full'])
                    ]
                );
            }
        }

        //        echo json_encode([
//            'items' => $fmtItems,
//        ]);

       echo json_encode([
           'data' => [
               'count' => count($items),
               'table' => $table->generate(),
           ]
       ]);
    }
}
