<?php
session_start();
?>
<?php include 'config/database.php'; ?>
<?php include 'includes/header.php'; ?>


<link rel="stylesheet" href="assets/css/ulasan.css">

<div class="ulasan-page">

    <!-- HEADER -->
    <div class="ulasan-hero">
        <h1>Beri Ulasan</h1>
        <p>Bagikan pendapat Anda tentang program berita RBTV</p>
    </div>

    <?php if(isset($_SESSION['notif'])): ?>
        <div class="alert">
            <?php echo $_SESSION['notif']; ?>
        </div>
    <?php unset($_SESSION['notif']); endif; ?>

    <!-- FORM -->
    <div class="form-container">
        <h3>Form Ulasan</h3>

        <form action="proses_ulasan.php" method="POST">

            <!-- KATEGORI -->
            <label>Pilih Kategori</label>
            <select name="kategori_berita" id="kategoriSelect">
                <option value="">Semua Kategori</option>
                <option value="Malam">Malam</option>
                <option value="Daerah">Daerah</option>
                <option value="Pekaro">Pekaro</option>
            </select>

            <!-- SEARCH -->
            <label>Cari Berita</label>
            <input type="text" id="searchBerita" placeholder="Cari berdasarkan judul...">

            <!-- JUDUL BERITA -->
            <label>Pilih Berita</label>
            <select name="judul_berita" id="judulSelect" required>
                <option value="">Pilih berita yang ingin diulas</option>

                <?php
                $query = mysqli_query($conn, "SELECT * FROM berita");
                while($row = mysqli_fetch_assoc($query)) {
                ?>
                    <option value="<?php echo $row['judul_berita']; ?>" data-kategori="<?php echo $row['kategori_berita']; ?>">
                        <?php echo $row['judul_berita']; ?>
                    </option>
                <?php } ?>

            </select>

            <!-- RATING -->
            <label>Rating Bintang</label>
            <div class="rating-stars">
                <?php for($i=1;$i<=5;$i++){ ?>
                    <span class="star" data-value="<?php echo $i; ?>">☆</span>
                <?php } ?>
            </div>
            <input type="hidden" name="rating" id="ratingValue" required>

            <!-- ULASAN -->
            <label>Ulasan Anda</label>
            <textarea name="isi_ulasan" placeholder="Tulis ulasan Anda..." required></textarea>

            <!-- NAMA -->
            <label>Nama Pemberi Ulasan</label>
            <input type="text" name="nama_user" placeholder="Nama lengkap Anda">

            <div class="anonim-box">
                <input type="checkbox" id="anonimCheck">
                <label>Kirim sebagai anonim</label>
            </div>

            <button type="submit">Kirim Ulasan</button>

        </form>
    </div>

    <!-- ULASAN SEBELUMNYA -->
    <div class="ulasan-list-section">

        <h3>Ulasan Sebelumnya</h3>

        <div class="ulasan-list">

        <?php
        $query = mysqli_query($conn, "SELECT * FROM ulasan WHERE status='Approved' ORDER BY waktu_kirim DESC LIMIT 10");

        while($row = mysqli_fetch_assoc($query)) {
        ?>
            <div class="ulasan-card">

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
                    <?php echo substr($row['isi_ulasan_raw'],0,100); ?>...
                </p>

                <!-- BERITA -->
                <div class="berita-info">
                    <span class="kategori"><?php echo $row['kategori_berita']; ?></span>

                    <a href="detail.php?judul=<?php echo urlencode($row['judul_berita']); ?>&kategori=<?php echo $row['kategori_berita']; ?>" class="btn-berita">
                        Berita
                    </a>
                </div>

                <small><?php echo $row['judul_berita']; ?></small>

                <!-- USER -->
                <div class="user">
                    <?php echo $row['nama_user']; ?>
                </div>

            </div>
        <?php } ?>

        </div>

    </div>

</div>

<script src="assets/js/ulasan.js"></script>

<?php include 'includes/footer.php'; ?>