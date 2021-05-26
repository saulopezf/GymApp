<?php
    session_start();
    if(!isset($_SESSION['userData'])){
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
      <style type="text/css">

        #imagenTop{
            background-image: url("img/xbg_5.jpg.pagespeed.ic.AP6oI9aFte.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;
        }

        form{
            font-size: 18px;
            font-weight: 700;
            font-style: italic;
            color: #e1193e;
        }
        form .btn{
            font-size: 16px;
            font-weight: 700;
            font-style: italic;
            text-transform: uppercase;
        }

        .gym-login{
            background-color: rgba(255,255,255,0.4);
            padding: 6%;
            border-radius: 25px;

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
                        <a class="nav-link" href="calendario.php">Calendario</a>
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
      
      <div class="container-fluid">
      
            <div class="row justify-content-center" id="imagenTop" style="height: 100vh">
                  <div class="align-self-center gym-login">

                        <form action="" method="post">
                            <div class="form-group text-center">
                                <label>USUARIO </label>
                                <input type="text" class="form-control" name="usuario"><span id="errorNombre"></span><br>
                            </div>
                            <div class="form-group text-center">
                                <label>CONTRASEÑA </label>
                                <input type="password" class="form-control" name="password"><span id="errorApe"></span><br>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-danger" name="login" value="Iniciar sesion">
                            </div>
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
                                          echo "<div class='alert alert-danger'>El usuario introducido no existe</div>";
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
                                        header("location:index.php");    
                                    }
                                }
                            }     
                              
                        ?>
                        
                  </div>
            </div>

      </div>   
</body>
</html>
<?php
    }
    else{
        header("location:index.php");
    }
?>