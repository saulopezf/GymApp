<?php
session_start();
if(isset($_SESSION['error'])){
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
    <div class="container-fluid">
        <div class="row justify-content-center" id="imagenTop" style="height: 100vh">
            <div class="align-self-center gym-register">
                    <div class="row text-center justify-content-center titulo-registro">
                        ¡Ha ocurrido un error!
                    </div>
                    <div class="text-center" style="color:white;">
                        <p><?php echo "\"".$_SESSION['error']."\"" ?></p>
                        <a class="btn btn-danger" href="index.php">Volver al inicio</a>
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