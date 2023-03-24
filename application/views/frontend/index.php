<?php $this->load->view('frontend/header'); ?>
<style>
    .jumbotron {
        background-color: #ffffff;
    }

    .bg-gray {
        padding-top: 40px;
        background-color: #e9ecef;
    }

    /* Use position: sticky to have it stick to the edge
 * and top, right, or left to choose which edge to stick to: */

    thead tr th {
        position: -webkit-sticky;
        /* for Safari */
        position: sticky;
        top: 0;
    }

    tbody th {
        position: -webkit-sticky;
        /* for Safari */
        position: sticky;
        left: 0;
    }


    /* To have the header in the first column stick to the left: */

    thead th:first-child {
        left: 0;
        z-index: 2;
    }


    /* Just to display it nicely: */

    thead th {
        background: #000;
        color: #FFF;
        /* Ensure this stays above the emulated border right in tbody th {}: */
        z-index: 2;
    }

    tbody th {
        background: #FFF;
        border-right: 1px solid #CCC;
        /* Browsers tend to drop borders on sticky elements, so we emulate the border-right using a box-shadow to ensure it stays: */
        box-shadow: 1px 0 0 0 #ccc;
    }

    table {
        border-collapse: collapse;
    }

    td,
    th {
        padding: 0.5em;
    }
</style>

<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container">

                <a class="navbar-brand" style="font-weight: bold;" href="<?= base_url() ?>">Kas RT 031</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <!-- <a class="nav-link" href="<?= base_url() ?>home">Login Admin</a> -->
                        </li>
                    </ul>
                    <!-- <form class="form-inline mt-2 mt-md-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form> -->
                    <div>
                        <a class="btn btn-primary" href="<?= base_url() ?>home">Login Admin</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main role="main">


        <!-- Marketing messaging and featurettes
      ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <section class="jumbotron text-center" style="margin-top: 100px;">
            <div class="container">
                <h1 class="jumbotron-heading">Selamat Datang!</h1>
                <p class="lead text-muted">Selamat datang di Aplikasi Manajemen Kas RT 031 / RW 13 Perum GCC Cikarang.</p>
                <p>
                    <a href="#iuran" class="btn btn-primary my-2">Get Started!</a>
                </p>
            </div>
        </section>
        <div class="bg-gray" id="iuran">
            <div class="container">

                <div class="row">
                    <div class="col-md-4">
                        <div class="card mt-2">
                            <h5 class="card-header">Total Kas Masuk</h5>
                            <div class="card-body">
                                <h5 class="card-title text-success">
                                    Rp. <?= number_format($total_kas_masuk); ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mt-2">
                            <h5 class="card-header">Total Kas Keluar</h5>
                            <div class="card-body">
                                <h5 class="card-title text-danger">
                                    Rp. <?= number_format($total_kas_keluar); ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mt-2">
                            <h5 class="card-header">Sisa Saldo</h5>
                            <div class="card-body">
                                <h5 class="card-title text-secondary">
                                    Rp. <?= number_format($total_kas_masuk - $total_kas_keluar); ?>
                                </h5>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container">
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4><i>Data Iuran Warga</i> </h4>
                            <button onclick="print_iuran()" class="btn btn-secondary btn-sm">Print</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive tableku mt-2" id="iuran_warga" style="max-height: 400px;overflow: scroll;">
                            <table cellspacing="0" border="0" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th height="40" align="center" valign=middle>No</th>
                                        <th>Nama Warga</th>
                                        <?php foreach ($bulan as $key => $value) { ?>
                                            <th align="center"><b>
                                                    <?= $value ?>
                                                </b></th>
                                        <?php } ?>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <th><?= $no++; ?></th>
                                            <th class="classgroup" height="20" align="center" valign=middle>
                                                <?= $value['nama_warga'] ?>
                                            </th>
                                            <td <?= $value['01'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['01']) ?>
                                            </td>
                                            <td <?= $value['02'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['02']) ?>
                                            </td>
                                            <td <?= $value['03'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['03']) ?>
                                            </td>
                                            <td <?= $value['04'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['04']) ?>
                                            </td>
                                            <td <?= $value['05'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['05']) ?>
                                            </td>
                                            <td <?= $value['06'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['06']) ?>
                                            </td>
                                            <td <?= $value['07'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['07']) ?>
                                            </td>
                                            <td <?= $value['08'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['08']) ?>
                                            </td>
                                            <td <?= $value['09'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['09']) ?>
                                            </td>
                                            <td <?= $value['10'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['10']) ?>
                                            </td>
                                            <td <?= $value['11'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['11']) ?>
                                            </td>
                                            <td <?= $value['12'] == 0 ? ' style="background-color: #ffbfbf;"' : 'style="background-color: #bfffcb;"' ?>>
                                                <?= number_format($value['12']) ?>
                                            </td>
                                            <td>
                                                <?= number_format($value['01'] + $value['02'] + $value['03'] + $value['04'] + $value['05'] + $value['06'] + $value['07'] + $value['08'] + $value['09'] + $value['10'] + $value['11'] + $value['12']); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    <tr>
                                        <th>#</th>
                                        <th height="20" align="right" valign=middle><b>
                                                Total :
                                            </b>
                                        </th>
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
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <!-- <select name="tahun" id="tahun" class="form-control">
                                    <option value="<?= date('Y') - 3 ?>" <?= isset($_GET['q']) == (date('Y') - 3) ? 'selected' : '' ?>>Tahun <?= date('Y') - 3 ?></option>
                                    <option value="<?= date('Y') - 2 ?>" <?= isset($_GET['q']) == (date('Y') - 2) ? 'selected' : '' ?>>Tahun <?= date('Y') - 2 ?></option>
                                    <option value="<?= date('Y') - 1 ?>" <?= isset($_GET['q']) == (date('Y') - 1) ? 'selected' : '' ?>>Tahun <?= date('Y') - 1 ?></option>
                                    <option value="<?= date('Y') ?>" <?= isset($_GET['q']) == date('Y') ? 'selected' : '' ?>>Tahun <?= date('Y') ?></option>
                                </select> -->
                                </div>
                            </div>
                            <input type="text" class="form-control tanggal" hidden>
                            <div class="col-md-4">
                                <!-- <button class="btn btn-primary btn-lg">Download</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4> <i>Pemasukan & Pengeluaran</i> </h4>
                            <button onclick="print_pemasukan()" class="btn btn-secondary btn-sm">Print</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-2" id="pemasukan">
                            <table class="table table-striped table-bordered">
                                <colgroup width="106"></colgroup>
                                <colgroup span="7" width="64"></colgroup>
                                <tr>
                                    <td rowspan="2" height="40" align="center" valign=middle>No</td>
                                    <td class="classgroup" colspan=2 rowspan=2 height="40" align="center" valign=middle><b>
                                            Blok No
                                        </b></td>
                                    <td class="classgroup" colspan=12 align="center" valign=middle><b>
                                            Pemasukan Bulanan Tahun <?= date('Y') ?>
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
                                $nopm = 1; ?>
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
                                        <td><?= $nopm++; ?></td>
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
                                    <td rowspan="2" height="40" align="center" valign=middle>No</td>
                                    <td class="classgroup" colspan=2 rowspan=2 height="40" align="center" valign=middle><b>
                                            Item Pengeluaran
                                        </b></td>
                                    <td class="classgroup" colspan=12 align="center" valign=middle><b>
                                            Pengeluaran Bulanan Tahun <?= date('Y') ?>
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
                                $nopen = 1; ?>
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
                                        <td><?=$nopen++;?></td>
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
            </div><!-- /.container -->
        </div>


        <!-- FOOTER -->
        <footer class="container">
            <p class="float-right"><a href="#">Back to top</a></p>
            <p>&copy; <?= date('Y'); ?> FahmiDev. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
    </main>
</body>
<?php $this->load->view('frontend/footer'); ?>