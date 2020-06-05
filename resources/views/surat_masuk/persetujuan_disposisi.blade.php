<form action="{{ url ('surat_masuk/aksi_persetujuan_disposisi/'.$suratMasuk->id) }}" method="POST" id="formPersetujuanDisposisi" enctype="multipart/form-data">
  {{csrf_field()}}
  {{method_field('PUT')}}
    <input type="hidden" name="id" value="{{$suratMasuk->id}}">
    <div class="form-group">
      <label for="name" class="col-sm-3 control-label tengah2">Disposisi</label>
        <div class="col-md-9">
          <select class="form-control" name="txtDisposisi" required="">
            <option value="1">Ya</option>
            <option value="0">Tidak</option>
          </select>
        </div>
    </div>
    <div class="form-group">
      <label for="name" class="col-sm-3 control-label tengah2">Tindak Lanjut</label>
        <div class="col-md-9">
          <select class="form-control" name="txtTindakLanjut" required="">
            <option value="" disabled selected hidden>- Pilih -</option>
             @foreach($waka as $w)
                <option value="{{$w->id}}">{{$w->jabatan}}</option>
              @endforeach
            <option value="0">NONE</option>
          </select>
        </div>
    </div>
    
    <div class="modal-footer" style="border-top: 0px;">
      <button type="submit" class="btn btn-success tombolForm">Simpan</button>
    </div>
</form>
