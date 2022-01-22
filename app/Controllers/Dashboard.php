<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        if ($this->session->has('imsa_logged_in') || $this->session->has('ims_logged_in')) {
            // Todo: Review this approach of working with sessions

            // Redirect to employee dashboard first if session for employee exists
            // We skip to next condition if employee session is empty
            // Session keys used prevents session collision and allows
            // employee and admin to be logged in at the same time on the same browser.
            if ($this->session->has('ims_id') && $this->session->has('ims_email')) {
                return redirect()->to('employee/dashboard');
            }

            if ($this->session->has('imsa_id') && $this->session->has('imsa_email')) {
                return redirect()->to('admin/dashboard');
            }
        } else {
            return redirect()->to('employee/login');
        }

        return redirect()->back();
    }
}
