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