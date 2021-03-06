<?php session_start();
    include 'conexion.php';
    $conn = OpenCon();
    $ldap = $_SESSION['ldap'];
    $row = mysqli_query($conn,"SELECT estado, nombre, apellidos FROM usuarios WHERE ldap='$ldap'");
    $consulta=mysqli_fetch_array($row);
    if($row!=null){
        $estado = $consulta[0] ?? 'default value';
        $nombre = $consulta[1] ?? 'default value';
        $apellidos = $consulta[2] ?? 'default value';
        $espacio = " ";
        $nombreyapellidos = $nombre . $espacio . $apellidos;
    }else{
        echo "MAL ";
    }

    $row = mysqli_query($conn,"SELECT mensaje, C.nombre FROM
     notificacionfecha as A NATURAL JOIN usuarioyasignatura as B
     INNER JOIN asignatura as C ON B.codigoasignatura = C.codigo
     WHERE ldap = '$ldap' AND YEARWEEK(fecha,1)=YEARWEEK(NOW(),1)");
    $hayResultados = true;
    $notificaciones = "";
    while($hayResultados == true){
        $fila = mysqli_fetch_array($row);
        if ($fila){
            $notificaciones = $notificaciones . $fila[0] . " (" . $fila[1] . ")" . "<hr/>";
        }else{
            $hayResultados = false;
        }
    }
 /*
    if(isset($_POST['buscar_cli'])){
        $persona = new usuario();
        $valor = $persona->buscarCliente($_POST['buscar_cli']);
    }

    public function buscarCliente($ced){

        $buscar = "SELECT COUNT(*) FROM registro_clientes WHERE rc_cedu=:a";
        $resultado = $this->db_conexion->prepare($buscar);
        $resultado->execute(array(':a'=>$ced));

        $filas = $resultado->fetchColumn();

        if($filas>0){

            $extraer = "SELECT rc_cedu,rc_nomb,rc_aped,rc_telf,rc_dire FROM registro_clientes WHERE rc_cedu=:a";
            $resultado2 = $this->db_conexion->prepare($extraer);
            $resultado2->execute(array(':a'=>$ced));

            $arrResultado["datos"][] = $resultado2->fetch(PDO::FETCH_ASSOC);

            $resultado2->closeCursor();
        }else{
            $arrResultado=array("error"=>"No se encontraron datos");
        }

        $resultado->closeCursor();
        $this->db_conexion = null;

            header('Content-Type: application/json');
            echo json_encode($arrResultado);

     }
    */
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
      <div class="principal row d-flex ">

        <!--Nombre y apellidos-->



         <!--Zona alumnado-->
        <div class="col-lg-12 row d-flex align-items-center justify-content-center alumnado">

          <!--NOmbre apellidos estado y calendario-->
          <div class="col-lg-7 row d-flex justify-content-center ">
            <!--Nombre apellidos y estado de la persona-->
            <div class="col-lg-12 row d-flex  justify-content-center informacion">
              <div class="col-lg-12 row d-flex align-items-center nombre ">
                <h1 class="datos" id="nombre">
                  <?php echo $nombreyapellidos; ?>
                </h1>
              </div>

              <div class="col-lg-12 row d-flex estado">
                <h3 class="datos">Estado:  </h3>
                <h3 class="datos"><?php echo $estado; ?></h3>
              </div>

            </div>

            <!--Zona Calendario-->
            <div class="col-lg-7 row d-flex align-items-center justify-content-center calendar">

              <div id="calendario">
                <div id="anterior" onclick="mesantes()"></div>
                <div id="posterior" onclick="mesdespues()"></div>
                <h2 id="titulos"></h2>
                <table id="diasc">
                   <!--Dias de la semana-->
                  <tr  id="fila0"><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
                  <tr  id="fila1"><td class="emergente1" onclick="consultarhorario(1,0)"></td><td class="emergente1" onclick="consultarhorario(1,1)"></td><td class="emergente1" onclick="consultarhorario(1,2)"></td><td class="emergente1" onclick="consultarhorario(1,3)"></td><td class="emergente1" onclick="consultarhorario(1,4)"></td><td></td><td></td></tr>
                  <tr  id="fila2"><td class="emergente2" onclick="consultarhorario(2,0)"></td><td class="emergente2" onclick="consultarhorario(2,1)"></td><td class="emergente2" onclick="consultarhorario(2,2)"></td><td class="emergente2" onclick="consultarhorario(2,3)"></td><td class="emergente2" onclick="consultarhorario(2,4)"></td><td ></td><td ></td></tr>
                  <tr  id="fila3"><td class="emergente3" onclick="consultarhorario(3,0)"></td><td class="emergente3" onclick="consultarhorario(3,1)"></td><td class="emergente3" onclick="consultarhorario(3,2)"></td><td class="emergente3" onclick="consultarhorario(3,3)"></td><td class="emergente3" onclick="consultarhorario(3,4)"></td><td ></td><td ></td></tr>
                  <tr  id="fila4"><td class="emergente4" onclick="consultarhorario(4,0)"></td><td class="emergente4" onclick="consultarhorario(4,1)"></td><td class="emergente4" onclick="consultarhorario(4,2)"></td><td class="emergente4" onclick="consultarhorario(4,3)"></td><td class="emergente4" onclick="consultarhorario(4,4)"></td><td ></td><td ></td></tr>
                  <tr  id="fila5"><td class="emergente5" onclick="consultarhorario(5,0)"></td><td class="emergente5" onclick="consultarhorario(5,1)"></td><td class="emergente5" onclick="consultarhorario(5,2)"></td><td class="emergente5" onclick="consultarhorario(5,3)"></td><td class="emergente5" onclick="consultarhorario(5,4)"></td><td></td><td ></td></tr>
                  <tr  id="fila6"><td class="emergente6" onclick="consultarhorario(6,0)"></td><td class="emergente6" onclick="consultarhorario(6,1)"></td><td class="emergente6" onclick="consultarhorario(6,2)"></td><td class="emergente6" onclick="consultarhorario(6,3)"></td><td class="emergente6" onclick="consultarhorario(6,4)"></td><td ></td><td></td></tr>
                </table>
                <div id="fechaactual"><i onclick="actualizar()"> </i></div>
                <div id="buscafecha">
                  <form action="#" name="buscar">
                    <p>+

                      <select name="buscames">
                        <option value="0">Enero</option>
                        <option value="1">Febrero</option>
                        <option value="2">Marzo</option>
                        <option value="3">Abril</option>
                        <option value="4">Mayo</option>
                        <option value="5">Junio</option>
                        <option value="6">Julio</option>
                        <option value="7">Agosto</option>
                        <option value="8">Septiembre</option>
                        <option value="9">Octubre</option>
                        <option value="10">Noviembre</option>
                        <option value="11">Diciembre</option>
                      </select>

                      <input type="text" name="buscaanno" maxlength="4" size="4" />

                      <input type="button" value="BUSCAR" onclick="mifecha()" />
                    </p>
                  </form>
                </div>
              </div>

            </div>
          </div>

            <!--notificaciones-->
          <div class="col-lg-4 row d-flex align-items-center  justify-content-center notificaciones ">
            <h3 class="datos" style="text-align:center;"><?php echo $notificaciones; ?></h3>
          </div>

           
          </div>
        </div>
      </div>

      <!--Boton cerrar sesión-->
      <div class= "boton">
        <a href="index.php">
          <button class="button " href="index.php">Cerrar Sesión</button>
        </a>
      </div>
      


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Clases</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="horario">

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
        <script type="text/javascript">
            function consultarhorario(semana, diaSemana){

                  if(notmesanterior(semana, diaSemana)){
                      // celda=diassemana[e];
                      // var miVariableJS=$("select * from usuarios").val();

                      // Enviamos la variable de javascript a archivo.php
                      // $.post("consultaHorario.php",{"texto":miVariableJS},function(respuesta){
                      //     alert(respuesta);
                      // });

                      if(diaSemana<5){

                          if(notmesanterior(semana, diaSemana)){

                             fila = document.getElementById("fila" + semana);
                             celda=fila.getElementsByTagName("td")[diaSemana];
                             var array = tit.textContent.split(" ");
                             mes = meses.indexOf(array[0]) + 1;
                             dia = celda.textContent;

                             //Para que aparezca la ventana emergente con el horario
                             $(".emergente" + semana).attr("data-toggle" , "modal");
                             $(".emergente" + semana).attr("data-target" , "#exampleModal");
                             div = document.getElementById('horario');
                             div.classList.add('d-flex', 'align-items-center', 'justify-content-center');
                             div.innerHTML = "";

                             //lunes
                             if(diaSemana == 0){
                                document.getElementById("horario").innerHTML = "<div> 13:00 - 15:00 &nbsp;  API &nbsp;  PRESENCIAL &nbsp; <br> 15:00 - 17:00 &nbsp;  TIA &nbsp; ONLINE</div>";
                             }
                            //martes
                              if(diaSemana == 1){
                                document.getElementById("horario").innerHTML = "<div> 15:00 - 17:00 &nbsp;  AS &nbsp;  PRESENCIAL &nbsp; <br> 17:00 - 19:00 &nbsp;  PLCs &nbsp; ONLINE</div>";
                             }
                              //miercoles
                              if(diaSemana == 2){
                                document.getElementById("horario").innerHTML = "<div> 14:00 - 16:00 &nbsp;  API &nbsp;  PRESENCIAL &nbsp; <br> 16:00 - 18:00 &nbsp;  PLCs &nbsp; PRESENCIAL &nbsp; <br> 18:00 - 20:00 &nbsp;  AS &nbsp; ONLINE</div>";
                             }
                             //lunes
                             if(diaSemana == 3){
                                document.getElementById("horario").innerHTML = "<div> 13:00 - 15:00 &nbsp;  API &nbsp;  PRESENCIAL &nbsp; <br> 15:00 - 17:00 &nbsp;  TIA &nbsp; ONLINE</div>";
                             }
                            
                              //miercoles
                              if(diaSemana == 4){
                                document.getElementById("horario").innerHTML = "<div> 14:00 - 16:00 &nbsp;  API &nbsp;  PRESENCIAL &nbsp; <br> 16:00 - 18:00 &nbsp;  PLCs &nbsp; PRESENCIAL &nbsp; <br> 18:00 - 20:00 &nbsp;  AS &nbsp; ONLINE</div>";
                             }
                          }
                      }
                  }
               else {
                   alert("No hay clase el día seleccionado")
               }
            }
        </script>

        <!--===============================================================================================-->
        <!--===============================================================================================-->
    </body>
</html>
