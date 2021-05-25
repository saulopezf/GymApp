<?php
      session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
      <title>GymApp</title>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="css/navbar.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
      <script src="js/ScriptsGym.js"></script>
      <style type="text/css">

        body{
            /*background-image: url("img/xbg_5.jpg.pagespeed.ic.AP6oI9aFte.png");*/
        }
        
        td,th{
          border: 1px solid black;
          font-style: italic;
        }

        td{
            font-weight: 700;
        }

        td button{
            position: relative;
            bottom: 0;
        }

        thead{
            background:#030513;
            color: white;
        }
      </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg ftco-navbar-light" id="mynav" style="position: static;background: #030513;">
        <div class="container-xl">
            <a class="navbar-brand" href="index.php"><span class="">GymApp <small>Bodybuilding &amp; Fitness</small></span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
                  Menu
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="calendario.php">Calendario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="monitores.php">Monitores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="clases.php">Clases</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.php">Contacto </a>
                    </li>
                    <?php
                        if(isset($_SESSION['userData'])){
                            if($_SESSION['userData']['user']!='gymMatriculado'){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="matriculados.php">Lista de Matriculados</a>
                    </li>
                    <?php
                            }
                            else{
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="imc.php">Calculadora IMC</a>
                    </li>
                    <?php
                            }
                        }
                    ?>                      
                    <?php
                        if(isset($_SESSION['userData'])){
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                            <?php echo $_SESSION['userData']['nombre']." ".$_SESSION['userData']['apellido'] ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <?php
                                if($_SESSION['userData']['user']=="gymAsist"){
                            ?>
                                <a class="dropdown-item" href="registro.php">Registrar</a>
                            <?php
                                }
                            ?>
                                <a class="dropdown-item" href="mensajes.php">Mensajes</a>
                                <a class="dropdown-item" href="config.php">Configuracion de la cuenta</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="php/cerrarSesion.php">Cerrar sesion</a>
                            </div>
                        </li>
                    <?php
                        }
                        else{
                    ?>
                </ul>
                <a class="btn-custom" href="login.php">Iniciar sesion</a>
                <?php
                    }
                ?>
            </div>
        </div>
    </nav>
      
      <div class="container-fluid text-center">
        <div class="d-flex justify-content-center p-5">
        <?php
          $host='localhost';
          $usuario_bd='guest';
          $password_bd='guest';
          $nombre_bd='gimnasio';
          $conexion=mysqli_connect($host,$usuario_bd,$password_bd,$nombre_bd);
          if (mysqli_connect_errno()) { //(!$conexion)
              printf("Conexión fallida: %s\n", mysqli_connect_error());
              exit();
          }
          $sql = "SELECT clases.idClase,nombre,dia,horaInicio,horaFin FROM horarios INNER JOIN clases ON horarios.idClase=clases.idClase
                  ORDER BY dia ASC";
          if(isset($_SESSION['userData'])){
            if($_SESSION['userData']['user']=="gymMonitor"){
              $dniMonitor = $_SESSION['userData']['dni'];
              $sql = "SELECT clases.idClase,nombre,dia,horaInicio,horaFin FROM horarios INNER JOIN clases ON horarios.idClase=clases.idClase
                  WHERE clases.dniMonitor='$dniMonitor'
                  ORDER BY dia ASC";
            }
          }
          
          $resultado = mysqli_query($conexion, $sql);
          $clases = [];
          while ($fila = mysqli_fetch_assoc($resultado)) {
              $clases[] = $fila;
          }
            $diasSemana = ["lunes","martes","miercoles","jueves","viernes","sabado","domingo",];
            $horaInicio = 8;
            $horaFin = 9;
            echo "<table class='table table-striped table-dark'><thead><th scope='col'></th>";
            for ($j=0; $j < count($diasSemana); $j++) { 
              echo "<th scope='col'>".strtoupper($diasSemana[$j])."</th>";
            }
            echo "</thead>";
            while ($horaInicio<22) { 
                echo "<tr><td scope='row'>$horaInicio:00 - $horaFin:00</td>";
                for ($i=0; $i < count($diasSemana); $i++) { 
                  echo "<td>";
                  foreach ($clases as $indice => $clase) {
                    $d=strtotime($clase['horaInicio']);
                    if(date("H",$d)==$horaInicio&&$clase['dia']==$diasSemana[$i]){
                      echo strtoupper($clase['nombre']);
                      if(isset($_SESSION['userData'])){
                        if($_SESSION['userData']['user']=="gymMatriculado"){
                          echo "<br><button class='btn btn-danger'>Apuntarse</button>";
                        }
                      }
                    }
                  }
                  echo "</td>";
                }
                echo "</tr>";
                $horaInicio++;
                $horaFin++;
            }   
          ?>
          </table>
          </div>
      </div>
</body>
</html>