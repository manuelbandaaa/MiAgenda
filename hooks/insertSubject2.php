<?php
    $nrc = $_POST['nrc'];
    $codigoMateria = $_POST['codigoMateria'];
    $nombreMateria = $_POST['nombreMateria'];
    $nombreMaestro = $_POST['nombreMaestro'];
    $modulo = $_POST['modulo'];
    $horario = $_POST['horario'];
    $codigoAlumno = $_POST['codigoAlumno'];
    $codigoMaestro = "";
    //Conexion con BD
    $con=mysqli_connect("localhost", "id62763_id62763_root", "Guadalajara", "id62763_miagenda");
    if(mysqli_connect_error($con)){
        $respuesta = "Fallo en la conexión con el servidor por esta causa: ".mysqli_connect_error();
    }
    else{
        $sql="INSERT INTO Materia(nrc, codigo, nombre) VALUES('$nrc','$codigoMateria','$nombreMateria');";
        if(mysqli_query($con,$sql)){
            $sql="INSERT INTO SeccionAlumno(nrc, codigoAlumno) VALUES('$nrc','$codigoAlumno');";
            if(mysqli_query($con,$sql)){
                $sql="SELECT * FROM Maestro WHERE nombre='$nombreMaestro';";
                $resultados=mysqli_query($con, $sql);
                if(mysqli_num_rows($resultados)>0){
                    while($row = mysqli_fetch_assoc($resultados)) {
                        $codigoMaestro=$row["codigo"];
                    }
                }
                $sql="INSERT INTO Seccion(nrc, codigoMateria, modulo, codigoMaestro, horario) VALUES('$nrc','$codigoMateria', '$modulo', '$codigoMaestro', '$horario');";
                    if(mysqli_query($con,$sql)){
                        $respuesta = "Materia Agregada correctamente";
                    }
            }
        }
        else{
            $respuesta = "Error: ".mysqli_error($con);
        }
    }
    mysqli_close($con);
    echo $respuesta;