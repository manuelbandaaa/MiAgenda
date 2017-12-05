<?php

    # definimos la carpeta destino
    $carpetaDestino="images/";
    # si hay algun archivo que subir
    if($_FILES["archivo"]["name"][0]){
        # recorremos todos los arhivos que se han subido
        for($i=0;$i<count($_FILES["archivo"]["name"]);$i++){
            # si es un formato de imagen
            if($_FILES["archivo"]["type"][$i]=="image/jpeg" || $_FILES["archivo"]["type"][$i]=="image/pjpeg" || $_FILES["archivo"]["type"][$i]=="image/gif" || $_FILES["archivo"]["type"][$i]=="image/png"){
                # si exsite la carpeta o se ha creado
                if(file_exists($carpetaDestino) || @mkdir($carpetaDestino)){
                    $origen=$_FILES["archivo"]["tmp_name"][$i];
                    $destino=$carpetaDestino.$_FILES["archivo"]["name"][$i];
                    # movemos el archivo
                    if(@move_uploaded_file($origen, $destino)){
                        #echo "<br>".$_FILES["archivo"]["name"][$i]." movido correctamente";
                        $path = $destino;
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $foto = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    }else{
                        echo "<br>No se ha podido mover el archivo: ".$_FILES["archivo"]["name"][$i];
                    }
                }else{
                    echo "<br>No se ha podido crear la carpeta: up/".$user;
                }
            }else{
                echo "<br>".$_FILES["archivo"]["name"][$i]." - NO es imagen jpg";
                return 0;
                echo "<a href = 'news.php'>Regresar</a>";
            }
        }
        }else{
            echo "<br>No se ha subido ninguna imagen";
        }

$titulo = $_POST["titulo"];
$contenido = $_POST["contenido"];
$tipo = $_POST["tipo"];
$fecha = $_POST["fecha"];
$imagen = $foto;

#conexion a DB
$conexion=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
if(mysqli_connect_error($conexion)){
    echo "fallo la conexion al servidor por esta causa".mysqli_connect_error();
}

$sql = "INSERT INTO Noticia(titulo, noticia, tipo, foto, fecha) VALUES ('$titulo', '$contenido', '$tipo', '$imagen', '$fecha')";

#comprobamos insercion

if(mysqli_query($conexion, $sql)){
    echo "Noticia ingresada con exito";
}
else{
    echo "error: ".mysqli_error($conexion);
}
echo "<br>";
echo "<a href = 'news.php'>Regresar</a>";
    
mysqli_close($conexion);

?>