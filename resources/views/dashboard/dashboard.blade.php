@extends('layouts.template')

 <?php 
 $title="Dashboard | ";
 ?>
@section('content') <!-- Content Wrapper. Contains page content -->
        <div class="preloader">
      <div class="loading">
        <img src="{{url('public/image/loading.gif')}}" width="80">
        <p>Harap Tunggu</p>
      </div>
    </div>
    <!-- Main content -->
      <!-- Small boxes (Stat box) -->
      <div class="row kotak" style="padding: 200px;">
        <!-- <h4 align="center" style="color: green;font-size: 21px;padding: 20px;margin-bottom: 0px"><b>SELAMAT DATANG <br><br>
          DI SIGASOM GARASI SHCOOL</b><hr>
        </h4> -->
      
        <div class="col-6">

        <div class="col-lg-6 col-xs-3">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$jumlahSuratMasuk}}</h3>

              <p>Jumlah Surat Masuk</p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </div>
            <a href="{{url('surat_masuk')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- col -->
         <div class="col-lg-6 col-xs-3">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$jumlahSuratKeluar}}</h3>

              <p>Jumlah Surat Keluar</p>
            </div>
            <div class="icon">
              <i class="fa fa-envelope-open" aria-hidden="true"></i>
            </div>
            <a href="{{url('surat_keluar')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        


<!--     <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border" style="background-color: transparent;">


            </div>
          


    </section> -->





       </div>
<!-- // koneksi ke mysql -->
<!--  -->
      @endsection