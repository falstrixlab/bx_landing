<?php

namespace App\Controllers;
use Exception;
use CodeIgniter\Controller;
use App\Models\Crud;

class AdminTicketing extends BaseController {
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

    /* Master Ticket Page */ 
    public function masterticket() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticket', '', '', ['tbl_ticket_category' => 'tbl_ticket.ticket_category = tbl_ticket_category.ticketcat_id'], '', '', '');
            echo view('administrator/ticketing/dataticket/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_masterticket()
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticket_category', '', '', '', '', '', '');
            echo view('administrator/ticketing/dataticket/add', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_masterticket()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $ticketpict =  $this->request->getFile('ticket_pict');
                    $newticketpict = '';
                    $hasTicketPict = $this->hasUploadedFile($ticketpict);
                    if ($hasTicketPict)
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'ticket_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[ticket_pict]',
                                    'mime_in[ticket_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/ticketing/masterticket/add');
                        }
                        $newticketpict = 'bxsea_image_' . $ticketpict->getRandomName();
                        $ticketpict->move(ROOTPATH .'assets/upload/ticket', $newticketpict, true);
                    }

                    $data = [
                        'ticket_title' => $this->request->getVar('ticket_title'),
                        'ticket_title_en' => $this->request->getVar('ticket_title_en'),
                        'ticket_subtitle' => $this->request->getVar('ticket_subtitle'),
                        'ticket_schedule' => $this->request->getVar('ticket_schedule'),
                        'ticket_schedule_en' => $this->request->getVar('ticket_schedule_en'),
                        'ticket_total_journey' => $this->request->getVar('ticket_total_journey'),
                        'ticket_link' => $this->request->getVar('ticket_link'),
                        'ticket_pict' => $newticketpict,
                        'ticket_price' => $this->request->getVar('ticket_price'),
                        'ticket_category' => $this->request->getVar('ticket_category'),
                        'ticket_status' => $this->request->getVar('ticket_status')
                    ];
                    $insert = $this->Crud->createData('tbl_ticket', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/masterticket');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/masterticket/add');
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
    public function update_masterticket($ticket_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticket', ['ticket_id' => $ticket_id], '', '', '', '', '');
            echo view('administrator/ticketing/dataticket/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_masterticket()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload ticket */
                    $ticketpict =  $this->request->getFile('ticket_pict');
                    $newticketpict = $this->request->getVar('ticket_pict_temp');
                    $hasTicketPict = $this->hasUploadedFile($ticketpict);
                    if ($hasTicketPict)
                    {
                        // Start process upload logo
                        $validationRule = [
                            'ticket_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[ticket_pict]',
                                    'mime_in[ticket_pict,image/jpg,image/jpeg,image/png,video/mp4]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/ticketing/masterticket/update/'.$this->request->getVar('ticket_id'));
                        }
                        $newticketpict = 'bxsea_image_' . $ticketpict->getRandomName();
                        if (is_file('assets/upload/ticket/'.$this->request->getVar('ticket_pict_temp'))){
                            unlink('assets/upload/ticket/'.$this->request->getVar('ticket_pict_temp'));
                        }
                        $ticketpict->move(ROOTPATH .'assets/upload/ticket', $newticketpict, true);
                    }
                    /* End upload testimoni */

                    $data = [
                        'ticket_title' => $this->request->getVar('ticket_title'),
                        'ticket_title_en' => $this->request->getVar('ticket_title_en'),
                        'ticket_subtitle' => $this->request->getVar('ticket_subtitle'),
                        'ticket_schedule' => $this->request->getVar('ticket_schedule'),
                        'ticket_schedule_en' => $this->request->getVar('ticket_schedule_en'),
                        'ticket_total_journey' => $this->request->getVar('ticket_total_journey'),
                        'ticket_link' => $this->request->getVar('ticket_link'),
                        'ticket_pict' => $newticketpict,
                        'ticket_price' => $this->request->getVar('ticket_price'),
                        'ticket_status' => $this->request->getVar('ticket_status')
                    ];
                    $update = $this->Crud->updateData('tbl_ticket', $data, ['ticket_id' => $this->request->getVar('ticket_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/masterticket');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/masterticket');
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
    public function delete_masterticket($ticket_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('ticket_pict', 'tbl_ticket', ['ticket_id' => $ticket_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/ticket/'.$val['ticket_pict'])){
                        unlink('assets/upload/ticket/'.$val['ticket_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_ticket', ['ticket_id' => $ticket_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/masterticket');
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
    /* Master Ticket Page */ 

    /* Experience Page */ 
    public function experience() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticketexperience', '', '', '', '', '', '');
            echo view('administrator/ticketing/experience/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_experience()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/ticketing/experience/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_experience()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $experiencepict = $this->request->getFile('experience_pict');
                    $newexperiencepict = '';
                    if ($experiencepict && $experiencepict->isValid() && !$experiencepict->hasMoved()) {
                        $newexperiencepict = 'bxsea_image_' . $experiencepict->getRandomName();
                        $experiencepict->move(ROOTPATH . 'assets/upload/experience', $newexperiencepict, true);
                    }

                    $data = [
                        'experience_title' => $this->request->getVar('experience_title'),
                        'experience_title_en' => $this->request->getVar('experience_title_en'),
                        'experience_desc' => $this->request->getVar('experience_desc'),
                        'experience_desc_en' => $this->request->getVar('experience_desc_en'),
                        'experience_pict' => $newexperiencepict,
                    ];
                    $insert = $this->Crud->createData('tbl_ticketexperience', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/experience');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/experience/add');
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
    public function update_experience($experience_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticketexperience', ['experience_id' => $experience_id], '', '', '', '', '');
            echo view('administrator/ticketing/experience/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_experience()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $experiencepict = $this->request->getFile('experience_pict');
                    $newexperiencepict = $this->request->getVar('experience_pict_temp');
                    if ($experiencepict && $experiencepict->isValid() && !$experiencepict->hasMoved()) {
                        $newexperiencepict = 'bxsea_image_' . $experiencepict->getRandomName();
                        if (!empty($this->request->getVar('experience_pict_temp')) && is_file(ROOTPATH . 'assets/upload/experience/' . $this->request->getVar('experience_pict_temp'))) {
                            unlink(ROOTPATH . 'assets/upload/experience/' . $this->request->getVar('experience_pict_temp'));
                        }
                        $experiencepict->move(ROOTPATH . 'assets/upload/experience', $newexperiencepict, true);
                    }

                    $data = [
                        'experience_title' => $this->request->getVar('experience_title'),
                        'experience_title_en' => $this->request->getVar('experience_title_en'),
                        'experience_desc' => $this->request->getVar('experience_desc'),
                        'experience_desc_en' => $this->request->getVar('experience_desc_en'),
                        'experience_pict' => $newexperiencepict,
                    ];
                    $update = $this->Crud->updateData('tbl_ticketexperience', $data, ['experience_id' => $this->request->getVar('experience_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/experience');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/experience');
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
    public function delete_experience($experience_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $this->Crud->deleteData('tbl_ticketexperience', ['experience_id' => $experience_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/experience');
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
    /* Experience Page */ 

    /* Moment Page */ 
    public function moment() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticketmoment', '', '', '', '', '', '');
            echo view('administrator/ticketing/moment/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_moment()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/ticketing/moment/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_moment()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $momentpict =  $this->request->getFile('moment_pict');
                    $newmomentpict = '';
                    $hasMomentPict = $this->hasUploadedFile($momentpict);
                    if ($hasMomentPict)
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'moment_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[moment_pict]',
                                    'mime_in[moment_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/ticketing/moment/add');
                        }
                        $newmomentpict = 'bxsea_image_' . $momentpict->getRandomName();
                        $momentpict->move(ROOTPATH .'assets/upload/moment', $newmomentpict, true);
                    }

                    $data = [
                        'moment_title' => $this->request->getVar('moment_title'),
                        'moment_title_en' => $this->request->getVar('moment_title_en'),
                        'moment_desc' => $this->request->getVar('moment_desc'),
                        'moment_desc_en' => $this->request->getVar('moment_desc_en'),
                        'moment_pict' => $newmomentpict,
                    ];
                    $insert = $this->Crud->createData('tbl_ticketmoment', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/moment');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/moment/add');
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
    public function update_moment($moment_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticketmoment', ['moment_id' => $moment_id], '', '', '', '', '');
            echo view('administrator/ticketing/moment/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_moment()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload ticket */
                    $momentpict =  $this->request->getFile('moment_pict');
                    $newmomentpict = $this->request->getVar('moment_pict_temp');
                    $hasMomentPict = $this->hasUploadedFile($momentpict);
                    if ($hasMomentPict)
                    {
                        // Start process upload logo
                        $validationRule = [
                            'moment_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[moment_pict]',
                                    'mime_in[moment_pict,image/jpg,image/jpeg,image/png,video/mp4]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/ticketing/moment/update/'.$this->request->getVar('moment_id'));
                        }
                        $newmomentpict = 'bxsea_image_' . $momentpict->getRandomName();
                        if (is_file('assets/upload/moment/'.$this->request->getVar('moment_pict_temp'))){
                            unlink('assets/upload/moment/'.$this->request->getVar('moment_pict_temp'));
                        }
                        $momentpict->move(ROOTPATH .'assets/upload/moment', $newmomentpict, true);
                    }
                    /* End upload testimoni */

                    $data = [
                        'moment_title' => $this->request->getVar('moment_title'),
                        'moment_title_en' => $this->request->getVar('moment_title_en'),
                        'moment_desc' => $this->request->getVar('moment_desc'),
                        'moment_desc_en' => $this->request->getVar('moment_desc_en'),
                        'moment_pict' => $newmomentpict,
                    ];
                    $update = $this->Crud->updateData('tbl_ticketmoment', $data, ['moment_id' => $this->request->getVar('moment_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/moment');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/moment');
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
    public function delete_moment($moment_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('moment_pict', 'tbl_ticketmoment', ['moment_id' => $moment_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/moment/'.$val['moment_pict'])){
                        unlink('assets/upload/moment/'.$val['moment_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_ticketmoment', ['moment_id' => $moment_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/moment');
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
    /* Moment Page */ 

    /* Promotion Page */ 
    public function promotion() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticketpromotion', '', '', '', '', '', '');
            echo view('administrator/ticketing/promotion/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_promotion()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/ticketing/promotion/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_promotion()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $promotionpict =  $this->request->getFile('promotion_pict');
                    $newpromotionpict = '';
                    $hasPromotionPict = $this->hasUploadedFile($promotionpict);
                    if ($hasPromotionPict)
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'promotion_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[promotion_pict]',
                                    'mime_in[promotion_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/ticketing/promotion/add');
                        }
                        $newpromotionpict = 'bxsea_image_' . $promotionpict->getRandomName();
                        $promotionpict->move(ROOTPATH .'assets/upload/promotion', $newpromotionpict, true);
                    }

                    $data = [
                        'promotion_title' => $this->request->getVar('promotion_title'),
                        'promoton_title_en' => $this->request->getVar('promoton_title_en'),
                        'promotion_pict' => $newpromotionpict,
                        'promotion_desc' => $this->request->getVar('promotion_desc'),
                        'promotion_desc_en' => $this->request->getVar('promotion_desc_en'),
                        'promotion_link' => $this->request->getVar('promotion_link'),
                    ];
                    $insert = $this->Crud->createData('tbl_ticketpromotion', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/promotion');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/promotion/add');
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
    public function update_promotion($promotion_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticketpromotion', ['promotion_id' => $promotion_id], '', '', '', '', '');
            echo view('administrator/ticketing/promotion/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_promotion()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload ticket */
                    $promotionpict =  $this->request->getFile('promotion_pict');
                    $newpromotionpict = $this->request->getVar('promotion_pict_temp');
                    $hasPromotionPict = $this->hasUploadedFile($promotionpict);
                    if ($hasPromotionPict)
                    {
                        // Start process upload logo
                        $validationRule = [
                            'promotion_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[promotion_pict]',
                                    'mime_in[promotion_pict,image/jpg,image/jpeg,image/png,video/mp4]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/ticketing/promotion/update/'.$this->request->getVar('promotion_id'));
                        }
                        $newpromotionpict = 'bxsea_image_' . $promotionpict->getRandomName();
                        if (is_file('assets/upload/promotion/'.$this->request->getVar('promotion_pict_temp'))){
                            unlink('assets/upload/promotion/'.$this->request->getVar('promotion_pict_temp'));
                        }
                        $promotionpict->move(ROOTPATH .'assets/upload/promotion', $newpromotionpict, true);
                    }
                    /* End upload testimoni */

                    $data = [
                        'promotion_title' => $this->request->getVar('promotion_title'),
                        'promoton_title_en' => $this->request->getVar('promoton_title_en'),
                        'promotion_pict' => $newpromotionpict,
                        'promotion_desc' => $this->request->getVar('promotion_desc'),
                        'promotion_desc_en' => $this->request->getVar('promotion_desc_en'),
                        'promotion_link' => $this->request->getVar('promotion_link'),
                    ];
                    $update = $this->Crud->updateData('tbl_ticketpromotion', $data, ['promotion_id' => $this->request->getVar('promotion_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/promotion');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/promotion');
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
    public function delete_promotion($promotion_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('promotion_pict', 'tbl_ticketpromotion', ['promotion_id' => $promotion_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/promotion/'.$val['promotion_pict'])){
                        unlink('assets/upload/promotion/'.$val['promotion_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_ticketpromotion', ['promotion_id' => $promotion_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/promotion');
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
    /* Promotion Page */ 

    /* Promosi Tiket Page */
    public function promosi()
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticketpromosi', '', '', '', '', '', '');
            echo view('administrator/ticketing/promosi/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_promosi()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/ticketing/promosi/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_promosi()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $promosipict = $this->request->getFile('promosi_pict');
                    $newpromosipict = '';
                    $hasPromosiPict = $this->hasUploadedFile($promosipict);
                    if ($hasPromosiPict)
                    {
                        $validationRule = [
                            'promosi_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[promosi_pict]',
                                    'mime_in[promosi_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule))
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/ticketing/promosi/add');
                        }
                        $newpromosipict = 'bxsea_image_' . $promosipict->getRandomName();
                        $promosipict->move(ROOTPATH . 'assets/upload/promosi', $newpromosipict, true);
                    }
                    $data = [
                        'promosi_title'    => $this->request->getVar('promosi_title'),
                        'promosi_title_en' => $this->request->getVar('promosi_title_en'),
                        'promosi_pict'     => $newpromosipict,
                        'promosi_desc'     => $this->request->getVar('promosi_desc'),
                        'promosi_desc_en'  => $this->request->getVar('promosi_desc_en'),
                        'promosi_link'     => $this->request->getVar('promosi_link'),
                        'promosi_tnc'      => $this->request->getVar('promosi_tnc'),
                        'promosi_tnc_en'   => $this->request->getVar('promosi_tnc_en'),
                    ];
                    $insert = $this->Crud->createData('tbl_ticketpromosi', $data);
                    if ($insert)
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/promosi');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/promosi/add');
                    }
                }
                catch(Exception $ex)
                {
                    echo 'Message: ' . $ex->getMessage();
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_promosi($promosi_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticketpromosi', ['promosi_id' => $promosi_id], '', '', '', '', '');
            echo view('administrator/ticketing/promosi/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_promosi()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $promosipict = $this->request->getFile('promosi_pict');
                    $newpromosipict = $this->request->getVar('promosi_pict_temp');
                    $hasPromosiPict = $this->hasUploadedFile($promosipict);
                    if ($hasPromosiPict)
                    {
                        $validationRule = [
                            'promosi_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[promosi_pict]',
                                    'mime_in[promosi_pict,image/jpg,image/jpeg,image/png]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule))
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/ticketing/promosi/update/'.$this->request->getVar('promosi_id'));
                        }
                        $newpromosipict = 'bxsea_image_' . $promosipict->getRandomName();
                        if (is_file('assets/upload/promosi/' . $this->request->getVar('promosi_pict_temp')))
                        {
                            unlink('assets/upload/promosi/' . $this->request->getVar('promosi_pict_temp'));
                        }
                        $promosipict->move(ROOTPATH . 'assets/upload/promosi', $newpromosipict, true);
                    }
                    $data = [
                        'promosi_title'    => $this->request->getVar('promosi_title'),
                        'promosi_title_en' => $this->request->getVar('promosi_title_en'),
                        'promosi_pict'     => $newpromosipict,
                        'promosi_desc'     => $this->request->getVar('promosi_desc'),
                        'promosi_desc_en'  => $this->request->getVar('promosi_desc_en'),
                        'promosi_link'     => $this->request->getVar('promosi_link'),
                        'promosi_tnc'      => $this->request->getVar('promosi_tnc'),
                        'promosi_tnc_en'   => $this->request->getVar('promosi_tnc_en'),
                    ];
                    $update = $this->Crud->updateData('tbl_ticketpromosi', $data, ['promosi_id' => $this->request->getVar('promosi_id')]);
                    if ($update)
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/promosi');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/promosi');
                    }
                }
                catch(Exception $ex)
                {
                    echo 'Message: ' . $ex->getMessage();
                }
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_promosi($promosi_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('promosi_pict', 'tbl_ticketpromosi', ['promosi_id' => $promosi_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/promosi/' . $val['promosi_pict']))
                    {
                        unlink('assets/upload/promosi/' . $val['promosi_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_ticketpromosi', ['promosi_id' => $promosi_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/promosi');
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
    /* Promosi Tiket Page */

    /* School Program Page */ 
    public function schoolprogram() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticketschoolprogram', '', '', '', '', '', '');
            echo view('administrator/ticketing/schoolprogram/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_schoolprogram()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/ticketing/schoolprogram/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_schoolprogram()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $schoolprogrampict =  $this->request->getFile('schoolprogram_pict');
                    $newschoolprogrampict = '';
                    $hasSchoolProgramPict = $this->hasUploadedFile($schoolprogrampict);
                    if ($hasSchoolProgramPict)
                    {
                        // Start process upload Service Process Image
                        $validationRule = [
                            'schoolprogram_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[schoolprogram_pict]',
                                    'mime_in[schoolprogram_pict,image/jpg,image/jpeg,image/png]'
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolprogram/add');
                        }
                        $newschoolprogrampict = 'bxsea_image_' . $schoolprogrampict->getRandomName();
                        $schoolprogrampict->move(ROOTPATH .'assets/upload/schoolprogram', $newschoolprogrampict, true);
                    }

                    $data = [
                        'schoolprogram_title' => $this->request->getVar('schoolprogram_title'),
                        'schoolprogram_title_en' => $this->request->getVar('schoolprogram_title_en'),
                        'schoolprogram_desc' => $this->request->getVar('schoolprogram_desc'),
                        'schoolprogram_desc_en' => $this->request->getVar('schoolprogram_desc_en'),
                        'schoolprogram_pict' => $newschoolprogrampict,
                        'schoolprogram_link' => $this->request->getVar('schoolprogram_link'),
                    ];
                    $insert = $this->Crud->createData('tbl_ticketschoolprogram', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolprogram');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolprogram/add');
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
    public function update_schoolprogram($schoolprogram_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_ticketschoolprogram', ['schoolprogram_id' => $schoolprogram_id], '', '', '', '', '');
            echo view('administrator/ticketing/schoolprogram/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_schoolprogram()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    /* Start upload ticket */
                    $schoolprogrampict =  $this->request->getFile('schoolprogram_pict');
                    $newschoolprogrampict = $this->request->getVar('schoolprogram_pict_temp');
                    $hasSchoolProgramPict = $this->hasUploadedFile($schoolprogrampict);
                    if ($hasSchoolProgramPict)
                    {
                        // Start process upload logo
                        $validationRule = [
                            'schoolprogram_pict' => [
                                'label' => 'Image File',
                                'rules' => [
                                    'uploaded[schoolprogram_pict]',
                                    'mime_in[schoolprogram_pict,image/jpg,image/jpeg,image/png,video/mp4]',
                                ],
                            ],
                        ];
                        if (! $this->validate($validationRule)) 
                        {
                            $this->session->setFlashdata('invalidate', '-');
                            return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolprogram/update/'.$this->request->getVar('schoolprogram_id'));
                        }
                        $newschoolprogrampict = 'bxsea_image_' . $schoolprogrampict->getRandomName();
                        if (is_file('assets/upload/schoolprogram/'.$this->request->getVar('schoolprogram_pict_temp'))){
                            unlink('assets/upload/schoolprogram/'.$this->request->getVar('schoolprogram_pict_temp'));
                        }
                        $schoolprogrampict->move(ROOTPATH .'assets/upload/schoolprogram', $newschoolprogrampict, true);
                    }
                    /* End upload testimoni */

                    $data = [
                        'schoolprogram_title' => $this->request->getVar('schoolprogram_title'),
                        'schoolprogram_title_en' => $this->request->getVar('schoolprogram_title_en'),
                        'schoolprogram_desc' => $this->request->getVar('schoolprogram_desc'),
                        'schoolprogram_desc_en' => $this->request->getVar('schoolprogram_desc_en'),
                        'schoolprogram_pict' => $newschoolprogrampict,
                        'schoolprogram_link' => $this->request->getVar('schoolprogram_link'),
                    ];
                    $update = $this->Crud->updateData('tbl_ticketschoolprogram', $data, ['schoolprogram_id' => $this->request->getVar('schoolprogram_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolprogram');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolprogram');
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
    public function delete_schoolprogram($schoolprogram_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $getimage = $this->Crud->readData('schoolprogram_pict', 'tbl_ticketschoolprogram', ['schoolprogram_id' => $schoolprogram_id], '', '', '', '', '');
                foreach($getimage AS $val)
                {
                    if (is_file('assets/upload/schoolprogram/'.$val['schoolprogram_pict'])){
                        unlink('assets/upload/schoolprogram/'.$val['schoolprogram_pict']);
                    }
                }
                $this->Crud->deleteData('tbl_ticketschoolprogram', ['schoolprogram_id' => $schoolprogram_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolprogram');
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
    /* School Program Page */ 

    /* Description Page */ 
    public function description() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_menu' => 'ticket'], '', '', '', '', '');
            echo view('administrator/ticketing/description/index', $data);
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
            echo view('administrator/ticketing/description/add');
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
                        'masterdesc_menu' => 'ticket',
                    ];
                    $insert = $this->Crud->createData('tbl_masterdesc', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/description');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/description/add');
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
            echo view('administrator/ticketing/description/update', $data);
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
                        'masterdesc_menu' => 'ticket',
                    ];
                    $update = $this->Crud->updateData('tbl_masterdesc', $data, ['masterdesc_id' => $this->request->getVar('masterdesc_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/description');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/description');
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
                return redirect()->route(getenv('bxsea.admin').'/ticketing/description');
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

    /* School Visit Program */ 
    public function schoolvisit() {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdesc'] = $this->Crud->readData('*', 'tbl_schoolvisit', '', '', '', '', '', '');
            echo view('administrator/ticketing/schoolvisit/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_schoolvisit()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/ticketing/schoolvisit/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_schoolvisit()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar("submit");
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'schoolvisit_desc' => $this->request->getVar('schoolvisit_desc'),
                        'schoolvisit_desc_en' => $this->request->getVar('schoolvisit_desc_en'),
                        'schoolvisit_basic' => $this->request->getVar('schoolvisit_basic'),
                        'schoolvisit_premium' => $this->request->getVar('schoolvisit_premium'),
                        'schoolvisit_special' => $this->request->getVar('schoolvisit_special'),
                    ];
                    $insert = $this->Crud->createData('tbl_schoolvisit', $data);
                    if ($insert) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolvisit');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolvisit/add');
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
    public function update_schoolvisit($schoolvisit_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_schoolvisit', ['schoolvisit_id' => $schoolvisit_id], '', '', '', '', '');
            echo view('administrator/ticketing/schoolvisit/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_schoolvisit()
    {
        if(session()->get('islogin') == TRUE)
        {
            $submit = $this->request->getVar('submit');
            if (isset($submit))
            {
                try
                {
                    $data = [
                        'schoolvisit_desc' => $this->request->getVar('schoolvisit_desc'),
                        'schoolvisit_desc_en' => $this->request->getVar('schoolvisit_desc_en'),
                        'schoolvisit_basic' => $this->request->getVar('schoolvisit_basic'),
                        'schoolvisit_premium' => $this->request->getVar('schoolvisit_premium'),
                        'schoolvisit_special' => $this->request->getVar('schoolvisit_special'),
                    ];
                    $update = $this->Crud->updateData('tbl_schoolvisit', $data, ['schoolvisit_id' => $this->request->getVar('schoolvisit_id')]);
                    if ($update) 
                    {
                        $this->session->setFlashdata('success', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolvisit');
                    }
                    else
                    {
                        $this->session->setFlashdata('failed', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolvisit');
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
    public function delete_schoolvisit($schoolvisit_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $this->Crud->deleteData('tbl_schoolvisit', ['schoolvisit_id' => $schoolvisit_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolvisit');
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
    /* School Visit Program */ 

    /* Additional Experience Header */
    public function additionalexp()
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_additional_experience', '', '', '', '', '', '');
            echo view('administrator/ticketing/additionalexp/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_additionalexp($additional_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_additional_experience', ['additional_id' => $additional_id], '', '', '', '', '');
            echo view('administrator/ticketing/additionalexp/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_additionalexp()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $data = [
                    'additional_title_id' => $this->request->getPost('additional_title_id'),
                    'additional_title_en' => $this->request->getPost('additional_title_en'),
                    'additional_desc_id' => $this->request->getPost('additional_desc_id'),
                    'additional_desc_en' => $this->request->getPost('additional_desc_en'),
                    'additional_notes_id' => $this->request->getPost('additional_notes_id'),
                    'additional_notes_en' => $this->request->getPost('additional_notes_en')
                ];
                
                $this->Crud->createData('tbl_additional_experience', $data);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/additionalexp');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/additionalexp');
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_additionalexp()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $additional_id = $this->request->getPost('additional_id');
                $data = [
                    'additional_title_id' => $this->request->getPost('additional_title_id'),
                    'additional_title_en' => $this->request->getPost('additional_title_en'),
                    'additional_desc_id' => $this->request->getPost('additional_desc_id'),
                    'additional_desc_en' => $this->request->getPost('additional_desc_en'),
                    'additional_notes_id' => $this->request->getPost('additional_notes_id'),
                    'additional_notes_en' => $this->request->getPost('additional_notes_en')
                ];
                
                $this->Crud->updateData('tbl_additional_experience', $data, ['additional_id' => $additional_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/additionalexp');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/additionalexp/update/'.$additional_id);
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* Additional Experience Header */

    /* Additional Experience Item */
    public function additionalexpitem()
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_additional_experience_item', '', '', '', '', '', '');
            echo view('administrator/ticketing/additionalexpitem/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_additionalexpitem()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/ticketing/additionalexpitem/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_additionalexpitem()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $data = [
                    'item_title_id' => $this->request->getPost('item_title_id'),
                    'item_title_en' => $this->request->getPost('item_title_en'),
                    'item_desc_id' => $this->request->getPost('item_desc_id'),
                    'item_desc_en' => $this->request->getPost('item_desc_en'),
                    'item_duration_id' => $this->request->getPost('item_duration_id'),
                    'item_duration_en' => $this->request->getPost('item_duration_en'),
                    'item_schedule_id' => $this->request->getPost('item_schedule_id'),
                    'item_schedule_en' => $this->request->getPost('item_schedule_en'),
                    'item_location_id' => $this->request->getPost('item_location_id'),
                    'item_location_en' => $this->request->getPost('item_location_en'),
                    'item_button_id' => $this->request->getPost('item_button_id'),
                    'item_button_en' => $this->request->getPost('item_button_en'),
                    'item_status' => $this->request->getPost('item_status')
                ];

                // Upload main image
                $file = $this->request->getFile('item_image');
                if ($this->hasUploadedFile($file))
                {
                    $newname = 'bxsea_image_' . time() . '.' . $file->getExtension();
                    if($file->move('./assets/upload/additional_exp_item/', $newname))
                    {
                        $data['item_image'] = $newname;
                    }
                    else
                    {
                        $this->session->setFlashdata('failedmovefile', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/additionalexpitem/add');
                    }
                }

                // Upload duration icon
                $durationIcon = $this->request->getFile('item_duration_icon');
                if ($this->hasUploadedFile($durationIcon))
                {
                    $iconName = 'bxsea_icon_duration_' . time() . '.' . $durationIcon->getExtension();
                    if($durationIcon->move('./assets/upload/additional_exp_item/', $iconName))
                    {
                        $data['item_duration_icon'] = $iconName;
                    }
                }

                // Upload schedule icon
                $scheduleIcon = $this->request->getFile('item_schedule_icon');
                if ($this->hasUploadedFile($scheduleIcon))
                {
                    $iconName = 'bxsea_icon_schedule_' . time() . '.' . $scheduleIcon->getExtension();
                    if($scheduleIcon->move('./assets/upload/additional_exp_item/', $iconName))
                    {
                        $data['item_schedule_icon'] = $iconName;
                    }
                }

                // Upload location icon
                $locationIcon = $this->request->getFile('item_location_icon');
                if ($this->hasUploadedFile($locationIcon))
                {
                    $iconName = 'bxsea_icon_location_' . time() . '.' . $locationIcon->getExtension();
                    if($locationIcon->move('./assets/upload/additional_exp_item/', $iconName))
                    {
                        $data['item_location_icon'] = $iconName;
                    }
                }
                
                $this->Crud->createData('tbl_additional_experience_item', $data);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/additionalexpitem');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/additionalexpitem/add');
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_additionalexpitem($item_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_additional_experience_item', ['item_id' => $item_id], '', '', '', '', '');
            echo view('administrator/ticketing/additionalexpitem/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_additionalexpitem()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $item_id = $this->request->getPost('item_id');
                $data = [
                    'item_title_id' => $this->request->getPost('item_title_id'),
                    'item_title_en' => $this->request->getPost('item_title_en'),
                    'item_desc_id' => $this->request->getPost('item_desc_id'),
                    'item_desc_en' => $this->request->getPost('item_desc_en'),
                    'item_duration_id' => $this->request->getPost('item_duration_id'),
                    'item_duration_en' => $this->request->getPost('item_duration_en'),
                    'item_schedule_id' => $this->request->getPost('item_schedule_id'),
                    'item_schedule_en' => $this->request->getPost('item_schedule_en'),
                    'item_location_id' => $this->request->getPost('item_location_id'),
                    'item_location_en' => $this->request->getPost('item_location_en'),
                    'item_button_id' => $this->request->getPost('item_button_id'),
                    'item_button_en' => $this->request->getPost('item_button_en'),
                    'item_status' => $this->request->getPost('item_status')
                ];

                // Upload main image
                $file = $this->request->getFile('item_image');
                if ($this->hasUploadedFile($file))
                {
                    $newname = 'bxsea_image_' . time() . '.' . $file->getExtension();
                    if($file->move('./assets/upload/additional_exp_item/', $newname))
                    {
                        $data['item_image'] = $newname;
                        $oldpicture = $this->request->getPost('oldpicture');
                        if (!empty($oldpicture) && file_exists('./assets/upload/additional_exp_item/'.$oldpicture))
                        {
                            unlink('./assets/upload/additional_exp_item/'.$oldpicture);
                        }
                    }
                }

                // Upload duration icon
                $durationIcon = $this->request->getFile('item_duration_icon');
                if ($this->hasUploadedFile($durationIcon))
                {
                    $iconName = 'bxsea_icon_duration_' . time() . '.' . $durationIcon->getExtension();
                    if($durationIcon->move('./assets/upload/additional_exp_item/', $iconName))
                    {
                        $data['item_duration_icon'] = $iconName;
                        $oldIcon = $this->request->getPost('old_duration_icon');
                        if (!empty($oldIcon) && file_exists('./assets/upload/additional_exp_item/'.$oldIcon))
                        {
                            unlink('./assets/upload/additional_exp_item/'.$oldIcon);
                        }
                    }
                }

                // Upload schedule icon
                $scheduleIcon = $this->request->getFile('item_schedule_icon');
                if ($this->hasUploadedFile($scheduleIcon))
                {
                    $iconName = 'bxsea_icon_schedule_' . time() . '.' . $scheduleIcon->getExtension();
                    if($scheduleIcon->move('./assets/upload/additional_exp_item/', $iconName))
                    {
                        $data['item_schedule_icon'] = $iconName;
                        $oldIcon = $this->request->getPost('old_schedule_icon');
                        if (!empty($oldIcon) && file_exists('./assets/upload/additional_exp_item/'.$oldIcon))
                        {
                            unlink('./assets/upload/additional_exp_item/'.$oldIcon);
                        }
                    }
                }

                // Upload location icon
                $locationIcon = $this->request->getFile('item_location_icon');
                if ($this->hasUploadedFile($locationIcon))
                {
                    $iconName = 'bxsea_icon_location_' . time() . '.' . $locationIcon->getExtension();
                    if($locationIcon->move('./assets/upload/additional_exp_item/', $iconName))
                    {
                        $data['item_location_icon'] = $iconName;
                        $oldIcon = $this->request->getPost('old_location_icon');
                        if (!empty($oldIcon) && file_exists('./assets/upload/additional_exp_item/'.$oldIcon))
                        {
                            unlink('./assets/upload/additional_exp_item/'.$oldIcon);
                        }
                    }
                }
                
                $this->Crud->updateData('tbl_additional_experience_item', $data, ['item_id' => $item_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/additionalexpitem');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/additionalexpitem/update/'.$item_id);
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_additionalexpitem($item_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $data = $this->Crud->readData('*', 'tbl_additional_experience_item', ['item_id' => $item_id], '', '', '', '', '');
                
                // Delete main image
                if (!empty($data[0]['item_image']) && file_exists('./assets/upload/additional_exp_item/'.$data[0]['item_image']))
                {
                    unlink('./assets/upload/additional_exp_item/'.$data[0]['item_image']);
                }
                
                // Delete duration icon
                if (!empty($data[0]['item_duration_icon']) && file_exists('./assets/upload/additional_exp_item/'.$data[0]['item_duration_icon']))
                {
                    unlink('./assets/upload/additional_exp_item/'.$data[0]['item_duration_icon']);
                }
                
                // Delete schedule icon
                if (!empty($data[0]['item_schedule_icon']) && file_exists('./assets/upload/additional_exp_item/'.$data[0]['item_schedule_icon']))
                {
                    unlink('./assets/upload/additional_exp_item/'.$data[0]['item_schedule_icon']);
                }
                
                // Delete location icon
                if (!empty($data[0]['item_location_icon']) && file_exists('./assets/upload/additional_exp_item/'.$data[0]['item_location_icon']))
                {
                    unlink('./assets/upload/additional_exp_item/'.$data[0]['item_location_icon']);
                }
                
                $this->Crud->deleteData('tbl_additional_experience_item', ['item_id' => $item_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/additionalexpitem');
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
    /* Additional Experience Item */

    /* School Why BXSEA */
    public function schoolwhybxsea()
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_school_why_bxsea', '', '', '', '', '', '');
            echo view('administrator/ticketing/schoolwhybxsea/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_schoolwhybxsea($why_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_school_why_bxsea', ['why_id' => $why_id], '', '', '', '', '');
            echo view('administrator/ticketing/schoolwhybxsea/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_schoolwhybxsea()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $data = [
                    'why_title_id' => $this->request->getPost('why_title_id'),
                    'why_title_en' => $this->request->getPost('why_title_en'),
                    'why_content_id' => $this->request->getPost('why_content_id'),
                    'why_content_en' => $this->request->getPost('why_content_en')
                ];
                
                $this->Crud->createData('tbl_school_why_bxsea', $data);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolwhybxsea');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolwhybxsea');
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_schoolwhybxsea()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $why_id = $this->request->getPost('why_id');
                $data = [
                    'why_title_id' => $this->request->getPost('why_title_id'),
                    'why_title_en' => $this->request->getPost('why_title_en'),
                    'why_content_id' => $this->request->getPost('why_content_id'),
                    'why_content_en' => $this->request->getPost('why_content_en')
                ];
                
                $this->Crud->updateData('tbl_school_why_bxsea', $data, ['why_id' => $why_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolwhybxsea');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolwhybxsea/update/'.$why_id);
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    /* School Why BXSEA */

    /* School What Included */
    public function schoolincluded()
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_school_what_included', '', '', '', '', '', '');
            echo view('administrator/ticketing/schoolincluded/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_schoolincluded()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/ticketing/schoolincluded/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_schoolincluded()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $data = [
                    'included_title_id' => $this->request->getPost('included_title_id'),
                    'included_title_en' => $this->request->getPost('included_title_en'),
                    'included_desc_id' => $this->request->getPost('included_desc_id'),
                    'included_desc_en' => $this->request->getPost('included_desc_en'),
                    'included_status' => $this->request->getPost('included_status')
                ];

                $file = $this->request->getFile('included_image');
                if ($this->hasUploadedFile($file))
                {
                    $newname = 'bxsea_image_' . time() . '.' . $file->getExtension();
                    if($file->move('./assets/upload/school_included/', $newname))
                    {
                        $data['included_image'] = $newname;
                    }
                    else
                    {
                        $this->session->setFlashdata('failedmovefile', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolincluded/add');
                    }
                }
                
                $this->Crud->createData('tbl_school_what_included', $data);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolincluded');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolincluded/add');
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_schoolincluded($included_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_school_what_included', ['included_id' => $included_id], '', '', '', '', '');
            echo view('administrator/ticketing/schoolincluded/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_schoolincluded()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $included_id = $this->request->getPost('included_id');
                $data = [
                    'included_title_id' => $this->request->getPost('included_title_id'),
                    'included_title_en' => $this->request->getPost('included_title_en'),
                    'included_desc_id' => $this->request->getPost('included_desc_id'),
                    'included_desc_en' => $this->request->getPost('included_desc_en'),
                    'included_status' => $this->request->getPost('included_status')
                ];

                $file = $this->request->getFile('included_image');
                if ($this->hasUploadedFile($file))
                {
                    $newname = 'bxsea_image_' . time() . '.' . $file->getExtension();
                    if($file->move('./assets/upload/school_included/', $newname))
                    {
                        $data['included_image'] = $newname;
                        $oldpicture = $this->request->getPost('oldpicture');
                        if (!empty($oldpicture) && file_exists('./assets/upload/school_included/'.$oldpicture))
                        {
                            unlink('./assets/upload/school_included/'.$oldpicture);
                        }
                    }
                }
                
                $this->Crud->updateData('tbl_school_what_included', $data, ['included_id' => $included_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolincluded');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolincluded/update/'.$included_id);
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_schoolincluded($included_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $data = $this->Crud->readData('*', 'tbl_school_what_included', ['included_id' => $included_id], '', '', '', '', '');
                if (!empty($data[0]['included_image']) && file_exists('./assets/upload/school_included/'.$data[0]['included_image']))
                {
                    unlink('./assets/upload/school_included/'.$data[0]['included_image']);
                }
                $this->Crud->deleteData('tbl_school_what_included', ['included_id' => $included_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolincluded');
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
    /* School What Included */

    /* School Teacher Said */
    public function schoolteacher()
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_school_teacher_said', '', '', '', '', ['teacher_created_at' => 'DESC'], '');
            echo view('administrator/ticketing/schoolteacher/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_schoolteacher()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/ticketing/schoolteacher/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_schoolteacher()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $data = [
                    'teacher_name' => $this->request->getPost('teacher_name'),
                    'teacher_title_id' => $this->request->getPost('teacher_title_id'),
                    'teacher_title_en' => $this->request->getPost('teacher_title_en'),
                    'teacher_desc_id' => $this->request->getPost('teacher_desc_id'),
                    'teacher_desc_en' => $this->request->getPost('teacher_desc_en')
                ];

                $file = $this->request->getFile('teacher_image');
                if ($this->hasUploadedFile($file))
                {
                    $newname = 'bxsea_image_' . time() . '.' . $file->getExtension();
                    if($file->move('./assets/upload/school_teacher/', $newname))
                    {
                        $data['teacher_image'] = $newname;
                    }
                    else
                    {
                        $this->session->setFlashdata('failedmovefile', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolteacher/add');
                    }
                }
                
                $this->Crud->createData('tbl_school_teacher_said', $data);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolteacher');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolteacher/add');
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_schoolteacher($teacher_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_school_teacher_said', ['teacher_id' => $teacher_id], '', '', '', '', '');
            echo view('administrator/ticketing/schoolteacher/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_schoolteacher()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $teacher_id = $this->request->getPost('teacher_id');
                $data = [
                    'teacher_name' => $this->request->getPost('teacher_name'),
                    'teacher_title_id' => $this->request->getPost('teacher_title_id'),
                    'teacher_title_en' => $this->request->getPost('teacher_title_en'),
                    'teacher_desc_id' => $this->request->getPost('teacher_desc_id'),
                    'teacher_desc_en' => $this->request->getPost('teacher_desc_en')
                ];

                $file = $this->request->getFile('teacher_image');
                if ($this->hasUploadedFile($file))
                {
                    $newname = 'bxsea_image_' . time() . '.' . $file->getExtension();
                    if($file->move('./assets/upload/school_teacher/', $newname))
                    {
                        $data['teacher_image'] = $newname;
                        $oldpicture = $this->request->getPost('oldpicture');
                        if (!empty($oldpicture) && file_exists('./assets/upload/school_teacher/'.$oldpicture))
                        {
                            unlink('./assets/upload/school_teacher/'.$oldpicture);
                        }
                    }
                }
                
                $this->Crud->updateData('tbl_school_teacher_said', $data, ['teacher_id' => $teacher_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolteacher');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolteacher/update/'.$teacher_id);
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_schoolteacher($teacher_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $data = $this->Crud->readData('*', 'tbl_school_teacher_said', ['teacher_id' => $teacher_id], '', '', '', '', '');
                if (!empty($data[0]['teacher_image']) && file_exists('./assets/upload/school_teacher/'.$data[0]['teacher_image']))
                {
                    unlink('./assets/upload/school_teacher/'.$data[0]['teacher_image']);
                }
                $this->Crud->deleteData('tbl_school_teacher_said', ['teacher_id' => $teacher_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/schoolteacher');
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
    /* School Teacher Said */

    /* Moment Memories */
    public function momentmemories()
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_moment_memories', '', '', '', '', '', '');
            echo view('administrator/ticketing/momentmemories/index', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function add_momentmemories()
    {
        if(session()->get('islogin') == TRUE)
        {
            echo view('administrator/ticketing/momentmemories/add');
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_add_momentmemories()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $data = [
                    'memory_title_id' => $this->request->getPost('memory_title_id'),
                    'memory_title_en' => $this->request->getPost('memory_title_en'),
                    'memory_status' => $this->request->getPost('memory_status')
                ];

                $file = $this->request->getFile('memory_image');
                if ($this->hasUploadedFile($file))
                {
                    $newname = 'bxsea_image_' . time() . '.' . $file->getExtension();
                    if($file->move('./assets/upload/moment_memory/', $newname))
                    {
                        $data['memory_image'] = $newname;
                    }
                    else
                    {
                        $this->session->setFlashdata('failedmovefile', '-');
                        return redirect()->route(getenv('bxsea.admin').'/ticketing/momentmemories/add');
                    }
                }
                
                $this->Crud->createData('tbl_moment_memories', $data);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/momentmemories');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/momentmemories/add');
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function update_momentmemories($memory_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            $data['getdata'] = $this->Crud->readData('*', 'tbl_moment_memories', ['memory_id' => $memory_id], '', '', '', '', '');
            echo view('administrator/ticketing/momentmemories/update', $data);
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function run_update_momentmemories()
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $memory_id = $this->request->getPost('memory_id');
                $data = [
                    'memory_title_id' => $this->request->getPost('memory_title_id'),
                    'memory_title_en' => $this->request->getPost('memory_title_en'),
                    'memory_status' => $this->request->getPost('memory_status')
                ];

                $file = $this->request->getFile('memory_image');
                if ($this->hasUploadedFile($file))
                {
                    $newname = 'bxsea_image_' . time() . '.' . $file->getExtension();
                    if($file->move('./assets/upload/moment_memory/', $newname))
                    {
                        $data['memory_image'] = $newname;
                        $oldpicture = $this->request->getPost('oldpicture');
                        if (!empty($oldpicture) && file_exists('./assets/upload/moment_memory/'.$oldpicture))
                        {
                            unlink('./assets/upload/moment_memory/'.$oldpicture);
                        }
                    }
                }
                
                $this->Crud->updateData('tbl_moment_memories', $data, ['memory_id' => $memory_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/momentmemories');
            }
            catch(Exception $ex)
            {
                $this->session->setFlashdata('failed', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/momentmemories/update/'.$memory_id);
            }
        }
        else
        {
            $this->session->setFlashdata('nologin', '-');
            return redirect()->route(getenv('bxsea.admin'));
        }
    }
    public function delete_momentmemories($memory_id = NULL)
    {
        if(session()->get('islogin') == TRUE)
        {
            try
            {
                $data = $this->Crud->readData('*', 'tbl_moment_memories', ['memory_id' => $memory_id], '', '', '', '', '');
                if (!empty($data[0]['memory_image']) && file_exists('./assets/upload/moment_memory/'.$data[0]['memory_image']))
                {
                    unlink('./assets/upload/moment_memory/'.$data[0]['memory_image']);
                }
                $this->Crud->deleteData('tbl_moment_memories', ['memory_id' => $memory_id]);
                $this->session->setFlashdata('success', '-');
                return redirect()->route(getenv('bxsea.admin').'/ticketing/momentmemories');
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
    /* Moment Memories */
}

?>