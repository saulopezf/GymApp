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
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
      <script src="js/slider.js"></script>
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
                                                <p class="mb-5">A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                                <p><a href="#" class="btn btn-danger px-4 py-3">MATRICULATE YA!<span class="ion ion-ios-arrow-round-forward"></span></a></p>
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


<!--    <div class="container-fluid">  

        <div class="row justify-content-center" id="cabezera" style="">   

            <div id="carouselExampleIndicators" class="carousel slide mx-auto" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
            <div class="carousel-inner">
                <div class="carousel-item">
                    <img class="d-block w-100" src="img/h1_hero.png.png" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>New York</h5>
                        <p>We love the big apple</p>
                    </div>
                </div>
        <div class="carousel-item active">
        <img class="d-block w-100" src="img/xbg_3.jpg.pagespeed.ic.3D5M-4z-2Z.png" alt="First slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Chicago</h5>
          <p>We love the big apple</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="img/xbg_2.jpg.pagespeed.ic.00rxxJ64yj (1).png" alt="Second slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Los Angeles</h5>
          <p>We love the big apple</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    
  </div>
            </div>
      </div>-->


      <section class="ftco-section">
            <div class="container">
            <div class="row justify-content-center pb-5">
            <div class="col-md-5 text-center heading-section" data-aos="fade-up" data-aos-duration="1000">
            <span class="subheading">Join Us Now</span>
            <h2 class="mb-3">Join Us Our Free Workout Training With <span>Dazko</span></h2>
            </div>
            </div>
            <div class="row g-md-0">
            <div class="col-md-4 d-flex">
            <div class="services text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
            <div class="icon-svg">
            <img src="images/svg/001-fitness.svg" class="img-fluid" alt="">
            </div>
            <div class="text">
            <h2>Free Fitness <br>Training</h2>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
            </div>
            </div>
            </div>
            <div class="col-md-4 d-flex">
            <div class="services services-border text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
            <div class="icon-svg">
            <img src="images/svg/002-treadmill.svg" class="img-fluid" alt="">
            </div>
            <div class="text">
            <h2>Tons of Cardio &amp; Strength</h2>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
            </div>
            </div>
            </div>
            <div class="col-md-4 d-flex">
            <div class="services services-border text-center" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
            <div class="icon-svg">
            <img src="images/svg/003-vip-card.svg" class="img-fluid" alt="">
            </div>
            <div class="text">
            <h2>No Commentment Memberships</h2>
            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
            </div>
            </div>
            </div>
            </div>
            </div>
      </section>

      
</body>
</html>