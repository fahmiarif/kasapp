<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
  .navbar-bg {
    background-color: #408768;
  }

  .btn-primary {
    background-color: #408768;
    box-shadow: 0 2px 6px #038f0f;
    border-color: #038f0f;
  }

  .btn-primary:hover {
    background-color: #00743d !important;
  }

  .select2-container--default .select2-selection--single {
    background-color: #fdfdff;
    border: 1px solid #e4e6fc;
    border-radius: 4px;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 40px;
  }

  .main-sidebar .sidebar-menu li.active a {
    color: #408768;
  }
</style>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?php echo base_url(); ?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, <?= $this->session->userdata('nama_lengkap'); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 1 min ago</div>
              <a href="#" class="dropdown-item has-icon">
                <i class="far fa-user"></i> <?= $this->session->userdata('nama_lengkap'); ?>
              </a>
              <a href="<?=base_url();?>" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Kunjungi Website
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url(); ?>auth/logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>