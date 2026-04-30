-- ============================================================
-- BXSea CMS Database Schema Update
-- Run this SQL in phpMyAdmin or MySQL CLI before deploying code
-- ============================================================

-- 1. New table for visitor info page-level settings (banner, welcome, hours, guide tabs)
CREATE TABLE IF NOT EXISTS `tbl_visitvisitorpage` (
  `visitorpage_id` int(11) NOT NULL AUTO_INCREMENT,
  `visitorpage_key` varchar(100) NOT NULL,
  `visitorpage_title` varchar(255) DEFAULT '',
  `visitorpage_title_en` varchar(255) DEFAULT '',
  `visitorpage_desc` text DEFAULT NULL,
  `visitorpage_desc_en` text DEFAULT NULL,
  `visitorpage_pict1` varchar(255) DEFAULT '',
  `visitorpage_pict2` varchar(255) DEFAULT '',
  PRIMARY KEY (`visitorpage_id`),
  UNIQUE KEY `uk_visitorpage_key` (`visitorpage_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed default data (INSERT IGNORE skips if key already exists)
INSERT IGNORE INTO `tbl_visitvisitorpage` (`visitorpage_key`, `visitorpage_title`, `visitorpage_title_en`, `visitorpage_desc`, `visitorpage_desc_en`) VALUES
('banner',
 'INFORMASI PENGUNJUNG',
 'VISITOR INFORMATION',
 'Maksimalkan kunjungan Anda di BXSea!',
 'Make the most of your visit to BXSea!'),

('welcome',
 'Selamat Datang di BXSea!',
 'Welcome to BXSea!',
 'Oceanarium kami mengundang pengunjung dari berbagai kalangan untuk menjelajahi keanekaragaman laut yang memukau di BXSea. Agar kunjungan Anda lebih maksimal, harap ikuti langkah-langkah sederhana berikut demi menjaga lingkungan yang aman dan nyaman bagi kita semua',
 'Our oceanarium invites visitors of all backgrounds to explore the stunning diversity of marine life at BXSea. To make the most of your visit, please follow these simple steps to maintain a safe and comfortable environment for everyone.'),

('hours',
 'Jam Operasional',
 'Operating Hours',
 '<p>BXSea Oceanarium buka <strong>setiap hari</strong>.</p><ul><li>Senin – Jumat: 10:00 – 22:00 WIB</li><li>Sabtu – Minggu: 09:00 – 22:00 WIB</li></ul><p>Pembelian Tiket Terakhir pukul 21:00 setiap hari</p><p><em>* Seluruh waktu yang tertera dalam WIB (Waktu Indonesia Barat)</em></p><p><em>* Jam operasional dapat berubah sewaktu-waktu</em></p>',
 '<p>BXSea Oceanarium is open <strong>every day</strong>.</p><ul><li>Monday – Friday: 10:00 AM – 10:00 PM WIB</li><li>Saturday – Sunday: 09:00 AM – 10:00 PM WIB</li></ul><p>Last ticket purchase at 9:00 PM daily</p><p><em>* All times are in WIB (Western Indonesia Time)</em></p><p><em>* Operating hours are subject to change without prior notice</em></p>'),

('guide_gettinghere',
 'Cara Menuju ke Sini',
 'Getting Here',
 '<h3>NAIK KERETA</h3><p>BXSea terletak di Bintaro Jaya Xchange Mall 2, yang memiliki akses langsung ke Stasiun Jurangmangu. Cukup berjalan kaki melalui terowongan penghubung yang akan mengarahkan Anda langsung ke area mal.</p><p>Saat hendak pulang, jangan lewatkan burung-burung cantik di BXBirds, aviari mini kami yang dapat dikunjungi secara gratis!</p><h3>KENDARAAN PRIBADI</h3><p>BXSea terletak di Bintaro Jaya Xchange Mall 2 dan dapat diakses melalui berbagai ruas jalan tol. Tersedia area parkir yang luas bagi Anda yang membawa kendaraan pribadi.</p><h3>NAIK BUS</h3><p>BXSea dapat diakses menggunakan In-Trans, layanan bus jemputan (shuttle bus) gratis yang beroperasi di wilayah Bintaro Jaya.</p>',
 '<h3>BY TRAIN</h3><p>BXSea is located in Bintaro Jaya Xchange Mall 2, which has direct access to Jurangmangu Station. Simply walk through the connecting tunnel which will lead you directly to the mall area.</p><h3>PRIVATE VEHICLE</h3><p>BXSea is located in Bintaro Jaya Xchange Mall 2 and is accessible via various toll roads. Ample parking is available for those bringing private vehicles.</p><h3>BY BUS</h3><p>BXSea is accessible via In-Trans, a free shuttle bus service operating in the Bintaro Jaya area.</p>'),

('guide_howto',
 'Panduan Menjelajah',
 'How to Explore',
 '<h3>Denah Oceanarium</h3><p>Jelajahi beragam kehidupan laut kami dengan mudah menggunakan Denah Oceanarium. Unduh langsung ke perangkat Anda!</p><h3>Panduan Aksesibilitas</h3><p>BXSea hadir untuk semua! Simak Panduan Aksesibilitas kami agar kunjungan Anda berjalan senyaman mungkin.</p>',
 '<h3>Oceanarium Map</h3><p>Explore our diverse marine life with ease using the Oceanarium Map. Download it directly to your device!</p><h3>Accessibility Guide</h3><p>BXSea is for everyone! Check out our Accessibility Guide to make your visit as comfortable as possible.</p>'),

('guide_explore',
 'Cara Menjelajah',
 'Ways to Explore',
 '<h3>Jadwal Pertunjukan</h3><p>Maksimalkan kunjungan Anda di BXSea dengan memeriksa Jadwal Pertunjukan terlebih dahulu! Pelajari lebih dalam tentang kehidupan laut kami melalui berbagai pertunjukan edukatif.</p><p>Tidak diperlukan tiket tambahan untuk menyaksikan pertunjukan harian kami.</p><h3>Makanan &amp; Minuman</h3><p>Nikmati hidangan lezat dari berbagai tenan kami!</p>',
 '<h3>Show Schedule</h3><p>Maximize your visit to BXSea by checking the Show Schedule first! Learn more about our marine life through various educational performances.</p><p>No additional ticket is required to watch our daily shows.</p><h3>Food &amp; Beverages</h3><p>Enjoy delicious food from our various tenants!</p>'),

('guide_app',
 'BXSea Explore App',
 'BXSea Explore App',
 '<h3>Panduan Digital</h3><p>Jangan lewatkan aplikasi <strong>BXSea Explore</strong> untuk petualangan yang lebih seru di BXSea!</p><ol><li>Pandu perjalanan Anda langsung di aplikasi melalui sensor Bluetooth di setiap zona.</li><li>Jelajahi setiap spesies melalui profil lengkap dan detail yang tersedia di aplikasi ini.</li><li>Selesaikan berbagai misi sepanjang perjalanan untuk BXSea Buddy Anda dengan permainan yang menyenangkan.</li></ol>',
 '<h3>Digital Guide</h3><p>Don''t miss the <strong>BXSea Explore</strong> app for a more exciting adventure at BXSea!</p><ol><li>Guide your journey directly in the app via Bluetooth sensors in each zone.</li><li>Explore each species through complete and detailed profiles available in the app.</li><li>Complete various missions along the way for your BXSea Buddy with fun games.</li></ol>');

-- 2. Add label columns to tbl_visitvisitorinfo (for the Learn section badge/label)
ALTER TABLE `tbl_visitvisitorinfo`
  ADD COLUMN `visitorinfo_label` varchar(255) DEFAULT '' AFTER `visitorinfo_title_en`,
  ADD COLUMN `visitorinfo_label_en` varchar(255) DEFAULT '' AFTER `visitorinfo_label`;

-- 3. Add image column to tbl_masterdesc (for home additional-experience section image)
ALTER TABLE `tbl_masterdesc`
  ADD COLUMN `masterdesc_pict` varchar(255) DEFAULT '' AFTER `masterdesc_desc_en`;
