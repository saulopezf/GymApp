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
      <style type="text/css">

        #cabezera{
            background-image: url("img/cabezera1.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;
        }

        #mynav{
            position: absolute;
            width: 100%;
        }

    </style>
</head>
<body>
      <?php
            session_start();
      ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mynav">
            <a class="navbar-brand" href="index.php">GymApp</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fa fa-bars" aria-hidden="true"></i>
              Menu
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="login.php">Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="monitores.php">Monitores</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="mensajes.php">mensajes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="php/cerrarSesion.php">Cerrar sesion</a>
                </li>
                  <?php
                        if(isset($_SESSION['userData'])){
                  ?>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $_SESSION['userData']['nombre']." ".$_SESSION['userData']['apellido'] ?> <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        sadf
                        <li><a href="">sdaf</a></li>
                        
                                   
                      </ul>
                  </li>
                  <?php
                        }
                  ?>
              </ul>
            </div>
      </nav>    
      <div class="container-fluid">  

      <div class="row justify-content-center" id="cabezera" style="height: 100vh;">   
            <div class="align-self-center">
                  <a class="btn btn-danger btn-lg active" href="inicio.html">Inicio</a>
            </div>
      </div>
      </div>

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