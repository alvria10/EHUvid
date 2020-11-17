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

	  <!--Cerrar sesion-->
	  <div style='text-align:right'>
		<button class="button "><a href="logout.php">Cerrar Sesión</a></button>
	  </div>

        <!--Nombre y apellidos-->
        <div class="col-lg-5 row d-flex align-items-center nombre ">
          <h1 class="datos" id="nombre">
            Administración EHUvid
          </h1>
        </div>

        <!--Cerrar sesion-->
        	  <div style='text-align:left'>
        		<button class="button "><a href="registro.php">Añadir nuevo usuario</a></button>
        	  </div>

    <div class="col-lg-12 row d-flex align-items-center justify-content-center alumnado">
              <!--estado-->
              <div class="col-lg-5 row d-flex  justify-content-center informacion">
                <div class="col-lg-12 row d-flex estado">
                  <h3 class="datos">Listado de clases: </h3>
                </div>
              </div>
    </div>
        <div class="col-lg-12 row d-flex align-items-center justify-content-center alumnado">
             <!--asignaturas-->
            <div class="col-lg-9 row d-flex align-items-center  justify-content-center notificaciones">
              <?php
               $row = mysqli_query($conn,"SELECT * FROM asignatura");
               $hayResultados = true;
               $listafrases = "";
               while($hayResultados == true){
                       $fila = mysqli_fetch_array($row);
                       if ($fila){
                           $nombre = $fila[0];
                           $codigo = $fila[1];
                           $estado = $fila[2];
                           $aula = $fila[3];
                           $frase = $nombre . " | " . $codigo . " | " . $estado . " | " . $aula . "<br>";
                           echo '<div>';
                           echo '<form method=post action="">';
                           echo '<input type="hidden" name="codigo" value="' . $codigo . '">';
                           echo $frase;
                           echo '<button type="submit" name="action" value="add_to_cart">Detalles</button>';
                           echo '</div>';
                           echo '<hr>';
                       }else{
                           $hayResultados = false;
                       }
                   }
               ?>
            </div>
        </div>

        <!--===============================================================================================-->
        <!--===============================================================================================-->

        <?php
            if($_POST){
                $codigo = $_POST['codigo'];
                $_SESSION['codigo'] = $codigo;
                header('Location: clase.php');
                exit();
            }
        ?>
    </body>
</html>
