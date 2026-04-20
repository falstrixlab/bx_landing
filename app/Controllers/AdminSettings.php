<?php

namespace App\Controllers;

class AdminSettings extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        return redirect()->to(base_url(getenv('bxsea.admin') . '/master/setup/update'));
    }

    public function run_update()
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        return redirect()->to(base_url(getenv('bxsea.admin') . '/master/setup/update'));
    }
}
