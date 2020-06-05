$(document).ready(function(){
	    var tbTransaksiBarang = $('#tbtransaksibarang').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataTransaksiBarang',
        columns: [
            {data: 'id_barang', name: 'br.id_barang'},
            {data: 'nama_barang', name: 'br.nama_barang'},
            {data: 'harga_barang', name: 'br.harga_barang'},
            {data: 'jenis_barang', name: 'br.jenis_barang'},
            {data: 'action', name: 'br.id_barang',orderable: false, searchable: false}

        ],   
             
    });

	$(document).ready(function(){
      $('#item').select2();
    });

    $('#item').change(function(){
        console.log("beras");

    });



    var table = $('#tbtransaksibarang').DataTable();
    $('#tbtransaksibarang').on( 'click', 'tr', function () {
    console.log( table.row( this ).data());
     var data=table.row( this ).data();
     var kode = data.id_barang;
     var nama = data.nama_barang;
     var jenis_barang = data.jenis_barang;
     var harga = data.harga_barang;
     var total=harga*1;


    if($("#"+kode).length){
        var jumlah =$('#jumlah'+kode).val();
        jumlah=parseInt(jumlah)+1;
        $('#jumlah'+kode).val(jumlah);
        var total=harga*jumlah
        $('#total'+kode).val(total);
        var sum=0;
            $('.total').each(function(){
                sum +=parseInt($(this).val());
                    // console.log(sum);
                $('#grandTotal').text("Rp. "+sum);
                 $('#inputgrandtotal').val(sum);
            });
    }else{
          $('#tbitem > tbody:last-child' ).append('<tr><td>'+kode+'<input type="hidden" value="'+kode+'" id="'+kode+'" name="id_barang[]"></td><td>'+nama+'</td><td>'+jenis_barang+'</td><td><input class="form-control" name="harga[]"" value="'+harga+'" id="harga'+kode+'" readonly></td><td><input type="number" class="form-control inputjumlah" name="jumlah[]" id="jumlah'+kode+'" value="1" data-id="'+kode+'"></td><script></script></td><td><input type="text" readonly class="form-control total" id="total'+kode+'" value="'+total+'"></td><td><span class="btn btn-danger removebtn" data-id="'+kode+'"> Hapus</span></td></tr>');
                var sum=0;

                $('.total').each(function(){

                    sum +=parseInt($(this).val());
                    // console.log(sum);
                    $('#grandTotal').text("Rp. "+sum);
                    $('#inputgrandtotal').val(sum);

                });

                    var tbodyitem=$('#tbitem tbody');
                    if (tbodyitem.children().length!=0) {
                        $('#btnSimpanPenjualan').removeClass("disabled");   
                    }


    }




    } );

    $(document).on('keypress','.inputjumlah',function(e){
        if (e.keyCode==13) {
           var id=$(this).attr('data-id');
           var harga=$('#harga'+id).val();
           var jumlah=$('#jumlah'+id).val();
           var total=harga*jumlah;
           // alert(jumlah);
           $('#total'+id).val(total);

           var sum=0;

            $('.total').each(function(){

                sum +=parseInt($(this).val());
                // console.log(sum);
                $('#grandTotal').text("Rp. "+sum);
                $('#inputgrandtotal').val(sum);

            });
        };
    });


    var remove=$(document).on('click','.removebtn',function(){
        
        var sum=0;
        var id=$(this).attr('data-id');
        var total=$('#total'+id).val();
        var grandTotal=$("#grandTotal").text();
        var numberPattern = /\d+/g;
        var grandTotal=grandTotal.match( numberPattern )

        var remove=$(this).closest('tr').remove();
        if (remove) {
            grandTotal=parseInt(grandTotal)-parseInt(total);
            $('#inputgrandtotal').val(sum);
            $('#grandTotal').text("Rp. "+grandTotal);

        }

        var tbodyitem=$('#tbitem tbody');
        if (tbodyitem.children().length==0) {
            // tbodyitem.html("<tr><td colspan='6'>tes</td></tr>")
            $('#btnSimpanPenjualan').addClass("disabled");
        }
  
    });


    var tbodyitem=$('#tbitem tbody');

    if (tbodyitem.children().length==0) {
        $('#btnSimpanPenjualan').addClass("disabled");
    }



    

    

});