@extends('layouts.template')

 <?php 
 $title="Tambah Surat Masuk |";
 ?>

@section('content')


<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">TAMBAH DATA SURAT MASUK</h3>

              <div class="box-tools pull-right">
              </div>
            </div> 
<div class="row kotak">
    <div class="col-xs-12">

   <form id="tambahsuratmasuk" method="POST" action="{{ route('surat_masuk.store') }}" enctype="multipart/form-data">
         {!! csrf_field() !!}

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">ID Surat Masuk</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="txtIdSuratMasuk" value="{{$newID}}" readonly required="">
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Tanggal Terima</label>
            <div class="col-md-10">
            <input type="date" class="form-control" name="txtTanggalTerima" required="" autofocus autocomplete="off">
          </div>
          </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label tengah2">Kode</label>
            <div class="col-md-10" style="margin-bottom: 3px;">
                <div class="input-group">
                    
                    <input type="text" name="txtKodeSurat" placeholder="Kode Surat" class="form-control" id="KodeSurat" required="" readonly="" style="background-color: #fff">
                    <input type="hidden" name="txtIdKodeSurat" placeholder="ID Kode Surat" class="form-control" id="IdKodeSurat" readonly="" required="">
                    <span class="input-group-addon" style="padding: 0px 0px 0px 7px;margin: 0px;"> <a href="" title="Pilih Kode Surat" data-toggle="modal" data-target="#ModalKodeSurat" class="tombolModal">
                    <i class="fa fa-search" aria-hidden="true"></i></a></span>

              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Nomor Surat</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="txtNoSurat" placeholder="Nomor Surat" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Asal Surat</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="txtAsalSurat" placeholder="Asal Surat" required="">
          </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Perihal Surat</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="txtPerihalSurat" placeholder="Perihal Surat" required="">
          </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Tanggal Surat</label>
            <div class="col-md-10">
            <input type="date" class="form-control" name="txtTanggalSurat" required="">
          </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Keterangan</label>
            <div class="col-md-10">
            <textarea class="form-control" name="txtKeterangan" required="" rows="3" cols="10" placeholder="Keterangan"></textarea>
          </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Tindak Lanjut</label>
            <div class="col-md-10">
            <select class="form-control" name="txtTindakLanjut">
                @foreach($kepala as $w)
                <option value="{{$w->id}}">{{$w->jabatan}}</option>
                @endforeach
            </select>
          </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">File (Scan)</label>
            <div class="col-md-10">
            <input type="file" class="form-control" name="txtFile" required="" id="profile-img_surat">
            <img src="" id="profile-img-tag_surat" style="width: 100px;" />
          </div>
          </div>

        <div class="modal-footer" style="border-top: 0px;">
          <button type="submit" class="btn btn-success tombolform">Simpan</button>
           <a href="javascript:history.go(-1)" class="btn btn-danger tombolform">Batal</a>
        </div>
      </form>
  </div>
</div>
</div>


<!-- MODAL TAMPIL KODE SURAT -->
        <div class="modal fade" id="ModalKodeSurat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:800px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">PILIH KODE SURAT</h4>
                    </div>
                    <div class="modal-body">
                        <table id="lookupKodeSurat" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>ID Kode Surat</th>
                                    <th>Kode Surat</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no=1;
                                ?>
                                @foreach($kodeSurat as $o)
                                    <tr class="pilihKodeSurat" data-id="{{$o->id}}" data-nama="{{$o->kode_surat}}">
                                        <td>{{$no++}}</td>
                                        <td>{{$o->kode_id}}</td>
                                        <td>{{$o->kode_surat}}</td>
                                        <td>{{$o->keterangan}}</td>
                                    </tr>
                                  @endforeach
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).on('click', '.pilihKodeSurat', function (e) {
                document.getElementById("KodeSurat").value = $(this).attr('data-nama');
                document.getElementById("IdKodeSurat").value = $(this).attr('data-id');
                $('#ModalKodeSurat').modal('hide');
            });
            

            $(document).ready(function() {
            var t = $('#lookupKodeSurat').DataTable( {
            "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0,
            } ],
              "order": [[ 0, 'asc' ]]
            } );
 
            t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );

        </script>
<!-- END -->

<!-- TAMPIL IMAGE SAAT TAMBAH -->
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag_surat').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img_surat").change(function(){
        readURL(this);
    });
</script>
@endsection

