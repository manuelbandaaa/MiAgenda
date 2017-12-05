<?php
    $nombreMateria = $_POST['nombreMateria'];
    $nombreMaestro = $_POST['nombreMaestro'];
    $modulo = $_POST['modulo'];
    $horario = $_POST['horario'];
    $codigoAlumno = $_POST['codigoAlumno'];
    $codigoMaestro = "";
    $respuesta="";
    //Conexion con BD
    $con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta = "Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
        $sql="SELECT * FROM Materia WHERE nombre='$nombreMateria';";
        $resultados10=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados10)>0){
    		while($row10 = mysqli_fetch_assoc($resultados10)) {
    		    $nrc = $row10["nrc"];
    		    $codigoMateria = $row10["codigo"];
    		    $sql="SELECT * FROM SeccionAlumno WHERE nrc='$nrc' and codigoAlumno='$codigoAlumno';";
                $resultados11=mysqli_query($con, $sql);
                if(mysqli_num_rows($resultados11)>0){
            		while($row11 = mysqli_fetch_assoc($resultados11)) {
            		    $respuesta = $row11["nrc"];
            		}
                }
                else{
                    $sql="INSERT INTO SeccionAlumno(nrc, codigoAlumno) VALUES('$nrc','$codigoAlumno');";
                    if(mysqli_query($con,$sql)){
                        $sql="SELECT * FROM Maestro WHERE nombre='$nombreMaestro';";
                        $resultados15=mysqli_query($con, $sql);
                        if(mysqli_num_rows($resultados15)>0){
                            while($row15 = mysqli_fetch_assoc($resultados15)) {
                                $codigoMaestro=$row15["codigo"];
                            }
                        }
                        $sql="SELECT * FROM Seccion WHERE nrc='$nrc';";
                        $resultados12=mysqli_query($con, $sql);
                        if(mysqli_num_rows($resultados12)>0){
                    		while($row12 = mysqli_fetch_assoc($resultados12)) {
                    		    
                    		}
                    		$respuesta = $codigoMaestro;
                        }
                        else{
                            $sql="INSERT INTO Seccion(nrc, codigoMateria, modulo, codigoMaestro, horario) VALUES('$nrc','$codigoMateria', '$modulo', '$codigoMaestro', '$horario');";
                            if(mysqli_query($con,$sql)){
                                $respuesta = "Materia Agregada correctamente";
                            }
                        }
                    }
                }
    		}
        }
        else{
            $respuesta = "Error: ".mysqli_error($con);
        }
    }
    mysqli_close($con);
    echo $respuesta;