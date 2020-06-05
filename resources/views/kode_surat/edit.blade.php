<form action="{{ route ('kode_surat.update',[$kodeSurat->id]) }}" method="POST" id="formEditKodeSurat" enctype="multipart/form-data">
  {{csrf_field()}}
  {{method_field('PUT')}}
    <input type="hidden" name="id" value="{{$kodeSurat->id}}">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">ID Kode</label>
        <div class="col-md-10">
        <input type="text" class="form-control" name="txtIdKode" value="{{$kodeSurat->kode_id}}" readonly="">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Kode</label>
        <div class="col-md-10">
        <input type="text" class="form-control" name="txtKode" value="{{$kodeSurat->kode_surat}}" required="">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Keterangan</label>
        <div class="col-md-10">
        <input type="text" class="form-control" name="txtKeterangan" value="{{$kodeSurat->keterangan}}" required="">
        </div>
    </div>
<div class="modal-footer" style="border-top: 0px;">
    <button type="submit" class="btn btn-success tombolform">Perbarui</button>
    <button type="button" class="btn btn-danger tombolform" data-dismiss="modal">Batal</button>
</div>
</form>
