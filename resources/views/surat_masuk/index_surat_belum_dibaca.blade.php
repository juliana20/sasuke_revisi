@extends('layouts.template')

 <?php 
 $title="Surat Masuk Belum Dibaca |";
 ?>
@section('content')
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">DAFTAR SURAT MASUK BELUM DIBACA</h3>

              <div class="box-tools pull-right">
              </div>
            </div>   
<div class="row kotak">
<div align="left">
@if($count<=0)
  <h4 align="center">Tidak ada surat masuk yang belum dibaca!</h4>
@else
@if((Session::get('user_tipe')=='Admin'))
<!-- <a href="{{route('surat_masuk.create')}}" class="btn btn-success">
  Tambah Data</a>
</div><br> -->
@else

@endif
<table border="1" width="100%" class="table table-bordered table-hover" id="dataSuratMasuk">
	<thead>
		<tr>
			<th width="3%">No</th>
            <th>Tanggal Terima</th>
            <th>Kode</th>
            <th>No Surat</th>
            <th>Asal Surat</th>
            <th>Perihal Surat</th>
            <th>Tanggal Surat</th>
            <th>Keterangan</th>
            <th>Disposisi</th>
            <th>File</th>       
            <th>Tindak Lanjut</th>
            @if((Session::get('user_tipe')=='Wakil Kepala'))
            <th>Aksi</th>
            @else
            <th>Aksi</th>
            @endif
        </tr>
	</thead>
	<tbody>
	 <?php $no=1; ?>
    @foreach($suratMasuk->all() as $p)
    <tr>
      <td>{{$no++}} </td>
      <td>{{Carbon\Carbon::parse($p->tanggal_terima)->formatLocalized('%d %b %Y')}}</td>
      <td>{{$p->kode_surat}}</td>
      <td>{{$p->no_surat_masuk}}</td>
      <td>{{$p->asal_surat_masuk}}</td>
      <td>{{$p->perihal_surat_masuk}}</td>
      <td>{{Carbon\Carbon::parse($p->tanggal_surat_masuk)->formatLocalized('%d %b %Y')}}</td>
      <td>{{$p->keterangan_surat_masuk}}</td>
      <td align="center">
        @if($p->disposisi=='1')
            <input type="checkbox" name="txtDisposisi" checked="" onclick="return false;">
        @else
            <input type="checkbox" name="txtDisposisi" readonly="" onclick="return false;">
        @endif
        </td>
      <td>
        <a href="{{url('public/image/scan_surat/'.$p->file)}}" target="blank"><img src="{{url('public/image/scan_surat/'.$p->file)}}" width="50px" height="auto" id="zoom1"></a>
    </td>
      <td>{{$p->tindak_lanjut2}}</td>
      @if((Session::get('user_tipe')=='Admin'))
      <td>
            <a title="Ubah Surat Masuk" href="{{url('surat_masuk/edit/'.$p->id)}}" data-toggle="modal"><span class="btn btn-warning  btn-sm" style="margin: 1px;"><span class="fa fa-edit"></span></span></a>
            <a><span class="btn btn-warning  btn-sm" style="margin: 1px;" @if($p->tindak_lanjut=='0') data-target='#modalKirimSuratMasuk' data-toggle='modal'  data-id='{!! $p->id!!}' title='Kirim Surat Masuk'  @else data-target='#' disabled  @endif><span class="fa fa-send"></span></span></a>
            <a title="Cetak Surat Masuk" data-toggle="modal" href="{{url('surat_masuk/lembar_disposisi/'.$p->id)}}"><span class="btn btn-warning  btn-sm" style="margin: 1px;"><span class="glyphicon glyphicon-print"></span></span></a>
      </td>
      @elseif((Session::get('user_tipe')=='Kepala Sekolah'))
      <td>
            @if($p->disposisi=='1')
              <a title="Batal Disposisi" data-toggle="modal" data-target="#modalBatalDisposisi" data-id="{!! $p->id!!}" ><span class="btn btn-danger  btn-sm" style="margin: 1px;"><span class="glyphicon glyphicon-remove"></span></span></a>
            @else
              <a title="Persetujuan Disposisi" data-toggle="modal" data-target="#modalPersetujuanDisposisi" data-id="{!! $p->id!!}"><span class="btn btn-primary  btn-sm" style="margin: 1px;"><span class="glyphicon glyphicon-ok"></span></span></a>
            @endif 
      </td>
      @else
      <td>
          @if($p->sudah_dibaca=='1')
            <a title="Sudah dibaca" data-toggle="modal" data-target="#" data-id=""><span class="btn btn-success  btn-sm" style="margin: 1px;"><span class="glyphicon glyphicon-ok"></span></span></a>
          @else
            <a title="Tandai sudah dibaca" data-toggle="modal" data-target="#modalSudahDibaca" data-id="{!! $p->id!!}"><span class="btn btn-primary  btn-sm" style="margin: 1px;"><span class="glyphicon glyphicon-ok"></span></span></a>
          @endif
      </td>
      @endif
    </tr>
    @endforeach
</tbody>

</table>
@endif
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

<div class="modal fade" id="modalPersetujuanDisposisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" align="center"><strong>PERSETUJUAN DISPOSISI</strong></h5>
      </div>
      <div class="modal-body" id="loadPersetujuanDisposisi">
            
    </div>
  </div>
  </div>
</div>

<div class="modal fade" id="modalBatalDisposisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" align="center"><strong>PERHATIAN!</strong></h5>
      </div>
      <div class="modal-body" id="loadBatalDisposisi">
            
    </div>
  </div>
  </div>
</div>

<div class="modal fade" id="modalSudahDibaca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" align="center"><strong>PERHATIAN!</strong></h5>
      </div>
      <div class="modal-body" id="loadSudahDibaca">
            
    </div>
  </div>
  </div>
</div>


<!-- DATATABLES -->
<script type="text/javascript">
$(document).ready(function() {
    var t = $('#dataSuratMasuk').DataTable( {
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
 
