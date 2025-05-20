// Modal elementleri
var modal = document.getElementById("loginModal");
var favoriteButton = document.getElementById("favoriteButton");
var closeModal = document.getElementById("closeModal");
var redirectToLogin = document.getElementById("redirectToLogin");

// Favori butonuna tıklanıldığında modal göster
favoriteButton.onclick = function(event) {
    event.preventDefault(); // Linkin normal işlevini engeller
    modal.style.display = "block";
}

// Modalı kapatmak için X butonuna tıklanıldığında
closeModal.onclick = function() {
    modal.style.display = "none";
}

// Tamam butonuna tıklanıldığında giriş sayfasına yönlendir
redirectToLogin.onclick = function() {
    window.location.href = "login.html"; // Giriş sayfasına yönlendirir
}

// Modal dışına tıklanıldığında modalı kapat
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Geri butonuna tıklanıldığında sayfayı geri gitmek
document.getElementById("backButton").onclick = function() {
    window.history.back(); // Bir önceki sayfaya geri dön
}

// "Tamam" butonuna tıklanıldığında giriş sayfasına yönlendirme
document.getElementById("redirectToLogin").onclick = function() {
    window.location.href = "login.html"; // Giriş sayfasına yönlendirir
}
