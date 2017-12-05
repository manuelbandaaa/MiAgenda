<?php
	//https://zacvineyard.com/posts/upload-a-file-to-a-remote-server-with-phonegap
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
	$path = "https://seguridad1315.000webhostapp.com/MiAgenda/Data/images/perfil.png";
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = file_get_contents($path);
    $foto = 'data:image/' . $type . ';base64,' . base64_encode($data);
    //Conexion con BD
    $con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta = "Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
    	$sql="INSERT INTO Alumno(codigo, nombre, foto) VALUES('$codigo','$nombre','$foto');";
        //comprobamos la insercion
        if(mysqli_query($con,$sql)){
        	$respuesta = "Registro exitoso";
        }
        else{
            $respuesta = "Error: ".mysqli_error($con);
        }
    }
    mysqli_close($con);
    echo json_encode($respuesta);