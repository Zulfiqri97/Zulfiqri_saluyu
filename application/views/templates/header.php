<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url('assets/images/saluyu1.png'); ?>" rel="icon">
  <title>Cv.Saluyu</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css'); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'); ?>">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'); ?>">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/bs-stepper/css/bs-stepper.min.css'); ?>">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/dropzone/min/dropzone.min.css'); ?>">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css'); ?>">
  <!-- jQuery -->
  <script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
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
        <a href="<?= base_url() ?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
   
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="<?= base_url('assets/images/saluyu1.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Cv.Saluyu - <?= $this->session->userdata('user_type'); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $this->session->userdata('name'); ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-handshake"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url("request") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Request Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url("transaction") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Transaksi</p>
                </a>
              </li>
            </ul>
          </li>
          <?php if ($this->session->userdata('is_employee_read')) { ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Karyawan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url("employee") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Karyawan</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url("user") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data User</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <?php if ($this->session->userdata('user_type') == 'super admin' || $this->session->userdata('user_type') == 'admin') { ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Toko & Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url("store") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Toko</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url("product") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Produk</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url("supply") ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Suplai Barang</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a href="<?= base_url("auth/logout") ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
