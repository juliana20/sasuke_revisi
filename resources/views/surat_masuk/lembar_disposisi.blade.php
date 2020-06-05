@extends('layouts.template')

 <?php 
 $title="Lembar Disposisi |";
 ?>

@section('content')
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">LEMBAR DISPOSISI</h3>

              <div class="box-tools pull-right">
              </div>
            </div> 
<div class="row kotak">
<div class="col-xs-12">
<div align="right" style="margin-bottom: 10px;">
    <a href="{{url('surat_masuk/cetak/'.$suratMasuk->id)}}" class="btn btn-primary" target="blank">Cetak</a>
    <a href="javascript:history.go(-1)" class="btn btn-danger">Batal</a>
</div>


<input type="hidden" name="id" value="">
<table class="table" border="1">
    <tr>
        <td colspan="5" align="center"><h2>LEMBAR DISPOSISI</h2></td>
    </tr>
    <tr>
        <th width="25%">Indexs : </th>
        <th colspan="2" width="25%">Kode : {{$suratMasuk->kode_surat}}</th>
        <th width="25%">No Urut</th>
        <th width="25%">Tgl Penyelesaian</th>
    </tr>
    <tr>
        <th colspan="5" style="padding-bottom: 60px;">Perihal Isi Ringkasan <br> {{$suratMasuk->perihal_surat_masuk}}</th>
    </tr>
    <tr>
        <th colspan="2">Asal Surat : {{$suratMasuk->asal_surat_masuk}}</th>
        <th>Tgl : {{Carbon\Carbon::parse($suratMasuk->tanggal_surat_masuk)->formatLocalized('%d %b %Y')}}</th>
        <th>Nomor : {{$suratMasuk->no_surat_masuk}}</th>
        <th>Lampiran</th>
    </tr>
    <tr>
        <th colspan="2" style="padding-bottom: 250px;">Diajukan diteruskan Kepada : {{$suratMasuk->jabatan}}</th>
        <th colspan="3">Instruksi / Informasi</th>
    </tr>
</table>
</div>
</div>
</div>   

@endsection