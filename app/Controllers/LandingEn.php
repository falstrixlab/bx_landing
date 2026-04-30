<?php

namespace App\Controllers;
use Exception;
use App\Models\Crud;

class LandingEn extends BaseController
{
    public function __construct()
    {
        $this->Crud = new Crud();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }
    public function first()
    {
        return redirect()->route('en');
    }
    public function index()
    {
        $data['title'] = 'Beranda';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['homebanner'] = $this->Crud->readData('*', 'tbl_homebanner', '', '', '', '', '', '');
        $data['homefiturslider'] = $this->Crud->readData('*', 'tbl_homefiturslide', '', '', '', '', '', '');
        $data['homeinfluencer'] = $this->Crud->readData('*', 'tbl_homeinfluencer', '', '', '', '', '', '');
        $data['homeannouncement'] = $this->Crud->readData('*', 'tbl_homeannouncement', '', '', '', '', '', '');
        $data['homepartner'] = $this->Crud->readData('*', 'tbl_homepartner', '', '', '', '', '', '');
        $data['hometestimoni'] = $this->Crud->readData('*', 'tbl_hometestimoni', '', '', '', '', '', '');
        $data['homesosmedcontent'] = $this->Crud->readData('*', 'tbl_homesosmedcontent', '', '', '', '', '', '');
        /*--------------------*/
        $data['ticketcat'] = $this->Crud->readData('*', 'tbl_ticket_category', ['ticketcat_id !=' => '4'], '', '', '', '', '');
        $data['ticketregular'] = $this->Crud->readData('*', 'tbl_ticket', ['ticket_category' => 1], '', '', '', '', '');
        $data['ticketgroup'] = $this->Crud->readData('*', 'tbl_ticket', ['ticket_category' => 2], '', '', '', '', '');
        $data['ticketvip'] = $this->Crud->readData('*', 'tbl_ticket', ['ticket_category' => 3], '', '', '', '', '');
        /*--------------------*/
        $data['journey'] = $this->Crud->readData('*', 'tbl_explorejourney', '', '', '', '', '', '');
        $data['journeydesc'] = $this->Crud->readData('*', 'tbl_explorejourney', '', '', '', '', '', '');
        $data['show'] = $this->Crud->readData('*', 'tbl_exploreshow', '', '', '', '', '', '');
        $data['tenantpict'] = $this->Crud->readData('tenant_thumbnail_pict, tenant_main_pict', 'tbl_visittenant', '', '', '', '', '', '');
        $data['tenantdesc'] = $this->Crud->readData('tenant_title, tenant_desc_en, tenant_location, tenant_location_en', 'tbl_visittenant', '', '', '', '', '', '');
        $data['article'] = $this->Crud->readData('*', 'tbl_article', '', '', '', '', ['article_created_date' => 'desc'], '');
        $data['articletop'] = $this->Crud->readData('*', 'tbl_article', '', '', '', '', ['article_created_date' => 'desc'], ['limit' => 4]);
        $data['homepromo'] = $this->Crud->readData('*', 'tbl_ticketpromotion', '', '', '', '', ['promotion_id' => 'desc'], ['limit' => 4]);
        $data['ticketexperience'] = $this->Crud->readData('*', 'tbl_ticketexperience', '', '', '', '', '', '');
        /*--------------------*/
        $data['homedescbanner'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'homedescbanner'], '', '', '', '', '');
        $data['homedescticket'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'homedescticket'], '', '', '', '', '');
        $data['homedescnews'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'homedescnews'], '', '', '', '', '');
        $data['homedescexperience'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'homedescexperience'], '', '', '', '', '');
        $data['homedesctestimoni'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'homedesctestimoni'], '', '', '', '', '');
        $data['homedescsosmed'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'homedescsosmed'], '', '', '', '', '');
        $data['homedescpartner'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'homedescpartner'], '', '', '', '', '');
        $data['homedescticketreguler'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'hometicketregular'], '', '', '', '', '');
        $data['homedescticketgroup'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'hometicketgroup'], '', '', '', '', '');
        $data['homedescticketvip'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'hometicketvip'], '', '', '', '', '');
        $data['homeinfluencertitle'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'homeinfluencertitle'], '', '', '', '', '');
        $data['hometitlesea'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'hometitlesea'], '', '', '', '', '');
        $data['hometitleshow'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'hometitleshow'], '', '', '', '', '');
        $data['hometitletenant'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'hometitletenant'], '', '', '', '', '');
        $data['hometitlepartner'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'hometitlepartner'], '', '', '', '', '');

        echo view('landingen/home', $data);
    }
    public function tiketmaster()
    {
        $data['title'] = 'Ticket Prices';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['ticketcat'] = $this->Crud->readData('*', 'tbl_ticket_category', ['ticketcat_id !=' => '4'], '', '', '', '', '');
        $data['ticketregular'] = $this->Crud->readData('*', 'tbl_ticket', ['ticket_category' => 1], '', '', '', '', '');
        $data['ticketgroup'] = $this->Crud->readData('*', 'tbl_ticket', ['ticket_category' => 2], '', '', '', '', '');
        $data['ticketvip'] = $this->Crud->readData('*', 'tbl_ticket', ['ticket_category' => 3], '', '', '', '', '');
        $data['ticketother'] = $this->Crud->readData('*', 'tbl_ticket', ['ticket_category' => 4], '', '', '', '', '');
        /*--------------------*/
        $data['ticketjourney'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'ticketjourney'], '', '', '', '', '');
        $data['ticketshort'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'ticketshort'], '', '', '', '', '');
        $data['ticketlong'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'ticketlong'], '', '', '', '', '');
        $data['ticketdescvip'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'ticketvip'], '', '', '', '', '');
        $data['ticketheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'ticketheader'], '', '', '', '', '');
        $data['homedescticketreguler'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'hometicketregular'], '', '', '', '', '');
        $data['homedescticketgroup'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'hometicketgroup'], '', '', '', '', '');
        $data['homedescticketvip'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'hometicketvip'], '', '', '', '', '');
        
        echo view('landingen/tiketmaster', $data);
    }
    public function tiketpromosi()
    {
        $data['title'] = 'Promotions';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/

        $data['promoheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'promotionheader'], '', '', '', '', '');
        $data['promo'] = $this->Crud->readData('*', 'tbl_ticketpromosi', '', '', '', '', '', '');
        echo view('landingen/tiketpromosi', $data);
    }
    public function tiketpengalaman()
    {
        $data['title'] = 'Premium Experiences';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['experience'] = $this->Crud->readData('*', 'tbl_ticketexperience', '', '', '', '', '', '');
        $data['premiumheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'premiumheader'], '', '', '', '', '');
        $data['premiumdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'premiumdescription'], '', '', '', '', '');
        // New additional experience data
        $data['additional'] = $this->Crud->readData('*', 'tbl_additional_experience', '', '', '', '', '', '');
        $data['additionalitems'] = $this->Crud->readData('*', 'tbl_additional_experience_item', ['item_status' => 1], '', '', '', '', '');

        echo view('landingen/tiketpengalaman', $data);
    }
    public function tiketkunjungansekolah()
    {
        $data['title'] = 'School Visit Program';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['schoolprogram'] = $this->Crud->readData('*', 'tbl_ticketschoolprogram', '', '', '', '', '', '');
        $data['schoolprogramheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'schoolprogramheader'], '', '', '', '', '');
        $data['schoolvisitdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'schoolvisitdesc'], '', '', '', '', '');
        $data['schoolteachersaid'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'schoolteachersaid'], '', '', '', '', '');
        $data['schoolvisit'] = $this->Crud->readData('schoolvisit_desc, schoolvisit_desc_en', 'tbl_schoolvisit', '', '', '', '', '', '');
        $data['schoolvisitbasic'] = $this->Crud->readData('schoolvisit_basic', 'tbl_schoolvisit', '', '', '', '', '', '');
        $data['schoolvisitpremium'] = $this->Crud->readData('schoolvisit_premium', 'tbl_schoolvisit', '', '', '', '', '', '');
        $data['schoolvisitspecial'] = $this->Crud->readData('schoolvisit_special', 'tbl_schoolvisit', '', '', '', '', '', '');
        // New school sections data
        $data['schoolwhybxsea'] = $this->Crud->readData('*', 'tbl_school_why_bxsea', '', '', '', '', '', '');
        $data['schoolincluded'] = $this->Crud->readData('*', 'tbl_school_what_included', ['included_status' => 1], '', '', '', '', '');
        $data['teachertestimonial'] = $this->Crud->readData('*', 'tbl_school_teacher_said', '', '', '', '', ['teacher_created_at' => 'DESC'], '1');
        
        echo view('landingen/tiketkunjungansekolah', $data);
    }
    public function tiketmomenistimewa()
    {
        $data['title'] = 'Special Moments';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['moment'] = $this->Crud->readData('*', 'tbl_ticketmoment', '', '', '', '', '', '');
        $data['momentheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'momentheader'], '', '', '', '', '');
        $data['momentdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'momentdescription'], '', '', '', '', '');
        // New memories data
        $data['memories'] = $this->Crud->readData('*', 'tbl_moment_memories', ['memory_status' => 1], '', '', '', '', '');

        echo view('landingen/tiketmomenistimewa', $data);
    }
    public function jelajahutama()
    {
        $data['title'] = 'Main Journey';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['journey'] = $this->Crud->readData('*', 'tbl_explorejourney', '', '', '', '', '', '');
        $data['journeyheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'journeyheader'], '', '', '', '', '');
        $data['maincarousel'] = $this->Crud->readData('*', 'tbl_explore_main_carousel', '', '', '', '', ['carousel_id' => 'ASC'], '');

        echo view('landingen/jelajahutama', $data);
    }
    public function jelajahpertunjukan()
    {
        $data['title'] = 'Shows';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['show'] = $this->Crud->readData('*', 'tbl_exploreshow', '', '', '', '', '', '');
        $data['showheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'showheader'], '', '', '', '', '');

        echo view('landingen/jelajahpertunjukan', $data);
    }
    public function kunjunganjadwal()
    {
        $data['title'] = 'Aquarium Schedule';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['schedule'] = $this->Crud->readData('*', 'tbl_visitschedule', '', '', '', '', ['schedule_date' => 'ASC'], '');
        $data['ticketdescschedule'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'ticketschedule'], '', '', '', '', '');
        $data['scheduleheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'scheduleheader'], '', '', '', '', '');

        echo view('landingen/kunjunganjadwal', $data);
    }
    public function kunjungandenah()
    {
        $data['title'] = 'Oceanarium Maps';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/

        $data['map'] = $this->Crud->readData('*', 'tbl_visitmap', '', '', '', '', '', '');
        echo view('landingen/kunjungandenah', $data);
    }
    public function kunjunganpanduan()
    {
        $data['title'] = 'Accessibility Guide';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['guide'] = $this->Crud->readData('*', 'tbl_visitguide', '', '', '', '', '', '');
        $data['guideheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'guideheader'], '', '', '', '', '');
        $data['guidedesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'guidedescription'], '', '', '', '', '');

        echo view('landingen/kunjunganpanduan', $data);
    }
    public function kunjungantenant()
    {
        $data['title'] = 'Tenant Kami';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/

        $data['tenant'] = $this->Crud->readData('*', 'tbl_visittenant', '', '', '', '', '', '');
        $data['title'] = 'Our Tenants';
        echo view('landingen/kunjungantenant', $data);
    }
    public function kunjunganmerchandise()
    {
        $data['title'] = 'Merchandise';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/

        $data['mercat'] = $this->Crud->readData('*', 'tbl_visitmerchandise_category', '', '', '', '', '', '');
        $data['merchandise'] = $this->Crud->readData('*', 'tbl_visitmerchandise', '', '', '', '', '', '');
        $data['merchandiseheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'merchandiseheader'], '', '', '', '', '');
        $data['merchandisedesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'merchandisedescripton'], '', '', '', '', '');

        echo view('landingen/kunjunganmerchandise', $data);
    }
    public function kunjunganfaq()
    {
        $data['title'] = 'FAQ';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/

        $data['faqgeneral'] = $this->Crud->readData('*', 'tbl_visitfaq', ['faq_category' => 'general'], '', '', '', '', '');
        $data['faqfacility'] = $this->Crud->readData('*', 'tbl_visitfaq', ['faq_category' => 'facility'], '', '', '', '', '');
        $data['faqother'] = $this->Crud->readData('*', 'tbl_visitfaq', ['faq_category' => 'other'], '', '', '', '', '');
        $data['faqdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'faqdescription'], '', '', '', '', '');

        echo view('landingen/kunjunganfaq', $data);
    }
    public function kunjunganhubungi()
    {
        $data['title'] = 'Contact Us';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        
        $data['contactheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'contactheader'], '', '', '', '', '');
        $data['contactdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'contactdescription'], '', '', '', '', '');
        $captcha = \App\Controllers\CaptchaController::makeToken();
        $data['captcha_token']   = $captcha['token'];
        $data['captcha_gap_y']   = $captcha['gap_y'];
        $data['captcha_gap_x']   = $captcha['gap_x'];
        $data['captcha_img_url'] = $captcha['img_url'];
        echo view('landingen/kunjunganhubungi', $data);
    }
    public function kunjunganhubungiproses()
    {
        if (!$this->request->is('post') || !$this->request->getPost('submit')) {
            return redirect()->to(base_url('en/kunjungan/hubungi-kami'));
        }

        $captchaToken = (string)($this->request->getPost('captcha_token') ?? '');
        $captchaPos   = (int)($this->request->getPost('captcha_pos') ?? 0);
        if (!\App\Controllers\CaptchaController::verify($captchaToken, $captchaPos)) {
            $this->session->setFlashdata('captcha_error', '-');
            return redirect()->to(base_url('en/kunjungan/hubungi-kami'));
        }

        $rules = [
            'contact_fullname' => 'required|max_length[200]|regex_match[/^[a-zA-Z ]+$/]',
            'contact_phone'    => 'permit_empty|max_length[20]|regex_match[/^[0-9]*$/]',
            'contact_email'    => 'permit_empty|valid_email|max_length[100]',
            'contact_desc'     => 'permit_empty|max_length[5000]',
        ];

        if (!$this->validate($rules)) {
            $this->session->setFlashdata('failed', '-');
            return redirect()->to(base_url('en/kunjungan/hubungi-kami'));
        }

        try
        {
            $data = [
                'contact_fullname' => trim(strip_tags($this->request->getPost('contact_fullname'))),
                'contact_phone'    => trim(strip_tags($this->request->getPost('contact_phone') ?? '')),
                'contact_email'    => trim($this->request->getPost('contact_email') ?? ''),
                'contact_desc'     => trim(strip_tags($this->request->getPost('contact_desc') ?? '')),
                'contact_type'     => 'general',
            ];
            $insert = $this->Crud->createData('tbl_visitcontact', $data);
            if ($insert)
            {
                $this->session->setFlashdata('success', '-');
            }
            else
            {
                $this->session->setFlashdata('failed', '-');
            }
        }
        catch(Exception $ex)
        {
            log_message('error', 'Contact form EN: ' . $ex->getMessage());
            $this->session->setFlashdata('failed', '-');
        }

        return redirect()->to(base_url('en/kunjungan/hubungi-kami'));
    }

    public function kunjunganpartnership()
    {
        $data['title'] = 'Partnership';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $pcRows = $this->Crud->readData('*', 'tbl_partnership_content', ['id' => 1], '', '', '', '', '');
        $data['partnershipContent'] = !empty($pcRows) ? $pcRows[0] : [];
        $data['partnershipOpportunities'] = $this->Crud->readData('*', 'tbl_partnership_opportunity', '', '', '', '', ['opp_sort' => 'ASC'], '');
        $captcha = \App\Controllers\CaptchaController::makeToken();
        $data['captcha_token']   = $captcha['token'];
        $data['captcha_gap_y']   = $captcha['gap_y'];
        $data['captcha_gap_x']   = $captcha['gap_x'];
        $data['captcha_img_url'] = $captcha['img_url'];
        echo view('landingen/kunjunganpartnership', $data);
    }

    public function kunjunganpartnershipproses()
    {
        if (!$this->request->is('post') || !$this->request->getPost('submit')) {
            return redirect()->to(base_url('en/kunjungan/partnership'));
        }

        $captchaToken = (string)($this->request->getPost('captcha_token') ?? '');
        $captchaPos   = (int)($this->request->getPost('captcha_pos') ?? 0);
        if (!\App\Controllers\CaptchaController::verify($captchaToken, $captchaPos)) {
            $this->session->setFlashdata('captcha_error', '-');
            return redirect()->to(base_url('en/kunjungan/partnership'));
        }

        $rules = [
            'contact_fullname' => 'required|max_length[200]|regex_match[/^[a-zA-Z ]+$/]',
            'contact_phone'    => 'permit_empty|max_length[20]|regex_match[/^[0-9]*$/]',
            'contact_email'    => 'permit_empty|valid_email|max_length[100]',
            'contact_desc'     => 'permit_empty|max_length[5000]',
        ];

        if (!$this->validate($rules)) {
            $this->session->setFlashdata('failed', '-');
            return redirect()->to(base_url('en/kunjungan/partnership'));
        }

        try
        {
            $data = [
                'contact_fullname' => trim(strip_tags($this->request->getPost('contact_fullname'))),
                'contact_phone'    => trim(strip_tags($this->request->getPost('contact_phone') ?? '')),
                'contact_email'    => trim($this->request->getPost('contact_email') ?? ''),
                'contact_desc'     => trim(strip_tags($this->request->getPost('contact_desc') ?? '')),
                'contact_type'     => 'partnership',
            ];
            $insert = $this->Crud->createData('tbl_visitcontact', $data);
            if ($insert) {
                $this->session->setFlashdata('success', '-');
            } else {
                $this->session->setFlashdata('failed', '-');
            }
        }
        catch(\Exception $ex)
        {
            log_message('error', 'Partnership contact EN: ' . $ex->getMessage());
            $this->session->setFlashdata('failed', '-');
        }

        return redirect()->to(base_url('en/kunjungan/partnership'));
    }

    public function kunjunganinfopengunjung()
    {
        $data['title'] = 'Visitor Information';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['visitorInfoRules'] = $this->Crud->readData('*', 'tbl_visitvisitorinfo', ['visitorinfo_section' => 'rule', 'visitorinfo_status' => 1], '', '', '', ['visitorinfo_sort' => 'ASC'], '');
        $data['visitorInfoLearn'] = $this->Crud->readData('*', 'tbl_visitvisitorinfo', ['visitorinfo_section' => 'learn', 'visitorinfo_status' => 1], '', '', '', ['visitorinfo_sort' => 'ASC'], '');
        $vpRows = $this->Crud->readData('*', 'tbl_visitvisitorpage', '', '', '', '', ['visitorpage_id' => 'ASC'], '');
        $data['visitorPageData'] = !empty($vpRows) ? array_column($vpRows, null, 'visitorpage_key') : [];
        echo view('landingen/kunjunganinfopengunjung', $data);
    }

    public function berita()
    {
        $data['title'] = 'Latest News';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        
        $data['articleatop'] = $this->Crud->readData('*', 'tbl_article', '', '', '', '', ['article_created_date' => 'desc'], ['limit' => 1]);
        $data['articleall'] = $this->Crud->readData('*', 'tbl_article', '', '', '', '', ['article_created_date' => 'desc'], ['limit' => 4]);
        $data['articlenews'] = $this->Crud->readData('*', 'tbl_article', ['article_category' => 1], '', '', '', ['article_created_date' => 'desc'], '');
        $data['articlereward'] = $this->Crud->readData('*', 'tbl_article', ['article_category' => 2], '', '', '', ['article_created_date' => 'desc'], '');
        $data['articleconservation'] = $this->Crud->readData('*', 'tbl_article', ['article_category' => 3], '', '', '', ['article_created_date' => 'desc'], '');

        echo view('landingen/berita', $data);
    }
    public function beritadetail($id = NULL)
    {
        $data['title'] = 'Latest News';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        
        $data['article'] = $this->Crud->readData('*', 'tbl_article', ['article_id' => $id], '', '', '', '', ['limit' => 1]);        
        echo view('landingen/beritadetail', $data);
    }
    public function syaratketentuan()
    {
        $data['title'] = 'Syarat & Ketentuan';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['legal'] = $this->Crud->readData('*', 'tbl_masterlegal', ['masterlegal_position' => 'termcondition'], '', '', '', '', '');

        echo view('landingen/syaratketentuan', $data);
    }
    public function privasi()
    {
        $data['title'] = 'Privasi';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        
        $data['legal'] = $this->Crud->readData('*', 'tbl_masterlegal', ['masterlegal_position' => 'privasi'], '', '', '', '', '');
        echo view('landingen/privasi', $data);
    }
    public function tentang()
    {
        $data['title'] = 'Tentang Kami';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['about'] = $this->Crud->readData('*', 'tbl_about', '', '', '', '', '', '');
        $aboutPageRows = $this->Crud->readData('*', 'tbl_about_page', ['id' => 1], '', '', '', '', '');
        $data['aboutPage'] = !empty($aboutPageRows) ? $aboutPageRows[0] : [];

        $data['title'] = 'About Us';
        echo view('landingen/tentang', $data);
    }
}