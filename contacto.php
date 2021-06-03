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
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
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
      
    <div class="container-fluid pb-5" style="margin-bottom: 90px;">
        <div class="row">
            <div class="col-lg-6 col-md-offset-3 mt-5 text-center">
                <h2 class="titulo">Nuestros gimnasios</h2>
                <div id="map-container-google-1" class=" map-container " style="height: 500px">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23130.85373283083!2d-5.935529970629762!3d43.557449614216765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd369b638b853ca1%3A0x2f8943a218606643!2sAvil%C3%A9s%2C%20Asturias!5e0!3m2!1ses!2ses!4v1622752123279!5m2!1ses!2ses" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                </div>
            </div>
            <div class="col-lg-6 col-md-offset-3 mt-5">
                <div class="well well-sm justify-content-center">
                  <form class="form" action="" method="post">
                      <fieldset>
                        <div class="text-center">
                            <h2 class="titulo">Contactanos</h2>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12 control-label" for="name" style="color:black;">Tu nombre</label>
                            <div class="col-md-12">
                                <input id="name" name="name" type="text" placeholder="Tu nombre" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12 control-label" for="email" style="color:black;">Tu correo electronico</label>
                            <div class="col-md-12">
                                <input id="email" name="email" type="text" placeholder="Tu correo electronico" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12 control-label" for="message" style="color:black;">Mensaje</label>
                            <div class="col-md-12">
                                <textarea class="form-control" id="message" name="mensaje" placeholder="Por favor inserte su mensaje aqui..." rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-danger btn-lg">Enviar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="row ml-3 mt-4">
                <h4>O llame al: <span style="color:red">699605944</span></h4>
            </div>
        </div>
    </div>
</div> 
<footer class="ftco-footer">
    <div class="container-fluid px-0 py-5 bg-darken">
        <div class="container-xl">
            <div class="col-md-12 text-center">
                <p id="textoFooter" class="mb-0" style="color: rgba(255,255,255,.5); font-size: 13px;">
                    <script>escribirFooter();</script>
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
