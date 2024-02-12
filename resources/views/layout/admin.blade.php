<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PUNTO DE VENTA</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-eOJMYsd53ii5bFc7FqC6U3tw3EuD5lLnxF6IyoNyoa7Ip/dSbZ5Roo68tNvoJ9/J" crossorigin="anonymous">
<!-- Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" integrity="sha384-pzjw8z+IgGdPL5op5zVRi3gBvltKEkRRp4S0k6Dm4iND4uQmG1L1XUoq6QF5qiw" crossorigin="anonymous">

<!-- full calendar para el calendario -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" integrity="sha256-rS4Cq3MV7GshCvx6irWknrC5NlROvX+6+9O58XZmU5g=" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/proyecto_vison/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/proyecto_vison/public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/proyecto_vison/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/proyecto_vison/public/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/proyecto_vison/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/proyecto_vison/public/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/proyecto_vison/public/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links barra superior donde esta el home-->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo de inicio -->
    <a href="{{route('consultas.index')}}" class="brand-link">
      <img src="https://static.vecteezy.com/system/resources/previews/000/554/206/original/cool-sunglasses-eye-frames-vector-icon.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Optica</span>
    </a>

    <div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Botón Dashboard -->
      <li class="nav-item">
        <a href="{{route('consultas.index')}}" class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Citas</p>
        </a>
      </li>

      <!-- Botón Clientes -->
      <li class="nav-item">
        <a href="{{route('cliente.index')}}" class="nav-link">
          <i class="nav-icon fas fa-chart-pie"></i>
          <p>Clientes</p>
        </a>
      </li>

      <!-- Botón Almacén con submenú -->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Almacén
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>

        <!-- Submenú de Almacén -->
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('armazones.index') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Armazones</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('insumo.index')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Insumos</p>
            </a>
          </li>
        </ul>
      </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Ventas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('bucarclienteexistencia')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Venta a cliente</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('encontrar.verificarpersonas2')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Venta rápida</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Seguridad
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="{{ route("usuarios.index") }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>
                
                <!-- <li class="nav-item">
                  <a href="pages/forms/general.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>laboratorio</p>
                  </a>
                </li> -->
              </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Reporteria
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('bucarventas')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ventas x Día</p>
                  </a>
                </li>

                <!-- <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p></p>
                  </a>
                </li> -->
              </ul>
              <!--termina el listado  -->
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Dashboard</h1> lado derecho de la plantilla -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="{{ route('consultas.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @yield('contenido')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- mensajes temporales -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery agregado para fecha calendario y el axion-->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script> -->

<!-- full calendar para el calendario -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js" integrity="sha256-43Kl6pvmC27ENYK3d3A4DpSOpZlTwn6UqfCkEhAA9E4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js" integrity="sha256-rS4Cq3MV7GshCvx6irWknrC5NlROvX+6+9O58XZmU5g=" crossorigin="anonymous"></script> -->

  <!-- FullCalendar idioma español -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/locale/es.js" integrity="sha256-hqDaMlCdsA0N4YFYE0zf5T+3cAvP7dhYXnhj9e6WzjQ=" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> 
<!-- jQuery -->
<script src="/proyecto_vison/public/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/proyecto_vison/public/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/proyecto_vison/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/proyecto_vison/public/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/proyecto_vison/public/plugins/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="/proyecto_vison/public/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/proyecto_vison/public/plugins/moment/moment.min.js"></script>
<script src="/proyecto_vison/public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/proyecto_vison/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/proyecto_vison/public/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/proyecto_vison/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/proyecto_vison/public/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/proyecto_vison/public/dist/js/pages/dashboard.js"></script>
</body>
</html>
