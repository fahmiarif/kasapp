
    $.ajax({
        url : "kwitansinotaris/getAll",
        method : "POST",
        async : true,
        dataType : 'json',
        success: function(data){
            $('select[name="notaris"]').empty();
            
            $.each(data, function(key, value) {
                $('select[name="notaris"]').append('<option value="'+ value.no + ',' + value.proses + ',' + value.id_client +'" selected>'+ value.nama_proses +'. '+ value.nama_client +'</option>');
            });
            return false;
        }
    }); 