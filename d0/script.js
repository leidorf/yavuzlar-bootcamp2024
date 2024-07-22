//Cikis fonksiyonu
function logOut() {
  window.location.href = "index.html";
}
document.getElementById("logoutButton").addEventListener("click", logOut);

//Anasayfaya donus fonksiyonu
function goToHomePage() {
  window.location.href = "homePage.html";
}
document.getElementById("homePageButton").addEventListener("click", goToHomePage);
