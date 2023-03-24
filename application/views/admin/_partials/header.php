<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta http-equiv="refresh" content="" />
  <meta name="keywords" content="Aplikasi Manajemen kas RT" />
  <meta name="description" content="Aplikasi Manajemen kas RT" />
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/kasapp-favicon-32x32.png">
  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/kasapp-favicon-32x32.png">
  <title><?php echo $title; ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">

  <!-- Start GA -->
  <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script> -->
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<?php if (
  $this->uri->segment(1) == "home" ||
  $this->uri->segment(1) == "datauser" ||
  $this->uri->segment(1) == "databarang" ||
  $this->uri->segment(1) == "transaksi" ||
  $this->uri->segment(1) == "barangkeluar" ||
  $this->uri->segment(1) == "datakasmasuk" ||
  $this->uri->segment(1) == "datakaskeluar" ||
  $this->uri->segment(1) == "dataitem" ||
  $this->uri->segment(1) == "datacustomer" ||
  $this->uri->segment(1) == "datawarga" ||
  $this->uri->segment(1) == "datamesin" ||
  $this->uri->segment(1) == "setting" ||
  $this->uri->segment(1) == "tunggakan" ||
  $this->uri->segment(1) == "datablok" ||
  $this->uri->segment(1) == "reportkas"
) {

  $this->load->view('admin/_partials/layout');
  $this->load->view('admin/_partials/sidebar');
} elseif (
  $this->uri->segment(2) == "auth_login" &&
  $this->uri->segment(2) == "auth_forgot_password" &&
  $this->uri->segment(2) == "auth_register"
) {
}
?>