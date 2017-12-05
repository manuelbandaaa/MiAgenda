<?php
    //Conexion con BD
	$codigo = $_POST['codigo'];
	//$codigo = "2027402";
	$nrc=0;
	$con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta="Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
        $materias = array();
        $aEliminar = array();
    	$sql="SELECT * FROM Seccion WHERE codigoMaestro='$codigo';";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
    		while($row = mysqli_fetch_assoc($resultados)) {
    		    $nrc=$row["nrc"];
    			$modulo=$row["modulo"];
    			$horario=$row["horario"];
    			
    		    $sql="SELECT count(*) as total FROM SeccionAlumno WHERE nrc='$nrc';";
                $resultados10=mysqli_query($con, $sql);
                if(mysqli_num_rows($resultados10)>0){
            		$data=mysqli_fetch_assoc($resultados10);
            		if($data['total']=="0"){
            		    array_push($aEliminar, $nrc);
            		}
            		else{
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
                }
                
                //Eliminamos Materias y Secciones sin Alumnos
                $server='localhost';
                $user='id62763_id62763_root';
                $pass='Guadalajara';
                $db='id62763_miagenda';
            
                //connect to the database
                $mysqli = new mysqli($server, $user, $pass, $db);
                foreach ($aEliminar as $elimina){
                    if($result = $mysqli->query("DELETE FROM Seccion WHERE nrc='$elimina'")){
                    }
                }
    		}
    		$respuesta = json_encode($materias);
        }
        else{
            $respuesta = "No hay coincidencias";
        }
    }
    echo $respuesta;