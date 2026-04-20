<?php

namespace App\Controllers;
use App\Models\Crud;

class AdminAuth extends BaseController
{
    public function __construct()
    {
        $this->Crud = new Crud();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function index() {
        if (session()->get('islogin')) {
            return redirect()->to(base_url(getenv('bxsea.admin') . '/dashboard'));
        }
        echo view('administrator/login');
    }

    public function loginproc() {
        try {
            $submit = $this->request->getVar('submit');
            if (isset($submit)) {
                $username   = $this->request->getVar('username');
                $password   = $this->request->getVar('password');

                // Ambil user berdasarkan username saja dulu
                $checkData = $this->Crud->readData('*', 'tbl_user', [
                    'user_username' => $username,
                ], '', '', '', '', '');

                if (count($checkData) > 0) {
                    $user = $checkData[0];
                    $storedPass = $user['user_password'];
                    $valid = false;

                    // Cek password_hash modern dulu
                    if (password_verify($password, $storedPass)) {
                        $valid = true;
                    }
                    // Fallback: cek MD5 legacy (untuk transisi)
                    elseif ($storedPass === md5($password)) {
                        $valid = true;
                        // Upgrade MD5 → password_hash secara otomatis
                        $this->Crud->updateData('tbl_user',
                            ['user_password' => password_hash($password, PASSWORD_BCRYPT)],
                            ['user_id' => $user['user_id']]
                        );
                    }

                    if ($valid) {
                        $ses_data = [
                            'id'       => $user['user_id'],
                            'fullname' => $user['user_fullname'],
                            'username' => $user['user_username'],
                            'islogin'  => true,
                            'role'     => $user['user_role'],
                        ];
                        $this->session->set($ses_data);
                        return redirect()->to(base_url(getenv('bxsea.admin') . '/dashboard'));
                    }
                }

                $this->session->setFlashdata('nodata', 'Username atau password salah.');
                return redirect()->to(base_url(getenv('bxsea.admin')));
            } else {
                $this->session->setFlashdata('error', 'Request tidak valid.');
                return redirect()->to(base_url(getenv('bxsea.admin')));
            }
        } catch (\Exception $ex) {
            log_message('error', $ex->getMessage());
            $this->session->setFlashdata('error', 'Terjadi kesalahan sistem.');
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url(getenv('bxsea.admin')));
    }
}
