<?php
    session_start();
    $host='localhost';
            $usuario_bd='root';
            $password_bd='';
            $nombre_bd='gimnasio';
            $conexion=mysqli_connect($host,$usuario_bd,$password_bd,$nombre_bd);
            if (mysqli_connect_errno()) { //(!$conexion)
                printf("Conexión fallida: %s\n", mysqli_connect_error());
                exit();
            }          

            $dni = $_SESSION['userData']['dni'];
    if(isset($_POST['calcularIMC'])){
                    $peso = intval($_POST['peso']);
                    $altura = intval($_POST['altura']);
                    $alturam = $altura*0.01;
                    $imc = $peso/pow($alturam, 2);
                    $imc = round($imc,2);
                    $sql = "UPDATE matriculados SET peso=$peso,altura=$altura,imc=$imc WHERE dniMatriculado='$dni'";
                    $calcularIMC = mysqli_query($conexion, $sql);
                    if(!$calcularIMC){
                        header("location:error.php");
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
    <script type="text/javascript">
        //kg/m^2
        //50/((150*0.01)^2)
        /*0-15: muy bajo peso
15-16: Muy bajo peso
16-18.5: bajo peso
18.5 - 25: Rango Normal (saludable)
25-30: sobrepeso
30 - 35: Clase obesa I - Obesa moderada
35 - 40: Clase obesa II - Muy obesa
40: obeso clase III: muy obesos*/
    </script>
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
                        <a class="nav-link active" href="imc.php">Calculadora IMC</a>
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

            
            $sql = "SELECT peso,altura,imc FROM matriculados INNER JOIN usuarios ON dniMatriculado=dni
                    WHERE dni = '$dni'";
            $resultado = mysqli_query($conexion, $sql);
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $matriculados[] = $fila;
            }
                $matriculado = $matriculados[0];

                
    ?>

    <div class="container-fluid">
    	
    	<div class="row justify-content-center">
            <div class="col-md-6 p-5">
                <div class="row justify-content-center titulo-registro">
                        ¿Que es el IMC?
                    </div>
                <p>El índice de masa corporal (IMC) es un método utilizado para estimar la cantidad de grasa corporal que tiene una persona, y determinar por tanto si el peso está dentro del rango normal, o por el contrario, se tiene sobrepeso o delgadez. Para ello, se pone en relación la estatura y el peso actual del individuo.</p>

                <p>El IMC es una fórmula que se calcula dividiendo el peso, expresado siempre en Kg, entre la altura, siempre en metros al cuadrado. Una cosa importante que destaca la nutricionista es que no se pueden aplicar los mismos valores en niños y adolescentes que en adultos.</p>
                <div>
                    <ul>
                        <li>0-15: muy bajo peso</li>
                        <li>15-16: Muy bajo peso</li>
                        <li>16-18.5: bajo peso</li>
                        <li>18.5 - 25: Rango Normal (saludable)</li>
                        <li>25-30: sobrepeso</li>
                        <li>30 - 35: Clase obesa I - Obesa moderada</li>
                        <li>35 - 40: Clase obesa II - Muy obesa</li>
                        <li>40: obeso clase III: muy obesos</li>
                    </ul>
                </div>
            </div>
             <div class="col-md-6 p-5">
                <div class="row justify-content-center titulo-registro">
                        Calculadora IMC
                    </div>
                <form action="" method="post" id="formulario" class="mx-auto" style="width:70%">
                	<div class="form-row">
                        <div class="col-md-6 mb-3">
                	<label style="color:black">Peso 30-200 (kg): </label>
                	<input type="number" name="peso" id="peso" class="form-control" min="30" max="200" <?php echo "value = ".intval($matriculado['peso'])?>  required>
                	</div>
                    <div class="col-md-6 mb-3">
                	<label style="color:black">Altura 100-250 (cm): </label>
                	<input type="number" name="altura" id="altura" class="form-control" min="100" max="250" <?php echo "value = ".intval($matriculado['altura'])?> required>
                	</div>
                </div>
                <div class="form-row justify-content-center">
                    <label style="color:black;font-size: 20px;">Tu IMC: <?php echo $matriculado['imc']?></label>
                </div>
                <div class="form-row justify-content-center">
                	<input type="submit" name="calcularIMC" class="btn btn-danger" value="Calcular IMC">
                </div>
                </form>

                
                
                </div>
                
            </div>
        </div>

    </div>
</body>
</html>