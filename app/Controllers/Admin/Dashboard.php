<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\EmployeeModel;
use Casbin\Enforcer;
use Casbin\Exceptions\CasbinException;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->session = \Config\Services::session();
        $this->e = new Enforcer(APPPATH . 'model.conf', WRITEPATH . 'casbin/policy.csv');

        helper('uom');
    }

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        helper('html');

        $data = [
            'page_title' => 'Dashboard',
        ];

        if (!$this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/login');
        }

        return view('admin/dashboard', $data);
    }

    public function login()
    {
        helper('html');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $validated = $this->validate([
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'password' => ['label' => 'Password', 'rules' => 'required'],
            ]);

            if ($validated) {
                $user = $this->authenticateUser($email, $password, $this->adminModel);

                if ($user) {
                    // Authentication successful
                    // Set session
                    $this->session->set([
                        'imsa_id' => $user['admin_id'],
                        'imsa_email' => $user['email'],
                        'imsa_fname' => $user['first_name'],
                        'imsa_logged_in' => true,
                    ]);

                    return redirect()->to('admin/dashboard');
                }

                $this->session->setFlashdata('error_message', 'Wrong Email/Password Combination!');

                return view('admin/login');
            }

            $data = [
                'admin' => [
                    'email' => $this->request->getPost('email'),
                ],
                'validation' => $this->validator,
            ];

            return view('admin/login', $data);
        }

        if ($this->session->has('imsa_logged_in')) {
            return redirect()->to('admin/dashboard');
        }

        return view('admin/login');
    }


    public function logout()
    {
        $this->session->destroy();

        return view('admin/login');
    }

    public function authenticateUser($email, $password, $model)
    {
        if ($user = $model->getSingle($email)) {
            // Check password
            if (password_verify($password, $user['password'])) {
                return $user;
            }

            return false;
        }

        return false;
    }

    public function printItemsList()
    {
        $html = $this->itemContent();

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 48,
            'margin_bottom' => 25,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);

        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Rescue Dada Centre - Items Overview");
        $mpdf->SetAuthor("Rescue Dada Centre");
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);
        $mpdf->Output('RDC-itemslist.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    }

    public function itemContent()
    {
        $i = 1;
        $itemModel = model('ItemModel');
        $items = $itemModel->join('tbl_uoms', 'tbl_uoms.uom_id = tbl_items.uom')->findAll();

        $html = '
        <html lang="en">
        <head>
        <style>
        body {font-family: sans-serif;
            font-size: 10pt;
        }
        p {	margin: 0; }
        table.items {
            border: 0.1mm solid #000000;
        }
        td { vertical-align: top; }
        .items td {
            border-left: 0.1mm solid #000000;
            border-right: 0.1mm solid #000000;
        }
        table thead th { background-color: #EEEEEE;
            text-align: center;
            border: 0.1mm solid #000000;
            font-variant: small-caps;
        }
        .items td.qty {
            text-align: center;
        }
        </style>
        </head>
        <body>
        <!--mpdf
        <htmlpageheader name="myheader">
        <table width="100%"><tr>
        <td width="50%" style="color:#91498F; "><span style="font-weight: bold; font-size: 14pt;">Rescue Dada Centre</span><br />Songot Way, off Park Road, Ngara,<br />Nairobi, Kenya<br /><span style="font-family:dejavusanscondensed;">&#9742;</span>+254 725 694 624</td>
        </tr></table>
        </htmlpageheader>
        <htmlpagefooter name="myfooter">
        <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
        Page {PAGENO} of {nb}
        </div>
        </htmlpagefooter>
        <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
        <sethtmlpagefooter name="myfooter" value="on" />
        mpdf-->
        <div style="text-align: right">Date: ' . date("jS M Y") . '</div>
        <br />';
        $html .= '<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th width="15%">#</th>';
        $html .= '<th width="45%">Item Name</th>';
        $html .= '<th width="20%">Quantity</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach ($items as $item) {
            $html .= '<tr>';
            $html .= '<td align="center">' . $i . '</td>';
            $html .= '<td align="center">' . $item['item_name'] . '</td>';
            $html .= '<td class="qty">' . $item['quantity'] . '&nbsp;' . uom_formatter($item['item_name'], $item['quantity'], $item['uom_full']) . '</td>';
            $html .= '</tr>';
            $i++;
        }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</body>';
        $html .= '</html>';

        return $html;
    }
}
