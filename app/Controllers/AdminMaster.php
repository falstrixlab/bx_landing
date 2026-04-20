<?php

namespace App\Controllers;
use Exception;
use CodeIgniter\Controller;
use App\Models\Crud;
use App\Models\DesignAssetModel;

class AdminMaster extends BaseController {
    protected $Crud;
    protected $designAssetModel;
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->Crud = new Crud();
        $this->designAssetModel = new DesignAssetModel();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    private function hasUploadedFile($file): bool
    {
        return $file && $file->isValid() && $file->getError() !== UPLOAD_ERR_NO_FILE && ! $file->hasMoved();
    }

    private function getDesignAssetFileOptions(): array
    {
        $designPath = ROOTPATH . 'assets/landing/image';
        if (! is_dir($designPath)) {
            return [];
        }

        $entries = scandir($designPath) ?: [];
        $files = [];
        foreach ($entries as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }

            $fullPath = $designPath . DIRECTORY_SEPARATOR . $entry;
            if (is_file($fullPath)) {
                $files[] = $entry;
            }
        }

        natcasesort($files);
        return array_values($files);
    }

    private function persistDesignAssetPayload(?array $existing = null): array
    {
        $source = $this->request->getVar('designasset_source') ?: 'redesign';
        $directory = trim((string) ($this->request->getVar('designasset_directory') ?: 'image'));
        $directory = $directory === '' ? 'image' : $directory;
        $file = trim((string) $this->request->getVar('designasset_file_redesign'));

        if ($source === 'upload') {
            $uploadedFile = $this->request->getFile('designasset_file_upload');
            if ($this->hasUploadedFile($uploadedFile)) {
                $file = 'bxsea_designasset_' . $uploadedFile->getRandomName();
                $uploadedFile->move(ROOTPATH . 'assets/upload/designasset', $file, true);

                if ($existing && ($existing['designasset_source'] ?? '') === 'upload' && ! empty($existing['designasset_file'])) {
                    $oldFile = ROOTPATH . 'assets/upload/designasset/' . $existing['designasset_file'];
                    if (is_file($oldFile)) {
                        unlink($oldFile);
                    }
                }
            } elseif ($existing && ($existing['designasset_source'] ?? '') === 'upload') {
                $file = $existing['designasset_file'];
            }

            if ($file === '') {
                throw new Exception('Upload asset file is required.');
            }

            $directory = 'image';
        } else {
            if ($file === '' && $existing) {
                $file = $existing['designasset_file'];
            }

            if ($file === '') {
                throw new Exception('Redesign asset file is required.');
            }

            if ($existing && ($existing['designasset_source'] ?? '') === 'upload' && ! empty($existing['designasset_file'])) {
                $oldFile = ROOTPATH . 'assets/upload/designasset/' . $existing['designasset_file'];
                if (is_file($oldFile)) {
                    unlink($oldFile);
                }
            }
        }

        return [
            'designasset_group' => trim((string) $this->request->getVar('designasset_group')),
            'designasset_key' => trim((string) $this->request->getVar('designasset_key')),
            'designasset_label' => trim((string) $this->request->getVar('designasset_label')),
            'designasset_label_en' => trim((string) $this->request->getVar('designasset_label_en')),
            'designasset_source' => $source,
            'designasset_directory' => $directory,
            'designasset_file' => $file,
            'designasset_alt' => trim((string) $this->request->getVar('designasset_alt')),
            'designasset_status' => (int) ($this->request->getVar('designasset_status') ?? 1),
            'designasset_sort' => (int) ($this->request->getVar('designasset_sort') ?? 0),
        ];
    }

    private function handleArticleImageUpload(bool $required, ?string $existingFile = null): ?string
    {
        $articleImage = $this->request->getFile('article_pict');

        if (! $articleImage || $articleImage->getError() === UPLOAD_ERR_NO_FILE) {
            if ($required) {
                throw new Exception('Gambar artikel wajib diunggah.');
            }

            return $existingFile;
        }

        $validationRule = [
            'article_pict' => [
                'label' => 'Gambar artikel',
                'rules' => [
                    'uploaded[article_pict]',
                    'is_image[article_pict]',
                    'mime_in[article_pict,image/jpg,image/jpeg,image/png,image/webp]',
                    'max_size[article_pict,5120]',
                ],
            ],
        ];

        if (! $this->validate($validationRule)) {
            $errors = $this->validator ? $this->validator->getErrors() : [];
            throw new Exception($errors['article_pict'] ?? 'Upload gambar artikel gagal. Periksa format dan ukuran file.');
        }

        if (! $articleImage->isValid() || $articleImage->hasMoved()) {
            throw new Exception('File gambar artikel tidak valid atau sudah diproses sebelumnya.');
        }

        $newArticlePict = 'bxsea_image_' . $articleImage->getRandomName();

        try {
            $articleImage->move(ROOTPATH . 'assets/upload/article', $newArticlePict, true);
        } catch (Exception $ex) {
            throw new Exception('Gagal mengunggah gambar artikel ke server. ' . $ex->getMessage(), 0, $ex);
        }

        if ($existingFile) {
            $oldFile = ROOTPATH . 'assets/upload/article/' . $existingFile;
            if (is_file($oldFile)) {
                unlink($oldFile);
            }
        }

        return $newArticlePict;
    }
    /* Description Page */ 
    public function description() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', '', '', '', '', '', '');
            echo view('administrator/master/description/index', $data);
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
            echo view('administrator/master/description/add');
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
                        'masterdesc_menu' => $this->request->getVar('masterdesc_menu'),
                    ];
                    $insert = $this->Crud->createData('tbl_masterdesc', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/description');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/description/add');
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
            echo view('administrator/master/description/update', $data);
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
                        'masterdesc_menu' => $this->request->getVar('masterdesc_menu'),
                    ];
                    $update = $this->Crud->updateData('tbl_masterdesc', $data, ['masterdesc_id' => $this->request->getVar('masterdesc_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/description');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/description');
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
                return redirect()->route(getenv('bxsea.admin').'/master/description');
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

    /* Legal Page */ 
    public function legal() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_masterlegal', '', '', '', '', '', '');
            echo view('administrator/master/legal/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_legal()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/master/legal/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_legal()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'masterlegal_title' => $this->request->getVar('masterlegal_title'),
                        'masterlegal_title_en' => $this->request->getVar('masterlegal_title_en'),
                        'masterlegal_desc' => $this->request->getVar('masterlegal_desc'),
                        'masterlegal_desc_en' => $this->request->getVar('masterlegal_desc_en'),
                        'masterlegal_position' => $this->request->getVar('masterlegal_position')
                    ];
                    $insert = $this->Crud->createData('tbl_masterlegal', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/legal');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/legal/add');
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
    public function update_legal($masterlegal_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_masterlegal', ['masterlegal_id' => $masterlegal_id], '', '', '', '', '');
            echo view('administrator/master/legal/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_legal()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'masterlegal_title' => $this->request->getVar('masterlegal_title'),
                        'masterlegal_title_en' => $this->request->getVar('masterlegal_title_en'),
                        'masterlegal_desc' => $this->request->getVar('masterlegal_desc'),
                        'masterlegal_desc_en' => $this->request->getVar('masterlegal_desc_en'),
                        'masterlegal_position' => $this->request->getVar('masterlegal_position')
                    ];
                    $update = $this->Crud->updateData('tbl_masterlegal', $data, ['masterlegal_id' => $this->request->getVar('masterlegal_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/legal');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/legal');
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
    public function delete_legal($masterlegal_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $this->Crud->deleteData('tbl_masterlegal', ['masterlegal_id' => $masterlegal_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/master/legal');
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
    /* Legal Page */ 

    /* Setup Page */ 
    public function setup() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
            echo view('administrator/master/setup/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_setup()
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
            echo view('administrator/master/setup/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_setup()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload setup logo */
                    $mastersetuplogo =  $this->request->getFile('setup_logo');
                    $newNameSetupLogo = "bxsea_image_".$mastersetuplogo->getRandomName();
                    if ($mastersetuplogo != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'setup_logo' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[setup_logo]',
                                    'mime_in[setup_logo,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/master/setup/update/'.$this->request->getVar('setup_id'));
                        }
                        if ($mastersetuplogo->isValid() && ! $mastersetuplogo->hasMoved()) 
                        {
                            if (is_file('assets/upload/setup/'.$this->request->getVar('setup_logo_temp'))){
                                unlink('assets/upload/setup/'.$this->request->getVar('setup_logo_temp'));
                            }
                            $mastersetuplogo->move(ROOTPATH .'assets/upload/setup', $newNameSetupLogo, true);
                        }
                    }
                    /* End upload setup logo */

                    /* Start upload favicon */
                    $mastersetupfavion =  $this->request->getFile('setup_favicon');
                    $newNameSetupFavicon = "bxsea_image".$mastersetupfavion->getRandomName();
                    if ($mastersetupfavion != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'setup_favicon' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[setup_favicon]',
                                    'mime_in[setup_favicon,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/master/setup/update/'.$this->request->getVar('setup_id'));
                        }
                        if ($mastersetupfavion->isValid() && ! $mastersetupfavion->hasMoved()) 
                        {
                            if (is_file('assets/upload/setup/'.$this->request->getVar('setup_favicon_temp'))){
                                unlink('assets/upload/setup/'.$this->request->getVar('setup_favicon_temp'));
                            }
                            $mastersetupfavion->move(ROOTPATH .'assets/upload/setup', $newNameSetupFavicon, true);
                        }
                    }
                    /* End upload favicon */

                    /* Start upload footer holding */
                    $mastersetupfooterholding =  $this->request->getFile('setup_footer_holding_pict');
                    $newNameSetupFooterHolding = "bxsea_image".$mastersetupfooterholding->getRandomName();
                    if ($mastersetupfooterholding != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'setup_footer_holding_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[setup_footer_holding_pict]',
                                    'mime_in[setup_footer_holding_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/master/setup/update/'.$this->request->getVar('setup_id'));
                        }
                        if ($mastersetupfooterholding->isValid() && ! $mastersetupfooterholding->hasMoved()) 
                        {
                            if (is_file('assets/upload/setup/'.$this->request->getVar('setup_footer_holding_pict_temp'))){
                                unlink('assets/upload/setup/'.$this->request->getVar('setup_footer_holding_pict_temp'));
                            }
                            $mastersetupfooterholding->move(ROOTPATH .'assets/upload/setup', $newNameSetupFooterHolding, true);
                        }
                    }
                    /* End upload footer holding */

                    /* Start upload footer company */
                    $mastersetupfootercompany =  $this->request->getFile('setup_footer_company_pict');
                    $newNameSetupFooterCompany = "bxsea_image".$mastersetupfootercompany->getRandomName();
                    if ($mastersetupfootercompany != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'setup_footer_company_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[setup_footer_company_pict]',
                                    'mime_in[setup_footer_company_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/master/setup/update/'.$this->request->getVar('setup_id'));
                        }
                        if ($mastersetupfootercompany->isValid() && ! $mastersetupfootercompany->hasMoved()) 
                        {
                            if (is_file('assets/upload/setup/'.$this->request->getVar('setup_footer_company_pict_temp'))){
                                unlink('assets/upload/setup/'.$this->request->getVar('setup_footer_company_pict_temp'));
                            }
                            $mastersetupfootercompany->move(ROOTPATH .'assets/upload/setup', $newNameSetupFooterCompany, true);
                        }
                    }
                    /* End upload footer company */
                    
                    $data = [
                        'setup_title' => $this->request->getVar('setup_title'),
                        'setup_logo' => ($mastersetuplogo != "") ? $newNameSetupLogo : $this->request->getVar('setup_logo_temp'),
                        'setup_favicon' => ($mastersetupfavion != "") ? $newNameSetupFavicon : $this->request->getVar('setup_favicon_temp'),
                        'setup_address' => $this->request->getVar('setup_address'),
                        'setup_gmaps' => $this->request->getVar('setup_gmaps'),
                        'setup_operation_day' => $this->request->getVar('setup_operation_day'),
                        'setup_operation_duration' => $this->request->getVar('setup_operation_duration'),
                        'setup_footer_holding_pict' => ($mastersetupfooterholding != "") ? $newNameSetupFooterHolding : $this->request->getVar('setup_footer_holding_pict_temp'),
                        'setup_footer_company_pict' => ($mastersetupfootercompany != "") ? $newNameSetupFooterCompany : $this->request->getVar('setup_footer_company_pict_temp'),
                        'setup_email' => $this->request->getVar('setup_email'),
                        'setup_customer' => $this->request->getVar('setup_customer'),
                        'setup_phone' => $this->request->getVar('setup_phone'),
                    ];
                    $update = $this->Crud->updateData('tbl_mastersetup', $data, ['setup_id' => $this->request->getVar('setup_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/setup');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/setup/update/'.$this->request->getVar('setup_id'));
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
    /* Setup Page */ 

    /* Social Media Page */ 
    public function socialmedia() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
            echo view('administrator/master/socialmedia/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_socialmedia()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/master/socialmedia/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_socialmedia()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $socialmedialogo =  $this->request->getFile('mastersocialmedia_logo');
                    $newSocialmediaLogo = "bxsea_image_".$socialmedialogo->getRandomName();
                    if ($socialmedialogo != "")
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'mastersocialmedia_logo' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[mastersocialmedia_logo]',
                                    'mime_in[mastersocialmedia_logo,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/master/socialmedia/add');
                        }
                        if ($socialmedialogo->isValid() && ! $socialmedialogo->hasMoved()) 
                        {
                            $socialmedialogo->move(ROOTPATH .'assets/upload/socialmedia', $newSocialmediaLogo, true);
                        }
                    }

                    $data = [
                        'mastersocialmedia_name' => $this->request->getVar('mastersocialmedia_name'),
                        'mastersocialmedia_logo' => $newSocialmediaLogo,
                        'mastersocialmedia_link' => $this->request->getVar('mastersocialmedia_link')
                    ];
                    $insert = $this->Crud->createData('tbl_mastersocialmedia', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/socialmedia');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/socialmedia/add');
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
    public function update_socialmedia($sosmed_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', ['mastersocialmedia_id' => $sosmed_id], '', '', '', '', '');
            echo view('administrator/master/socialmedia/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_socialmedia()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload socialmedia */
                    $mastersocialmedia =  $this->request->getFile('mastersocialmedia_logo');
                    $newNameSocialmediaLogo = "bxsea_image".$mastersocialmedia->getRandomName();
                    if ($mastersocialmedia != "")
                    {
                        // Start process upload logo
                        $validationRule = [
                            'mastersocialmedia_logo' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[mastersocialmedia_logo]',
                                    'mime_in[mastersocialmedia_logo,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/master/socialmedia/update/'.$this->request->getVar('mastersocialmedia_id'));
                        }
                        if ($mastersocialmedia->isValid() && ! $mastersocialmedia->hasMoved()) 
                        {
                            if (is_file('assets/upload/socialmedia/'.$this->request->getVar('mastersocialmedia_logo_temp'))){
                                unlink('assets/upload/socialmedia/'.$this->request->getVar('mastersocialmedia_logo_temp'));
                            }
                            $mastersocialmedia->move(ROOTPATH .'assets/upload/socialmedia', $newNameSocialmediaLogo, true);
                        }
                    }
                    /* End upload socialmedia */

                    $data = [
                        'mastersocialmedia_name' => $this->request->getVar('mastersocialmedia_name'),
                        'mastersocialmedia_logo' => ($mastersocialmedia != "") ? $newNameSocialmediaLogo : $this->request->getVar('mastersocialmedia_logo_temp'),
                        'mastersocialmedia_link' => $this->request->getVar('mastersocialmedia_link')
                    ];
                    $update = $this->Crud->updateData('tbl_mastersocialmedia', $data, ['mastersocialmedia_id' => $this->request->getVar('mastersocialmedia_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/socialmedia');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/socialmedia');
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
    public function delete_socialmedia($mastersocialmedia_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('mastersocialmedia_logo', 'tbl_mastersocialmedia', ['mastersocialmedia_id' => $mastersocialmedia_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/socialmedia/'.$val['mastersocialmedia_logo'])){
                        unlink('assets/upload/socialmedia/'.$val['mastersocialmedia_logo']);
                    }
                }
                $this->Crud->deleteData('tbl_mastersocialmedia', ['mastersocialmedia_id' => $mastersocialmedia_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/master/socialmedia');
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
    /* Social Media Page */ 

    /* Design Asset Page */
    public function designasset()
    {
        if (session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->designAssetModel
                ->orderBy('designasset_group', 'ASC')
                ->orderBy('designasset_sort', 'ASC')
                ->findAll();
            echo view('administrator/master/designasset/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }

    public function add_designasset()
    {
        if (session()->get('islogin') == TRUE)
        {
            $data['assetFiles'] = $this->getDesignAssetFileOptions();
            echo view('administrator/master/designasset/add', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }

    public function run_add_designasset()
    {
        if (session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $data = $this->persistDesignAssetPayload();
                    if (! $this->designAssetModel->insert($data)) {
                        throw new Exception(implode(' ', $this->designAssetModel->errors()));
                    }

                    bxsea_design_asset_records(true);
                    $this->session->setFlashdata('success', '-');
                    return redirect()->route(getenv('bxsea.admin').'/master/designasset');
                }
                catch(Exception $ex)
                {
                    $this->session->setFlashdata('failed', $ex->getMessage());
                    return redirect()->route(getenv('bxsea.admin').'/master/designasset/add');
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }

    public function update_designasset($designasset_id = NULL)
    {
        if (session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->designAssetModel->find($designasset_id);
            $data['assetFiles'] = $this->getDesignAssetFileOptions();
            echo view('administrator/master/designasset/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }

    public function run_update_designasset()
    {
        if (session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $designAssetId = (int) $this->request->getVar('designasset_id');
                    $existing = $this->designAssetModel->find($designAssetId);
                    if (! $existing) {
                        throw new Exception('Design asset data was not found.');
                    }

                    $data = $this->persistDesignAssetPayload($existing);
                    if (! $this->designAssetModel->update($designAssetId, $data)) {
                        throw new Exception(implode(' ', $this->designAssetModel->errors()));
                    }

                    bxsea_design_asset_records(true);
                    $this->session->setFlashdata('success', '-');
                    return redirect()->route(getenv('bxsea.admin').'/master/designasset');
                }
                catch(Exception $ex)
                {
                    $this->session->setFlashdata('failed', $ex->getMessage());
                    return redirect()->route(getenv('bxsea.admin').'/master/designasset');
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }

    public function delete_designasset($designasset_id = NULL)
    {
        if (session()->get('islogin') == TRUE)
        {
            try
            {
                $existing = $this->designAssetModel->find($designasset_id);
                if ($existing && ($existing['designasset_source'] ?? '') === 'upload' && ! empty($existing['designasset_file'])) {
                    $oldFile = ROOTPATH . 'assets/upload/designasset/' . $existing['designasset_file'];
                    if (is_file($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $this->designAssetModel->delete($designasset_id);
                bxsea_design_asset_records(true);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/master/designasset');
            }
            catch(Exception $ex)
            {
                echo 'Message: ' . $ex->getMessage();
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* Design Asset Page */

    /* Article Page */ 
    public function article() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_article', '', '', ['tbl_article_category' => 'tbl_article.article_category = tbl_article_category.articlecat_id'], '', '', '');
            echo view('administrator/master/article/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_article()
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_article_category', '', '', '', '', '', '');
            echo view('administrator/master/article/add', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_article()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $newArticlePict = $this->handleArticleImageUpload(true);

                    $data = [
                        'article_title' => $this->request->getVar('article_title'),
                        'article_title_en' => $this->request->getVar('article_title_en'),
                        'article_desc' => $this->request->getVar('article_desc'),
                        'article_desc_en' => $this->request->getVar('article_desc_en'),
                        'article_pict' => $newArticlePict,
                        'article_author' => $this->request->getVar('article_author'),
                        'article_category' => $this->request->getVar('article_category'),
                        'article_created_date' => date('Y-m-d H:i:s')
                    ];
                    $insert = $this->Crud->createData('tbl_article', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/article');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', 'Gagal menyimpan artikel ke database.');
                        return redirect()->route(getenv('bxsea.admin').'/master/article/add');
                    }
                }
                catch(Exception $ex)
                {
                    $this->session->setFlashdata('failed', $ex->getMessage());
                    return redirect()->route(getenv('bxsea.admin').'/master/article/add')->withInput();
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_article($article_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_article', ['article_id' => $article_id], '', '', '', '', '');
            echo view('administrator/master/article/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_article()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $requiresNewImage = false;
                    $articleImage = $this->request->getFile('article_pict');
                    if ($articleImage && $articleImage->getError() !== UPLOAD_ERR_NO_FILE) {
                        $requiresNewImage = true;
                    }

                    $newArticlePict = $this->handleArticleImageUpload(
                        $requiresNewImage,
                        $this->request->getVar('article_pict_temp')
                    );

                    $data = [
                        'article_title' => $this->request->getVar('article_title'),
                        'article_title_en' => $this->request->getVar('article_title_en'),
                        'article_desc' => $this->request->getVar('article_desc'),
                        'article_desc_en' => $this->request->getVar('article_desc_en'),
                        'article_pict' => $newArticlePict,
                    ];
                    $update = $this->Crud->updateData('tbl_article', $data, ['article_id' => $this->request->getVar('article_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/master/article');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', 'Gagal memperbarui artikel di database.');
                        return redirect()->route(getenv('bxsea.admin').'/master/article');
                    }
                }
                catch(Exception $ex)
                {
                    $this->session->setFlashdata('failed', $ex->getMessage());
                    return redirect()->route(getenv('bxsea.admin').'/master/article/update/'.$this->request->getVar('article_id'))->withInput();
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_article($article_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('article_pict', 'tbl_article', ['article_id' => $article_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/article/'.$val['article_pict'])){
                        unlink('assets/upload/article/'.$val['article_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_article', ['article_id' => $article_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/master/article');
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
    /* Article Page */
}

?>