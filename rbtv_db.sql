CREATE DATABASE rbtv_db;
USE rbtv_db;

CREATE TABLE berita (
  id_berita INT(11) NOT NULL AUTO_INCREMENT,
  kategori_berita ENUM('Malam', 'Daerah', 'Pekaro') NOT NULL,
  judul_berita VARCHAR(255) NOT NULL,
  tanggal_berita DATE NOT NULL,
  caption_berita TEXT NOT NULL,
  gambar_berita VARCHAR(255) DEFAULT 'default.jpg',
  PRIMARY KEY (id_berita)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE ulasan (
  id_ulasan INT(11) NOT NULL AUTO_INCREMENT,
  kategori_berita ENUM('Malam', 'Daerah', 'Pekaro') NOT NULL,
  judul_berita VARCHAR(255) NOT NULL,
  rating INT(1) NOT NULL,
  nama_user VARCHAR(100) DEFAULT 'Anonim',
  isi_ulasan_raw TEXT NOT NULL,
  isi_ulasan_clean TEXT DEFAULT NULL,
  status ENUM('Approved', 'Rejected', 'Spam', 'Duplikat') DEFAULT 'Approved',
  is_spam TINYINT(1) DEFAULT 0,
  is_kasar TINYINT(1) DEFAULT 0,
  skor_cosine FLOAT DEFAULT 0,
  waktu_kirim TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_ulasan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

