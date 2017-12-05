<?php
    $codigo = $_POST['codigo'];
    $server='localhost';
    $user='id62763_id62763_root';
    $pass='Guadalajara';
    $db='id62763_miagenda';

    //connect to the database
    $mysqli = new mysqli($server, $user, $pass, $db);
    //get the records from the database
    if($result = $mysqli->query("DELETE FROM Asistencia WHERE codigo='$codigo'")){
        if($result = $mysqli->query("DELETE FROM SeccionAlumno WHERE codigoAlumno='$codigo'")){
            if($result = $mysqli->query("DELETE FROM Alumno WHERE codigo='$codigo'")){
                $respuesta = "Eliminado con exito"; 
            }
            else{
                $respuesta = "No se ha podido eliminar";
            }
        }
        else{
            $respuesta = "No se ha podido eliminar";
        }
    }
    else{
        $respuesta = "No se ha podido eliminar";
    }
    $mysqli->close();
    echo json_encode($respuesta);
?>