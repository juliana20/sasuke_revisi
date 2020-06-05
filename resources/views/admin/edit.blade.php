<form action="{{ route ('admin.update',[$admin->id]) }}" method="POST" id="formEditAdmin" enctype="multipart/form-data">
  {{csrf_field()}}
  {{method_field('PUT')}}
    <input type="hidden" name="id" value="{{$admin->id}}">
   
<div class="form-group">
    <label for="name" class="col-sm-2 control-label tengah2">ID</label>
    <div class="col-md-10">
    <input type="text" class="form-control" name="txtIdAdmin" value="{{$admin->user_id}}" readonly="">
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-2 control-label tengah2">Nama Pegawai</label>
    <div class="col-md-10">
    <input type="text" class="form-control" name="txtNamaPegawai" value="{{$admin->nama_pegawai}}" required="">
    </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-2 control-label tengah2">Jabatan</label>
    <div class="col-md-10">
    <select name="txtJabatan" class="form-control" required="">
        <option value="{{$admin->jabatan}}">{{$admin->jabatan}}</option>
        @if($admin->jabatan=='Admin Keuangan')
            <option value="Admin Kurikulum">Admin Kurikulum</option>
            <option value="Admin Humas">Admin Humas</option>
        @elseif($admin->jabatan=='Admin Kurikulum')
            <option value="Admin Keuangan">Admin Keuangan</option>
            <option value="Admin Humas">Admin Humas</option>
        @else
            <option value="Admin Keuangan">Admin Keuangan</option>
            <option value="Admin Kurikulum">Admin Kurikulum</option>
        @endif
    </select>
    </div>
</div>
<div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Username</label>
        <div class="col-md-10">
        <input type="text" class="form-control" name="txtUsername" value="{{$admin->username}}" required="">
        </div>
</div>
<div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Password</label>
        <div class="col-md-10">
        <input type="password" class="form-control" name="txtPassword" value="{{$admin->password }}"  required="">
        </div>
</div>
<div class="form-group">
    <label for="name" class="col-sm-2 control-label tengah2">Status</label>
    <div class="col-md-10">
    <select name="txtStatus" class="form-control" required="">
        <option value="{{$admin->status}}">{{$admin->status}}</option>
            @if($admin->status=='Aktif')
              <option value="Tidak Aktif">Tidak Aktif</option>
            @else
              <option value="Aktif">Aktif</option>
            @endif
    </select>
    </div>
</div>
<div class="form-group">
        <label for="exampleInputFile" class="col-sm-2 control-label tengah2">Foto</label><br>
        <div class="col-md-10">
        <img src="{{ asset('public/image/foto_staff/'.$admin->foto) }}" style="width: 100px;" id="profile-img-tag2">
        </div>
</div>
<div class="form-group">
        <label for="exampleInputFile" class="col-sm-2 control-label tengah2">Ganti Foto</label>
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