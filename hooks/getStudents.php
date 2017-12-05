<?php
    //Conexion con BD
	$nrc = $_POST["nrc"];
	//$nrc="140933";
	$con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta="Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
        $students = array();
    	$sql="SELECT * FROM SeccionAlumno WHERE nrc='$nrc';";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
            $students = array();
    		while($row = mysqli_fetch_assoc($resultados)) {
    		    $codigoAlumno = $row["codigoAlumno"];
    		    $sql="SELECT * FROM Alumno WHERE codigo='$codigoAlumno';";
                $resultados2=mysqli_query($con, $sql);
                if(mysqli_num_rows($resultados2)>0){
            		while($row2 = mysqli_fetch_assoc($resultados2)) {
            		    $nombre = $row2["nombre"];
            		    $foto = $row2["foto"];
            		    $student = array($codigoAlumno, $nombre, $foto);
            		    array_push($students, $student);
            		}
                }
    		}
    		$respuesta = json_encode($students);
        }
        else{
            $respuesta = "0";
        }
    }
    echo $respuesta;
?>