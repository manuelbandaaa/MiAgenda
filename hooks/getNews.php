<?php
    //Conexion con BD
	$con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta="Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
    	$sql="SELECT * FROM Noticia";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
            $news = array();
    		while($row = mysqli_fetch_assoc($resultados)) {
    			$titulo=$row["titulo"];
    			$foto=$row["foto"];
    			$id=$row["id"];
    			$data = array($titulo, $foto, $id);
    			array_push($news, $data);
    		}
    		$respuesta = json_encode($news);
        }
        else{
            $respuesta = "No hay coincidencias";
        }
    }
    echo $respuesta;