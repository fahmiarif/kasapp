<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="<?php echo base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register User</h4></div>

              <div class="card-body">
                <form action="#" id="form" class="form-horizontal">
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="nama_lengkap">Nama Lengkap</label>
                      <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" autofocus>
                      <div class="invalid-feedback"><span class="help-block"></span></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email">
                    <div class="invalid-feedback"><span class="help-block"></span></div>
                  </div>

                  <div class="row">
                    <div class="form-group col-12">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                      <div class="invalid-feedback"><span class="help-block"></span></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>
                </form>

                  <div class="form-group">
                    <button type="submit" id="btnSave" onclick="save_account()"  class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div><div class="mt-5 text-muted text-center">
                  Sudah punya akun ? <a href="<?php echo base_url(); ?>auth">Login</a>
                </div>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; <?=date('Y')?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php $this->load->view('admin/_partials/js'); ?>
<script type="text/javascript">
// ------------------- SAVE DATA ------------------------------------------
function save_account()
{ 
    $('#btnSave').text('Please wait...'); 
    $('#btnSave').attr('disabled',true); 
    $.ajax({
        url : "ajax_add",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) 
            {
                $('#btnSave').text('Register'); 
                $('#btnSave').attr('disabled',false); 
                alert('Akun berhasil didaftarkan, silahkan login');
                window.history.go(-1);
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('#btnSave').text('Register'); 
                    $('#btnSave').attr('disabled',false); 
                    $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
                }
            }
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Register'); 
            $('#btnSave').attr('disabled',false); 
 
        }
    });
}
</script>