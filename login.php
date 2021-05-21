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
      <style type="text/css">

        #imagenTop{
            background-image: url("img/loginbg.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;
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
      
            <div class="row justify-content-center" id="imagenTop" style="height: 100vh">
                  <div class="align-self-center bg-dark">
                        <form action="" method="post">
                              <label>User: </label>
                              <input type="text" name="usuario" onblur="validarNombre(this.value,'errorNombre')"><span id="errorNombre"></span><br>
                              <label>Pass: </label>
                              <input type="password" name="password" onblur="validarApellidos(this.value,'errorApe')"><span id="errorApe"></span><br>
                              <input type="submit" name="login" value="Iniciar sesion">
                        </form>
                        <?php
                              if($_SERVER["REQUEST_METHOD"] == "POST"){
                                    if($_POST['login']){

                                    $host='localhost';
                                    $usuario_bd='guest';
                                    $password_bd='guest';
                                    $nombre_bd='gimnasio';
                                    $conexion=mysqli_connect($host,$usuario_bd,$password_bd,$nombre_bd);


                                    $usuario=$_POST['usuario'];
                                    $password=$_POST['password'];

                                    $pass_code=hash_hmac('sha512', $_POST['password'], 'secret');

                                    $sql = "SELECT * FROM usuarios
                                    WHERE user='$usuario' AND pass='$pass_code'";
                                    $resultado = mysqli_query($conexion, $sql);

                                    if(mysqli_num_rows($resultado)==0){
                                          echo "<p>El usuario introducido no existe o ha introducido mal algun campo</p><p><a href='index.php'>Volver al inicio de sesion</a></p>";
                                    }
                                    else{
                                          $sql = "SELECT dni,nombre,apellido,rol FROM usuarios
                                          WHERE user='$usuario'";
                                          $resultado = mysqli_query($conexion, $sql);
                                          $info = mysqli_fetch_assoc($resultado);
                                          $_SESSION['userData'] = [];
                                          $_SESSION['userData']['dni'] = $info['dni'];
                                          $_SESSION['userData']['nombre'] = $info['nombre'];
                                          $_SESSION['userData']['apellido'] = $info['apellido'];
                                          if ($info['rol']=="asistente") {
                                                $_SESSION['userData']['user']="gymAsist";
                                          }
                                          elseif ($info['rol']=="monitor") {
                                                $_SESSION['userData']['user']="gymMonitor";
                                          }
                                          elseif ($info['rol']=="matriculado") {
                                                $_SESSION['userData']['user']="gymMatriculado";        
                                          }
                                          header("Location:index.php");      
                                    }
                              }
                              }     
                              
                        ?>
                  </div>
            </div>

      </div>

      

      

      
</body>
</html>
