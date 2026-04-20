<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRedesignCmsDefaults extends Migration
{
    public function up(): void
    {
        if ($this->db->tableExists('tbl_masterdesc')) {
            $defaults = [
                [
                    'masterdesc_position' => 'homedescexperience',
                    'masterdesc_menu' => 'ticket',
                    'masterdesc_title' => 'Kenali Lebih Dalam',
                    'masterdesc_title_en' => 'Get To Know More',
                    'masterdesc_desc' => 'Pengalaman tambahan kami membawa Anda jauh lebih dekat dengan kehidupan laut!',
                    'masterdesc_desc_en' => 'Our additional experiences bring you even closer to marine life.',
                ],
                [
                    'masterdesc_position' => 'promotionheader',
                    'masterdesc_menu' => 'ticket',
                    'masterdesc_title' => 'PROMO SPESIAL',
                    'masterdesc_title_en' => 'SPECIAL PROMOTIONS',
                    'masterdesc_desc' => 'Dapatkan penawaran terbaik dan nikmati pengalaman BXSea dengan harga spesial!',
                    'masterdesc_desc_en' => 'Get the best offers and enjoy BXSea with special prices and limited-time promotions.',
                ],
                [
                    'masterdesc_position' => 'scheduleheader',
                    'masterdesc_menu' => 'visit',
                    'masterdesc_title' => 'JADWAL PERTUNJUKAN',
                    'masterdesc_title_en' => 'SHOW SCHEDULE',
                    'masterdesc_desc' => 'Jika Anda mencari jadwal pertunjukan spektakuler kami, Anda berada di tempat yang tepat! Rencanakan kunjungan Anda ke BXSea di sini.',
                    'masterdesc_desc_en' => 'If you are looking for our spectacular show schedule, you are in the right place! Plan your visit to BXSea here.',
                ],
                [
                    'masterdesc_position' => 'ticketschedule',
                    'masterdesc_menu' => 'visit',
                    'masterdesc_title' => '',
                    'masterdesc_title_en' => '',
                    'masterdesc_desc' => '<h2>Jadwal Aquarium</h2><p><br>Keajaiban bawah laut selalu ada untuk Anda! BXSea Oceanarium buka setiap hari dan menghadirkan jadwal pertunjukan yang terus diperbarui untuk menemani petualangan Anda.</p>',
                    'masterdesc_desc_en' => '<h2>Aquarium Schedule</h2><p><br>The wonders of the ocean are always waiting for you at BXSea. Check the latest show times and plan the perfect visit for your family.</p>',
                ],
                [
                    'masterdesc_position' => 'guideheader',
                    'masterdesc_menu' => 'visit',
                    'masterdesc_title' => 'PANDUAN AKSESIBILITAS',
                    'masterdesc_title_en' => 'ACCESSIBILITY GUIDE',
                    'masterdesc_desc' => '',
                    'masterdesc_desc_en' => '',
                ],
                [
                    'masterdesc_position' => 'guidedescription',
                    'masterdesc_menu' => 'visit',
                    'masterdesc_title' => 'Selamat Datang di BXSea!',
                    'masterdesc_title_en' => 'Welcome to BXSea!',
                    'masterdesc_desc' => 'BXSea Oceanarium senantiasa menjaga seluruh pengunjung, memastikan semua atraksi dapat diakses oleh siapa saja! Jelajahi dunia bawah laut tanpa batas.',
                    'masterdesc_desc_en' => 'BXSea Oceanarium welcomes every guest and works to ensure all attractions can be accessed comfortably. Explore the underwater world without limits.',
                ],
            ];

            foreach ($defaults as $default) {
                $exists = $this->db->table('tbl_masterdesc')
                    ->where('masterdesc_position', $default['masterdesc_position'])
                    ->countAllResults();

                if ($exists === 0) {
                    $this->db->table('tbl_masterdesc')->insert($default);
                }
            }
        }

        if ($this->db->tableExists('tbl_visitguide')) {
            $guideExists = $this->db->table('tbl_visitguide')->countAllResults();

            if ($guideExists === 0) {
                $this->db->table('tbl_visitguide')->insertBatch([
                    [
                        'guide_title' => 'Jalur Ramah Kursi Roda',
                        'guide_desc' => 'BXSea sepenuhnya dapat diakses oleh kursi roda! Ini mencakup semua pintu masuk, jalur pejalan kaki, semua area, lift, serta fasilitas pendukung lainnya.',
                        'guide_desc_en' => 'BXSea is fully wheelchair accessible, including entrances, walkways, major public areas, elevators, and supporting facilities.',
                        'guide_pict' => 'bxsea_image_wheelchair.png',
                    ],
                    [
                        'guide_title' => 'Elevator',
                        'guide_desc' => 'Akses lift tersedia untuk memudahkan perpindahan antar area bagi seluruh pengunjung yang membutuhkan.',
                        'guide_desc_en' => 'Dedicated elevator access is available for guests who need a more comfortable route between levels.',
                        'guide_pict' => 'bxsea_image_elevator.png',
                    ],
                    [
                        'guide_title' => 'Toilet Disabilitas',
                        'guide_desc' => 'Toilet disabilitas tersedia untuk memastikan kenyamanan pengunjung selama berada di BXSea.',
                        'guide_desc_en' => 'Accessible toilets are available to support a more comfortable and inclusive visit throughout BXSea.',
                        'guide_pict' => 'bxsea_image_disabledtoilets.png',
                    ],
                ]);
            }
        }
    }

    public function down(): void
    {
        // Intentionally non-destructive.
    }
}