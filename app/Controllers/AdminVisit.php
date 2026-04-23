<?php

namespace App\Controllers;
use Exception;
use CodeIgniter\Controller;
use App\Models\Crud;
use App\Models\VisitorInfoModel;

class AdminVisit extends BaseController {
    public function __construct()
    {
        $this->Crud = new Crud();
        $this->visitorInfoModel = new VisitorInfoModel();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    private function hasUploadedFile($file): bool
    {
        return $file && $file->isValid() && $file->getError() !== UPLOAD_ERR_NO_FILE && ! $file->hasMoved();
    }

    /* Tenant Page */ 
    public function tenant() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visittenant', '', '', '', '', '', '');
            echo view('administrator/visit/tenant/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_tenant()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/visit/tenant/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_tenant()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    /* upload tenant thumbnail pict */
                    $tenantthumbpict =  $this->request->getFile('tenant_thumbnail_pict');
                    $newtenantthumbpict = '';
                    $hasTenantThumbPict = $this->hasUploadedFile($tenantthumbpict);
                    if ($hasTenantThumbPict)
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'tenant_thumbnail_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[tenant_thumbnail_pict]',
                                    'mime_in[tenant_thumbnail_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/tenant/add');
                        }
                        $newtenantthumbpict = 'bxsea_image_' . $tenantthumbpict->getRandomName();
                        $tenantthumbpict->move(ROOTPATH .'assets/upload/tenant', $newtenantthumbpict, true);
                    }
                    /* upload tenant thumbnail pict */

                    /* upload tenant main pict */
                    $tenantmainpict =  $this->request->getFile('tenant_main_pict');
                    $newtenantmainpict = '';
                    $hasTenantMainPict = $this->hasUploadedFile($tenantmainpict);
                    if ($hasTenantMainPict)
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'tenant_main_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[tenant_main_pict]',
                                    'mime_in[tenant_main_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/tenant/add');
                        }
                        $newtenantmainpict = 'bxsea_image_' . $tenantmainpict->getRandomName();
                        $tenantmainpict->move(ROOTPATH .'assets/upload/tenant', $newtenantmainpict, true);
                    }
                    /* upload tenant main pict */

                    $data = [
                        'tenant_thumbnail_pict' => $newtenantthumbpict,
                        'tenant_main_pict' => $newtenantmainpict,
                        'tenant_title' => $this->request->getVar('tenant_title'),
                        'tenant_desc' => $this->request->getVar('tenant_desc'),
                        'tenant_desc_en' => $this->request->getVar('tenant_desc_en'),
                        'tenant_location' => $this->request->getVar('tenant_location'),
                        'tenant_location_en' => $this->request->getVar('tenant_location_en'),
                    ];
                    /* upload tenant popup image */
                    $tenantpopupimg = $this->request->getFile('tenant_popup_image');
                    if ($this->hasUploadedFile($tenantpopupimg)) {
                        if (! $this->validate(['tenant_popup_image' => ['label' => 'Popup Image', 'rules' => ['uploaded[tenant_popup_image]', 'mime_in[tenant_popup_image,image/jpg,image/jpeg,image/png]']]])) {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/tenant/add');
                        }
                        $data['tenant_popup_image'] = 'bxsea_image_' . $tenantpopupimg->getRandomName();
                        $tenantpopupimg->move(ROOTPATH . 'assets/upload/tenant', $data['tenant_popup_image'], true);
                    }
                    /* upload tenant galleries (min 1 max 3) */
                    $galleryNames = ['tenant_gallery1', 'tenant_gallery2', 'tenant_gallery3'];
                    $uploadedGalleries = 0;
                    foreach ($galleryNames as $gKey) {
                        $gFile = $this->request->getFile($gKey);
                        if ($this->hasUploadedFile($gFile)) {
                            if (! $this->validate([$gKey => ['label' => 'Gallery Image', 'rules' => ['uploaded['.$gKey.']', 'mime_in['.$gKey.',image/jpg,image/jpeg,image/png]']]])) {
                                $this->session->setFlashdata('invalidate', '-');
                                return redirect()->route(getenv('bxsea.admin').'/visit/tenant/add');
                            }
                            $data[$gKey] = 'bxsea_image_' . $gFile->getRandomName();
                            $gFile->move(ROOTPATH . 'assets/upload/tenant', $data[$gKey], true);
                            $uploadedGalleries++;
                        }
                    }
                    $data['tenant_popup_desc_id'] = $this->request->getVar('tenant_popup_desc_id');
                    $data['tenant_popup_desc_en'] = $this->request->getVar('tenant_popup_desc_en');
                    $data['tenant_btn_text']    = $this->request->getVar('tenant_btn_text');
                    $data['tenant_btn_text_en'] = $this->request->getVar('tenant_btn_text_en');
                    $insert = $this->Crud->createData('tbl_visittenant', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/tenant');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/tenant/add');
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
    public function update_tenant($tenant_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visittenant', ['tenant_id' => $tenant_id], '', '', '', '', '');
            echo view('administrator/visit/tenant/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_tenant()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload tenant thumbnail */
                    $tenantthumbpict =  $this->request->getFile('tenant_thumbnail_pict');
                    $newtenantthumbpict = $this->request->getVar('tenant_thumbnail_pict_temp');
                    $hasTenantThumbPict = $this->hasUploadedFile($tenantthumbpict);
                    if ($hasTenantThumbPict)
                    {
                        // Start process upload logo
                        $validationRule = [
                            'tenant_thumbnail_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[tenant_thumbnail_pict]',
                                    'mime_in[tenant_thumbnail_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/tenant/update/'.$this->request->getVar('tenant_id'));
                        }
                        $newtenantthumbpict = 'bxsea_image_' . $tenantthumbpict->getRandomName();
                        if (is_file('assets/upload/tenant/'.$this->request->getVar('tenant_thumbnail_pict_temp'))){
                            unlink('assets/upload/tenant/'.$this->request->getVar('tenant_thumbnail_pict_temp'));
                        }
                        $tenantthumbpict->move(ROOTPATH .'assets/upload/tenant', $newtenantthumbpict, true);
                    }
                    /* Start upload tenant thumbnail */

                    /* Start upload tenant mainpict */
                    $tenantmainpict =  $this->request->getFile('tenant_main_pict');
                    $newtenantmainpict = $this->request->getVar('tenant_main_pict_temp');
                    $hasTenantMainPict = $this->hasUploadedFile($tenantmainpict);
                    if ($hasTenantMainPict)
                    {
                        // Start process upload logo
                        $validationRule = [
                            'tenant_main_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[tenant_main_pict]',
                                    'mime_in[tenant_main_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/tenant/update/'.$this->request->getVar('tenant_id'));
                        }
                        $newtenantmainpict = 'bxsea_image_' . $tenantmainpict->getRandomName();
                        if (is_file('assets/upload/tenant/'.$this->request->getVar('tenant_main_pict_temp'))){
                            unlink('assets/upload/tenant/'.$this->request->getVar('tenant_main_pict_temp'));
                        }
                        $tenantmainpict->move(ROOTPATH .'assets/upload/tenant', $newtenantmainpict, true);
                    }
                    /* Start upload tenant mainpict */

                    $data = [
                        'tenant_thumbnail_pict' => $newtenantthumbpict,
                        'tenant_main_pict' => $newtenantmainpict,
                        'tenant_title' => $this->request->getVar('tenant_title'),
                        'tenant_desc' => $this->request->getVar('tenant_desc'),
                        'tenant_desc_en' => $this->request->getVar('tenant_desc_en'),
                        'tenant_location' => $this->request->getVar('tenant_location'),
                        'tenant_location_en' => $this->request->getVar('tenant_location_en'),
                    ];
                    /* update tenant popup image */
                    $tenantpopupimg = $this->request->getFile('tenant_popup_image');
                    $newtenantpopupimg = $this->request->getVar('tenant_popup_image_temp');
                    if ($this->hasUploadedFile($tenantpopupimg)) {
                        if (! $this->validate(['tenant_popup_image' => ['label' => 'Popup Image', 'rules' => ['uploaded[tenant_popup_image]', 'mime_in[tenant_popup_image,image/jpg,image/jpeg,image/png]']]])) {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/tenant/update/'.$this->request->getVar('tenant_id'));
                        }
                        if ($newtenantpopupimg && is_file('assets/upload/tenant/'.$newtenantpopupimg)) { unlink('assets/upload/tenant/'.$newtenantpopupimg); }
                        $newtenantpopupimg = 'bxsea_image_' . $tenantpopupimg->getRandomName();
                        $tenantpopupimg->move(ROOTPATH . 'assets/upload/tenant', $newtenantpopupimg, true);
                    }
                    $data['tenant_popup_image'] = $newtenantpopupimg;
                    /* update tenant galleries */
                    $galleryNames = ['tenant_gallery1', 'tenant_gallery2', 'tenant_gallery3'];
                    foreach ($galleryNames as $gKey) {
                        $gFile = $this->request->getFile($gKey);
                        $newGVal = $this->request->getVar($gKey.'_temp');
                        if ($this->hasUploadedFile($gFile)) {
                            if (! $this->validate([$gKey => ['label' => 'Gallery Image', 'rules' => ['uploaded['.$gKey.']', 'mime_in['.$gKey.',image/jpg,image/jpeg,image/png]']]])) {
                                $this->session->setFlashdata('invalidate', '-');
                                return redirect()->route(getenv('bxsea.admin').'/visit/tenant/update/'.$this->request->getVar('tenant_id'));
                            }
                            if ($newGVal && is_file('assets/upload/tenant/'.$newGVal)) { unlink('assets/upload/tenant/'.$newGVal); }
                            $newGVal = 'bxsea_image_' . $gFile->getRandomName();
                            $gFile->move(ROOTPATH . 'assets/upload/tenant', $newGVal, true);
                        }
                        $data[$gKey] = $newGVal;
                    }
                    $data['tenant_popup_desc_id'] = $this->request->getVar('tenant_popup_desc_id');
                    $data['tenant_popup_desc_en'] = $this->request->getVar('tenant_popup_desc_en');
                    $data['tenant_btn_text']    = $this->request->getVar('tenant_btn_text');
                    $data['tenant_btn_text_en'] = $this->request->getVar('tenant_btn_text_en');
                    $update = $this->Crud->updateData('tbl_visittenant', $data, ['tenant_id' => $this->request->getVar('tenant_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/tenant');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/tenant');
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
    public function delete_tenant($tenant_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('tenant_thumbnail_pict, tenant_main_pict', 'tbl_visittenant', ['tenant_id' => $tenant_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/tenant/'.$val['tenant_thumbnail_pict'])){
                        unlink('assets/upload/tenant/'.$val['tenant_thumbnail_pict']);
                    }
                    if (is_file('assets/upload/tenant/'.$val['tenant_main_pict'])){
                        unlink('assets/upload/tenant/'.$val['tenant_main_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_visittenant', ['tenant_id' => $tenant_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/visit/tenant');
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
    /* Tenant Page */ 

    /* Contact Page */ 
    public function contact() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitcontact', '', '', '', '', '', '');
            echo view('administrator/visit/contact/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_contanct($contact_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $this->Crud->deleteData('tbl_visitcontact', ['contact_id' => $contact_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/visit/contact');
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
    /* Contact Page */ 

    /* Faq Page */ 
    public function faq() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitfaq', '', '', '', '', '', '');
            echo view('administrator/visit/faq/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_faq()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/visit/faq/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_faq()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'faq_title' => $this->request->getVar('faq_title'),
                        'faq_title_en' => $this->request->getVar('faq_title_en'),
                        'faq_desc' => $this->request->getVar('faq_desc'),
                        'faq_desc_en' => $this->request->getVar('faq_desc_en'),
                        'faq_category' => $this->request->getVar('faq_category'),
                    ];
                    $insert = $this->Crud->createData('tbl_visitfaq', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/faq');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/faq/add');
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
    public function update_faq($faq_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitfaq', ['faq_id' => $faq_id], '', '', '', '', '');
            echo view('administrator/visit/faq/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_faq()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'faq_title' => $this->request->getVar('faq_title'),
                        'faq_title_en' => $this->request->getVar('faq_title_en'),
                        'faq_desc' => $this->request->getVar('faq_desc'),
                        'faq_desc_en' => $this->request->getVar('faq_desc_en'),
                    ];
                    $update = $this->Crud->updateData('tbl_visitfaq', $data, ['faq_id' => $this->request->getVar('faq_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/faq');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/faq');
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
    public function delete_faq($faq_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $this->Crud->deleteData('tbl_visitfaq', ['faq_id' => $faq_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/visit/faq');
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
    /* Faq Page */ 

    /* Guide Page */ 
    public function guide() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitguide', '', '', '', '', '', '');
            echo view('administrator/visit/guide/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_guide()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/visit/guide/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_guide()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $guidepict =  $this->request->getFile('guide_pict');
                    $newguidepict = '';
                    $hasGuidePict = $this->hasUploadedFile($guidepict);
                    if ($hasGuidePict)
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'guide_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[guide_pict]',
                                    'mime_in[guide_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/guide/add');
                        }
                        $newguidepict = 'bxsea_image_' . $guidepict->getRandomName();
                        $guidepict->move(ROOTPATH .'assets/upload/guide', $newguidepict, true);
                    }

                    $data = [
                        'guide_pict' => $newguidepict,
                        'guide_title' => $this->request->getVar('guide_title'),
                        'guide_desc' => $this->request->getVar('guide_desc'),
                        'guide_desc_en' => $this->request->getVar('guide_desc_en'),
                    ];
                    $insert = $this->Crud->createData('tbl_visitguide', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/guide');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/guide/add');
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
    public function update_guide($guide_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitguide', ['guide_id' => $guide_id], '', '', '', '', '');
            echo view('administrator/visit/guide/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_guide()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload guide pict */
                    $guidepict =  $this->request->getFile('guide_pict');
                    $newguidepict = $this->request->getVar('guide_pict_temp');
                    $hasGuidePict = $this->hasUploadedFile($guidepict);
                    if ($hasGuidePict)
                    {
                        // Start process upload logo
                        $validationRule = [
                            'guide_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[guide_pict]',
                                    'mime_in[guide_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/guide/update/'.$this->request->getVar('guide_id'));
                        }
                        $newguidepict = 'bxsea_image_' . $guidepict->getRandomName();
                        if (is_file('assets/upload/guide/'.$this->request->getVar('guide_pict_temp'))){
                            unlink('assets/upload/guide/'.$this->request->getVar('guide_pict_temp'));
                        }
                        $guidepict->move(ROOTPATH .'assets/upload/guide', $newguidepict, true);
                    }
                    /* End upload guide pict */

                    $data = [
                        'guide_pict' => $newguidepict,
                        'guide_title' => $this->request->getVar('guide_title'),
                        'guide_desc' => $this->request->getVar('guide_desc'),
                        'guide_desc_en' => $this->request->getVar('guide_desc_en'),
                    ];
                    $update = $this->Crud->updateData('tbl_visitguide', $data, ['guide_id' => $this->request->getVar('guide_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/guide');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/guide');
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
    public function delete_guide($guide_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('guide_pict', 'tbl_visitguide', ['guide_id' => $guide_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/guide/'.$val['guide_pict'])){
                        unlink('assets/upload/guide/'.$val['guide_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_visitguide', ['guide_id' => $guide_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/visit/guide');
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
    /* Guide Page */ 

    /* Map Page */ 
    public function map() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitmap', '', '', '', '', '', '');
            echo view('administrator/visit/map/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_map()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/visit/map/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_map()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $mappict =  $this->request->getFile('map_pict');
                    $newmappict = '';
                    $hasMapPict = $this->hasUploadedFile($mappict);
                    if ($hasMapPict)
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'map_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[map_pict]',
                                    'mime_in[map_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/map/add');
                        }
                        $newmappict = 'bxsea_image_' . $mappict->getRandomName();
                        $mappict->move(ROOTPATH .'assets/upload/map', $newmappict, true);
                    }

                    $mapfile =  $this->request->getFile('map_file');
                    $newmapfile = '';
                    $hasMapFile = $this->hasUploadedFile($mapfile);
                    if ($hasMapFile)
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'map_file' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[map_file]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/map/add');
                        }
                        $newmapfile = 'bxsea_file_' . $mapfile->getRandomName();
                        $mapfile->move(ROOTPATH .'assets/upload/map', $newmapfile, true);
                    }

                    $data = [
                        'map_title' => $this->request->getVar('map_title'),
                        'map_title_en' => $this->request->getVar('map_title_en'),
                        'map_desc' => $this->request->getVar('map_desc'),
                        'map_desc_en' => $this->request->getVar('map_desc_en'),
                        'map_pict' => $newmappict,
                        'map_file' => $newmapfile,
                    ];
                    $insert = $this->Crud->createData('tbl_visitmap', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/map');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/guide/add');
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
    public function update_map($map_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitmap', ['map_id' => $map_id], '', '', '', '', '');
            echo view('administrator/visit/map/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_map()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload map pict */
                    $mappict =  $this->request->getFile('map_pict');
                    $newmappict = $this->request->getVar('map_pict_temp');
                    $hasMapPict = $this->hasUploadedFile($mappict);
                    if ($hasMapPict)
                    {
                        // Start process upload logo
                        $validationRule = [
                            'map_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[map_pict]',
                                    'mime_in[map_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/map/update/'.$this->request->getVar('map_id'));
                        }
                        $newmappict = 'bxsea_image_' . $mappict->getRandomName();
                        if (is_file('assets/upload/map/'.$this->request->getVar('map_pict_temp'))){
                            unlink('assets/upload/map/'.$this->request->getVar('map_pict_temp'));
                        }
                        $mappict->move(ROOTPATH .'assets/upload/map', $newmappict, true);
                    }
                    /* End upload map pict */

                    /* Start upload map pict */
                    $mapfile =  $this->request->getFile('map_file');
                    $newmapfile = $this->request->getVar('map_file_temp');
                    $hasMapFile = $this->hasUploadedFile($mapfile);
                    if ($hasMapFile)
                    {
                        // Start process upload logo
                        $validationRule = [
                            'map_file' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[map_file]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/map/update/'.$this->request->getVar('map_id'));
                        }
                        $newmapfile = 'bxsea_file_' . $mapfile->getRandomName();
                        if (is_file('assets/upload/map/'.$this->request->getVar('map_file_temp'))){
                            unlink('assets/upload/map/'.$this->request->getVar('map_file_temp'));
                        }
                        $mapfile->move(ROOTPATH .'assets/upload/map', $newmapfile, true);
                    }
                    /* End upload map pict */

                    $data = [
                        'map_title' => $this->request->getVar('map_title'),
                        'map_title_en' => $this->request->getVar('map_title_en'),
                        'map_desc' => $this->request->getVar('map_desc'),
                        'map_desc_en' => $this->request->getVar('map_desc_en'),
                        'map_pict' => $newmappict,
                        'map_file' => $newmapfile,
                    ];
                    $update = $this->Crud->updateData('tbl_visitmap', $data, ['map_id' => $this->request->getVar('map_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/map');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/map');
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
    public function delete_map($map_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('map_pict, map_file', 'tbl_visitmap', ['map_id' => $map_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/map/'.$val['map_pict'])){
                        unlink('assets/upload/map/'.$val['map_pict']);
                    }
                    if (is_file('assets/upload/map/'.$val['map_file'])){
                        unlink('assets/upload/map/'.$val['map_file']);
                    }
                }
                $this->Crud->deleteData('tbl_visitmap', ['map_id' => $map_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/visit/map');
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
    /* Map Page */

    /* Merchandise Page */ 
    public function merchandise() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitmerchandise', '', '', ['tbl_visitmerchandise_category' => 'tbl_visitmerchandise.merchandise_category = tbl_visitmerchandise_category.merchandisecat_id'], '', '', '');
            echo view('administrator/visit/merchandise/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_merchandise()
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitmerchandise_category', '', '', '', '', '', '');
            echo view('administrator/visit/merchandise/add', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_merchandise()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $merchandisepict =  $this->request->getFile('merchandise_pict');
                    $newmerchandisepict = '';
                    $hasMerchandisePict = $this->hasUploadedFile($merchandisepict);
                    if ($hasMerchandisePict)
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'merchandise_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[merchandise_pict]',
                                    'mime_in[merchandise_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/merchandise/add');
                        }
                        $newmerchandisepict = 'bxsea_image_' . $merchandisepict->getRandomName();
                        $merchandisepict->move(ROOTPATH .'assets/upload/merchandise', $newmerchandisepict, true);
                    }

                    $data = [
                        'merchandise_title' => $this->request->getVar('merchandise_title'),
                        'merchandise_title_en' => $this->request->getVar('merchandise_title_en'),
                        'merchandise_desc' => $this->request->getVar('merchandise_desc'),
                        'merchandise_desc_en' => $this->request->getVar('merchandise_desc_en'),
                        'merchandise_pict' => $newmerchandisepict,
                        'merchandise_price' => $this->request->getVar('merchandise_price'),
                        'merchandise_category' => $this->request->getVar('merchandise_category'),
                    ];
                    $insert = $this->Crud->createData('tbl_visitmerchandise', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/merchandise');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/merchandise/add');
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
    public function update_merchandise($merchandise_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitmerchandise', ['merchandise_id' => $merchandise_id], '', '', '', '', '');
            echo view('administrator/visit/merchandise/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_merchandise()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload map pict */
                    $merchandisepict =  $this->request->getFile('merchandise_pict');
                    $newmerchandisepict = $this->request->getVar('merchandise_pict_temp');
                    $hasMerchandisePict = $this->hasUploadedFile($merchandisepict);
                    if ($hasMerchandisePict)
                    {
                        // Start process upload logo
                        $validationRule = [
                            'merchandise_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[merchandise_pict]',
                                    'mime_in[merchandise_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/visit/merchandise/update/'.$this->request->getVar('map_id'));
                        }
                        $newmerchandisepict = 'bxsea_image_' . $merchandisepict->getRandomName();
                        if (is_file('assets/upload/merchandise/'.$this->request->getVar('merchandise_pict_temp'))){
                            unlink('assets/upload/merchandise/'.$this->request->getVar('merchandise_pict_temp'));
                        }
                        $merchandisepict->move(ROOTPATH .'assets/upload/merchandise', $newmerchandisepict, true);
                    }
                    /* End upload map pict */

                    $data = [
                        'merchandise_title' => $this->request->getVar('merchandise_title'),
                        'merchandise_title_en' => $this->request->getVar('merchandise_title_en'),
                        'merchandise_desc' => $this->request->getVar('merchandise_desc'),
                        'merchandise_desc_en' => $this->request->getVar('merchandise_desc_en'),
                        'merchandise_pict' => $newmerchandisepict,
                        'merchandise_price' => $this->request->getVar('merchandise_price'),
                    ];
                    $update = $this->Crud->updateData('tbl_visitmerchandise', $data, ['merchandise_id' => $this->request->getVar('merchandise_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/merchandise');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/merchandise');
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
    public function delete_merchandise($merchandise_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('merchandise_pict', 'tbl_visitmerchandise', ['merchandise_id' => $merchandise_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/merchandise/'.$val['merchandise_pict'])){
                        unlink('assets/upload/merchandise/'.$val['merchandise_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_visitmerchandise', ['merchandise_id' => $merchandise_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/visit/merchandise');
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
    /* Merchandise Page */

    /* Schedule Page */ 
    public function schedule() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitschedule', '', '', '', '', '', '');
            echo view('administrator/visit/schedule/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_schedule()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/visit/schedule/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_schedule()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'schedule_date' => $this->request->getVar('schedule_date'),
                        'schedule_name' => $this->request->getVar('schedule_name'),
                        'schedule_name_en' => $this->request->getVar('schedule_name_en'),
                        'schedule_desc' => $this->request->getVar('schedule_desc'),
                        'schedule_desc_en' => $this->request->getVar('schedule_desc_en'),
                        'schedule_time' => $this->request->getVar('schedule_time'),
                    ];
                    $insert = $this->Crud->createData('tbl_visitschedule', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/schedule');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/schedule/add');
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
    public function update_schedule($schedule_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_visitschedule', ['schedule_id' => $schedule_id], '', '', '', '', '');
            echo view('administrator/visit/schedule/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_schedule()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'schedule_date' => $this->request->getVar('schedule_date'),
                        'schedule_name' => $this->request->getVar('schedule_name'),
                        'schedule_name_en' => $this->request->getVar('schedule_name_en'),
                        'schedule_desc' => $this->request->getVar('schedule_desc'),
                        'schedule_desc_en' => $this->request->getVar('schedule_desc_en'),
                        'schedule_time' => $this->request->getVar('schedule_time'),
                    ];
                    $update = $this->Crud->updateData('tbl_visitschedule', $data, ['schedule_id' => $this->request->getVar('schedule_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/schedule');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/schedule');
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
    public function delete_schedule($schedule_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $this->Crud->deleteData('tbl_visitschedule', ['schedule_id' => $schedule_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/visit/schedule');
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
    /* Merchandise Page */

    /* Description Page */ 
    public function description() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_menu' => 'visit'], '', '', '', '', '');
            echo view('administrator/visit/description/index', $data);
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
            echo view('administrator/visit/description/add');
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
                        'masterdesc_menu' => 'visit',
                    ];
                    $insert = $this->Crud->createData('tbl_masterdesc', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/description');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/description/add');
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
            echo view('administrator/visit/description/update', $data);
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
                        'masterdesc_menu' => 'visit',
                    ];
                    $update = $this->Crud->updateData('tbl_masterdesc', $data, ['masterdesc_id' => $this->request->getVar('masterdesc_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/description');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/visit/description');
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
                return redirect()->route(getenv('bxsea.admin').'/visit/description');
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

    public function visitorinfo()
    {
        if (session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->visitorInfoModel->orderBy('visitorinfo_sort', 'ASC')->orderBy('visitorinfo_id', 'DESC')->findAll();
            echo view('administrator/visit/visitorinfo/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }

    public function add_visitorinfo()
    {
        if (session()->get('islogin') == TRUE)
        {
            echo view('administrator/visit/visitorinfo/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }

    public function run_add_visitorinfo()
    {
        if (session()->get('islogin') != TRUE) {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }

        if (! $this->request->getVar('submit')) {
            return redirect()->route(getenv('bxsea.admin').'/visit/visitorinfo');
        }

        $data = $this->collectVisitorInfoPayload();

        if (! $this->visitorInfoModel->insert($data)) {
            $this->session->setFlashdata('failed', '-');
            return redirect()->route(getenv('bxsea.admin').'/visit/visitorinfo/add');
        }

        $this->session->setFlashdata('success', '-');
        return redirect()->route(getenv('bxsea.admin').'/visit/visitorinfo');
    }

    public function update_visitorinfo($visitorinfo_id = NULL)
    {
        if (session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->visitorInfoModel->find($visitorinfo_id);
            if (empty($data['getdata'])) {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/visit/visitorinfo');
            }
            echo view('administrator/visit/visitorinfo/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }

    public function run_update_visitorinfo()
    {
        if (session()->get('islogin') != TRUE) {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }

        $visitorinfoId = (int) $this->request->getVar('visitorinfo_id');
        $existing = $this->visitorInfoModel->find($visitorinfoId);

        if (empty($existing)) {
            $this->session->setFlashdata('failed', '-');
            return redirect()->route(getenv('bxsea.admin').'/visit/visitorinfo');
        }

        $data = $this->collectVisitorInfoPayload($existing);

        if (! $this->visitorInfoModel->update($visitorinfoId, $data)) {
            $this->session->setFlashdata('failed', '-');
            return redirect()->route(getenv('bxsea.admin').'/visit/visitorinfo/update/'.$visitorinfoId);
        }

        $this->session->setFlashdata('success', '-');
        return redirect()->route(getenv('bxsea.admin').'/visit/visitorinfo');
    }

    public function delete_visitorinfo($visitorinfo_id = NULL)
    {
        if (session()->get('islogin') != TRUE) {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }

        $this->visitorInfoModel->delete($visitorinfo_id);
        $this->session->setFlashdata('success', '-');
        return redirect()->route(getenv('bxsea.admin').'/visit/visitorinfo');
    }

    private function collectVisitorInfoPayload(array $existing = []): array
    {
        $uploadPath = ROOTPATH . 'assets/upload/visitorinfo';
        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }

        $iconName = $existing['visitorinfo_icon'] ?? null;
        $imageName = $existing['visitorinfo_image'] ?? null;

        $iconFile = $this->request->getFile('visitorinfo_icon');
        if ($iconFile && $iconFile->isValid() && ! $iconFile->hasMoved()) {
            $iconName = 'bxsea_icon_' . $iconFile->getRandomName();
            $iconFile->move($uploadPath, $iconName, true);
        }

        $imageFile = $this->request->getFile('visitorinfo_image');
        if ($imageFile && $imageFile->isValid() && ! $imageFile->hasMoved()) {
            $imageName = 'bxsea_image_' . $imageFile->getRandomName();
            $imageFile->move($uploadPath, $imageName, true);
        }

        return [
            'visitorinfo_section' => $this->request->getVar('visitorinfo_section'),
            'visitorinfo_title' => $this->request->getVar('visitorinfo_title'),
            'visitorinfo_title_en' => $this->request->getVar('visitorinfo_title_en'),
            'visitorinfo_desc' => $this->request->getVar('visitorinfo_desc'),
            'visitorinfo_desc_en' => $this->request->getVar('visitorinfo_desc_en'),
            'visitorinfo_icon' => $iconName,
            'visitorinfo_image' => $imageName,
            'visitorinfo_sort' => (int) ($this->request->getVar('visitorinfo_sort') ?: 0),
            'visitorinfo_status' => (int) ($this->request->getVar('visitorinfo_status') ?: 1),
        ];
    }
}