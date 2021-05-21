<?php
	session_start();
	if(isset($_SESSION['userData'])){
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
    <?php
        if(isset($_POST['dni'])){
            echo "<script>userChat = '".$_POST['dni']."'; nuevoChat = true;</script>";
        }
    ?>
    <link rel="stylesheet" type="text/css" href="css/mensajes.css">
</head>
<body onload="getUsuarioActual();cargarMensajeria();">
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

   	<?php
   		echo $_SESSION['userData']['dni'];
   	?>

<div class="container">
<h3 class=" text-center">Messaging</h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
          </div>
          <div class="inbox_chat" id="inbox_chat">

          </div>
        </div>
        <div class="mesgs">
          <div class="msg_history" id="chat">
            
          </div>
          <div class="type_msg" id="type_msg" style="display: none;">
            <div class="input_msg_write">
              <input type="text" class="write_msg" placeholder="Type a message" id="mensajeEnviar" />
              <button class="msg_send_btn btn btn-primary" type="button" onclick="comprobarMsg();">Enviar</button>
            </div>
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