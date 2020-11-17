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
		<button class="button "><a href="admin.php">Volver</a></button>
	  </div>

	  <div class="col-lg-12 divform d-flex align-items-center justify-content-center">
          <form class="formulario text-center align-items-center justify-content-center " action="registro.php" method="post">
              <input type="text" class="form-field " placeholder="Nombre" name="nombre" id="nombre">
              <input type="text" class="form-field " placeholder="Apellidos" name="apellidos" id="apellidos">
              <input type="text" class="form-field " placeholder="LDAP" name="ldap" id="ldap">
              <input type="password" class="form-field " placeholder="Contraseña" name="contrasena" id="contrasena">
              <input type="password" class="form-field " placeholder="Repetir Contraseña" name="repetircontrasena" id="repetircontrasena">
              <button class="button ">LOGIN</button>
          </form>
       </div>


        <?php
                if($_POST){
                  $nombre = $_POST['nombre'];
                  $apellidos = $_POST['apellidos'];
                  $ldap = $_POST['ldap'];
                  $contrasena = $_POST['contrasena'];
                  $repetircontrasena = $_POST['repetircontrasena'];

                  $checkldap=mysqli_query($conn, "SELECT * FROM usuarios WHERE ldap='$ldap'");
                  $check_ldap=mysqli_num_rows($checkldap);
                  if($contrasena!=$repetircontrasena){
                  echo '<script language="javascript">alert("Las contraseñas no coinciden.");</script> ';
                  }else{
                      if($check_ldap>0){
                          echo ' <script language="javascript">alert("El ldap introducido ya existe, introduzca de nuevo");</script> ';
                      }else{
                          //Introduce un usuario a la base de datos
                          $hash = password_hash($contrasena, PASSWORD_DEFAULT);
                          $estado = "negativo";
                          $sql= "INSERT INTO usuarios(nombre,apellidos,ldap,contrasena, estado) VALUES ('$nombre','$apellidos', '$ldap', '$hash', '$estado') ";
                          mysqli_query($conn, $sql);
                          mysqli_commit ( $conn );

                          $checkldap=mysqli_query($conn, "SELECT * FROM usuarios WHERE ldap='$ldap'");
                          $check_ldap=mysqli_num_rows($checkldap);
                          if($check_ldap>0){
                              echo '<script language="javascript"> alert("Se ha registrado al alumno con éxito"); </script>';
                          } else {
                              echo '<script language="javascript"> alert("Registro fallido"); </script>';
                          }
                      }
                  }
                }

        ?>
    </body>
</html>
