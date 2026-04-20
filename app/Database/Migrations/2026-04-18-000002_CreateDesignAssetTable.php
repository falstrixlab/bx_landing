<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDesignAssetTable extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('tbl_designasset')) {
            $this->forge->addField([
                'designasset_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'designasset_group' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'designasset_key' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'designasset_label' => [
                    'type' => 'VARCHAR',
                    'constraint' => 200,
                ],
                'designasset_label_en' => [
                    'type' => 'VARCHAR',
                    'constraint' => 200,
                    'null' => true,
                ],
                'designasset_source' => [
                    'type' => 'VARCHAR',
                    'constraint' => 20,
                    'default' => 'redesign',
                ],
                'designasset_directory' => [
                    'type' => 'VARCHAR',
                    'constraint' => 120,
                    'default' => 'image',
                ],
                'designasset_file' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ],
                'designasset_alt' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                ],
                'designasset_status' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 1,
                ],
                'designasset_sort' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'deleted_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('designasset_id', true);
            $this->forge->addKey(['designasset_group', 'designasset_key']);
            $this->forge->createTable('tbl_designasset', true);
        }

        $defaults = [
            ['designasset_group' => 'global', 'designasset_key' => 'site_logo', 'designasset_label' => 'Site Logo', 'designasset_label_en' => 'Site Logo', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'logo-BXSea.png', 'designasset_alt' => 'BXSea Logo', 'designasset_status' => 1, 'designasset_sort' => 1],
            ['designasset_group' => 'global', 'designasset_key' => 'favicon', 'designasset_label' => 'Favicon', 'designasset_label_en' => 'Favicon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'logo-BXSea.png', 'designasset_alt' => 'BXSea Favicon', 'designasset_status' => 1, 'designasset_sort' => 2],
            ['designasset_group' => 'global', 'designasset_key' => 'footer_holding', 'designasset_label' => 'Footer Holding Logo', 'designasset_label_en' => 'Footer Holding Logo', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'Jaya Property True White.png', 'designasset_alt' => 'Jaya Property', 'designasset_status' => 1, 'designasset_sort' => 3],
            ['designasset_group' => 'global', 'designasset_key' => 'footer_company', 'designasset_label' => 'Footer Company Logo', 'designasset_label_en' => 'Footer Company Logo', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'logo_footer.png', 'designasset_alt' => 'BXSea Footer Logo', 'designasset_status' => 1, 'designasset_sort' => 4],
            ['designasset_group' => 'global', 'designasset_key' => 'search_icon', 'designasset_label' => 'Search Icon', 'designasset_label_en' => 'Search Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_icon_search.png', 'designasset_alt' => 'Search', 'designasset_status' => 1, 'designasset_sort' => 5],
            ['designasset_group' => 'global', 'designasset_key' => 'clock_icon', 'designasset_label' => 'Clock Icon', 'designasset_label_en' => 'Clock Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'icons8-clock-40.png', 'designasset_alt' => 'Clock', 'designasset_status' => 1, 'designasset_sort' => 6],
            ['designasset_group' => 'global', 'designasset_key' => 'location_icon', 'designasset_label' => 'Location Icon', 'designasset_label_en' => 'Location Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'icons8-location-40.png', 'designasset_alt' => 'Location', 'designasset_status' => 1, 'designasset_sort' => 7],
            ['designasset_group' => 'global', 'designasset_key' => 'globe_icon', 'designasset_label' => 'Language Globe Icon', 'designasset_label_en' => 'Language Globe Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'globe.svg', 'designasset_alt' => 'Language', 'designasset_status' => 1, 'designasset_sort' => 8],
            ['designasset_group' => 'home', 'designasset_key' => 'marquee_star', 'designasset_label' => 'Marquee Starfish', 'designasset_label_en' => 'Marquee Starfish', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => '3d_cartoon_style_red_starfish_with_yellow_dots_icon-removebg-preview 1.png', 'designasset_alt' => 'Starfish', 'designasset_status' => 1, 'designasset_sort' => 10],
            ['designasset_group' => 'home', 'designasset_key' => 'shortcut_ticket', 'designasset_label' => 'Shortcut Ticket Icon', 'designasset_label_en' => 'Shortcut Ticket Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'book-ticket-icon-bxsea.png', 'designasset_alt' => 'Ticket', 'designasset_status' => 1, 'designasset_sort' => 11],
            ['designasset_group' => 'home', 'designasset_key' => 'shortcut_map', 'designasset_label' => 'Shortcut Map Icon', 'designasset_label_en' => 'Shortcut Map Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'oceanarium-icon-bxsea.png', 'designasset_alt' => 'Map', 'designasset_status' => 1, 'designasset_sort' => 12],
            ['designasset_group' => 'home', 'designasset_key' => 'shortcut_show', 'designasset_label' => 'Shortcut Show Icon', 'designasset_label_en' => 'Shortcut Show Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'show-icon-bxsea.png', 'designasset_alt' => 'Show', 'designasset_status' => 1, 'designasset_sort' => 13],
            ['designasset_group' => 'home', 'designasset_key' => 'shortcut_visitor', 'designasset_label' => 'Shortcut Visitor Icon', 'designasset_label_en' => 'Shortcut Visitor Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'visitor-information-icon-bxsea.png', 'designasset_alt' => 'Visitor Info', 'designasset_status' => 1, 'designasset_sort' => 14],
            ['designasset_group' => 'home', 'designasset_key' => 'shortcut_contact', 'designasset_label' => 'Shortcut Contact Icon', 'designasset_label_en' => 'Shortcut Contact Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'contactus-icon-bxsea.png', 'designasset_alt' => 'Contact', 'designasset_status' => 1, 'designasset_sort' => 15],
            ['designasset_group' => 'home', 'designasset_key' => 'feature_slide_1', 'designasset_label' => 'Homepage Feature Slide 1', 'designasset_label_en' => 'Homepage Feature Slide 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'rajaampat-carousel.png', 'designasset_alt' => 'Raja Ampat', 'designasset_status' => 1, 'designasset_sort' => 20],
            ['designasset_group' => 'home', 'designasset_key' => 'feature_slide_2', 'designasset_label' => 'Homepage Feature Slide 2', 'designasset_label_en' => 'Homepage Feature Slide 2', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'rainforest-carousel.png', 'designasset_alt' => 'Rainforest', 'designasset_status' => 1, 'designasset_sort' => 21],
            ['designasset_group' => 'home', 'designasset_key' => 'feature_slide_3', 'designasset_label' => 'Homepage Feature Slide 3', 'designasset_label_en' => 'Homepage Feature Slide 3', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'seatunnel-carousel.png', 'designasset_alt' => 'Sea Tunnel', 'designasset_status' => 1, 'designasset_sort' => 22],
            ['designasset_group' => 'home', 'designasset_key' => 'feature_slide_4', 'designasset_label' => 'Homepage Feature Slide 4', 'designasset_label_en' => 'Homepage Feature Slide 4', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'penguin-carousel.png', 'designasset_alt' => 'Penguin', 'designasset_status' => 1, 'designasset_sort' => 23],
            ['designasset_group' => 'home', 'designasset_key' => 'additional_exp_1', 'designasset_label' => 'Additional Experience 1', 'designasset_label_en' => 'Additional Experience 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'boat-tour-image.png', 'designasset_alt' => 'Boat Tour', 'designasset_status' => 1, 'designasset_sort' => 30],
            ['designasset_group' => 'home', 'designasset_key' => 'additional_exp_2', 'designasset_label' => 'Additional Experience 2', 'designasset_label_en' => 'Additional Experience 2', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'behind-the-sea-image.png', 'designasset_alt' => 'Behind The Sea', 'designasset_status' => 1, 'designasset_sort' => 31],
            ['designasset_group' => 'home', 'designasset_key' => 'additional_exp_3', 'designasset_label' => 'Additional Experience 3', 'designasset_label_en' => 'Additional Experience 3', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'penguin-feeding-fun.png', 'designasset_alt' => 'Penguin Feeding Fun', 'designasset_status' => 1, 'designasset_sort' => 32],
            ['designasset_group' => 'home', 'designasset_key' => 'show_bg_left', 'designasset_label' => 'Show Background Left', 'designasset_label_en' => 'Show Background Left', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bg-show.png', 'designasset_alt' => 'Show Background', 'designasset_status' => 1, 'designasset_sort' => 40],
            ['designasset_group' => 'home', 'designasset_key' => 'show_bg_right', 'designasset_label' => 'Show Background Right', 'designasset_label_en' => 'Show Background Right', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bg-show2.png', 'designasset_alt' => 'Show Background', 'designasset_status' => 1, 'designasset_sort' => 41],
            ['designasset_group' => 'home', 'designasset_key' => 'testimonial_1', 'designasset_label' => 'Homepage Testimonial 1', 'designasset_label_en' => 'Homepage Testimonial 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'testi1.jpg', 'designasset_alt' => 'Testimonial 1', 'designasset_status' => 1, 'designasset_sort' => 50],
            ['designasset_group' => 'home', 'designasset_key' => 'testimonial_2', 'designasset_label' => 'Homepage Testimonial 2', 'designasset_label_en' => 'Homepage Testimonial 2', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'testi2.jpg', 'designasset_alt' => 'Testimonial 2', 'designasset_status' => 1, 'designasset_sort' => 51],
            ['designasset_group' => 'home', 'designasset_key' => 'tenant_thumb_1', 'designasset_label' => 'Homepage Tenant Thumb 1', 'designasset_label_en' => 'Homepage Tenant Thumb 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'image-card-tenant5.png', 'designasset_alt' => 'Tenant 1', 'designasset_status' => 1, 'designasset_sort' => 60],
            ['designasset_group' => 'home', 'designasset_key' => 'partner_logo_1', 'designasset_label' => 'Homepage Partner Logo 1', 'designasset_label_en' => 'Homepage Partner Logo 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'image-partner3.png', 'designasset_alt' => 'Partner', 'designasset_status' => 1, 'designasset_sort' => 70],
            ['designasset_group' => 'home', 'designasset_key' => 'partnership_wave', 'designasset_label' => 'Partnership Wave', 'designasset_label_en' => 'Partnership Wave', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'wave-partnerships.png', 'designasset_alt' => 'Partnership Wave', 'designasset_status' => 1, 'designasset_sort' => 80],
            ['designasset_group' => 'visit', 'designasset_key' => 'map_download', 'designasset_label' => 'Downloadable BXSea Map PDF', 'designasset_label_en' => 'Downloadable BXSea Map PDF', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'FULL BXSea MAP [Revised]_compressed.pdf', 'designasset_alt' => 'BXSea Map PDF', 'designasset_status' => 1, 'designasset_sort' => 90],
            ['designasset_group' => 'visit', 'designasset_key' => 'map_preview', 'designasset_label' => 'BXSea Map Preview', 'designasset_label_en' => 'BXSea Map Preview', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'FULL BXSea MAP [Revised]-1.png', 'designasset_alt' => 'BXSea Map', 'designasset_status' => 1, 'designasset_sort' => 91],
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
        // Intentionally left blank to avoid destructive rollbacks on production data.
    }
}