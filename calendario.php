<?php
      session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
      <title>GymApp</title>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
      <script src="js/ScriptsGym.js"></script>
      <style type="text/css">
        
        td,th{
          height: 50px;
          width: 100px;
          border: 1px solid black;
        }
      </style>
</head>
<body>

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mynav">
            <a class="navbar-brand" href="index.php">GymApp</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fa fa-bars" aria-hidden="true"></i>
              Menu
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="calendario.php">Calendario</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="monitores.php">Monitores</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="mensajes.php">Mensajes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Iniciar sesion</a>
                </li>
                  <?php
                        if(isset($_SESSION['userData'])){
                  ?>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $_SESSION['userData']['nombre']." ".$_SESSION['userData']['apellido'] ?> <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="php/cerrarSesion.php">Cerrar sesion</a></li>
                        
                                   
                      </ul>
                  </li>
                  <?php
                        }
                  ?>
              </ul>
            </div>
      </nav>
      
      <div class="container-fluid">
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
            echo "<table><tr><th></th>";
            for ($j=0; $j < count($diasSemana); $j++) { 
              echo "<th>$diasSemana[$j]</th>";
            }
            echo "</tr>";
            while ($horaInicio<22) { 
                echo "<tr><td>$horaInicio:00 - $horaFin:00</td>";
                for ($i=0; $i < count($diasSemana); $i++) { 
                  echo "<td>";
                  foreach ($clases as $indice => $clase) {
                    $d=strtotime($clase['horaInicio']);
                    if(date("H",$d)==$horaInicio&&$clase['dia']==$diasSemana[$i]){
                      echo $clase['nombre'];
                      if(isset($_SESSION['userData'])){
                        if($_SESSION['userData']['user']=="gymMatriculado"){
                          echo "<br><button>Apuntarse</button>";
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
      
</body>
</html>