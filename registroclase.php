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
    <script src="js/validation.js"></script>
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
            <div class="align-self-center gym-register">
                <div class="row justify-content-center titulo-registro">
                    Nueva Clase
                </div>
                <form action="" method="post" id="formClase" onsubmit="return validarNuevaClase()">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label>Nombre clase</label>
                            <input type="text" name="nombreClase" id="nombreClase" class="form-control" required>
                            <div class="invalid-feedback">
                                No puede contener numeros.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Monitor</label>
                            <select name="monitorClase" id="monitorClase" class="form-control" required>
                                <option>Seleccione un monitor...</option>
                            </select>
                            <div class="invalid-feedback">
                                Seleccione un monitor valido.
                            </div>
                        </div>
                    </div>
                    <h4>Horario: </h4>

                    <label>Hora inicio: </label>
                    <input type="time" min="8:00" max="22:00" name="horaInicio" required>

                    <label>Hora fin: </label>
                    <input type="text" name="horaFin" id="horaFin" required>
                    <div class="form-row justify-content-center mt-3">
                        <input type="submit" name="nuevaClase" class="w-100 btn btn-danger" value="AÑADIR NUEVA CLASE">
                    </div>
                </form>
            </div>  
        </div>
    </div> 
</body>
</html>
<?php
?>