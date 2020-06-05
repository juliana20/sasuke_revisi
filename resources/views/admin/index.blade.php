@extends('layouts.template')

 <?php 
 $title="Admin |";
 ?>

@section('content')
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">DATA ADMIN</h3>

              <div class="box-tools pull-right">
              </div>
            </div>    
<div class="row kotak">
<div align="left">
@if(Session::get('user_tipe')=='Kepala Sekolah')
@else
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahAdmin" title="Tambah Data Admin">Tambah Data
</button>
@endif
</div><br>
<table border="1" width="100%" class="table table-bordered" id="dataAdmin">
	<thead>
		<tr>
			<th width="5%">No</th>
      <th>Foto</th>
      <th>ID</th>
      <th>Nama Pegawai</th>
      <th>Username</th>
     <!--  <th>Password</th> -->
      <th>Jabatan</th>
      <th>Status</th>
      @if(Session::get('user_tipe')=='Kepala Sekolah')
      @else
			<th>Aksi</th>
      @endif

		</tr>
	</thead>
	<tbody>
    <?php $no=1; ?>
    @foreach($admin as $p)
    <tr>
      <td>{{$no++}} </td>
      <td><img src="{{url('public/image/foto_staff/'.$p->foto)}}" width="40px" height="auto"></td>
      <td>{{$p->user_id}}</td>
      <td>{{$p->nama_pegawai}}</td>
      <td>{{$p->username}}</td>
 <!--      <td>{{$p->password}}</td> -->
      <td>{{$p->jabatan}}</td>
      <td><span @if($p->status=="Aktif") class="statusAktif" @else class="statusTidakAktif" @endif>{{$p->status}}</span></td>
      @if(Session::get('user_tipe')=='Kepala Sekolah')
      @else
      <td>
        
            <a title="Edit Data Admin" data-toggle="modal" data-target="#modalEditAdmin" data-id="{!! $p->id!!}" ><span class="btn btn-warning  btn-sm"><span class="fa fa-edit"></span></span></a>
      </td>
      @endif
    </tr>
    @endforeach
	
</tbody>

</table>
</div>



<!-- MODAL TAMBAH ADMIN -->
<div class="modal fade" id="modalTambahAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" align="center"><strong>FORM TAMBAH DATA ADMIN</strong></h5>
      </div>
      <div class="modal-body">
        <form id="tambahadmin" method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
         {!! csrf_field() !!}
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">ID</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="txtIdAdmin" value="{{$newID}}" readonly="" required="">
          </div>
          </div>
         <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Nama Pegawai</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="txtNamaPegawai" value="{{ old('txtNamaPegawai') }}" placeholder="Nama Pegawai" autofocus autocomplete="off" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Jabatan</label>
            <div class="col-md-10">
            <select name="txtJabatan" class="form-control" required="">
              <option value="Admin">Admin</option>
            </select>
          </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Username</label>
            <div class="col-md-10">
            <input type="text" name="txtUsername" class="form-control" placeholder="Username" value="{{ old('txtUsername') }}" required="">
          </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Password</label>
            <div class="col-md-10">
            <input type="password" class="form-control" name="txtPassword" value="{{ old('txtPassword') }}" placeholder="Password" required="">
          </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Status</label>
            <div class="col-md-10">
            <select name="txtStatus" class="form-control" required="">
                <option value="">- Status -</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
          </div>
          </div>
          
          <div class="form-group">
          <label for="exampleInputFile" class="col-sm-2 control-label tengah2">Foto</label>
          <div class="col-md-10">
          <input type="file" name="txtFoto" id="profile-img" class="form-control">
          <img src="" id="profile-img-tag" style="width: 100px;" />
          </div>
          

        </div>
           
          
        <div class="modal-footer" style="border-top: 0px;">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
        </div>
      </form>
      
      </div>
       
     
    </div>
  </div>
</div>



<!-- MODAL EDIT ADMIN -->
<div class="modal fade" id="modalEditAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" align="center"><strong>FORM UBAH DATA ADMIN</strong></h5>
      </div>
      <div class="modal-body" id="loadEditAdmin">
        
      
      </div>

    </div>
  </div>
</div>

<!-- DATA TABLE TAMPIL DATA -->
<script type="text/javascript">
$(document).ready(function() {
    var t = $('#dataAdmin').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0,
        } ],
        "order": [[ 1, 'desc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );


</script> 

<!-- TAMPIL IMAGE SAAT TAMBAH -->
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
</script>
@endsection
 
