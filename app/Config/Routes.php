<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('adminsite', function($routes){
    // Public routes (no auth needed)
    $routes->get('/', 'AdminAuth::index');
    $routes->post('loginproc', 'AdminAuth::loginproc');
    $routes->get('logout', 'AdminAuth::logout');

    // Admin Dashboard
    $routes->get('dashboard', 'AdminDashboard::index');
    $routes->get('subscribed', 'AdminDashboard::subscribed');

    $routes->get('about', 'AdminDashboard::about');
    $routes->get('about/add', 'AdminDashboard::add_about');
    $routes->post('about/runadd', 'AdminDashboard::run_add_about');
    $routes->get('about/update/(:num)', 'AdminDashboard::update_about/$1');
    $routes->post('about/runupdate', 'AdminDashboard::run_update_about');
    $routes->get('about/delete/(:num)', 'AdminDashboard::delete_about/$1');

    $routes->get('user', 'AdminDashboard::user');
    $routes->get('user/add', 'AdminDashboard::add_user');
    $routes->post('user/runadd', 'AdminDashboard::run_add_user');
    $routes->get('user/update/(:num)', 'AdminDashboard::update_user/$1');
    $routes->post('user/runupdate', 'AdminDashboard::run_update_user');
    $routes->get('user/delete/(:num)', 'AdminDashboard::delete_user/$1');

    // Master Routes
    $routes->get('master/description', 'AdminMaster::description');
    $routes->get('master/description/add', 'AdminMaster::add_description');
    $routes->post('master/description/runadd', 'AdminMaster::run_add_description');
    $routes->get('master/description/update/(:num)', 'AdminMaster::update_description/$1');
    $routes->post('master/description/runupdate', 'AdminMaster::run_update_description');
    $routes->get('master/description/delete/(:num)', 'AdminMaster::delete_description/$1');

    $routes->get('master/legal', 'AdminMaster::legal');
    $routes->get('master/legal/add', 'AdminMaster::add_legal');
    $routes->post('master/legal/runadd', 'AdminMaster::run_add_legal');
    $routes->get('master/legal/update/(:num)', 'AdminMaster::update_legal/$1');
    $routes->post('master/legal/runupdate', 'AdminMaster::run_update_legal');
    $routes->get('master/legal/delete/(:num)', 'AdminMaster::delete_legal/$1');

    $routes->get('master/setup', 'AdminMaster::setup');
    $routes->get('master/setup/update', 'AdminMaster::update_setup');
    $routes->post('master/setup/runupdate', 'AdminMaster::run_update_setup');

    $routes->get('master/socialmedia', 'AdminMaster::socialmedia');
    $routes->get('master/socialmedia/add', 'AdminMaster::add_socialmedia');
    $routes->post('master/socialmedia/runadd', 'AdminMaster::run_add_socialmedia');
    $routes->get('master/socialmedia/update/(:num)', 'AdminMaster::update_socialmedia/$1');
    $routes->post('master/socialmedia/runupdate', 'AdminMaster::run_update_socialmedia');
    $routes->get('master/socialmedia/delete/(:num)', 'AdminMaster::delete_socialmedia/$1');

    $routes->get('master/designasset', 'AdminMaster::designasset');
    $routes->get('master/designasset/add', 'AdminMaster::add_designasset');
    $routes->post('master/designasset/runadd', 'AdminMaster::run_add_designasset');
    $routes->get('master/designasset/update/(:num)', 'AdminMaster::update_designasset/$1');
    $routes->post('master/designasset/runupdate', 'AdminMaster::run_update_designasset');
    $routes->get('master/designasset/delete/(:num)', 'AdminMaster::delete_designasset/$1');

    $routes->get('master/article', 'AdminMaster::article');
    $routes->get('master/article/add', 'AdminMaster::add_article');
    $routes->post('master/article/runadd', 'AdminMaster::run_add_article');
    $routes->get('master/article/update/(:num)', 'AdminMaster::update_article/$1');
    $routes->post('master/article/runupdate', 'AdminMaster::run_update_article');
    $routes->get('master/article/delete/(:num)', 'AdminMaster::delete_article/$1');

    // Category Routes
    $routes->get('category/articlecategory', 'AdminCategory::articlecategory');
    $routes->get('category/articlecategory/add', 'AdminCategory::add_articlecategory');
    $routes->post('category/articlecategory/runadd', 'AdminCategory::run_add_articlecategory');
    $routes->get('category/articlecategory/update/(:num)', 'AdminCategory::update_articlecategory/$1');
    $routes->post('category/articlecategory/runupdate', 'AdminCategory::run_update_articlecategory');
    $routes->get('category/articlecategory/delete/(:num)', 'AdminCategory::delete_articlecategory/$1');

    $routes->get('category/merchandisecategory', 'AdminCategory::merchandisecategory');
    $routes->get('category/merchandisecategory/add', 'AdminCategory::add_merchandisecategory');
    $routes->post('category/merchandisecategory/runadd', 'AdminCategory::run_add_merchandisecategory');
    $routes->get('category/merchandisecategory/update/(:num)', 'AdminCategory::update_merchandisecategory/$1');
    $routes->post('category/merchandisecategory/runupdate', 'AdminCategory::run_update_merchandisecategory');
    $routes->get('category/merchandisecategory/delete/(:num)', 'AdminCategory::delete_merchandisecategory/$1');

    $routes->get('category/ticketcategory', 'AdminCategory::ticketcategory');
    $routes->get('category/ticketcategory/add', 'AdminCategory::add_ticketcategory');
    $routes->post('category/ticketcategory/runadd', 'AdminCategory::run_add_ticketcategory');
    $routes->get('category/ticketcategory/update/(:num)', 'AdminCategory::update_ticketcategory/$1');
    $routes->post('category/ticketcategory/runupdate', 'AdminCategory::run_update_ticketcategory');
    $routes->get('category/ticketcategory/delete/(:num)', 'AdminCategory::delete_ticketcategory/$1');

    // Home Routes
    $routes->get('home', 'AdminHome::index');
    $routes->get('home/description', 'AdminHome::description');
    $routes->get('home/description/add', 'AdminHome::add_description');
    $routes->post('home/description/runadd', 'AdminHome::run_add_description');
    $routes->get('home/description/update/(:num)', 'AdminHome::update_description/$1');
    $routes->post('home/description/runupdate', 'AdminHome::run_update_description');
    $routes->get('home/description/delete/(:num)', 'AdminHome::delete_description/$1');

    $routes->get('home/announcement', 'AdminHome::announcement');
    $routes->get('home/announcement/add', 'AdminHome::add_announcement');
    $routes->post('home/announcement/runadd', 'AdminHome::run_add_announcement');
    $routes->get('home/announcement/update/(:num)', 'AdminHome::update_announcement/$1');
    $routes->post('home/announcement/runupdate', 'AdminHome::run_update_announcement');
    $routes->get('home/announcement/delete/(:num)', 'AdminHome::delete_announcement/$1');

    $routes->get('home/banner', 'AdminHome::banner');
    $routes->get('home/banner/add', 'AdminHome::add_banner');
    $routes->post('home/banner/runadd', 'AdminHome::run_add_banner');
    $routes->get('home/banner/update/(:num)', 'AdminHome::update_banner/$1');
    $routes->post('home/banner/runupdate', 'AdminHome::run_update_banner');
    $routes->get('home/banner/delete/(:num)', 'AdminHome::delete_banner/$1');

    $routes->get('home/fiturslide', 'AdminHome::fiturslide');
    $routes->get('home/fiturslide/add', 'AdminHome::add_fiturslide');
    $routes->post('home/fiturslide/runadd', 'AdminHome::run_add_fiturslide');
    $routes->get('home/fiturslide/update/(:num)', 'AdminHome::update_fiturslide/$1');
    $routes->post('home/fiturslide/runupdate', 'AdminHome::run_update_fiturslide');
    $routes->get('home/fiturslide/delete/(:num)', 'AdminHome::delete_fiturslide/$1');

    $routes->get('home/influencer', 'AdminHome::influencer');
    $routes->get('home/influencer/add', 'AdminHome::add_influencer');
    $routes->post('home/influencer/runadd', 'AdminHome::run_add_influencer');
    $routes->get('home/influencer/update/(:num)', 'AdminHome::update_influencer/$1');
    $routes->post('home/influencer/runupdate', 'AdminHome::run_update_influencer');
    $routes->get('home/influencer/delete/(:num)', 'AdminHome::delete_influencer/$1');

    $routes->get('home/testimoni', 'AdminHome::testimoni');
    $routes->get('home/testimoni/add', 'AdminHome::add_testimoni');
    $routes->post('home/testimoni/runadd', 'AdminHome::run_add_testimoni');
    $routes->get('home/testimoni/update/(:num)', 'AdminHome::update_testimoni/$1');
    $routes->post('home/testimoni/runupdate', 'AdminHome::run_update_testimoni');
    $routes->get('home/testimoni/delete/(:num)', 'AdminHome::delete_testimoni/$1');

    $routes->get('home/partner', 'AdminHome::partner');
    $routes->get('home/partner/add', 'AdminHome::add_partner');
    $routes->post('home/partner/runadd', 'AdminHome::run_add_partner');
    $routes->get('home/partner/update/(:num)', 'AdminHome::update_partner/$1');
    $routes->post('home/partner/runupdate', 'AdminHome::run_update_partner');
    $routes->get('home/partner/delete/(:num)', 'AdminHome::delete_partner/$1');

    $routes->get('home/sosmedcontent', 'AdminHome::sosmedcontent');
    $routes->get('home/sosmedcontent/add', 'AdminHome::add_sosmedcontent');
    $routes->post('home/sosmedcontent/runadd', 'AdminHome::run_add_sosmedcontent');
    $routes->get('home/sosmedcontent/update/(:num)', 'AdminHome::update_sosmedcontent/$1');
    $routes->post('home/sosmedcontent/runupdate', 'AdminHome::run_update_sosmedcontent');
    $routes->get('home/sosmedcontent/delete/(:num)', 'AdminHome::delete_sosmedcontent/$1');

    // Ticketing
    $routes->get('ticketing/description', 'AdminTicketing::description');
    $routes->get('ticketing/description/add', 'AdminTicketing::add_description');
    $routes->post('ticketing/description/runadd', 'AdminTicketing::run_add_description');
    $routes->get('ticketing/description/update/(:num)', 'AdminTicketing::update_description/$1');
    $routes->post('ticketing/description/runupdate', 'AdminTicketing::run_update_description');
    $routes->get('ticketing/description/delete/(:num)', 'AdminTicketing::delete_description/$1');

    $routes->get('ticketing/schoolvisit', 'AdminTicketing::schoolvisit');
    $routes->get('ticketing/schoolvisit/add', 'AdminTicketing::add_schoolvisit');
    $routes->post('ticketing/schoolvisit/runadd', 'AdminTicketing::run_add_schoolvisit');
    $routes->get('ticketing/schoolvisit/update/(:num)', 'AdminTicketing::update_schoolvisit/$1');
    $routes->post('ticketing/schoolvisit/runupdate', 'AdminTicketing::run_update_schoolvisit');
    $routes->get('ticketing/schoolvisit/delete/(:num)', 'AdminTicketing::delete_schoolvisit/$1');

    $routes->get('ticketing/masterticket', 'AdminTicketing::masterticket');
    $routes->get('ticketing/masterticket/add', 'AdminTicketing::add_masterticket');
    $routes->post('ticketing/masterticket/runadd', 'AdminTicketing::run_add_masterticket');
    $routes->get('ticketing/masterticket/update/(:num)', 'AdminTicketing::update_masterticket/$1');
    $routes->post('ticketing/masterticket/runupdate', 'AdminTicketing::run_update_masterticket');
    $routes->get('ticketing/masterticket/delete/(:num)', 'AdminTicketing::delete_masterticket/$1');

    $routes->get('ticketing/experience', 'AdminTicketing::experience');
    $routes->get('ticketing/experience/add', 'AdminTicketing::add_experience');
    $routes->post('ticketing/experience/runadd', 'AdminTicketing::run_add_experience');
    $routes->get('ticketing/experience/update/(:num)', 'AdminTicketing::update_experience/$1');
    $routes->post('ticketing/experience/runupdate', 'AdminTicketing::run_update_experience');
    $routes->get('ticketing/experience/delete/(:num)', 'AdminTicketing::delete_experience/$1');

    $routes->get('ticketing/moment', 'AdminTicketing::moment');
    $routes->get('ticketing/moment/add', 'AdminTicketing::add_moment');
    $routes->post('ticketing/moment/runadd', 'AdminTicketing::run_add_moment');
    $routes->get('ticketing/moment/update/(:num)', 'AdminTicketing::update_moment/$1');
    $routes->post('ticketing/moment/runupdate', 'AdminTicketing::run_update_moment');
    $routes->get('ticketing/moment/delete/(:num)', 'AdminTicketing::delete_moment/$1');

    $routes->get('ticketing/promotion', 'AdminTicketing::promotion');
    $routes->get('ticketing/promotion/add', 'AdminTicketing::add_promotion');
    $routes->post('ticketing/promotion/runadd', 'AdminTicketing::run_add_promotion');
    $routes->get('ticketing/promotion/update/(:num)', 'AdminTicketing::update_promotion/$1');
    $routes->post('ticketing/promotion/runupdate', 'AdminTicketing::run_update_promotion');
    $routes->get('ticketing/promotion/delete/(:num)', 'AdminTicketing::delete_promotion/$1');

    $routes->get('ticketing/promosi', 'AdminTicketing::promosi');
    $routes->get('ticketing/promosi/add', 'AdminTicketing::add_promosi');
    $routes->post('ticketing/promosi/runadd', 'AdminTicketing::run_add_promosi');
    $routes->get('ticketing/promosi/update/(:num)', 'AdminTicketing::update_promosi/$1');
    $routes->post('ticketing/promosi/runupdate', 'AdminTicketing::run_update_promosi');
    $routes->get('ticketing/promosi/delete/(:num)', 'AdminTicketing::delete_promosi/$1');

    $routes->get('ticketing/schoolprogram', 'AdminTicketing::schoolprogram');
    $routes->get('ticketing/schoolprogram/add', 'AdminTicketing::add_schoolprogram');
    $routes->post('ticketing/schoolprogram/runadd', 'AdminTicketing::run_add_schoolprogram');
    $routes->get('ticketing/schoolprogram/update/(:num)', 'AdminTicketing::update_schoolprogram/$1');
    $routes->post('ticketing/schoolprogram/runupdate', 'AdminTicketing::run_update_schoolprogram');
    $routes->get('ticketing/schoolprogram/delete/(:num)', 'AdminTicketing::delete_schoolprogram/$1');

    $routes->get('ticketing/additionalexp', 'AdminTicketing::additionalexp');
    $routes->get('ticketing/additionalexp/add', 'AdminTicketing::add_additionalexp');
    $routes->post('ticketing/additionalexp/runadd', 'AdminTicketing::run_add_additionalexp');
    $routes->get('ticketing/additionalexp/update/(:num)', 'AdminTicketing::update_additionalexp/$1');
    $routes->post('ticketing/additionalexp/runupdate', 'AdminTicketing::run_update_additionalexp');

    $routes->get('ticketing/additionalexpitem', 'AdminTicketing::additionalexpitem');
    $routes->get('ticketing/additionalexpitem/add', 'AdminTicketing::add_additionalexpitem');
    $routes->post('ticketing/additionalexpitem/runadd', 'AdminTicketing::run_add_additionalexpitem');
    $routes->get('ticketing/additionalexpitem/update/(:num)', 'AdminTicketing::update_additionalexpitem/$1');
    $routes->post('ticketing/additionalexpitem/runupdate', 'AdminTicketing::run_update_additionalexpitem');
    $routes->get('ticketing/additionalexpitem/delete/(:num)', 'AdminTicketing::delete_additionalexpitem/$1');

    $routes->get('ticketing/schoolwhybxsea', 'AdminTicketing::schoolwhybxsea');
    $routes->get('ticketing/schoolwhybxsea/add', 'AdminTicketing::add_schoolwhybxsea');
    $routes->post('ticketing/schoolwhybxsea/runadd', 'AdminTicketing::run_add_schoolwhybxsea');
    $routes->get('ticketing/schoolwhybxsea/update/(:num)', 'AdminTicketing::update_schoolwhybxsea/$1');
    $routes->post('ticketing/schoolwhybxsea/runupdate', 'AdminTicketing::run_update_schoolwhybxsea');

    $routes->get('ticketing/schoolincluded', 'AdminTicketing::schoolincluded');
    $routes->get('ticketing/schoolincluded/add', 'AdminTicketing::add_schoolincluded');
    $routes->post('ticketing/schoolincluded/runadd', 'AdminTicketing::run_add_schoolincluded');
    $routes->get('ticketing/schoolincluded/update/(:num)', 'AdminTicketing::update_schoolincluded/$1');
    $routes->post('ticketing/schoolincluded/runupdate', 'AdminTicketing::run_update_schoolincluded');
    $routes->get('ticketing/schoolincluded/delete/(:num)', 'AdminTicketing::delete_schoolincluded/$1');

    $routes->get('ticketing/schoolteacher', 'AdminTicketing::schoolteacher');
    $routes->get('ticketing/schoolteacher/add', 'AdminTicketing::add_schoolteacher');
    $routes->post('ticketing/schoolteacher/runadd', 'AdminTicketing::run_add_schoolteacher');
    $routes->get('ticketing/schoolteacher/update/(:num)', 'AdminTicketing::update_schoolteacher/$1');
    $routes->post('ticketing/schoolteacher/runupdate', 'AdminTicketing::run_update_schoolteacher');
    $routes->get('ticketing/schoolteacher/delete/(:num)', 'AdminTicketing::delete_schoolteacher/$1');

    $routes->get('ticketing/momentmemories', 'AdminTicketing::momentmemories');
    $routes->get('ticketing/momentmemories/add', 'AdminTicketing::add_momentmemories');
    $routes->post('ticketing/momentmemories/runadd', 'AdminTicketing::run_add_momentmemories');
    $routes->get('ticketing/momentmemories/update/(:num)', 'AdminTicketing::update_momentmemories/$1');
    $routes->post('ticketing/momentmemories/runupdate', 'AdminTicketing::run_update_momentmemories');
    $routes->get('ticketing/momentmemories/delete/(:num)', 'AdminTicketing::delete_momentmemories/$1');

    // Explore
    $routes->get('explore/description', 'AdminExplore::description');
    $routes->get('explore/description/add', 'AdminExplore::add_description');
    $routes->post('explore/description/runadd', 'AdminExplore::run_add_description');
    $routes->get('explore/description/update/(:num)', 'AdminExplore::update_description/$1');
    $routes->post('explore/description/runupdate', 'AdminExplore::run_update_description');
    $routes->get('explore/description/delete/(:num)', 'AdminExplore::delete_description/$1');

    $routes->get('explore/journey', 'AdminExplore::journey');
    $routes->get('explore/journey/add', 'AdminExplore::add_journey');
    $routes->post('explore/journey/runadd', 'AdminExplore::run_add_journey');
    $routes->get('explore/journey/update/(:num)', 'AdminExplore::update_journey/$1');
    $routes->post('explore/journey/runupdate', 'AdminExplore::run_update_journey');
    $routes->get('explore/journey/delete/(:num)', 'AdminExplore::delete_journey/$1');

    $routes->get('explore/maincarousel', 'AdminExplore::maincarousel');
    $routes->get('explore/maincarousel/add', 'AdminExplore::add_maincarousel');
    $routes->post('explore/maincarousel/runadd', 'AdminExplore::run_add_maincarousel');
    $routes->get('explore/maincarousel/update/(:num)', 'AdminExplore::update_maincarousel/$1');
    $routes->post('explore/maincarousel/runupdate', 'AdminExplore::run_update_maincarousel');
    $routes->get('explore/maincarousel/delete/(:num)', 'AdminExplore::delete_maincarousel/$1');

    $routes->get('explore/show', 'AdminExplore::show');
    $routes->get('explore/show/add', 'AdminExplore::add_show');
    $routes->post('explore/show/runadd', 'AdminExplore::run_add_show');
    $routes->get('explore/show/update/(:num)', 'AdminExplore::update_show/$1');
    $routes->post('explore/show/runupdate', 'AdminExplore::run_update_show');
    $routes->get('explore/show/delete/(:num)', 'AdminExplore::delete_show/$1');

    // Visit

    $routes->get('visit/description', 'AdminVisit::description');
    $routes->get('visit/description/add', 'AdminVisit::add_description');
    $routes->post('visit/description/runadd', 'AdminVisit::run_add_description');
    $routes->get('visit/description/update/(:num)', 'AdminVisit::update_description/$1');
    $routes->post('visit/description/runupdate', 'AdminVisit::run_update_description');
    $routes->get('visit/description/delete/(:num)', 'AdminVisit::delete_description/$1');

    $routes->get('visit/tenant', 'AdminVisit::tenant');
    $routes->get('visit/tenant/add', 'AdminVisit::add_tenant');
    $routes->post('visit/tenant/runadd', 'AdminVisit::run_add_tenant');
    $routes->get('visit/tenant/update/(:num)', 'AdminVisit::update_tenant/$1');
    $routes->post('visit/tenant/runupdate', 'AdminVisit::run_update_tenant');
    $routes->get('visit/tenant/delete/(:num)', 'AdminVisit::delete_tenant/$1');

    $routes->get('visit/contact', 'AdminVisit::contact');
    $routes->get('visit/contact/delete/(:num)', 'AdminVisit::delete_contanct/$1');

    $routes->get('visit/faq', 'AdminVisit::faq');
    $routes->get('visit/faq/add', 'AdminVisit::add_faq');
    $routes->post('visit/faq/runadd', 'AdminVisit::run_add_faq');
    $routes->get('visit/faq/update/(:num)', 'AdminVisit::update_faq/$1');
    $routes->post('visit/faq/runupdate', 'AdminVisit::run_update_faq');
    $routes->get('visit/faq/delete/(:num)', 'AdminVisit::delete_faq/$1');

    $routes->get('visit/visitorinfo', 'AdminVisit::visitorinfo');
    $routes->get('visit/visitorinfo/add', 'AdminVisit::add_visitorinfo');
    $routes->post('visit/visitorinfo/runadd', 'AdminVisit::run_add_visitorinfo');
    $routes->get('visit/visitorinfo/update/(:num)', 'AdminVisit::update_visitorinfo/$1');
    $routes->post('visit/visitorinfo/runupdate', 'AdminVisit::run_update_visitorinfo');
    $routes->get('visit/visitorinfo/delete/(:num)', 'AdminVisit::delete_visitorinfo/$1');

    // Visitor Info - Know Section (vi-know-section, rule items)
    $routes->get('visit/visitorinfo/know', 'AdminVisit::visitorinfo_know');
    $routes->get('visit/visitorinfo/know/add', 'AdminVisit::add_visitorinfo_know');
    $routes->post('visit/visitorinfo/know/runadd', 'AdminVisit::run_add_visitorinfo_know');

    // Visitor Info - Learn Section (vi-learn-section, learn items)
    $routes->get('visit/visitorinfo/learn', 'AdminVisit::visitorinfo_learn');
    $routes->get('visit/visitorinfo/learn/add', 'AdminVisit::add_visitorinfo_learn');
    $routes->post('visit/visitorinfo/learn/runadd', 'AdminVisit::run_add_visitorinfo_learn');

    // Visitor Page sections
    $routes->get('visit/visitorpage', 'AdminVisit::visitorpage');            $routes->get('visit/visitorpage/banner', 'AdminVisit::visitorpage_banner');    $routes->get('visit/visitorpage/welcome', 'AdminVisit::visitorpage_welcome');
    $routes->get('visit/visitorpage/guide', 'AdminVisit::visitorpage_guide');
    $routes->get('visit/visitorpage/add/(:segment)', 'AdminVisit::add_visitorpage_bykey/$1');
    $routes->get('visit/visitorpage/update/(:num)', 'AdminVisit::update_visitorpage/$1');
    $routes->post('visit/visitorpage/runupdate', 'AdminVisit::run_update_visitorpage');

    $routes->get('visit/guide', 'AdminVisit::guide');
    $routes->get('visit/guide/add', 'AdminVisit::add_guide');
    $routes->post('visit/guide/runadd', 'AdminVisit::run_add_guide');
    $routes->get('visit/guide/update/(:num)', 'AdminVisit::update_guide/$1');
    $routes->post('visit/guide/runupdate', 'AdminVisit::run_update_guide');
    $routes->get('visit/guide/delete/(:num)', 'AdminVisit::delete_guide/$1');

    $routes->get('visit/map', 'AdminVisit::map');
    $routes->get('visit/map/add', 'AdminVisit::add_map');
    $routes->post('visit/map/runadd', 'AdminVisit::run_add_map');
    $routes->get('visit/map/update/(:num)', 'AdminVisit::update_map/$1');
    $routes->post('visit/map/runupdate', 'AdminVisit::run_update_map');
    $routes->get('visit/map/delete/(:num)', 'AdminVisit::delete_map/$1');

    $routes->get('visit/merchandise', 'AdminVisit::merchandise');
    $routes->get('visit/merchandise/add', 'AdminVisit::add_merchandise');
    $routes->post('visit/merchandise/runadd', 'AdminVisit::run_add_merchandise');
    $routes->get('visit/merchandise/update/(:num)', 'AdminVisit::update_merchandise/$1');
    $routes->post('visit/merchandise/runupdate', 'AdminVisit::run_update_merchandise');
    $routes->get('visit/merchandise/delete/(:num)', 'AdminVisit::delete_merchandise/$1');

    $routes->get('visit/schedule', 'AdminVisit::schedule');
    $routes->get('visit/schedule/add', 'AdminVisit::add_schedule');
    $routes->post('visit/schedule/runadd', 'AdminVisit::run_add_schedule');
    $routes->get('visit/schedule/update/(:num)', 'AdminVisit::update_schedule/$1');
    $routes->post('visit/schedule/runupdate', 'AdminVisit::run_update_schedule');
    $routes->get('visit/schedule/delete/(:num)', 'AdminVisit::delete_schedule/$1');
});

$routes->get('/', 'Landing::first');

// Slider captcha image/refresh endpoints
$routes->get('captcha/slide-bg/(:segment)',    'CaptchaController::slideBackground/$1');
$routes->get('captcha/slide-piece/(:segment)', 'CaptchaController::slidePiece/$1');
$routes->get('captcha/slide-refresh',          'CaptchaController::slideRefresh');

$routes->group('id', function($routes){
    $routes->get('/', 'Landing::index');
    $routes->get('tiket/harga', 'Landing::tiketmaster');
    $routes->get('tiket/promosi', 'Landing::tiketpromosi');
    $routes->get('tiket/pengalaman-premium', 'Landing::tiketpengalaman');
    $routes->get('tiket/program-kunjungan-sekolah', 'Landing::tiketkunjungansekolah');
    $routes->get('tiket/momen-istimewa', 'Landing::tiketmomenistimewa');
    $routes->get('journey/journey-utama', 'Landing::jelajahutama');
    $routes->get('journey/pertunjukan', 'Landing::jelajahpertunjukan');
    $routes->get('kunjungan/jadwal-aquarium', 'Landing::kunjunganjadwal');
    $routes->get('kunjungan/denah', 'Landing::kunjungandenah');
    $routes->get('kunjungan/panduan-aksesibilitas', 'Landing::kunjunganpanduan');
    $routes->get('kunjungan/tenant', 'Landing::kunjungantenant');
    $routes->get('kunjungan/merchandise', 'Landing::kunjunganmerchandise');
    $routes->get('kunjungan/faq', 'Landing::kunjunganfaq');
    $routes->get('kunjungan/hubungi-kami', 'Landing::kunjunganhubungi');
    $routes->post('kunjungan/hubungi-kami-proses', 'Landing::kunjunganhubungiproses');
    $routes->get('kunjungan/partnership', 'Landing::kunjunganpartnership');
    $routes->post('kunjungan/partnership-proses', 'Landing::kunjunganpartnershipproses');
    $routes->get('kunjungan/informasi-pengunjung', 'Landing::kunjunganinfopengunjung');
    $routes->get('berita', 'Landing::berita');
    $routes->get('berita/detail/(:num)', 'Landing::beritadetail/$1');
    $routes->get('syarat-ketentuan', 'Landing::syaratketentuan');
    $routes->get('privasi', 'Landing::privasi');
    $routes->get('tentang-kami', 'Landing::tentang');
});

$routes->group('en', function($routes){
    $routes->get('/', 'LandingEn::index');
    $routes->get('tiket/harga', 'LandingEn::tiketmaster');
    $routes->get('tiket/promosi', 'LandingEn::tiketpromosi');
    $routes->get('tiket/pengalaman-premium', 'LandingEn::tiketpengalaman');
    $routes->get('tiket/program-kunjungan-sekolah', 'LandingEn::tiketkunjungansekolah');
    $routes->get('tiket/momen-istimewa', 'LandingEn::tiketmomenistimewa');
    $routes->get('journey/journey-utama', 'LandingEn::jelajahutama');
    $routes->get('journey/pertunjukan', 'LandingEn::jelajahpertunjukan');
    $routes->get('kunjungan/jadwal-aquarium', 'LandingEn::kunjunganjadwal');
    $routes->get('kunjungan/denah', 'LandingEn::kunjungandenah');
    $routes->get('kunjungan/panduan-aksesibilitas', 'LandingEn::kunjunganpanduan');
    $routes->get('kunjungan/tenant', 'LandingEn::kunjungantenant');
    $routes->get('kunjungan/merchandise', 'LandingEn::kunjunganmerchandise');
    $routes->get('kunjungan/faq', 'LandingEn::kunjunganfaq');
    $routes->get('kunjungan/hubungi-kami', 'LandingEn::kunjunganhubungi');
    $routes->post('kunjungan/hubungi-kami-proses', 'LandingEn::kunjunganhubungiproses');
    $routes->get('kunjungan/informasi-pengunjung', 'LandingEn::kunjunganinfopengunjung');
    $routes->get('kunjungan/partnership', 'LandingEn::kunjunganpartnership');
    $routes->post('kunjungan/partnership-proses', 'LandingEn::kunjunganpartnershipproses');
    $routes->get('berita', 'LandingEn::berita');
    $routes->get('berita/detail/(:num)', 'LandingEn::beritadetail/$1');
    $routes->get('syarat-ketentuan', 'LandingEn::syaratketentuan');
    $routes->get('privasi', 'LandingEn::privasi');
    $routes->get('tentang-kami', 'LandingEn::tentang');
});

// ====================================================================
// ADMIN NEW FEATURE ROUTES (ditambahkan Task 4 & 5)
// ====================================================================
$routes->group('adminsite', function($routes) {

    // Profile & Change Password
    $routes->get('profile', 'AdminProfile::index');
    $routes->post('profile/runupdate', 'AdminProfile::run_update');
    $routes->get('profile/changepassword', 'AdminProfile::changepassword');
    $routes->post('profile/runchangepassword', 'AdminProfile::run_changepassword');

    // Global Settings
    $routes->get('settings', 'AdminSettings::index');
    $routes->post('settings/runupdate', 'AdminSettings::run_update');

    // Media Manager
    $routes->get('media', 'AdminMedia::index');
    $routes->post('media/upload', 'AdminMedia::upload');
    $routes->get('media/delete/(:segment)', 'AdminMedia::delete/$1');

    // Partnership CMS
    $routes->get('partnership', 'AdminPartnership::index');
    $routes->get('partnership/add', 'AdminPartnership::add');
    $routes->post('partnership/runadd', 'AdminPartnership::run_add');
    $routes->get('partnership/update/(:num)', 'AdminPartnership::update/$1');
    $routes->post('partnership/runupdate/(:num)', 'AdminPartnership::run_update/$1');
    $routes->get('partnership/delete/(:num)', 'AdminPartnership::delete/$1');

    // Highlight / Journey Utama (menggunakan data explore/journey yang ada)
    $routes->get('highlight', 'AdminExplore::journey');
    $routes->get('highlight/add', 'AdminExplore::add_journey');
    $routes->post('highlight/runadd', 'AdminExplore::run_add_journey');
    $routes->get('highlight/update/(:num)', 'AdminExplore::update_journey/$1');
    $routes->post('highlight/runupdate', 'AdminExplore::run_update_journey');
    $routes->get('highlight/delete/(:num)', 'AdminExplore::delete_journey/$1');

    // Whats New / Berita Terdepan (uses article + new whats_new table)
    $routes->get('whatsnew', 'AdminWhatsNew::index');
    $routes->get('whatsnew/add', 'AdminWhatsNew::add');
    $routes->post('whatsnew/runadd', 'AdminWhatsNew::run_add');
    $routes->get('whatsnew/update/(:num)', 'AdminWhatsNew::update/$1');
    $routes->post('whatsnew/runupdate/(:num)', 'AdminWhatsNew::run_update/$1');
    $routes->get('whatsnew/delete/(:num)', 'AdminWhatsNew::delete/$1');

    // About Page CMS (tbl_about_page - single row)
    $routes->get('about/page', 'AdminDashboard::about_page');
    $routes->post('about/page/update/(:segment)', 'AdminDashboard::run_update_about_page/$1');

    // Partnership Content & Opportunity CMS
    $routes->get('partnership/content', 'AdminPartnership::content');
    $routes->post('partnership/content/update/(:segment)', 'AdminPartnership::run_update_content/$1');
    $routes->get('partnership/opportunity', 'AdminPartnership::opportunity');
    $routes->get('partnership/opportunity/add', 'AdminPartnership::add_opportunity');
    $routes->post('partnership/opportunity/runadd', 'AdminPartnership::run_add_opportunity');
    $routes->get('partnership/opportunity/update/(:num)', 'AdminPartnership::update_opportunity/$1');
    $routes->post('partnership/opportunity/runupdate', 'AdminPartnership::run_update_opportunity');
    $routes->get('partnership/opportunity/delete/(:num)', 'AdminPartnership::delete_opportunity/$1');
});

// Frontend routes untuk halaman baru
$routes->group('id', function($routes) {
    $routes->get('kunjungan/partnership', 'Landing::kunjunganpartnership');
    $routes->post('kunjungan/partnership-proses', 'Landing::kunjunganpartnershipproses');
    $routes->get('journey/journey-utama', 'Landing::jelajahutama');
    $routes->get('berita/terbaru', 'Landing::berita');
});
