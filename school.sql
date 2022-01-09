-- phpMyAdmin SQL Dump
-- version 5.1.1deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 09 Jan 2022 pada 20.28
-- Versi server: 10.5.12-MariaDB-1
-- Versi PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_message`
--

CREATE TABLE `admin_message` (
  `id` int(11) NOT NULL,
  `message` varchar(512) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(256) NOT NULL,
  `isi` longtext NOT NULL,
  `tanggal` int(11) NOT NULL,
  `penulis` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `tanggal`, `penulis`) VALUES
(1, 'SUKSES MENGGELAR KULIAH UMUM, UNSIKA SIAP MENERAPKAN DIGITALISASI DALAM PELAKSANAAN KAMPUS MERDEKA DAN MENJADI PERGURUAN TINGGI YANG INOVATIF, KOMPETITIF, DAN UNGGUL', '<p>Indonesia terus melakukan evaluasi dan reformasi di bidang pendidikan, sarana, prasarana pendidikan, dan kurikulum pendidikan. Pemerintah berupaya untuk meningkatkan kualitas pendidikan di Indonesia. Upaya ini bertujuan untuk meningkatkan kualitas pendidikan yang berkelanjutan secara pembangunan menuju Sustainable Development Goals (S.D.G.s) yang diharapkan dapat terwujud pada tahun 2030. Peningkatan kompetensi pendidik yang harus memiliki keterampilan di bidang digital dan berpikir kreatif. Pemerintah harus menyelaraskan pendidikan dan industri serta menerapkan teknologi dalam kegiatan belajar mengajar melalui penyusunan kurikulum yang tepat.</p><figure class=\"image\"><img src=\"https://unsika.ac.id/wp-content/uploads/2021/12/29-12-2021-1-300x199.png\" alt=\"\" srcset=\"https://unsika.ac.id/wp-content/uploads/2021/12/29-12-2021-1-300x199.png 300w, https://unsika.ac.id/wp-content/uploads/2021/12/29-12-2021-1.png 635w\" sizes=\"100vw\" width=\"376\"></figure><p>Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi melakukan transformasi pendidikan melalui kebijakan MBKM (Merdeka Belajar- Kampus Merdeka). Salah satu program dari kebijakan Merdeka Belajar – Kampus Merdeka adalah Hak Belajar Tiga Semester atau setara dengan 60 sks di luar program studi yang merupakan amanah dari berbagai landasan hukum pendidikan tinggi dalam rangka peningkatan mutu pembelajaran dan lulusan pendidikan tinggi salah satunya tertuang di Peraturan Menteri Pendidikan dan Kebudayaan Nomor 3 Tahun 2020 Tentang Standar Nasional Pendidikan Tinggi.  Magang, Studi/Proyek Independen, Penelitian, Kewirausahaan, Mengajar di Sekolah, Pertukaran Mahasiswa, Membangun Desa, Proyek Kemanusiaan, dan Bela Negara merupakan Sembilan bentuk MBKM.</p><figure class=\"image\"><img src=\"https://unsika.ac.id/wp-content/uploads/2021/12/29-12-2021-2-300x200.png\" alt=\"\" srcset=\"https://unsika.ac.id/wp-content/uploads/2021/12/29-12-2021-2-300x200.png 300w, https://unsika.ac.id/wp-content/uploads/2021/12/29-12-2021-2.png 612w\" sizes=\"100vw\" width=\"375\"></figure><p>Sebagai upaya dalam memberikan pemahaman yang tepat dan memotivasi seluruh sivitas akademika dan tenaga kependidikan untuk aktif dalam kegiatan MBKM, Unsika menggelar kuliah umum dengan tema <strong>Penerapan Kampus Merdeka di Era Digital Guna Mencapai Unsika yang Inovatif, Kompetitif, dan Unggul. </strong>Kegiatan ini dilaksanakan secara bauran dengan undangan terbatas pada hari Rabu, 29 Desember 2021 bertempat di Gedung Aula Unsika dan dihadiri oleh ribuan mahasiswa, dosen, dan tendik Unsika melalui media daring.Tidak hanya dihadiri mahasiswa Unsika, kegiatan ini juga dihadiri oleh mahasiswa <i>inbound</i> Pertukaran Mahasiswa Merdeka yang berasal dari berbagai 22 perguruan tinggi se-Indonesia.</p><p>Kegiatan ini dibuka dengan menyambut pemateri dengan mapag tamu yang menjadi salah satu ciri khas budaya tanah sunda dalam menyambut tamu yang datang. Acara ini juga menyajikan penampilan budaya nusantara yang disajikan oleh Parasika (Paguyuban Rakyat Seni Unsika) dengan meriah dan menakjubkan sehingga mampu membakar semangat peserta untuk benar-benar fokus mendengarkan sesi kuliah umum.</p><p> “Sebagai bentuk komitmen pelaksanaan MBKM di era digital, Unsika di bawah tim kewareksatuan sedang mempersiapkan konsep  ABCD (<i>Artificial Inteligence (AI), Blockchain(B), Cloud Computing(C),</i>dan <i>Data Analytics(D)</i> sebagai bagian dari mata kuliah wajib.” tutur Prof. Dr. Sri Mulyani, Ak., ACPA., CA. selaku Rektor Universitas Singaperbangsa Karawang saat membuka kegiatan kuliah umum. Rektor Unsika yakin konsep ABCD akan mampu mendukung perkembangan pelaksanaan MBKM di era digital karena tidak ada satupun aktivitas MBKM yang tidak terkait dengan digitalisasi.</p><p>Dengan menghadirkan Dr. Ir. Paristiyanti Nurwadani, selaku Sekretaris Direktorat Jenderal Pendidikan Tinggi sebagai pemateri kegiatan kuliah umum penerapan kampus merdeka di era digital, Unsika menunjukkan komitmen untuk aktif mendorong dan memotivasi mahasiswa mengikuti kegiatan MBKM. Tidak hanya memberikan apresiasi atas prestasi yang mampu dicapai oleh Unsika, Sesdirjendikti juga mengajak seluruh sivitas akademika dan tenaga kependidikan Unsika untuk bersatu dalam menjalankan MBKM dapat menjadi perguruan tinggi yang inovatif, kompetitif, dan unggul.</p><p>Tidak hanya memberikan pemahaman tentang konsep MBKM yang tepat, Sesdirjendikti juga memotivasi mahasiswa dengan memberikan informasi perihal beasiswa pemotongan UKT, dan pemberian uang saku bagi mahasiswa peserta MBKM melalui pendanaan dari LPDP (Lembaga Pengelolaan Dana Pendidikan). Selain memperoleh pengalaman belajar di luar kampus, mahasiswa juga mendapatkan dukungan pendanaan.</p><p>Pada kuliah umum ini juga, Sesdirjendikti memberikan <i>reward</i> kepada tiga orang mahasiswa berupa kesempatan untuk hadir pada diskusi nasional yang akan digelar dalam rangka mempersiapkan Program MBKM tahun 2022 mendatang. Hal ini merupakan kesempatan luar biasa bagi mahasiswa Unsika untuk belajar banyak bagaimana setiap program MBKM itu dirancang di level kementerian.</p><p>“Saya sangat yakin dari kegiatan kuliah umum pagi ini, akan semakin menjamin bahwa Unsika Jaya, Kini, Masa Depan, dan Selamanya” ungkap Dr. Ir. Paristiyanti Nurwadani dengan optimis dalam menutup sesi paparan materi kuliah umum.</p>', 1641754762, 'Admin'),
(2, 'Dusun Kalenkalong Memenangkan Juara sebagai Lembaga Mitra Desa PHP2D tahun 2021', '<figure class=\"image\"><img src=\"https://unsika.ac.id/wp-content/uploads/2021/12/13-12-2021-3.jpg\" alt=\"You are currently viewing Dusun Kalenkalong Memenangkan Juara sebagai Lembaga Mitra Desa PHP2D tahun 2021\" srcset=\"https://unsika.ac.id/wp-content/uploads/2021/12/13-12-2021-3.jpg 851w, https://unsika.ac.id/wp-content/uploads/2021/12/13-12-2021-3-300x225.jpg 300w, https://unsika.ac.id/wp-content/uploads/2021/12/13-12-2021-3-768x576.jpg 768w\" sizes=\"100vw\" width=\"851\"></figure><h2><strong>Dusun Kalenkalong Memenangkan Juara sebagai Lembaga Mitra Desa PHP2D tahun 2021</strong></h2><ul><li>Post author:<a href=\"https://unsika.ac.id/author/administrator/\">administrator</a></li><li>Post published:13 Desember 2021</li><li>Post category:<a href=\"https://unsika.ac.id/category/berita/\">Berita</a> / <a href=\"https://unsika.ac.id/category/kegiatan/\">Kegiatan</a> / <a href=\"https://unsika.ac.id/category/prestasi/\">Prestasi</a></li><li>Reading time:2 mins read</li></ul><p>Program Holistik Pemberdayaan dan Pembinaan Desa (PHP2D) merupakan sebuah program bina desa yang dinaungi oleh Kemenristek dikti, dan ini adalah kali pertama Himpunan Mahasiswa Teknik Elektro (HIMTEL UNSIKA) mendapatkan kesempatan pada PHP2D. Program yang berlangsung selama 5 bulan ini bertujuan untuk memberdayakan masyarakat desa pada sector perikanan yang merupakan salah satu keunggulan dari dusun ini.</p><p>Pada kesempatan ini, perdananya diadakan ajang penghargaan pada PHP2D, P3D dan Wira Desa yaitu Abdidaya 2021 Pemerintah Dusun Kalenkalong mendapatkan nominasi pada kategori Lembaga Mitra Desa. Dusun ini masuk kedalam 40 besar desa dengan Lembaga Mitra Desa terbaik untuk PHP2D, serta memenangi Juara 3 pada kategori tersebut. Hal ini menjadikan kebanggaan bagi Lembaga desa, tim, dosen pembimbing, maupun civitas Universitas yang dimana ini adalah suatu pencapaian yang luar biasa. “Alhamdulillah, puji syukur untuk seluruh tim dan juga yang berpartisipasi semoga kita semua dalam lindungan-Nya, kami sebagai warga dusun kalen kalong ber terima kasih sebanyak-banyaknya atas binaan dan pencapaian ini. Semoga kedepannya ada lagi program yang dapat membantu dusun kami Bersama para mahasiswa untuk memajukan desa dan negara.” Ujar Abdul Kodir Jaelani selaku kepala kelompok usaha binaan. “Masya Allah Alhamdulillah, kemenangan ini tidak hanya sebagai pencapaian kita namun juga berkat mitra yang sangat mendukung untuk program maupun koordinasi selama program berlangsung hingga kini, semoga komunikasi dan silahturahim kita dapat terus berjalan dan tidak terputus karena berakhirnya program ini” ujar Arnisa Stefanie selaku Dosen Pembimbing PHP2D Himtel Unsika. Meskipun pada pelaksanaan wawancara ini banyak sekali rintangannya seperti terjadinya banjir ketika hari H dan juga kurang baiknya jalanan ini tidak menjadi pematah semangat dari tim maupun Lembaga kemitraan yang sangat responsif, dan koordinatif. Harapannya program dan penghargaan ini tidak hanya sampai disini, namun dapat lebih bersinergi kedepannya bersama dalam membangun desa yang lebih sejahtera.</p>', 1641756262, 'Admin'),
(3, 'BEM Fakultas Pertanian Unsika Mendapat Penghargaan Abdidaya 2021 sebagai Ormawa Terbaik.', '<figure class=\"image\"><img src=\"https://unsika.ac.id/wp-content/uploads/2021/12/13-12-2021.png\" alt=\"You are currently viewing BEM Fakultas Pertanian Unsika Mendapat Penghargaan Abdidaya 2021 sebagai Ormawa Terbaik.\" srcset=\"https://unsika.ac.id/wp-content/uploads/2021/12/13-12-2021.png 1603w, https://unsika.ac.id/wp-content/uploads/2021/12/13-12-2021-300x180.png 300w, https://unsika.ac.id/wp-content/uploads/2021/12/13-12-2021-1024x614.png 1024w, https://unsika.ac.id/wp-content/uploads/2021/12/13-12-2021-768x460.png 768w, https://unsika.ac.id/wp-content/uploads/2021/12/13-12-2021-1536x921.png 1536w\" sizes=\"100vw\" width=\"1603\"></figure><h2><strong>BEM Fakultas Pertanian Unsika Mendapat Penghargaan Abdidaya 2021 sebagai Ormawa Terbaik.</strong></h2><ul><li>Post author:<a href=\"https://unsika.ac.id/author/administrator/\">administrator</a></li><li>Post published:13 Desember 2021</li><li>Post category:<a href=\"https://unsika.ac.id/category/akademik/\">Akademik</a> / <a href=\"https://unsika.ac.id/category/berita/\">Berita</a> / <a href=\"https://unsika.ac.id/category/prestasi/\">Prestasi</a></li><li>Reading time:2 mins read</li></ul><p>Tim Program Holistik Pembinaan dan Pemberdayaan Desa (PHP2D) dari Badan Eksekutif Mahasiswa Fakultas Pertanian Universitas Singaperbangsa Karawang memberikan hadiah istimewa di penghujung tahun. Melalui program yang berjudul “Peningkatan Keanekaragaman Hayati pada Lahan Padi Sawah melalui Pertanian Tekno-ekologis dalam Upaya Pembentukan Edu-Agrowisata di Desa Lemahmulya Kabupaten Karawang”, tim ini berhasil mendapatkan juara pertama kategori Organisasi Kemahasiswaan pada Abdidaya 2021.</p><p> </p><p>Abdidaya merupakan ajang apresiasi sebagai puncak pelaksanaan program-program pengabdian dan pemberdayaan desa seperti PHP2D, Wira Desa, dan P3D. Abdidaya sendiri diadakan oleh Direktorat Pembelajaran dan Kemahasiswaan (Belmawa), Direktorat Jenderal Pendidikan Tinggi (Ditjen Dikti), serta Kementrian Pendidikan, Kebudayaan, Riset dan Teknologi (Kemendikbudristek) Republik Indonesia.</p><p>Abdidaya 2021 ini diikuti oleh 113 Perguruan Tinggi di seluruh Indonesia dengan total 240 tim yang dibagi dalam 6 skema dan 4 kategori, berupa kategori Organisasi Kemahasiswaan, Dosen Pendamping, Lembaga Mitra Desa, dan <i>Support System</i>. Dari 40 nominator kategori Organisasi Kemahasiswaan, Badan Eksekutif Mahasiswa Fakultas Pertanian Unsika menjadi pemenang dalam program Abdidaya tahun 2021. Tim BEM Fakultas Pertanian Unsika menerima penghargaan atas program pemberdayaan yang mengangkat konsep Edu-Agrowisata yang berbasis Tekno-ekologis.</p><p>Fikri Zainul Hilmi, selaku Ketua Tim PHP2D BEM Fakultas Pertanian Unsika mengatakan bahwa prestasi ini dapat diraih karena kerja keras yang dilakukan bersama-sama. “Banyak perjuangan yang telah kami lakukan untuk sampai pada tahap ini. Semangat merupakan motivasi awal bagi kami agar terus optimis melaksanakan program ini demi kemajuan desa”, ujar Fikri, Rabu (08/12/2021).</p><p>Rektor serta Wakil Dekan Bidang Akademik dan Kemahasiswaan Fakultas Pertanian turut mengucapkan rasa syukur dan bangganya atas prestasi yang telah ditorehkan. Wujud tindakan yang wajib dilaksanakan dalam menjadi seorang mahasiswa adalah pengaplikasian dan pengabdian.</p><p>“Saya sangat bangga terhadap pencapaian tim BEM Faperta. Penghargaan ini dicapai dari hasil kerja keras mahasiswa dalam menjalankan pengabdian kepada masyarakat melalui PHP2D”, ujar Winda Rianti, S.P., M.Sc., selaku dosen pendamping tim PHP2D, Rabu (08/12/2021). Ia juga berharap penghargaan ini dapat memberi motivasi kepada mahasiswa Fakultas Pertanian pada khususnya dan Unsika pada umumnya, agar terus berprestasi baik secara nasional maupun internasional.</p><p>Tidak hanya itu, program Edu-Agrowisata di Desa Lemahmulya nantinya dapat menjadi salah satu media pembelajaran yang mengedukasi siswa-siswi sekolah dasar yang ada di sekitar desa. Lemahmulya Park akan terus dikembangkan dan memperluas kemitraan pada lembaga manapun yang senantiasa mendukung keberlanjutan program.</p>', 1641756287, 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `semester` int(1) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `is_open` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `classroom`
--

INSERT INTO `classroom` (`id`, `name`, `semester`, `prodi_id`, `is_open`) VALUES
(1, 'A', 4, 1, 1),
(2, 'B', 4, 1, 1),
(3, 'C', 4, 1, 1),
(4, 'A', 3, 1, 1),
(5, 'B', 3, 1, 1),
(6, 'C', 3, 1, 1),
(7, 'A', 4, 2, 1),
(8, 'B', 4, 2, 1),
(12, 'C', 4, 2, 1),
(13, 'D', 4, 2, 1),
(15, 'A', 1, 2, 1),
(16, 'B', 1, 2, 1),
(17, 'C', 1, 2, 1),
(19, 'A', 1, 1, 1),
(20, 'B', 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `classroom_users`
--

CREATE TABLE `classroom_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `time_group` char(1) DEFAULT NULL,
  `accepted` int(11) NOT NULL,
  `date_accepted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `classroom_users`
--

INSERT INTO `classroom_users` (`id`, `user_id`, `classroom_id`, `time_group`, `accepted`, `date_accepted`) VALUES
(13, 10, 17, 'A', 0, NULL),
(22, 14, 2, 'C', 1, '2021-05-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `sks` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `course`
--

INSERT INTO `course` (`id`, `name`, `sks`) VALUES
(3, 'Aljabar Linier', 3),
(4, 'Sistem Informasi', 3),
(5, 'Matematika Diskrit', 3),
(6, 'Pemograman Web', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id`, `name`) VALUES
(1, 'Sistem Informasi'),
(2, 'Sistem Informasi Akutansi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `day` varchar(60) NOT NULL,
  `timeGroup` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `schedule`
--

INSERT INTO `schedule` (`id`, `course_id`, `classroom_id`, `time_start`, `time_end`, `day`, `timeGroup`) VALUES
(3, 3, 1, '16:00:00', '17:30:00', 'Senin', 'A'),
(4, 4, 1, '13:00:00', '14:30:00', 'Selasa', 'A'),
(7, 5, 2, '07:30:00', '09:00:00', 'Senin', 'B'),
(8, 6, 2, '13:00:00', '14:30:00', 'Rabu', 'C'),
(9, 6, 2, '10:00:00', '11:30:00', 'Selasa', 'B'),
(10, 3, 3, '15:00:00', '16:30:00', 'Kamis', 'C'),
(13, 5, 4, '10:30:00', '12:00:00', 'Selasa', 'A'),
(18, 5, 15, '15:00:00', '16:30:00', 'Kamis', 'B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `npm` varchar(20) NOT NULL,
  `avatar` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `year_join` int(4) NOT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `fakultas` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `npm`, `avatar`, `password`, `year_join`, `prodi_id`, `fakultas`, `role_id`, `is_active`, `date_created`) VALUES
(2, 'Roland Vincent', 'roland.vincentnet@gmail.com', '', '990530e26886b525c269e09b6dfcaa882.jpg', '$2y$10$zBXIOXSpzof3/GCA/R2NMe//MhNtjyRL2ejVlAd2ay5yr/0iz.P0W', 0, 0, '', 1, 1, 1621607512),
(10, 'Roland Vincent', 'roland.vincent10032001in2@hotmail.com', '1911121211212', 'default.png', '$2y$10$Lxc.sm/RPYWw8zFTpm.K0uKZtHwntaiEz6SBKd1Gx/E3rztBv/bLO', 0, NULL, 'Ilmu Santet', 2, 1, 1621693809),
(13, 'Admin', 'admin@gmail.com', '0', 'unsika.png', '$2y$10$5Yk5MWOKEU6fkzx8qWBJHOJVDNe9sWWPQIAK9UlfcQQwB67XElw9i', 0, NULL, '0', 1, 1, 2147483647),
(14, 'Roland Vincent', 'roland.vincent10032001@gmail.com', '1910631170200', 'v2-34c65f2e224076866988843276446674_1440w1.jpg', '$2y$10$cyGKBIJg6HwrqgWyK.VxrORXWNHG7ZpDcNWO/JSnU.payWl/O2Kgy', 0, NULL, '', 2, 1, 1621791695),
(16, 'Roland Vincent Sitanggang', 'roland.vincent19131@student.unsika.ac.id', '1910631170131', '029fd096e0e6ce101292226921243a91.jpg', '$2y$10$Ey924dS714Ue7MOmsx8K3e7RFHMKENe5sJwM5zuCM6/5HZryNW1ue', 2019, 1, 'Ilmu Komputer', 2, 1, 1621816701);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(11, 2, 2),
(27, 1, 2),
(28, 1, 3),
(29, 2, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(5, 'Student');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(8, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(10, 1, 'User Management', 'admin/usermanager', 'fas fa-fw fa-users-cog', 1),
(11, 1, 'Classroom Management', 'admin/classroom', 'fab fa-fw fa-joomla', 1),
(12, 1, 'Course Schedule', 'admin/schedule', 'fas fa-fw fa-calendar-alt', 1),
(13, 1, 'Student Room', 'admin/student', 'fas fa-fw fa-user-graduate', 1),
(14, 5, 'Schedule', 'student', 'fas fa-fw fa-calendar-alt', 1),
(15, 1, 'Berita', 'admin/berita', 'fas fa-newspaper', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(64) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(11, 'roland.vincent19131@student.unsika.ac.id', '0uGPxhCTjo1T6Uuc16g74Nr4yQHtelA/FIlIQgRl0qI=', 1621816561),
(12, 'roland.vincent19131@student.unsika.ac.id', 'Sk0l5kxic+pJBT5TbHBHdA0IrPCEDsScnRqIA2KbOtU=', 1621816701);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_message`
--
ALTER TABLE `admin_message`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `classroom_users`
--
ALTER TABLE `classroom_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `npm` (`npm`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_message`
--
ALTER TABLE `admin_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `classroom_users`
--
ALTER TABLE `classroom_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
