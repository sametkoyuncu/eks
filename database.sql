-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 16 Eyl 2019, 22:55:13
-- Sunucu sürümü: 10.1.34-MariaDB
-- PHP Sürümü: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `eks`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

CREATE TABLE `ayar` (
  `ayar_id` int(1) NOT NULL,
  `ayar_sitefavicon` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_sitelogo` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_siteadresi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_sitebaslik` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_siteaciklama` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_anahtarkelime` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_recaptcha` varchar(250) COLLATE utf8_turkish_ci DEFAULT '0',
  `ayar_analytics` varchar(50) COLLATE utf8_turkish_ci DEFAULT '0',
  `ayar_smtphost` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtpkullanici` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtpparola` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtpport` varchar(4) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_footeryazi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_nedenbaslik` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_nedenaltbaslik` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_ozelliklerbaslik` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_ozellikleraltbaslik` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_iletisimbaslik` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_iletisimaltbaslik` varchar(150) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayar`
--

INSERT INTO `ayar` (`ayar_id`, `ayar_sitefavicon`, `ayar_sitelogo`, `ayar_siteadresi`, `ayar_sitebaslik`, `ayar_siteaciklama`, `ayar_anahtarkelime`, `ayar_recaptcha`, `ayar_analytics`, `ayar_smtphost`, `ayar_smtpkullanici`, `ayar_smtpparola`, `ayar_smtpport`, `ayar_footeryazi`, `ayar_nedenbaslik`, `ayar_nedenaltbaslik`, `ayar_ozelliklerbaslik`, `ayar_ozellikleraltbaslik`, `ayar_iletisimbaslik`, `ayar_iletisimaltbaslik`) VALUES
(1, '../../favicon.png', 'images/logo-yatay.svg', 'http://localhost/surutakip/', 'Çifftliğim Takip', 'Çiftliğinizin kayıtlarını tutmanın en kolay yolu!', 'sürü takip, çiftlik takip, sürü yönetimi, çiftlik yönetimi,çiftlik kayıt, sürü kayıt', '6LfcECAUAAAAAPiRhbvWlOqh1lW8jxwGuxYsU8Ov', '', 'mail.siteadiniz.com', 'eposta@siteadiniz.com', 'parolanız', '25', '2017 - ciftligimtakip.com', 'NEDEN ÇİFTLİĞİM TAKİP?', 'Veritabanından çekilen alt başlık.', 'SİSTEMİN ÖZELLİKLERİ', 'Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz.', 'İLETİŞİM', 'Yaygın inancın tersine, Lorem Ipsum rastgele sözcüklerden oluşmaz.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `birim`
--

CREATE TABLE `birim` (
  `birim_id` int(11) NOT NULL,
  `birim_adi` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `birim_aciklama` varchar(1000) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `birim`
--

INSERT INTO `birim` (`birim_id`, `birim_adi`, `birim_aciklama`) VALUES
(1, 'Balya', 'Bir ticaret malının keten bezi ya da benzeri bir gereçle sarılıp çemberlenerek ya da metal tellerle bağlanarak denk durumuna getirilmiş biçimi.'),
(2, 'Kilogram', ''),
(3, 'Çuval', ''),
(4, 'Adet', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hatirlatici`
--

CREATE TABLE `hatirlatici` (
  `hatirlatici_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `hatirlatici_referans` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `hatirlatici_kayittarihi` datetime DEFAULT CURRENT_TIMESTAMP,
  `hatirlatici_aciklama` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `hatirlatici_tarih` datetime DEFAULT NULL,
  `hatirlatici_durum` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hatirlatici`
--

INSERT INTO `hatirlatici` (`hatirlatici_id`, `kullanici_id`, `hatirlatici_referans`, `hatirlatici_kayittarihi`, `hatirlatici_aciklama`, `hatirlatici_tarih`, `hatirlatici_durum`) VALUES
(69, 5, 'koyun_tohum_id_2', '2019-09-07 23:49:30', 'Karagöz - Doğum (Hata payı 5 gün)', '2020-01-11 00:00:00', 1),
(70, 5, 'koyun_tohum_id_3', '2019-09-07 23:49:49', 'Karagöz Kuzu 2 - Doğum (Hata payı 5 gün)', '2020-01-20 00:00:00', 1),
(71, 5, 'koyun_tohum_id_4', '2019-09-07 23:50:13', 'Kara Koyun - Doğum (Hata payı 5 gün)', '2019-12-19 00:00:00', 1),
(72, 5, 'koyun_tohum_id_5', '2019-09-07 23:51:02', 'Kara Kuzu - Doğum (Hata payı 5 gün)', '2019-10-27 00:00:00', 1),
(73, 5, 'koyun_tohum_id_6', '2019-09-07 23:51:36', 'Kocakarı Kuzu - Doğum (Hata payı 5 gün)', '2020-01-19 00:00:00', 1),
(74, 5, 'koyun_tohum_id_7', '2019-09-07 23:52:05', 'Sakız Kuzu - Doğum (Hata payı 5 gün)', '2020-01-19 00:00:00', 1),
(76, 5, 'inek_tohum_id_11', '2019-09-09 11:49:13', 'Zümrüt - Doğum (Hata payı 5 gün)', '2020-04-30 00:00:00', 1),
(77, 5, 'inek_tohum_id_12', '2019-09-09 11:49:30', 'Çiçek - Doğum (Hata payı 5 gün)', '2020-05-12 00:00:00', 1),
(78, 5, 'koyun_tohum_id_9', '2019-09-10 13:29:10', 'R5 - Alaca Kulak - Doğum (Hata payı 5 gün)', '2020-02-07 00:00:00', 1),
(79, 5, 'koyun_tohum_id_10', '2019-09-10 13:32:00', 'Sakız Şişek - Doğum (Hata payı 5 gün)', '2020-01-21 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hayvan`
--

CREATE TABLE `hayvan` (
  `hayvan_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `hayvan_kupeno` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `hayvan_adi` varchar(25) COLLATE utf8_turkish_ci DEFAULT NULL,
  `hayvan_irk` int(2) DEFAULT NULL,
  `hayvan_cinsiyet` int(1) DEFAULT NULL,
  `hayvan_kayittarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hayvan_dogumtarihi` date DEFAULT NULL,
  `hayvan_olumtarihi` date DEFAULT NULL,
  `hayvan_alistarihi` date DEFAULT NULL,
  `hayvan_satistarihi` date DEFAULT NULL,
  `hayvan_alisfiyati` decimal(10,2) DEFAULT NULL,
  `hayvan_satisfiyati` decimal(10,2) DEFAULT NULL,
  `hayvan_rasyon` int(11) DEFAULT NULL,
  `hayvan_bakim` int(11) DEFAULT NULL,
  `hayvan_not` int(11) DEFAULT NULL,
  `ana_id` int(1) DEFAULT NULL,
  `buzagi_goster` int(1) DEFAULT '0',
  `hayvan_durum` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hayvan`
--

INSERT INTO `hayvan` (`hayvan_id`, `kullanici_id`, `hayvan_kupeno`, `hayvan_adi`, `hayvan_irk`, `hayvan_cinsiyet`, `hayvan_kayittarihi`, `hayvan_dogumtarihi`, `hayvan_olumtarihi`, `hayvan_alistarihi`, `hayvan_satistarihi`, `hayvan_alisfiyati`, `hayvan_satisfiyati`, `hayvan_rasyon`, `hayvan_bakim`, `hayvan_not`, `ana_id`, `buzagi_goster`, `hayvan_durum`) VALUES
(29, 5, 'TR', 'Emine', 1, 0, '2018-12-12 20:19:31', '2014-12-12', NULL, '2018-12-12', NULL, '0.00', '9500.00', NULL, NULL, NULL, NULL, 0, 2),
(30, 5, 'TR', 'Zümrüt', 1, 0, '2018-12-12 20:21:18', '2014-12-12', NULL, '2018-12-12', NULL, '0.00', NULL, NULL, NULL, NULL, NULL, 0, 1),
(31, 5, 'TR', 'Sümbül', 1, 0, '2018-12-12 20:21:55', '2017-12-12', NULL, '2018-12-12', NULL, '0.00', '7500.00', NULL, NULL, NULL, NULL, 0, 2),
(32, 5, 'TR', 'Akbaş', 1, 0, '2018-12-12 20:22:20', '2015-12-12', NULL, '2018-12-12', NULL, '0.00', '5000.00', NULL, NULL, NULL, NULL, 0, 2),
(33, 5, 'TR', 'Cingöz', 1, 1, '2018-12-12 20:25:39', '2018-02-16', NULL, NULL, NULL, '0.00', '7000.00', NULL, NULL, NULL, 30, 1, 2),
(34, 5, 'TR', 'Tospiş', 1, 1, '2018-12-12 20:26:09', '2017-12-27', NULL, NULL, NULL, '0.00', '7000.00', NULL, NULL, NULL, 31, 1, 2),
(35, 5, 'TR', 'Umut', 4, 1, '2018-12-12 20:28:03', '2018-04-11', NULL, NULL, NULL, '0.00', '7000.00', NULL, NULL, NULL, 32, 1, 2),
(36, 5, 'TR', 'Gülizar', 1, 0, '2018-12-12 20:28:28', '2018-06-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, 1, 1),
(37, 5, 'TR', 'Ceylan', 4, 0, '2018-12-12 20:33:05', '2015-12-12', NULL, '2018-12-12', NULL, '0.00', NULL, NULL, NULL, NULL, NULL, 0, 2),
(38, 5, 'TR', 'Bulut', 4, 1, '2018-12-12 20:33:45', '2018-01-01', NULL, NULL, NULL, '0.00', '7000.00', NULL, NULL, NULL, 37, 1, 2),
(39, 5, 'TR', 'Karakız', 2, 0, '2018-12-12 20:34:34', '2015-12-12', NULL, '2018-12-12', NULL, '0.00', NULL, NULL, NULL, NULL, NULL, 0, 2),
(40, 5, 'TR', 'Sarıkız', 3, 0, '2018-12-12 20:35:22', '2015-12-12', NULL, '2018-12-12', NULL, '0.00', NULL, NULL, NULL, NULL, NULL, 0, 2),
(41, 5, 'TR', 'Nokta', 3, 0, '2018-12-12 20:36:25', '2018-05-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 40, 1, 1),
(42, 5, 'TR', 'Pörtlek', 4, 1, '2018-12-12 20:37:00', '2018-02-22', NULL, NULL, NULL, '0.00', '7000.00', NULL, NULL, NULL, 39, 1, 2),
(43, 5, 'TR', 'Çiçek', 1, 0, '2018-12-12 20:37:45', '2016-11-30', NULL, '2018-12-12', NULL, '0.00', NULL, NULL, NULL, NULL, NULL, 0, 1),
(44, 5, 'TR', 'Kadife', 1, 0, '2018-12-12 20:39:08', '2016-11-01', NULL, '2018-12-12', NULL, '0.00', NULL, NULL, NULL, NULL, NULL, 0, 1),
(45, 5, 'TR', 'Reis', 1, 1, '2018-12-12 20:39:36', '2017-02-28', NULL, '2018-12-12', NULL, '0.00', '16100.00', NULL, NULL, NULL, NULL, 0, 2),
(46, 5, 'TR', 'Cabbar', 2, 1, '2018-12-12 20:39:57', '2017-05-14', NULL, '2018-12-12', NULL, '0.00', '12250.00', NULL, NULL, NULL, NULL, 0, 2),
(47, 5, 'TR', 'Küçük Montafon', 2, 1, '2018-12-12 20:41:27', '2016-12-12', NULL, '2018-12-12', NULL, '0.00', '11750.00', NULL, NULL, NULL, NULL, 0, 2),
(48, 5, 'TR', 'Büyük Montafon', 2, 1, '2018-12-12 20:41:48', '2016-12-12', NULL, '2018-12-12', NULL, '0.00', '14350.00', NULL, NULL, NULL, NULL, 0, 2),
(49, 5, 'TR', 'Kara Düve', 4, 0, '2018-12-12 20:42:33', '2017-06-30', NULL, '2018-12-12', NULL, '0.00', NULL, NULL, NULL, NULL, NULL, 0, 1),
(50, 5, 'TR', 'Kabakoz Akbaş', 4, 1, '2018-12-12 20:43:45', '2017-08-12', NULL, '2018-12-12', NULL, '0.00', '7000.00', NULL, NULL, NULL, NULL, 0, 2),
(51, 5, 'TR', 'Kabakoz', 4, 1, '2018-12-12 20:44:11', '2017-08-12', NULL, '2018-12-12', NULL, '0.00', '7000.00', NULL, NULL, NULL, NULL, 0, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hisse`
--

CREATE TABLE `hisse` (
  `hisse_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `hayvan_id` int(11) DEFAULT NULL,
  `hisse_alici` varchar(25) COLLATE utf8_turkish_ci DEFAULT 'Ad Soyad',
  `hisse_alici_tel` varchar(25) COLLATE utf8_turkish_ci DEFAULT '05551234567',
  `hayvan_kayittarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hisse_odenen` decimal(10,2) DEFAULT '0.00',
  `hisse_toplam` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hisse`
--

INSERT INTO `hisse` (`hisse_id`, `kullanici_id`, `hayvan_id`, `hisse_alici`, `hisse_alici_tel`, `hayvan_kayittarihi`, `hisse_odenen`, `hisse_toplam`) VALUES
(1, 5, 1, 'Ad Soyad', '05551234567', '2018-12-12 14:06:58', '0.00', '1500.00'),
(2, 5, 1, 'Ad Soyad', '05551234567', '2018-12-12 14:06:58', '0.00', '1500.00'),
(3, 5, 1, 'Ad Soyad', '05551234567', '2018-12-12 14:06:58', '0.00', '1500.00'),
(4, 5, 1, 'Ad Soyad', '05551234567', '2018-12-12 14:06:58', '0.00', '1500.00'),
(5, 5, 1, 'Ad Soyad', '05551234567', '2018-12-12 14:06:58', '0.00', '1500.00'),
(6, 5, 1, 'Ad Soyad', '05551234567', '2018-12-12 14:06:58', '0.00', '1500.00'),
(7, 5, 2, 'Ad Soyad', '05551234567', '2018-12-12 14:09:12', '0.00', '1500.00'),
(8, 5, 2, 'Ad Soyad', '05551234567', '2018-12-12 14:09:12', '0.00', '1500.00'),
(9, 5, 2, 'Ad Soyad', '05551234567', '2018-12-12 14:09:12', '0.00', '1500.00'),
(10, 5, 2, 'Ad Soyad', '05551234567', '2018-12-12 14:09:12', '0.00', '1500.00'),
(11, 5, 2, 'Ad Soyad', '05551234567', '2018-12-12 14:09:12', '0.00', '1500.00'),
(12, 5, 2, 'Ad Soyad', '05551234567', '2018-12-12 14:09:12', '0.00', '1500.00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `inek_tohum`
--

CREATE TABLE `inek_tohum` (
  `inek_tohum_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `hayvan_id` int(11) NOT NULL,
  `inek_tohum_irk` int(2) DEFAULT NULL,
  `hayvan_kayittarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hayvan_tohumtarihi` date DEFAULT NULL,
  `inek_tohum_not` varchar(1000) COLLATE utf8_turkish_ci DEFAULT 'Açıklama yok.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `inek_tohum`
--

INSERT INTO `inek_tohum` (`inek_tohum_id`, `kullanici_id`, `hayvan_id`, `inek_tohum_irk`, `hayvan_kayittarihi`, `hayvan_tohumtarihi`, `inek_tohum_not`) VALUES
(11, 5, 30, 1, '2019-09-09 11:49:13', '2019-07-20', ''),
(12, 5, 43, 1, '2019-09-09 11:49:30', '2019-08-01', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `irk`
--

CREATE TABLE `irk` (
  `irk_id` int(2) NOT NULL,
  `irk_adi` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `irk_ozellikleri` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `irk`
--

INSERT INTO `irk` (`irk_id`, `irk_adi`, `irk_ozellikleri`) VALUES
(1, 'Simental', NULL),
(2, 'Montafon', NULL),
(3, 'Cersey', NULL),
(4, 'Diğer', NULL),
(100, 'Yerli Koyun', NULL),
(101, 'Sakız', NULL),
(102, 'Pırlak', NULL),
(201, 'Sakız M', NULL),
(202, 'Merinos M', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `irk_koyun`
--

CREATE TABLE `irk_koyun` (
  `irk_id` int(2) NOT NULL,
  `irk_adi` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `irk_ozellikleri` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `irk_koyun`
--

INSERT INTO `irk_koyun` (`irk_id`, `irk_adi`, `irk_ozellikleri`) VALUES
(100, 'Yerli', NULL),
(101, 'Sakız', NULL),
(102, 'Pırlak', NULL),
(200, 'Diğer', NULL),
(201, 'Sakız M', NULL),
(202, 'Merinos M', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `isler`
--

CREATE TABLE `isler` (
  `isler_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `isler_kayittarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isler_aciklama` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `isler_tarih` date DEFAULT NULL,
  `isler_durum` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `isler`
--

INSERT INTO `isler` (`isler_id`, `kullanici_id`, `isler_kayittarihi`, `isler_aciklama`, `isler_tarih`, `isler_durum`) VALUES
(52, 5, '2018-12-12 00:03:18', 'İnek tohum ve yapılacaklar düzenlendiğinde yaklaşan olaylarda tarihi güncelle', '2018-12-14', 0),
(53, 5, '2018-12-12 00:04:19', 'Anasayfada ki yaklaşan olaylar kısmında karakter sınırı koy', '2018-12-13', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `koyun`
--

CREATE TABLE `koyun` (
  `koyun_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `koyun_kupeno` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `koyun_kupeno_isletme` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL,
  `koyun_adi` varchar(25) COLLATE utf8_turkish_ci DEFAULT NULL,
  `koyun_irk` int(2) DEFAULT NULL,
  `koyun_cinsiyet` int(1) DEFAULT NULL,
  `koyun_kayittarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `koyun_dogumtarihi` date DEFAULT NULL,
  `koyun_olumtarihi` date DEFAULT NULL,
  `koyun_alistarihi` date DEFAULT NULL,
  `koyun_satistarihi` date DEFAULT NULL,
  `koyun_alisfiyati` decimal(10,2) DEFAULT NULL,
  `koyun_satisfiyati` decimal(10,2) DEFAULT NULL,
  `koyun_rasyon` int(11) DEFAULT NULL,
  `koyun_bakim` int(11) DEFAULT NULL,
  `koyun_not` varchar(256) COLLATE utf8_turkish_ci DEFAULT NULL,
  `ana_id` int(1) DEFAULT '0',
  `baba_id` int(1) DEFAULT '0',
  `koyun_durum` int(11) DEFAULT '1',
  `koyun_nitelik` int(2) DEFAULT '1',
  `koyun_padok` int(11) DEFAULT '1',
  `koyun_kardesdurumu` int(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `koyun`
--

INSERT INTO `koyun` (`koyun_id`, `kullanici_id`, `koyun_kupeno`, `koyun_kupeno_isletme`, `koyun_adi`, `koyun_irk`, `koyun_cinsiyet`, `koyun_kayittarihi`, `koyun_dogumtarihi`, `koyun_olumtarihi`, `koyun_alistarihi`, `koyun_satistarihi`, `koyun_alisfiyati`, `koyun_satisfiyati`, `koyun_rasyon`, `koyun_bakim`, `koyun_not`, `ana_id`, `baba_id`, `koyun_durum`, `koyun_nitelik`, `koyun_padok`, `koyun_kardesdurumu`) VALUES
(1, 5, 'TR', '1', 'Karagöz', 201, 0, '2019-08-30 23:56:36', '2019-01-26', NULL, '2019-01-26', NULL, '500.00', '0.00', NULL, NULL, 'İkiz anası, pırlaka olabilir', NULL, NULL, 1, 1, NULL, 1),
(2, 5, 'TR', '2', 'Karagöz Kuzu 1 (beyaz kul', 201, 0, '2019-08-31 00:15:59', '2019-01-01', NULL, '2019-01-26', NULL, '400.00', NULL, NULL, NULL, 'İkiz eşi', 0, 0, 1, 1, NULL, 1),
(3, 5, 'TR', '3', 'Karagöz Kuzu 2', 201, 0, '2019-08-31 00:16:46', '2019-01-01', NULL, '2019-01-26', NULL, '400.00', NULL, NULL, NULL, 'İkiz eşi', 0, 0, 1, 1, NULL, 1),
(4, 5, 'TR', '4', 'Şişek', 202, 0, '2019-08-31 00:18:04', '2019-08-26', NULL, '2019-02-26', NULL, '500.00', NULL, NULL, NULL, 'İkiz anası', 0, 0, 1, 1, NULL, 1),
(5, 5, 'TR', '5', 'Şişek kuzu 1', 202, 1, '2019-08-31 00:18:46', '2019-01-01', NULL, '2019-01-26', NULL, '400.00', '1400.00', NULL, NULL, 'İkiz eşi', 0, 0, 2, 1, NULL, 1),
(6, 5, 'TR', '6', 'Şişek kuzu 2', 202, 1, '2019-08-31 00:19:26', '2019-01-01', NULL, '2019-01-26', NULL, '400.00', '1000.00', NULL, NULL, 'İkiz eşi', 0, 0, 2, 1, NULL, 1),
(7, 5, 'TR', '7', 'Kocakarı', 102, 0, '2019-08-31 00:22:52', '2011-01-01', NULL, '2019-01-13', NULL, '1200.00', NULL, NULL, NULL, 'Pırlak ırkı', 0, 0, 1, 1, NULL, 1),
(8, 5, 'TR', '10', 'Kocakarı Kuzu', 102, 0, '2019-08-31 00:23:52', '2019-02-15', NULL, '2019-02-15', NULL, '0.00', '0.00', NULL, NULL, 'Pırlak ırkı, kocakarının yavrusu', NULL, NULL, 1, 1, NULL, 1),
(9, 5, 'TR', '8', 'Kara Koyun', 201, 0, '2019-08-31 00:25:30', '2019-01-31', NULL, '2019-01-31', NULL, '800.00', NULL, NULL, NULL, 'İkiz anası', 0, 0, 1, 1, NULL, 1),
(10, 5, 'TR', '9', 'Kara Kuzu', 201, 0, '2019-08-31 00:26:11', '2019-01-31', NULL, '2019-01-31', NULL, '500.00', NULL, NULL, NULL, 'İkiz eşi', 0, 0, 1, 1, NULL, 1),
(11, 5, 'TR', '11', 'Sakız Kuzu', 101, 0, '2019-08-31 00:27:22', '2019-05-12', NULL, '2019-05-12', NULL, '1250.00', NULL, NULL, NULL, 'Sakız ırkı, çoğuz eşi, Göçbeyli', 0, 0, 1, 1, NULL, 1),
(12, 5, 'TR', '12', 'Sakız Koç', 101, 1, '2019-08-31 00:28:48', '2019-05-12', NULL, '2019-05-12', NULL, '2000.00', NULL, NULL, NULL, 'Sakız ırkı, Üçüz Eşi, Alındığı zaman yaklaşık 12 aylık, Göçbeyli', 0, 0, 1, 1, NULL, 1),
(14, 5, 'TR', '13', 'Sakız Şişek', 101, 0, '2019-08-31 14:39:37', '2019-05-19', NULL, '2019-05-19', NULL, '1200.00', NULL, NULL, NULL, '2018-19 kış ilk kuzulama, çoğuz doğum, çoğuz eşi', 0, 0, 1, 1, NULL, 1),
(15, 5, 'TR', '14', 'Karamandere Kuzu', 200, 0, '2019-08-31 14:51:22', '2019-06-26', NULL, '2019-06-26', NULL, '315.00', NULL, NULL, NULL, '', 0, 0, 1, 1, NULL, 1),
(16, 5, 'TR', '15', 'Adem Koyun', 201, 0, '2019-08-31 14:53:21', '2019-07-06', NULL, '2019-07-06', NULL, '700.00', NULL, NULL, NULL, '3-4-5 kuzulama, çoğuz doğum', 0, 0, 1, 1, NULL, 1),
(17, 5, 'TR', '16', 'Adem Kuzu', 201, 0, '2019-08-31 14:54:04', '2019-07-06', NULL, '2019-07-06', NULL, '300.00', NULL, NULL, NULL, 'İkiz eşi', 0, 0, 1, 1, NULL, 1),
(18, 5, 'TR 35 3770722', '17', 'R1 - uzun kuruk', 101, 0, '2019-08-31 14:55:25', '2019-07-20', NULL, '2019-07-20', NULL, '1000.00', '0.00', NULL, NULL, '', NULL, NULL, 1, 1, NULL, 1),
(19, 5, 'TR 35 3770688', '18', 'R2 - büyük gebe', 101, 0, '2019-08-31 14:56:25', '2019-08-28', NULL, '2019-08-28', NULL, '1000.00', '0.00', NULL, NULL, 'Şişek kuzu 2 ile takas, geldiğinde 2-3 aylık gebe', NULL, NULL, 1, 1, NULL, 1),
(20, 5, 'TR 35 3770701', '19', 'R3 - 0701', 101, 0, '2019-08-31 14:57:08', '2019-08-29', NULL, '2019-08-29', NULL, '950.00', '0.00', NULL, NULL, 'Geldiğinde gebe 2-3 aylık', NULL, NULL, 1, 1, NULL, 1),
(21, 5, 'TR 35 3770699', '20', 'R4 - Küpesiz', 101, 0, '2019-08-31 14:57:50', '2019-08-29', NULL, '2019-08-29', NULL, '950.00', '0.00', NULL, NULL, '', NULL, NULL, 1, 1, NULL, 1),
(22, 5, 'TR 35 3770674', '21', 'R5 - Alaca Kulak', 101, 0, '2019-08-31 14:58:14', '2019-08-29', NULL, '2019-08-29', NULL, '950.00', '0.00', NULL, NULL, 'sol ön kolda benek var', NULL, NULL, 1, 1, NULL, 1),
(23, 5, 'TR', '22', 'R 6', 101, 0, '2019-08-31 14:58:50', '2019-08-29', NULL, '2019-08-29', NULL, '950.00', NULL, NULL, NULL, '', 0, 0, 1, 1, NULL, 1),
(24, 5, 'TR 35 3770712', '23', 'R7 - Küpeli', 101, 0, '2019-08-31 14:59:20', '2019-08-29', NULL, '2019-08-29', NULL, '950.00', '0.00', NULL, NULL, '', NULL, NULL, 1, 1, NULL, 1),
(25, 5, 'TR', '24', 'R 8', 101, 0, '2019-08-31 22:44:27', '2019-08-31', NULL, '2019-08-31', NULL, '665.00', NULL, NULL, NULL, '', 0, 0, 1, 1, NULL, 1),
(26, 5, 'TR', '25', 'R 9', 101, 0, '2019-08-31 22:44:44', '2019-08-31', NULL, '2019-08-31', NULL, '665.00', NULL, NULL, NULL, '', 0, 0, 1, 1, NULL, 1),
(27, 5, 'TR 35 3578903', '26', 'R10-yaralı kuzu', 101, 0, '2019-08-31 22:45:36', '2019-08-31', NULL, '2019-08-31', NULL, '670.00', '0.00', NULL, NULL, '', NULL, NULL, 1, 1, NULL, 1),
(28, 5, 'TR', '27', 'Boynuzlu', 100, 0, '2019-09-05 23:12:25', NULL, NULL, '2019-09-04', NULL, '0.00', NULL, NULL, NULL, 'kasımda doğuracak, marya koyun, Rahmi Kahya\'dan alındı..', NULL, NULL, 1, 1, 2, NULL),
(31, 5, 'TR', '28', 'Akbaş Marya', 100, 0, '2019-09-05 23:21:45', NULL, NULL, '2019-09-04', NULL, '0.00', NULL, NULL, NULL, 'kasımda doğuracak, marya koyun, Rahmi Kahya\'dan alındı..', NULL, NULL, 1, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `koyun_tohum`
--

CREATE TABLE `koyun_tohum` (
  `koyun_tohum_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `koyun_id` int(11) NOT NULL,
  `koyun_asim_koc` int(11) DEFAULT NULL,
  `koyun_kayittarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `koyun_tohumtarihi` date DEFAULT NULL,
  `koyun_tohum_not` varchar(1000) COLLATE utf8_turkish_ci DEFAULT 'Açıklama yok.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `koyun_tohum`
--

INSERT INTO `koyun_tohum` (`koyun_tohum_id`, `kullanici_id`, `koyun_id`, `koyun_asim_koc`, `koyun_kayittarihi`, `koyun_tohumtarihi`, `koyun_tohum_not`) VALUES
(2, 5, 1, 12, '2019-09-07 23:49:30', '2019-08-14', ''),
(3, 5, 3, 12, '2019-09-07 23:49:49', '2019-08-23', ''),
(4, 5, 9, 12, '2019-09-07 23:50:13', '2019-07-22', ''),
(5, 5, 10, 12, '2019-09-07 23:51:02', '2019-05-30', 'koç denedi'),
(6, 5, 8, 12, '2019-09-07 23:51:36', '2019-08-22', 'ramazanın koç ??'),
(7, 5, 11, 12, '2019-09-07 23:52:05', '2019-08-22', 'Ramazanın Koç'),
(8, 5, 14, 12, '2019-09-07 23:52:46', '2019-09-24', 'çok defa atladı ama tutturamamış olabilir'),
(9, 5, 22, 12, '2019-09-10 13:29:10', '2019-09-10', 'Peşindeydi, atlamaya çalıştı, aşım yapmış olabilir..'),
(10, 5, 14, 12, '2019-09-10 13:32:00', '2019-08-24', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `kullanici_id` int(11) NOT NULL,
  `kullanici_adi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_sifre` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_adsoyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'Ad Soyad',
  `kullanici_eposta` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_gorsel` varchar(250) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'images/kullanici/kullanici.png',
  `kullanici_kayittarihi` datetime NOT NULL,
  `kullanici_yetki` int(1) NOT NULL DEFAULT '2',
  `kullanici_durum` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`kullanici_id`, `kullanici_adi`, `kullanici_sifre`, `kullanici_adsoyad`, `kullanici_eposta`, `kullanici_gorsel`, `kullanici_kayittarihi`, `kullanici_yetki`, `kullanici_durum`) VALUES
(1, 'admin', 'e53a0a2978c28872a4505bdb51db06dc', 'Yönetici', 'admin@ciftligimtakip.com', 'images/kullanici/29621232203032425156flat-faces-icons-circle-3.png', '2017-05-13 14:19:41', 1, 1),
(5, 'koyuncu', 'e53a0a2978c28872a4505bdb51db06dc', 'Ad Soyad', 'kullanici@eposta.com', 'images/user.png', '2017-05-15 15:02:45', 2, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kurbanlik_hayvanlar`
--

CREATE TABLE `kurbanlik_hayvanlar` (
  `hayvan_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `hayvan_kupeno` varchar(50) COLLATE utf8_turkish_ci DEFAULT NULL,
  `hayvan_adi` varchar(25) COLLATE utf8_turkish_ci DEFAULT NULL,
  `hayvan_irk` int(2) DEFAULT NULL,
  `hayvan_cinsiyet` int(1) DEFAULT NULL,
  `hayvan_kayittarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hayvan_kilo` varchar(10) COLLATE utf8_turkish_ci DEFAULT NULL,
  `hayvan_alici` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `hayvan_alici_tel` varchar(11) COLLATE utf8_turkish_ci DEFAULT NULL,
  `hayvan_hisse_adedi` int(2) DEFAULT '1',
  `hayvan_satisfiyati` decimal(10,0) DEFAULT NULL,
  `hayvan_not` int(11) DEFAULT NULL,
  `hayvan_durum` varchar(1) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `muhasebe`
--

CREATE TABLE `muhasebe` (
  `muhasebe_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `muhasebe_gelir` decimal(10,2) DEFAULT NULL,
  `muhasebe_gider` decimal(10,2) DEFAULT NULL,
  `muhasabe_kayittarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `muhasebe_aciklama` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `muhasebe`
--

INSERT INTO `muhasebe` (`muhasebe_id`, `kullanici_id`, `muhasebe_gelir`, `muhasebe_gider`, `muhasabe_kayittarihi`, `muhasebe_aciklama`) VALUES
(1, 5, '0.00', '500.00', '2019-08-30 23:56:36', 'TR küpeli koyun işlemleri.'),
(2, 5, NULL, '400.00', '2019-08-31 00:15:59', 'TR küpeli koyun işlemleri.'),
(3, 5, NULL, '400.00', '2019-08-31 00:16:46', 'TR küpeli koyun işlemleri.'),
(4, 5, NULL, '500.00', '2019-08-31 00:18:04', 'TR küpeli koyun işlemleri.'),
(5, 5, NULL, '400.00', '2019-08-31 00:18:46', 'TR küpeli koyun işlemleri.'),
(6, 5, NULL, '400.00', '2019-08-31 00:19:26', 'TR küpeli koyun işlemleri.'),
(7, 5, NULL, '1200.00', '2019-08-31 00:22:52', 'TR küpeli koyun işlemleri.'),
(8, 5, NULL, '0.00', '2019-08-31 00:23:52', 'TR küpeli koyun işlemleri.'),
(9, 5, NULL, '800.00', '2019-08-31 00:25:30', 'TR küpeli koyun işlemleri.'),
(10, 5, NULL, '500.00', '2019-08-31 00:26:11', 'TR küpeli koyun işlemleri.'),
(11, 5, NULL, '1250.00', '2019-08-31 00:27:22', 'TR küpeli koyun işlemleri.'),
(12, 5, NULL, '2000.00', '2019-08-31 00:28:48', 'TR küpeli koyun işlemleri.'),
(13, 5, NULL, '450.00', '2019-08-31 12:28:06', 'TR küpeli koyun işlemleri.'),
(14, 5, NULL, '1200.00', '2019-08-31 14:39:37', 'TR küpeli koyun işlemleri.'),
(15, 5, NULL, '315.00', '2019-08-31 14:51:22', 'TR küpeli koyun işlemleri.'),
(16, 5, NULL, '700.00', '2019-08-31 14:53:21', 'TR küpeli koyun işlemleri.'),
(17, 5, NULL, '300.00', '2019-08-31 14:54:04', 'TR küpeli koyun işlemleri.'),
(18, 5, NULL, '1000.00', '2019-08-31 14:55:25', 'TR küpeli koyun işlemleri.'),
(19, 5, NULL, '1000.00', '2019-08-31 14:56:25', 'TR küpeli koyun işlemleri.'),
(20, 5, NULL, '950.00', '2019-08-31 14:57:08', 'TR küpeli koyun işlemleri.'),
(21, 5, NULL, '950.00', '2019-08-31 14:57:50', 'TR küpeli koyun işlemleri.'),
(22, 5, NULL, '950.00', '2019-08-31 14:58:14', 'TR küpeli koyun işlemleri.'),
(23, 5, NULL, '950.00', '2019-08-31 14:58:50', 'TR küpeli koyun işlemleri.'),
(24, 5, NULL, '950.00', '2019-08-31 14:59:20', 'TR küpeli koyun işlemleri.'),
(25, 5, NULL, '665.00', '2019-08-31 22:44:27', 'TR küpeli koyun işlemleri.'),
(26, 5, NULL, '665.00', '2019-08-31 22:44:44', 'TR küpeli koyun işlemleri.'),
(27, 5, NULL, '670.00', '2019-08-31 22:45:36', 'TR küpeli koyun işlemleri.'),
(28, 5, NULL, '0.00', '2019-09-05 23:04:13', ' işletme küpeli koyun işlemleri.'),
(29, 5, NULL, '0.00', '2019-09-05 23:05:37', ' işletme küpeli koyun işlemleri.'),
(30, 5, NULL, '0.00', '2019-09-05 23:07:06', ' işletme küpeli koyun işlemleri.'),
(31, 5, NULL, '0.00', '2019-09-05 23:08:25', '25 işletme küpeli koyun işlemleri.'),
(32, 5, NULL, '0.00', '2019-09-05 23:11:16', '25 işletme küpeli koyun işlemleri.'),
(33, 5, NULL, '0.00', '2019-09-05 23:12:25', '25 işletme küpeli koyun işlemleri.'),
(34, 5, NULL, '0.00', '2019-09-05 23:15:05', '25 işletme küpeli koyun işlemleri.'),
(35, 5, NULL, '0.00', '2019-09-05 23:20:04', '26 işletme küpeli koyun işlemleri.'),
(36, 5, NULL, '0.00', '2019-09-05 23:21:45', '26 işletme küpeli koyun işlemleri.'),
(37, 5, NULL, NULL, '2019-09-05 23:22:31', '4RT işletme küpeli koyun işlemleri.'),
(38, 5, NULL, NULL, '2019-09-05 23:23:28', '4RT işletme küpeli koyun işlemleri.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notlar`
--

CREATE TABLE `notlar` (
  `not_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `not_kayittarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `not_baslik` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `not_aciklama` varchar(3000) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `notlar`
--

INSERT INTO `notlar` (`not_id`, `kullanici_id`, `not_kayittarihi`, `not_baslik`, `not_aciklama`) VALUES
(32, 5, '2018-12-12 00:10:34', 'Mısır Sılajı Tartım 1', '<p>2 Aralık&nbsp;Başlangı&ccedil;</p>\r\n\r\n<p>Toplam 792.5 kilogram</p>\r\n'),
(34, 5, '2018-12-12 20:55:54', 'Köpekler Doğum', '<p>12 Kasım Pazartesi</p>\r\n'),
(35, 5, '2018-12-12 20:56:33', 'Sılaj Alım', '<p>&nbsp;20 Kasım</p>\r\n'),
(36, 5, '2018-12-13 15:40:34', 'İlaç 1', '<p>11 kasım 2018<br />\r\nnokta hari&ccedil;<br />\r\nbızağı ve tosunlar<br />\r\nivomec</p>\r\n\r\n<p>12 kasım haplar<br />\r\n18 kasım vitamin<br />\r\n&nbsp;</p>\r\n'),
(38, 5, '2018-12-14 23:44:01', 'Mısır Sılajı Tartım 2', '<p>207</p>\r\n\r\n<p>194.5</p>\r\n'),
(39, 5, '2018-12-14 23:44:26', 'ilaç ademin', '<p>buzağılar</p>\r\n'),
(40, 5, '2018-12-17 22:10:58', 'enikler dış parazit', '<p>16 12 2018</p>\r\n'),
(41, 5, '2019-09-08 23:01:56', 'Yeni Koyunlara OraselE Verildi', '<p>Ramazandan gelen 9 koyuna ve kahyadan gelen 2 koyuna verildi.</p>\r\n');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `padok`
--

CREATE TABLE `padok` (
  `padok_id` int(2) NOT NULL,
  `padok_adi` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `padok_aciklama` varchar(25) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `padok`
--

INSERT INTO `padok` (`padok_id`, `padok_adi`, `padok_aciklama`) VALUES
(1, 'Bölme 1', 'Samanlık Büyük'),
(2, 'Bölme 2', 'Samanlık Küçük'),
(3, 'Bölme 3', 'Ahır'),
(4, 'Bölme 4', 'Meşe Altı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tartim`
--

CREATE TABLE `tartim` (
  `tartim_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `hayvan_id` int(11) NOT NULL,
  `tartim_kilo` int(3) DEFAULT NULL,
  `tartim_tarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tartim_aciklama` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tartim`
--

INSERT INTO `tartim` (`tartim_id`, `kullanici_id`, `hayvan_id`, `tartim_kilo`, `tartim_tarihi`, `tartim_aciklama`) VALUES
(1, 5, 1, 0, '2019-08-30 23:56:36', NULL),
(2, 5, 2, 0, '2019-08-31 00:15:59', NULL),
(3, 5, 3, 0, '2019-08-31 00:16:46', NULL),
(4, 5, 4, 0, '2019-08-31 00:18:04', NULL),
(5, 5, 5, 0, '2019-08-31 00:18:46', NULL),
(6, 5, 6, 0, '2019-08-31 00:19:26', NULL),
(7, 5, 7, 0, '2019-08-31 00:22:52', NULL),
(8, 5, 8, 0, '2019-08-31 00:23:52', NULL),
(9, 5, 9, 0, '2019-08-31 00:25:30', NULL),
(10, 5, 10, 0, '2019-08-31 00:26:11', NULL),
(11, 5, 11, 0, '2019-08-31 00:27:22', NULL),
(12, 5, 12, 0, '2019-08-31 00:28:48', NULL),
(13, 5, 13, 0, '2019-08-31 12:28:06', NULL),
(14, 5, 14, 0, '2019-08-31 14:39:37', NULL),
(15, 5, 15, 15, '2019-08-31 14:51:22', NULL),
(16, 5, 16, 0, '2019-08-31 14:53:21', NULL),
(17, 5, 17, 14, '2019-08-31 14:54:04', NULL),
(18, 5, 18, 52, '2019-08-31 14:55:25', NULL),
(19, 5, 19, 0, '2019-08-31 14:56:25', NULL),
(20, 5, 20, 0, '2019-08-31 14:57:08', NULL),
(21, 5, 21, 0, '2019-08-31 14:57:50', NULL),
(22, 5, 22, 0, '2019-08-31 14:58:14', NULL),
(23, 5, 23, 0, '2019-08-31 14:58:50', NULL),
(24, 5, 24, 0, '2019-08-31 14:59:20', NULL),
(25, 5, 25, 0, '2019-08-31 22:44:27', NULL),
(26, 5, 26, 0, '2019-08-31 22:44:44', NULL),
(27, 5, 27, 0, '2019-08-31 22:45:36', NULL),
(28, 5, 0, 0, '2019-09-05 23:04:13', NULL),
(29, 5, 0, 0, '2019-09-05 23:05:37', NULL),
(30, 5, 0, 0, '2019-09-05 23:07:06', NULL),
(31, 5, 0, 0, '2019-09-05 23:08:25', NULL),
(32, 5, 0, 0, '2019-09-05 23:11:16', NULL),
(33, 5, 28, 0, '2019-09-05 23:12:25', NULL),
(34, 5, 29, 0, '2019-09-05 23:15:05', NULL),
(35, 5, 30, 0, '2019-09-05 23:20:04', NULL),
(36, 5, 31, 0, '2019-09-05 23:21:45', NULL),
(37, 5, 32, 3, '2019-09-05 23:22:31', NULL),
(38, 5, 33, 15, '2019-09-05 23:23:28', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tartim_koyun`
--

CREATE TABLE `tartim_koyun` (
  `tartim_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `hayvan_id` int(11) NOT NULL,
  `tartim_kilo` int(3) DEFAULT NULL,
  `tartim_tarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tartim_aciklama` varchar(1000) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tartim_koyun`
--

INSERT INTO `tartim_koyun` (`tartim_id`, `kullanici_id`, `hayvan_id`, `tartim_kilo`, `tartim_tarihi`, `tartim_aciklama`) VALUES
(1, 5, 1, 73, '2019-08-30 23:56:36', NULL),
(2, 5, 2, 32, '2019-08-31 00:15:59', NULL),
(3, 5, 3, 36, '2019-08-31 00:16:46', NULL),
(4, 5, 4, 43, '2019-08-31 00:18:04', NULL),
(5, 5, 5, 48, '2019-08-31 00:18:46', NULL),
(6, 5, 6, 50, '2019-08-31 00:19:26', NULL),
(7, 5, 7, 40, '2019-08-31 00:22:52', NULL),
(8, 5, 8, 22, '2019-08-31 00:23:52', NULL),
(9, 5, 9, 85, '2019-08-31 00:25:30', NULL),
(10, 5, 10, 41, '2019-08-31 00:26:11', NULL),
(11, 5, 11, 38, '2019-08-31 00:27:22', NULL),
(12, 5, 12, 60, '2019-08-31 00:28:48', NULL),
(14, 5, 14, 42, '2019-08-31 14:39:37', NULL),
(15, 5, 15, 15, '2019-08-31 14:51:22', NULL),
(16, 5, 16, 0, '2019-08-31 14:53:21', NULL),
(17, 5, 17, 14, '2019-08-31 14:54:04', NULL),
(18, 5, 18, 52, '2019-08-31 14:55:25', NULL),
(19, 5, 19, 0, '2019-08-31 14:56:25', NULL),
(20, 5, 20, 0, '2019-08-31 14:57:08', NULL),
(21, 5, 21, 0, '2019-08-31 14:57:50', NULL),
(22, 5, 22, 0, '2019-08-31 14:58:14', NULL),
(23, 5, 23, 0, '2019-08-31 14:58:50', NULL),
(24, 5, 24, 0, '2019-08-31 14:59:20', NULL),
(25, 5, 25, 0, '2019-09-07 23:41:41', NULL),
(26, 5, 26, 19, '2019-09-07 23:41:41', NULL),
(27, 5, 27, 0, '2019-09-07 23:41:41', NULL),
(28, 5, 28, 0, '2019-09-07 23:41:41', NULL),
(29, 5, 31, 0, '2019-09-07 23:48:02', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yem`
--

CREATE TABLE `yem` (
  `yem_id` int(2) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `yem_adi` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `yem_miktari` int(11) NOT NULL,
  `yem_birimi` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yem`
--

INSERT INTO `yem` (`yem_id`, `kullanici_id`, `yem_adi`, `yem_miktari`, `yem_birimi`) VALUES
(1, 5, 'Saman', 850, 1),
(2, 5, 'Yonca', 740, 1),
(3, 5, 'Arpa', 650, 2),
(4, 5, 'Kepek', 600, 2),
(5, 5, 'Buğday', 510, 2),
(6, 5, 'Mısır Silajı', 1200, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yemkayit`
--

CREATE TABLE `yemkayit` (
  `yemkayit_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `yemkayit_adi` int(2) NOT NULL,
  `yemkayit_miktari` int(11) NOT NULL,
  `yemkayit_birimi` int(2) NOT NULL,
  `yemkayit_birimfiyati` decimal(10,2) NOT NULL,
  `yemkayit_alistarihi` date NOT NULL,
  `yemkayit_aciklama` varchar(1000) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yemkayit`
--

INSERT INTO `yemkayit` (`yemkayit_id`, `kullanici_id`, `yemkayit_adi`, `yemkayit_miktari`, `yemkayit_birimi`, `yemkayit_birimfiyati`, `yemkayit_alistarihi`, `yemkayit_aciklama`) VALUES
(1, 5, 1, 500, 1, '12.50', '2017-05-18', ''),
(2, 5, 3, 450, 2, '0.85', '2017-05-17', ''),
(3, 5, 4, 600, 2, '0.70', '2017-05-09', ''),
(4, 5, 2, 340, 1, '15.00', '2017-05-02', ''),
(5, 5, 5, 280, 1, '0.90', '2017-05-10', ''),
(6, 5, 6, 1200, 2, '0.25', '2017-05-13', ''),
(10, 5, 1, 150, 1, '13.00', '2017-05-19', 'Saman alındı.'),
(11, 5, 5, 230, 2, '1.00', '2017-05-19', 'Kargalı buğdayı.'),
(13, 5, 1, 100, 1, '11.00', '2017-05-01', ''),
(14, 5, 3, 200, 2, '0.85', '2017-05-23', ''),
(15, 5, 1, 100, 1, '12.00', '2017-06-25', 'kargalı saman'),
(16, 5, 2, 400, 1, '16.50', '2018-06-16', 'Adapazarı');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Tablo için indeksler `birim`
--
ALTER TABLE `birim`
  ADD PRIMARY KEY (`birim_id`);

--
-- Tablo için indeksler `hatirlatici`
--
ALTER TABLE `hatirlatici`
  ADD PRIMARY KEY (`hatirlatici_id`);

--
-- Tablo için indeksler `hayvan`
--
ALTER TABLE `hayvan`
  ADD PRIMARY KEY (`hayvan_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Tablo için indeksler `hisse`
--
ALTER TABLE `hisse`
  ADD PRIMARY KEY (`hisse_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Tablo için indeksler `inek_tohum`
--
ALTER TABLE `inek_tohum`
  ADD PRIMARY KEY (`inek_tohum_id`),
  ADD KEY `kullanici_id` (`kullanici_id`),
  ADD KEY `hayvan_id` (`hayvan_id`);

--
-- Tablo için indeksler `irk`
--
ALTER TABLE `irk`
  ADD PRIMARY KEY (`irk_id`);

--
-- Tablo için indeksler `irk_koyun`
--
ALTER TABLE `irk_koyun`
  ADD PRIMARY KEY (`irk_id`);

--
-- Tablo için indeksler `isler`
--
ALTER TABLE `isler`
  ADD PRIMARY KEY (`isler_id`);

--
-- Tablo için indeksler `koyun`
--
ALTER TABLE `koyun`
  ADD PRIMARY KEY (`koyun_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Tablo için indeksler `koyun_tohum`
--
ALTER TABLE `koyun_tohum`
  ADD PRIMARY KEY (`koyun_tohum_id`),
  ADD KEY `kullanici_id` (`kullanici_id`),
  ADD KEY `hayvan_id` (`koyun_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`kullanici_id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`),
  ADD UNIQUE KEY `kullanici_eposta` (`kullanici_eposta`),
  ADD KEY `kullanici_adi_2` (`kullanici_adi`),
  ADD KEY `kullanici_adi_3` (`kullanici_adi`),
  ADD KEY `kullanici_eposta_2` (`kullanici_eposta`);

--
-- Tablo için indeksler `kurbanlik_hayvanlar`
--
ALTER TABLE `kurbanlik_hayvanlar`
  ADD PRIMARY KEY (`hayvan_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Tablo için indeksler `muhasebe`
--
ALTER TABLE `muhasebe`
  ADD PRIMARY KEY (`muhasebe_id`);

--
-- Tablo için indeksler `notlar`
--
ALTER TABLE `notlar`
  ADD PRIMARY KEY (`not_id`);

--
-- Tablo için indeksler `padok`
--
ALTER TABLE `padok`
  ADD PRIMARY KEY (`padok_id`);

--
-- Tablo için indeksler `tartim`
--
ALTER TABLE `tartim`
  ADD PRIMARY KEY (`tartim_id`);

--
-- Tablo için indeksler `tartim_koyun`
--
ALTER TABLE `tartim_koyun`
  ADD PRIMARY KEY (`tartim_id`);

--
-- Tablo için indeksler `yem`
--
ALTER TABLE `yem`
  ADD PRIMARY KEY (`yem_id`);

--
-- Tablo için indeksler `yemkayit`
--
ALTER TABLE `yemkayit`
  ADD PRIMARY KEY (`yemkayit_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayar`
--
ALTER TABLE `ayar`
  MODIFY `ayar_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `birim`
--
ALTER TABLE `birim`
  MODIFY `birim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `hatirlatici`
--
ALTER TABLE `hatirlatici`
  MODIFY `hatirlatici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Tablo için AUTO_INCREMENT değeri `hayvan`
--
ALTER TABLE `hayvan`
  MODIFY `hayvan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Tablo için AUTO_INCREMENT değeri `hisse`
--
ALTER TABLE `hisse`
  MODIFY `hisse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `inek_tohum`
--
ALTER TABLE `inek_tohum`
  MODIFY `inek_tohum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `irk`
--
ALTER TABLE `irk`
  MODIFY `irk_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- Tablo için AUTO_INCREMENT değeri `irk_koyun`
--
ALTER TABLE `irk_koyun`
  MODIFY `irk_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- Tablo için AUTO_INCREMENT değeri `isler`
--
ALTER TABLE `isler`
  MODIFY `isler_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Tablo için AUTO_INCREMENT değeri `koyun`
--
ALTER TABLE `koyun`
  MODIFY `koyun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `koyun_tohum`
--
ALTER TABLE `koyun_tohum`
  MODIFY `koyun_tohum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `kurbanlik_hayvanlar`
--
ALTER TABLE `kurbanlik_hayvanlar`
  MODIFY `hayvan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `muhasebe`
--
ALTER TABLE `muhasebe`
  MODIFY `muhasebe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Tablo için AUTO_INCREMENT değeri `notlar`
--
ALTER TABLE `notlar`
  MODIFY `not_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Tablo için AUTO_INCREMENT değeri `padok`
--
ALTER TABLE `padok`
  MODIFY `padok_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `tartim`
--
ALTER TABLE `tartim`
  MODIFY `tartim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Tablo için AUTO_INCREMENT değeri `tartim_koyun`
--
ALTER TABLE `tartim_koyun`
  MODIFY `tartim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Tablo için AUTO_INCREMENT değeri `yem`
--
ALTER TABLE `yem`
  MODIFY `yem_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `yemkayit`
--
ALTER TABLE `yemkayit`
  MODIFY `yemkayit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
