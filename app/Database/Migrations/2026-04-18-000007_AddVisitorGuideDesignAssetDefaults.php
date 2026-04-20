<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVisitorGuideDesignAssetDefaults extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('tbl_designasset')) {
            return;
        }

        $defaults = [
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_location_icon', 'designasset_label' => 'Visitor Location Icon', 'designasset_label_en' => 'Visitor Location Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_icon_location.png', 'designasset_alt' => 'Location icon', 'designasset_status' => 1, 'designasset_sort' => 116],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_by_train_1', 'designasset_label' => 'Visitor By Train Image 1', 'designasset_label_en' => 'Visitor By Train Image 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bytrain.png', 'designasset_alt' => 'By train', 'designasset_status' => 1, 'designasset_sort' => 117],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_by_train_2', 'designasset_label' => 'Visitor By Train Image 2', 'designasset_label_en' => 'Visitor By Train Image 2', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bytrain2.png', 'designasset_alt' => 'By train', 'designasset_status' => 1, 'designasset_sort' => 118],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_by_vehicle_1', 'designasset_label' => 'Visitor By Vehicle Image 1', 'designasset_label_en' => 'Visitor By Vehicle Image 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_byvehicle.png', 'designasset_alt' => 'By vehicle', 'designasset_status' => 1, 'designasset_sort' => 119],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_by_vehicle_2', 'designasset_label' => 'Visitor By Vehicle Image 2', 'designasset_label_en' => 'Visitor By Vehicle Image 2', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_byvehicle2.png', 'designasset_alt' => 'By vehicle', 'designasset_status' => 1, 'designasset_sort' => 120],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_by_bus', 'designasset_label' => 'Visitor By Bus Image', 'designasset_label_en' => 'Visitor By Bus Image', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bybus.png', 'designasset_alt' => 'By bus', 'designasset_status' => 1, 'designasset_sort' => 121],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_getting_around', 'designasset_label' => 'Visitor Getting Around Image', 'designasset_label_en' => 'Visitor Getting Around Image', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_gettingaround.png', 'designasset_alt' => 'Getting around', 'designasset_status' => 1, 'designasset_sort' => 122],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_ways_to_explore', 'designasset_label' => 'Visitor Ways To Explore Image', 'designasset_label_en' => 'Visitor Ways To Explore Image', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_waystoexplore.png', 'designasset_alt' => 'Ways to explore', 'designasset_status' => 1, 'designasset_sort' => 123],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_guide_app_1', 'designasset_label' => 'Visitor Guide App Image 1', 'designasset_label_en' => 'Visitor Guide App Image 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_guideapp.png', 'designasset_alt' => 'Guide app', 'designasset_status' => 1, 'designasset_sort' => 124],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_guide_app_2', 'designasset_label' => 'Visitor Guide App Image 2', 'designasset_label_en' => 'Visitor Guide App Image 2', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_guideapp2.png', 'designasset_alt' => 'Guide app', 'designasset_status' => 1, 'designasset_sort' => 125],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_guide_app_3', 'designasset_label' => 'Visitor Guide App Image 3', 'designasset_label_en' => 'Visitor Guide App Image 3', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_guideapp3.png', 'designasset_alt' => 'Guide app', 'designasset_status' => 1, 'designasset_sort' => 126],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_guide_app_4', 'designasset_label' => 'Visitor Guide App Image 4', 'designasset_label_en' => 'Visitor Guide App Image 4', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_guideapp4.png', 'designasset_alt' => 'Guide app', 'designasset_status' => 1, 'designasset_sort' => 127],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_guide_app_5', 'designasset_label' => 'Visitor Guide App Image 5', 'designasset_label_en' => 'Visitor Guide App Image 5', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_guideapp5.png', 'designasset_alt' => 'Guide app', 'designasset_status' => 1, 'designasset_sort' => 128],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_app_store', 'designasset_label' => 'Visitor App Store Badge', 'designasset_label_en' => 'Visitor App Store Badge', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_appstore.png', 'designasset_alt' => 'App Store', 'designasset_status' => 1, 'designasset_sort' => 129],
            ['designasset_group' => 'visit', 'designasset_key' => 'visitor_play_store', 'designasset_label' => 'Visitor Play Store Badge', 'designasset_label_en' => 'Visitor Play Store Badge', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_playstore.png', 'designasset_alt' => 'Play Store', 'designasset_status' => 1, 'designasset_sort' => 130],
            ['designasset_group' => 'visit', 'designasset_key' => 'arrow_white', 'designasset_label' => 'White Arrow', 'designasset_label_en' => 'White Arrow', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'arrow-right-white.png', 'designasset_alt' => 'Arrow', 'designasset_status' => 1, 'designasset_sort' => 131],
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