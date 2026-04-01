const searchInput = document.getElementById("searchInput");
const sortSelect = document.getElementById("sortSelect");
const kategoriSelect = document.getElementById("kategoriSelect");

const items = document.querySelectorAll(".berita-item");

function filterData() {
    const search = searchInput.value.toLowerCase();
    const kategori = kategoriSelect.value;

    items.forEach(item => {
        const judul = item.dataset.judul;
        const kat = item.dataset.kategori;

        let show = true;

        if (!judul.includes(search)) show = false;
        if (kategori && kat !== kategori) show = false;

        item.style.display = show ? "flex" : "none";
    });
}

function sortData() {
    const container = document.getElementById("beritaList");
    const itemsArray = Array.from(items);

    const sort = sortSelect.value;

    itemsArray.sort((a, b) => {
        const dateA = new Date(a.dataset.tanggal);
        const dateB = new Date(b.dataset.tanggal);

        if (sort === "terbaru") return dateB - dateA;
        if (sort === "terlama") return dateA - dateB;
        if (sort === "az") return a.dataset.judul.localeCompare(b.dataset.judul);
        if (sort === "za") return b.dataset.judul.localeCompare(a.dataset.judul);
    });

    itemsArray.forEach(el => container.appendChild(el));
}

searchInput.addEventListener("input", filterData);
kategoriSelect.addEventListener("change", filterData);
sortSelect.addEventListener("change", sortData);