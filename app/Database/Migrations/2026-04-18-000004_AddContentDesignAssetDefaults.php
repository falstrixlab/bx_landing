<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddContentDesignAssetDefaults extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('tbl_designasset')) {
            return;
        }

        $defaults = [
            ['designasset_group' => 'ticket', 'designasset_key' => 'hero', 'designasset_label' => 'Ticket Hero Background', 'designasset_label_en' => 'Ticket Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-ticket.png', 'designasset_alt' => 'Ticket background', 'designasset_status' => 1, 'designasset_sort' => 120],
            ['designasset_group' => 'ticket', 'designasset_key' => 'grass', 'designasset_label' => 'Ticket Grass Decoration', 'designasset_label_en' => 'Ticket Grass Decoration', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bg-grass.png', 'designasset_alt' => 'Grass', 'designasset_status' => 1, 'designasset_sort' => 121],
            ['designasset_group' => 'ticket', 'designasset_key' => 'location_icon', 'designasset_label' => 'Ticket Location Icon', 'designasset_label_en' => 'Ticket Location Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'dashicons_location.png', 'designasset_alt' => 'Location', 'designasset_status' => 1, 'designasset_sort' => 122],
            ['designasset_group' => 'ticket', 'designasset_key' => 'explore_addons', 'designasset_label' => 'Explore Addons Card', 'designasset_label_en' => 'Explore Addons Card', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-addons.png', 'designasset_alt' => 'Addons', 'designasset_status' => 1, 'designasset_sort' => 123],
            ['designasset_group' => 'ticket', 'designasset_key' => 'explore_school', 'designasset_label' => 'Explore School Card', 'designasset_label_en' => 'Explore School Card', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-school.png', 'designasset_alt' => 'School', 'designasset_status' => 1, 'designasset_sort' => 124],
            ['designasset_group' => 'ticket', 'designasset_key' => 'explore_special', 'designasset_label' => 'Explore Special Card', 'designasset_label_en' => 'Explore Special Card', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-special.png', 'designasset_alt' => 'Special', 'designasset_status' => 1, 'designasset_sort' => 125],
            ['designasset_group' => 'premium', 'designasset_key' => 'hero', 'designasset_label' => 'Premium Hero Background', 'designasset_label_en' => 'Premium Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-addons.png', 'designasset_alt' => 'Premium background', 'designasset_status' => 1, 'designasset_sort' => 130],
            ['designasset_group' => 'premium', 'designasset_key' => 'wave', 'designasset_label' => 'Premium Wave Decoration', 'designasset_label_en' => 'Premium Wave Decoration', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'wave-additional-exp-desc.png', 'designasset_alt' => 'Wave', 'designasset_status' => 1, 'designasset_sort' => 131],
            ['designasset_group' => 'premium', 'designasset_key' => 'duration_icon', 'designasset_label' => 'Premium Duration Icon', 'designasset_label_en' => 'Premium Duration Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_icon_duration_add_ons.png', 'designasset_alt' => 'Duration', 'designasset_status' => 1, 'designasset_sort' => 132],
            ['designasset_group' => 'premium', 'designasset_key' => 'ticket_icon', 'designasset_label' => 'Premium Ticket Icon', 'designasset_label_en' => 'Premium Ticket Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_icon_ticket_add_ons.png', 'designasset_alt' => 'Ticket', 'designasset_status' => 1, 'designasset_sort' => 133],
            ['designasset_group' => 'premium', 'designasset_key' => 'location_icon', 'designasset_label' => 'Premium Location Icon', 'designasset_label_en' => 'Premium Location Icon', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_icon_location_add_ons.png', 'designasset_alt' => 'Location', 'designasset_status' => 1, 'designasset_sort' => 134],
            ['designasset_group' => 'special', 'designasset_key' => 'hero', 'designasset_label' => 'Special Moment Hero Background', 'designasset_label_en' => 'Special Moment Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-special.png', 'designasset_alt' => 'Special background', 'designasset_status' => 1, 'designasset_sort' => 140],
            ['designasset_group' => 'school', 'designasset_key' => 'hero', 'designasset_label' => 'School Hero Background', 'designasset_label_en' => 'School Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-school.png', 'designasset_alt' => 'School background', 'designasset_status' => 1, 'designasset_sort' => 150],
            ['designasset_group' => 'school', 'designasset_key' => 'program_image', 'designasset_label' => 'School Program Image', 'designasset_label_en' => 'School Program Image', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'image-school-package.png', 'designasset_alt' => 'School program', 'designasset_status' => 1, 'designasset_sort' => 151],
            ['designasset_group' => 'school', 'designasset_key' => 'included_card', 'designasset_label' => 'School Included Card Image', 'designasset_label_en' => 'School Included Card Image', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-visitor.png', 'designasset_alt' => 'Included card', 'designasset_status' => 1, 'designasset_sort' => 152],
            ['designasset_group' => 'about', 'designasset_key' => 'hero', 'designasset_label' => 'About Hero Background', 'designasset_label_en' => 'About Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-tenant.png', 'designasset_alt' => 'About background', 'designasset_status' => 1, 'designasset_sort' => 160],
            ['designasset_group' => 'about', 'designasset_key' => 'octopus', 'designasset_label' => 'About Octopus Decoration', 'designasset_label_en' => 'About Octopus Decoration', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'gurita.png', 'designasset_alt' => 'Octopus', 'designasset_status' => 1, 'designasset_sort' => 161],
            ['designasset_group' => 'about', 'designasset_key' => 'gallery_1', 'designasset_label' => 'About Gallery 1', 'designasset_label_en' => 'About Gallery 1', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'image-aboutus2.png', 'designasset_alt' => 'Gallery', 'designasset_status' => 1, 'designasset_sort' => 162],
            ['designasset_group' => 'about', 'designasset_key' => 'gallery_2', 'designasset_label' => 'About Gallery 2', 'designasset_label_en' => 'About Gallery 2', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'image-aboutus.png', 'designasset_alt' => 'Gallery', 'designasset_status' => 1, 'designasset_sort' => 163],
            ['designasset_group' => 'about', 'designasset_key' => 'gallery_3', 'designasset_label' => 'About Gallery 3', 'designasset_label_en' => 'About Gallery 3', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'image-aboutus2.png', 'designasset_alt' => 'Gallery', 'designasset_status' => 1, 'designasset_sort' => 164],
            ['designasset_group' => 'about', 'designasset_key' => 'main_image', 'designasset_label' => 'About Main Image', 'designasset_label_en' => 'About Main Image', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_aboutus.png', 'designasset_alt' => 'About image', 'designasset_status' => 1, 'designasset_sort' => 165],
            ['designasset_group' => 'merchandise', 'designasset_key' => 'hero', 'designasset_label' => 'Merchandise Hero Background', 'designasset_label_en' => 'Merchandise Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-tenant.png', 'designasset_alt' => 'Merchandise background', 'designasset_status' => 1, 'designasset_sort' => 170],
            ['designasset_group' => 'journey', 'designasset_key' => 'hero', 'designasset_label' => 'Journey Hero Background', 'designasset_label_en' => 'Journey Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-mainjourney.png', 'designasset_alt' => 'Journey background', 'designasset_status' => 1, 'designasset_sort' => 180],
            ['designasset_group' => 'journey', 'designasset_key' => 'badge', 'designasset_label' => 'Journey Badge', 'designasset_label_en' => 'Journey Badge', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'img-animal-focus.png', 'designasset_alt' => 'Journey badge', 'designasset_status' => 1, 'designasset_sort' => 181],
            ['designasset_group' => 'journey', 'designasset_key' => 'wave', 'designasset_label' => 'Journey Wave Decoration', 'designasset_label_en' => 'Journey Wave Decoration', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'wave-additional-exp-desc.png', 'designasset_alt' => 'Journey wave', 'designasset_status' => 1, 'designasset_sort' => 182],
            ['designasset_group' => 'journey', 'designasset_key' => 'arrow', 'designasset_label' => 'Journey Arrow', 'designasset_label_en' => 'Journey Arrow', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'arrow-right-mainjourney.png', 'designasset_alt' => 'Journey arrow', 'designasset_status' => 1, 'designasset_sort' => 183],
            ['designasset_group' => 'show', 'designasset_key' => 'hero', 'designasset_label' => 'Show Hero Background', 'designasset_label_en' => 'Show Hero Background', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'bxsea_image_bg-show.png', 'designasset_alt' => 'Show background', 'designasset_status' => 1, 'designasset_sort' => 190],
            ['designasset_group' => 'show', 'designasset_key' => 'arrow', 'designasset_label' => 'Show Arrow', 'designasset_label_en' => 'Show Arrow', 'designasset_source' => 'redesign', 'designasset_directory' => 'image', 'designasset_file' => 'arrow-right-blue.png', 'designasset_alt' => 'Show arrow', 'designasset_status' => 1, 'designasset_sort' => 191],
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
