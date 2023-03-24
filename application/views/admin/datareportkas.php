<?php $this->load->view('admin/_partials/header'); ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Report Kas RT</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
        <div class="breadcrumb-item">Data Kas</div>
      </div>
    </div>

    <div class="section-body">
      <button class="btn btn-primary mb-3" onclick="add()"><i class="fa fa-plus"></i> Add Data</button>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>All Data Direct Packing </h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="datadatatable" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th width="80px">Tanggal</th>
                      <th>Nama</th>
                      <th>No Mesin</th>
                      <th>Shift</th>
                      <th width="50px">Item</th>
                      <th>Customer</th>
                      <th>No Palet</th>
                      <th width="90px">Qty (set)</th>
                      <th>No Dies L-Inner</th>
                      <th>No Dies R-Outer</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('admin/_partials/footer'); ?>

<!-- Template JS File -->
<script>
  var save_method;
  var target = 11;
  var searching = false;
  var actionUrlGet = "datadirectpacking/ajax_list";
</script>
<script src="<?php echo base_url(); ?>assets/js/crud.js"></script>