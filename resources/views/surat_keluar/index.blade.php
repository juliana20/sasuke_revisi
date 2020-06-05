@extends('layouts.template')

 <?php 
 $title="Surat Keluar |";
 ?>
@section('content')
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">DATA SURAT KELUAR</h3>

              <div class="box-tools pull-right">
              </div>
            </div>   
<div class="row kotak">
<div align="left">
@if((Session::get('user_tipe')=='Admin') || (Session::get('user_tipe')=='Wakil Kepala'))
<a href="{{route('surat_keluar.create')}}" class="btn btn-success">
  Tambah Data</a>
</div><br>
@else
@endif
<table border="1" width="100%" class="table table-bordered table-hover" id="dataSuratKeluar">
	<thead>
		<tr>
          @if(Session::get('user_tipe')=='Admin')
			       <th width="3%">No</th>
            <th>Tanggal Dikirim</th>
            <th>Kode</th>
            <th>No Surat</th>
            <th>Tujuan Surat</th>
            <th>Perihal Surat</th>
            <th>Tanggal Surat</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>File</th>
            <th>Bukti Pengiriman Surat</th>   
            <th>Aksi</th>
          @elseif(Session::get('user_tipe')=='Kepala Sekolah')
            <th width="3%">No</th>
            <th>Tanggal Dikirim</th>
            <th>Kode</th>
            <th>No Surat</th>
            <th>Tujuan Surat</th>
            <th>Perihal Surat</th>
            <th>Tanggal Surat</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>File</th>
            <th>Bukti Pengiriman Surat</th>   

          @elseif(Session::get('user_tipe')=='Wakil Kepala')
              <th width="5%">No</th>
              <th>File</th> 
              <th>No Surat</th>
              <th>Aksi</th>    
          @endif  
        </tr>
	</thead>
	<tbody>
	 <?php $no=1; ?>
    @foreach($suratKeluar->all() as $p)
    <tr>
    @if(Session::get('user_tipe')=='Admin')
      <td>{{$no++}} </td>
      <td>{{Carbon\Carbon::parse($p->tanggal_dikirim)->formatLocalized('%d %b %Y')}}</td>
      <td>{{$p->kode_surat}}</td>
      <td>{{$p->no_surat_keluar}}</td>
      <td>{{$p->tujuan_surat}}</td>
      <td>{{$p->perihal_surat_keluar}}</td>
      <td>{{Carbon\Carbon::parse($p->tanggal_surat_keluar)->formatLocalized('%d %b %Y')}}</td>
      <td>{{$p->keterangan_surat_keluar}}</td>
      <td>{{$p->status_surat}}</td>
      <td>
        <a href="{{url('public/image/scan_surat_keluar/'.$p->file)}}" target="blank"><img src="{{url('public/image/scan_surat_keluar/'.$p->file)}}" width="50px" height="auto" id="zoom1"></a>
    </td>
     <td>
        <a href="{{url('public/image/scan_surat_keluar/'.$p->bukti_pengiriman_surat)}}" target="blank"><img src="{{url('public/image/scan_surat_keluar/'.$p->bukti_pengiriman_surat)}}" width="50px" height="auto" id="zoom1"></a>
    </td>
    <td>
            <a title="Ubah Surat Keluar" href="{{url('surat_keluar/edit/'.$p->id)}}" data-toggle="modal"><span class="btn btn-warning  btn-sm" style="margin: 1px;"><span class="fa fa-edit"></span></span></a>
            
    </td>

    @elseif(Session::get('user_tipe')=='Kepala Sekolah')
      <td>{{$no++}} </td>
      <td>{{Carbon\Carbon::parse($p->tanggal_dikirim)->formatLocalized('%d %b %Y')}}</td>
      <td>{{$p->kode_surat}}</td>
      <td>{{$p->no_surat_keluar}}</td>
      <td>{{$p->tujuan_surat}}</td>
      <td>{{$p->perihal_surat_keluar}}</td>
      <td>{{Carbon\Carbon::parse($p->tanggal_surat_keluar)->formatLocalized('%d %b %Y')}}</td>
      <td>{{$p->keterangan_surat_keluar}}</td>
      <td>{{$p->status_surat}}</td>
      <td>
        <a href="{{url('public/image/scan_surat_keluar/'.$p->file)}}" target="blank"><img src="{{url('public/image/scan_surat_keluar/'.$p->file)}}" width="50px" height="auto" id="zoom1"></a>
    </td>
     <td>
        <a href="{{url('public/image/scan_surat_keluar/'.$p->bukti_pengiriman_surat)}}" target="blank"><img src="{{url('public/image/scan_surat_keluar/'.$p->bukti_pengiriman_surat)}}" width="50px" height="auto" id="zoom1"></a>
    </td>
      @elseif(Session::get('user_tipe')=='Wakil Kepala')
      <td>{{$no++}} </td>
      <td>
        <a href="{{url('public/image/scan_surat_keluar/'.$p->file)}}" target="blank"><img src="{{url('public/image/scan_surat_keluar/'.$p->file)}}" width="50px" height="auto" id="zoom1"></a>
      </td>
      <td>{{$p->no_surat_keluar}}</td>
       <td>
            <a title="Ubah Surat Keluar" href="{{url('surat_keluar/edit/'.$p->id)}}" data-toggle="modal"><span class="btn btn-warning  btn-sm" style="margin: 1px;"><span class="fa fa-edit"></span></span></a>
      </td>
      @endif 
    </tr>
    @endforeach
</tbody>

</table>
</div>


<!-- MODAL KIRIM SURAT -->
<div class="modal fade" id="modalKirimSuratMasuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" align="center"><strong>WAKA</strong></h5>
      </div>
      <div class="modal-body" id="loadKirimSuratMasuk">

      </div>

    </div>
  </div>
</div>


<!-- DATATABLES -->
<script type="text/javascript">
$(document).ready(function() {
    var t = $('#dataSuratKeluar').DataTable( {
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
 
