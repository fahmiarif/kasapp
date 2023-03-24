var table;
var csrf_test_name = "csrf_test_name";
var token = $("input[name=csrf_test_name]").val();
// ------------------- GET DATATABLE ------------------------------------------
$(document).ready(function () {
  table = $("#datadatatable").DataTable({
    processing: true,
    serverSide: true,
    order: [],

    ajax: {
      url: actionUrlGet,
      type: "POST",
      data: function (d) {
        d.csrf_test_name = token;
      },
    },
    searching: true,
    columnDefs: [
      {
        targets: [target],
        orderable: false,
      },
    ],
  });

  table.on("xhr.dt", function (e, settings, json, xhr) {
    token = json.csrf_test_name;
  });
});
// ------------------- RELOAD DATATABLE ------------------------------------------
function reload_tableset() {
  table.ajax.reload(null, false);
}

// ------------------- ADD DATA ------------------------------------------
function add() {
  save_method = "add";
  $("#form")[0].reset();
  $(".form-control").removeClass("is-invalid");
  $(".help-block").empty();
  $("#modal_form").modal("show");
  $(".modal-title").text("Add Data");
  $("#btnSave").text("Save");
  $("#btnSave").attr("disabled", false);
  if (actionUrlAdd == "datadirectpacking/ajax_add") {
    $.ajax({
      url: "datadirectpacking/ajax_getkode/",
      type: "GET",
      dataType: "JSON",
      success: function (data) {
        $('[name="no_palet"]').val(data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert("Error get data from ajax");
      },
    });
  }
}

// ------------------- SAVE DATA ------------------------------------------
$("#form").submit(function (e) {
  $("#btnSave").attr("disabled", true);
  var url;
  if (save_method == "add") {
    url = actionUrlAdd;
  } else {
    url = actionUrlupdate;
  }
  e.preventDefault();
  $.ajax({
    url: url,
    type: "post",
    data: new FormData(this),
    dataType: "JSON",
    processData: false,
    contentType: false,
    cache: false,
    async: false,
    success: function (data) {
      if (data.status == true) {
        $("#modal_form").modal("hide");
        reload_tableset();
        if (save_method == "add") {
          swal("Good Job", "Successfully added data", "success");
        } else {
          showNotification();
        }
      } else {
        if (data.status == "double") {
          $("#modal_form").modal("hide");
          swal("Proses Gagal", data.message, "error");
        } else {
          for (var i = 0; i < data.inputerror.length; i++) {
            $("#btnSave").attr("disabled", false);
            $('[name="' + data.inputerror[i] + '"]').addClass("is-invalid");
            $('[name="' + data.inputerror[i] + '"]')
              .next()
              .text(data.error_string[i]);
              // call ulang yg punya class select2
            $(".select2").select2();
          }
        }
      }
    },
  });
});
// ------------------- NOTIF ------------------------------------------
function showNotification() {
  iziToast.success({
    title: "Congrulations!",
    message: "Success update your data",
    position: "topRight",
  });
}

// ------------------- DEL DATA ------------------------------------------
function destroy(id) {
  swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this imaginary file!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: actionUrlDelete + id,
        data: { csrf_test_name: token },
        type: "POST",
        dataType: "JSON",
        success: function (data) {
          reload_tableset();
          showNotification();
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert("Error deleting data");
        },
      });

      swal("Poof! Your imaginary file has been deleted!", {
        icon: "success",
      });
    } else {
      swal("Your imaginary file is safe!");
    }
  });
}
