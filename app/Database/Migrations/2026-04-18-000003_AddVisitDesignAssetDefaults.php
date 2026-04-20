<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVisitDesignAssetDefaults extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('tbl_designasset')) {
            return;
        }

        $defaults = [
            ['designasset_group' => 'global', 'designasset_key' => 'clock_icon_id', 'designasset_label' => 'Clock Icon ID', 'designasset_label_en' => 'Clock Icon ID', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'icons8-clock-40.png', 'designasset_alt' => 'Clock', 'designasset_status' => 1, 'designasset_sort' => 9],
            ['designasset_group' => 'global', 'designasset_key' => 'location_icon_id', 'designasset_label' => 'Location Icon ID', 'designasset_label_en' => 'Location Icon ID', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'icons8-location-40.png', 'designasset_alt' => 'Location', 'designasset_status' => 1, 'designasset_sort' => 10],
            ['designasset_group' => 'visit', 'designasset_key' => 'hero_contact', 'designasset_label' => 'Contact Hero Background', 'designasset_label_en' => 'Contact Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-tenant.png', 'designasset_alt' => 'Contact background', 'designasset_status' => 1, 'designasset_sort' => 100],
            ['designasset_group' => 'visit', 'designasset_key' => 'contact_card_customer', 'designasset_label' => 'Contact Card Customer', 'designasset_label_en' => 'Contact Card Customer', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'sosmed.png', 'designasset_alt' => 'Customer service', 'designasset_status' => 1, 'designasset_sort' => 101],
            ['designasset_group' => 'visit', 'designasset_key' => 'contact_card_whatsapp', 'designasset_label' => 'Contact Card Whatsapp', 'designasset_label_en' => 'Contact Card Whatsapp', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'sosmed2.png', 'designasset_alt' => 'Whatsapp', 'designasset_status' => 1, 'designasset_sort' => 102],
            ['designasset_group' => 'visit', 'designasset_key' => 'contact_card_email', 'designasset_label' => 'Contact Card Email', 'designasset_label_en' => 'Contact Card Email', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'sosmed3.png', 'designasset_alt' => 'Email', 'designasset_status' => 1, 'designasset_sort' => 103],
            ['designasset_group' => 'visit', 'designasset_key' => 'faq_shark', 'designasset_label' => 'FAQ Shark Decoration', 'designasset_label_en' => 'FAQ Shark Decoration', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'shark2.png', 'designasset_alt' => 'Shark', 'designasset_status' => 1, 'designasset_sort' => 104],
            ['designasset_group' => 'visit', 'designasset_key' => 'faq_question_icon', 'designasset_label' => 'FAQ Question Icon', 'designasset_label_en' => 'FAQ Question Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'Group 1171274846.svg', 'designasset_alt' => 'FAQ', 'designasset_status' => 1, 'designasset_sort' => 105],
            ['designasset_group' => 'visit', 'designasset_key' => 'faq_chevron', 'designasset_label' => 'FAQ Chevron Icon', 'designasset_label_en' => 'FAQ Chevron Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'icons8-chevron-down-24.png', 'designasset_alt' => 'Chevron', 'designasset_status' => 1, 'designasset_sort' => 106],
            ['designasset_group' => 'visit', 'designasset_key' => 'faq_wave', 'designasset_label' => 'FAQ Partnership Wave', 'designasset_label_en' => 'FAQ Partnership Wave', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'wave-partnerships.png', 'designasset_alt' => 'Wave', 'designasset_status' => 1, 'designasset_sort' => 107],
            ['designasset_group' => 'visit', 'designasset_key' => 'partnership_showcase_1', 'designasset_label' => 'Partnership Showcase 1', 'designasset_label_en' => 'Partnership Showcase 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_partnership2.png', 'designasset_alt' => 'Partnership showcase', 'designasset_status' => 1, 'designasset_sort' => 108],
            ['designasset_group' => 'visit', 'designasset_key' => 'partnership_showcase_2', 'designasset_label' => 'Partnership Showcase 2', 'designasset_label_en' => 'Partnership Showcase 2', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_partnership.png', 'designasset_alt' => 'Partnership showcase', 'designasset_status' => 1, 'designasset_sort' => 109],
            ['designasset_group' => 'visit', 'designasset_key' => 'partnership_opportunity_1', 'designasset_label' => 'Partnership Opportunity 1', 'designasset_label_en' => 'Partnership Opportunity 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_partnership_opportunity.png', 'designasset_alt' => 'Partnership opportunity', 'designasset_status' => 1, 'designasset_sort' => 110],
            ['designasset_group' => 'visit', 'designasset_key' => 'partnership_opportunity_2', 'designasset_label' => 'Partnership Opportunity 2', 'designasset_label_en' => 'Partnership Opportunity 2', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_partnership_opportunity2.png', 'designasset_alt' => 'Partnership opportunity', 'designasset_status' => 1, 'designasset_sort' => 111],
            ['designasset_group' => 'visit', 'designasset_key' => 'partnership_opportunity_3', 'designasset_label' => 'Partnership Opportunity 3', 'designasset_label_en' => 'Partnership Opportunity 3', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_partnership_opportunity3.png', 'designasset_alt' => 'Partnership opportunity', 'designasset_status' => 1, 'designasset_sort' => 112],
            ['designasset_group' => 'visit', 'designasset_key' => 'hero_visitor', 'designasset_label' => 'Visitor Hero Background', 'designasset_label_en' => 'Visitor Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-visitor.png', 'designasset_alt' => 'Visitor background', 'designasset_status' => 1, 'designasset_sort' => 113],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_penguin_1', 'designasset_label' => 'Visitor Penguin 1', 'designasset_label_en' => 'Visitor Penguin 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_penguin_visitor_information.png', 'designasset_alt' => 'Penguin', 'designasset_status' => 1, 'designasset_sort' => 114],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_penguin_2', 'designasset_label' => 'Visitor Penguin 2', 'designasset_label_en' => 'Visitor Penguin 2', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_penguin_visitor_information2.png', 'designasset_alt' => 'Penguin', 'designasset_status' => 1, 'designasset_sort' => 115],
        ];

        foreach ($defaults as $default) {
            $exists = $this->db->table('tbl_designasset')
                ->where('designasset_group', $default['designasset_group'])
                ->where('designasset_key', $default['designasset_key'])
                ->countAllResults();

            if ($exists === 0) {
                $this->db->table('tbl_designasset')->insert($default);
            }
        }
    }

    public function down()
    {
        // Intentionally left blank to avoid destructive rollback on production content.
    }
}
