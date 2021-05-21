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
      
      <div class="container-fluid" id="monitores">
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

            if(isset($_GET['idMonitor'])){
                $idMonitor = $_GET['idMonitor'];
                $sql = "SELECT idMonitor,dniMonitor,titulacion,usuarios.nombre,usuarios.apellido FROM monitores INNER JOIN usuarios ON usuarios.dni=monitores.dniMonitor
                    WHERE idMonitor = '$idMonitor'";
                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $monitores[] = $fila;
                }
                $monitor = $monitores[0];
        ?>
            <div class="container-fluid">
                  <h1><?php echo  $monitor['nombre']." ".$monitor['apellido'];?></h1>
                  <h2>Titulacion: <?php echo  $monitor['titulacion'];?></h2>
                  <p> Clases: </p>
                  <form action="mensajes.php" method="post">
                    <?php
                        echo '<button type="submit" name="dni" value="'.$monitor['dniMonitor'].'" class="btn btn-primary">asdf</button>';
                    ?>
                  </form>
            </div>
        <?php
            }
            else{
                $sql = "SELECT idMonitor,usuarios.dni,usuarios.nombre,usuarios.apellido,titulacion FROM monitores INNER JOIN usuarios ON usuarios.dni=monitores.dniMonitor";
                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $monitores[] = $fila;
                } 
                foreach ($monitores as $key => $monitor) {
                    echo '<div class="card" style="width: 18rem">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.$monitor['nombre'].' '.$monitor['apellido'].'</h5>';
                    echo '<p class="card-text">'.$monitor['titulacion'].'</p>';
                    echo '<form action="" method="get">';
                    echo '<button type="submit" name="idMonitor" value="'.$monitor['idMonitor'].'" class="btn btn-primary">Mas informacion</button>';
                    echo '</form>';
                    echo '</div></div>';
                }
            }    
        ?>     
</body>
</html>
