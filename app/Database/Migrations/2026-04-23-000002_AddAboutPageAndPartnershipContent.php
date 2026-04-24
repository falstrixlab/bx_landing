<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAboutPageAndPartnershipContent extends Migration
{
    public function up(): void
    {
        // Add carousel_zone column to existing tbl_explore_main_carousel if not exists
        if ($this->db->tableExists('tbl_explore_main_carousel') && ! $this->db->fieldExists('carousel_zone', 'tbl_explore_main_carousel')) {
            $this->forge->addColumn('tbl_explore_main_carousel', [
                'carousel_zone' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'carousel_title_en'],
            ]);
        }

        // Create tbl_about_page (single-row settings table for About page sections)
        if (! $this->db->tableExists('tbl_about_page')) {
            $this->forge->addField([
                'id'                    => ['type' => 'INT', 'auto_increment' => true],
                // Section 1: Intro (about-title & about-desc)
                'intro_title_id'        => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
                'intro_title_en'        => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
                'intro_desc_id'         => ['type' => 'TEXT', 'null' => true],
                'intro_desc_en'         => ['type' => 'TEXT', 'null' => true],
                // Section 2: Sub-circle header (title-about-circle)
                'subcircle_desc_id'     => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
                'subcircle_desc_en'     => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
                // Section 3: Bubbles (about-bubble) - 7 bubbles each with ID and EN
                'bubble1_id'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble1_en'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble2_id'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble2_en'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble3_id'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble3_en'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble4_id'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble4_en'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble5_id'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble5_en'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble6_id'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble6_en'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble7_id'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'bubble7_en'            => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                // Section 4: Gallery (about-gallery) - 3 images
                'gallery_1'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'gallery_2'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'gallery_3'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                // Section 5: Text Block - Left col (col-lg-5): image + desc
                'textblock_image'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'textblock_left_desc_id'=> ['type' => 'TEXT', 'null' => true],
                'textblock_left_desc_en'=> ['type' => 'TEXT', 'null' => true],
                // Section 5: Text Block - Right col (col-lg-7): 2 sub-blocks (Conservation & Community)
                'textblock_title1_id'   => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'textblock_title1_en'   => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'textblock_desc1_id'    => ['type' => 'TEXT', 'null' => true],
                'textblock_desc1_en'    => ['type' => 'TEXT', 'null' => true],
                'textblock_btn1_id'     => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'textblock_btn1_en'     => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'textblock_title2_id'   => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'textblock_title2_en'   => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'textblock_desc2_id'    => ['type' => 'TEXT', 'null' => true],
                'textblock_desc2_en'    => ['type' => 'TEXT', 'null' => true],
                'textblock_btn2_id'     => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'textblock_btn2_en'     => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'updated_at'            => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addPrimaryKey('id');
            $this->forge->createTable('tbl_about_page');

            // Insert default row
            $this->db->table('tbl_about_page')->insert([
                'id'                    => 1,
                'intro_title_id'        => 'Xtraordinary Xperience at Sea and Forest',
                'intro_title_en'        => 'Xtraordinary Xperience at Sea and Forest',
                'intro_desc_id'         => '<p>BXSea adalah destinasi akuarium utama di wilayah Tangerang Selatan, hadir sebagai sarana edutainment bagi segala usia untuk mengenal kehidupan laut.</p>',
                'intro_desc_en'         => '<p>BXSea is the premier aquarium destination in South Tangerang, created as an edutainment experience for all ages to discover the wonders of marine life.</p>',
                'subcircle_desc_id'     => 'BXSea adalah rumah bagi keragaman biota laut yang sangat luas!',
                'subcircle_desc_en'     => 'BXSea is home to a vast diversity of marine life!',
                'bubble1_id'            => '7,354m² <br><span>Luas Area</span>',
                'bubble1_en'            => '7,354m² <br><span>Total Area</span>',
                'bubble2_id'            => '54 <br><span>Display Akuarium</span>',
                'bubble2_en'            => '54 <br><span>Aquarium Displays</span>',
                'bubble3_id'            => '~25,000<br><span>Biota</span>',
                'bubble3_en'            => '~25,000<br><span>Biota</span>',
                'bubble4_id'            => 'Kapasitas air 4.5 Juta <br><span>Liter</span>',
                'bubble4_en'            => '4.5 Million Litres<br><span>Water Capacity</span>',
                'bubble5_id'            => '140 <br><span>Spesies</span>',
                'bubble5_en'            => '140 <br><span>Species</span>',
                'bubble6_id'            => '10 <br><span>Terarium</span>',
                'bubble6_en'            => '10 <br><span>Terrariums</span>',
                'bubble7_id'            => '44 Akuarium<br><span>Air Tawar &amp; Air Laut</span>',
                'bubble7_en'            => '44 Aquariums<br><span>Freshwater &amp; Saltwater</span>',
                'textblock_title1_id'   => 'Konservasi',
                'textblock_title1_en'   => 'Conservation',
                'textblock_desc1_id'    => 'BXSea berkomitmen pada perlindungan dan konservasi biota serta berupaya menghadirkan pengalaman edukasi berbasis konservasi bagi semua orang.',
                'textblock_desc1_en'    => 'BXSea is committed to the protection and conservation of marine life while delivering educational experiences rooted in real conservation efforts.',
                'textblock_btn1_id'     => 'Lihat Cerita Konservasi kami selengkapnya',
                'textblock_btn1_en'     => 'See our full Conservation Stories',
                'textblock_title2_id'   => 'Komunitas',
                'textblock_title2_en'   => 'Community',
                'textblock_desc2_id'    => 'Komunitas adalah jantung dari BXSea! Kami berupaya menghubungkan keluarga dan orang-orang dari segala usia dengan keajaiban kehidupan laut.',
                'textblock_desc2_en'    => 'Community is the heart of BXSea. We work to connect families and visitors of all ages with the wonders of marine life.',
                'textblock_btn2_id'     => 'Lihat Program Kunjungan Sekolah kami selengkapnya',
                'textblock_btn2_en'     => 'See our School Visit Program',
                'updated_at'            => date('Y-m-d H:i:s'),
            ]);
        }

        // Create tbl_partnership_content (single-row for meaningful-section)
        if (! $this->db->tableExists('tbl_partnership_content')) {
            $this->forge->addField([
                'id'                    => ['type' => 'INT', 'auto_increment' => true],
                'meaningful_title_id'   => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
                'meaningful_title_en'   => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
                'meaningful_desc_id'    => ['type' => 'TEXT', 'null' => true],
                'meaningful_desc_en'    => ['type' => 'TEXT', 'null' => true],
                'meaningful_img1'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'meaningful_img2'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'updated_at'            => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addPrimaryKey('id');
            $this->forge->createTable('tbl_partnership_content');

            // Insert default row
            $this->db->table('tbl_partnership_content')->insert([
                'id'                    => 1,
                'meaningful_title_id'   => 'Bekerja Sama untuk Perubahan yang Berarti',
                'meaningful_title_en'   => 'Working Together for Meaningful Change',
                'meaningful_desc_id'    => 'Sebagai rumah bagi ribuan spesies laut, BXSea berkomitmen menghadirkan hiburan edukatif yang menginspirasi rasa ingin tahu, konservasi, dan koneksi.',
                'meaningful_desc_en'    => 'As a home for thousands of marine species, BXSea is committed to delivering educational entertainment that inspires curiosity, conservation, and connection.',
                'updated_at'            => date('Y-m-d H:i:s'),
            ]);
        }

        // Create tbl_partnership_opportunity (multi-row for partnership-section cards)
        if (! $this->db->tableExists('tbl_partnership_opportunity')) {
            $this->forge->addField([
                'opp_id'    => ['type' => 'INT', 'auto_increment' => true],
                'opp_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'opp_title_id' => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'opp_title_en' => ['type' => 'VARCHAR', 'constraint' => 300, 'null' => true],
                'opp_desc_id'  => ['type' => 'TEXT', 'null' => true],
                'opp_desc_en'  => ['type' => 'TEXT', 'null' => true],
                'opp_sort'     => ['type' => 'INT', 'null' => true, 'default' => 0],
                'opp_created_at' => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addPrimaryKey('opp_id');
            $this->forge->createTable('tbl_partnership_opportunity');

            // Insert default 3 opportunity cards
            $this->db->table('tbl_partnership_opportunity')->insertBatch([
                [
                    'opp_title_id'   => 'Keselarasan Misi',
                    'opp_title_en'   => 'Mission Alignment',
                    'opp_desc_id'    => 'Bergabunglah bersama BXSea dalam menginspirasi masyarakat dari segala usia untuk menghargai laut dan mendukung upaya konservasi yang berkelanjutan.',
                    'opp_desc_en'    => 'Join BXSea in inspiring people of all ages to value the ocean and support ongoing conservation efforts.',
                    'opp_sort'       => 1,
                    'opp_created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'opp_title_id'   => 'Keterlibatan Komunitas',
                    'opp_title_en'   => 'Community Engagement',
                    'opp_desc_id'    => 'BXSea membangun koneksi bermakna antara keluarga, pendidik, dan individu melalui pengalaman edukatif bersama.',
                    'opp_desc_en'    => 'BXSea builds meaningful connections among families, educators, and curious individuals through shared educational experiences.',
                    'opp_sort'       => 2,
                    'opp_created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'opp_title_id'   => 'Kesadaran Merek',
                    'opp_title_en'   => 'Brand Awareness',
                    'opp_desc_id'    => 'Ciptakan visibilitas autentik untuk kedua merek melalui kemitraan yang berakar pada pengalaman nyata dan dampak positif bagi publik.',
                    'opp_desc_en'    => 'Create authentic visibility for both brands through a partnership grounded in real experiences and positive public impact.',
                    'opp_sort'       => 3,
                    'opp_created_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        }
    }

    public function down(): void
    {
        if ($this->db->fieldExists('carousel_zone', 'tbl_explore_main_carousel')) {
            $this->forge->dropColumn('tbl_explore_main_carousel', 'carousel_zone');
        }
        $this->forge->dropTable('tbl_about_page', true);
        $this->forge->dropTable('tbl_partnership_content', true);
        $this->forge->dropTable('tbl_partnership_opportunity', true);
    }
}
