<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $adminConf->siteName ?> | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('backend/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('backend/dist/css/adminlte.min.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url($adminConf->logoutControllerMethod) ?>">
          <i class="fas fa-th-large"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url($adminConf->brandLink) ?>" class="brand-link">
      <img src="<?php echo base_url($adminConf->brand) ?>" alt="<?php echo $adminConf->siteName ?>" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light"> <br></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php foreach ($adminConf->navigation as $nav): ?>
                <li class="nav-item">
                    <a href="<?php echo site_url($nav['link']) ?>" class="nav-link">
                        <i class="<?php echo $nav['icon'] ?>"></i>
                        <p><?php echo $nav['name'] ?></p>
                    </a>
                </li>
            <?php endforeach?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $page_title ?></h1>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php echo $this->renderSection('yield') ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
       <b>ADMIN LTE</b> 3.0.5
    </div>
    <strong>Copyright &copy; <?php echo date('Y') ?> <?php echo $adminConf->copyright ?>.</strong> Todos os direitos reservados
  </footer>
</div>
<script src="<?php echo base_url('backend/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('backend/dist/js/adminlte.min.js') ?>"></script>
</body>
</html>