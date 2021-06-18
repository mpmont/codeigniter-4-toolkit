<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $adminConf->siteName ?? '' ?> | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php foreach ($adminConf->css as $key => $file): ?>
        <?php if (filter_var($file, FILTER_VALIDATE_URL)): ?>
            <link rel="stylesheet" href="<?php echo $file ?>">
        <?php else: ?>
            <link rel="stylesheet" href="<?php echo base_url($adminConf->assetsPath . $file) ?>">
        <?php endif;?>
    <?php endforeach?>
  <style>
       [class*="sidebar-dark-"] .sidebar a{color: <?php echo $adminConf->colors['sidebarLink'] ?? '#c2c7d0' ?>;}
       [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link {color: <?php echo $adminConf->colors['sidebarLink'] ?? '#c2c7d0' ?>;}
       [class*=sidebar-dark-] .nav-sidebar>.nav-item.menu-open>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item:hover>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link:focus, [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link:focus, [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link:hover {
            background-color: <?php echo $adminConf->colors['sidebarHover'] ?? 'rgba(255, 255, 255, .1)'; ?>;
            color: <?php echo $adminConf->colors['sidebarHoverLink'] ?? '#FFFFFF' ?>;
        }
        .content-wrapper {
            background-color: <?php echo $adminConf->colors['contentWrapper'] ?? '#f4f6f9' ?>;
        }
        .btn.btn-primary,  .btn.btn-primary:focus, .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle{
            background-color: <?php echo $adminConf->colors['primaryColor'] ?? '#007bff'; ?>;
            border-color: <?php echo $adminConf->colors['primaryColor'] ?? '#007bff'; ?>
        }
    </style>
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
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: <?php echo $adminConf->colors['sidebarBG'] ?? '#343a40' ?>">
    <!-- Brand Logo -->
    <a href="<?php echo site_url($adminConf->brandLink ?? '') ?>" class="brand-link">
        <?php if (!empty($adminConf->logo)): ?>
            <img src="<?php echo base_url($adminConf->logo) ?>" alt="<?php echo $adminConf->brand ?>" class="brand-image"
               style="opacity: .8">
            <span class="brand-text font-weight-light">
                <small><?php echo $adminConf->brand ?? null ?></small>
            </span>
        <?php else: ?>
            <?php echo $adminConf->brand ?? null ?>
        <?php endif;?>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php foreach ($adminConf->navigation as $nav): ?>
                <?php if (!isset($nav['childs'])): ?>
                    <li class="nav-item">
                        <a href="<?php echo site_url($nav['link']) ?>" class="nav-link">
                            <i class="<?php echo $nav['icon'] ?>"></i>
                            <p><?php echo $nav['name'] ?></p>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="<?php echo $nav['icon'] ?>"></i>
                            <p>
                                <?php echo $nav['name'] ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                          <?php foreach ($nav['childs'] as $child): ?>
                            <li class="nav-item">
                                <a href="<?php echo $child['link'] ?>" class="nav-link">
                                    <i class="<?php echo $child['icon'] ?>"></i>
                                    <p><?php echo $child['name'] ?></p>
                                </a>
                            </li>
                          <?php endforeach?>
                        </ul>
                      </li>
                <?php endif?>
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
        <?php if (!empty($confirm)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $confirm ?>
            </div>
        <?php endif?>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-success" role="alert">
                <?php foreach ($errors as $error): ?>
                    <?php echo $error ?>
                <?php endforeach?>
            </div>
        <?php endif?>
        <?php if (isset($adminConf->breadcrumb) && $adminConf->breadcrumb): ?>
            <?php echo $breadcrumb->render(); ?>
        <?php endif?>
        <?php echo $this->renderSection('yield') ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
       <?php echo $adminConf->copyrightRight ?? null ?>
    </div>
    <?php echo $adminConf->copyrightLeft ?? null ?>
  </footer>
</div>
<?php foreach ($adminConf->js as $key => $file): ?>
    <?php if (filter_var($file, FILTER_VALIDATE_URL)): ?>
        <script src="<?php echo $file ?>"></script>
    <?php else: ?>
        <script src="<?php echo base_url($adminConf->assetsPath . $file) ?>"></script>
    <?php endif;?>
<?php endforeach?>
</body>
</html>
