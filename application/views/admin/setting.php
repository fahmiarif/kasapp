<?php $this->load->view('admin/_partials/header');?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Setting Aplikasi</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
              <div class="breadcrumb-item">Setting</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">All About General Settings</h2>
            <p class="section-lead">
              You can adjust all general settings here
            </p>

            <div id="output-status"></div>
            <div class="row">
<div class="card">
                  <div class="card-header">
                    <h4>2 Column</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-4">
                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active show" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="false">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#lisensi" role="tab" aria-controls="profile" aria-selected="false">Lisensi</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="true">Contact</a>
                          </li>
                        </ul>
                      </div>
                      <div class="col-12 col-sm-12 col-md-8">
                        <div class="tab-content no-padding" id="myTab2Content">
                          <div class="tab-pane fade" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                          </div>
                          <div class="tab-pane fade" id="lisensi" role="tabpanel" aria-labelledby="profile-tab4">
                              <div class="card profile-widget">
                                <div class="profile-widget-header">                     
                                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
                                    <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Posts</div>
                                        <div class="profile-widget-item-value">187</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Followers</div>
                                        <div class="profile-widget-item-value">6,8K</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Following</div>
                                        <div class="profile-widget-item-value">2,1K</div>
                                    </div>
                                    </div>
                                </div>
                                <div class="profile-widget-description">
                                    <div class="profile-widget-name">Fahmi Arif <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> Web Developer</div></div>
                                    <?=$lisensi['keterangan']?>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="font-weight-bold mb-2">Follow Ujang On</div>
                                            <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                                            <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                                            <i class="fab fa-twitter"></i>
                                            </a>
                                            <a href="#" class="btn btn-social-icon btn-github mr-1">
                                            <i class="fab fa-github"></i>
                                            </a>
                                            <a href="#" class="btn btn-social-icon btn-instagram">
                                            <i class="fab fa-instagram"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                          <div class="tab-pane fade active show" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                            Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                          </div>
                        </div>
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
                    <button type="submit" class="btn btn-primary">Save changes</button>
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