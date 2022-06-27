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
    Proyectos | Terzett Technologix
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
            <a href="/lider/usuario">
              <i class="now-ui-icons users_single-02"></i>
              <p>Cuenta</p>
            </a>
          </li>
          <li class="active ">
            <a href="/lider/proyectos">
              <i class="now-ui-icons education_atom"></i>
              <p>Proyectos</p>
            </a>
          </li>
          <li>
            <a href="/Ayuda">
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
      <nav class="navbar navbar-expand-lg bg-primary navbar-absolute navbar-transparent">
            <div class="container-fluid">
            <div class="navbar-wrapper">
            <div class="navbar-toggle">
            <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
            </button>
            </div>
            <a class="navbar-brand" href="#pablo">Admnistración de proyectos</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="navbar-collapse justify-content-end collapse show" id="navigation" style="">
            <form class="form-inline my-2 my-lg-0" action="/lider/proyectos/filtro" method="POST">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar..." aria-label="Search"  id="nombre" name="busqueda">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                  </form>

            

            <ul class="navbar-nav">
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" rel="tooltip" title="Filtrar con las siguientes opciones">
            <i class="now-ui-icons education_glasses"></i>
            <p>
            <span class="d-lg-none d-md-block">Some Actions</span>
            </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="/lider/proyectos/filtro?filtro=0">Ford</a>
            <a class="dropdown-item" href="/lider/proyectos/filtro?filtro=1">BD</a>
            <a class="dropdown-item" href="/lider/proyectos/filtro?filtro=2">Internos</a>
            </div>
            </li>
            </ul>
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
            <div class="card-header d-flex bd-highlight">
              <h4 class="card-title p-2 flex-grow-1 bd-highlight">Proyectos</h4>
              <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              Crear tablón
            </a>
            </div>
          <?php
              include_once __DIR__."/../templates/alertas.php";
          ?>
          <?php 
            $mensaje = mostrarNotificacion( intval( $resultado) );
            if($mensaje) { ?>
              <p class="alert alert-success text-white font-weight-bold text-center text-uppercase"><?php echo s($mensaje); ?></p>
            <?php } 
          ?>
        <form method="POST" action="/lider/proyectos">
            <div class="container">
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del tablón</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre del tablón" name="nombre" value="<?php echo s($tablon->nombre) ?>">
                </div>
                <div class="mb-3">
                  <label for="lugar" class="form-label">Lugar del Tablon</label>
                  <select class="form-select" aria-label="Selecciona el lugar donde se desarrolla el proyecto" name="lugar">
                      <option value="0">FORD</option>
                      <option value="1">BD</option>
                      <option value="2">Interno</option>
                  </select>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripción del tablón" name="descripcion" value="<?php echo s($tablon->nombre) ?>" ></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
            </div>
        </form>
        <?php if(empty($tablones)) {?>
            <p class="text-center">No hay tablones con estos parametros o no has creado alguno aun</p>

        <?php } ?>
          <?php foreach($tablones as $tablon) {?>
            <div class="card text-center container">
                <div class="card-header">
                    <strong>Líder de proyecto:<br></strong>  <?php echo $tablon->lider; ?>
                </div>
                  <div class="card-body">
                <strong>Título:<br></strong>
                  <p class="card-text"><?php echo $tablon->nombre; ?></p>
                <strong>Descripción:<br></strong>
                  <p class="card-text"><?php echo $tablon->descripcion; ?></p>
                <strong>Destino de proyecto:<br></strong>
                  <?php if($tablon->lugar=='0') $tablon->lugar="FORD" ?>
                  <p><?php if($tablon->lugar=='1') $tablon->lugar="BD" ?>
                  <?php if($tablon->lugar=='2') $tablon->lugar="Interno" ?>
                  <p class="card-text"><?php echo $tablon->lugar?></p>
                <strong>Fecha de creación:<br></strong> 
                <?php echo $tablon->fecha; ?>
                  <div class="btn-toolbar justify-content-center">
                    <a href="/lider/proyectos/tablon?url=<?php echo $tablon->url?>" class="btn btn-primary ml-3">Detalles del tablón</a>
                    <form method="POST" action="/lider/proyectos/eliminar?url=<?php echo $tablon->url?>" class="eliminar">
                      <button href="/lider/proyectos/eliminar?url=<?php echo $tablon->url?>" class="btn btn-danger ml-3">Eliminar del tablón</button>
                    </form>
                    <!-- <button data-id="<?php echo $tablon->url?>" class="btn btn-danger ml-3 button">Eliminar el tablón</button> -->
                    <form method="POST" action="/lider/proyectos/tablon/pdf?url=<?php echo $tablon->url?>">
                      <button href="/lider/proyectos/tablon/pdf=<?php echo $tablon->url?>" class="btn btn-success ml-3">Descargar el tablón</button>
                    </form>
                  </div>
                </div>
              </div>
              <?php } ?>
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
  <script>
$('.eliminar').submit(function(e){
        e.preventDefault();
        swal({
        title: '¿Deseas eliminar?',
        text: "¡Esta acción no se puede revertir,asegurate de descargar el pdf si de verdad desea eliminar este tablon!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si,eliminar',
        cancelButtonText: 'Cancelar'
        }).then((result) => {
            swal(
            'Datos Eliminados!',
            'eliminación correcta',
            'success'
            )
            this.submit();
        
        })
    });    
</script>
</body>

</html>