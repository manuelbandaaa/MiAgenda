<?php
    //Conexion con BD
	$con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta="Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
        $maestros=array();
    	$sql="SELECT * FROM Maestro";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
    		while($row = mysqli_fetch_assoc($resultados)) {
    			array_push($maestros, $row["nombre"]);
    		}
    		$respuesta = json_encode($maestros);
        }
        else{
            $respuesta = "No hay coincidencias";
        }
    }
    echo $respuesta;