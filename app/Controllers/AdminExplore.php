<?php

namespace App\Controllers;
use Exception;
use CodeIgniter\Controller;
use App\Models\Crud;

class AdminExplore extends BaseController {
    public function __construct()
    {
        $this->Crud = new Crud();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    private function hasUploadedFile($file): bool
    {
        return $file && $file->isValid() && $file->getError() !== UPLOAD_ERR_NO_FILE && ! $file->hasMoved();
    }
    /* Journey Page */ 
    public function journey() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_explorejourney', '', '', '', '', '', '');
            echo view('administrator/explore/journey/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_journey()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/explore/journey/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_journey()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $journeypict =  $this->request->getFile('journey_pict');
                    $newjourneypict = "bxsea_image_".$journeypict->getRandomName();
                    if ($journeypict != "")
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'journey_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[journey_pict]',
                                    'mime_in[journey_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/journey/add');
                        }
                        if ($journeypict->isValid() && ! $journeypict->hasMoved()) 
                        {
                            $journeypict->move(ROOTPATH .'assets/upload/journey', $newjourneypict, true);
                        }
                    }

                    /* Popup pict 1 */
                    $popupPict1 = $this->request->getFile('journey_popup_pict1');
                    $newPopupPict1 = '';
                    if ($this->hasUploadedFile($popupPict1)) {
                        if (! $this->validate(['journey_popup_pict1' => ['label' => 'Popup Image 1', 'rules' => ['uploaded[journey_popup_pict1]', 'mime_in[journey_popup_pict1,image/jpg,image/jpeg,image/png]']]])) {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/journey/add');
                        }
                        $newPopupPict1 = 'bxsea_image_' . $popupPict1->getRandomName();
                        $popupPict1->move(ROOTPATH . 'assets/upload/journey', $newPopupPict1, true);
                    }
                    /* Popup pict 2 */
                    $popupPict2 = $this->request->getFile('journey_popup_pict2');
                    $newPopupPict2 = '';
                    if ($this->hasUploadedFile($popupPict2)) {
                        if (! $this->validate(['journey_popup_pict2' => ['label' => 'Popup Image 2', 'rules' => ['uploaded[journey_popup_pict2]', 'mime_in[journey_popup_pict2,image/jpg,image/jpeg,image/png]']]])) {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/journey/add');
                        }
                        $newPopupPict2 = 'bxsea_image_' . $popupPict2->getRandomName();
                        $popupPict2->move(ROOTPATH . 'assets/upload/journey', $newPopupPict2, true);
                    }

                    $data = [
                        'journey_title' => $this->request->getVar('journey_title'),
                        'journey_title_en' => $this->request->getVar('journey_title_en'),
                        'journey_desc' => $this->request->getVar('journey_desc'),
                        'journey_desc_en' => $this->request->getVar('journey_desc_en'),
                        'journey_pict' => $newjourneypict,
                        'journey_zone' => $this->request->getVar('journey_zone'),
                        'journey_popup_desc_id' => $this->request->getVar('journey_popup_desc_id'),
                        'journey_popup_desc_en' => $this->request->getVar('journey_popup_desc_en'),
                        'journey_popup_pict1' => $newPopupPict1,
                        'journey_popup_pict1_label_id' => $this->request->getVar('journey_popup_pict1_label_id'),
                        'journey_popup_pict1_label_en' => $this->request->getVar('journey_popup_pict1_label_en'),
                        'journey_popup_pict2' => $newPopupPict2,
                        'journey_popup_pict2_label_id' => $this->request->getVar('journey_popup_pict2_label_id'),
                        'journey_popup_pict2_label_en' => $this->request->getVar('journey_popup_pict2_label_en'),
                    ];
                    $insert = $this->Crud->createData('tbl_explorejourney', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/journey');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/journey/add');
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
    public function update_journey($journey_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_explorejourney', ['journey_id' => $journey_id], '', '', '', '', '');
            echo view('administrator/explore/journey/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_journey()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload ticket */
                    $journeypict =  $this->request->getFile('journey_pict');
                    $newjourneypict = "bxsea_image".$journeypict->getRandomName();
                    if ($journeypict != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'journey_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[journey_pict]',
                                    'mime_in[journey_pict,image/jpg,image/jpeg,image/png,video/mp4]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/journey/update/'.$this->request->getVar('journey_id'));
                        }
                        if ($journeypict->isValid() && ! $journeypict->hasMoved()) 
                        {
                            if (is_file('assets/upload/journey/'.$this->request->getVar('journey_pict_temp'))){
                                unlink('assets/upload/journey/'.$this->request->getVar('journey_pict_temp'));
                            }
                            $journeypict->move(ROOTPATH .'assets/upload/journey', $newjourneypict, true);
                        }
                    }
                    /* End upload testimoni */

                    /* Popup pict 1 update */
                    $popupPict1 = $this->request->getFile('journey_popup_pict1');
                    $newPopupPict1 = $this->request->getVar('journey_popup_pict1_temp');
                    if ($this->hasUploadedFile($popupPict1)) {
                        if (! $this->validate(['journey_popup_pict1' => ['label' => 'Popup Image 1', 'rules' => ['uploaded[journey_popup_pict1]', 'mime_in[journey_popup_pict1,image/jpg,image/jpeg,image/png]']]])) {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/journey/update/'.$this->request->getVar('journey_id'));
                        }
                        if ($newPopupPict1 && is_file('assets/upload/journey/'.$newPopupPict1)) { unlink('assets/upload/journey/'.$newPopupPict1); }
                        $newPopupPict1 = 'bxsea_image_' . $popupPict1->getRandomName();
                        $popupPict1->move(ROOTPATH . 'assets/upload/journey', $newPopupPict1, true);
                    }
                    /* Popup pict 2 update */
                    $popupPict2 = $this->request->getFile('journey_popup_pict2');
                    $newPopupPict2 = $this->request->getVar('journey_popup_pict2_temp');
                    if ($this->hasUploadedFile($popupPict2)) {
                        if (! $this->validate(['journey_popup_pict2' => ['label' => 'Popup Image 2', 'rules' => ['uploaded[journey_popup_pict2]', 'mime_in[journey_popup_pict2,image/jpg,image/jpeg,image/png]']]])) {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/journey/update/'.$this->request->getVar('journey_id'));
                        }
                        if ($newPopupPict2 && is_file('assets/upload/journey/'.$newPopupPict2)) { unlink('assets/upload/journey/'.$newPopupPict2); }
                        $newPopupPict2 = 'bxsea_image_' . $popupPict2->getRandomName();
                        $popupPict2->move(ROOTPATH . 'assets/upload/journey', $newPopupPict2, true);
                    }

                    $data = [
                        'journey_title' => $this->request->getVar('journey_title'),
                        'journey_title_en' => $this->request->getVar('journey_title_en'),
                        'journey_desc' => $this->request->getVar('journey_desc'),
                        'journey_desc_en' => $this->request->getVar('journey_desc_en'),
                        'journey_pict' => ($journeypict != "") ? $newjourneypict : $this->request->getVar('journey_pict_temp'),
                        'journey_zone' => $this->request->getVar('journey_zone'),
                        'journey_popup_desc_id' => $this->request->getVar('journey_popup_desc_id'),
                        'journey_popup_desc_en' => $this->request->getVar('journey_popup_desc_en'),
                        'journey_popup_pict1' => $newPopupPict1,
                        'journey_popup_pict1_label_id' => $this->request->getVar('journey_popup_pict1_label_id'),
                        'journey_popup_pict1_label_en' => $this->request->getVar('journey_popup_pict1_label_en'),
                        'journey_popup_pict2' => $newPopupPict2,
                        'journey_popup_pict2_label_id' => $this->request->getVar('journey_popup_pict2_label_id'),
                        'journey_popup_pict2_label_en' => $this->request->getVar('journey_popup_pict2_label_en'),
                    ];
                    $update = $this->Crud->updateData('tbl_explorejourney', $data, ['journey_id' => $this->request->getVar('journey_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/journey');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/journey');
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
    public function delete_journey($journey_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('journey_pict', 'tbl_explorejourney', ['journey_id' => $journey_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/journey/'.$val['journey_pict'])){
                        unlink('assets/upload/journey/'.$val['journey_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_explorejourney', ['journey_id' => $journey_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/explore/journey');
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
    /* Journey Page */ 

    /* Main Carousel Page */
    public function maincarousel() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_explore_main_carousel', '', '', '', '', ['carousel_id' => 'ASC'], '');
            echo view('administrator/explore/maincarousel/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_maincarousel()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/explore/maincarousel/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_maincarousel()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $img = $this->request->getFile('carousel_image');
                    $newImg = '';
                    if ($this->hasUploadedFile($img)) {
                        if (! $this->validate(['carousel_image' => ['label' => 'Image File', 'rules' => ['uploaded[carousel_image]', 'mime_in[carousel_image,image/jpg,image/jpeg,image/png]']]])) {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/maincarousel/add');
                        }
                        $newImg = 'bxsea_image_' . $img->getRandomName();
                        $img->move(ROOTPATH . 'assets/upload/maincarousel', $newImg, true);
                    }
                    $data = [
                        'carousel_title_id' => $this->request->getVar('carousel_title_id'),
                        'carousel_title_en' => $this->request->getVar('carousel_title_en'),
                        'carousel_zone'     => $this->request->getVar('carousel_zone'),
                        'carousel_desc_id'  => $this->request->getVar('carousel_desc_id'),
                        'carousel_desc_en'  => $this->request->getVar('carousel_desc_en'),
                        'carousel_image'    => $newImg,
                        'carousel_created_at' => date('Y-m-d H:i:s'),
                    ];
                    $insert = $this->Crud->createData('tbl_explore_main_carousel', $data);
                    if ($insert) {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/maincarousel');
                    } else {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/maincarousel/add');
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
    public function update_maincarousel($carousel_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_explore_main_carousel', ['carousel_id' => $carousel_id], '', '', '', '', '');
            echo view('administrator/explore/maincarousel/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_maincarousel()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $img = $this->request->getFile('carousel_image');
                    $newImg = $this->request->getVar('carousel_image_temp');
                    if ($this->hasUploadedFile($img)) {
                        if (! $this->validate(['carousel_image' => ['label' => 'Image File', 'rules' => ['uploaded[carousel_image]', 'mime_in[carousel_image,image/jpg,image/jpeg,image/png]']]])) {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/maincarousel/update/'.$this->request->getVar('carousel_id'));
                        }
                        if ($newImg && is_file('assets/upload/maincarousel/'.$newImg)) { unlink('assets/upload/maincarousel/'.$newImg); }
                        $newImg = 'bxsea_image_' . $img->getRandomName();
                        $img->move(ROOTPATH . 'assets/upload/maincarousel', $newImg, true);
                    }
                    $data = [
                        'carousel_title_id' => $this->request->getVar('carousel_title_id'),
                        'carousel_title_en' => $this->request->getVar('carousel_title_en'),
                        'carousel_zone'     => $this->request->getVar('carousel_zone'),
                        'carousel_desc_id'  => $this->request->getVar('carousel_desc_id'),
                        'carousel_desc_en'  => $this->request->getVar('carousel_desc_en'),
                        'carousel_image'    => $newImg,
                    ];
                    $update = $this->Crud->updateData('tbl_explore_main_carousel', $data, ['carousel_id' => $this->request->getVar('carousel_id')]);
                    if ($update) {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/maincarousel');
                    } else {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/maincarousel');
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
    public function delete_maincarousel($carousel_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('carousel_image', 'tbl_explore_main_carousel', ['carousel_id' => $carousel_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if ($val['carousel_image'] && is_file('assets/upload/maincarousel/'.$val['carousel_image'])) {
                        unlink('assets/upload/maincarousel/'.$val['carousel_image']);
                    }
                }
                $this->Crud->deleteData('tbl_explore_main_carousel', ['carousel_id' => $carousel_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/explore/maincarousel');
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
    /* Main Carousel Page */

    /* Show Page */ 
    public function show() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_exploreshow', '', '', '', '', '', '');
            echo view('administrator/explore/show/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_show()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/explore/show/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_show()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $showpict =  $this->request->getFile('show_pict');
                    $newshowpict = "bxsea_image_".$showpict->getRandomName();
                    if ($showpict != "")
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'show_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[show_pict]',
                                    'mime_in[show_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/show/add');
                        }
                        if ($showpict->isValid() && ! $showpict->hasMoved()) 
                        {
                            $showpict->move(ROOTPATH .'assets/upload/show', $newshowpict, true);
                        }
                    }

                    $showposter =  $this->request->getFile('show_poster');
                    $newshowposter = "bxsea_image_".$showposter->getRandomName();
                    if ($showposter != "")
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'show_poster' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[show_poster]',
                                    'mime_in[show_poster,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/show/add');
                        }
                        if ($showposter->isValid() && ! $showposter->hasMoved()) 
                        {
                            $showposter->move(ROOTPATH .'assets/upload/show', $newshowposter, true);
                        }
                    }

                    $data = [
                        'show_title' => $this->request->getVar('show_title'),
                        'show_title_en' => $this->request->getVar('show_title_en'),
                        'show_desc' => $this->request->getVar('show_desc'),
                        'show_desc_en' => $this->request->getVar('show_desc_en'),
                        'show_type' => $this->request->getVar('show_type') === 'seapecial' ? 'seapecial' : 'regular',
                        'show_pict' => $newshowpict,
                        'show_poster' => $newshowposter,
                    ];
                    $insert = $this->Crud->createData('tbl_exploreshow', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/show');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/show/add');
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
    public function update_show($show_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_exploreshow', ['show_id' => $show_id], '', '', '', '', '');
            echo view('administrator/explore/show/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_show()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload show */
                    $showpict =  $this->request->getFile('show_pict');
                    $newshowpict = "bxsea_image".$showpict->getRandomName();
                    if ($showpict != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'show_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[show_pict]',
                                    'mime_in[show_pict,image/jpg,image/jpeg,image/png,video/mp4]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/show/update/'.$this->request->getVar('show_id'));
                        }
                        if ($showpict->isValid() && ! $showpict->hasMoved()) 
                        {
                            if (is_file('assets/upload/show/'.$this->request->getVar('show_pict_temp'))){
                                unlink('assets/upload/show/'.$this->request->getVar('show_pict_temp'));
                            }
                            $showpict->move(ROOTPATH .'assets/upload/show', $newshowpict, true);
                        }
                    }
                    /* End upload show */

                    /* Start upload show poster */
                    $showposter =  $this->request->getFile('show_poster');
                    $newshowposter = "bxsea_image".$showposter->getRandomName();
                    if ($showposter != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'show_poster' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[show_poster]',
                                    'mime_in[show_poster,image/jpg,image/jpeg,image/png,video/mp4]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/explore/show/update/'.$this->request->getVar('show_id'));
                        }
                        if ($showposter->isValid() && ! $showposter->hasMoved()) 
                        {
                            if (is_file('assets/upload/show/'.$this->request->getVar('show_poster_temp'))){
                                unlink('assets/upload/show/'.$this->request->getVar('show_poster_temp'));
                            }
                            $showposter->move(ROOTPATH .'assets/upload/show', $newshowposter, true);
                        }
                    }
                    /* End upload show poster */

                    $data = [
                        'show_title' => $this->request->getVar('show_title'),
                        'show_title_en' => $this->request->getVar('show_title_en'),
                        'show_desc' => $this->request->getVar('show_desc'),
                        'show_desc_en' => $this->request->getVar('show_desc_en'),
                        'show_type' => $this->request->getVar('show_type') === 'seapecial' ? 'seapecial' : 'regular',
                        'show_pict' => ($showpict != "") ? $newshowpict : $this->request->getVar('show_pict_temp'),
                        'show_poster' => ($showposter != "") ? $newshowposter : $this->request->getVar('show_poster_temp'),
                    ];
                    $update = $this->Crud->updateData('tbl_exploreshow', $data, ['show_id' => $this->request->getVar('show_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/show');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/show');
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
    public function delete_show($show_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('show_pict, show_poster', 'tbl_exploreshow', ['show_id' => $show_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/show/'.$val['show_pict'])){
                        unlink('assets/upload/show/'.$val['show_pict']);
                    }
                    if (is_file('assets/upload/show/'.$val['show_poster'])){
                        unlink('assets/upload/show/'.$val['show_poster']);
                    }
                }
                $this->Crud->deleteData('tbl_exploreshow', ['show_id' => $show_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/explore/show');
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
    /* Show Page */ 

    /* Description Page */ 
    public function description() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_menu' => 'explore'], '', '', '', '', '');
            echo view('administrator/explore/description/index', $data);
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
            echo view('administrator/explore/description/add');
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
                        'masterdesc_menu' => 'explore',
                    ];
                    $insert = $this->Crud->createData('tbl_masterdesc', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/description');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/description/add');
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
    public function update_description($masterdesc_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_id' => $masterdesc_id], '', '', '', '', '');
            echo view('administrator/explore/description/update', $data);
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
                    $data = [
                        'masterdesc_title' => $this->request->getVar('masterdesc_title'),
                        'masterdesc_title_en' => $this->request->getVar('masterdesc_title_en'),
                        'masterdesc_desc' => $this->request->getVar('masterdesc_desc'),
                        'masterdesc_desc_en' => $this->request->getVar('masterdesc_desc_en'),
                        'masterdesc_position' => $this->request->getVar('masterdesc_position'),
                        'masterdesc_menu' => 'explore',
                    ];
                    $update = $this->Crud->updateData('tbl_masterdesc', $data, ['masterdesc_id' => $this->request->getVar('masterdesc_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/description');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/explore/description');
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
    public function delete_description($masterdesc_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $this->Crud->deleteData('tbl_masterdesc', ['masterdesc_id' => $masterdesc_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/explore/description');
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
    /* Description Page */ 
}

?>