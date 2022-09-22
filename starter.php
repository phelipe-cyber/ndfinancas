<?php
session_start();
include_once("verifica_login.php");
include_once("verifica_acesso.php");
include_once("conexao.php");

$id_user = $_SESSION['id_user'];
// print_r($acessos_page);


?>
<!DOCTYPE html>

<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ND Finanças</title>
  <link rel="shortcut icon" href="/dist/img/ndicon.ico">

  <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> -->
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> -->
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="starter.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="logout.php" class="nav-link">Sair</a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

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
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/nd.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ND FINANÇAS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
          </div>
          <div class="info">
            <a href="#" class="d-block"> <?php echo $_SESSION['login'] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php

  foreach( $acessos as $ver_acessos):
      // print_r($ver_acessos['menu_name']);
?>
            <li class="nav-item menu-open">
              <a class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  <?php echo $ver_acessos['menu_name'] ?>
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <?php 
            
            $ver_acessos_name = explode('|-separator-sql-|', $ver_acessos['menu_folder']);
            $menu_sep = explode('|-separator-sql-|', $ver_acessos['menu']);
            // print_r($menu_sep);
            foreach ($ver_acessos_name as $key => $name):

                  // print_r($name);
                ?>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a id="<?php echo $name ?>" href="<?php echo $name.".php" ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <?php
                          ?> <p><?php echo($menu_sep[$key]) ?></p><?php
                       ?>
                  </a>
                </li>
              </ul>
              <!-- <script>
                     $("#<?php echo $name.".php" ?>").click(function() {  
                       
                          document.getElementById('class<?php echo $name.".php" ?>').classList.add('active');
                        });
                    </script> -->
              <?php
              endforeach;
              ?>
            </li>
            <?php
  endforeach;

?>
                


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="height: auto;" >
      <!-- Content Header (Page header) -->
      <div class="content-header">

        <?php 
      
      if (in_array($array_salvar, $acessos_page)) { 
        // echo "Tem Acesso";
    } else  {
        // echo "Sem Acesso";
        ?>
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="col-12">

                  <div id="spiner" style="display: none;">
                    <!-- <div class="spinner-border"></div> -->
                    <div class="text-center">
                      <div class="spinner-border" role="status">

                      </div>
                    </div>
                    <div class="text-center">
                      <!-- <label>Buscando...</label> -->
                    </div>
                  </div>
                  <div id="danger-alert" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Erro!</h5>
                    Sem acesso a esta página!
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
        die();
    }

      ?>

      </div>
      <?php 
    // echo $id_user;
  ?>
      <!-- Conteudo aqui -->
      <!-- Main content -->

      <!-- <script src="plugins/jquery/jquery.min.js"></script> -->
      <!-- Bootstrap 4 -->
      <!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
      <!-- AdminLTE App -->
      <script src="dist/js/adminlte.min.js"></script>

</body>

</html>