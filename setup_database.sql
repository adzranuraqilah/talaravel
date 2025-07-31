-- Setup database untuk galeri_pratinjau
-- Jalankan query ini di database MySQL

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

-- Tambah beberapa data sample
INSERT INTO `galeri_pratinjau` (`nama_produk`, `jenis_produk`, `foto_pratinjau`, `created_at`, `updated_at`) VALUES
('Kaos Polos', 'kaos', 'galeri_pratinjau/kaos-sample.jpg', NOW(), NOW()),
('Hoodie Basic', 'hoodie', 'galeri_pratinjau/hoodie-sample.jpg', NOW(), NOW()),
('Kemeja Formal', 'kemeja', 'galeri_pratinjau/kemeja-sample.jpg', NOW(), NOW()),
('Jaket Denim', 'jaket', 'galeri_pratinjau/jaket-sample.jpg', NOW(), NOW()); 