<?php $this->load->view('admin/_partials/header'); ?>

<link rel="stylesheet" href="assets/modules/bootstrap-daterangepicker/daterangepicker.css">
<style>


</style>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Tunggakan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
        <div class="breadcrumb-item">Data Tunggakan Iuran</div>
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Filter Tunggakan</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <select name="tahun" id="tahun" class="form-control">
                      <option value="<?= date('Y') - 3 ?>" <?= $_GET['q'] == (date('Y') - 3) ? 'selected' : '' ?>>Tahun <?= date('Y') - 3 ?></option>
                      <option value="<?= date('Y') - 2 ?>" <?= $_GET['q'] == (date('Y') - 2) ? 'selected' : '' ?>>Tahun <?= date('Y') - 2 ?></option>
                      <option value="<?= date('Y') - 1 ?>" <?= $_GET['q'] == (date('Y') - 1) ? 'selected' : '' ?>>Tahun <?= date('Y') - 1 ?></option>
                      <option value="<?= date('Y') ?>" <?= $_GET['q'] == date('Y') ? 'selected' : '' ?>>Tahun <?= date('Y') ?></option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <select name="blok" id="blok" class="form-control">
                      <?php foreach ($blok as $key => $value) { ?>
                        <option value="<?= $value['id'] ?>" <?= $_GET['b'] == $value['id'] ? 'selected' : '' ?>><?= $value['nama_blok'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <input type="text" class="form-control tanggal" hidden>
                <!-- <div class="col-md-4">
                  <button class="btn btn-primary btn-lg">Download</button>
                </div> -->
              </div>
              <div class="table-responsive mt-2">
                <table class="table table-striped table-bordered">
                  <colgroup width="106"></colgroup>
                  <colgroup span="7" width="64"></colgroup>
                  <tr>
                    <td rowspan=2 height="40" align="center" valign=middle>No</td>
                    <td class="classgroup" colspan=2 rowspan=2 height="40" align="center" valign=middle><b>
                        Nama Warga
                      </b></td>
                    <td class="classgroup" colspan=12 align="center" valign=middle><b>
                        Data Iuran
                      </b></td>
                    <td class="classgroup" rowspan=2 align="center" valign=middle><b>
                        Total
                      </b></td>
                  </tr>
                  <tr>
                    <?php foreach ($bulan as $key => $value) { ?>
                      <td class="classgroup" align="center" valign=middle><b>
                          <?= $value ?>
                        </b></td>
                    <?php } ?>
                  </tr>
                  <?php $total01 = 0;
                  $total02 = 0;
                  $total03 = 0;
                  $total04 = 0;
                  $total05 = 0;
                  $total06 = 0;
                  $total07 = 0;
                  $total08 = 0;
                  $total09 = 0;
                  $total10 = 0;
                  $total11 = 0;
                  $total12 = 0;
                  $totalsemua = 0;
                  $no = 1; ?>
                  <?php foreach ($tunggakan as $key => $value) { ?>
                    <?php
                    $total01 += $value['01'];
                    $total02 += $value['02'];
                    $total03 += $value['03'];
                    $total04 += $value['04'];
                    $total05 += $value['05'];
                    $total06 += $value['06'];
                    $total07 += $value['07'];
                    $total08 += $value['08'];
                    $total09 += $value['09'];
                    $total10 += $value['10'];
                    $total11 += $value['11'];
                    $total12 += $value['12'];
                    $totalsemua += $value['01'] + $value['02'] + $value['03'] + $value['04'] + $value['05'] + $value['06'] + $value['07'] + $value['08'] + $value['09'] + $value['10'] + $value['11'] + $value['12']; ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td class="classgroup" colspan=2 height="20" align="center" valign=middle>
                        <?= $value['nama_warga'] ?>
                      </td>
                      <td><?= number_format($value['01']) ?>
                      </td>
                      <td>
                        <?= number_format($value['02']) ?>
                      </td>
                      <td>
                        <?= number_format($value['03']) ?>
                      </td>
                      <td>
                        <?= number_format($value['04']) ?>
                      </td>
                      <td>
                        <?= number_format($value['05']) ?>
                      </td>
                      <td>
                        <?= number_format($value['06']) ?>
                      </td>
                      <td>
                        <?= number_format($value['07']) ?>
                      </td>
                      <td>
                        <?= number_format($value['08']) ?>
                      </td>
                      <td>
                        <?= number_format($value['09']) ?>
                      </td>
                      <td>
                        <?= number_format($value['10']) ?>
                      </td>
                      <td>
                        <?= number_format($value['11']) ?>
                      </td>
                      <td>
                        <?= number_format($value['12']) ?>
                      </td>
                      <td>
                        <?= number_format($value['01'] + $value['02'] + $value['03'] + $value['04'] + $value['05'] + $value['06'] + $value['07'] + $value['08'] + $value['09'] + $value['10'] + $value['11'] + $value['12']); ?>
                      </td>
                    </tr>
                  <?php } ?>

                  <tr>
                    <td>#</td>
                    <td class="classgroup" colspan=2 height="20" align="right" valign=middle><b>
                        Total :
                      </b></td>
                    <td><b>
                        <?= number_format($total01) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total02) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total03) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total04) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total05) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total06) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total07) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total08) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total09) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total10) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total11) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total12) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($totalsemua) ?>
                      </b></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<input type="hidden" value="<?= $this->security->get_csrf_hash() ?>" name="csrf_test_name">

<?php $this->load->view('admin/_partials/footer'); ?>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
  $('#tahun').change(function() {
    var blok = $('#blok').val();
    window.location = 'tunggakan?q=' + $(this).val() + '&b=' + blok;
  })
  $('#blok').change(function() {
    var tahun = $('#tahun').val();
    window.location = 'tunggakan?q=' + tahun + '&b=' + $(this).val();
  })
</script>