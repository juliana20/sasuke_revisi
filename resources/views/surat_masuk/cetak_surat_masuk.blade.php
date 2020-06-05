<table class="table" border="1" cellspacing="0" cellpadding="0" width="100%">
    <tr>
        <td colspan="5" align="center"><h2>LEMBAR DISPOSISI</h2></td>
    </tr>
    <tr align="center">
        <td width="25%" style="padding: 10px;">Indexs : </td>
        <td colspan="2" width="25%">Kode : <b>{{$suratMasuk->kode_surat}}</b></td>
        <td width="25%">No Urut</td>
        <td width="25%">Tgl Penyelesaian</td>
    </tr>
    <tr>
        <td colspan="5" style="padding: 10px 10px 60px 10px;">Perihal Isi Ringkasan <br> <b>{{$suratMasuk->perihal_surat_masuk}}</b></td>
    </tr>
    <tr>
        <td colspan="2" style="padding: 5px 5px 5px 5px;">Asal Surat : <b>{{$suratMasuk->asal_surat_masuk}}</b></td>
        <td style="padding: 5px 5px 5px 5px;">Tgl : <b>{{Carbon\Carbon::parse($suratMasuk->tanggal_surat_masuk)->formatLocalized('%d %b %Y')}}</b></td>
        <td style="padding: 5px 5px 5px 5px;">Nomor : <b>{{$suratMasuk->no_surat_masuk}}</b></td>
        <td style="padding: 5px 5px 5px 5px;">Lampiran</th>
    </tr>
    <tr>
        <td colspan="2" style="padding: 10px 10px 250px 10px;">Diajukan diteruskan Kepada <br><b>{{$suratMasuk->jabatan}}</b></td>
        <td colspan="3" style="padding: 0px 10px 260px 10px;">Instruksi / Informasi</td>
    </tr>
</table>