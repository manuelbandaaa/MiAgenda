<?php
    //Conexion con BD
    $id = $_POST["id"];
	$con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta="Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
    	$sql="SELECT * FROM Noticia WHERE id='$id'";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
    		while($row = mysqli_fetch_assoc($resultados)) {
    			$titulo=$row["titulo"];
    			$noticia=$row["noticia"];
    			$tipo=$row["tipo"];
    			$foto=$row["foto"];
    			$fecha=$row["fecha"];
    			$news = array($titulo, $noticia, $tipo, $foto, $fecha);
    		}
    		$respuesta = json_encode($news);
        }
        else{
            $respuesta = "No hay coincidencias";
        }
    }
    echo $respuesta;