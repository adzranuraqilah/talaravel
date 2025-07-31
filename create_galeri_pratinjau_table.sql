-- Buat tabel galeri_pratinjau jika belum ada
CREATE TABLE IF NOT EXISTS `galeri_pratinjau` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) NOT NULL,
  `jenis_produk` varchar(255) NOT NULL,
  `foto_pratinjau` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 