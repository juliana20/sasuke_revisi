$(document).ready(function(){

    $('body').on('click','#submitekstra',function(){
        var formEkstra=$("#tambahEkstra");
        var formDataEkstra=formEkstra.serialize();
       ;
        $.ajax({
            url:'ekstra',
            type:'POST',
            data:formDataEkstra,
            success:function(data){
                console.log(data);
                if (data.errors) {
                    $('#jurusan-error').html(data.errors.nama[0]);
                    $('#frmgrpjurusan').addClass('has-error')

                }else if(data.success){
                    $('#frmgrpjurusan').removeClass('has-error')
                    $('#jurusan-error').html("");
                    $('#modalTambahJurusan').modal('hide');
                    swal({
                        title: "Success!",
                        text: "Data Berhasil Ditambah!",
                        type: "success",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $('#tambahEkstra').trigger('reset');
                }

            }
        });
    });



   $('#modalEkstra').on('shown.bs.modal', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#id').val(id);
    });

    $('#bangsat').on('shown.bs.modal', function (e) {
        alert("tes");
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#detailEkstraSiswa').load('ekstra/'+id+'/detailEkstraSiswa');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

   
});

