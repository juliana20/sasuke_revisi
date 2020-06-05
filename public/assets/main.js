$(document).ready(function(){
var get = [];
        location.search.replace('?','').split('&').forEach(function(val){
            split = val.split("=",2);
            get[split[0]] = split[1];
        });

    jQuery.each( [ "put", "delete" ], function( i, method ) {
        jQuery[ method ] = function( url, data, callback, type ) {
            if ( jQuery.isFunction( data ) ) {
                type = type || callback;
                callback = data;
                data = undefined;
            }

            return jQuery.ajax({
                url: url,
                type: method,
                dataType: type,
                data: data,
                success: callback
            });
        };
    });


    // -----------------Tampil admin--------------
    var tbAdmin = $('#tbAdmin').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataStaff',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'kd_pasien', name: 'ds.kd_pasien'},
            {data: 'nama_pasien', name: 'ds.nama_pasien'},
            {data: 'tanggal_lahir_pasien', name: 'ds.tanggal_lahir_pasien'},
            {data: 'jenis_kelamin_pasien', name: 'ds.jenis_kelamin_pasien'},
            {data: 'alergi', name: 'ds.alergi'},
            {data: 'alamat_pasien', name: 'ds.alamat_pasien'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false},
        ],

        rowCallback: function(row,data,iDisplayIndex){
            var api=this.api();
            var info=api.page.info();
            var page=info.page;
            var lenght=info.lenght;
            var index=(page*length+(iDisplayIndex+1));
            $('td:eq(0)',row).html(index);
        }      
             
    });


    // EDIT ADMIN
    $(document).on('shown.bs.modal','#modalEditAdmin', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadEditAdmin').load('admin/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formEditAdmin',function(){
        var formEditAdmin=$("#formEditAdmin");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'admin/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formEditAdmin').trigger('reset');
                    tbAdmin.api().ajax.reload(); 
                    $('#modalEditAdmin').modal('hide');
                    
                }

            
        });
        return false;
    });

    // EDIT WAKIL KEPALA
    $(document).on('shown.bs.modal','#modalEditWakilKepala', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadEditWakilKepala').load('wakil_kepala/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formEditWakilKepala',function(){
        var formEditWakilKepala=$("#formEditWakilKepala");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'wakil_kepala/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formEditWakilKepala').trigger('reset');
                    tbAdmin.api().ajax.reload(); 
                    $('#modalEditWakilKepala').modal('hide');
                    
                }

            
        });
        return false;
    });

     // EDIT KEPALA SEKOLAH
    $(document).on('shown.bs.modal','#modalEditKepalaSekolah', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadEditKepalaSekolah').load('kepala_sekolah/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formEditKepalaSekolah',function(){
        var formEditKepalaSekolah=$("#formEditKepalaSekolah");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'kepala_sekolah/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formEditKepalaSekolah').trigger('reset');
                    tbAdmin.api().ajax.reload(); 
                    $('#modalEditKepalaSekolah').modal('hide');
                    
                }

            
        });
        return false;
    });



     // -----------------TAMPIL KODE SURAT--------------
    var tbKodeSurat = $('#tbKodeSurat').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataMurid',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'nip', name: 'ds.nip'},
            {data: 'nama_pegawai', name: 'ds.nama_pegawai'},
            {data: 'no_hp_pegawai', name: 'ds.no_hp_pegawai'},
            {data: 'jabatan', name: 'ds.jabatan'},
            {data: 'alamat_pegawai', name: 'ds.alamat_pegawai'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false}
        ],   

        rowCallback: function(row,data,iDisplayIndex){
            var api=this.api();
            var info=api.page.info();
            var page=info.page;
            var lenght=info.lenght;
            var index=(page*length+(iDisplayIndex+1));
            $('td:eq(0)',row).html(index);
        }      
             
    });

    // EDIT KODE SURAT
    $(document).on('shown.bs.modal','#modalEditKodeSurat', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadEditKodeSurat').load('kode_surat/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formEditKodeSurat',function(){
        var formEditKodeSurat=$("#formEditKodeSurat");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'kode_surat/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formEditKodeSurat').trigger('reset');
                    tbKodeSurat.api().ajax.reload(); 
                    $('#modalEditKodeSurat').modal('hide');
                    
                }

            
        });
        return false;
    });




  // -----------------SURAT MASUK--------------
    var tbSuratMasuk = $('#tbSuratMasuk').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataPenyewa',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'nip', name: 'ds.nip'},
            {data: 'nama_pegawai', name: 'ds.nama_pegawai'},
            {data: 'no_hp_pegawai', name: 'ds.no_hp_pegawai'},
            {data: 'jabatan', name: 'ds.jabatan'},
            {data: 'alamat_pegawai', name: 'ds.alamat_pegawai'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false}
        ],   

        rowCallback: function(row,data,iDisplayIndex){
            var api=this.api();
            var info=api.page.info();
            var page=info.page;
            var lenght=info.lenght;
            var index=(page*length+(iDisplayIndex+1));
            $('td:eq(0)',row).html(index);
        }      
             
    });

    // KIRIM SURAT KE WAKA
    $(document).on('shown.bs.modal','#modalKirimSuratMasuk', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadKirimSuratMasuk').load('surat_masuk/kirim_waka/'+id);
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formKirimSuratMasuk',function(){
        var formKirimSuratMasuk=$("#formKirimSuratMasuk");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'surat_masuk/aksi_kirim_waka/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formKirimSuratMasuk').trigger('reset');
                    tbSuratMasuk.api().ajax.reload(); 
                    $('#modalKirimSuratMasuk').modal('hide');
                    
                }

            
        });
        return false;
    });


    // EDIT SURAT MASUK
    $(document).on('shown.bs.modal','#modalEditSuratMasuk', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadEditSuratMasuk').load('surat_masuk/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formEditSuratMasuk',function(){
        var formEditSuratMasuk=$("#formEditSuratMasuk");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'surat_masuk/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formEditSuratMasuk').trigger('reset');
                    tbSuratMasuk.api().ajax.reload(); 
                    $('#modalEditSuratMasuk').modal('hide');
                    
                }

            
        });
        return false;
    });

    // PERSETUJUAN DISPOSISI
    $(document).on('shown.bs.modal','#modalPersetujuanDisposisi', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadPersetujuanDisposisi').load('surat_masuk/persetujuan_disposisi/'+id);
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formPersetujuanDisposisi',function(){
        var formPersetujuanDisposisi=$("#formPersetujuanDisposisi");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'surat_masuk/aksi_persetujuan_disposisi/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formPersetujuanDisposisi').trigger('reset');
                    tbSuratMasuk.api().ajax.reload(); 
                    $('#modalPersetujuanDispoisi').modal('hide');
                    
                }

            
        });
        return false;
    });

     // BATAL DISPOSISI
    $(document).on('shown.bs.modal','#modalBatalDisposisi', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadBatalDisposisi').load('surat_masuk/batal_disposisi/'+id);
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formBatalisposisi',function(){
        var formBatalDisposisi=$("#formBatalDisposisi");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'surat_masuk/aksi_batal_disposisi/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formBatalDisposisi').trigger('reset');
                    tbSuratMasuk.api().ajax.reload(); 
                    $('#modalBatalDispoisi').modal('hide');
                    
                }

            
        });
        return false;
    });

     // SUDAH DIBACA
    $(document).on('shown.bs.modal','#modalSudahDibaca', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadSudahDibaca').load('surat_masuk/sudah_dibaca/'+id);
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formSudahDibaca',function(){
        var formSudahDibaca=$("#formSudahDibaca");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'surat_masuk/aksi_sudah_dibaca/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formSudahDibaca').trigger('reset');
                    tbSuratMasuk.api().ajax.reload(); 
                    $('#modalSudahDibaca').modal('hide');
                    
                }

            
        });
        return false;
    });



   // -----------------Tampil kelas--------------
    var tbKelas = $('#tbKelas').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataKelas',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'kelas_id', name: 'ds.kelas_id'},
            {data: 'nama_kelas', name: 'ds.nama_kelas'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false}
        ],   
             
    });

     // Edit kelas
    $(document).on('shown.bs.modal','#modalEditKelas', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadEditKelas').load('kelas/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formEditKelas',function(){
        var formEditKelas=$("#formEditKelas");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'kelas/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formEditKelas').trigger('reset');
                    tbKelas.api().ajax.reload(); 
                    $('#modalEditKelas').modal('hide');
                    
                }

            
        });
        return false;
    });

     // -----------------Tampil Jadwal Studio--------------
    var tbJadwalStudio = $('#tbJadwalStudio').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataMurid',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'nip', name: 'ds.nip'},
            {data: 'nama_pegawai', name: 'ds.nama_pegawai'},
            {data: 'no_hp_pegawai', name: 'ds.no_hp_pegawai'},
            {data: 'jabatan', name: 'ds.jabatan'},
            {data: 'alamat_pegawai', name: 'ds.alamat_pegawai'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false}
        ],   

        rowCallback: function(row,data,iDisplayIndex){
            var api=this.api();
            var info=api.page.info();
            var page=info.page;
            var lenght=info.lenght;
            var index=(page*length+(iDisplayIndex+1));
            $('td:eq(0)',row).html(index);
        }      
             
    });

    // Edit jadwal Studio
    $(document).on('shown.bs.modal','#modalEditJadwalStudio', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadEditJadwalStudio').load('jadwal_studio/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formEditJadwalStudio',function(){
        var formEditJadwalStudio=$("#formEditJadwalStudio");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'jadwal_studio/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formEditJadwalStudio').trigger('reset');
                    tbJadwalStudio.api().ajax.reload(); 
                    $('#modalEditJadwalStudio').modal('hide');
                    
                }

            
        });
        return false;
    });

     //BOOKING STUDIO
    $(document).on('shown.bs.modal','#modalTambahJadwalPenyewa', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadTambahJadwalPenyewa').load('jadwal_studio/'+id+'/booking_studio');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formTambahJadwalPenyewa',function(){
        var formEditJadwalPenyewa=$("#formTambahJadwalPenyewa");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'jadwal_studio/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formTambahJadwalPenyewa').trigger('reset');
                    tbJadwalStudio.api().ajax.reload(); 
                    $('#modalTambahJadwalPenyewa').modal('hide');
                    
                }

            
        });
        return false;
    });


// -----------------Tampil Jadwal kelas--------------
    var tbJadwalKelas = $('#tbJadwalKelas').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataJadwalKelas',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'kelas_id', name: 'ds.kelas_id'},
            {data: 'nama_kelas', name: 'ds.nama_kelas'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false}
        ],   
             
    });

     // Edit kelas
    $(document).on('shown.bs.modal','#modalEditJadwalKelas', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadEditJadwalKelas').load('jadwal_kelas/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formEditJadwalKelas',function(){
        var formEditJadwalKelas=$("#formEditJadwalKelas");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'jadwal_kelas/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formEditJadwalKelas').trigger('reset');
                    tbJadwalKelas.api().ajax.reload(); 
                    $('#modalEditJadwalKelas').modal('hide');
                    
                }

            
        });
        return false;
    });

    // -----------------Tampil Jadwal MURID--------------
    var tbJadwalMurid = $('#tbJadwalMurid').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataJadwalKelas',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'kelas_id', name: 'ds.kelas_id'},
            {data: 'nama_kelas', name: 'ds.nama_kelas'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false}
        ],   
             
    });

     // Edit jadwal Murid
    $(document).on('shown.bs.modal','#modalEditJadwalMurid', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadEditJadwalMurid').load('jadwal_murid/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formEditJadwalMurid',function(){
        var formEditJadwalMurid=$("#formEditJadwalMurid");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'jadwal_murid/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formEditJadwalMurid').trigger('reset');
                    tbJadwalMurid.api().ajax.reload(); 
                    $('#modalEditJadwalMurid').modal('hide');
                    
                }

            
        });
        return false;
    });

     // -----------------ABSENSI-------------
    var tbAbsensi = $('#tbabsensi').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataObatMasuk',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'kd_obatmasuk', name: 'ds.kd_obatmasuk'},
            {data: 'nama_obat', name: 'nama_obat'},
             { 
            "data": null, 
            render: function (data, type, row) {
                        var tgl = row.tgl_obatmasuk;
                        var jam = row.jam_obatmasuk
                        var tampil =  tgl+" | " + jam;
                        return tampil;
                    }
        },
            {data: 'jml_obatmasuk', name: 'ds.jml_obatmasuk'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false}
        ],

         rowCallback: function(row,data,iDisplayIndex){
            var api=this.api();
            var info=api.page.info();
            var page=info.page;
            var lenght=info.lenght;
            var index=(page*length+(iDisplayIndex+1));
            $('td:eq(0)',row).html(index);
        }      
             
    });

   // ABSENSI SISWA
    $(document).on('shown.bs.modal','#modalAbsenSiswa', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadAbsenSiswa').load('absensi_admin/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formAbsenSiswa',function(){
        var formAbsenSiswa=$("#formAbsenSiswa");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'absensi_admin/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formAbsenSiswa').trigger('reset');
                    tbAbsensi.api().ajax.reload(); 
                    $('#modalAbsenSiswa').modal('hide');
                    
                }

            
        });
        return false;
    });

    // ABSENSI ADMIN
    $(document).on('shown.bs.modal','#modalAbsenAdmin', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadAbsenAdmin').load('absensi/absen_admin/'+id);
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formAbsenAdmin',function(){
        var formAbsenAdmin=$("#formAbsenAdmin");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'absensi/absen_admin/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formAbsenAdmin').trigger('reset');
                    tbAbsensi.api().ajax.reload(); 
                    $('#modalAbsenAdmin').modal('hide');
                    
                }

            
        });
        return false;
    });

     // ABSENSI GURU
    $(document).on('shown.bs.modal','#modalAbsenGuru', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadAbsenGuru').load('absensi/absen_guru/'+id);
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formAbsenGuru',function(){
        var formAbsenGuru=$("#formAbsenGuru");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'absensi/absen_guru/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formAbsenGuru').trigger('reset');
                    tbAbsensi.api().ajax.reload(); 
                    $('#modalAbsenGuru').modal('hide');
                    
                }

            
        });
        return false;
    });



    // hapus Obat Masuk
     $(document).on('shown.bs.modal','#modalHapusObatMasuk', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadHapusObatMasuk').load('delete_obatmasuk/'+id);
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formHapusObatMasuk',function(){
        var formHapusObatMasuk=$("#formHapusObatMasuk");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
        
        $.ajax({
            url:'obat_masuk/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formHapusObatMasuk').trigger('reset');
                    tbObatMasuk.api().ajax.reload(); 
                    $('#modalHapusObatMasuk').modal('hide');
                    
                }

            
        });
        return false;
    });

      // -----------------Tampil Rekam Medis--------------
    var tbRekamMedis = $('#tbrekammedis').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataRekamMedis',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'kd_rekam_medis', name: 'ds.kd_rekam_medis'},
            { 
            "data": null, 
            render: function (data, type, row) {
                        var tgl = row.tgl_periksa;
                        var jam = row.jam_periksa
                        var tampil =  tgl+" | " + jam;
                        return tampil;
                    }
        },
            {data: 'nama_pegawai', name: 'nama_pegawai'},
            {data: 'nama_pasien', name: 'nama_pasien'},        
            {data: 'keluhan', name: 'ds.keluhan'},
            {data: 'diagnosa', name: 'ds.diagnosa'},
            {data: 'penyakit', name: 'ds.penyakit'},
            {data: 'tindakan', name: 'ds.tindakan'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false}
        ],  

        rowCallback: function(row,data,iDisplayIndex){
            var api=this.api();
            var info=api.page.info();
            var page=info.page;
            var lenght=info.lenght;
            var index=(page*length+(iDisplayIndex+1));
            $('td:eq(0)',row).html(index);
        }   
             
    });


// Detail Rekam Medis
    $(document).on('shown.bs.modal','#modalDetailRekamMedis', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadDetailRekamMedis').load('rekam_medis/'+id+'/show');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formDetailRekamMedis',function(){
        var formDetailRekamMedis=$("#formDetailRekamMedis");
        var data=formDetailRekamMedis.serialize();
        var id=$("#id").val();
       
        $.ajax({
            url:'rekam_medis/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formDetailRekamMedis').trigger('reset');
                    tbRekamMedis.api().ajax.reload(); 
                    $('#modalDetailRekamMedis').modal('hide');
                    
                }

            
        });
        return false;
    });
 

 // -----------------Tampil KUNJUNGAN--------------
    var tbKunjungan = $('#tbkunjungan').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataKunjungan',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'tgl_periksa', name: 'ds.tgl_periksa'},
            {data: 'nama_pasien', name: 'nama_pasien'},
            {data: 'keluhan', name: 'ds.keluhan'},      
            {data: 'unit_tujuan', name: 'ds.unit_tujuan'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false}

        ], 

        rowCallback: function(row,data,iDisplayIndex){
            var api=this.api();
            var info=api.page.info();
            var page=info.page;
            var lenght=info.lenght;
            var index=(page*length+(iDisplayIndex+1));
            $('td:eq(0)',row).html(index);
        }  
             
    });

    // Tambah Kunjungan
     $('body').on('submit','#tambahkunjungan',function(){
        var formTambahKunjungan=$("#tambahkunjungan");
        var data= new FormData($(this)[0]);
        $('.overlay').css('display','block');
        $.ajax({
            url:'kunjungan',
            type:'POST',
            data:data,
            success:function(data){
                    tbKunjungan.api().ajax.reload(); 
                    $('#tambahkunjungan').trigger('reset');
                    $('#modalTambahKunjungan').modal('hide');
                }

            
        });
        return false;

});


// Detail Kunjungan
    $(document).on('shown.bs.modal','#modalDetailKunjungan', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadDetailKunjungan').load('kunjungan/'+id+'/show');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formDetailKunjungan',function(){
        var formDetailKunjungan=$("#formDetailKunjungan");
        var data=formDetailKunjungan.serialize();
        var id=$("#id").val();
       
        $.ajax({
            url:'kunjungan/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formDetailKunjungan').trigger('reset');
                    tbKunjungan.api().ajax.reload(); 
                    $('#modalDetailKunjungan').modal('hide');
                    
                }

            
        });
        return false;
    });

   
 // edit Kunjungan
    $(document).on('shown.bs.modal','#modalEditKunjungan', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadEditKunjungan').load('kunjungan/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formEditKunjungan',function(){
        var formEditKunjungan=$("#formEditKunjungan");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'kunjungan/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formEditKunjungan').trigger('reset');
                    tbKunjungan.api().ajax.reload(); 
                    $('#modalEditKunjungan').modal('hide');
                    
                }

            
        });
        return false;
    });


// edit Kunjungan
    $(document).on('shown.bs.modal','#modalResepObat', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadResepObat').load('kunjungan/'+id+'/resep_obat');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formResepObat',function(){
        var formResepObat=$("#formResepObat");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'kunjungan/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formResepObat').trigger('reset');
                    tbKunjungan.api().ajax.reload(); 
                    $('#modalResepObat').modal('hide');
                    
                }

            
        });
        return false;
    });



 // -----------------Tampil Resep Obat--------------
    var tbResepObat = $('#tbbuatresepobat').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataResepObat',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'nama_obat', name: 'nama_obat'},
            {data: 'jml_obatkeluar', name: 'ds.jml_obatkeluar'},
            {data: 'cara_pakai', name: 'ds.cara_pakai'},      
            {data: 'keterangan', name: 'ds.keterangan'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false}
        ],   
             
    });

    // Tambah Resep Obat
     $('body').on('submit','#simpanresepobat',function(){
        var formSimpanResepObat=$("#simpanresepobat");
        var data= new FormData($(this)[0]);
        $('.overlay').css('display','block');
        $.ajax({
            url:'simpan_resep_obat',
            type:'POST',
            data:data,
            success:function(data){
                    tbResepObat.api().ajax.reload(); 
                    $('#simpanresepobat').trigger('reset');
                    $('#modalResepObat').modal('hide');
                }

            
        });
        return false;

});

      // -----------------Tampil Jenis Obat--------------
    var tbJenisObat = $('#tbjenisobat').dataTable( {
        processing: true,
        serverSide: true,
        language: {
            
            "processing": "<div class='preloader-wrapper small active'><div class='spinner-layer spinner-green-only'><div class='circle-clipper left'><div class='circle'></div></div><div class='gap-patch'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div>"
        },
        scrollX: true,
        responsive: true,
        autoWidth: false,
        ajax: 'getDataJenisObat',
        columns: [
            // {data: 'no', name: 'no'},
            {data: 'no', name: 'no'},
            {data: 'jenis_obat', name: 'ds.jenis_obat'},
            {data: 'alias', name: 'ds.alias'},
            {data: 'action', name: 'ds.id',orderable: false, searchable: false}
        ],   
             
    });


       // Tambah Jenis Obat
     $('body').on('submit','#tambahjenisobat',function(){
        var formTambahJenisObat=$("#tambahjenisobat");
        var data= new FormData($(this)[0]);
        $('.overlay').css('display','block');
        $.ajax({
            url:'jenis_obat',
            type:'POST',
            data:data,
            success:function(data){
                    tbJenisObat.api().ajax.reload(); 
                    $('#tambahjenisobat').trigger('reset');
                    $('#modalTambahJenisObat').modal('hide');
                }

            
        });
        return false;

});
      // Edit Obat
    $(document).on('shown.bs.modal','#modalEditJenisObat', function (e) {
        $('.overlay').css('display','block');
        var id = $(e.relatedTarget).data('id');
        $('#loadEditJenisObat').load('jenis_obat/'+id+'/edit');
        setTimeout(function() {
                $('.overlay').css('display','none');
        }, 1500);
    });

    $(document).on('submit','#formEditJenisObat',function(){
        var formEditJenisObat=$("#formEditJenisObat");
        var data= new FormData($(this)[0]);
        var id=$("#id").val();
       
        $.ajax({
            url:'jenis_obat/'+id,
            type:'POST',
            data:data,
            success:function(data){
                    $('#formEditJenisObat').trigger('reset');
                    tbJenisObat.api().ajax.reload(); 
                    $('#modalEditJenisObat').modal('hide');
                    
                }

            
        });
        return false;
    });


});

