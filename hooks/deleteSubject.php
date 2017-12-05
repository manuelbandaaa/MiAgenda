<?php
    $codigo = $_POST['codigo'];
    $nrc = $_POST['nrc'];
    $server='localhost';
    $user='id62763_id62763_root';
    $pass='Guadalajara';
    $db='id62763_miagenda';

    //connect to the database
    $mysqli = new mysqli($server, $user, $pass, $db);
    if($result = $mysqli->query("DELETE FROM SeccionAlumno WHERE nrc='$nrc' and codigoAlumno='$codigo'")){
        $respuesta = "Materia eliminada";
    }
    else{
        $respuesta = "No se ha podido eliminar";
    }
    $mysqli->close();
    echo json_encode($respuesta);
?>