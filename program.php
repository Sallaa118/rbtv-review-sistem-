<?php 
include 'config/database.php';
include 'includes/header.php';
?>

<link rel="stylesheet" href="assets/css/program.css">

<div class="program-container">

    <!-- HERO -->
    <div class="program-hero">
        <h1>Program Berita RBTV</h1>
        <p>Jelajahi seluruh program berita terbaru dan terupdate dari RBTV</p>
    </div>

    <!-- FILTER -->
    <div class="filter-bar">
        <input type="text" id="searchInput" placeholder="Cari berita...">

        <select id="sortSelect">
            <option value="terbaru">Terbaru</option>
            <option value="terlama">Terlama</option>
            <option value="az">Judul A-Z</option>
            <option value="za">Judul Z-A</option>
        </select>

        <select id="kategoriSelect">
            <option value="">Semua Kategori</option>
            <option value="Malam">Berita Malam</option>
            <option value="Daerah">Berita Daerah</option>
            <option value="Pekaro">Pekaro</option>
        </select>
    </div>

    <!-- LIST -->
    <div id="beritaList">

        <?php
        $query = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal_berita DESC");

        while($row = mysqli_fetch_assoc($query)) {
        ?>

        <div class="berita-item"
            data-judul="<?php echo strtolower($row['judul_berita']); ?>"
            data-kategori="<?php echo $row['kategori_berita']; ?>"
            data-tanggal="<?php echo $row['tanggal_berita']; ?>"
        >

            <!-- IMAGE -->
            <div class="thumb">
                <img src="assets/img/berita/<?php echo $row['gambar_berita']; ?>">
            </div>

            <!-- CONTENT -->
            <div class="berita-content">

                <div class="top">
                    <span class="kategori"><?php echo $row['kategori_berita']; ?></span>
                </div>

                <h3><?php echo $row['judul_berita']; ?></h3>

                <p><?php echo substr($row['caption_berita'], 0, 120); ?>...</p>

                <div class="meta">
                    <?php echo date('d F Y', strtotime($row['tanggal_berita'])); ?>
                </div>
            </div>

            <!-- ACTION -->
            <div class="action">
                <a href="detail.php?id=<?php echo $row['id_berita']; ?>" class="btn-detail">
                    Detail
                </a>
            </div>

        </div>

        <?php } ?>

    </div>

</div>

<script src="assets/js/program.js"></script>

<?php include 'includes/footer.php'; ?>