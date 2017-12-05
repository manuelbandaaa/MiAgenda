<?php
    //Conexion con BD
    $codigo = $_POST['codigo'];
    //$codigo="211674941";
    $con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta="Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
        $codigoMateria="";
        $nombreMateria="";
        $nombreProfesor="";
        $codigoMaestro="";
        $modulo="";
        $horario="";
        $data = array();
        $sql="SELECT nrc FROM SeccionAlumno WHERE codigoAlumno='$codigo';";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
            while($row = mysqli_fetch_assoc($resultados)) {
                $nrc=$row["nrc"];
                $sql="SELECT * FROM Materia WHERE nrc='$nrc';";
                $resultados2=mysqli_query($con, $sql);
                if(mysqli_num_rows($resultados2)>0){
                    while($row2 = mysqli_fetch_assoc($resultados2)) {
                        $codigoMateria=$row2["codigo"];
                        $nombreMateria=$row2["nombre"];
                    }
                }
                $sql="SELECT * FROM Seccion WHERE nrc='$nrc';";
                $resultados3=mysqli_query($con, $sql);
                if(mysqli_num_rows($resultados3)>0){
                    while($row3 = mysqli_fetch_assoc($resultados3)) {
                        $codigoMaestro=$row3["codigoMaestro"];
                        $modulo=$row3["modulo"];
                        $horario=$row3["horario"];
                    }
                }
                $sql="SELECT nombre FROM Maestro WHERE codigo='$codigoMaestro';";
                $resultados4=mysqli_query($con, $sql);
                if(mysqli_num_rows($resultados4)>0){
                    while($row4 = mysqli_fetch_assoc($resultados4)) {
                        $nombreProfesor=$row4["nombre"];
                    }
                }
                $materias = array($nrc, $codigoMateria, $nombreMateria, $nombreProfesor, $modulo, $horario);
                array_push($data, $materias);
            }
            //var_dump($data);
            $respuesta = json_encode($data);
        }
        else{
            $respuesta = "No hay coincidencias";
        }
    }
    echo $respuesta;