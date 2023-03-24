<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <img src="<?php echo base_url(); ?>assets/img/kasapp.png" alt="logo" width="50" class="shadow-light rounded-circle">
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <img src="<?php echo base_url(); ?>assets/img/kasapp.png" alt="logo" width="50" class="shadow-light rounded-circle">
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="<?php echo $this->uri->segment(1) == 'home' ? 'active' : ''; ?>">
        <a class="nav-link <?php echo $this->uri->segment(1) == 'home' ? ' beep beep-sidebar' : ''; ?>" href="<?php echo base_url(); ?>home"><i class="fas fa-fire">
          </i> <span>Home</span>
        </a>
      </li>
      <li class="menu-header"> Menu Utama</li>

      <li class="<?php echo $this->uri->segment(1) == 'datakasmasuk' ? 'active' : ''; ?>">
        <a class="nav-link <?php echo $this->uri->segment(1) == 'datakasmasuk' ? ' beep beep-sidebar' : ''; ?>" href="<?php echo base_url(); ?>datakasmasuk"><i class="fas fa-pencil-ruler">
          </i> <span>Data Kas Masuk</span>
        </a>
      </li>
      <li class="<?php echo $this->uri->segment(1) == 'datakaskeluar' ? 'active' : ''; ?>">
        <a class="nav-link <?php echo $this->uri->segment(1) == 'datakaskeluar' ? ' beep beep-sidebar' : ''; ?>" href="<?php echo base_url(); ?>datakaskeluar"><i class="fas fa-pencil-ruler">
          </i> <span>Data Kas Keluar</span>
        </a>
      </li>
      <li class="<?php echo $this->uri->segment(1) == 'tunggakan' ? 'active' : ''; ?>">
        <a class="nav-link <?php echo $this->uri->segment(1) == 'tunggakan' ? ' beep beep-sidebar' : ''; ?>" href="<?php echo base_url(); ?>tunggakan?q=<?= date('Y') ?>&b=1"><i class="fas fa-pencil-ruler">
          </i> <span>Tunggakan</span>
        </a>
      </li>
      <li class="<?php echo $this->uri->segment(1) == 'reportkas' ? 'active' : ''; ?>">
        <a class="nav-link <?php echo $this->uri->segment(1) == 'reportkas' ? ' beep beep-sidebar' : ''; ?>" href="<?php echo base_url(); ?>reportkas?q=<?= date('Y') ?>">
          <i class="fas fa-file-export"></i> <span>Report Kas</span>
        </a>
      </li>
      <li class="menu-header"> Data Master</li>
      <li class="<?php echo $this->uri->segment(1) == 'datablok' ? 'active' : ''; ?>">
        <a class="nav-link <?php echo $this->uri->segment(1) == 'datablok' ? ' beep beep-sidebar' : ''; ?>" href="<?php echo base_url(); ?>datablok">
          <i class="fas fa-robot"></i> <span>Data Blok</span>
        </a>
      </li>
      <li class="<?php echo $this->uri->segment(1) == 'datawarga' ? 'active' : ''; ?>">
        <a class="nav-link <?php echo $this->uri->segment(1) == 'datawarga' ? ' beep beep-sidebar' : ''; ?>" href="<?php echo base_url(); ?>datawarga">
          <i class="fas fa-address-card"></i> <span>Data Warga</span>
        </a>
      </li>
      <li class="<?php echo $this->uri->segment(1) == 'dataitem' ? 'active' : ''; ?>">
        <a class="nav-link <?php echo $this->uri->segment(1) == 'dataitem' ? ' beep beep-sidebar' : ''; ?>" href="<?php echo base_url(); ?>dataitem">
          <i class="fas fa-clipboard-check"></i> <span>Data Item</span>
        </a>
      </li>
      <!-- Jika role admin -->
      <?php if ($this->session->userdata('role_id') == 1) : ?>
        <li class="<?php echo $this->uri->segment(1) == 'datauser' ? 'active' : ''; ?>">
          <a class="nav-link <?php echo $this->uri->segment(1) == 'datauser' ? ' beep beep-sidebar' : ''; ?>" href="<?php echo base_url(); ?>datauser">
            <i class="fas fa-user"></i> <span>Data User</span>
          </a>
        </li>
      <?php endif ?>
      <!-- endif -->
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="<?= base_url(); ?>auth/logout" class="btn btn-primary btn-lg btn-block btn-icon-split text-white">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </div>
  </aside>
</div>