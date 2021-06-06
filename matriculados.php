<?php
    include "php/conexion.php";
    session_start();
    if(isset($_SESSION['userData'])){
        if($_SESSION['userData']['user']!="gymMatriculado"){
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
      <script src="js/ScriptsGym.js"></script>
      <style type="text/css">

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
                        <a class="nav-link active" href="matriculados.php">Lista de Matriculados</a>
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
      
    <div class="container-fluid text-center">
        <div class="row d-flex justify-content-center p-5">
            <?php
            $conexion=conexion();       

            if(isset($_GET['dniMatriculado'])){
                $dniMatriculado = $_GET['dniMatriculado'];
                $sql = "SELECT dniMatriculado,peso,altura,imc,usuarios.nombre,usuarios.apellido FROM matriculados INNER JOIN usuarios ON usuarios.dni=matriculados.dniMatriculado
                WHERE dniMatriculado = '$dniMatriculado'";
                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $matriculados[] = $fila;
                }
                $matriculado = $matriculados[0];
                ?>
                <div class="col-12">
                    <table class="table table-striped table-dark">
                        <thead>
                            <th scope="col">DNI</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Peso (kg)</th>
                            <th scope="col">Altura (cm)</th>
                            <th scope="col">IMC</th>
                        </thead>
                        <tr scope="row">
                            <?php
                            echo "<td>".$matriculado['dniMatriculado']."</td>";
                            echo "<td>".$matriculado['nombre']." ".$matriculado['apellido']."</td>";
                            echo "<td>".$matriculado['peso']."</td>";
                            echo "<td>".$matriculado['altura']."</td>";
                            echo "<td>".$matriculado['imc']."</td>";
                            ?>
                            
                        </tr>
                    </table>
                </div>
                <div class="col-12 mt-5" style="height: 100vh;">
                    <a href="matriculados.php" class="btn btn-danger self-align-center">Atrás</a>
                </div>
                <?php
            }
            else{
                $sql = "SELECT dni,nombre,apellido,sexo,fechaNacimiento,telefono,mail FROM usuarios INNER JOIN matriculados ON usuarios.dni=matriculados.dniMatriculado
                WHERE rol='matriculado'";
                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $matriculados[] = $fila;
                } 

                echo '<table class="table table-striped table-dark"><thead><th scope="col">DNI</th><th scope="col">Nombre</th><th scope="col">Apellido</th><th scope="col">Sexo</th><th scope="col">Fecha de Nacimiento</th><th scope="col">Telefono</th><th scope="col">Correo electronico</th><th scope="col">Datos fisicos</th><th scope="col">Contactar</th></thead>';
                foreach ($matriculados as $key => $matriculado) {
                    echo '<tr scope="row">';
                    foreach ($matriculado as $key => $valor) {
                        echo '<td>'.$valor.'</td>';
                    }
                    echo '<td>';
                    echo '<form action="" method="get">';
                    echo '<button type="submit" name="dniMatriculado" value="'.$matriculado['dni'].'" class="btn btn-danger">Mas info</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '<td>';
                    echo '<form action="mensajes.php" method="post">';
                    echo '<button type="submit" name="dni" value="'.$matriculado['dni'].'" class="btn btn-danger">Mensaje</button>';
                    echo '</form>';
                    echo '</td></tr>';
                }
                echo '</table>';
            }    
            ?>  
        </div>
    </div>   

</body>
</html>
<?php
    }
    else{
        header("location: index.php");
    }
}
else{
    header("location: index.php");
}
?>