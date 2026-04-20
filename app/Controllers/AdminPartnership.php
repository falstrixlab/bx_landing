<?php

namespace App\Controllers;
use App\Models\Crud;

class AdminPartnership extends BaseController {
    public function __construct()
    {
        $this->Crud = new Crud();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        if(session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $data['getdata'] = $this->Crud->readData('*', 'tbl_partnership', '', '', '', '', ['partnership_created_at' => 'DESC'], '');
        echo view('administrator/partnership/index', $data);
    }

    public function add()
    {
        if(session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        echo view('administrator/partnership/add');
    }

    public function run_add()
    {
        if(session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $submit = $this->request->getVar('submit');
        if (isset($submit)) {
            try {
                $pict = $this->request->getFile('partnership_pict');
                $newPict = '';
                if ($pict && $pict->isValid() && !$pict->hasMoved()) {
                    $newPict = 'bxsea_' . $pict->getRandomName();
                    $pict->move(ROOTPATH . 'assets/upload/partnership/', $newPict);
                }
                $insertData = [
                    'partnership_name'  => $this->request->getVar('partnership_name'),
                    'partnership_desc'  => $this->request->getVar('partnership_desc'),
                    'partnership_email' => $this->request->getVar('partnership_email'),
                    'partnership_phone' => $this->request->getVar('partnership_phone'),
                    'partnership_pict'  => $newPict,
                    'partnership_status'=> $this->request->getVar('partnership_status') ?? 'pending',
                    'partnership_created_at' => date('Y-m-d H:i:s'),
                ];
                $this->Crud->createData('tbl_partnership', $insertData);
                $this->session->setFlashdata('success', 'Data berhasil ditambahkan');
            } catch(\Exception $ex) {
                log_message('error', 'AdminPartnership::run_add - ' . $ex->getMessage());
                $this->session->setFlashdata('failed', 'Gagal menambahkan data');
            }
        }
        return redirect()->to(base_url(getenv('bxsea.admin') . '/partnership'));
    }

    public function update($id = null)
    {
        if(session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $data['getdata'] = $this->Crud->readData('*', 'tbl_partnership', ['partnership_id' => $id], '', '', '', '', ['limit' => 1]);
        echo view('administrator/partnership/update', $data);
    }

    public function run_update($id = null)
    {
        if(session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $submit = $this->request->getVar('submit');
        if (isset($submit)) {
            try {
                $existing = $this->Crud->readData('*', 'tbl_partnership', ['partnership_id' => $id], '', '', '', '', ['limit' => 1]);
                $pict = $this->request->getFile('partnership_pict');
                $newPict = $existing[0]['partnership_pict'] ?? '';
                if ($pict && $pict->isValid() && !$pict->hasMoved()) {
                    $newPict = 'bxsea_' . $pict->getRandomName();
                    $pict->move(ROOTPATH . 'assets/upload/partnership/', $newPict);
                }
                $updateData = [
                    'partnership_name'  => $this->request->getVar('partnership_name'),
                    'partnership_desc'  => $this->request->getVar('partnership_desc'),
                    'partnership_email' => $this->request->getVar('partnership_email'),
                    'partnership_phone' => $this->request->getVar('partnership_phone'),
                    'partnership_pict'  => $newPict,
                    'partnership_status'=> $this->request->getVar('partnership_status'),
                ];
                $this->Crud->updateData('tbl_partnership', $updateData, 'partnership_id', $id);
                $this->session->setFlashdata('success', 'Data berhasil diperbarui');
            } catch(\Exception $ex) {
                log_message('error', 'AdminPartnership::run_update - ' . $ex->getMessage());
                $this->session->setFlashdata('failed', 'Gagal memperbarui data');
            }
        }
        return redirect()->to(base_url(getenv('bxsea.admin') . '/partnership'));
    }

    public function delete($id = null)
    {
        if(session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        try {
            $this->Crud->deleteData('tbl_partnership', 'partnership_id', $id);
            $this->session->setFlashdata('success', 'Data berhasil dihapus');
        } catch(\Exception $ex) {
            log_message('error', 'AdminPartnership::delete - ' . $ex->getMessage());
            $this->session->setFlashdata('failed', 'Gagal menghapus data');
        }
        return redirect()->to(base_url(getenv('bxsea.admin') . '/partnership'));
    }
}
