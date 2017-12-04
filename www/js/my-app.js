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

//Al cargarse la ventana de Perfil
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

myApp.onPageInit('schedule-form', function (page) {
  $.get("https://seguridad1315.000webhostapp.com/MiAgenda/Data/getTeachers.php", function(respuesta4){
    data = JSON.parse(respuesta4);
    teachers="";
    for (i = 0; i < data.length; i++) { 
      teachers+="<option name='maestro' value='"+data[i]+"''>"+data[i]+"</option>";
    }
    document.getElementById("teachers-list").innerHTML = teachers;
  });
});

/*myApp.onPageInit('schedule', function (page) {
  var codigo = localStorage.getItem('codigo');
  $.post("https://seguridad1315.000webhostapp.com/MiAgenda/Data/getStudentSubject.php", {codigo: codigo}, function(respuesta4){
    data = JSON.parse(respuesta4);
    //alert(data[0][0]);
    materias="";
    for (i = 0; i < data.length; i++) { 
      materias +="<div class='row'><div class='cell' data-title='NRC'>"+data[i][0]+"</div><div class='cell' data-title='Codigo'>"+data[i][1]+"</div><div class='cell' data-title='Nombre'>"+data[i][2]+"</div><div class='cell' data-title='Profesor'>"+data[i][3]+"</div><div class='cell' data-title='Modulo'>"+data[i][4]+"</div></div>";
    }
    document.getElementById("schedule-list").innerHTML = materias;
  });
  var atras = document.getElementsByClassName("refresh")[0];
  atras.onclick = function(){
    location.href = "menu.html";
  }
});*/

myApp.onPageInit('map', function (page) {
    var modulo = localStorage.getItem('modulo');
    var latitud =0;
    var longitud=0;
    if(modulo=="X"){
      latitud=20.658233;
      longitud=-103.327155;
    }
    if(modulo=="W"){
      latitud=20.658031;
      longitud=-103.327123;
    }
    if(modulo=="U"){
      latitud=20.658129;
      longitud=-103.325547;
    }
    if(modulo=="T"){
      latitud=20.657903;
      longitud=-103.325480;
    }
    if(modulo=="Beta" || modulo=="Bet"){
      latitud=20.656242;
      longitud=-103.325239;
    }
    var map = new google.maps.Map(document.getElementById('map'), {
      mapTypeControl: false,
      center: {lat: latitud, lng: longitud},
      zoom: 19
    });
    var marker = new google.maps.Marker({
      position: {lat: latitud, lng: longitud},
      map: map
    });
});

/*myApp.onPageAfterBack('schedule2', function (page) {
  location.reload();
});*/

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

//Maestro App
myApp.onPageInit('teacher-profile', function (page) {
  //Se cargan el nombre y la foto
  var codigo = localStorage.getItem('codigo') || '<empty>';
  $.post("https://seguridad1315.000webhostapp.com/MiAgenda/Data/getTeacherData.php", {codigo: codigo}, function(respuesta){
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
            $.post("https://seguridad1315.000webhostapp.com/MiAgenda/Data/updateTeacherPhoto.php", {codigo: codigo, foto: foto}, function(respuesta2){
              myApp.alert(respuesta2, 'Cambio de foto', function () {
                location.reload();
              });
            });
        };
        fileReader.readAsDataURL(fileToLoad);
      }
  });
});

myApp.onPageInit('presenceList', function (page) {
  var nrc = localStorage.getItem('teacherNrc');
  $.post("https://seguridad1315.000webhostapp.com/MiAgenda/Data/getStudents.php", {nrc: nrc}, function(respuesta){
    data = JSON.parse(respuesta);
    students="";
    for (i = 0; i < data.length; i++) { 
       students="<li><label class='label-checkbox item-content'><input type='checkbox' name='"+data[i][0]+"' value='"+data[i][0]+"'><div class='item-media'><i class='icon icon-form-checkbox'></i></div><div class='item-inner'><div class='item-title'>"+data[i][1]+"</div></div></label></li>";
     }
    document.getElementById("presenceList").innerHTML = students;
  });
});      