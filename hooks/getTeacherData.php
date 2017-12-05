<?php
    //Conexion con BD
	$codigo = $_POST['codigo'];
	$con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta="Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
    	$sql="SELECT * FROM Maestro WHERE codigo='$codigo';";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
    		while($row = mysqli_fetch_assoc($resultados)) {
    			$nombre=$row["nombre"];
    			$foto=$row["foto"];
    		}
    		$respuesta = json_encode($codigo."|".$nombre."|").$foto;
        }
        else{
            $respuesta = "0";
        }
    }
    echo $respuesta;