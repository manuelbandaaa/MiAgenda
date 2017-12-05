<?php
    $alumnosAsistencia = json_decode($_POST['alumnos']);
    $fecha = $_POST['fecha'];
    $nrc= $_POST['nrc'];
    $respuesta = "";
    //Conexion con BD
    $con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta = "Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
        $todosAlumnos = array();
        $sql="SELECT * FROM SeccionAlumno WHERE nrc='$nrc';";
        $resultados=mysqli_query($con, $sql);
        if(mysqli_num_rows($resultados)>0){
    		while($row = mysqli_fetch_assoc($resultados)) {
    		    array_push($todosAlumnos, $row["codigoAlumno"]);
    		}
        }
        else{
            $respuesta="Error en consula de alumnos";
        }
        foreach ($todosAlumnos as $alumno){
            if(in_array($alumno, $alumnosAsistencia)){
                $asiste=1;
                $sql="INSERT INTO Asistencia(codigo, nrc, fecha, asistencia) VALUES('$alumno','$nrc','$fecha', '$asiste');";
                if(mysqli_query($con,$sql)){
                	$respuesta = "Registro exitoso";
                }
                else{
                    $respuesta="Error asistencia: ".mysqli_error($con);
                }
            }
            else{
                $asiste=0;
                $sql="INSERT INTO Asistencia(codigo, nrc, fecha, asistencia) VALUES('$alumno','$nrc','$fecha', '$asiste');";
                if(mysqli_query($con,$sql)){
                	$respuesta = "Registro exitoso";
                }
                else{
                    $respuesta="Error en insercion de falta";
                }
            }
        }
    }
    mysqli_close($con);
    echo json_encode($respuesta);