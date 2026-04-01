<?php 
include 'includes/header.php';
?>

<link rel="stylesheet" href="assets/css/tentang.css">

<!-- ICON CDN -->
<script src="https://unpkg.com/lucide@latest"></script>

<div class="tentang-container">

    <!-- HERO -->
    <div class="tentang-hero">
        <h1>Tentang Sistem Review RBTV</h1>
        <p>
            Platform Multi-Stage Validation Pipeline untuk meningkatkan kualitas program berita RBTV melalui feedback masyarakat
        </p>
    </div>

    <!-- TENTANG PROYEK -->
    <div class="section">
        <h2>Tentang Proyek</h2>

        <div class="card-box">
            <p>
                <strong>Pengembangan Sistem Review Program di RBTV Berbasis Multi-Stage Validation Pipeline</strong> 
                adalah inisiatif untuk menciptakan platform yang memungkinkan masyarakat memberikan ulasan 
                dan feedback terhadap program berita yang disiarkan oleh RBTV.
            </p>
            <br>
            <p>
                Sistem ini dirancang dengan pendekatan multi-stage validation yang memastikan setiap ulasan 
                yang masuk melalui proses verifikasi untuk menjaga kualitas dan relevansi feedback. 
                Dengan platform ini, kami berharap dapat meningkatkan kualitas program berita dan memberikan 
                konten yang lebih sesuai dengan kebutuhan masyarakat.
            </p>
        </div>
    </div>

    <!-- FITUR -->
    <div class="section">
        <h2>Fitur Utama</h2>

        <div class="fitur-grid">

            <div class="fitur-card">
                <h4><i data-lucide="star"></i> Review & Rating</h4>
                <p>Sistem rating bintang dan ulasan untuk setiap program berita</p>
            </div>

            <div class="fitur-card">
                
                <h4><i data-lucide="shield-check"></i> Multi-Stage Validation</h4>
                <p>Validasi bertahap untuk menjaga kualitas ulasan</p>
            </div>

            <div class="fitur-card">
                
                <h4><i data-lucide="layout-dashboard"></i> User-Friendly</h4>
                <p>Antarmuka mudah digunakan oleh semua pengguna</p>
            </div>

            <div class="fitur-card">
                
                <h4><i data-lucide="folder"></i> Kategori Terorganisir</h4>
                <p>Program berita dikelompokkan dengan rapi</p>
            </div>

        </div>
    </div>

    <!-- VISI MISI -->
    <div class="section">
        <h2>Visi & Misi</h2>

        <div class="visi-misi">

            <div class="vm-card">
                <h4>Visi</h4>
                <p>
                    Menjadi platform review terdepan yang menjembatani komunikasi antara RBTV dan masyarakat.
                </p>
            </div>

            <div class="vm-card">
                <h4>Misi</h4>
                <ul>
                    <li>Menyediakan platform feedback yang transparan</li>
                    <li>Meningkatkan kualitas ulasan dengan validasi</li>
                    <li>Membantu RBTV meningkatkan kualitas program</li>
                </ul>
            </div>

        </div>
    </div>

    <!-- DEVELOPER -->
    <div class="section">
        <h2><i data-lucide="users"></i> Developer</h2>

        <div class="dev-grid">

            <div class="dev-card">
                <img src="assets/img/sella.jpg">
                <h4>Sallaa Fikriyatul Arifah</h4>
                <p>Developer</p>
                <span>Universitas Bengkulu</span>
            </div>

            <div class="dev-card">
                <img src="assets/img/najwa.jpg">
                <h4>Najwa Nabilah Wibisono</h4>
                <p>Developer</p>
                <span>Universitas Bengkulu</span>
            </div>

        </div>
    </div>

</div>

<script src="assets/js/tentang.js"></script>
<script>
lucide.createIcons();
</script>

<?php include 'includes/footer.php'; ?>