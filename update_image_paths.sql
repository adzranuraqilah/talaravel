-- Update path gambar di database
UPDATE `galeri_pratinjau` 
SET `foto_pratinjau` = 'img/kaos-default.png' 
WHERE `jenis_produk` = 'kaos';

UPDATE `galeri_pratinjau` 
SET `foto_pratinjau` = 'img/hoodie-default.png' 
WHERE `jenis_produk` = 'hoodie';

UPDATE `galeri_pratinjau` 
SET `foto_pratinjau` = 'img/kemeja-default.png' 
WHERE `jenis_produk` = 'kemeja';

UPDATE `galeri_pratinjau` 
SET `foto_pratinjau` = 'img/jaket-default.png' 
WHERE `jenis_produk` = 'jaket'; 