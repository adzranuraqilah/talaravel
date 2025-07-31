-- Query untuk memperbaiki masalah tabel galeri_pratinjau
-- Jalankan query ini di database MySQL

-- 1. Pastikan tabel galeri_pratinjau ada dan strukturnya benar
CREATE TABLE IF NOT EXISTS `galeri_pratinjau` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) NOT NULL,
  `jenis_produk` varchar(255) NOT NULL,
  `foto_pratinjau` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Hapus data lama di galeri_pratinjau (jika ada)
DELETE FROM `galeri_pratinjau`;

-- 3. Copy data dari galeri_pratinjaus ke galeri_pratinjau dengan jenis_produk yang benar
INSERT INTO `galeri_pratinjau` (`nama_produk`, `jenis_produk`, `foto_pratinjau`, `created_at`, `updated_at`)
SELECT 
    `nama_produk`,
    CASE 
        WHEN `nama_produk` LIKE '%kaos%' OR `nama_produk` LIKE '%Kaos%' THEN 'kaos'
        WHEN `nama_produk` LIKE '%hoodie%' OR `nama_produk` LIKE '%Hoodie%' THEN 'hoodie'
        WHEN `nama_produk` LIKE '%kemeja%' OR `nama_produk` LIKE '%Kemeja%' THEN 'kemeja'
        WHEN `nama_produk` LIKE '%jaket%' OR `nama_produk` LIKE '%Jaket%' THEN 'jaket'
        ELSE 'kaos' -- default ke kaos jika tidak ada yang cocok
    END as `jenis_produk`,
    `foto_pratinjau`,
    `created_at`,
    `updated_at`
FROM `galeri_pratinjaus`;

-- 4. Tambah data sample jika tabel galeri_pratinjaus kosong
INSERT INTO `galeri_pratinjau` (`nama_produk`, `jenis_produk`, `foto_pratinjau`, `created_at`, `updated_at`)
SELECT * FROM (
    SELECT 'Kaos Polos' as nama_produk, 'kaos' as jenis_produk, 'galeri_pratinjau/kaos-sample.jpg' as foto_pratinjau, NOW() as created_at, NOW() as updated_at
    UNION ALL
    SELECT 'Hoodie Basic', 'hoodie', 'galeri_pratinjau/hoodie-sample.jpg', NOW(), NOW()
    UNION ALL
    SELECT 'Kemeja Formal', 'kemeja', 'galeri_pratinjau/kemeja-sample.jpg', NOW(), NOW()
    UNION ALL
    SELECT 'Jaket Denim', 'jaket', 'galeri_pratinjau/jaket-sample.jpg', NOW(), NOW()
) AS temp
WHERE NOT EXISTS (SELECT 1 FROM `galeri_pratinjau` WHERE `nama_produk` = temp.nama_produk);

-- 5. Tampilkan hasil
SELECT 
    id,
    nama_produk,
    jenis_produk,
    foto_pratinjau,
    created_at
FROM `galeri_pratinjau`
ORDER BY id; 