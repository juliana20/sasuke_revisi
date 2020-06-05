<div align="center">
  <h4>LAPORAN SURAT MASUK<br>
  SMK SARASWATI 1 DENPASAR<br>
  STATUS : TERAKREDITASI A, NDS. 4322090004, NSS.
  343220900003, NPSN. 50103146<br>
  Jl. Kamboja No. 11A, Telp. (0361) 255766 Denpasar<br>
  e-mail : smeasaraswatidps@yahoo.com, Fax : (0361) 225766<hr></h4>
</div>
<p>Tanggal Cetak : {{Carbon\Carbon::now()->formatLocalized('%d %B %Y')}}</p>
<table border="1" width="100%" cellpadding="2" cellspacing="0" class="table table-bordered table-hover">
	<thead>
		<tr align="center">
			<th width="5%">No</th>
            <th>Tanggal Terima</th>
            <th>Kode</th>
            <th>No Surat</th>
            <th>Asal Surat</th>
            <th>Perihal Surat</th>
            <th>Tanggal Surat</th>      
            <th>Tindak Lanjut</th>
        </tr>
	</thead>
	<tbody>
	 <?php $no=1; ?>
    @foreach($laporanSuratMasuk->all() as $p)
    <tr>
      <td>{{$no++}} </td>
      <td>{{Carbon\Carbon::parse($p->tanggal_terima)->formatLocalized('%d %b %Y')}}</td>
      <td align="center">{{$p->kode_surat}}</td>
      <td>{{$p->no_surat_masuk}}</td>
      <td>{{$p->asal_surat_masuk}}</td>
      <td>{{$p->perihal_surat_masuk}}</td>
      <td>{{Carbon\Carbon::parse($p->tanggal_surat_masuk)->formatLocalized('%d %b %Y')}}</td>
      <td>{{$p->tindak_lanjut2}}</td>
    </tr>
    @endforeach
</tbody>

</table>
<p>Jumlah Surat Masuk : {{$jumlahSuratMasuk}}</p>