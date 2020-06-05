@extends('layouts.template')

 <?php 
 $title="Kode Surat | ";
 ?>

@section('content')
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">KODE SURAT</h3>

              <div class="box-tools pull-right">
              </div>
            </div>   
<div class="row kotak">
 
<div align="left">
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahKodeSurat">
  Tambah Data
</button>
</div><br>

<table border="1" width="100%" class="table table-bordered table-hover" id="dataKodeSurat">
	<thead>
		<tr>
			<th width="5%">No</th>
      <th>ID</th>
      <th>Kode</th>
      <th>Keterangan</th>
      <th>Aksi</th>
		</tr>
	</thead>
<tbody>
       <?php $no=1; ?>
    @foreach($kodeSurat as $p)
    <tr>
      <td>{{$no++}} </td>
      <td>{{$p->kode_id}}</td>
      <td>{{$p->kode_surat}}</td>
      <td>{{$p->keterangan}}</td>
      <td>
        
            <a title="Edit Data Kode Surat" data-toggle="modal" data-target="#modalEditKodeSurat" data-id="{!! $p->id!!}" ><span class="btn btn-warning  btn-sm"><span class="fa fa-edit"></span></span></a>
      </td>
    </tr>
    @endforeach
  
</tbody>

</table>
</div>


<!-- MODAL TAMBAH KODE SURAT -->
<div class="modal fade" id="modalTambahKodeSurat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" align="center"><strong>FORM TAMBAH KODE SURAT</strong></h5>
      </div>
      <div class="modal-body">
      	<form id="tambahkodesurat" method="POST" action="{{ route('kode_surat.store') }}" enctype="multipart/form-data">
         {!! csrf_field() !!}
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">ID Kode</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="txtIdKode" value="{{$newID}}" readonly="">
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Kode</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="txtKode" required="" placeholder="Kode" autofocus autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Keterangan</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="txtKeterangan" value="{{ old('txtKeterangan') }}" placeholder="Keterangan" required="">
            </div>
          </div>
          
        <div class="modal-footer" style="border-top: 0px;">
          <button type="submit" class="btn btn-success tombolform">Simpan</button>
          <button type="button" class="btn btn-warning tombolform" data-dismiss="modal">Tutup</button>
        </div>
      </form>
      
      </div>
       
     
    </div>
  </div>
</div>


<!-- EDIT KODE SURAT -->
<div class="modal fade" id="modalEditKodeSurat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" align="center"><strong>FORM UBAH DATA KODE SURAT</strong></h5>
      </div>
      <div class="modal-body" id="loadEditKodeSurat">
        
      
      </div>

    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
    var t = $('#dataKodeSurat').DataTable( {
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
@endsection
 
