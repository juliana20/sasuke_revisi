<form action="{{url('surat_masuk/aksi_sudah_dibaca/'.$suratMasuk->id)}}" id="formSudahDibaca">
   {{csrf_field()}}

<input type="hidden" name="id" value="{{$suratMasuk->id}}">
  Apakah Anda sudah membaca surat ini?
<div class="form-group">

</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-success">Ya</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
</div>
</form>