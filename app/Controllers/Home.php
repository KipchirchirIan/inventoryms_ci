<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
	{
	    helper('html');

	    $data = [
	        'page_title' => 'Dashboard',
            'first_uri_segment' => $this->request->uri->getSegment(1),
        ];

		return view('dash', $data);
	}

	public function welcome()
    {
        return view('welcome_message');
    }
}
