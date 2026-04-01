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

if(!$data){
    echo "<h2 style='padding:50px'>Berita tidak ditemukan</h2>";
    exit;
}

/* =========================
   AMBIL ULASAN + RATING
========================= */
$ulasan = mysqli_query($conn, "
    SELECT * FROM ulasan 
    WHERE judul_berita='".$data['judul_berita']."' 
    AND kategori_berita='".$data['kategori_berita']."'
    AND status='Approved'
    ORDER BY waktu_kirim DESC
");

$count = mysqli_num_rows($ulasan);
$total = 0;

$temp = [];
while($row = mysqli_fetch_assoc($ulasan)){
    $total += $row['rating'];
    $temp[] = $row;
}

$avg = $count > 0 ? round($total/$count,1) : 0;
?>

<link rel="stylesheet" href="assets/css/detail.css">

<div class="detail-container">

    <!-- BACK -->
    <a href="program.php" class="btn-back">← Kembali ke Program</a>

    <!-- MAIN CARD -->
    <div class="detail-card">

        <!-- IMAGE -->
        <div class="detail-hero">
            <img src="assets/img/berita/<?php echo $data['gambar_berita']; ?>">
        </div>

        <!-- CONTENT -->
        <div class="detail-content">

            <span class="kategori"><?php echo $data['kategori_berita']; ?></span>

            <h1><?php echo $data['judul_berita']; ?></h1>

            <!-- META -->
            <div class="meta">
                <span>
                    <?php echo date('l, d F Y', strtotime($data['tanggal_berita'])); ?>
                </span>

                <span class="rating-summary">
                    ⭐ <?php echo $avg; ?> (<?php echo $count; ?> ulasan)
                </span>
            </div>

            <hr>

            <p class="caption">
                <?php echo nl2br($data['caption_berita']); ?>
            </p>

            <!-- BUTTON -->
            <div class="action-btn">
                <a href="ulasan.php" class="btn-primary">Beri Ulasan</a>
                <a href="program.php" class="btn-secondary">Lihat Program Lain</a>
            </div>

        </div>

    </div>

    <!-- ULASAN -->
    <div class="ulasan-section">

        <h2>Ulasan Pengguna</h2>

        <?php if($count > 0): ?>
            <div class="ulasan-list">
                <?php foreach($temp as $row): ?>

                    <div class="ulasan-card">

                        <!-- TOP -->
                        <div class="ulasan-top">
                            <div class="rating">
                                <?php 
                                for($i=1;$i<=5;$i++){
                                    echo $i <= $row['rating'] ? "⭐" : "☆";
                                }
                                ?>
                            </div>

                            <span class="tanggal">
                                <?php echo date('d F Y', strtotime($row['waktu_kirim'])); ?>
                            </span>
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

                <?php endforeach; ?>
            </div>    
        <?php else: ?>
            <p class="no-ulasan">Belum ada ulasan untuk berita ini</p>
        <?php endif; ?>

    </div>

</div>

<script src="assets/js/detail.js"></script>

<?php include 'includes/footer.php'; ?>