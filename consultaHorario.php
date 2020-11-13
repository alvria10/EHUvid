<?php
    include 'conexion.php';
    $conn = OpenCon();
    if($_POST['texto']) {
        $consulta = $_POST['texto'];
        $respuesta = mysqli_query($conn,$consulta);
        $respuesta_str = $row['nombre'];
        echo $respuesta_str;
        }
    else {
        echo "He recibido un campo vacio";
        }
?>