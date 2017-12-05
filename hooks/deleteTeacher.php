<?php
    $codigo = $_POST['codigo'];
    $server='localhost';
    $user='id62763_id62763_root';
    $pass='Guadalajara';
    $db='id62763_miagenda';

    //connect to the database
    $mysqli = new mysqli($server, $user, $pass, $db);
    //get the records from the database
    $con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    $sql="SELECT * FROM Seccion WHERE codigoMaestro='$codigo';";
    $resultados=mysqli_query($con, $sql);
    if(mysqli_num_rows($resultados)>0){
		while($row = mysqli_fetch_assoc($resultados)) {
			$nrc=$row["nrc"];
		}
    }
    if($result = $mysqli->query("DELETE FROM Asistencia WHERE nrc='$nrc'")){
        if($result = $mysqli->query("DELETE FROM SeccionAlumno WHERE nrc='$nrc'")){
            if($result = $mysqli->query("DELETE FROM Seccion WHERE codigoMaestro='$codigo'")){
                if($result = $mysqli->query("DELETE FROM Seccion WHERE nrc='$nrc'")){
                    if($result = $mysqli->query("DELETE FROM Materia WHERE nrc='$nrc'")){
                        if($result = $mysqli->query("DELETE FROM Maestro WHERE codigo='$codigo'")){
                            $respuesta = "Eliminado con exito"; 
                        }
                        else{
                            $respuesta = "No se ha podido eliminar";
                        }
                    }
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
    }
    else{
        $respuesta = "No se ha podido eliminar";
    }
    $mysqli->close();
    echo json_encode($respuesta);
?>