<?php

namespace App\Controllers;
use Exception;
use App\Models\Crud;

class Landing extends BaseController
{
    public function __construct()
    {
        $this->Crud = new Crud();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }
    public function first()
    {
        return redirect()->route('id');
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
        $data['tickasd'] = $this->Crud->readData('*', 'tbl_ticket', ['ticket_category' => 5], '', '', '', '', '');
        /*--------------------*/
        $data['journey'] = $this->Crud->readData('*', 'tbl_explorejourney', '', '', '', '', '', '');
        $data['journeydesc'] = $this->Crud->readData('*', 'tbl_explorejourney', '', '', '', '', '', '');
        $data['show'] = $this->Crud->readData('*', 'tbl_exploreshow', '', '', '', '', '', '');
        $data['tenantpict'] = $this->Crud->readData('tenant_thumbnail_pict, tenant_main_pict', 'tbl_visittenant', '', '', '', '', '', '');
        $data['tenantdesc'] = $this->Crud->readData('tenant_title, tenant_desc, tenant_location', 'tbl_visittenant', '', '', '', '', '', '');
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

        echo view('landingid/home', $data);
    }
    public function tiketmaster()
    {
        $data['title'] = 'Harga Tiket';
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

        echo view('landingid/tiketmaster', $data);
    }
    public function tiketpromosi()
    {
        $data['title'] = 'Event & Promosi';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/

        $data['promo'] = $this->Crud->readData('*', 'tbl_ticketpromosi', '', '', '', '', '', '');
        $data['promoheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'promotionheader'], '', '', '', '', '');

        echo view('landingid/tiketpromosi', $data);
    }
    public function tiketpengalaman()
    {
        $data['title'] = 'Pengalaman Premium';
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

        echo view('landingid/tiketpengalaman', $data);
    }
    public function tiketkunjungansekolah()
    {
        $data['title'] = 'Program Kunjungan Sekolah';
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

        echo view('landingid/tiketkunjungansekolah', $data);
    }
    public function tiketmomenistimewa()
    {
        $data['title'] = 'Momen Istimewa';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        // New memories data
        $data['memories'] = $this->Crud->readData('*', 'tbl_moment_memories', ['memory_status' => 1], '', '', '', '', '');
        /*--------------------*/
        $data['moment'] = $this->Crud->readData('*', 'tbl_ticketmoment', '', '', '', '', '', '');
        $data['momentheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'momentheader'], '', '', '', '', '');
        $data['momentdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'momentdescription'], '', '', '', '', '');

        echo view('landingid/tiketmomenistimewa', $data);
    }
    public function jelajahutama()
    {
        $data['title'] = 'Journey Utama';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['journey'] = $this->Crud->readData('*', 'tbl_explorejourney', '', '', '', '', '', '');
        $data['journeyheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'journeyheader'], '', '', '', '', '');
        $data['maincarousel'] = $this->Crud->readData('*', 'tbl_explore_main_carousel', '', '', '', '', ['carousel_id' => 'ASC'], '');

        echo view('landingid/jelajahutama', $data);
    }
    public function jelajahpertunjukan()
    {
        $data['title'] = 'Pertunjukan';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['show'] = $this->Crud->readData('*', 'tbl_exploreshow', '', '', '', '', '', '');
        $data['showheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'showheader'], '', '', '', '', '');

        echo view('landingid/jelajahpertunjukan', $data);
    }
    public function kunjunganjadwal()
    {
        $data['title'] = 'Jadwal Aquarium';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['schedule'] = $this->Crud->readData('*', 'tbl_visitschedule', '', '', '', '', ['schedule_date' => 'ASC'], '');
        $data['ticketdescschedule'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'ticketschedule'], '', '', '', '', '');
        $data['scheduleheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'scheduleheader'], '', '', '', '', '');

        echo view('landingid/kunjunganjadwal', $data);
    }
    public function kunjungandenah()
    {
        $data['title'] = 'Denah BXSea';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/

        $data['map'] = $this->Crud->readData('*', 'tbl_visitmap', '', '', '', '', '', '');
        echo view('landingid/kunjungandenah', $data);
    }
    public function kunjunganpanduan()
    {
        $data['title'] = 'Panduan Aksesibilitas';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        $data['guide'] = $this->Crud->readData('*', 'tbl_visitguide', '', '', '', '', '', '');
        $data['guideheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'guideheader'], '', '', '', '', '');
        $data['guidedesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'guidedescription'], '', '', '', '', '');

        echo view('landingid/kunjunganpanduan', $data);
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

        $data['title'] = 'Tenant Kami';
        echo view('landingid/kunjungantenant', $data);
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

        echo view('landingid/kunjunganmerchandise', $data);
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

        echo view('landingid/kunjunganfaq', $data);
    }
    public function kunjunganhubungi()
    {
        $data['title'] = 'Hubungi Kami';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/

        $data['contactheader'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'contactheader'], '', '', '', '', '');
        $data['contactdesc'] = $this->Crud->readData('*', 'tbl_masterdesc', ['masterdesc_position' => 'contactdescription'], '', '', '', '', '');
        
        echo view('landingid/kunjunganhubungi', $data);
    }
    public function kunjunganhubungiproses()
    {
        $submit = $this->request->getVar('submit');
        if (isset($submit))
        {
            try
            {
                $data = [
                    'contact_fullname' => $this->request->getVar('contact_fullname'),
                    'contact_phone' => $this->request->getVar('contact_phone'),
                    'contact_email' => $this->request->getVar('contact_email'),
                    'contact_desc' => $this->request->getVar('contact_desc'),
                ];
                $insert = $this->Crud->createData('tbl_visitcontact', $data);
                if ($insert) 
                {
                    $this->session->setFlashdata('success', '-');
                    return redirect()->route('id/kunjungan/hubungi-kami');
                }
                else
                {
                    $this->session->setFlashdata('failed', '-');
                    return redirect()->route('id/kunjungan/hubungi-kami');
                }
            }
            catch(Exception $ex)
            {
                echo 'Message: ' .$ex->getMessage();
            }
        }
    }
    public function berita()
    {
        $data['title'] = 'Berita Terkini';
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

        echo view('landingid/berita', $data);
    }
    public function beritadetail($id = NULL)
    {
        $data['title'] = 'Berita Terkini';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        /*--------------------*/
        
        $data['article'] = $this->Crud->readData('*', 'tbl_article', ['article_id' => $id], '', '', '', '', ['limit' => 1]);        
        echo view('landingid/beritadetail', $data);
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

        echo view('landingid/syaratketentuan', $data);
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
        echo view('landingid/privasi', $data);
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

        echo view('landingid/tentang', $data);
    }
    public function kunjunganpartnership()
    {
        $data['title'] = 'Kemitraan';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $pcRows = $this->Crud->readData('*', 'tbl_partnership_content', ['id' => 1], '', '', '', '', '');
        $data['partnershipContent'] = !empty($pcRows) ? $pcRows[0] : [];
        $data['partnershipOpportunities'] = $this->Crud->readData('*', 'tbl_partnership_opportunity', '', '', '', '', ['opp_sort' => 'ASC'], '');
        echo view('landingid/kunjunganpartnership', $data);
    }
    public function kunjunganpartnershipproses()
    {
        $submit = $this->request->getVar('submit');
        if (isset($submit))
        {
            try
            {
                $data = [
                    'contact_fullname' => $this->request->getVar('contact_fullname'),
                    'contact_phone'    => $this->request->getVar('contact_phone'),
                    'contact_email'    => $this->request->getVar('contact_email'),
                    'contact_desc'     => $this->request->getVar('contact_desc'),
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
                log_message('error', 'Partnership contact: ' . $ex->getMessage());
                $this->session->setFlashdata('failed', '-');
            }
        }
        return redirect()->to(base_url('id/kunjungan/partnership'));
    }

    public function kunjunganinfopengunjung()
    {
        $data['title'] = 'Informasi Pengunjung';
        $data['setup'] = $this->Crud->readData('*', 'tbl_mastersetup', '', '', '', '', '', '');
        $data['sosmed'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_a'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['sosmed_header_b'] = $this->Crud->readData('*', 'tbl_mastersocialmedia', '', '', '', '', '', '');
        $data['visitorInfoRules'] = $this->Crud->readData('*', 'tbl_visitvisitorinfo', ['visitorinfo_section' => 'rule', 'visitorinfo_status' => 1], '', '', '', ['visitorinfo_sort' => 'ASC'], '');
        $data['visitorInfoLearn'] = $this->Crud->readData('*', 'tbl_visitvisitorinfo', ['visitorinfo_section' => 'learn', 'visitorinfo_status' => 1], '', '', '', ['visitorinfo_sort' => 'ASC'], '');
        $vpRows = $this->Crud->readData('*', 'tbl_visitvisitorpage', '', '', '', '', ['visitorpage_id' => 'ASC'], '');
        $data['visitorPageData'] = !empty($vpRows) ? array_column($vpRows, null, 'visitorpage_key') : [];
        echo view('landingid/kunjunganinfopengunjung', $data);
    }
}