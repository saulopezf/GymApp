<?php
    session_start();
    $host='localhost';
    $usuario_bd='guest';
    $password_bd='guest';
    $nombre_bd='gimnasio';
    $conexion=mysqli_connect($host,$usuario_bd,$password_bd,$nombre_bd);
    if (mysqli_connect_errno()) { //(!$conexion)
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        exit();
    }  
    if(isset($_GET['idClase'])){
        $idClase = $_GET['idClase'];
        $sql = "SELECT clases.idClase,clases.nombre as nombreClase,idMonitor,monitores.dniMonitor,usuarios.dni,usuarios.nombre,usuarios.apellido FROM clases INNER JOIN monitores ON clases.dniMonitor=monitores.dniMonitor INNER JOIN usuarios ON usuarios.dni=monitores.dniMonitor
            WHERE idClase = '$idClase'";
        $resultado = mysqli_query($conexion, $sql);
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $clases[] = $fila;
        }
/*clase*/     $clase = $clases[0];

        $sql = "SELECT horarios.id AS idHorario,clases.idClase,nombre,dia,horaInicio,horaFin FROM horarios INNER JOIN clases ON horarios.idClase=clases.idClase
                WHERE clases.idClase = $idClase
                ORDER BY dia ASC";
        $resultado = mysqli_query($conexion, $sql);
        while ($fila = mysqli_fetch_assoc($resultado)) {
/*horarios*/            $horarios[] = $fila;
        }
        if(isset($_SESSION['userData'])){
            if($_SESSION['userData']['user']=="gymMatriculado"){
                $dniMatriculado = $_SESSION['userData']['dni'];
                $sql2 = "SELECT horarios.id AS idHorario,clases.idClase,nombre,dia,horaInicio,horaFin FROM horarios INNER JOIN clases ON horarios.idClase INNER JOIN apuntados ON apuntados.idHorario=horarios.id
                    WHERE dniMatriculado='$dniMatriculado'
                    ORDER BY dia ASC";
                $resultado2 = mysqli_query($conexion, $sql2);
                $clasesApuntadas = [];
                while ($fila = mysqli_fetch_assoc($resultado2)) {
                    $clasesApuntadas[] = $fila;
                }
            }
        }
    }     
?>
<!DOCTYPE html>
<html>
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
    <style type="text/css">
        .btn-clase{
            width: 300px;
            height: 300px;
            font-size: 25px !important;
            font-weight: 1000 !important;
            color: #e1193e !important;
            text-transform: uppercase;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            transition: transform .2s;
            -webkit-text-stroke: 1px black;
        }
.btn-clase:hover{
            transform: scale(1.1);
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
                        <a class="nav-link active" href="clases.php">Clases</a>
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
    <?php
    if(isset($_GET['idClase'])){
        ?>
    <section class="hero-wrap hero-wrap-2" style="background-image:url(img/xbg_1.jpg.pagespeed.ic.nbLQLxtGBs.png)">
    <div class="overlay"></div>
    <div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
    <div class="col-md-9 mb-5 text-center">
    <p class="breadcrumbs">Clases</p>
    <h1 class="mb-0 bread"><?php echo $clase['nombreClase']?></h1>
    </div>
    </div>
    </div>
    </section>
    <?php
    }
        ?>
    <div class="container-fluid">
        <?php

            

            if(isset($_GET['idClase'])){
        ?>
        <div class="row g-md-0 justify-content-center my-5 py-5">
        <div class="col-md-5 d-flex align-items-center">
            <div class="services text-center self-align-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                <?php
                if(isset($_SESSION['userData'])){
                    if($clase['dniMonitor']==$_SESSION['userData']['dni']){
                        $dniMonitor = $_SESSION['userData']['dni'];
                        $idClase = $_GET['idClase'];
                        $sql = "SELECT usuarios.dni,usuarios.nombre,usuarios.apellido,horarios.dia,horarios.horaInicio,horarios.horaFin,usuarios.dni FROM apuntados INNER JOIN horarios ON horarios.id=apuntados.idHorario INNER JOIN matriculados ON matriculados.dniMatriculado=apuntados.dniMatriculado INNER JOIN clases ON clases.idClase=horarios.idClase INNER JOIN usuarios ON usuarios.dni=matriculados.dniMatriculado
                            WHERE clases.dniMonitor='$dniMonitor' AND clases.idClase=$idClase;";
                        $resultado = mysqli_query($conexion, $sql);
                        $alumnos = [];
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $alumnos[] = $fila;
                        }
                        echo "<h1>Sus alumnos: </h1>";
                        echo "<table class='table table-striped table-dark'><thead><th scope='col'>DNI</th><th scope='col'>Nombre</th><th scope='col'>Dia</th><th scope='col'>Hora Inicio</th><th scope='col'>Hora Fin</th></thead>";
                        foreach ($alumnos as $indice => $alumno) {
                            echo "<tr scope='row'>";
                            foreach ($alumno as $indice => $valor) {
                                if($indice=="nombre"){
                                    echo "<td>$valor ";
                                }
                                elseif ($indice=="apellido") {
                                    echo "$valor</td>";
                                }
                                else{
                                    echo "<td>$valor</td>";
                                } 
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                    else{
                ?>
                    <div>
                        <h2>Monitor:<br> <?php echo  $clase['nombre']." ".$clase['apellido'];?></h2>
                        <form action="monitores.php" method="get">
                            <?php
                            echo '<button type="submit" name="idMonitor" value="'.$clase['idMonitor'].'" class="btn btn-danger">Ir al monitor</button>';
                            ?>
                        </form>
                    </div>
                <?php
                    }
                }
                else{
                    ?>
                    <div>
                        <h2>Monitor:<br> <?php echo  $clase['nombre']." ".$clase['apellido'];?></h2>
                        <form action="monitores.php" method="get">
                            <?php
                            echo '<button type="submit" name="idMonitor" value="'.$clase['idMonitor'].'" class="btn btn-danger">Ir al monitor</button>';
                            ?>
                        </form>
                    </div>
                    <?php
                }

                ?>
            </div>
        </div>
            <div class="col-md-5 d-flex">
            <div class="services services-border text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
            <div class="text">
            <h2>Horarios: </h2>
            <?php
                echo "<table class='table table-striped table-dark'><thead><th scope='col'>Dia</th><th scope='col'>Hora Inicio</th><th scope='col'>Hora Fin</th><th scope='col'>Apuntarse</th></thead>";
                foreach ($horarios as $indice => $horario) {
                    echo "<tr><td scope='row'>".$horario['dia']."</td><td>".$horario['horaInicio']."</td><td>".$horario['horaFin']."</td><td>";
                    if(isset($_SESSION['userData'])){
                                if($_SESSION['userData']['user']=="gymMatriculado"){
                                    $estaApuntado = false;
                                    foreach ($clasesApuntadas as $indice => $claseApuntada) {
                                        if($claseApuntada['idHorario']==$horario['idHorario']){
                                            $estaApuntado = true;
                                        }
                                    }
                                    if($estaApuntado){
                                        echo "<button value='".$horario['idHorario']."' class='btn btn-success'>Apuntado</button><form action='php/apuntarse.php' method='post'><button type='submit' name='desapuntarse' value='".$horario['idHorario']."' class='btn btn-danger'>X</button></form>";
                                    }
                                    else{
                                        echo "<form action='php/apuntarse.php' method='post'><button type='submit' name='apuntarse' value='".$horario['idHorario']."' class='btn btn-danger'>Apuntarse</button></form>";
                                    }
                        }
                        else{
                            
                        }
                    }
                    else{
                        echo "<a href='login.php' class='btn btn-danger'>Iniciar sesion</a>";
                    }
                    echo "</td>";
                }
                 echo "</table>";
            ?>
            </div>
            </div>
            </div>
        </div>
        <?php
            }
            else{
                $sql = "SELECT idClase,nombre FROM clases";
                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $clases[] = $fila;
                }  
                echo '<div class="row">';
                foreach ($clases as $key => $clase) {
                    echo '<div class="col-12 col-xl-3 col-lg-4 col-sm-6 text-center my-5 pb-5">';
                    echo '<form action="" method="get">';
                    echo '<button type="submit" name="idClase" class="btn btn-clase self-align-center" style="background-image: url(\'img/loginbg.jpg\');" value="'.$clase['idClase'].'">'.$clase['nombre'].'</button>';
                    echo '</form>';
                    echo '</div>';
                }
                echo '</div>';
            }     
        ?>     
    </div>
<footer class="ftco-footer">
    <div class="container-fluid px-0 py-5 bg-darken">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p id="textoFooter" class="mb-0" style="color: rgba(255,255,255,.5); font-size: 13px;">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | GymApp hecho por Saul Lopez Fernandez
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>