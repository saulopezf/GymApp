<?php
include "php/conexion.php";
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
      <script src="js/ScriptsGym.js"></script>
      <style type="text/css">
        #mynav{
            position: absolute;
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg ftco-navbar-light" id="mynav">
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
                    <li class="nav-item active">
                        <a class="nav-link active" href="index.php">Inicio</a>
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

    <section class="slider-hero">
        <div class="hero-slider">
            <div class="item">
                <div class="work">
                    <div class="img img2 d-flex align-items-center js-fullheight" style="background-image:url(img/xbg_3.jpg.pagespeed.ic.3D5M-4z-2Z.png)">
                        <div class="container-xl">
                            <div class="row">
                                <div class="col-md-12 col-lg-10">
                                    <div class="row">
                                        <div class="col-md-8 col-lg-6">
                                            <div class="text mt-md-5" data-aos="fade-up" data-aos-duration="1000">
                                                <h2>Moldea tu cuerpo ideal</h2>
                                                <p class="mb-5">Todo los que necesitas saber para alcanzar tu sueño lo tienes aqui, en GymApp</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-5 text-center heading-section" data-aos="fade-up" data-aos-duration="1000">
                    <span class="subheading">¡Matriculate ahora!</span>
                    <h2 class="mb-3">Unete a nuestro gimnasio y ten acceso a <span>GymApp</span></h2>
                </div>
            </div>
            <div class="row g-md-0">
                <div class="col-md-4 d-flex">
                    <div class="services text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                        <div class="icon-svg">
                            <img src="img/001-fitness.svg" class="img-fluid" alt="">
                        </div>
                        <div class="text">
                            <h2>El mejor entrenamiento <br>fitness</h2>
                            <p>Tenemos los monitores mas preparados con unas clases hechas para facilitar tu desarrollo muscular y quema de calorías facil y divertido.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="services services-border text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                        <div class="icon-svg">
                            <img src="img/002-treadmill.svg" class="img-fluid" alt="">
                        </div>
                        <div class="text">
                            <h2>Clases &amp; Maquinas</h2>
                            <p>Podras apuntarte a las clases que tu quieras y todas las maquinas estan a tu disposición para moldear tu cuerpo.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="services services-border text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                        <div class="icon-svg">
                            <img src="img/003-vip-card.svg" class="img-fluid" alt="">
                        </div>
                        <div class="text">
                            <h2>Matriculate para más</h2>
                            <p>Con todas la matriculas viene incluido el uso de GymApp con todas sus funcionalidades. Desde apuntarse a clases hasta chatear con tus monitores favoritos para preguntarles dudas o consejos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container-fluid">
            <div class="row justify-content-center pb-5">
                <div class="col-md-7 text-center heading-section" data-aos="fade-up" data-aos-duration="1000">
                    <span class="subheading">Nuestros precios</span>
                    <h2 class="mb-3">Paquetes de <span>MATRICULAS</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="100">
                    <div class="block-7">
                        <div class="text-center" style="height: 390px;position: relative;">
                            <span class="excerpt d-block">Matricula básica</span>
                            <span class="price"><sup>$</sup> <span class="number">49</span></span>
                            <ul class="pricing-text mb-3">
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Acceso a la aplicacion GymApp</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Acceso a sala de maquinas</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>1 mes gratis</li>
                            </ul>
                            <a href="#" style="position: absolute;bottom: 0;margin-left:  21%;" class="btn btn-primary d-block px-2 py-3">Matriculate</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="block-7">
                        <div class="text-center" style="height: 390px;position: relative;">
                            <span class="excerpt d-block">Matricula de clases</span>
                            <span class="price"><sup>$</sup> <span class="number">79</span></span>
                            <ul class="pricing-text mb-3">
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Acceso a la aplicacion GymApp</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Acceso a sala de maquinas</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Acceso a todas las clases</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>2 meses gratis</li>
                            </ul>
                            <a href="#" style="position: absolute;bottom: 0;margin-left:  21%;" class="btn btn-primary d-block px-2 py-3">Matriculate</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="300">
                    <div class="block-7">
                        <div class="text-center" style="height: 390px;position: relative;">
                            <span class="excerpt d-block">Matricula de entrenador</span>
                            <span class="price"><sup>$</sup> <span class="number">109</span></span>
                            <ul class="pricing-text mb-3">
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Acceso a la aplicacion GymApp</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Acceso a sala de maquinas</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Acceso a todas las clases</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Entrenador personal</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>2 meses gratis</li>
                            </ul>
                            <a href="#" style="position: absolute;bottom: 0;margin-left:  21%;" class="btn btn-primary d-block px-2 py-3">Matriculate</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3" style="height: 390px;" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="400">
                    <div class="block-7">
                        <div class="text-center" style="height: 390px;position: relative;">
                            <span class="excerpt d-block">Matricula ultimate</span>
                            <span class="price"><sup>$</sup> <span class="number">149</span></span>
                            <ul class="pricing-text mb-3">
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Acceso a la aplicacion GymApp</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Acceso a sala de maquinas</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Acceso a todas las clases</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>Entrenador personal</li>
                                <li><span class="fa ion-ios-arrow-round-forward me-2"></span>4 meses gratis</li>
                            </ul>
                            <a href="#" style="position: absolute;bottom: 0;margin-left:  21%;" class="btn btn-primary d-block px-2 py-3">Matriculate</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-md-5">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-stretch">
                            <div class="services p-4 d-flex align-items-start" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-sport"></span></div>
                                <div class="text ps-4">
                                    <h2>El mejor equipamiento</h2>
                                    <p>Equipamiento de ultima generacion y alta calidad para que te sientas mejor que nunca.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-stretch">
                            <div class="services services-border p-4 d-flex align-items-start" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-gym"></span></div>
                                <div class="text ps-4">
                                    <h2>Abierto de lunes a domingo de 8:00 a 22:00</h2>
                                    <p>Podras venir a la sala de maquinas siempre que quieras en nuestro horario</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-stretch">
                            <div class="services services-border p-4 d-flex align-items-start" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-protein-supplement"></span></div>
                                <div class="text ps-4">
                                    <h2>Monitores preparados</h2>
                                    <p>Pregunta cualquier duda que tengas sobre entrenamiento, alimentacion y quema de calorias a nuestros monitores</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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