<?php
    $codigo = $_POST["codigo"];
    $nip = $_POST["nip"];
    $con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
	$encontrado="0";
    if(mysqli_connect_error($con)){
        echo "Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
        $sql="SELECT * FROM `Usuario` WHERE `usuario` = '$codigo' AND `contrasenia` = '$nip'";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
        	$encontrado="1";
        }
        else{
            $encontrado="0";
        }
        mysqli_close($con);
	}
    //echo $encontrado;
    if($encontrado == 1){
        include("redirect.html");
    }
    else{
        echo "<a href=\"login.php\">Regresar</a>";
    }
?>