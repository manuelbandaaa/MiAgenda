<?php
    //Conexion con BD
	$codigo = $_POST['codigo'];
	$con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta="Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
        $materias = array();
    	$sql="SELECT * FROM Seccion WHERE codigoMaestro='$codigo';";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
    		while($row = mysqli_fetch_assoc($resultados)) {
    			$nrc=$row["nrc"];
    			$modulo=$row["modulo"];
    			$horario=$row["horario"];
    			$sql="SELECT * FROM Materia WHERE nrc='$nrc';";
                $resultados2=mysqli_query($con, $sql);
    			if(mysqli_num_rows($resultados2)>0){
        		    while($row2 = mysqli_fetch_assoc($resultados2)) {
        		        $nombreMateria = $row2["nombre"];
        		        $codigoMateria = $row2["codigo"];
        		    }
    			}
    			$materia = array($nrc, $codigoMateria, $nombreMateria, $modulo, $horario);
    			array_push($materias, $materia);
    		}
    		$respuesta = json_encode($materias);
        }
        else{
            $respuesta = "No hay coincidencias";
        }
    }
    echo $respuesta;