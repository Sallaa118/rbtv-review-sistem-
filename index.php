<?php 
include 'config/database.php';
include 'includes/header.php';
?>

<link rel="stylesheet" href="assets/css/index.css">

<!-- HERO -->
<div class="hero">
    <div class="hero-content">
        <h1>Sistem Review Program RBTV</h1>
        <p>
            Platform untuk memberikan ulasan dan feedback terhadap program berita RBTV.
            Suara Anda membantu kami memberikan konten berita yang lebih baik.
        </p>
        <a href="ulasan.php" class="btn-primary">Beri Ulasan Sekarang</a>
    </div>
</div>

<div class="container">

    <!-- BERITA -->
    <div class="section-header">
        <h2>Berita Terkini</h2>
        <a href="program.php">Lihat Semua</a>
    </div>

    <p class="subtitle">Program berita terbaru dari RBTV</p>

    <div class="berita-grid">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal_berita DESC LIMIT 5");

        while($row = mysqli_fetch_assoc($query)) {
        ?>
            <div class="card">
                <img src="assets/img/berita/<?php echo $row['gambar_berita']; ?>">

                <div class="card-body">
                    <div class="top-label">
                        <span class="kategori"><?php echo $row['kategori_berita']; ?></span>
                    </div>

                    <h3><?php echo $row['judul_berita']; ?></h3>

                    <p class="tanggal">
                        <?php echo date('d F Y', strtotime($row['tanggal_berita'])); ?>
                    </p>

                    <a href="detail.php?id=<?php echo $row['id_berita']; ?>" class="btn-detail">Detail</a>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- ULASAN -->
    <div class="section-header">
        <h2>Ulasan Pengguna</h2>
        <a href="ulasan.php">Lihat Semua</a>
    </div>

    <p class="subtitle">Apa kata pengguna tentang program kami</p>

    <div class="ulasan-container">
        <?php
        $query = mysqli_query($conn, 
            "SELECT ulasan.*, berita.gambar_berita 
            FROM ulasan
            LEFT JOIN berita 
            ON ulasan.judul_berita = berita.judul_berita 
            AND ulasan.kategori_berita = berita.kategori_berita
            WHERE ulasan.status='Approved'
            ORDER BY ulasan.waktu_kirim DESC
            LIMIT 5");

        while($row = mysqli_fetch_assoc($query)) {
        ?>
            <div class="ulasan-card">

                <div class="content">

                    <!-- HEADER -->
                    <div class="ulasan-header">
                        <span class="kategori"><?php echo $row['kategori_berita']; ?></span>

                        <a href="detail.php?judul=<?php echo urlencode($row['judul_berita']); ?>&kategori=<?php echo $row['kategori_berita']; ?>" 
                        class="badge-berita">
                            Berita
                        </a>
                    </div>

                    <!-- THUMBNAIL + JUDUL -->
                    <div class="berita-info">

                        <img src="assets/img/berita/<?php echo $row['gambar_berita'] ?: 'default.jpg'; ?>" alt="">

                        <div class="text">
                            <small class="berita-ref">
                                <?php echo $row['judul_berita']; ?>
                            </small>
                        </div>

                    </div>

                    <!-- RATING -->
                    <div class="rating">
                        <?php 
                        for($i=1; $i<=5; $i++) {
                            echo $i <= $row['rating'] ? "⭐" : "☆";
                        }
                        ?>
                    </div>

                    <!-- ULASAN -->
                    <p class="ulasan-text">
                        <?php echo $row['isi_ulasan_raw']; ?>
                    </p>

                </div>

                <!-- USER -->
                <div class="user">
                    <?php echo $row['nama_user']; ?>
                </div>

            </div>
        <?php } ?>
    </div>

</div>

<!-- CTA PINDAH KE SINI -->
<div class="cta">
    <h2>Bantu Kami Meningkatkan Kualitas Program</h2>
    <p>
        Ulasan Anda sangat berharga bagi kami untuk terus meningkatkan kualitas program berita.
    </p>
    <a href="ulasan.php">Mulai Beri Ulasan</a>
</div>

<script src="assets/js/index.js"></script>

<?php include 'includes/footer.php'; ?>