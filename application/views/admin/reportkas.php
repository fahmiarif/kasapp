<?php $this->load->view('admin/_partials/header'); ?>

<link rel="stylesheet" href="assets/modules/bootstrap-daterangepicker/daterangepicker.css">
<style>


</style>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Report Kas RT</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
        <div class="breadcrumb-item">Data Report</div>
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Filter berdasarkan tahun</h4>
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
                <input type="text" class="form-control tanggal" hidden>
                <div class="col-md-4">
                  <button class="btn btn-primary btn-lg">Download</button>
                </div>
              </div>
              <div class="table-responsive mt-2">
                <table class="table table-striped table-bordered">
                  <colgroup width="106"></colgroup>
                  <colgroup span="7" width="64"></colgroup>
                  <tr>
                    <td rowspan=2 height="40" align="center" valign=middle>No</td>
                    <td class="classgroup" colspan=2 rowspan=2 height="40" align="center" valign=middle><b>
                        Blok No
                      </b></td>
                    <td class="classgroup" colspan=12 align="center" valign=middle><b>
                        Pemasukan Bulanan
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
                  <?php foreach ($pemasukan as $key => $value) { ?>
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
                        <?= $value['nama_blok'] ?>
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
                  <tr>
                    <td>

                    </td>
                  </tr>
                  <tr>
                    <td rowspan=2 height="40" align="center" valign=middle>No</td>
                    <td class="classgroup" colspan=2 rowspan=2 height="40" align="center" valign=middle><b>
                        Item Pengeluaran
                      </b></td>
                    <td class="classgroup" colspan=12 align="center" valign=middle><b>
                        Pengeluaran Bulanan
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
                  </tr><?php $total01_pengeluaran = 0;
                        $total02_pengeluaran = 0;
                        $total03_pengeluaran = 0;
                        $total04_pengeluaran = 0;
                        $total05_pengeluaran = 0;
                        $total06_pengeluaran = 0;
                        $total07_pengeluaran = 0;
                        $total08_pengeluaran = 0;
                        $total09_pengeluaran = 0;
                        $total10_pengeluaran = 0;
                        $total11_pengeluaran = 0;
                        $total12_pengeluaran = 0;
                        $totalsemua_pengeluaran = 0;
                        $nop = 1; ?>
                  <?php foreach ($pengeluaran as $key => $value) { ?>
                    <?php
                    $total01_pengeluaran += $value['01'];
                    $total02_pengeluaran += $value['02'];
                    $total03_pengeluaran += $value['03'];
                    $total04_pengeluaran += $value['04'];
                    $total05_pengeluaran += $value['05'];
                    $total06_pengeluaran += $value['06'];
                    $total07_pengeluaran += $value['07'];
                    $total08_pengeluaran += $value['08'];
                    $total09_pengeluaran += $value['09'];
                    $total10_pengeluaran += $value['10'];
                    $total11_pengeluaran += $value['11'];
                    $total12_pengeluaran += $value['12'];
                    $totalsemua_pengeluaran += $value['01'] + $value['02'] + $value['03'] + $value['04'] + $value['05'] + $value['06'] + $value['07'] + $value['08'] + $value['09'] + $value['10'] + $value['11'] + $value['12']; ?>
                    <tr>
                      <td><?= $nop++; ?></td>
                      <td class="classgroup" colspan=2 height="20" align="center" valign=middle>
                        <?= $value['nama_item'] ?>
                      </td>
                      <td>
                        <?= number_format($value['01']) ?>
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
                        <?= number_format($total01_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total02_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total03_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total04_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total05_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total06_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total07_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total08_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total09_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total10_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total11_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total12_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($totalsemua_pengeluaran) ?>
                      </b></td>
                  </tr>
                  <tr>
                    <td>#</td>
                    <td class="classgroup3" colspan=2 height="21" align="right" valign=bottom><b>
                        Saldo akhir :
                      </b></td>
                    <td class="classgroup3" align="right" valign=middle sdval="123000" sdnum="1033;"><b>
                        <?= number_format($total01 - $total01_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total02 - $total02_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total03 - $total03_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total04 - $total04_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total05 - $total05_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total06 - $total06_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total07 - $total07_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total08 - $total08_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total09 - $total09_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total10 - $total10_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total11 - $total11_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($total12 - $total12_pengeluaran) ?>
                      </b></td>
                    <td><b>
                        <?= number_format($totalsemua - $totalsemua_pengeluaran) ?>
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

    window.location = 'reportkas?q=' + $(this).val();
  })
  $('.daterange-btn').daterangepicker({
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate: moment()
  }, function(start, end) {
    $('.tanggal').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    $('.tanggal').val(start.format('YYYY-MM-DD') + ' ~ ' + end.format('YYYY-MM-DD'))
  });

  function printlapnotakta() {
    var date_start = $('#date_start').val();
    var date_end = $('#date_end').val();
    var subjek = $('#subjek').val();
    var pengurusan = $('#pengurusan').val();
    var status = $('#status').val();

    window.open("printlaporannotarisakta/" + date_start + "/" + date_end + "/" + subjek + "/" + pengurusan + "/" + status, '_blank');

  }
</script>