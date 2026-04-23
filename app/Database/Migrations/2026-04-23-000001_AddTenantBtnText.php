<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTenantBtnText extends Migration
{
    public function up(): void
    {
        $additions = [
            'tenant_btn_text'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'default' => null],
            'tenant_btn_text_en' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'default' => null],
        ];
        foreach ($additions as $col => $def) {
            if (! $this->db->fieldExists($col, 'tbl_visittenant')) {
                $this->forge->addColumn('tbl_visittenant', [$col => $def]);
            }
        }
    }

    public function down(): void
    {
        foreach (['tenant_btn_text', 'tenant_btn_text_en'] as $col) {
            if ($this->db->fieldExists($col, 'tbl_visittenant')) {
                $this->forge->dropColumn('tbl_visittenant', $col);
            }
        }
    }
}
