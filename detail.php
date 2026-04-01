<?php
include 'config/database.php';
include 'includes/header.php';

/* =========================
   AMBIL DATA BERITA
========================= */
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $query = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita='$id'");
} else {
    $judul = mysqli_real_escape_string($conn, $_GET['judul']);
    $kategori = mysqli_real_escape_string($conn, $_GET['kategori']);

    $query = mysqli_query($conn, "
        SELECT * FROM berita 
        WHERE judul_berita='$judul' 
        AND kategori_berita='$kategori'
    ");
}

$data = mysqli_fetch_assoc($query);

/* =========================
   VALIDASI DATA
========================= */
if(!$data){
    echo "<h2 style='padding:50px'>Berita tidak ditemukan</h2>";
    exit;
}

/* =========================
   AMBIL ULASAN TERKAIT
========================= */
$ulasan = mysqli_query($conn, "
    SELECT * FROM ulasan 
    WHERE judul_berita='".$data['judul_berita']."' 
    AND kategori_berita='".$data['kategori_berita']."'
    AND status='Approved'
    ORDER BY waktu_kirim DESC
");
?>

<link rel="stylesheet" href="assets/css/detail.css">

<div class="detail-container">

    <!-- HERO IMAGE -->
    <div class="detail-hero">
        <img src="assets/img/berita/<?php echo $data['gambar_berita']; ?>" alt="">
    </div>

    <!-- BACK BUTTON -->
    <a href="program.php" class="btn-back">← Kembali ke Program</a>

    <!-- CONTENT -->
    <div class="detail-content">

        <span class="kategori">
            <?php echo $data['kategori_berita']; ?>
        </span>

        <h1>
            <?php echo $data['judul_berita']; ?>
        </h1>

        <p class="tanggal">
            <?php echo date('l, d F Y', strtotime($data['tanggal_berita'])); ?>
        </p>

        <p class="caption">
            <?php echo nl2br($data['caption_berita']); ?>
        </p>

    </div>

    <!-- ULASAN -->
    <div class="ulasan-section">

        <h2>Ulasan Terkait Berita Ini</h2>

        <div class="ulasan-list">

            <?php 
            if(mysqli_num_rows($ulasan) > 0) {
                while($row = mysqli_fetch_assoc($ulasan)) { 
            ?>

                <div class="ulasan-card">

                    <!-- HEADER -->
                    <div class="ulasan-top">
                        <span class="kategori">
                            <?php echo $row['kategori_berita']; ?>
                        </span>
                    </div>

                    <!-- RATING -->
                    <div class="rating">
                        <?php 
                        for($i=1;$i<=5;$i++){
                            echo $i <= $row['rating'] ? "⭐" : "☆";
                        }
                        ?>
                    </div>

                    <!-- ISI -->
                    <p class="ulasan-text">
                        <?php echo $row['isi_ulasan_raw']; ?>
                    </p>

                    <!-- USER -->
                    <div class="user">
                        <?php echo $row['nama_user']; ?>
                    </div>

                </div>

            <?php 
                }
            } else {
                echo "<p class='no-ulasan'>Belum ada ulasan untuk berita ini</p>";
            }
            ?>

        </div>

    </div>

</div>

<script src="assets/js/detail.js"></script>

<?php include 'includes/footer.php'; ?>