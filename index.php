<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>EHUCovid</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

         <!--CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="css/bootstrap.min.css">    
        <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@700&display=swap" rel="stylesheet">       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">

         <!--Mis css-->
         <link rel="stylesheet" href="css/miscss/index.css">


         <link href="https://allfont.es/allfont.css?fonts=alien-league" rel="stylesheet" type="text/css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="https://use.fontawesome.com/aaa4b89a6a.js"></script>

        <script src="js/misjs/calendar.js"></script>

        
    </head>
    <body class="">

      <div class="col-lg-12 row  d-flex principal">

        <div class="col-lg-8 d-flex imagenportada  align-items-center justify-content-center ">

          <img class="image " src="img/logoEhu.png" alt="Logo EHU">
        
        </div>

        
        
        <div class="col-lg-4 d-flex  align-items-center justify-content-center" >

          <div class="col-lg-12">

            <div class="col-lg-12 d-flex align-items-center justify-content-center titulo">

              <h1>EHUvid</h1>
            </div>
            

            <div class="col-lg-12 divform d-flex align-items-center justify-content-center">
              
              <form class="formulario text-center align-items-center justify-content-center " action="index.php" method="post">
                <input type="text" class="form-field " placeholder="LDAP" name="ldap" id="ldap">
                <input type="password" class="form-field " placeholder="Contraseña" name="contrasena" id="contrasena">
                <button class="button ">LOGIN</button>
              </form>
            </div>
            

          </div>
 
        
        </div>


      </div>

   
      


            
 
    <!-- Optional JavaScript -->
 
        <script src="js/jquery.js"></script>
        <script src="js/misjs/calendar.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

            <!--===============================================================================================-->
        <!--===============================================================================================-->

      <?php
        include 'conexion.php';
        $conn = OpenCon();
        //echo "Connected Successfully <hr>";

        if($_POST){
          $ldap = $_POST['LDAP'];
          $_SESSION['ldap'] = $ldap;
          $contrasena = $_POST['contrasena'];

          //echo "Email: " . $email . "<hr>" ;
          //echo "Contraseña: " . $contrasena . "<hr>" ;

          $contrasena_json=mysqli_query($conn,"SELECT contrasena FROM usuarios WHERE ldap='$ldap'");
          $check_ldap=mysqli_num_rows($contrasena_json);
          $row = mysqli_fetch_assoc($contrasena_json);
          //print_r ($row);
          $contrasena_str = $row['contrasena'];

          echo $contrasena_str;
          if($check_mail==0){
            echo ' <script language="javascript">alert("El ldap no está asociado a ninguna cuenta.");</script> ';
          }else{
            if($contrasena_str!=$contrasena){
              echo ' <script language="javascript">alert("La contraseña es incorrecta."); </script> ';
            }else{
              header('Location: information.php');
            }
          }
        }
      ?>
    
    </body>
</html>