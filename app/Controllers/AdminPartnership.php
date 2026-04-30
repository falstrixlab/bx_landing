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

    /* ============================================================
     *  Partnership CONTENT (Meaningful Section + Opportunity Cards)
     * ============================================================ */

    public function content()
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $rows = $this->Crud->readData('*', 'tbl_partnership_content', ['id' => 1], '', '', '', '', '');
        $data['partnershipContent'] = !empty($rows) ? $rows[0] : [];
        $data['opportunities'] = $this->Crud->readData('*', 'tbl_partnership_opportunity', '', '', '', '', ['opp_sort' => 'ASC'], '');
        echo view('administrator/partnership/content', $data);
    }

    public function run_update_content($section = null)
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $submit = $this->request->getVar('submit');
        if (!isset($submit)) {
            return redirect()->to(base_url('adminsite/partnership/content'));
        }
        try {
            $data = [];
            if ($section === 'meaningful') {
                $uploadDir = ROOTPATH . 'assets/upload/partnership/';
                if (!is_dir($uploadDir)) { mkdir($uploadDir, 0755, true); }

                $data['meaningful_title_id'] = $this->request->getVar('meaningful_title_id');
                $data['meaningful_title_en'] = $this->request->getVar('meaningful_title_en');
                $data['meaningful_desc_id']  = $this->request->getVar('meaningful_desc_id');
                $data['meaningful_desc_en']  = $this->request->getVar('meaningful_desc_en');

                foreach ([1, 2] as $img) {
                    $file = $this->request->getFile('meaningful_img'.$img);
                    if ($file && $file->isValid() && !$file->hasMoved()) {
                        $valRule = ['meaningful_img'.$img => ['label' => 'Image '.$img, 'rules' => ['mime_in[meaningful_img'.$img.',image/jpg,image/jpeg,image/png]']]];
                        if ($this->validate($valRule)) {
                            $newName = 'bxsea_image_' . $file->getRandomName();
                            $old = $this->request->getVar('meaningful_img'.$img.'_temp');
                            if ($old && is_file($uploadDir . $old)) { unlink($uploadDir . $old); }
                            $file->move($uploadDir, $newName, true);
                            $data['meaningful_img'.$img] = $newName;
                        } else {
                            $data['meaningful_img'.$img] = $this->request->getVar('meaningful_img'.$img.'_temp') ?? '';
                        }
                    } else {
                        $data['meaningful_img'.$img] = $this->request->getVar('meaningful_img'.$img.'_temp') ?? '';
                    }
                }
            }

            if (!empty($data)) {
                $data['updated_at'] = date('Y-m-d H:i:s');
                $exists = $this->Crud->readData('id', 'tbl_partnership_content', ['id' => 1], '', '', '', '', '');
                if (empty($exists)) {
                    $data['id'] = 1;
                    $this->Crud->createData('tbl_partnership_content', $data);
                } else {
                    $this->Crud->updateData('tbl_partnership_content', $data, ['id' => 1]);
                }
                $this->session->setFlashdata('success', '-');
            } else {
                $this->session->setFlashdata('failed', '-');
            }
        } catch (\Exception $ex) {
            echo 'Message: ' . $ex->getMessage();
            return;
        }
        return redirect()->to(base_url('adminsite/partnership/content'));
    }

    /* Opportunity CRUD */

    public function opportunity()
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $data['opportunities'] = $this->Crud->readData('*', 'tbl_partnership_opportunity', '', '', '', '', ['opp_sort' => 'ASC'], '');
        return redirect()->to(base_url('adminsite/partnership/content'));
    }

    public function add_opportunity()
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        echo view('administrator/partnership/opp_add');
    }

    public function run_add_opportunity()
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $submit = $this->request->getVar('submit');
        if (!isset($submit)) {
            return redirect()->to(base_url('adminsite/partnership/opportunity/add'));
        }
        try {
            $uploadDir = ROOTPATH . 'assets/upload/partnership/';
            if (!is_dir($uploadDir)) { mkdir($uploadDir, 0755, true); }

            $imgName = '';
            $file = $this->request->getFile('opp_image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $valRule = ['opp_image' => ['label' => 'Image', 'rules' => ['mime_in[opp_image,image/jpg,image/jpeg,image/png]']]];
                if ($this->validate($valRule)) {
                    $imgName = 'bxsea_image_' . $file->getRandomName();
                    $file->move($uploadDir, $imgName, true);
                }
            }

            $data = [
                'opp_image'    => $imgName,
                'opp_title_id' => $this->request->getVar('opp_title_id'),
                'opp_title_en' => $this->request->getVar('opp_title_en'),
                'opp_desc_id'  => $this->request->getVar('opp_desc_id'),
                'opp_desc_en'  => $this->request->getVar('opp_desc_en'),
                'opp_sort'     => (int) $this->request->getVar('opp_sort'),
                'opp_created_at' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->Crud->createData('tbl_partnership_opportunity', $data);
            if ($insert) {
                $this->session->setFlashdata('success', '-');
                return redirect()->to(base_url('adminsite/partnership/content'));
            } else {
                $this->session->setFlashdata('failed', '-');
                return redirect()->to(base_url('adminsite/partnership/opportunity/add'));
            }
        } catch (\Exception $ex) {
            echo 'Message: ' . $ex->getMessage();
        }
    }

    public function update_opportunity($id = null)
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $data['getdata'] = $this->Crud->readData('*', 'tbl_partnership_opportunity', ['opp_id' => $id], '', '', '', '', '');
        echo view('administrator/partnership/opp_update', $data);
    }

    public function run_update_opportunity()
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        $submit = $this->request->getVar('submit');
        $id     = $this->request->getVar('opp_id');
        if (!isset($submit)) {
            return redirect()->to(base_url('adminsite/partnership/opportunity/update/'.$id));
        }
        try {
            $uploadDir = ROOTPATH . 'assets/upload/partnership/';
            if (!is_dir($uploadDir)) { mkdir($uploadDir, 0755, true); }

            $imgName = $this->request->getVar('opp_image_temp') ?? '';
            $file    = $this->request->getFile('opp_image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $valRule = ['opp_image' => ['label' => 'Image', 'rules' => ['mime_in[opp_image,image/jpg,image/jpeg,image/png]']]];
                if ($this->validate($valRule)) {
                    $newName = 'bxsea_image_' . $file->getRandomName();
                    if ($imgName && is_file($uploadDir . $imgName)) { unlink($uploadDir . $imgName); }
                    $file->move($uploadDir, $newName, true);
                    $imgName = $newName;
                }
            }

            $data = [
                'opp_image'    => $imgName,
                'opp_title_id' => $this->request->getVar('opp_title_id'),
                'opp_title_en' => $this->request->getVar('opp_title_en'),
                'opp_desc_id'  => $this->request->getVar('opp_desc_id'),
                'opp_desc_en'  => $this->request->getVar('opp_desc_en'),
                'opp_sort'     => (int) $this->request->getVar('opp_sort'),
            ];
            $update = $this->Crud->updateData('tbl_partnership_opportunity', $data, ['opp_id' => $id]);
            if ($update) {
                $this->session->setFlashdata('success', '-');
            } else {
                $this->session->setFlashdata('failed', '-');
            }
        } catch (\Exception $ex) {
            echo 'Message: ' . $ex->getMessage();
            return;
        }
        return redirect()->to(base_url('adminsite/partnership/content'));
    }

    public function delete_opportunity($id = null)
    {
        if (session()->get('islogin') != TRUE) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
        try {
            $uploadDir = ROOTPATH . 'assets/upload/partnership/';
            $rows = $this->Crud->readData('opp_image', 'tbl_partnership_opportunity', ['opp_id' => $id], '', '', '', '', '');
            foreach ($rows as $row) {
                if (!empty($row['opp_image']) && is_file($uploadDir . $row['opp_image'])) {
                    unlink($uploadDir . $row['opp_image']);
                }
            }
            $this->Crud->deleteData('tbl_partnership_opportunity', 'opp_id', $id);
            $this->session->setFlashdata('success', '-');
        } catch (\Exception $ex) {
            $this->session->setFlashdata('failed', '-');
        }
        return redirect()->to(base_url('adminsite/partnership/content'));
    }
}
