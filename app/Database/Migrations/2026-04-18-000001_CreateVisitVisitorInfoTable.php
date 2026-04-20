<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisitVisitorInfoTable extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('tbl_visitvisitorinfo')) {
            $this->forge->addField([
                'visitorinfo_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'visitorinfo_section' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                ],
                'visitorinfo_title' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ],
                'visitorinfo_title_en' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                ],
                'visitorinfo_desc' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'visitorinfo_desc_en' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],
                'visitorinfo_icon' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                ],
                'visitorinfo_image' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                ],
                'visitorinfo_sort' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'default' => 0,
                ],
                'visitorinfo_status' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                    'default' => 1,
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

            $this->forge->addKey('visitorinfo_id', true);
            $this->forge->addKey(['visitorinfo_section', 'visitorinfo_status']);
            $this->forge->addKey('visitorinfo_sort');
            $this->forge->createTable('tbl_visitvisitorinfo', true);
            return;
        }

        $fields = $this->db->getFieldNames('tbl_visitvisitorinfo');
        $newFields = [];

        if (! in_array('created_at', $fields, true)) {
            $newFields['created_at'] = ['type' => 'DATETIME', 'null' => true];
        }
        if (! in_array('updated_at', $fields, true)) {
            $newFields['updated_at'] = ['type' => 'DATETIME', 'null' => true];
        }
        if (! in_array('deleted_at', $fields, true)) {
            $newFields['deleted_at'] = ['type' => 'DATETIME', 'null' => true];
        }
        if (! in_array('visitorinfo_status', $fields, true)) {
            $newFields['visitorinfo_status'] = ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1];
        }
        if (! in_array('visitorinfo_sort', $fields, true)) {
            $newFields['visitorinfo_sort'] = ['type' => 'INT', 'constraint' => 11, 'default' => 0];
        }
        if (! in_array('visitorinfo_icon', $fields, true)) {
            $newFields['visitorinfo_icon'] = ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true];
        }
        if (! in_array('visitorinfo_image', $fields, true)) {
            $newFields['visitorinfo_image'] = ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true];
        }

        if ($newFields !== []) {
            $this->forge->addColumn('tbl_visitvisitorinfo', $newFields);
        }
    }

    public function down()
    {
        // Intentionally left blank to avoid destructive schema rollback on live data.
    }
}
