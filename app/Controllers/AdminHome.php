<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Crud;

class AdminHome extends BaseController {
    public function __construct()
    {
        $this->Crud = new Crud();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        if (session()->get('islogin') != TRUE)
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }

        $countTable = function (string $table, array $where = []): int {
            return count($this->Crud->readData('*', $table, $where, '', '', '', '', ''));
        };

        $data['primarySections'] = [
            [
                'title' => 'Announcement',
                'description' => 'Teks marquee paling atas pada halaman home.',
                'href' => base_url('adminsite/home/announcement'),
                'meta' => $countTable('tbl_homeannouncement') . ' item',
            ],
            [
                'title' => 'Banner Utama',
                'description' => 'Visual hero banner di area utama homepage.',
                'href' => base_url('adminsite/home/banner'),
                'meta' => $countTable('tbl_homebanner') . ' item',
            ],
            [
                'title' => 'Fitur Slide',
                'description' => 'Slide utama setelah shortcut ticket dan map.',
                'href' => base_url('adminsite/home/fiturslide'),
                'meta' => $countTable('tbl_homefiturslide') . ' item',
            ],
            [
                'title' => 'Deskripsi Home',
                'description' => 'Copy per section untuk home seperti berita, testimoni, dan tiket.',
                'href' => base_url('adminsite/home/description'),
                'meta' => $countTable('tbl_masterdesc', ['masterdesc_menu' => 'home']) . ' section copy',
            ],
            [
                'title' => 'Review Pengunjung',
                'description' => 'Testimoni utama yang tampil pada slider review home.',
                'href' => base_url('adminsite/home/testimoni'),
                'meta' => $countTable('tbl_hometestimoni') . ' review',
            ],
            [
                'title' => 'Review Influencer',
                'description' => 'Cadangan review tambahan untuk slider home.',
                'href' => base_url('adminsite/home/influencer'),
                'meta' => $countTable('tbl_homeinfluencer') . ' review',
            ],
            [
                'title' => 'Partner',
                'description' => 'Logo partner yang tampil di bawah section tiket.',
                'href' => base_url('adminsite/home/partner'),
                'meta' => $countTable('tbl_homepartner') . ' partner',
            ],
            [
                'title' => 'Konten Sosial Media',
                'description' => 'Konten embed atau referensi sosial media untuk area home.',
                'href' => base_url('adminsite/home/sosmedcontent'),
                'meta' => $countTable('tbl_homesosmedcontent') . ' item',
            ],
            [
                'title' => 'Setup Landing',
                'description' => 'Identitas global landing seperti header, footer, dan kontak utama.',
                'href' => base_url('adminsite/master/setup'),
                'meta' => 'global',
            ],
        ];

        $data['relatedSections'] = [
            [
                'title' => 'Event di Home',
                'description' => 'Card event home mengambil data dari modul promotion.',
                'href' => base_url('adminsite/ticketing/promotion'),
                'meta' => $countTable('tbl_ticketpromotion') . ' event',
            ],
            [
                'title' => 'Highlight Tiket',
                'description' => 'Section pemesanan tiket home memakai data ticketing utama.',
                'href' => base_url('adminsite/ticketing/masterticket'),
                'meta' => $countTable('tbl_ticket') . ' tiket',
            ],
            [
                'title' => 'Tenant di Home',
                'description' => 'Carousel tenant home memakai data tenant dari Info Kunjungan.',
                'href' => base_url('adminsite/visit/tenant'),
                'meta' => $countTable('tbl_visittenant') . ' tenant',
            ],
            [
                'title' => 'Berita di Home',
                'description' => 'Card berita pada home memakai data artikel utama.',
                'href' => base_url('adminsite/master/article'),
                'meta' => $countTable('tbl_article') . ' artikel',
            ],
        ];

        echo view('administrator/home/overview', $data);
    }
    /* Banner Page */ 
    public function banner() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homebanner', '', '', '', '', '', '');
            echo view('administrator/home/banner/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_banner()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/home/banner/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_banner()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $homebannerpict =  $this->request->getFile('homebanner_pict');
                    $newHomeBannerPict = "bxsea_image_".$homebannerpict->getRandomName();
                    if ($homebannerpict != "")
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'homebanner_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[homebanner_pict]',
                                    'is_image[homebanner_pict]',
                                    'mime_in[homebanner_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/banner/add');
                        }
                        if ($homebannerpict->isValid() && ! $homebannerpict->hasMoved()) 
                        {
                            $homebannerpict->move(ROOTPATH .'assets/upload/banner', $newHomeBannerPict, true);
                        }
                    }

                    $data = [
                        'homebanner_pict' => $newHomeBannerPict,
                    ];
                    $insert = $this->Crud->createData('tbl_homebanner', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/banner');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/banner/add');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_banner($homebanner_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homebanner', ['homebanner_id' => $homebanner_id], '', '', '', '', '');
            echo view('administrator/home/banner/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_banner()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload banner */
                    $homebannerpict =  $this->request->getFile('homebanner_pict');
                    $newHomeBannerPict = "bxsea_image".$homebannerpict->getRandomName();
                    if ($homebannerpict != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'homebanner_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[homebanner_pict]',
                                    'is_image[homebanner_pict]',
                                    'mime_in[homebanner_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/banner/update/'.$this->request->getVar('homebanner_id'));
                        }
                        if ($homebannerpict->isValid() && ! $homebannerpict->hasMoved()) 
                        {
                            if (is_file('assets/upload/banner/'.$this->request->getVar('homebanner_pict_temp'))){
                                unlink('assets/upload/banner/'.$this->request->getVar('homebanner_pict_temp'));
                            }
                            $homebannerpict->move(ROOTPATH .'assets/upload/banner', $newHomeBannerPict, true);
                        }
                    }
                    /* End upload banner */

                    $data = [
                        'homebanner_pict' => ($homebannerpict != "") ? $newHomeBannerPict : $this->request->getVar('homebanner_pict_temp')
                    ];
                    $update = $this->Crud->updateData('tbl_homebanner', $data, ['homebanner_id' => $this->request->getVar('homebanner_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/banner');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/banner');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_banner($homebanner_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('homebanner_pict', 'tbl_homebanner', ['homebanner_id' => $homebanner_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/banner/'.$val['homebanner_pict'])){
                        unlink('assets/upload/banner/'.$val['homebanner_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_homebanner', ['homebanner_id' => $homebanner_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/home/banner');
            }
            catch(\Throwable $ex)
            {
                log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* Banner Page */ 

    /* Fitur Slide Page */ 
    public function fiturslide() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homefiturslide', '', '', '', '', '', '');
            echo view('administrator/home/fiturslide/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_fiturslide()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/home/fiturslide/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_fiturslide()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $fiturslidepict =  $this->request->getFile('homefitureslide_pict');
                    $newfiturslidepict = "bxsea_image_".$fiturslidepict->getRandomName();
                    if ($fiturslidepict != "")
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'homefitureslide_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[homefitureslide_pict]',
                                    'is_image[homefitureslide_pict]',
                                    'mime_in[homefitureslide_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/fiturslide/add');
                        }
                        if ($fiturslidepict->isValid() && ! $fiturslidepict->hasMoved()) 
                        {
                            $fiturslidepict->move(ROOTPATH .'assets/upload/fiturslide', $newfiturslidepict, true);
                        }
                    }

                    $data = [
                        'homefiturslide_title' => $this->request->getVar('homefiturslide_title'),
                        'homefiturslide_title_en' => $this->request->getVar('homefiturslide_title_en'),
                        'homefiturslide_shortdesc' => $this->request->getVar('homefiturslide_shortdesc'),
                        'homefiturslide_shortdesc_en' => $this->request->getVar('homefiturslide_shortdesc_en'),
                        'homefitureslide_pict' => $newfiturslidepict,
                        'homefitureslide_link' => $this->request->getVar('homefitureslide_link')
                    ];
                    $insert = $this->Crud->createData('tbl_homefiturslide', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/fiturslide');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/fiturslide/add');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_fiturslide($homefiturslide_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homefiturslide', ['homefiturslide_id' => $homefiturslide_id], '', '', '', '', '');
            echo view('administrator/home/fiturslide/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_fiturslide()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload banner */
                    $fiturslidepict =  $this->request->getFile('homefitureslide_pict');
                    $newfiturslidepict = "bxsea_image".$fiturslidepict->getRandomName();
                    if ($fiturslidepict != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'homefitureslide_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[homefitureslide_pict]',
                                    'is_image[homefitureslide_pict]',
                                    'mime_in[homefitureslide_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/banner/update/'.$this->request->getVar('homefiturslide_id'));
                        }
                        if ($fiturslidepict->isValid() && ! $fiturslidepict->hasMoved()) 
                        {
                            if (is_file('assets/upload/fiturslide/'.$this->request->getVar('homefitureslide_pict_temp'))){
                                unlink('assets/upload/fiturslide/'.$this->request->getVar('homefitureslide_pict_temp'));
                            }
                            $fiturslidepict->move(ROOTPATH .'assets/upload/fiturslide', $newfiturslidepict, true);
                        }
                    }
                    /* End upload banner */

                    $data = [
                        'homefiturslide_title' => $this->request->getVar('homefiturslide_title'),
                        'homefiturslide_title_en' => $this->request->getVar('homefiturslide_title_en'),
                        'homefiturslide_shortdesc' => $this->request->getVar('homefiturslide_shortdesc'),
                        'homefiturslide_shortdesc_en' => $this->request->getVar('homefiturslide_shortdesc_en'),
                        'homefitureslide_pict' => ($fiturslidepict != "") ? $newfiturslidepict : $this->request->getVar('homefitureslide_pict_temp'),
                        'homefitureslide_link' => $this->request->getVar('homefitureslide_link')
                    ];
                    $update = $this->Crud->updateData('tbl_homefiturslide', $data, ['homefiturslide_id' => $this->request->getVar('homefiturslide_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/fiturslide');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/fiturslide');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_fiturslide($homefiturslide_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('homefitureslide_pict', 'tbl_homefiturslide', ['homefiturslide_id' => $homefiturslide_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/fiturslide/'.$val['homefitureslide_pict'])){
                        unlink('assets/upload/fiturslide/'.$val['homefitureslide_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_homefiturslide', ['homefiturslide_id' => $homefiturslide_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/home/fiturslide');
            }
            catch(\Throwable $ex)
            {
                log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* Fitur Slide Page */ 

    /* Influencer Page */ 
    public function influencer() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homeinfluencer', '', '', '', '', '', '');
            echo view('administrator/home/influencer/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_influencer()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/home/influencer/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_influencer()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $influencerpict =  $this->request->getFile('homeinfluencer_pict');
                    $newinfluencerpict = "bxsea_image_".$influencerpict->getRandomName();
                    if ($influencerpict != "")
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'homeinfluencer_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[homeinfluencer_pict]',
                                    'mime_in[homeinfluencer_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/influencer/add');
                        }
                        if ($influencerpict->isValid() && ! $influencerpict->hasMoved()) 
                        {
                            $influencerpict->move(ROOTPATH .'assets/upload/influencer', $newinfluencerpict, true);
                        }
                    }

                    $data = [
                        'homeinfluencer_name' => $this->request->getVar('homeinfluencer_name'),
                        'homeinfluencer_pict' => $newinfluencerpict,
                        'homeinfluencer_review' => $this->request->getVar('homeinfluencer_review'),
                        'homeinfluencer_review_en' => $this->request->getVar('homeinfluencer_review_en'),
                    ];
                    $insert = $this->Crud->createData('tbl_homeinfluencer', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/influencer');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/influencer/add');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_influencer($homeinfluencer_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homeinfluencer', ['homeinfluencer_id' => $homeinfluencer_id], '', '', '', '', '');
            echo view('administrator/home/influencer/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_influencer()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload influencer */
                    $influencerpict =  $this->request->getFile('homeinfluencer_pict');
                    $newInfluencerpict = "bxsea_image".$influencerpict->getRandomName();
                    if ($influencerpict != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'homeinfluencer_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[homeinfluencer_pict]',
                                    'mime_in[homeinfluencer_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/influencer/update/'.$this->request->getVar('homeinfluencer_id'));
                        }
                        if ($influencerpict->isValid() && ! $influencerpict->hasMoved()) 
                        {
                            if (is_file('assets/upload/influencer/'.$this->request->getVar('homeinfluencer_pict_temp'))){
                                unlink('assets/upload/influencer/'.$this->request->getVar('homeinfluencer_pict_temp'));
                            }
                            $influencerpict->move(ROOTPATH .'assets/upload/influencer', $newInfluencerpict, true);
                        }
                    }
                    /* End upload influencer */

                    $data = [
                        'homeinfluencer_name' => $this->request->getVar('homeinfluencer_name'),
                        'homeinfluencer_review' => $this->request->getVar('homeinfluencer_review'),
                        'homeinfluencer_review_en' => $this->request->getVar('homeinfluencer_review_en'),
                        'homeinfluencer_pict' => ($influencerpict != "") ? $newInfluencerpict : $this->request->getVar('homeinfluencer_pict_temp')
                    ];
                    $update = $this->Crud->updateData('tbl_homeinfluencer', $data, ['homeinfluencer_id' => $this->request->getVar('homeinfluencer_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/influencer');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/influencer');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_influencer($homeinfluencer_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('homeinfluencer_pict', 'tbl_homeinfluencer', ['homeinfluencer_id' => $homeinfluencer_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/influencer/'.$val['homeinfluencer_pict'])){
                        unlink('assets/upload/influencer/'.$val['homeinfluencer_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_homeinfluencer', ['homeinfluencer_id' => $homeinfluencer_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/home/influencer');
            }
            catch(\Throwable $ex)
            {
                log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* Influencer Page */ 

    /* Testimoni Page */ 
    public function testimoni() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_hometestimoni', '', '', '', '', '', '');
            echo view('administrator/home/testimoni/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_testimoni()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/home/testimoni/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_testimoni()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $testimonipict =  $this->request->getFile('testimoni_pict');
                    $newtestimonipict = "bxsea_image_".$testimonipict->getRandomName();
                    if ($testimonipict != "")
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'testimoni_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[testimoni_pict]',
                                    'is_image[testimoni_pict]',
                                    'mime_in[testimoni_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/testimoni/add');
                        }
                        if ($testimonipict->isValid() && ! $testimonipict->hasMoved()) 
                        {
                            $testimonipict->move(ROOTPATH .'assets/upload/testimoni', $newtestimonipict, true);
                        }
                    }

                    $data = [
                        'testimoni_name' => $this->request->getVar('testimoni_name'),
                        'testimoni_desc' => $this->request->getVar('testimoni_desc'),
                        'testimoni_desc_en' => $this->request->getVar('testimoni_desc_en'),
                        'testimoni_pict' => $newtestimonipict,
                    ];
                    $insert = $this->Crud->createData('tbl_hometestimoni', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/testimoni');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/testimoni/add');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_testimoni($testimoni_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_hometestimoni', ['testimoni_id' => $testimoni_id], '', '', '', '', '');
            echo view('administrator/home/testimoni/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_testimoni()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload testimoni */
                    $testimonipict =  $this->request->getFile('testimoni_pict');
                    $newTestimonipict = "bxsea_image".$testimonipict->getRandomName();
                    if ($testimonipict != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'testimoni_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[testimoni_pict]',
                                    'is_image[testimoni_pict]',
                                    'mime_in[testimoni_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/testimoni/update/'.$this->request->getVar('testimoni_id'));
                        }
                        if ($testimonipict->isValid() && ! $testimonipict->hasMoved()) 
                        {
                            if (is_file('assets/upload/testimoni/'.$this->request->getVar('testimoni_pict_temp'))){
                                unlink('assets/upload/testimoni/'.$this->request->getVar('testimoni_pict_temp'));
                            }
                            $testimonipict->move(ROOTPATH .'assets/upload/testimoni', $newTestimonipict, true);
                        }
                    }
                    /* End upload testimoni */

                    $data = [
                        'testimoni_name' => $this->request->getVar('homeinfluencer_name'),
                        'testimoni_desc' => $this->request->getVar('testimoni_desc'),
                        'testimoni_desc_en' => $this->request->getVar('testimoni_desc_en'),
                        'testimoni_pict' => ($testimonipict != "") ? $newTestimonipict : $this->request->getVar('testimoni_pict_temp')
                    ];
                    $update = $this->Crud->updateData('tbl_hometestimoni', $data, ['testimoni_id' => $this->request->getVar('testimoni_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/testimoni');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/testimoni');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_testimoni($testimoni_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('testimoni_pict', 'tbl_hometestimoni', ['testimoni_id' => $testimoni_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/testimoni/'.$val['testimoni_pict'])){
                        unlink('assets/upload/testimoni/'.$val['testimoni_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_hometestimoni', ['testimoni_id' => $testimoni_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/home/testimoni');
            }
            catch(\Throwable $ex)
            {
                log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* Testimoni Page */ 

    /* Partner Page */ 
    public function partner() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homepartner', '', '', '', '', '', '');
            echo view('administrator/home/partner/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_partner()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/home/partner/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_partner()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $partnerpict =  $this->request->getFile('partner_pict');
                    $newpartnerpict = "bxsea_image_".$partnerpict->getRandomName();
                    if ($newpartnerpict != "")
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'partner_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[partner_pict]',
                                    'is_image[partner_pict]',
                                    'mime_in[partner_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/partner/add');
                        }
                        if ($partnerpict->isValid() && ! $partnerpict->hasMoved()) 
                        {
                            $partnerpict->move(ROOTPATH .'assets/upload/partner', $newpartnerpict, true);
                        }
                    }

                    $data = [
                        'partner_title' => $this->request->getVar('partner_title'),
                        'partner_pict' => $newpartnerpict,
                    ];
                    $insert = $this->Crud->createData('tbl_homepartner', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/partner');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/partner/add');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_partner($partner_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homepartner', ['partner_id' => $partner_id], '', '', '', '', '');
            echo view('administrator/home/partner/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_partner()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload partner */
                    $partnerpict =  $this->request->getFile('partner_pict');
                    $newPartnerpict = "bxsea_image".$partnerpict->getRandomName();
                    if ($partnerpict != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'partner_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[partner_pict]',
                                    'is_image[partner_pict]',
                                    'mime_in[partner_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/partner/update/'.$this->request->getVar('partner_id'));
                        }
                        if ($partnerpict->isValid() && ! $partnerpict->hasMoved()) 
                        {
                            if (is_file('assets/upload/partner/'.$this->request->getVar('partner_pict_temp'))){
                                unlink('assets/upload/partner/'.$this->request->getVar('partner_pict_temp'));
                            }
                            $partnerpict->move(ROOTPATH .'assets/upload/partner', $newPartnerpict, true);
                        }
                    }
                    /* End upload testimoni */

                    $data = [
                        'partner_title' => $this->request->getVar('partner_title'),
                        'partner_pict' => ($partnerpict != "") ? $newPartnerpict : $this->request->getVar('partner_pict_temp')
                    ];
                    $update = $this->Crud->updateData('tbl_homepartner', $data, ['partner_id' => $this->request->getVar('partner_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/partner');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/partner');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_partner($partner_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('partner_pict', 'tbl_homepartner', ['partner_id' => $partner_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/partner/'.$val['partner_pict'])){
                        unlink('assets/upload/partner/'.$val['partner_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_homepartner', ['partner_id' => $partner_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/home/partner');
            }
            catch(\Throwable $ex)
            {
                log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* Partner Page */ 

    /* Sosmed Content Page */ 
    public function sosmedcontent() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homesosmedcontent', '', '', '', '', '', '');
            echo view('administrator/home/sosmedcontent/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_sosmedcontent()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/home/sosmedcontent/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_sosmedcontent()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $sosmedcontentfile =  $this->request->getFile('sosmedcontent_file');
                    $newsosmedcontentfile = "bxsea_image_".$sosmedcontentfile->getRandomName();
                    if ($sosmedcontentfile != "")
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'sosmedcontent_file' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[sosmedcontent_file]',
                                    'mime_in[sosmedcontent_file,image/jpg,image/jpeg,image/png,video/mp4]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/sosmedcontent/add');
                        }
                        if ($sosmedcontentfile->isValid() && ! $sosmedcontentfile->hasMoved()) 
                        {
                            $sosmedcontentfile->move(ROOTPATH .'assets/upload/sosmedcontent', $newsosmedcontentfile, true);
                        }
                    }

                    $data = [
                        'sosmedcontent_file' => $newsosmedcontentfile,
                        'sosmedcontent_link' => $this->request->getVar('sosmedcontent_link'),
                    ];
                    $insert = $this->Crud->createData('tbl_homesosmedcontent', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/sosmedcontent');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/sosmedcontent/add');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_sosmedcontent($sosmedcontent_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homesosmedcontent', ['sosmedcontent_id' => $sosmedcontent_id], '', '', '', '', '');
            echo view('administrator/home/sosmedcontent/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_sosmedcontent()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload sosmedcontent */
                    $sosmedcontentfile = $this->request->getFile('sosmedcontent_file');
                    $newsosmedcontentfile = '';
                    if ($sosmedcontentfile !== null && $sosmedcontentfile->isValid() && ! $sosmedcontentfile->hasMoved())
                    {
                        $newsosmedcontentfile = "bxsea_image".$sosmedcontentfile->getRandomName();
                        // Start process upload logo
                        $validationRule = [
                            'sosmedcontent_file' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[sosmedcontent_file]',
                                    'mime_in[sosmedcontent_file,image/jpg,image/jpeg,image/png,video/mp4,video/quicktime,application/mp4,application/octet-stream]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->to(site_url(getenv('bxsea.admin').'/home/sosmedcontent/update/'.$this->request->getVar('sosmedcontent_id')));
                        }
                        $oldfile = ROOTPATH.'assets/upload/sosmedcontent/'.$this->request->getVar('sosmedcontent_file_temp');
                        if (is_file($oldfile)){
                            unlink($oldfile);
                        }
                        $sosmedcontentfile->move(ROOTPATH .'assets/upload/sosmedcontent', $newsosmedcontentfile, true);
                    }
                    /* End upload sosmedcontent */

                    $data = [
                        'sosmedcontent_file' => ($newsosmedcontentfile !== '') ? $newsosmedcontentfile : $this->request->getVar('sosmedcontent_file_temp'),
                        'sosmedcontent_link' => $this->request->getVar('sosmedcontent_link')
                    ];
                    $update = $this->Crud->updateData('tbl_homesosmedcontent', $data, ['sosmedcontent_id' => $this->request->getVar('sosmedcontent_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->to(site_url(getenv('bxsea.admin').'/home/sosmedcontent'));
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->to(site_url(getenv('bxsea.admin').'/home/sosmedcontent'));
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_sosmedcontent($sosmedcontent_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('sosmedcontent_file', 'tbl_homesosmedcontent', ['sosmedcontent_id' => $sosmedcontent_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/sosmedcontent/'.$val['sosmedcontent_file'])){
                        unlink('assets/upload/sosmedcontent/'.$val['sosmedcontent_file']);
                    }
                }
                $this->Crud->deleteData('tbl_homesosmedcontent', ['sosmedcontent_id' => $sosmedcontent_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/home/sosmedcontent');
            }
            catch(\Throwable $ex)
            {
                log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* Sosmed Content Page */

    /* Announcement Page */ 
    public function announcement() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homeannouncement', '', '', '', '', '', '');
            echo view('administrator/home/announcement/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_announcement()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/home/announcement/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_announcement()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'homeannouncement_text' => $this->request->getVar('homeannouncement_text'),
                        'homeannouncement_text_en' => $this->request->getVar('homeannouncement_text_en')
                    ];
                    $insert = $this->Crud->createData('tbl_homeannouncement', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/announcement');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/announcement/add');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_announcement($homeannouncement_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_homeannouncement', ['homeannouncement_id' => $homeannouncement_id], '', '', '', '', '');
            echo view('administrator/home/announcement/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_announcement()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'homeannouncement_text' => $this->request->getVar('homeannouncement_text'),
                        'homeannouncement_text_en' => $this->request->getVar('homeannouncement_text_en')
                    ];
                    $update = $this->Crud->updateData('tbl_homeannouncement', $data, ['homeannouncement_id' => $this->request->getVar('homeannouncement_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/announcement');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/announcement');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_announcement($homeannouncement_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $this->Crud->deleteData('tbl_homeannouncement', ['homeannouncement_id' => $homeannouncement_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/home/announcement');
            }
            catch(\Throwable $ex)
            {
                log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* Announcement Page */ 

    /* Description Page */ 
    public function description() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_menu' => 'home'], '', '', '', '', '');
            echo view('administrator/home/description/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_description()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/home/description/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_description()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'masterdesc_title' => $this->request->getVar('masterdesc_title'),
                        'masterdesc_title_en' => $this->request->getVar('masterdesc_title_en'),
                        'masterdesc_desc' => $this->request->getVar('masterdesc_desc'),
                        'masterdesc_desc_en' => $this->request->getVar('masterdesc_desc_en'),
                        'masterdesc_position' => $this->request->getVar('masterdesc_position'),
                        'masterdesc_menu' => 'home',
                    ];
                    $insert = $this->Crud->createData('tbl_masterdesc', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/description');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/description/add');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_description($masterdesc_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_id' => $masterdesc_id], '', '', '', '', '');
            echo view('administrator/home/description/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_description()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $uploadPath = ROOTPATH . 'assets/upload/masterdesc';
                    if (! is_dir($uploadPath)) {
                        mkdir($uploadPath, 0775, true);
                    }

                    $pictName = $this->request->getVar('masterdesc_pict_temp') ?? '';
                    $pictFile = $this->request->getFile('masterdesc_pict');
                    if ($pictFile && $pictFile->isValid() && ! $pictFile->hasMoved()) {
                        $validationRule = ['masterdesc_pict' => ['label' => 'Image', 'rules' => ['uploaded[masterdesc_pict]', 'mime_in[masterdesc_pict,image/jpg,image/jpeg,image/png,image/webp,image/gif]']]];
                        if (! $this->validate($validationRule)) {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/home/description');
                        }
                        if ($pictName && is_file($uploadPath . '/' . $pictName)) {
                            unlink($uploadPath . '/' . $pictName);
                        }
                        $pictName = 'bxsea_image_' . $pictFile->getRandomName();
                        $pictFile->move($uploadPath, $pictName, true);
                    }

                    $data = [
                        'masterdesc_title' => $this->request->getVar('masterdesc_title'),
                        'masterdesc_title_en' => $this->request->getVar('masterdesc_title_en'),
                        'masterdesc_desc' => $this->request->getVar('masterdesc_desc'),
                        'masterdesc_desc_en' => $this->request->getVar('masterdesc_desc_en'),
                        'masterdesc_position' => $this->request->getVar('masterdesc_position'),
                        'masterdesc_menu' => 'home',
                        'masterdesc_pict' => $pictName,
                    ];
                    $update = $this->Crud->updateData('tbl_masterdesc', $data, ['masterdesc_id' => $this->request->getVar('masterdesc_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/description');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/home/description');
                    }
                }
                catch(\Throwable $ex)
                {
                    log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_description($masterdesc_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $this->Crud->deleteData('tbl_masterdesc', ['masterdesc_id' => $masterdesc_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/home/description');
            }
            catch(\Throwable $ex)
            {
                log_message('error', 'AdminHome: ' . $ex->getMessage()); return redirect()->to(site_url(getenv('bxsea.admin').'/dashboard'));
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* Description Page */ 
}

?>