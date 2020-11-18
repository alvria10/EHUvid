<?php session_start();
    include 'conexion.php';
    $conn = OpenCon();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>EHUvid</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

         <!--CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">

         <!--Mis css-->
         <link rel="stylesheet" href="css/miscss/information.css">
         <link rel="stylesheet" href="css/miscss/menu.css">

         <link rel=”icon” href=”img/logoEhu.png”>


         <link href="https://allfont.es/allfont.css?fonts=alien-league" rel="stylesheet" type="text/css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="https://use.fontawesome.com/aaa4b89a6a.js"></script>
        <script src="js/misjs/calendar.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/jquery-2.2.4.js"></script>


    </head>
    <body class="">



      <!--div principal-->

	  <!--Volver-->
	  <div style='text-align:right'>
	    <a href="admin.php">
		  <button class="button ">Volver</button>
		</a>
	  </div>

	  <!--Zona alumnado-->
              <div class="col-lg-12 row d-flex align-items-center justify-content-center alumnado">
                   <!--asignaturas-->
                  <div class="col-lg-9 row d-flex align-items-center  justify-content-center notificaciones">
                    <?php
                     $codigo = $_SESSION['codigo'];
                     $row=mysqli_query($conn,"SELECT A.ldap, A.nombre, A.apellidos, A.estado FROM usuarios as A NATURAL JOIN usuarioyasignatura as B WHERE B.codigoasignatura='$codigo'");
                     $hayResultados = true;
                     $listafrases = "";
                     while($hayResultados == true){
                        $fila = mysqli_fetch_array($row);
                        if ($fila){
                           $nombre = $fila[1];
                           $ldap = $fila[0];
                           $estado = $fila[3];
                           $apellidos = $fila[2];
                           $frase = $nombre . " " . $apellidos . " | " . $ldap . " | " . $estado . "<br>";
                           echo '<div>';
                           if ($estado == 'positivo'){
                              echo '<font color="red">';
                           } else {
                              echo '<font color="green">';
                           }
                              echo $frase;
                              echo '</font>';
                              echo '</div>';
                              echo '<hr>';
                             }else{
                                 $hayResultados = false;
                             }
                         }
                     ?>
                  </div>
              </div>
         </body>
</html>
