@extends('layouts.template')

 <?php 
 $title="Surat Keluar |";
 ?>
@section('content')
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">DATA SURAT KELUAR (Belum Isi No Surat)</h3>

              <div class="box-tools pull-right">
              </div>
            </div>   
<div class="row kotak">
<div align="left">
<table border="1" width="100%" class="table table-bordered table-hover" id="dataSuratKeluar2">
	<thead>
		<tr>
        <th width="5%">No</th>
        <th>File</th> 
        <th>No Surat</th>
        <th>Aksi</th>      
    </tr>
	</thead>
	<tbody>
	 <?php $no=1; ?>
    @foreach($suratKeluar->all() as $p)
    <tr>
      <td>{{$no++}} </td>
      <td>
        <a href="{{url('public/image/scan_surat_keluar/'.$p->file)}}" target="blank"><img src="{{url('public/image/scan_surat_keluar/'.$p->file)}}" width="50px" height="auto" id="zoom1"></a>
      </td>
      <td>
        {{$p->no_surat_keluar}}
      </td>
      <td>
        <a title="Isi No Surat" href="{{url('surat_keluar/edit/'.$p->id)}}" data-toggle="modal"><span class="btn btn-warning  btn-sm" style="margin: 1px;"><span class="fa fa-edit"></span></span></a>
      </td>
    </tr>
    @endforeach
</tbody>

</table>
</div>


<!-- DATATABLES -->
<script type="text/javascript">
$(document).ready(function() {
    var t = $('#dataSuratKeluar2').DataTable( {
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
 
