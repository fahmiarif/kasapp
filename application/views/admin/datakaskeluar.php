<?php $this->load->view('admin/_partials/header'); ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Kas keluar </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
        <div class="breadcrumb-item">Data Kas keluar</div>
      </div>
    </div>

    <div class="section-body">
      <button class="btn btn-primary mb-3" onclick="add()"><i class="fa fa-plus"></i> Add Data</button>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>All Data Kas keluar </h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="datadatatable" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th width="80px">Tanggal</th>
                      <!-- <th>Blok</th> -->
                      <!-- <th>Warga</th> -->
                      <th>Jumlah</th>
                      <th>Item</th>
                      <th>Keterangan</th>
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

<div class="modal fade" role="dialog" id="modal_form">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php $attributes = array('class' => 'form-horizontal', 'id' => 'form');
        echo form_open('', $attributes); ?>
        <input type="hidden" value="" name="id" />
        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputPassword4">Tanggal *</label>
              <input type="date" value="<?= date('Y-m-d'); ?>" name="tanggal" class="form-control" placeholder="Tanggal">
              <div class="invalid-feedback"><span class="help-block"></span></div>
            </div>
            <div class="form-group col-md-12">
              <label for="inputPassword4">Item *</label>
              <select name="item" class="form-control select2" style="width: 100%;">
                <option value="">--Pilih item--</option>
                <?php foreach ($items as $key => $value) : ?>
                  <option value="<?= $value['id'] ?>"><?= $value['nama_item'] ?></option>
                <?php endforeach ?>
              </select>
              <div class="invalid-feedback"><span class="help-block"></span></div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputState">Jumlah (Rp)*</label>
              <input type="number" class="form-control" name="jumlah" autocomplete="off" placeholder="input jumlah...">
              <div class="invalid-feedback"><span class="help-block"></span></div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputState">Keterangan </label>
              <input type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="(opsional)">
              <div class="invalid-feedback"><span class="help-block"></span></div>
            </div>
          </div>

        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="btnSave" type="submit" class="btn btn-primary">Save changes</button>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_detail" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Detail Data</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body form">
        <div class="form-body">
          <table class="table">
            <tr>
              <td>Tanggal </td>
              <td>:</td>
              <td id="tanggal"></td>
            </tr>
            <tr>
              <td>Item </td>
              <td>:</td>
              <td id="item"></td>
            </tr>
            <tr>
              <td>Jumlah </td>
              <td>:</td>
              <td id="jumlah"></td>
            </tr>
            <tr>
              <td>Keterangan </td>
              <td>:</td>
              <td id="keterangan"></td>
            </tr>
            <tr>
              <td>Dibuat </td>
              <td>:</td>
              <td id="created_by"></td>
            </tr>
            <tr>
              <td>Terakhir diubah </td>
              <td>:</td>
              <td id="terakhir_diubah"></td>
            </tr>
          </table>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->load->view('admin/_partials/footer'); ?>

<!-- Template JS File -->
<script>
  var save_method;
  var target = 5;
  var searching = false;
  var actionUrlGet = "datakaskeluar/ajax_list";
  var actionUrlAdd = "datakaskeluar/ajax_add";
  var actionUrlEdit = "datakaskeluar/ajax_edit/";
  var actionUrlupdate = "datakaskeluar/ajax_update";
  var actionUrlDelete = "datakaskeluar/ajax_delete/";
  // ------------------- EDIT DATA ------------------------------------------
  function edit(id) {
    save_method = 'update';
    $('#btnSave').text('Save changes');
    $('#btnSave').attr('disabled', false);
    $('#form')[0].reset();
    $('.form-control').removeClass('is-invalid');
    $('.help-block').empty();

    $.ajax({
      url: actionUrlEdit + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        $('[name="id"]').val(data.id_data);
        $('[name="tanggal"]').val(data.created_date);
        $('[name="jumlah"]').val(data.jumlah);
        $('[name="item"]').val(data.item_id);
        $('[name="keterangan"]').val(data.keterangan);

        $('#modal_form').modal('show');
        $('.modal-title').text('Edit Data');
        $(".select2").select2();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }
  // ------------------ DETAIL ----------------------------------------------
  function detail(id) {
    $.ajax({
      url: "datakaskeluar/getdetail/" + id,
      method: "GET",
      async: true,
      dataType: 'json',
      success: function(data) {

        $('#tanggal').html(data.created_date);
        $('#blok').html(data.nama_blok);
        $('#jumlah').html(data.jumlah);
        $('#item').html(data.nama_item);
        $('#created_by').html(data.dibuat_oleh);
        $('#keterangan').html(data.keterangan);
        $('#terakhir_diubah').html(data.terakhir_diubah);
        $('#modal_form_detail').modal('show');
        $('.modal-title').text('Detail Data');

      }
    });
  }
</script>
<script src="<?php echo base_url(); ?>assets/js/crud.js"></script>