<!DOCTYPE html>
<html lang="en"><head>
<style>
    body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #eee;
    }

    .form-signin {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
      margin-bottom: 10px;
    }
    .form-signin .checkbox {
      font-weight: normal;
    }
    .form-signin .form-control {
      position: relative;
      font-size: 16px;
      height: auto;
      padding: 10px;
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="text"] {
      margin-bottom: -1px;
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
    .h2{
      text-align: center;
      font-weight: bold;
      color: #fff;
      font-size: 24px;
    }
    div .img{
      height:400px; 
      width:500px
    } 
</style>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://getbootstrap.com/docs-assets/ico/favicon.png">

    <title>Iniciar Sesión</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
        <form class="form-signin" action="users.php" method="POST">
        <h2>Iniciar Sesión</h2>
        <div align="center"><img src="logo.png"></div>
        <input class="form-control" name="codigo" placeholder="Código" required="" autofocus="" type="text">
        <input class="form-control" name="nip" placeholder="NIP" required="" type="password">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
      </form>

    </div> <!-- /container -->
</body>
</html>