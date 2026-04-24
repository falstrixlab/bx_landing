<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFeatureTasks234 extends Migration
{
    public function up(): void
    {
        // TASK 2: Create tbl_explore_main_carousel
        if (! $this->db->tableExists('tbl_explore_main_carousel')) {
            $this->forge->addField([
                'carousel_id'       => ['type' => 'INT', 'auto_increment' => true],
                'carousel_title_id' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'carousel_title_en' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'carousel_desc_id'  => ['type' => 'TEXT', 'null' => true],
                'carousel_desc_en'  => ['type' => 'TEXT', 'null' => true],
                'carousel_zone'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
                'carousel_image'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'carousel_created_at' => ['type' => 'DATETIME', 'null' => true, 'default' => null],
            ]);
            $this->forge->addPrimaryKey('carousel_id');
            $this->forge->createTable('tbl_explore_main_carousel');
        }

        // TASK 3: Add popup columns to tbl_explorejourney
        $journeyAdditions = [
            'journey_popup_desc_id'       => ['type' => 'TEXT', 'null' => true],
            'journey_popup_desc_en'       => ['type' => 'TEXT', 'null' => true],
            'journey_popup_pict1'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'journey_popup_pict1_label_id'=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'journey_popup_pict1_label_en'=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'journey_popup_pict2'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'journey_popup_pict2_label_id'=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'journey_popup_pict2_label_en'=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ];
        foreach ($journeyAdditions as $col => $def) {
            if (! $this->db->fieldExists($col, 'tbl_explorejourney')) {
                $this->forge->addColumn('tbl_explorejourney', [$col => $def]);
            }
        }

        // TASK 4: Add popup/gallery columns to tbl_visittenant
        $tenantAdditions = [
            'tenant_popup_image'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'tenant_popup_desc_id' => ['type' => 'TEXT', 'null' => true],
            'tenant_popup_desc_en' => ['type' => 'TEXT', 'null' => true],
            'tenant_gallery1'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'tenant_gallery2'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'tenant_gallery3'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ];
        foreach ($tenantAdditions as $col => $def) {
            if (! $this->db->fieldExists($col, 'tbl_visittenant')) {
                $this->forge->addColumn('tbl_visittenant', [$col => $def]);
            }
        }
    }

    public function down(): void
    {
        $this->forge->dropTable('tbl_explore_main_carousel', true);

        $journeyCols = [
            'journey_popup_desc_id', 'journey_popup_desc_en',
            'journey_popup_pict1', 'journey_popup_pict1_label_id', 'journey_popup_pict1_label_en',
            'journey_popup_pict2', 'journey_popup_pict2_label_id', 'journey_popup_pict2_label_en',
        ];
        foreach ($journeyCols as $col) {
            if ($this->db->fieldExists($col, 'tbl_explorejourney')) {
                $this->forge->dropColumn('tbl_explorejourney', $col);
            }
        }

        $tenantCols = ['tenant_popup_image', 'tenant_popup_desc_id', 'tenant_popup_desc_en', 'tenant_gallery1', 'tenant_gallery2', 'tenant_gallery3'];
        foreach ($tenantCols as $col) {
            if ($this->db->fieldExists($col, 'tbl_visittenant')) {
                $this->forge->dropColumn('tbl_visittenant', $col);
            }
        }
    }
}
