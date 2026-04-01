<?php 
include 'includes/header.php';
?>

<link rel="stylesheet" href="assets/css/kontak.css">

<div class="kontak-container">

    <!-- HERO -->
    <div class="kontak-hero">
        <h1>Hubungi Kami</h1>
        <p>Kami siap membantu Anda terkait sistem review RBTV</p>
    </div>

    <!-- CONTENT -->
    <div class="kontak-content">

        <!-- FORM -->
        <div class="kontak-form">
            <h3>Kirim Pesan</h3>

            <form>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" placeholder="Masukkan nama Anda">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="Masukkan email Anda">
                </div>

                <div class="form-group">
                    <label>Pesan</label>
                    <textarea rows="5" placeholder="Tulis pesan Anda..."></textarea>
                </div>

                <button type="submit" class="btn-kirim">Kirim Pesan</button>
            </form>
        </div>

        <!-- INFO -->
        <div class="kontak-info">
            <h3>Informasi Kontak</h3>

            <div class="info-item">
                <strong>Email</strong>
                <p>info@rbtv.co.id</p>
            </div>

            <div class="info-item">
                <strong>Telepon</strong>
                <p>+62 21 1234 5678</p>
            </div>

            <div class="info-item">
                <strong>Alamat</strong>
                <p>Bengkulu, Indonesia</p>
            </div>
        </div>

    </div>

    <!-- CTA (SAMA SEPERTI INDEX) -->
    <div class="cta">
        <h2>Butuh Bantuan?</h2>
        <p>
            Tim support kami siap membantu Anda dengan pertanyaan 
            atau masalah terkait sistem review RBTV.
        </p>

        <a href="#" class="btn-cta">Chat dengan Kami</a>
    </div>

</div>

<script src="assets/js/kontak.js"></script>

<?php include 'includes/footer.php'; ?>