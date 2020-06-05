<form action="{{ route ('kepala_sekolah.update',[$kepalaSekolah->id]) }}" method="POST" id="formEditKepalaSekolah" enctype="multipart/form-data">
  {{csrf_field()}}
  {{method_field('PUT')}}
    <input type="hidden" name="id" value="{{$kepalaSekolah->id}}">
   
<div class="form-group">
    <label for="name" class="col-sm-2 control-label tengah2">ID</label>
    <div class="col-md-10">
    <input type="text" class="form-control" name="txtIdKepalaSekolah" value="{{$kepalaSekolah->user_id}}" readonly="">
</div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-2 control-label tengah2">Nama Pegawai</label>
    <div class="col-md-10">
    <input type="text" class="form-control" name="txtNamaPegawai" value="{{$kepalaSekolah->nama_pegawai}}" required="">
</div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-2 control-label tengah2">Jabatan</label>
    <div class="col-md-10">
    <select name="txtJabatan" class="form-control" required="">
        <option value="{{$kepalaSekolah->jabatan}}">{{$kepalaSekolah->jabatan}}</option>
    </select>
</div>
</div>
<div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Username</label>
        <div class="col-md-10">
        <input type="text" class="form-control" name="txtUsername" value="{{$kepalaSekolah->username}}" required="">
    </div>
</div>
<div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Password</label>
        <div class="col-md-10">
        <input type="password" class="form-control" name="txtPassword" value="{{$kepalaSekolah->password }}"  required="">
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-2 control-label tengah2">Status</label>
    <div class="col-md-10">
    <select name="txtStatus" class="form-control" required="">
        <option value="{{$kepalaSekolah->status}}">{{$kepalaSekolah->status}}</option>
            @if($kepalaSekolah->status=='Aktif')
              <option value="Tidak Aktif">Tidak Aktif</option>
            @else
              <option value="Aktif">Aktif</option>
            @endif
    </select>
</div>
</div>
<div class="form-group">
        <label for="exampleInputFile" class="col-sm-2 control-label tengah2">Foto</label>
        <div class="col-md-10">
        <img src="{{ asset('public/image/foto_staff/'.$kepalaSekolah->foto) }}" id="profile-img-tag2" style="width: 100px;">
    </div>
</div>
<div class="form-group">
        <label for="exampleInputFile" class="col-sm-2 control-label tengah2">Ganti Foto</label><br>
        <div class="col-md-10">
        <input type="file" name="txtFoto" id="profile-img2" style="padding-top: 10px;padding-left: 3px;">
        </div>
</div>
<div class="modal-footer" style="border-top: 0px;">
    <button type="submit" class="btn btn-success">Perbarui</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
</div>
</form>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img2").change(function(){
        readURL(this);
    });
</script>