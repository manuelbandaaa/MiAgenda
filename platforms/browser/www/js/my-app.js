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
    $.get("https://seguridad1315.000webhostapp.com/MiAgenda/Data/getAllSubjects.php", function(respuesta10){
      data2 = JSON.parse(respuesta10);
      allSubjects="";
      for (i = 0; i < data2.length; i++) { 
        allSubjects+="<option name='materia' value='"+data2[i]+"''>"+data2[i]+"</option>";
      }
      document.getElementById("teachers-list").innerHTML = teachers;
      document.getElementById("all-subjects-list").innerHTML = allSubjects;
    });
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
    if(modulo == "A"){
        latitud = 20.6539887;
        longitud = -103.32575880000002;
    }
    if(modulo == "B"){
        latitud = 20.653978 ;
        longitud = -103.324872;
    }
    if(modulo == "C"){
        latitud = 20.654201;
        longitud = -103.325049;
    }
    if(modulo == "D"){
        latitud = 20.654482;
        longitud = -103.325311;
    }
    if(modulo == "Biblioteca"){
        latitud = 20.654813;
        longitud = -103.325529;
    }
    if(modulo == "E"){
        latitud = 20.655559;
        longitud = -103.32632;
    }
    if(modulo == "F"){
        latitud = 20.65588;
        longitud = -103.327001;
    }
    if(modulo == "G"){
        latitud = 20.656023;
        longitud = -103.326459;
    }
    if(modulo == "H"){
        latitud = 20.656068;
        longitud = -103.325958;
    }
    if(modulo == "I"){
        latitud = 20.656078;
        longitud = 103.325593;
    }
    if(modulo == "J"){
        latitud = 20.656184;
        longitud = -103.326036;
    }
    if(modulo == "K"){
        latitud = 20.65637;
        longitud = 103.326001;
    }
    if(modulo == "L"){
        latitud = 20.656766;
        longitud = -103.32525;
    }
    if(modulo == "M"){
        latitud = 20.656651;
        longitud = -103.326162;
    }
    if(modulo == "N"){
        latitud = 20.656944;
        longitud =  -103.32618;
    }
    if(modulo == "O"){
        latitud = 20.657288;
        longitud = -103.326256;
    }
    if(modulo == "P"){
        latitud = 20.657323;
        longitud = -103.325392;
    }
    if(modulo == "Q"){
        latitud = 20.657617;
        longitud = -103.324877;
    }
    if(modulo == "R"){
        latitud = 20.657639;
        longitud = -103.325682;
    }
    if(modulo == "S"){
        latitud = 20.657895;
        longitud = -103.326441;
    }
    if(modulo == "V1"){
        latitud = 20.658297;
        longitud = -103.326162;
    }
    if(modulo == "V2"){
        latitud = 20.658104;
        longitud = -103.326248;
    }
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
    if(modulo=="Alfa" || modulo=="Alf"){
      latitud=20.656447;
      longitud= -103.325223;
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
  var codigo = localStorage.getItem('codigo');
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
       students+="<li><label class='label-checkbox item-content'><input type='checkbox' name='students' value='"+data[i][0]+"'><div class='item-media'><i class='icon icon-form-checkbox'></i></div><div class='item-inner'><div class='item-title'>"+data[i][1]+"</div></div></label></li>";
     }
    document.getElementById("presenceList").innerHTML = students;
  });
});

myApp.onPageInit('chart', function (page) {
  var codigoEstudiante = localStorage.getItem('codigoEstudiante');
  var nrc = localStorage.getItem('teacherNrc');
  $.post("https://seguridad1315.000webhostapp.com/MiAgenda/Data/getAsistencia.php", {codigo: codigoEstudiante, nrc: nrc}, function(respuesta7){
    datos = JSON.parse(respuesta7);
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Asistencias', 'Faltas'],
        datasets: [{
          backgroundColor: [
            "#f1c40f",
            "#e74c3c"
          ],
          data: [datos[0], datos[1]]
        }]
      }
    });
  });
});