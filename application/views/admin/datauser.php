<?php $this->load->view('admin/_partials/header');?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data User</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
              <div class="breadcrumb-item">Data user</div>
            </div>
          </div>
          <div class="section-body">
            <button class="btn btn-primary mb-3" onclick="add()"><i class="fa fa-plus"></i> Add Data</button>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data User </h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="datadatatable">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
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
                          <label for="Username">Nama Lengkap</label>
                          <input type="text" class="form-control" name="username" placeholder="Username">
                          <div class="invalid-feedback"><span class="help-block"></span></div>
                          <input name="id_user" class="form-control" type="text" hidden>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword4">Email</label>
                          <input type="email" name="email" class="form-control" placeholder="Email">
                          <div class="invalid-feedback"><span class="help-block"></span></div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputCity">Level</label>
                          <select name="level" class="form-control" data-style="select-with-transition" data-size="7" required="">
                              <option value="1">Superadmin</option>
                              <option value="2">Administrator</option>
                              <option value="3">Staff</option>
                          </select>
                            <div class="invalid-feedback"><span class="help-block"></span></div>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputState">Status</label>
                          <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                          <div class="invalid-feedback"><span class="help-block"></span></div>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Password</label>
                          <input type="password" class="form-control" name="password" placeholder="Password">
                          <div class="invalid-feedback"><span class="help-block"></span></div>
                          <input name="date_created" type="hidden" class="form-control" value="<?= date('Y-m-d'); ?>">
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
    var target = 6; 
    var searching = true;
    var actionUrlGet = "datauser/ajax_list";
    var actionUrlAdd = "datauser/ajax_add";
    var actionUrlEdit = "datauser/ajax_edit/";
    var actionUrlupdate = "datauser/ajax_update";
    var actionUrlDelete = "datauser/ajax_delete/";

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
              $('[name="id_user"]').val(data.id_user);
              $('[name="username"]').val(data.nama_lengkap);
              $('[name="email"]').val(data.email);
              $('[name="level"]').val(data.id_role);
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