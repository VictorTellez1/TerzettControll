<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/build/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/build/img/logo-terzett.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Actualizacion de tarea | Terzett Technologix
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="/build/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/build/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/build/demo/demo.css" rel="stylesheet" />
  <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="red">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <img src="/build/img/System_Hercules.png" alt="">
        </a>
        <a style="font-family: 'Righteous', cursive;" class="simple-text logo-normal">
        System Hercules
        </a> 
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
        <li>
            <a href="/admin/usuario">
              <i class="now-ui-icons users_single-02"></i>
              <p>Cuenta</p>
            </a>
          </li>
          <li>
            <a href="/admin/usuarios">
              <i class="now-ui-icons business_badge"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li class="active ">
            <a href="/admin/proyectos">
              <i class="now-ui-icons education_atom"></i>
              <p>Proyectos</p>
            </a>
          </li>
          <li>
            <a href="/Retro">
              <i class="now-ui-icons design_palette"></i>
              <p>Ayuda</p>
            </a>
          </li>
          <li>
            <a href="/logout">
              <i class="now-ui-icons objects_key-25"></i>
              <p>Cerrar sesión</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="https://policy.terzett.tech/privacy-es" target="_blank">
              <i class="now-ui-icons ui-1_lock-circle-open"></i>
              <p>Aviso de privacidad</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Actualización de tareas</a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><?php echo $tarea->nombre ?></h4>
            </div>
            <div class="card-body">
            <?php 
                $mensaje = mostrarNotificacion( intval( $resultado) );
                if($mensaje) { ?>
                    <p class="alert alert-success text-white font-weight-bold text-center text-uppercase"><?php echo s($mensaje); ?></p>
                <?php } 
              ?>
              
                <?php
                    include_once __DIR__."/../templates/alertas.php";

                ?> 
                <form action="/admin/proyectos/tablon/tareas-actualizar?url=<?php echo $tarea->url ?>" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre del proyecto</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo s($tarea->nombre) ?>">
                      </div>
                    <div class="form-group">
                        <p>Estado :
                            <?php if($tarea->estado=='0') $tarea->estado="Nueva" ?>
                            <?php if($tarea->estado=='1') $tarea->estado="Estancada" ?>
                            <?php if($tarea->estado=='2') $tarea->estado="En proceso" ?>
                            <?php if($tarea->estado=='3') $tarea->estado="Lista" ?>
                            <?php echo $tarea->estado ?>
                            
                        </p>
                    <div class="form-group">
                        <label for="estado">Cambiar estado</label>
                        <select class="form-select" aria-label="Selecciona el lugar donde se desarrolla el proyecto" name="estado">
                            <option value="0" <?php if($tarea->estado=='Nueva') echo "selected" ?>>Nueva</option>
                            <option value="1" <?php  if($tarea->estado=='Estancada') echo "selected" ?>>Estancada</option>
                            <option value="2" <?php  if($tarea->estado=='En proceso') echo "selected" ?>>En proceso</option>
                            <option value="3" <?php  if($tarea->estado=='Lista') echo "selected" ?>>Lista</option>
                        </select>
                    </div>
                        <button href="/admin/proyectos/tablon/tareas-actualizar?url=<?php echo $tarea->url ?>" type="submit" class="btn btn-primary">Actualizar</button>
                  </form>
                </table>
              </div>
            </div>
          </div>
        </div>
      
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://policy.terzett.tech/quality-es">
                  Política de calidad
                </a>
              </li>
              <li>
                <a href="https://policy.terzett.tech/security-es">
                  Política de seguridad
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Terzett Technologix. Todos los derechos reservados.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="/build/js/core/jquery.min.js"></script>
  <script src="/build/js/core/popper.min.js"></script>
  <script src="/build/js/core/bootstrap.min.js"></script>
  <script src="/build/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="/build/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="/build/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/build/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="/build/demo/demo.js"></script>
  <script src="/build/js/grupos.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
</body>

</html>