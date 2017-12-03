// Determine theme depending on device
var isAndroid = Framework7.prototype.device.android === true;
var isIos = Framework7.prototype.device.ios === true;
 
// Set Template7 global devices flags
Template7.global = {
    android: isAndroid,
    ios: isIos
};
 
// Define Dom7
var $$ = Dom7;
 
// Change Through navbar layout to Fixed
if (!isIos) {
    // Change class
    $$('.view.navbar-through').removeClass('navbar-through').addClass('navbar-fixed');
    // And move Navbar into Page
    $$('.view .navbar').prependTo('.view .page');
}
 
// Init App
var myApp = new Framework7({
    // Enable Material theme for Android device only
    material: isIos ? false : true,
    // Enable Template7 pages
    template7Pages: true,
    swipePanel: 'right'
});
 
// Init View
var mainView = myApp.addView('.view-main', {
    dynamicNavbar: true
});

//Al cargarse la ventana de Acerca de
myApp.onPageInit('profile', function (page) {
  //Se cargan el nombre y la foto
  var codigo = localStorage.getItem('codigo') || '<empty>';
  $.post("https://seguridad1315.000webhostapp.com/MiAgenda/Data/getUser.php", {codigo: codigo}, function(respuesta){
      valores = respuesta.split("|");
      document.getElementById("user2").innerHTML = valores[1];
      newImage = "<img class='img-circle' src="+valores[2]+"\" alt='Fotografia'>";
      document.getElementById("photo2").innerHTML = newImage;
  });

  //Cambiar foto de perfil
  $('#imageInput').change(function(){
    var filesSelected = document.getElementById("imageInput").files;
    if (filesSelected.length > 0){
        var fileToLoad = filesSelected[0];
        var fileReader = new FileReader();
        fileReader.onload = function(fileLoadedEvent) {
            foto = fileLoadedEvent.target.result;
            $.post("https://seguridad1315.000webhostapp.com/MiAgenda/Data/updatePhoto.php", {codigo: codigo, foto: foto}, function(respuesta2){
              myApp.alert(respuesta2, 'Cambio de foto', function () {
                location.reload();
              });
            });
        };
        fileReader.readAsDataURL(fileToLoad);
      }
  });
});

var swiper = new Swiper('.swiper-container', {
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});