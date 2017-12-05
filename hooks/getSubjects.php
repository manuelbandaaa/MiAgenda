<?php
    //Conexion con BD
	$codigo = $_POST["codigo"];
	//$codigo = '211595871';
	$con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta="Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
    	$sql="SELECT * FROM Seccion WHERE codigoMaestro='$codigo';";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
            $completo = array();
    		while($row = mysqli_fetch_assoc($resultados)) {
    			$nrc = $row["nrc"];
    			$codigoMateria = $row["codigoMateria"];
                $modulo = $row["modulo"];
                $codigoMaestro = $row["codigoMaestro"];
                $horario = $row["horario"];
                $materias = array($nrc,$codigoMateria,$modulo,$codigoMaestro,$horario);
                array_push($completo,$materias);
    		}
    		$respuesta = json_encode($completo);
        }
        else{
            $respuesta = "No hay coincidencias";
        }
    }
    echo $respuesta;
?>