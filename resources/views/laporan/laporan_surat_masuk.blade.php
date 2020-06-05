@extends('layouts.template')

 <?php 
 $title="Laporan Surat Masuk |";
 ?>
@section('content')
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">LAPORAN SURAT MASUK</h3>

              <div class="box-tools pull-right">
              </div>
            </div>   
<div class="row kotak">

<!-- FILTER DATA -->
<form action="{{url('/laporan_surat_masuk/filter_periode')}}" method="GET">
<div class="modal fade" id="modalFilterSuratMasuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" align="center"><strong>FILTER</strong></h5>
      </div>
      <div class="modal-body">
        

     <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Tanggal</label>
            <div class="col-md-10">
            <input type="date" name="txtAwal" class="form-control" required="">
        	</div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Sampai</label>
            <div class="col-md-10">
            <input type="date" name="txtAkhir" class="form-control" required="">
        	</div>
        </div>

      </div>
      <div class="modal-footer" style="border-top: 0px;">
        <input type="submit" name="btnCari" value="Tampilkan" class="btn btn-success tombolform">
        <button type="button" class="btn btn-warning tombolform" data-dismiss="modal">Tutup</button>
      </div>
    
    </div>
  </div>
</div>
</form>


<form action="{{url('/laporan_surat_masuk/filter_kode_surat')}}" method="GET">
<div class="modal fade" id="modalFilterKodeSuratMasuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" align="center"><strong>FILTER</strong></h5>
      </div>
      <div class="modal-body">
        

     <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Kode Surat</label>
            <div class="col-md-10">
            <select name="txtKodeSurat" class="form-control" required="">
              @foreach($kodeSurat as $ks)
                <option value="{{$ks->id}}">{{$ks->kode_surat}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="border-top: 0px;">
        <input type="submit" name="btnCariKode" value="Tampilkan" class="btn btn-success tombolform">
        <button type="button" class="btn btn-warning tombolform" data-dismiss="modal">Tutup</button>
      </div>
    
    </div>
  </div>
</div>
</form>


<table width="100%">
  <tr>
    <td width="20%">
       <button type="button" title="Filter Periode"  class="btn btn-success" data-toggle="modal" data-target="#modalFilterSuratMasuk"><span class="fa fa-search"></span>
                    Filter Periode
        </button>
        <button type="button" title="Filter Kode Surat"  class="btn btn-warning" data-toggle="modal" data-target="#modalFilterKodeSuratMasuk"><span class="fa fa-search"></span>
                    Filter Kode Surat
        </button>
        <?php
      if(isset($_GET['btnCari'])){
    ?>
  <input type="hidden" name="txtAwal2" value="{{$awal}}">
	<input type="hidden" name="txtAkhir2" value="{{$akhir}}">
	<a href="{{url('/laporan_surat_masuk/filter_periode/cetak/'.$awal.'/'.$akhir)}}" class="btn btn-primary" target="blank" data-toggle="modal" title="Cetak PDF">Cetak PDF</a>
	<br><br>
      Periode <b>{{Carbon\Carbon::parse($awal)->formatLocalized('%d %B %Y')}}</b> Sampai dengan <b>{{Carbon\Carbon::parse($akhir)->formatLocalized('%d %B %Y')}}</b>
    <?php
    $periode=" Periode ".Carbon\Carbon::parse($awal)->formatLocalized('%d %B %Y'). " Sampai ".Carbon\Carbon::parse($akhir)->formatLocalized('%d %B %Y');
      }
      elseif(isset($_GET['btnCariKode'])){
      ?>
        <input type="hidden" name="txtKodeSurat2" value="{{$kodeSurat}}">
  <a href="{{url('/laporan_surat_masuk/filter_kode_surat/cetak/'.$txtKodeSurat)}}" class="btn btn-primary" target="blank" data-toggle="modal" title="Cetak PDF">Cetak PDF</a>
    <?php
      }else{
      ?>
      	<a href="{{url('/laporan_surat_masuk/filter_periode/cetak')}}" class="btn btn-primary" target="blank" data-toggle="modal" title="Cetak PDF">Cetak PDF</a>
      <?php
      }
    ?>
</p>
        
    </td>
    
  </tr>
</table>
<p>



<!-- END -->
<table border="1" width="100%" class="table table-bordered table-hover" id="dataLaporanSuratMasuk">
	<thead>
		<tr>
			<th width="3%">No</th>
            <th>Tanggal Terima</th>
            <th>Kode</th>
            <th>No Surat</th>
            <th>Asal Surat</th>
            <th>Perihal Surat</th>
            <th>Tanggal Surat</th>      
            <th>Tindak Lanjut</th>
            <th>Cetak</th>
        </tr>
	</thead>
	<tbody>
	 <?php $no=1; ?>
    @foreach($laporanSuratMasuk->all() as $p)
    <tr>
      <td>{{$no++}} </td>
      <td>{{Carbon\Carbon::parse($p->tanggal_terima)->formatLocalized('%d %b %Y')}}</td>
      <td>{{$p->kode_surat}}</td>
      <td>{{$p->no_surat_masuk}}</td>
      <td>{{$p->asal_surat_masuk}}</td>
      <td>{{$p->perihal_surat_masuk}}</td>
      <td>{{Carbon\Carbon::parse($p->tanggal_surat_masuk)->formatLocalized('%d %b %Y')}}</td>
      <td>{{$p->tindak_lanjut2}}</td>
      <td><a href="{{url('cetak_surat_masuk/'.$p->id)}}" class="btn btn-warning" target="blank"><i class="fa fa-print" aria-hidden="true"></i></a></td>
    </tr>
    @endforeach
</tbody>

</table>
<!-- Jumlah Surat : <span style="background-color: red;padding: 4px;color: #fff;border-radius: 4px;">{{$jumlahSuratMasuk}}</span> -->
</div>


<!-- DATATABLES -->
<script type="text/javascript">
$(document).ready(function() {
    var t = $('#dataLaporanSuratMasuk').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0,
        } ],
                "language": {
            // "lengthMenu": "Tampilkan _MENU_ records per Halaman",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Jumlah Surat : _TOTAL_, page _PAGE_ of _PAGES_",
            // "info": "show _PAGE_ of _PAGES_ of _TOTAL_",
            "infoEmpty": "Data tidak ditemukan",
            "infoFiltered": "(Total _MAX_ surat)"
        },
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
 
