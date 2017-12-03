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

myApp.onPageInit('news', function (page) {
  var idNews = localStorage.getItem('noticiaId');
  $.post("https://seguridad1315.000webhostapp.com/MiAgenda/Data/getInfoNews.php", {id: idNews}, function(respuesta3){
    dataNews = JSON.parse(respuesta3);
    document.getElementById("news-title").innerHTML = dataNews[0];
    document.getElementById("news-date").innerHTML = dataNews[4];
    document.getElementById("news-img").innerHTML = "<img width='400' height='200s' src='"+dataNews[3]+"'>";
    document.getElementById("news-description").innerHTML = dataNews[1];
    document.getElementById("news-type").innerHTML = dataNews[2];
  });
});

myApp.onPageInit('schedule', function (page) {
  var atras = document.getElementsByClassName("refresh")[0];
  atras.onclick = function(){
        location.href = "menu.html";
    }
});

myApp.onPageInit('map', function (page) {
    var map = new google.maps.Map(document.getElementById('map'), {
      mapTypeControl: false,
      center: {lat: 20.658031, lng: -103.327123},
      zoom: 19
    });
    var marker = new google.maps.Marker({
      position: {lat: 20.658031, lng: -103.327123},
      map: map
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