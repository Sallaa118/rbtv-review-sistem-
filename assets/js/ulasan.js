// RATING INTERAKTIF
const stars = document.querySelectorAll(".star");
const ratingValue = document.getElementById("ratingValue");

stars.forEach(star => {
    star.addEventListener("click", () => {
        let val = star.dataset.value;
        ratingValue.value = val;

        stars.forEach(s => {
            s.classList.remove("active");
            if(s.dataset.value <= val){
                s.classList.add("active");
                s.textContent = "★";
            } else {
                s.textContent = "☆";
            }
        });
    });
});

// FILTER KATEGORI → JUDUL
const kategoriSelect = document.getElementById("kategoriSelect");
const judulSelect = document.getElementById("judulSelect");

kategoriSelect.addEventListener("change", () => {
    let kategori = kategoriSelect.value;

    for(let option of judulSelect.options){
        let kat = option.getAttribute("data-kategori");

        if(!kategori || kat === kategori){
            option.style.display = "block";
        } else {
            option.style.display = "none";
        }
    }
});

// SEARCH JUDUL
document.getElementById("searchBerita").addEventListener("input", function(){
    let val = this.value.toLowerCase();

    for(let option of judulSelect.options){
        if(option.text.toLowerCase().includes(val)){
            option.style.display = "block";
        } else {
            option.style.display = "none";
        }
    }
});

const alertBox = document.querySelector(".alert");

if(alertBox){
    setTimeout(() => {
        alertBox.style.display = "none";
    }, 3000);
}

document.querySelector("form").addEventListener("submit", function(e){
    const rating = document.getElementById("ratingValue").value;

    if(!rating){
        alert("Rating wajib dipilih!");
        e.preventDefault();
    }
});