<?php $this->load->view('admin/_partials/header'); ?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data warga</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
        <div class="breadcrumb-item">Data warga</div>
      </div>
    </div>
    <div class="section-body">
      <button class="btn btn-primary mb-3" onclick="add()"><i class="fa fa-plus"></i> Add Data</button>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data warga </h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="datadatatable">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Nama warga</th>
                      <th>Blok</th>
                      <th>Alamat</th>
                      <th>Status</th>
                      <!-- <th>Created by</th> -->
                      <th>Created date</th>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal_form">
  <div class="modal-dialog" role="document">
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
              <label for="namaitem">Nama warga</label>
              <input type="text" class="form-control" name="nama_warga" placeholder="Nama warga">
              <div class="invalid-feedback"><span class="help-block"></span></div>
              <input name="id_user" class="form-control" type="text" hidden>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="namaitem">Blok</label>
              <select name="blok" class="form-control" id="">
                <option value="">--Pilih Blok--</option>
                <?php foreach ($bloks as $key => $value) { ?>
                  <option value="<?= $value['id'] ?>"><?= $value['nama_blok'] ?></option>
                <?php } ?>
              </select>
              <div class="invalid-feedback"><span class="help-block"></span></div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="namaitem">Alamat</label>
              <input type="text" class="form-control" name="alamat" placeholder="Alamat">
              <div class="invalid-feedback"><span class="help-block"></span></div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputState">Status</label>
              <select name="status" class="form-control">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
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

<?php $this->load->view('admin/_partials/footer'); ?>

<script>
  var save_method;
  var target = 4;
  var searching = true;
  var actionUrlGet = "datawarga/ajax_list";
  var actionUrlAdd = "datawarga/ajax_add";
  var actionUrlEdit = "datawarga/ajax_edit/";
  var actionUrlupdate = "datawarga/ajax_update";
  var actionUrlDelete = "datawarga/ajax_delete/";

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
        $('[name="id"]').val(data.id);
        $('[name="nama_warga"]').val(data.nama_warga);
        $('[name="blok"]').val(data.blok_id);
        $('[name="alamat"]').val(data.alamat);
        $('[name="status"]').val(data.status);

        $('#modal_form').modal('show');
        $('.modal-title').text('Edit Data');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }
</script>
<script src="<?php echo base_url(); ?>assets/js/crud.js"></script>