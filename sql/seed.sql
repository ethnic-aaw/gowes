USE mgc_gowes;
-- admin: admin@mgc.local / admin123 (bcrypt)
INSERT IGNORE INTO admin (nama,email,password_hash,role) VALUES
('Super Admin','admin@mgc.local','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','super_admin');

INSERT IGNORE INTO kegiatan (judul,slug,tanggal,lokasi,deskripsi,foto_cover,status,peserta) VALUES
('Gowes Manggar — Pantai Seribu Batu','gowes-manggar-pantai-seribu-batu','2026-08-17','Manggar – Pantai Seribu Batu','Gowes bareng 45 peserta menyusuri pesisir Manggar. Start jam 06.00, finish sarapan bersama di pantai. Rute 28km mostly flat, cocok untuk semua level.','https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=800&q=80','selesai',45),
('Fun Ride HUT RI ke-81','fun-ride-hut-ri-81','2026-08-10','Balikpapan – Manggar','Fun ride kemerdekaan, dress code merah-putih. Doorprize sepeda lipat dan helm.','https://images.unsplash.com/photo-1517649763962-0c623066013b?w=800&q=80','selesai',62),
('Gowes Subuh Rutin','gowes-subuh-rutin','2026-09-20','Manggar Loop 20K','Gowes rutin tiap Sabtu subuh. Kumpul 05.30 di pelataran Masjid Manggar.','https://images.unsplash.com/photo-1484156818044-c0402b43d590?w=800&q=80','akan_datang',NULL),
('Night Ride Manggar','night-ride-manggar','2026-07-12','Manggar – Lamaru','Night ride perdana, lampu dan reflektor wajib. Rute 18km.','https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80','selesai',28);

INSERT IGNORE INTO berita (judul,slug,kategori,isi,thumbnail,tanggal_publish,admin_id) VALUES
('MGC Raih Juara 2 Fun Bike Kaltim 2026','mgc-juara-2-fun-bike-kaltim-2026','Prestasi','<p>Tim MGC berhasil meraih juara 2 kategori komunitas pada ajang Fun Bike Kaltim 2026 yang diikuti 300 peserta dari berbagai kota.</p><p>Ketua MGC menyampaikan terima kasih atas kekompakan seluruh anggota.</p>','https://images.unsplash.com/photo-1517649763962-0c623066013b?w=800&q=80','2026-08-20',1),
('Tips Gowes Aman di Musim Hujan','tips-gowes-aman-musim-hujan','Tips','<p>Musim hujan bukan alasan berhenti gowes. Berikut tips aman: gunakan jas hujan tipis, rem lebih awal, hindari marka jalan yang licin, dan bawa lampu.</p>','https://images.unsplash.com/photo-1571068316344-75bc76f77890?w=800&q=80','2026-09-01',1),
('Jersey Baru MGC 2026 Resmi Diluncurkan','jersey-baru-mgc-2026','Berita','<p>Jersey terbaru MGC dengan desain hijau army dan aksen orange resmi diluncurkan. Pre-order dibuka hingga 30 September.</p>','https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80','2026-09-10',1);

INSERT IGNORE INTO galeri (kegiatan_id,url_foto,caption) VALUES
(1,'https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=600&q=80','Start Manggar'),
(1,'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=600&q=80','Finish pantai'),
(2,'https://images.unsplash.com/photo-1484156818044-c0402b43d590?w=600&q=80','Fun Ride HUT RI'),
(4,'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80','Night Ride'),
(1,'https://images.unsplash.com/photo-1571068316344-75bc76f77890?w=600&q=80','Kebersamaan'),
(2,'https://images.unsplash.com/photo-1541625602330-2277a4c46182?w=600&q=80','Peloton');
