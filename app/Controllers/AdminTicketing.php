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
                        'experience_schedule' => $this->request->getVar('experience_schedule'),
                        'experience_schedule_en' => $this->request->getVar('experience_schedule_en'),
                        'experience_duration' => $this->request->getVar('experience_duration'),
                        'experience_duration_en' => $this->request->getVar('experience_duration_en'),
                        'experience_age' => $this->request->getVar('experience_age'),
                        'experience_age_en' => $this->request->getVar('experience_age_en'),
                        'experience_price' => $this->request->getVar('experience_price'),
                        'experience_pict' => $newexperiencepict,
                        'experience_link' => $this->request->getVar('experience_link'),
                        'experience_status' => $this->request->getVar('experience_status'),
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
                        'experience_schedule' => $this->request->getVar('experience_schedule'),
                        'experience_schedule_en' => $this->request->getVar('experience_schedule_en'),
                        'experience_duration' => $this->request->getVar('experience_duration'),
                        'experience_duration_en' => $this->request->getVar('experience_duration_en'),
                        'experience_age' => $this->request->getVar('experience_age'),
                        'experience_age_en' => $this->request->getVar('experience_age_en'),
                        'experience_price' => $this->request->getVar('experience_price'),
                        'experience_pict' => $newexperiencepict,
                        'experience_link' => $this->request->getVar('experience_link'),
                        'experience_status' => $this->request->getVar('experience_status'),
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
}

?>