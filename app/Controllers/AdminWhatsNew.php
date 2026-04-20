<?php

namespace App\Controllers;
use App\Models\Crud;

class AdminWhatsNew extends BaseController {
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
        $data['getdata'] = $this->Crud->readData('*', 'tbl_article', '', '', '', '', ['article_created_date' => 'DESC'], '');
        echo view('administrator/whatsnew/index', $data);
    }

    public function add()
    {
        if(session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $data['categories'] = $this->Crud->readData('*', 'tbl_article_category', '', '', '', '', '', '');
        echo view('administrator/whatsnew/add', $data);
    }

    public function run_add()
    {
        if(session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $submit = $this->request->getVar('submit');
        if (isset($submit)) {
            try {
                $pict = $this->request->getFile('article_pict');
                $newPict = '';
                if ($pict && $pict->isValid() && !$pict->hasMoved()) {
                    $newPict = 'bxsea_' . $pict->getRandomName();
                    $pict->move(ROOTPATH . 'assets/upload/article/', $newPict);
                }
                $insertData = [
                    'article_title'        => $this->request->getVar('article_title'),
                    'article_desc'         => $this->request->getVar('article_desc'),
                    'article_pict'         => $newPict,
                    'article_category'     => $this->request->getVar('article_category') ?? 1,
                    'article_created_date' => date('Y-m-d H:i:s'),
                ];
                $this->Crud->createData('tbl_article', $insertData);
                $this->session->setFlashdata('success', 'Artikel berhasil ditambahkan');
            } catch(\Exception $ex) {
                log_message('error', 'AdminWhatsNew::run_add - ' . $ex->getMessage());
                $this->session->setFlashdata('failed', 'Gagal menambahkan artikel');
            }
        }
        return redirect()->to(base_url(getenv('bxsea.admin') . '/whatsnew'));
    }

    public function update($id = null)
    {
        if(session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $data['getdata'] = $this->Crud->readData('*', 'tbl_article', ['article_id' => $id], '', '', '', '', ['limit' => 1]);
        $data['categories'] = $this->Crud->readData('*', 'tbl_article_category', '', '', '', '', '', '');
        echo view('administrator/whatsnew/update', $data);
    }

    public function run_update($id = null)
    {
        if(session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $submit = $this->request->getVar('submit');
        if (isset($submit)) {
            try {
                $existing = $this->Crud->readData('*', 'tbl_article', ['article_id' => $id], '', '', '', '', ['limit' => 1]);
                $pict = $this->request->getFile('article_pict');
                $newPict = $existing[0]['article_pict'] ?? '';
                if ($pict && $pict->isValid() && !$pict->hasMoved()) {
                    $newPict = 'bxsea_' . $pict->getRandomName();
                    $pict->move(ROOTPATH . 'assets/upload/article/', $newPict);
                }
                $updateData = [
                    'article_title'    => $this->request->getVar('article_title'),
                    'article_desc'     => $this->request->getVar('article_desc'),
                    'article_pict'     => $newPict,
                    'article_category' => $this->request->getVar('article_category'),
                ];
                $this->Crud->updateData('tbl_article', $updateData, 'article_id', $id);
                $this->session->setFlashdata('success', 'Artikel berhasil diperbarui');
            } catch(\Exception $ex) {
                log_message('error', 'AdminWhatsNew::run_update - ' . $ex->getMessage());
                $this->session->setFlashdata('failed', 'Gagal memperbarui artikel');
            }
        }
        return redirect()->to(base_url(getenv('bxsea.admin') . '/whatsnew'));
    }

    public function delete($id = null)
    {
        if(session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        try {
            $this->Crud->deleteData('tbl_article', 'article_id', $id);
            $this->session->setFlashdata('success', 'Artikel berhasil dihapus');
        } catch(\Exception $ex) {
            log_message('error', 'AdminWhatsNew::delete - ' . $ex->getMessage());
            $this->session->setFlashdata('failed', 'Gagal menghapus artikel');
        }
        return redirect()->to(base_url(getenv('bxsea.admin') . '/whatsnew'));
    }
}
