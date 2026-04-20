<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSupportPageDesignAssetDefaults extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('tbl_designasset')) {
            return;
        }

        $defaults = [
            ['designasset_group' => 'promotion', 'designasset_key' => 'hero', 'designasset_label' => 'Promotion Hero Background', 'designasset_label_en' => 'Promotion Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-ticket.png', 'designasset_alt' => 'Promotion background', 'designasset_status' => 1, 'designasset_sort' => 200],
            ['designasset_group' => 'promotion', 'designasset_key' => 'shell', 'designasset_label' => 'Promotion Shell Decoration', 'designasset_label_en' => 'Promotion Shell Decoration', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'BXSea Asset plus-13 1.png', 'designasset_alt' => 'Shell', 'designasset_status' => 1, 'designasset_sort' => 201],
            ['designasset_group' => 'promotion', 'designasset_key' => 'grass', 'designasset_label' => 'Promotion Grass Decoration', 'designasset_label_en' => 'Promotion Grass Decoration', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bg-grass.png', 'designasset_alt' => 'Grass', 'designasset_status' => 1, 'designasset_sort' => 202],
            ['designasset_group' => 'tenant', 'designasset_key' => 'hero', 'designasset_label' => 'Tenant Hero Background', 'designasset_label_en' => 'Tenant Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-tenant.png', 'designasset_alt' => 'Tenant background', 'designasset_status' => 1, 'designasset_sort' => 210],
            ['designasset_group' => 'tenant', 'designasset_key' => 'shark', 'designasset_label' => 'Tenant Shark Decoration', 'designasset_label_en' => 'Tenant Shark Decoration', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'BXSea Asset plus-01 1.png', 'designasset_alt' => 'Shark', 'designasset_status' => 1, 'designasset_sort' => 211],
            ['designasset_group' => 'tenant', 'designasset_key' => 'grass', 'designasset_label' => 'Tenant Grass Decoration', 'designasset_label_en' => 'Tenant Grass Decoration', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bg-grass.png', 'designasset_alt' => 'Grass', 'designasset_status' => 1, 'designasset_sort' => 212],
            ['designasset_group' => 'guide', 'designasset_key' => 'hero', 'designasset_label' => 'Guide Hero Background', 'designasset_label_en' => 'Guide Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'banner-guide.png', 'designasset_alt' => 'Guide background', 'designasset_status' => 1, 'designasset_sort' => 220],
            ['designasset_group' => 'guide', 'designasset_key' => 'panel', 'designasset_label' => 'Guide Background Panel', 'designasset_label_en' => 'Guide Background Panel', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'Rectangle 19546.png', 'designasset_alt' => 'Background panel', 'designasset_status' => 1, 'designasset_sort' => 221],
            ['designasset_group' => 'guide', 'designasset_key' => 'root', 'designasset_label' => 'Guide Root Decoration', 'designasset_label_en' => 'Guide Root Decoration', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'akar 1.png', 'designasset_alt' => 'Root', 'designasset_status' => 1, 'designasset_sort' => 222],
            ['designasset_group' => 'guide', 'designasset_key' => 'turtle', 'designasset_label' => 'Guide Turtle Decoration', 'designasset_label_en' => 'Guide Turtle Decoration', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'turtle.png', 'designasset_alt' => 'Turtle', 'designasset_status' => 1, 'designasset_sort' => 223],
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