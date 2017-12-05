<?php
    //Conexion con BD
	$codigo = $_POST['codigo'];
	$nrc= $_POST['nrc'];
	//$codigo="211674941";
	$con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta="Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
        $asistencias=0;
        $faltas=0;
    	$sql="SELECT * FROM Asistencia WHERE codigo='$codigo' and nrc='$nrc'";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
    		while($row = mysqli_fetch_assoc($resultados)) {
    			$asistencia=$row["asistencia"];
    			if($asistencia){
    			    $asistencias++;
    			}
    			else{
    			    $faltas++;
    			}
    		}
    		//echo "Asistencias: ".$asistencias;
    		//echo "Faltas: ".$faltas;
    		$respuesta = json_encode(array($asistencias, $faltas));
        }
        else{
            $respuesta = "0";
        }
    }
    echo $respuesta;