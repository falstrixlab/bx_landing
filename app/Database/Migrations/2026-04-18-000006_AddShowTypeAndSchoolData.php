<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddShowTypeAndSchoolTeacherSaid extends Migration
{
    public function up(): void
    {
        // 1. Add show_type column to tbl_exploreshow
        if (! $this->db->fieldExists('show_type', 'tbl_exploreshow')) {
            $this->forge->addColumn('tbl_exploreshow', [
                'show_type' => [
                    'type'       => 'ENUM',
                    'constraint' => ['regular', 'seapecial'],
                    'default'    => 'regular',
                    'after'      => 'show_desc_en',
                ],
            ]);
        }

        // 2. Insert teacher-said masterdesc for school page (ID + EN)
        $existing = $this->db->table('tbl_masterdesc')
            ->where('masterdesc_position', 'schoolteachersaid')
            ->get()->getNumRows();

        if (! $existing) {
            $this->db->table('tbl_masterdesc')->insert([
                'masterdesc_title'    => '"...BXSea telah memberikan kami pengalaman terbaik yang pernah ada. Terima kasih banyak BXSea!"',
                'masterdesc_title_en' => '"...BXSea have been giving us one of the best experience ever. Thank you very much BXSea!"',
                'masterdesc_desc'     => 'Miss Ima - Mentari Preschool Jakarta',
                'masterdesc_desc_en'  => 'Miss Ima - Mentari Preschool Jakarta',
                'masterdesc_position' => 'schoolteachersaid',
                'masterdesc_menu'     => 'ticket',
            ]);
        }

        // 3. Insert school banner description if not present
        $existingSchoolBanner = $this->db->table('tbl_masterdesc')
            ->where('masterdesc_position', 'schoolprogramheader')
            ->get()->getNumRows();
        if (! $existingSchoolBanner) {
            $this->db->table('tbl_masterdesc')->insert([
                'masterdesc_title'    => 'PROGRAM KUNJUNGAN SEKOLAH',
                'masterdesc_title_en' => 'SCHOOL VISIT PROGRAM',
                'masterdesc_desc'     => 'Pemandu wisata kami yang berpengalaman akan memandu Anda untuk mempelajari keajaiban dunia bawah laut!',
                'masterdesc_desc_en'  => 'Our experienced tour guides will guide you to learn the wonders of the underwater world!',
                'masterdesc_position' => 'schoolprogramheader',
                'masterdesc_menu'     => 'ticket',
            ]);
        }

        // 4. Add design assets for school teacher said image + what-included cards
        $designAssets = [
            ['school', 'teacher_image', 'image', 'bxsea_image_miss_ima.png',        'Teacher Said - Teacher Image',    null],
            ['school', 'included_1',    'image', 'bxsea_image_whats_included.png',  'What\'s Included Card 1',          null],
            ['school', 'included_2',    'image', 'bxsea_image_whats_included2.png', 'What\'s Included Card 2',          null],
            ['school', 'included_3',    'image', 'bxsea_image_whats_included3.png', 'What\'s Included Card 3',          null],
            ['school', 'included_4',    'image', 'bxsea_image_whats_included4.png', 'What\'s Included Card 4',          null],
        ];
        $sort = 100;
        foreach ($designAssets as [$grp, $key, $dir, $file, $lbl]) {
            $exists = $this->db->table('tbl_designasset')
                ->where('designasset_group', $grp)
                ->where('designasset_key', $key)
                ->get();
            if ($exists === false || $exists->getNumRows() === 0) {
                $this->db->table('tbl_designasset')->insert([
                    'designasset_group'     => $grp,
                    'designasset_key'       => $key,
                    'designasset_label'     => $lbl,
                    'designasset_label_en'  => $lbl,
                    'designasset_source'    => 'redesign',
                    'designasset_directory' => $dir,
                    'designasset_file'      => $file,
                    'designasset_alt'       => $lbl,
                    'designasset_status'    => 1,
                    'designasset_sort'      => $sort++,
                ]);
            }
        }

        // 5. Add about circle-stats masterdesc
        $existingAboutCircle = $this->db->table('tbl_masterdesc')
            ->where('masterdesc_position', 'aboutcirclestats')
            ->get()->getNumRows();
        if (! $existingAboutCircle) {
            $this->db->table('tbl_masterdesc')->insert([
                'masterdesc_title'    => 'BXSea adalah rumah bagi keragaman biota laut yang sangat luas!',
                'masterdesc_title_en' => 'BXSea is home to a vast diversity of marine life!',
                'masterdesc_desc'     => '',
                'masterdesc_desc_en'  => '',
                'masterdesc_position' => 'aboutcirclestats',
                'masterdesc_menu'     => 'about',
            ]);
        }

        // 7. Make sure scheduleheader has EN content
        $scheduleRow = $this->db->table('tbl_masterdesc')
            ->where('masterdesc_position', 'scheduleheader')
            ->get()->getRowArray();
        if ($scheduleRow && empty(trim((string)($scheduleRow['masterdesc_desc_en'] ?? '')))) {
            $this->db->table('tbl_masterdesc')
                ->where('masterdesc_position', 'scheduleheader')
                ->update([
                    'masterdesc_desc_en' => 'If you are looking for our spectacular show schedule, you are in the right place! Plan your visit to BXSea here.',
                    'masterdesc_title_en' => 'Aquarium Schedule',
                ]);
        }
    }

    public function down(): void
    {
        // Remove show_type column
        $this->forge->dropColumn('tbl_exploreshow', 'show_type');
        // Remove inserted masterdesc rows
        $this->db->table('tbl_masterdesc')->where('masterdesc_position', 'schoolteachersaid')->delete();
        $this->db->table('tbl_masterdesc')->where('masterdesc_position', 'aboutcirclestats')->delete();
        // Remove design assets
        $this->db->table('tbl_designasset')
            ->where('designasset_page', 'school')
            ->whereIn('designasset_key', ['teacher_image', 'included_1', 'included_2', 'included_3', 'included_4'])
            ->delete();
    }
}
