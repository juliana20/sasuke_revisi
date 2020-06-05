<form action="{{ url ('surat_masuk/aksi_kirim_waka/'.$suratMasuk->id) }}" method="POST" id="formKirimSuratMasuk" enctype="multipart/form-data">
  {{csrf_field()}}
  {{method_field('PUT')}}
    <input type="hidden" name="id" value="{{$suratMasuk->id}}">
    <div class="form-group">
            <select class="form-control" name="txtTindakLanjut" required="">
                <option value="0">{{$suratMasuk->jabatan}}</option>
            </select>
          </div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success">Kirim</button>
</div>
</form>

