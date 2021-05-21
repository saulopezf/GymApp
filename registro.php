<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>GymApp</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>	
    <script src="js/validation.js"></script>
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
            <div class="align-self-center">
                <form action="php/registrar.php" method="post" id="formulario" onsubmit="return validarFormulario()">
                	
                	<label>DNI: </label>
                	<input type="text" name="dni" id="dniRegistro" onblur="validarElementos()" required><span id="errorDNI"></span><br>
                	
                	<label>Nombre: </label>
                	<input type="text" name="nombre" id="nombreRegistro" required><span id="errorNombre"></span><br>
                	
                	<label>Apellidos: </label>
                	<input type="text" name="apellidos" id="apeRegistro" required><span id="errorApe"></span><br>

                	<label>Sexo: </label><br>
                	<input type="radio" name="sexo" value="M" required> Masculino<br>
    				<input type="radio" name="sexo" value="F" required> Femenino<br>

    				<label>Fecha de nacimiento: </label>
                	<input type="date" name="fecha" required><br>

                	<label for="tlfno">Telefono</label>
					<input type="text" name="tlfno" id="tlfnoRegistro" required><span id="errorTlfno"></span><br>

                	<label>Correo electronico: </label>
          			<input type="text" name="mail" id="mailRegistro" required><span id="errorMail"></span><br>
       			
                	<label>User: </label>
                	<input type="text" name="user" id="userRegistro" required><span id="errorUser"></span><br>

                	<label for="password">Contraseña</label>
					<input type="password" name="password" id="pass" required><br>
					<label for="password">Repita la contraseña</label>
					<input type="password" id="passRegistro"><span id="errorPass"></span><br>

                	<input type="submit" name="login" value="Iniciar sesion">

                </form>
                <span id="errorVali"></span>
            </div>
        </div>

    </div>
</body>
</html>