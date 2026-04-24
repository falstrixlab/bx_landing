<?php

namespace App\Controllers;
use Exception;
use CodeIgniter\Controller;
use App\Models\Crud;

class AdminDashboard extends BaseController {
    public function __construct()
    {
        $this->Crud = new Crud();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }
    public function index() {
        if(session()->get('islogin') == TRUE)
        {
            $data['total_articles'] = count($this->Crud->readData('article_id', 'tbl_article', '', '', '', '', '', ''));
            $data['total_contacts'] = count($this->Crud->readData('contact_id', 'tbl_visitcontact', '', '', '', '', '', ''));
            $data['total_partnership'] = count($this->Crud->readData('partnership_id', 'tbl_partnership', '', '', '', '', '', ''));
            $data['total_subscribed'] = count($this->Crud->readData('subscribed_id', 'tbl_subscribed', '', '', '', '', '', ''));
            $data['total_users'] = count($this->Crud->readData('user_id', 'tbl_user', '', '', '', '', '', ''));
            $data['total_media_files'] = $this->countMediaFiles(ROOTPATH . 'assets/upload');
            $data['recent_articles'] = $this->Crud->readData('*', 'tbl_article', '', '', '', '', ['article_id' => 'DESC'], ['limit' => 5]);
            $data['recent_contacts'] = $this->Crud->readData('*', 'tbl_visitcontact', '', '', '', '', ['contact_id' => 'DESC'], ['limit' => 5]);
            echo view('administrator/home', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }

    private function countMediaFiles(string $path): int
    {
        if (! is_dir($path)) {
            return 0;
        }

        $total = 0;
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $total++;
            }
        }

        return $total;
    }

    /* Subscribed Page */
    public function subscribed() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_subscribed', '', '', '', '', '', '');
            echo view('administrator/subscribed/index',$data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* Subscribed Page */

    /* About Page */ 
    public function about() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_about', '', '', '', '', '', '');
            echo view('administrator/about/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_about()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/about/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_about()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $promotionpict =  $this->request->getFile('about_pict');
                    $newpromotionpict = "bxsea_image_".$promotionpict->getRandomName();
                    if ($promotionpict != "")
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'about_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[about_pict]',
                                    'mime_in[about_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/about/add');
                        }
                        if ($promotionpict->isValid() && ! $promotionpict->hasMoved()) 
                        {
                            $promotionpict->move(ROOTPATH .'assets/upload/about', $newpromotionpict, true);
                        }
                    }

                    $data = [
                        'about_title' => $this->request->getVar('about_title'),
                        'about_title_en' => $this->request->getVar('about_title_en'),
                        'about_pict' => $newpromotionpict,
                        'about_desc' => $this->request->getVar('about_desc'),
                        'about_desc_en' => $this->request->getVar('about_desc_en'),
                    ];
                    $insert = $this->Crud->createData('tbl_about', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/about');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/about/add');
                    }
                }
                catch(Exception $ex)
                {
                    echo 'Message: ' .$ex->getMessage();
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_about($about_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_about', ['about_id' => $about_id], '', '', '', '', '');
            echo view('administrator/about/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_about()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload ticket */
                    $promotionpict =  $this->request->getFile('about_pict');
                    $newpromotionpict = "bxsea_image".$promotionpict->getRandomName();
                    if ($promotionpict != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'about_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[about_pict]',
                                    'mime_in[about_pict,image/jpg,image/jpeg,image/png,video/mp4]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/about/update/'.$this->request->getVar('about_id'));
                        }
                        if ($promotionpict->isValid() && ! $promotionpict->hasMoved()) 
                        {
                            if (is_file('assets/upload/about/'.$this->request->getVar('about_pict_temp'))){
                                unlink('assets/upload/about/'.$this->request->getVar('about_pict_temp'));
                            }
                            $promotionpict->move(ROOTPATH .'assets/upload/about', $newpromotionpict, true);
                        }
                    }
                    /* End upload testimoni */

                    $data = [
                        'about_title' => $this->request->getVar('about_title'),
                        'about_title_en' => $this->request->getVar('about_title_en'),
                        'about_pict' => ($promotionpict != "") ? $newpromotionpict : $this->request->getVar('about_pict_temp'),
                        'about_desc' => $this->request->getVar('about_desc'),
                        'about_desc_en' => $this->request->getVar('about_desc_en'),
                    ];
                    $update = $this->Crud->updateData('tbl_about', $data, ['about_id' => $this->request->getVar('about_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/about');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/about');
                    }
                }
                catch(Exception $ex)
                {
                    echo 'Message: ' .$ex->getMessage();
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_promotion($about_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('about_pict', 'tbl_about', ['promotion_id' => $about_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/about/'.$val['promotion_pict'])){
                        unlink('assets/upload/about/'.$val['promotion_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_about', ['about_id' => $about_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/about');
            }
            catch(Exception $ex)
            {
                echo 'Message: ' .$ex->getMessage();
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* About Page CMS */
    public function about_page()
    {
        if (session()->get('islogin') == TRUE)
        {
            $rows = $this->Crud->readData('*', 'tbl_about_page', ['id' => 1], '', '', '', '', '');
            $data['aboutPage'] = !empty($rows) ? $rows[0] : [];
            echo view('administrator/about/page', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }

    public function run_update_about_page($section = null)
    {
        if (session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (!isset($submit))
            {
                return redirect()->to(base_url('adminsite/about/page'));
            }
            try
            {
                $data = [];

                if ($section === 'intro')
                {
                    $data = [
                        'intro_title_id'  => $this->request->getVar('intro_title_id'),
                        'intro_title_en'  => $this->request->getVar('intro_title_en'),
                        'intro_desc_id'   => $this->request->getVar('intro_desc_id'),
                        'intro_desc_en'   => $this->request->getVar('intro_desc_en'),
                    ];
                }
                elseif ($section === 'subcircle')
                {
                    $data = [
                        'subcircle_desc_id' => $this->request->getVar('subcircle_desc_id'),
                        'subcircle_desc_en' => $this->request->getVar('subcircle_desc_en'),
                    ];
                }
                elseif ($section === 'bubbles')
                {
                    for ($i = 1; $i <= 7; $i++) {
                        $data['bubble'.$i.'_id'] = $this->request->getVar('bubble'.$i.'_id');
                        $data['bubble'.$i.'_en'] = $this->request->getVar('bubble'.$i.'_en');
                    }
                }
                elseif ($section === 'gallery')
                {
                    $uploadDir = ROOTPATH . 'assets/upload/about/gallery/';
                    if (!is_dir($uploadDir)) { mkdir($uploadDir, 0755, true); }
                    foreach ([1, 2, 3] as $g)
                    {
                        $file = $this->request->getFile('gallery_'.$g);
                        if ($file && $file->isValid() && !$file->hasMoved())
                        {
                            $validationRule = ['gallery_'.$g => ['label' => 'Gallery Image '.$g, 'rules' => ['mime_in[gallery_'.$g.',image/jpg,image/jpeg,image/png]']]];
                            if ($this->validate($validationRule))
                            {
                                $newName = 'bxsea_image_' . $file->getRandomName();
                                $old = $this->request->getVar('gallery_'.$g.'_temp');
                                if ($old && is_file($uploadDir . $old)) { unlink($uploadDir . $old); }
                                $file->move($uploadDir, $newName, true);
                                $data['gallery_'.$g] = $newName;
                            }
                        }
                        else
                        {
                            $data['gallery_'.$g] = $this->request->getVar('gallery_'.$g.'_temp') ?? '';
                        }
                    }
                }
                elseif ($section === 'textblock')
                {
                    $uploadDir = ROOTPATH . 'assets/upload/about/';
                    if (!is_dir($uploadDir)) { mkdir($uploadDir, 0755, true); }

                    // Handle main textblock image
                    $imgFile = $this->request->getFile('textblock_image');
                    if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved())
                    {
                        $validationRule = ['textblock_image' => ['label' => 'Textblock Image', 'rules' => ['mime_in[textblock_image,image/jpg,image/jpeg,image/png]']]];
                        if ($this->validate($validationRule))
                        {
                            $newName = 'bxsea_image_' . $imgFile->getRandomName();
                            $old = $this->request->getVar('textblock_image_temp');
                            if ($old && is_file($uploadDir . $old)) { unlink($uploadDir . $old); }
                            $imgFile->move($uploadDir, $newName, true);
                            $data['textblock_image'] = $newName;
                        }
                        else
                        {
                            $data['textblock_image'] = $this->request->getVar('textblock_image_temp') ?? '';
                        }
                    }
                    else
                    {
                        $data['textblock_image'] = $this->request->getVar('textblock_image_temp') ?? '';
                    }

                    $data['textblock_left_desc_id']  = $this->request->getVar('textblock_left_desc_id');
                    $data['textblock_left_desc_en']  = $this->request->getVar('textblock_left_desc_en');
                    $data['textblock_title1_id']     = $this->request->getVar('textblock_title1_id');
                    $data['textblock_title1_en']     = $this->request->getVar('textblock_title1_en');
                    $data['textblock_desc1_id']      = $this->request->getVar('textblock_desc1_id');
                    $data['textblock_desc1_en']      = $this->request->getVar('textblock_desc1_en');
                    $data['textblock_btn1_id']       = $this->request->getVar('textblock_btn1_id');
                    $data['textblock_btn1_en']       = $this->request->getVar('textblock_btn1_en');
                    $data['textblock_title2_id']     = $this->request->getVar('textblock_title2_id');
                    $data['textblock_title2_en']     = $this->request->getVar('textblock_title2_en');
                    $data['textblock_desc2_id']      = $this->request->getVar('textblock_desc2_id');
                    $data['textblock_desc2_en']      = $this->request->getVar('textblock_desc2_en');
                    $data['textblock_btn2_id']       = $this->request->getVar('textblock_btn2_id');
                    $data['textblock_btn2_en']       = $this->request->getVar('textblock_btn2_en');
                }

                if (!empty($data))
                {
                    $data['updated_at'] = date('Y-m-d H:i:s');
                    // Check if row exists, if not insert it first
                    $exists = $this->Crud->readData('id', 'tbl_about_page', ['id' => 1], '', '', '', '', '');
                    if (empty($exists))
                    {
                        $data['id'] = 1;
                        $this->Crud->createData('tbl_about_page', $data);
                    }
                    else
                    {
                        $this->Crud->updateData('tbl_about_page', $data, ['id' => 1]);
                    }
                    $this->session->setFlashdata('success', '-');
                }
                else
                {
                    $this->session->setFlashdata('failed', '-');
                }
            }
            catch (Exception $ex)
            {
                echo 'Message: ' . $ex->getMessage();
                return;
            }
            return redirect()->to(base_url('adminsite/about/page'));
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }

    /* User Page */ 

    public function user() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_user', '', '', '', '', '', '');
            echo view('administrator/user/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_user()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/user/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_user()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'user_fullname' => $this->request->getVar('user_fullname'),
                        'user_username' => $this->request->getVar('user_username'),
                        'user_password' => password_hash($this->request->getVar('user_password'), PASSWORD_BCRYPT),
                        'user_role' => $this->request->getVar('user_role'),
                    ];
                    $insert = $this->Crud->createData('tbl_user', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/user');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/user/add');
                    }
                }
                catch(Exception $ex)
                {
                    echo 'Message: ' .$ex->getMessage();
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_user($user_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_user', ['user_id' => $user_id], '', '', '', '', '');
            echo view('administrator/user/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_user()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'user_fullname' => $this->request->getVar('user_fullname'),
                        'user_username' => $this->request->getVar('user_username'),
                        'user_role' => $this->request->getVar('user_role'),
                    ];
                    // Only update password if provided
                    $newPass = $this->request->getVar('user_password');
                    if (!empty($newPass)) {
                        $data['user_password'] = password_hash($newPass, PASSWORD_BCRYPT);
                    }
                    $update = $this->Crud->updateData('tbl_user', $data, ['user_id' => $this->request->getVar('user_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/user');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/user');
                    }
                }
                catch(Exception $ex)
                {
                    echo 'Message: ' .$ex->getMessage();
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_user($user_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $this->Crud->deleteData('tbl_user', ['user_id' => $user_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/user');
            }
            catch(Exception $ex)
            {
                echo 'Message: ' .$ex->getMessage();
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
}

?>