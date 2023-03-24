<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>

    <div class="row">
      <div class="col-12 mb-4">
        <div class="hero bg-primary text-white">
          <div class="hero-inner">
            <h2>Welcome Back, <?= $this->session->userdata('nama_lengkap'); ?></h2>
            <p class="lead">Selamat datang di Aplikasi Manajemen Kas</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="<?= base_url(); ?>datakasmasuk">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="fas fa-pencil-ruler"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Kas Masuk</h4>
              </div>
              <div class="card-body">
                Rp. <?= number_format($total_kas_masuk); ?>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="<?= base_url(); ?>datakaskeluar">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-address-card"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Kas Keluar</h4>
              </div>
              <div class="card-body">
                Rp. <?= number_format($total_kas_keluar); ?>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="<?= base_url(); ?>reportkas?q=<?= date('Y') ?>">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Sisa Saldo</h4>
              </div>
              <div class="card-body">
                Rp. <?= number_format($total_kas_masuk - $total_kas_keluar); ?>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <a href="<?= base_url(); ?>datawarga">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-robot"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Data Warga</h4>
              </div>
              <div class="card-body">
                <?= $total_warga; ?>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>