<?php
session_start();
include 'config/database.php';
include 'includes/header.php';
?>

<link rel="stylesheet" href="assets/css/ulasan.css">

<div class="ulasan-page">

    <!-- HERO -->
    <div class="ulasan-hero">
        <h1>Beri Ulasan</h1>
        <p>Bagikan pendapat Anda tentang program berita RBTV</p>
    </div>

    <!-- NOTIF -->
    <?php if(isset($_SESSION['notif'])): ?>
        <div class="alert">
            <?php echo $_SESSION['notif']; ?>
        </div>
    <?php unset($_SESSION['notif']); endif; ?>

    <!-- FORM -->
    <div class="form-wrapper">

        <form action="proses_ulasan.php" method="POST">
            <h3>Formulir Ulasan</h3>
            <div class="form-grid">
                
                <!-- LEFT SIDE -->
                <div class="form-left">

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

                    <!-- JUDUL -->
                    <label>Pilih Berita</label>
                    <select name="judul_berita" id="judulSelect" required>
                        <option value="">Pilih berita yang ingin diulas</option>

                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM berita");
                        while($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <option 
                                value="<?php echo $row['judul_berita']; ?>" 
                                data-kategori="<?php echo $row['kategori_berita']; ?>">
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
                </div>

                <!-- RIGHT SIDE -->
                <div class="form-right">

                    <!-- ULASAN -->
                    <label>Ulasan Anda</label>
                    <textarea name="isi_ulasan" placeholder="Tulis ulasan Anda..." required></textarea>

                    <!-- NAMA -->
                    <label>Nama Pemberi Ulasan</label>
                    <input type="text" name="nama_user" id="namaInput" placeholder="Nama lengkap Anda">

                    <!-- ANONIM -->
                    <div class="anonim-box">
                        <input type="checkbox" id="anonimCheck">
                        <label>Kirim sebagai anonim</label>
                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn-submit">Kirim Ulasan</button>

        </form>

    </div>

    <!-- ULASAN LIST -->
    <div class="ulasan-list-section">

        <h3>Ulasan Sebelumnya</h3>

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
            LIMIT 10");

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

                    <!-- THUMB -->
                    <div class="berita-info">
                        <img src="assets/img/berita/<?php echo $row['gambar_berita'] ?: 'default.jpg'; ?>">
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

                    <!-- TEXT -->
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

</div>

<script src="assets/js/ulasan.js"></script>

<?php include 'includes/footer.php'; ?>