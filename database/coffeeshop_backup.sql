DROP TABLE IF EXISTS `bahan`;
CREATE TABLE `bahan` (
  `id_bahan` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_bahan` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 100,
  `satuan` varchar(50) NOT NULL DEFAULT 'porsi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_bahan`),
  UNIQUE KEY `bahan_nama_bahan_unique` (`nama_bahan`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('2', 'Espresso Shot', '98', 'porsi', '2026-07-24 17:47:39', '2026-08-08 08:33:40');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('3', 'Susu Segar', '98', 'porsi', '2026-07-24 17:47:39', '2026-08-08 08:33:40');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('4', 'Busa Susu (Foam)', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('5', 'Kopi Arabika', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('6', 'Kopi Robusta', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('7', 'Gula Aren', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('8', 'Es Batu', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('9', 'Air Panas', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('10', 'Coklat Bubuk', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('11', 'Matcha Bubuk', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('12', 'Taro Powder', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('13', 'Sirup Vanilla', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('14', 'Whipped Cream', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('15', 'Susu Kental Manis', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('16', 'Cream Cheese', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('17', 'Biskuit Graham', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('18', 'Gula Pasir', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('19', 'Telur', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('20', 'Tepung Terigu', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('21', 'Mentega', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('22', 'Coklat Batang', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('23', 'Keju', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('24', 'Daging Ayam', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('25', 'Roti Tawar', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('26', 'Selai', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('27', 'Buah Lemon', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('28', 'Teh Celup', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('29', 'Sirup Lychee', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('30', 'Sirup Peach', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('31', 'Air Mineral', '100', 'porsi', '2026-07-24 17:47:39', '2026-07-24 17:47:39');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('32', 'Oat Milk (Oatside)', '100', 'porsi', '2026-08-04 18:30:59', '2026-08-04 18:30:59');
INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES ('33', 'Sirup Karamel', '100', 'porsi', '2026-08-04 18:30:59', '2026-08-04 18:30:59');

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-abc@gmail.com|127.0.0.1', 'i:1;', '1786154071');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-abc@gmail.com|127.0.0.1:timer', 'i:1786154071;', '1786154071');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6', 'i:1;', '1786152958');
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('laravel-cache-livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer', 'i:1786152958;', '1786152958');

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `dataset_kopi`;
CREATE TABLE `dataset_kopi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `suhu_cuaca` enum('Dingin','Normal','Panas') NOT NULL,
  `kepadatan_pengunjung` enum('Sepi','Normal','Ramai') NOT NULL,
  `jam` enum('Pagi','Siang','Malam') NOT NULL,
  `rekomendasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('1', 'Dingin', 'Sepi', 'Pagi', 'Hot Latte', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('2', 'Dingin', 'Normal', 'Pagi', 'Hot Cappuccino', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('3', 'Panas', 'Ramai', 'Pagi', 'Iced Americano', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('4', 'Normal', 'Sepi', 'Pagi', 'Hot Americano', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('5', 'Panas', 'Ramai', 'Siang', 'Iced Caramel Macchiato', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('6', 'Panas', 'Normal', 'Siang', 'Iced Latte', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('7', 'Normal', 'Sepi', 'Siang', 'Cold Brew', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('8', 'Dingin', 'Ramai', 'Siang', 'Hot Mocha', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('9', 'Dingin', 'Sepi', 'Malam', 'Hot Chamomile Tea', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('10', 'Normal', 'Normal', 'Malam', 'Decaf Espresso', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('11', 'Panas', 'Ramai', 'Malam', 'Iced Matcha Latte', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('12', 'Dingin', 'Ramai', 'Malam', 'Hot Chocolate', '2026-06-30 11:51:18', '2026-06-30 11:51:18');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('13', 'Dingin', 'Sepi', 'Pagi', 'Hot Latte', '2026-06-30 11:51:32', '2026-06-30 11:51:32');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('14', 'Dingin', 'Normal', 'Pagi', 'Hot Cappuccino', '2026-06-30 11:51:32', '2026-06-30 11:51:32');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('15', 'Panas', 'Ramai', 'Pagi', 'Iced Americano', '2026-06-30 11:51:32', '2026-06-30 11:51:32');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('16', 'Normal', 'Sepi', 'Pagi', 'Hot Americano', '2026-06-30 11:51:32', '2026-06-30 11:51:32');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('17', 'Panas', 'Ramai', 'Siang', 'Iced Caramel Macchiato', '2026-06-30 11:51:32', '2026-06-30 11:51:32');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('18', 'Panas', 'Normal', 'Siang', 'Iced Latte', '2026-06-30 11:51:32', '2026-06-30 11:51:32');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('19', 'Normal', 'Sepi', 'Siang', 'Cold Brew', '2026-06-30 11:51:32', '2026-06-30 11:51:32');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('20', 'Dingin', 'Ramai', 'Siang', 'Hot Mocha', '2026-06-30 11:51:32', '2026-06-30 11:51:32');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('21', 'Dingin', 'Sepi', 'Malam', 'Hot Chamomile Tea', '2026-06-30 11:51:32', '2026-06-30 11:51:32');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('22', 'Normal', 'Normal', 'Malam', 'Decaf Espresso', '2026-06-30 11:51:32', '2026-06-30 11:51:32');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('23', 'Panas', 'Ramai', 'Malam', 'Iced Matcha Latte', '2026-06-30 11:51:32', '2026-06-30 11:51:32');
INSERT INTO `dataset_kopi` (`id`, `suhu_cuaca`, `kepadatan_pengunjung`, `jam`, `rekomendasi`, `created_at`, `updated_at`) VALUES ('24', 'Dingin', 'Ramai', 'Malam', 'Hot Chocolate', '2026-06-30 11:51:32', '2026-06-30 11:51:32');

DROP TABLE IF EXISTS `detail_pesanans`;
CREATE TABLE `detail_pesanans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pesanan_id` bigint(20) unsigned NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `harga_satuan` bigint(20) unsigned NOT NULL,
  `qty` tinyint(3) unsigned NOT NULL,
  `subtotal` bigint(20) unsigned NOT NULL,
  `suhu` varchar(10) DEFAULT NULL,
  `sugar_level` varchar(20) DEFAULT NULL,
  `ukuran` varchar(15) DEFAULT NULL,
  `jenis_susu` varchar(15) DEFAULT NULL,
  `topping` varchar(100) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_pesanans_pesanan_id_foreign` (`pesanan_id`),
  CONSTRAINT `detail_pesanans_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `detail_pesanans` (`id`, `pesanan_id`, `nama_menu`, `harga_satuan`, `qty`, `subtotal`, `suhu`, `sugar_level`, `ukuran`, `jenis_susu`, `topping`, `catatan`, `created_at`, `updated_at`) VALUES ('1', '1', 'Aura Ice Coffee Melts', '22000', '2', '44000', 'Ice', 'Normal Sugar', 'Reguler', 'Milk', NULL, 'Es sedikit aja ya', '2026-08-04 18:10:58', '2026-08-04 18:10:58');
INSERT INTO `detail_pesanans` (`id`, `pesanan_id`, `nama_menu`, `harga_satuan`, `qty`, `subtotal`, `suhu`, `sugar_level`, `ukuran`, `jenis_susu`, `topping`, `catatan`, `created_at`, `updated_at`) VALUES ('2', '2', 'Affogato', '28000', '1', '28000', 'Ice', 'Normal Sugar', 'Reguler', 'Milk', NULL, '', '2026-08-04 18:42:42', '2026-08-04 18:42:42');
INSERT INTO `detail_pesanans` (`id`, `pesanan_id`, `nama_menu`, `harga_satuan`, `qty`, `subtotal`, `suhu`, `sugar_level`, `ukuran`, `jenis_susu`, `topping`, `catatan`, `created_at`, `updated_at`) VALUES ('3', '3', 'Flat White', '25000', '2', '50000', 'Ice', 'Normal Sugar', 'Large', NULL, NULL, '', '2026-08-08 08:33:40', '2026-08-08 08:33:40');

DROP TABLE IF EXISTS `kategori_menu`;
CREATE TABLE `kategori_menu` (
  `id_kategori` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kategori_menu` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES ('1', 'Kopi', '2026-07-18 12:05:24', '2026-07-18 12:05:24');
INSERT INTO `kategori_menu` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES ('2', 'Non-Kopi', '2026-07-18 12:05:24', '2026-07-18 12:05:24');
INSERT INTO `kategori_menu` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES ('3', 'Makanan', '2026-07-18 12:05:24', '2026-07-18 12:05:24');
INSERT INTO `kategori_menu` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES ('4', 'Dessert', '2026-07-18 12:05:24', '2026-07-18 12:05:24');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id_menu` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_kategori` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`),
  KEY `menu_id_kategori_foreign` (`id_kategori`),
  CONSTRAINT `menu_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_menu` (`id_kategori`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('1', 'Affogato', '28000', 'affogato.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('2', 'Americano', '15000', 'americano.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('3', 'Cappuccino', '20000', 'cappuccino.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('4', 'Cold Brew', '22000', 'cold-brew.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('5', 'Es Kopi Susu Gula Aren', '18000', 'es-kopi-susu-gula-aren.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('6', 'Espresso', '14000', 'espresso.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('7', 'Flat White', '21000', 'flat-white.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('8', 'Iced Americano', '16000', 'iced-americano.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('9', 'Iced Latte', '20000', 'iced-latte.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('10', 'Latte', '20000', 'latte.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('11', 'Macchiato', '19000', 'macchiato.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('12', 'Mocha', '21000', 'mocha.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('13', 'Vietnamese Coffee', '19000', 'vietnamese-coffee.webp', '1', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('14', 'Chocolate', '18000', 'chocolate.webp', '2', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('15', 'Green Tea', '17000', 'green-tea.webp', '2', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('16', 'Lemon Tea', '15000', 'lemon-tea.webp', '2', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('17', 'Lychee Tea', '16000', 'lychee-tea.webp', '2', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('18', 'Matcha Latte', '22000', 'matcha-latte.webp', '2', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('19', 'Mineral Water', '8000', 'mineral-water.webp', '2', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('20', 'Peach Tea', '16000', 'peach-tea.webp', '2', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('21', 'Red Velvet Latte', '22000', 'red-velvet-latte.webp', '2', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('22', 'Taro Latte', '22000', 'taro-latte.webp', '2', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('23', 'Tea Latte', '18000', 'tea-latte.webp', '2', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('24', 'Burger', '30000', 'burger.webp', '3', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('25', 'Chicken Wings', '28000', 'chicken-wings.webp', '3', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('26', 'French Fries', '18000', 'french-fries.webp', '3', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('27', 'Pain au Chocolat', '20000', 'pain-au-chocolat.webp', '3', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('28', 'Sandwich', '25000', 'gourmet-sandwich.webp', '3', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('29', 'Spaghetti', '32000', 'spaghetti-bolognese.webp', '3', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('30', 'Toast', '15000', 'artisanal-toast.webp', '3', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('31', 'Brownies', '17000', 'brownies.webp', '4', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('32', 'Cheesecake', '25000', 'cheesecake.webp', '4', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('33', 'Cinnamon Roll', '18000', 'cinnamon-roll.webp', '4', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('34', 'Cookies', '12000', 'cookies.webp', '4', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('35', 'Croissant', '16000', 'croissant.webp', '4', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('36', 'Donut', '12000', 'donut.webp', '4', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('37', 'Muffin', '15000', 'muffin.webp', '4', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('38', 'Red Velvet Cake', '22000', 'red-velvet-cake.webp', '4', '2026-07-18 12:05:24', '2026-08-04 19:07:55');
INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `gambar`, `id_kategori`, `created_at`, `updated_at`) VALUES ('39', 'Tiramisu', '27000', 'tiramisu.webp', '4', '2026-07-18 12:05:24', '2026-08-04 19:07:55');

DROP TABLE IF EXISTS `menu_bahan`;
CREATE TABLE `menu_bahan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_menu` bigint(20) unsigned NOT NULL,
  `id_bahan` bigint(20) unsigned NOT NULL,
  `jumlah_dibutuhkan` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menu_bahan_id_menu_id_bahan_unique` (`id_menu`,`id_bahan`),
  KEY `menu_bahan_id_bahan_foreign` (`id_bahan`),
  CONSTRAINT `menu_bahan_id_bahan_foreign` FOREIGN KEY (`id_bahan`) REFERENCES `bahan` (`id_bahan`) ON DELETE CASCADE,
  CONSTRAINT `menu_bahan_id_menu_foreign` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('1', '3', '4', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('2', '3', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('3', '3', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('4', '10', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('5', '10', '13', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('6', '10', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('7', '2', '9', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('8', '2', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('10', '9', '8', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('11', '9', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('12', '9', '13', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('13', '9', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('14', '8', '9', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('15', '8', '8', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('16', '8', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('17', '4', '31', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('18', '4', '8', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('19', '4', '5', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('20', '7', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('21', '7', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('22', '11', '4', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('23', '11', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('24', '11', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('25', '12', '10', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('26', '12', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('27', '12', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('29', '1', '8', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('30', '1', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('31', '1', '15', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('32', '13', '8', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('33', '13', '6', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('34', '13', '15', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('35', '5', '8', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('36', '5', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('37', '5', '7', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('38', '5', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('39', '18', '8', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('40', '18', '11', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('41', '18', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('42', '22', '8', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('43', '22', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('44', '22', '12', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('45', '21', '10', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('46', '21', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('47', '21', '13', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('48', '21', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('49', '23', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('50', '23', '28', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('51', '14', '10', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('52', '14', '3', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('54', '15', '9', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('55', '15', '11', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('56', '16', '9', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('57', '16', '27', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('58', '16', '18', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('59', '16', '28', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('60', '17', '8', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('61', '17', '29', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('62', '17', '28', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('63', '20', '8', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('64', '20', '30', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('65', '20', '28', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('66', '19', '31', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('67', '32', '17', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('68', '32', '16', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('69', '32', '18', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('71', '38', '10', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('72', '38', '18', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('73', '38', '21', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('74', '38', '19', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('75', '38', '20', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('76', '39', '10', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('77', '39', '16', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('78', '39', '18', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('79', '39', '5', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('80', '39', '19', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('81', '31', '22', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('82', '31', '18', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('83', '31', '21', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('84', '31', '19', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('85', '31', '20', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('86', '37', '18', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('87', '37', '21', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('88', '37', '19', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('89', '37', '20', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('90', '33', '18', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('91', '33', '21', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('92', '33', '19', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('93', '33', '20', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('94', '35', '21', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('95', '35', '19', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('96', '35', '20', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('97', '27', '22', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('98', '27', '21', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('99', '27', '20', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('100', '36', '18', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('101', '36', '21', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('102', '36', '19', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('103', '36', '20', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('104', '34', '22', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('105', '34', '18', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('106', '34', '21', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('107', '34', '19', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('108', '34', '20', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('109', '30', '21', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('110', '30', '25', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('111', '30', '26', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('112', '28', '23', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('113', '28', '21', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('114', '28', '25', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('115', '28', '19', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('116', '24', '24', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('117', '24', '23', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('118', '24', '25', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('119', '24', '19', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('120', '26', '18', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('121', '26', '20', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('122', '25', '24', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('123', '25', '21', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('124', '25', '20', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('125', '29', '24', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('126', '29', '23', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('127', '29', '20', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('129', '6', '5', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('135', '6', '2', '1', NULL, NULL);
INSERT INTO `menu_bahan` (`id`, `id_menu`, `id_bahan`, `jumlah_dibutuhkan`, `created_at`, `updated_at`) VALUES ('154', '38', '16', '1', NULL, NULL);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '2026_06_30_112603_create_dataset_kopi_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '2026_06_30_131422_create_sessions_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '2026_06_30_202303_create_cache_table', '3');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2026_07_05_171129_create_kategori_menu_table', '4');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2026_07_05_171130_create_menu_table', '4');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2026_07_05_192809_create_users_table', '5');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2026_07_24_173227_create_bahan_table', '6');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2026_07_24_173229_create_menu_bahan_table', '6');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('9', '2026_08_01_085423_add_role_to_users_table', '7');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('10', '2026_08_01_090033_add_kasir_role_to_users_table', '8');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('11', '2026_08_04_175832_create_pesanans_table', '9');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('12', '2026_08_04_175834_create_detail_pesanans_table', '9');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('13', '2026_08_05_150150_add_cash_to_metode_bayar_pesanans_table', '10');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('14', '2026_08_08_083000_add_stok_to_bahan_and_menu_bahan', '10');

DROP TABLE IF EXISTS `pesanans`;
CREATE TABLE `pesanans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_pesanan` varchar(20) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `nomor_hp` varchar(20) DEFAULT NULL,
  `nomor_meja` int(11) DEFAULT NULL,
  `status` enum('menunggu','diproses','selesai','dibatalkan') NOT NULL DEFAULT 'menunggu',
  `metode_bayar` enum('qris','cash') NOT NULL DEFAULT 'qris',
  `subtotal` bigint(20) unsigned NOT NULL,
  `ppn` bigint(20) unsigned NOT NULL,
  `diskon` bigint(20) unsigned NOT NULL DEFAULT 0,
  `total_akhir` bigint(20) unsigned NOT NULL,
  `persen_diskon` tinyint(4) NOT NULL DEFAULT 0,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pesanans_kode_pesanan_unique` (`kode_pesanan`),
  KEY `pesanans_user_id_foreign` (`user_id`),
  CONSTRAINT `pesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pesanans` (`id`, `kode_pesanan`, `user_id`, `nama_pelanggan`, `nomor_hp`, `nomor_meja`, `status`, `metode_bayar`, `subtotal`, `ppn`, `diskon`, `total_akhir`, `persen_diskon`, `catatan`, `created_at`, `updated_at`) VALUES ('1', 'ORD-20260804-0001', NULL, 'Test Pelanggan', '08123456789', '5', 'menunggu', 'qris', '44000', '4400', '0', '48400', '0', NULL, '2026-08-04 18:10:58', '2026-08-04 18:10:58');
INSERT INTO `pesanans` (`id`, `kode_pesanan`, `user_id`, `nama_pelanggan`, `nomor_hp`, `nomor_meja`, `status`, `metode_bayar`, `subtotal`, `ppn`, `diskon`, `total_akhir`, `persen_diskon`, `catatan`, `created_at`, `updated_at`) VALUES ('2', 'ORD-20260804-0002', NULL, 'Test', '0888', '2', 'diproses', 'qris', '28000', '2800', '0', '30800', '0', NULL, '2026-08-04 18:42:42', '2026-08-04 18:49:07');
INSERT INTO `pesanans` (`id`, `kode_pesanan`, `user_id`, `nama_pelanggan`, `nomor_hp`, `nomor_meja`, `status`, `metode_bayar`, `subtotal`, `ppn`, `diskon`, `total_akhir`, `persen_diskon`, `catatan`, `created_at`, `updated_at`) VALUES ('3', 'ORD-20260808-0001', NULL, 'Miguel', '088', '1', 'selesai', 'cash', '50000', '5000', '0', '55000', '0', NULL, '2026-08-08 08:33:40', '2026-08-08 08:34:44');

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('dqEJFyHUdzyBXkcT7qxqKaEkFCRTWKR9fjeZmrPM', '6', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ6OGVvZ0F5VHNTWGF4bmw1b3BiRTRCcXFKMkhKREVpZVZ4Yk9oZUVLIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImNvZmZlZXNob3AuaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjZ9', '1786154252');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('IjEgRA3up9T0j810L4KpZFMBCxEDguonUsVLgitW', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJEY250N0RrbGlRSTJTYll0bmpES0FQdTk0R2RMODd6Q0lrNERuQUNmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJjb2ZmZWVzaG9wLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', '1786152876');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('rf5qHXdAnhQW68Ef7DAfSjkzcfOCALwBFETCH39E', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI1WjlGbVhSNFlsdUxXT1FBZkMwdTJLWHZ1MzVHOUVHUHV6ZkJqNTFtIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hZG1pblwvbGFwb3Jhbi1wZW5qdWFsYW4iLCJyb3V0ZSI6ImZpbGFtZW50LmFkbWluLnBhZ2VzLmxhcG9yYW4tcGVuanVhbGFuIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwidXJsIjpbXSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiNWVhMWRkOTI2NzQ5ZTc2N2I1ZjA5YzAyMTg2YTU4OWU5YmI1YjU2NTI4ZDEzYTQ1NzU3YTQ4NjlkMTA1ZTFmOCIsInRhYmxlcyI6eyIxMDZlNTc3OTM5MGJhZWUyMzk3Y2QxM2VkZDc4NzMwMF9jb2x1bW5zIjpbeyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImdhbWJhciIsImxhYmVsIjoiR2FtYmFyIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6Im5hbWFfbWVudSIsImxhYmVsIjoiTmFtYSBNZW51IiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImthdGVnb3JpLm5hbWFfa2F0ZWdvcmkiLCJsYWJlbCI6IkthdGVnb3JpIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImhhcmdhIiwibGFiZWwiOiJIYXJnYSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJiYWhhbnNfY291bnQiLCJsYWJlbCI6IkptbCBCYWhhbiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XSwiYTM3OGU2YWE1ODMzNDJjZTgyMGYzYTYzMDU1MjZiODlfY29sdW1ucyI6W3sidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJrb2RlX3Blc2FuYW4iLCJsYWJlbCI6IktvZGUgUGVzYW5hbiIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJuYW1hX3BlbGFuZ2dhbiIsImxhYmVsIjoiUGVsYW5nZ2FuIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6ImRldGFpbHNfY291bnQiLCJsYWJlbCI6Ikl0ZW1zIiwiaXNIaWRkZW4iOmZhbHNlLCJpc1RvZ2dsZWQiOnRydWUsImlzVG9nZ2xlYWJsZSI6ZmFsc2UsImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI6bnVsbH0seyJ0eXBlIjoiY29sdW1uIiwibmFtZSI6InRvdGFsX2FraGlyIiwibGFiZWwiOiJUb3RhbCIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJwZXJzZW5fZGlza29uIiwibGFiZWwiOiJEaXNrb24iLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoic3RhdHVzIiwibGFiZWwiOiJTdGF0dXMiLCJpc0hpZGRlbiI6ZmFsc2UsImlzVG9nZ2xlZCI6dHJ1ZSwiaXNUb2dnbGVhYmxlIjpmYWxzZSwiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjpudWxsfSx7InR5cGUiOiJjb2x1bW4iLCJuYW1lIjoibWV0b2RlX2JheWFyIiwibGFiZWwiOiJCYXlhciIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9LHsidHlwZSI6ImNvbHVtbiIsIm5hbWUiOiJjcmVhdGVkX2F0IiwibGFiZWwiOiJXYWt0dSIsImlzSGlkZGVuIjpmYWxzZSwiaXNUb2dnbGVkIjp0cnVlLCJpc1RvZ2dsZWFibGUiOmZhbHNlLCJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiOm51bGx9XX19', '1786151744');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('X5WDfrMYBKjgV7qh6CdunKEAExCbnpgnfVdt5D02', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJzV214MFZubGhPRk1lMkJ3TzJudWJ5S0pVRXJvVzc4djVrUVNjUmRHIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvbG9naW4iLCJyb3V0ZSI6ImZpbGFtZW50LmFkbWluLmF1dGgubG9naW4ifX0=', '1786152892');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','kasir','user') NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `google_id`, `avatar`, `created_at`, `updated_at`) VALUES ('1', 'Admin', 'superadmin@coffeeshop.com', 'admin', NULL, '$2y$12$WUlTCwr4qOFKDBJxTc5VFeFW.9kUywEADX4rSQ1qxCLBcd0kA8O9G', NULL, NULL, NULL, '2026-07-24 16:36:23', '2026-08-01 09:23:18');
INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `google_id`, `avatar`, `created_at`, `updated_at`) VALUES ('2', 'Admin Coffeeshop', 'admin@coffeeshop.com', 'admin', NULL, '$2y$12$9TU/oKKBca7DqaGl1yG.reeTpjQrXiMjkqK3sbtYFfXy4PIf7KcZe', NULL, NULL, NULL, '2026-08-01 08:55:36', '2026-08-01 08:55:36');
INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `google_id`, `avatar`, `created_at`, `updated_at`) VALUES ('3', 'Pelanggan Demo', 'user@coffeeshop.com', 'user', NULL, '$2y$12$OcDulDPe6Bf0L1AC9HoIp.X/1m2ilNCBPKHt.LnrUhpKwIJ9bTraS', NULL, NULL, NULL, '2026-08-01 08:55:36', '2026-08-01 08:55:36');
INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `google_id`, `avatar`, `created_at`, `updated_at`) VALUES ('4', 'Kasir 1', 'kasir@coffeeshop.com', 'kasir', NULL, '$2y$12$2RHG7Hxu0sRLnkVskit.fuBOex.E5/4UtEiyh/tMUZjTH69QAgb2K', NULL, NULL, NULL, '2026-08-01 09:01:49', '2026-08-01 09:01:49');
INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `google_id`, `avatar`, `created_at`, `updated_at`) VALUES ('6', 'Manuk', 'manuk@gmail.com', 'user', NULL, '$2y$12$Zp0oH6wWFdyK3qDMPY5pDe3dqUXKa9GtqDJ.10rM5mNkEpcFqL0HW', 'sX9svn3GydE13ftwoNpzNL5Oih9Cj7gekuxRVv3jIbNkxlHWkskATUQpR5rW', NULL, NULL, '2026-08-08 08:57:30', '2026-08-08 08:57:30');

