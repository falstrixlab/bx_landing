<?php

namespace App\Controllers;
use App\Models\Crud;

class AdminProfile extends BaseController
{
    public function __construct()
    {
        $this->Crud = new Crud();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $userId = session()->get('id');
        $user = $this->Crud->readData('*', 'tbl_user', ['user_id' => $userId], '', '', '', '', '');
        $data['user'] = count($user) > 0 ? $user[0] : [];
        $data['title'] = 'Profile';
        echo view('administrator/profile/index', $data);
    }

    public function run_update()
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $userId = session()->get('id');
        $fullname = $this->request->getPost('user_fullname');
        $username = $this->request->getPost('user_username');

        // Check username uniqueness (exclude self)
        $existing = $this->Crud->readData('user_id', 'tbl_user', ['user_username' => $username], '', '', '', '', '');
        if (count($existing) > 0 && $existing[0]['user_id'] != $userId) {
            $this->session->setFlashdata('error', 'Username sudah digunakan.');
            return redirect()->to(base_url(getenv('bxsea.admin') . '/profile'));
        }

        $this->Crud->updateData('tbl_user', [
            'user_fullname' => $fullname,
            'user_username' => $username,
        ], ['user_id' => $userId]);

        // Update session fullname & username
        $this->session->set('fullname', $fullname);
        $this->session->set('username', $username);

        $this->session->setFlashdata('success', 'Profil berhasil diperbarui.');
        return redirect()->to(base_url(getenv('bxsea.admin') . '/profile'));
    }

    public function changepassword()
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $data['title'] = 'Ganti Password';
        echo view('administrator/profile/changepassword', $data);
    }

    public function run_changepassword()
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $userId = session()->get('id');
        $oldPass   = $this->request->getPost('old_password');
        $newPass   = $this->request->getPost('new_password');
        $confirmPass = $this->request->getPost('confirm_password');

        if ($newPass !== $confirmPass) {
            $this->session->setFlashdata('error', 'Konfirmasi password tidak cocok.');
            return redirect()->to(base_url(getenv('bxsea.admin') . '/profile/changepassword'));
        }

        $user = $this->Crud->readData('*', 'tbl_user', ['user_id' => $userId], '', '', '', '', '');
        if (count($user) == 0) {
            $this->session->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to(base_url(getenv('bxsea.admin') . '/profile/changepassword'));
        }

        $storedPass = $user[0]['user_password'];
        $valid = false;
        if (password_verify($oldPass, $storedPass)) {
            $valid = true;
        } elseif ($storedPass === md5($oldPass)) {
            $valid = true;
        }

        if (!$valid) {
            $this->session->setFlashdata('error', 'Password lama tidak sesuai.');
            return redirect()->to(base_url(getenv('bxsea.admin') . '/profile/changepassword'));
        }

        if (strlen($newPass) < 8) {
            $this->session->setFlashdata('error', 'Password baru minimal 8 karakter.');
            return redirect()->to(base_url(getenv('bxsea.admin') . '/profile/changepassword'));
        }

        $this->Crud->updateData('tbl_user', [
            'user_password' => password_hash($newPass, PASSWORD_BCRYPT),
        ], ['user_id' => $userId]);

        $this->session->setFlashdata('success', 'Password berhasil diubah.');
        return redirect()->to(base_url(getenv('bxsea.admin') . '/profile'));
    }
}
