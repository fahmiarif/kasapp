<?php $this->load->view('admin/_partials/header');?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Item</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
              <div class="breadcrumb-item">Data item</div>
            </div>
          </div>
          <div class="section-body">
            <button class="btn btn-primary mb-3" onclick="add()"><i class="fa fa-plus"></i> Add Data</button>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data item </h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="datadatatable">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nama Item</th>
                            <th>Status</th>
                            <th>Created by</th>
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
                    echo form_open('',$attributes);?>
                    <input type="hidden" value="" name="id"/> 
                    <div class="card-body">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="namaitem">Nama Item</label>
                          <input type="text" class="form-control" name="nama_item" placeholder="Nama item">
                          <div class="invalid-feedback"><span class="help-block"></span></div>
                          <input name="id_user" class="form-control" type="text" hidden>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
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
                <?php echo form_close();?>
              </div>
            </div>
          </div>
        </div>

<?php $this->load->view('admin/_partials/footer');?>

  <script> 
    var save_method; 
    var target = 2; 
    var searching = true;
    var actionUrlGet = "dataitem/ajax_list";
    var actionUrlAdd = "dataitem/ajax_add";
    var actionUrlEdit = "dataitem/ajax_edit/";
    var actionUrlupdate = "dataitem/ajax_update";
    var actionUrlDelete = "dataitem/ajax_delete/";

    // ------------------- EDIT DATA ------------------------------------------
    function edit(id)
    {
        save_method = 'update';
        $('#btnSave').text('Save changes'); 
        $('#btnSave').attr('disabled',false); 
        $('#form')[0].reset(); 
        $('.form-control').removeClass('is-invalid'); 
        $('.help-block').empty(); 
     
        $.ajax({
            url : actionUrlEdit + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
              $('[name="id"]').val(data.id);
              $('[name="nama_item"]').val(data.nama_item);
              $('[name="status"]').val(data.status);

              $('#modal_form').modal('show'); 
              $('.modal-title').text('Edit Data'); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

  </script>
  <script src="<?php echo base_url(); ?>assets/js/crud.js"></script>