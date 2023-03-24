<?php $this->load->view('admin/_partials/header'); ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Kas Masuk </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
        <div class="breadcrumb-item">Data Kas Masuk</div>
      </div>
    </div>

    <div class="section-body">
      <button class="btn btn-primary mb-3" onclick="add()"><i class="fa fa-plus"></i> Add Data</button>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>All Data Kas Masuk </h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="datadatatable" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th width="80px">Tanggal</th>
                      <th>Blok</th>
                      <th>Warga</th>
                      <th>Jumlah</th>
                      <th>Tanggal diupdate</th>
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
              <label for="inputPassword4">Warga *</label>
              <select name="warga" class="form-control select2" style="width: 100%;">
                <option value="">--Pilih warga--</option>
                <?php foreach ($warga as $key => $value) : ?>
                  <option value="<?= $value['id'] ?>"><?= $value['nama_warga'] ?></option>
                <?php endforeach ?>
              </select>
              <div class="invalid-feedback"><span class="help-block"></span></div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputState">Jumlah (Rp)*</label>
              <input type="number" class="form-control" name="jumlah" value="45000" autocomplete="off" placeholder="input jumlah...">
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
              <td>Blok </td>
              <td>:</td>
              <td id="blok"></td>
            </tr>
            <tr>
              <td>Warga </td>
              <td>:</td>
              <td id="warga"></td>
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
  var actionUrlGet = "datakasmasuk/ajax_list";
  var actionUrlAdd = "datakasmasuk/ajax_add";
  var actionUrlEdit = "datakasmasuk/ajax_edit/";
  var actionUrlupdate = "datakasmasuk/ajax_update";
  var actionUrlDelete = "datakasmasuk/ajax_delete/";
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
        $('[name="warga"]').val(data.warga_id);
        $('[name="jumlah"]').val(data.jumlah);
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
      url: "datakasmasuk/getdetail/" + id,
      method: "GET",
      async: true,
      dataType: 'json',
      success: function(data) {

        $('#tanggal').html(data.created_date);
        $('#blok').html(data.nama_blok);
        $('#warga').html(data.nama_warga);
        $('#jumlah').html(data.jumlah);
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