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
                    Matricular
                </div>
                <form action="php/registrar.php" method="post" id="formMatricular" onsubmit="return validarFormulario()">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>DNI: </label>
                            <input type="text" name="dni" id="dniRegistro" class="form-control" required><span id="errorDNI"></span>
                            <div class="invalid-feedback">
                                DNI introducido incorrecto.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Nombre: </label>
                            <input type="text" name="nombre" id="nombreRegistro" class="form-control" required><span id="errorNombre"></span>
                            <div class="invalid-feedback">
                                No puede contener numeros.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Apellidos: </label>
                            <input type="text" name="apellidos" id="apeRegistro" class="form-control" required><span id="errorApe"></span>
                            <div class="invalid-feedback">
                                No puede contener numeros.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Sexo:</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="customControlValidation2" name="sexo" value="M" required>
                                <label class="custom-control-label" for="customControlValidation2">Masculino</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="customControlValidation3" name="sexo" value="F" required>
                                <label class="custom-control-label" for="customControlValidation3">Femenino</label>
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label>Fecha de nacimiento: </label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required min="1899-01-01" max=<?php echo date('Y-m-d');?>>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="tlfno">Telefono</label>
                            <input type="text" name="tlfno" id="tlfnoRegistro" class="form-control" required>
                            <div class="invalid-feedback">
                                Numero introducido incorrecto.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Correo electronico: </label>
                            <input type="text" name="mail" id="mailRegistro" class="form-control" required>
                            <div class="invalid-feedback">
                                Email introducido incorrecto.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Nombre de usuario </label>
                        </div>
                        <div class="col-md-8 mb-3">
                            <input type="text" name="user" id="userRegistro" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="password">Contraseña</label>
                        </div>
                        <div class="col-md-8 mb-3">
                            <input type="password" name="password" id="pass" class="form-control" required>
                        </div>
                     </div>  
                    <div class="form-row">        
                        <div class="col-md-4 mb-3"> 
                            <label for="password">Repita la contraseña</label>
                        </div>
                        <div class="col-md-8 mb-3">
                            <input type="password" id="passRegistro" class="form-control">
                            <div class="invalid-feedback">
                                Las contraseñas tienen que coincidir.
                            </div>
                        </div>
                    </div> 
                    <div class="form-row justify-content-center" id="errorVali"></div>
                    <div class="form-row justify-content-center">
                        <input type="submit" name="registrar" class="w-100 btn btn-danger" value="MATRICULAR USUARIO">
                    </div>
                </form>
            </div> 
        </div>  
    </div>
</body>
</html>