-- MGC Gowes — schema MySQL (XAMPP)
-- ponytail: tanpa FK strict untuk galeri.kegiatan_id agar hapus kegiatan tak blokir galeri; add FK when butuh cascade
CREATE DATABASE IF NOT EXISTS mgc_gowes CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mgc_gowes;

CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','super_admin') NOT NULL DEFAULT 'admin',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS kegiatan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(200) NOT NULL,
  slug VARCHAR(220) NOT NULL UNIQUE,
  tanggal DATE NOT NULL,
  lokasi VARCHAR(200) NOT NULL,
  deskripsi TEXT NOT NULL,
  foto_cover VARCHAR(255) DEFAULT NULL,
  status ENUM('akan_datang','selesai') NOT NULL DEFAULT 'selesai',
  peserta INT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_tanggal (tanggal),
  INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS berita (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(200) NOT NULL,
  slug VARCHAR(220) NOT NULL UNIQUE,
  kategori VARCHAR(80) NOT NULL DEFAULT 'Umum',
  isi TEXT NOT NULL,
  thumbnail VARCHAR(255) DEFAULT NULL,
  tanggal_publish DATE NOT NULL,
  admin_id INT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_publish (tanggal_publish),
  FOREIGN KEY (admin_id) REFERENCES admin(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS galeri (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kegiatan_id INT DEFAULT NULL,
  url_foto VARCHAR(255) NOT NULL,
  caption VARCHAR(200) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_kegiatan (kegiatan_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
