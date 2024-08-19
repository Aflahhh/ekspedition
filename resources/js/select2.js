// membuat select2
$(document).ready(function () {
    $(" #alamat_kirim").select2();
});
// end membuat select2

// Event listener untuk memanggil fungsi filter saat isi kotak pencarian berubah
document.getElementById("searchBox").addEventListener("input", filterDropdown);

// Fungsi untuk menerapkan filter pada dropdown
function filterDropdown() {
    // Mendapatkan nilai dari kotak pencarian
    const filter = document.getElementById("searchBox").value.toUpperCase();
    // Mendapatkan elemen dropdown
    const dropdown = document.getElementById("alamat_kirim");
    // Mendapatkan elemen-elemen opsi di dropdown
    const options = dropdown.getElementsByTagName("option");

    // Iterasi melalui setiap opsi
    for (let i = 0; i < options.length; i++) {
        // Mendapatkan teks dari setiap opsi dan mengonversinya menjadi huruf besar
        const textValue = options[i].textContent || options[i].innerText;
        // Jika teks opsi cocok dengan filter, tampilkan; jika tidak, sembunyikan
        if (textValue.toUpperCase().indexOf(filter) > -1) {
            options[i].style.display = "";
        } else {
            options[i].style.display = "none";
        }
    }
}

// Ambil elemen select dan input pencarian
const select = document.getElementById("alamat_kirim");
const searchBox = document.getElementById("searchBox");

// Tambahkan event listener untuk menampilkan dan menyembunyikan input ketika elemen select diklik
select.addEventListener("click", function () {
    this.parentElement.classList.toggle("open");
});

// Tambahkan event listener untuk menyembunyikan input ketika klik di luar elemen select atau input
document.addEventListener("click", function (event) {
    if (!select.contains(event.target)) {
        select.parentElement.classList.remove("open");
    }
});

// Event listener untuk memanggil fungsi filter saat isi kotak pencarian berubah
document.getElementById("searchBox").addEventListener("input", filterDropdown);
