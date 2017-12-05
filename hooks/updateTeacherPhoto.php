<?php
    //Conexion con BD
    $codigo = $_POST['codigo'];
	$foto = $_POST['foto'];
	$con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta="Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
    	$sql = "UPDATE Maestro SET foto='$foto' WHERE codigo='$codigo'";
        if (mysqli_query($con, $sql)) {
            $respuesta = "Foto actualizada";
        }
        else{
            $respuesta = "Error";
        }
    }
    echo $respuesta;