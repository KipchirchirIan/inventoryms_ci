<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\ItemHistoryModel;
use App\Models\ItemModel;
use App\Models\UomModel;
use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;

class Item extends BaseController
{
    public function __construct()
    {
        $this->itemModel = new ItemModel();
        $this->uomModel = new UomModel();
        $this->itemsHistoryModel = new ItemHistoryModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->e = new Enforcer(APPPATH . 'model.conf', WRITEPATH . 'casbin/policy.csv');

        helper('html');
        helper('uom');
    }

    public function index()
    {
        $data = array();

        if (!$this->session->has('ims_logged_in')) {
            return redirect('employee/login');
        }

        try {
            $sub = $this->session->get('ims_email');
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

        return view('employee/item/index', $data);
    }

    public function show($id = 0)
    {
        $data = array();

        // Check if user is logged in
        if (!$this->session->has('ims_logged_in')) {
            return redirect('employee/login');
        }

        // Validate $id - required, natural number except 0
        if (!$this->validation->check($id, 'required|is_natural_no_zero')) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid ID');
            return redirect()->back();
        }

        $item = $this->itemModel->join('uoms', 'uoms.uom_id = items.uom_id')
            ->join('item_categories', 'items.category_id = item_categories.category_id')
            ->find($id);

        if (!$item) {
            $this->session->setFlashdata('error_message', 'Record does not exist!');
            return redirect()->back();
        }

        try {
            $sub = $this->session->get('ims_email');
            $obj = 'items';
            $action = 'read';

            if ($this->e->enforce($sub, $obj, $action) === true) {
                $data['item'] = $item;

                return view('employee/item/show', $data);
            }

            throw new CasbinException('Request Denied!', 403);
        } catch (CasbinException $e) {
            echo $e->getMessage();
        }

        return redirect()->back();
    }

    public function checkInOut()
    {
        $data = array();
        if (!$this->session->has('ims_logged_in')) {
            return redirect('employee/login');
        }

        try {
            $sub = $this->session->get('ims_email');
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

        return view('employee/item/checkInOut', $data);
    }

    public function checkIn($id = 0)
    {
        if (!$this->session->has('ims_logged_in')) {
            return redirect('employee/login');
        }

        if (empty($id) || !is_numeric($id)) {
            $this->session->setFlashdata('error_message', 'Missing/Invalid ID');
            return redirect()->back();
        }

        // Todo: Check if user is permitted to do this action
        $item = $this->itemModel->join('uoms', 'uoms.uom_id = items.uom_id')->find($id);

        if (!$item) {
            $this->session->setFlashdata('error_message', 'Record does not exist!');
            return redirect()->back();
        }

        $data = [
            'item' => $item,
        ];

        return view('employee/item/checkIn', $data);
    }

    public function updateCheckIn($id = 0)
    {
        $item = $this->itemModel->find($id);

        if (!$this->session->has('ims_logged_in')) {
            return redirect('employee/login');
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
                'checked_by' => $this->session->get('ims_email'),
            ];

            if ($validated) {
                try {
                    $sub = $this->session->get('ims_email');
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
            $sub = $this->session->get('ims_email');
            $obj = 'items';
            $act = 'update';

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
        if (!$this->session->has('ims_logged_in')) {
            return redirect('employee/login');
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

        return view('employee/item/checkOut', $data);
    }

    public function updateCheckOut($id = 0)
    {
        $item = $this->itemModel->find($id);

        if (!$this->session->has('ims_logged_in')) {
            return redirect('employee/login');
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

            $insert_data = [
                'item_id' => $item['item_id'],
                'check_in' => 0.0,
                'check_out' => $checkout_qty,
                'checked_by' => $this->session->get('ims_email'),
            ];

            if ($validated) {
                try {
                    $sub = $this->session->get('ims_email');
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
}
