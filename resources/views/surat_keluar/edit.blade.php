@extends('layouts.template')

 <?php 
 $title="Ubah Surat Keluar |";
 ?>

@section('content')
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">UBAH DATA SURAT KELUAR</h3>

              <div class="box-tools pull-right">
              </div>
            </div> 
<div class="row kotak">
<div class="col-xs-12">
<form action="{{ route ('surat_keluar.update',[$suratKeluar->id]) }}" method="POST" id="formEditSuratKeluar" enctype="multipart/form-data">
  {{csrf_field()}}
  {{method_field('PUT')}}
  @if(Session::get('user_tipe')=='Admin')
  @if($suratKeluar->no_surat_keluar=='')
<input type="hidden" name="id" value="{{$suratKeluar->id}}">
<div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Nomor Surat</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="txtNoSurat" value="{{$suratKeluar->no_surat_keluar}}" required="" placeholder="Nomor Surat">
        </div>
    </div>
 <div class="form-group">
                    <label for="exampleInputFile" class="col-sm-2 control-label tengah2">File (Scan)</label>
                    <div class="col-md-10">
                    <img src="{{ asset('public/image/scan_surat_keluar/'.$suratKeluar->file) }}" style="width: 100px;padding-left: 3px;" id="profile-img-tag_surat2">
                </div>
            </div>


    @else 
    <input type="hidden" name="id" value="{{$suratKeluar->id}}">
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">ID Surat Keluar</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="txtIdSuratKeluar" value="{{$suratKeluar->surat_keluar_id}}" readonly required="">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Tanggal Dikirm</label>
        <div class="col-md-10">
            <input type="date" class="form-control" name="txtTanggalKirim" required="" value="{{$suratKeluar->tanggal_dikirim}}">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Kode</label>
            <div class="col-md-10" style="margin-bottom:6px;">
                <div class="input-group">
                    <input type="text" name="txtKodeSurat" placeholder="Kode Surat" class="form-control" id="KodeSurat2" required="" readonly="" style="background-color: #fff" value="{{$suratKeluar->kode_surat}}">
                    <input type="hidden" name="txtIdKodeSurat" placeholder="ID Kode Surat" class="form-control" id="IdKodeSurat2" readonly="" required="" value="{{$suratKeluar->kode_surat_keluar}}">
                    <span class="input-group-addon" style="padding: 0px 0px 0px 7px;margin: 0px;"> <a href="" title="Pilih Kode Surat" data-toggle="modal" data-target="#ModalKodeSurat2" class="tombolModal">
                    <i class="fa fa-search" aria-hidden="true"></i></a></span>
              </div>
            </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Nomor Surat</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="txtNoSurat" value="{{$suratKeluar->no_surat_keluar}}" required="">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Tujuan Surat</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="txtTujuanSurat" value="{{$suratKeluar->tujuan_surat}}" required="">
        </div>
    </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Perihal Surat</label>
            <div class="col-md-10">
            <input type="text" class="form-control" name="txtPerihalSurat" value="{{$suratKeluar->perihal_surat_keluar}}" required="">
        </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Tanggal Surat</label>
            <div class="col-md-10">
            <input type="date" class="form-control" name="txtTanggalSurat" required="" value="{{$suratKeluar->tanggal_surat_keluar}}">
        </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Keterangan</label>
            <div class="col-md-10">
            <textarea class="form-control" name="txtKeterangan" required="" rows="3" cols="10" placeholder="Keterangan">{{$suratKeluar->keterangan_surat_keluar}}</textarea>
        </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label tengah2">Status</label>
            <div class="col-md-10">
            <select class="form-control" name="txtStatus">
                @if($suratKeluar->status_surat=='Dikirim')
                    <option value="Dikirim" selected="">Dikirim</option>
                    <option value="Belum Dikirim">Belum Dikirim</option>
                @else
                    <option value="Dikirim">Dikirim</option>
                    <option value="Belum Dikirim" selected="">Belum Dikirim</option>
                @endif
            </select>
        </div>
        </div>
           <div class="form-group">
                    <label for="exampleInputFile" class="col-sm-2 control-label tengah2">File (Scan)</label>
                    <div class="col-md-10">
                    <img src="{{ asset('public/image/scan_surat_keluar/'.$suratKeluar->file) }}" style="width: 100px;padding-left: 3px;" id="profile-img-tag_surat2">
                </div>
            </div>
            <div class="form-group">
                 <label for="exampleInputFile" class="col-sm-2 control-label tengah2">Ganti File</label>
                    <div class="col-md-10">
                    <input type="file" name="txtFile" id="profile-img_surat2" style="padding-top: 10px;padding-left: 3px;">
                </div>
                    
            </div>
            <table width="100%">
                <tr>
                    <td>
                        <div class="form-group">
                    <label for="exampleInputFile" class="col-sm-2 control-label tengah2">Bukti Pengiriman</label>
                    <div class="col-md-10">
                    <img src="{{ asset('public/image/scan_surat_keluar/'.$suratKeluar->bukti_pengiriman_surat) }}" style="width: 100px;padding-left: 3px;" id="profile-img-tag_suratxx">
                </div>
            </div>
            <div class="form-group">
                 <label for="exampleInputFile" class="col-sm-2 control-label tengah2">Ganti File</label>
                    <div class="col-md-10">
                    <input type="file" name="txtBuktiPengiriman" id="profile-img_suratxx" style="padding-top: 10px;padding-left: 3px;">
                </div>
                    
            </div>
                    </td>
                </tr>
            </table>
            
    @endif
@else(Session::get('user_tipe')=='Wakil Kepala')
<input type="hidden" name="id" value="{{$suratKeluar->id}}">
<div class="form-group">
        <label for="name" class="col-sm-2 control-label tengah2">Nomor Surat</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="txtNoSurat" value="{{$suratKeluar->no_surat_keluar}}" required="" disabled="" placeholder="Nomor Surat">
        </div>
    </div>
 <div class="form-group">
                    <label for="exampleInputFile" class="col-sm-2 control-label tengah2">File (Scan)</label>
                    <div class="col-md-10">
                    <img src="{{ asset('public/image/scan_surat_keluar/'.$suratKeluar->file) }}" style="width: 100px;padding-left: 3px;" id="profile-img-tag_surat2">
                </div>
            </div>
            <div class="form-group">
                 <label for="exampleInputFile" class="col-sm-2 control-label tengah2">Ganti File</label>
                    <div class="col-md-10">
                    <input type="file" name="txtFile" id="profile-img_surat2" style="padding-top: 10px;padding-left: 3px;">
                </div>
                    
            </div>

@endif 
      
          
<div class="modal-footer" style="border-top: 0px;">
    <button type="submit" class="btn btn-success tombolform">Perbarui</button>
    <a href="javascript:history.go(-1)" class="btn btn-danger tombolform">Batal</a>
</div>
</form>
</div>
</div>
</div>


<!-- MODAL TAMPIL KODE SURAT -->
        <div class="modal fade" id="ModalKodeSurat2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width:800px">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">PILIH KODE SURAT</h4>
                    </div>
                    <div class="modal-body">
                        <table id="lookupKodeSurat2" class="table table-bordered table-hover table-striped">
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
                                    <tr class="pilihKodeSurat2" data-id="{{$o->id}}" data-nama="{{$o->kode_surat}}">
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
            $(document).on('click', '.pilihKodeSurat2', function (e) {
                document.getElementById("KodeSurat2").value = $(this).attr('data-nama');
                $('#ModalKodeSurat2').modal('hide');
            });
            
             $(document).on('click', '.pilihKodeSurat2', function (e) {
                document.getElementById("IdKodeSurat2").value = $(this).attr('data-id');
                $('#ModalKodeSurat2').modal('hide');
            });


            $(document).ready(function() {
            var t = $('#lookupKodeSurat2').DataTable( {
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

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag_surat2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img_surat2").change(function(){
        readURL(this);
    });
</script>
<script type="text/javascript">
    function readURLxx(input) {
        if (input.files && input.files[0]) {
            var readerxx = new FileReader();
            
            readerxx.onload = function (e) {
                $('#profile-img-tag_suratxx').attr('src', e.target.result);
            }
            readerxx.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img_suratxx").change(function(){
        readURLxx(this);
    });
</script>
@endsection