// optional interaksi
console.log("Halaman Kontak Loaded");

// contoh validasi sederhana
document.querySelector("form").addEventListener("submit", function(e){
    e.preventDefault();
    alert("Pesan berhasil dikirim (dummy)");
});