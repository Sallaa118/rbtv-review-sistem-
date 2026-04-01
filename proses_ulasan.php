<?php
session_start();
include 'config/database.php';

$nama = $_POST['nama_user'] ?: 'Anonim';
$kategori = $_POST['kategori_berita'];
$judul = $_POST['judul_berita'];
$rating = $_POST['rating'];
$ulasan = $_POST['isi_ulasan'];

// VALIDASI RATING
if(empty($rating)){
    session_start();
    $_SESSION['notif'] = "Rating wajib diisi!";
    header("Location: ulasan.php");
    exit;
}

// escape
$ulasan_safe = escapeshellarg($ulasan);

$old_comments = [];

$query_old = mysqli_query($conn, "SELECT isi_ulasan_clean FROM ulasan");

while ($row = mysqli_fetch_assoc($query_old)) {
    if ($row['isi_ulasan_clean']) {
        $old_comments[] = $row['isi_ulasan_clean'];
    }
}

$file_path = "D:\\laragon\\laragon\\www\\rbtv_project\\python_scripts\\temp_comments.json";

file_put_contents($file_path, json_encode($old_comments));

// jalankan python
$command = "D:\\laragon\\laragon\\bin\\python\\python-3.10\\python.exe D:\\laragon\\laragon\\www\\rbtv_project\\python_scripts\\main_filter.py $ulasan_safe $file_path 2>&1";
$output = shell_exec($command);

// decode JSON
$result = json_decode($output, true);

// cek error python
if (!$result) {
    $_SESSION['notif'] = "Terjadi kesalahan saat memproses ulasan!";
    header("Location: ulasan.php");
    exit;
}

// ambil hasil
$clean   = $result['clean_text'] ?? '';
$status  = $result['status'] ?? 'Approved';
$is_spam = $result['is_spam'] ?? 0;
$is_kasar= $result['is_kasar'] ?? 0;
$cosine  = $result['skor_cosine'] ?? 0;

// simpan ke DB
$query = "INSERT INTO ulasan 
(kategori_berita, judul_berita, rating, nama_user, isi_ulasan_raw, isi_ulasan_clean, status, is_spam, is_kasar, skor_cosine) 
VALUES 
('$kategori','$judul','$rating','$nama','$ulasan','$clean','$status','$is_spam','$is_kasar','$cosine')";

mysqli_query($conn, $query);

// set notif sukses
$_SESSION['notif'] = "Ulasan berhasil dikirim!";

// redirect balik
header("Location: ulasan.php");
exit;
?>