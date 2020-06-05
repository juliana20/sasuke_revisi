
<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SSK</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{ url('public/image/logo_smk.png') }}" style="width: 45px;"><b>SASUKE</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          @if(Session::get('user_tipe')=='Admin')
                    <li class="dropdown notifications-menu">
                        <!-- NOTIFIKASI -->
                         <?php
                          include ('public/config/config.php');
                          $query = "SELECT count(id) as notif FROM tb_surat_masuk where status_dikirim=0 and tindak_lanjut!=0 and disposisi!=0";
                          $hasil = mysqli_query($conn,$query);
                          $data  = mysqli_fetch_array($hasil);

                          $query2 = "SELECT count(id) as notif2 FROM tb_surat_masuk where status_dikirim=0 and tindak_lanjut=0 and disposisi=0";
                          $hasil2 = mysqli_query($conn,$query2);
                          $data2  = mysqli_fetch_array($hasil2);

                          $query3 = "SELECT count(id) as notif3 FROM tb_surat_keluar where no_surat_keluar is NULL";
                          $hasil3 = mysqli_query($conn,$query3);
                          $data3  = mysqli_fetch_array($hasil3);

                          $query4 = "SELECT count(id) as notif4 FROM tb_surat_masuk where sudah_dibaca=1";
                          $hasil4 = mysqli_query($conn,$query4);
                          $data4  = mysqli_fetch_array($hasil4);
                          ?>


                          
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-bell-o"></i>
                          <span class="label label-primary sum_notif">
                             <?php echo $data['notif']+$data2['notif2']+$data3['notif3']+$data4['notif4']; ?>
                          </span>
                        </a>
                        <ul class="dropdown-menu">
                           <li class="" style="padding: 0px;border-radius: 0px;">
                              <a href="{{url('daftar_belum_dikirim')}}" style="padding: 8px;">
                              <?php echo $data['notif']; ?> Surat belum dikirim!
                              </a>
                            </li>
                            <li class="" style="padding: 0px;border-radius: 0px;border-top: 1px solid #ddd">
                              <a href="{{url('daftar_belum_disposisi')}}" style="padding: 8px;">
                              <?php echo $data2['notif2']; ?> Surat belum disposisi kepala sekolah!
                              </a>
                            </li>
                            <li class="" style="padding: 0px;border-radius: 0px;border-top: 1px solid #ddd">
                              <a href="{{url('belum_isi_no_surat')}}" style="padding: 8px;">
                              <?php echo $data3['notif3']; ?> Surat dari WAKA!
                              </a>
                            </li>

                            <li class="" style="padding: 0px;border-radius: 0px;border-top: 1px solid #ddd">
                              <a href="{{url('surat_masuk')}}" style="padding: 8px;">
                              <?php echo $data4['notif4']; ?> Surat sudah dibaca WAKA!
                              </a>
                            </li>

                          <li>
                            <ul class="menu" id="menu">

                            </ul>
                          </li>
                        </ul>
                      </li>
          @else
           <li class="dropdown notifications-menu">
                        <!-- NOTIFIKASI -->
                         <?php
                          include ('public/config/config.php');
                          ?>
                          @if(Session::get('user_tipe')=='Wakil Kepala')
                          <?php
                          $id=Session::get('id');
                          $query = "SELECT count(id) as notif FROM tb_surat_masuk where sudah_dibaca=0 and tindak_lanjut=$id";
                          ?>
                          @else
                          <?php
                          $query = "SELECT count(id) as notif FROM tb_surat_masuk where disposisi=0";
                          ?>
                          @endif
                          <?php
                          $hasil = mysqli_query($conn,$query);
                          $data  = mysqli_fetch_array($hasil);
                          ?>
                          
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                          <i class="fa fa-bell-o"></i>
                          <span class="label label-primary sum_notif">
                            @if(Session::get('user_tipe')=='Kepala Sekolah')
                             <?php echo $data['notif']; ?>
                            @elseif(Session::get('user_tipe')=='Wakil Kepala')
                              <?php echo $data['notif']; ?>
                            @else
                            @endif
                          </span>
                        </a>
                        <ul class="dropdown-menu">
                          @if(Session::get('user_tipe')=='Kepala Sekolah')
                          <li class="" style="padding: 0px;border-radius: 0px;"><a href="{{url('daftar_belum_disposisi')}}" style="padding: 8px;">
                              <?php echo $data['notif']; ?> Surat belum disposisi!
                             </a></li>
                          @elseif(Session::get('user_tipe')=='Wakil Kepala')
                           <li class="" style="padding: 0px;border-radius: 0px;"><a href="{{url('daftar_belum_dibaca')}}" style="padding: 8px;">
                              <?php echo $data['notif']; ?> Surat belum dibaca!
                             </a></li>
                            
                          @else

                          @endif
                          <li>
                            <ul class="menu" id="menu">

                            </ul>
                          </li>
                        </ul>
                      </li>
                      @endif
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{ url('public/image/foto_staff/'.Session::get('foto')) }}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{Session::get('username')}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{ url('public/assets/dist/img/user.png') }}" class="img-circle" alt="User Image">

                <p>
                  <small>{{Session::get('nama_pegawai')}}</small> 
                  <small>{{Session::get('jabatan')}}</small>
                  
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('/akun/'.Session::get('id_pegawai'))}}" class="btn btn-default btn-flat">Akun</a>
                </div>
                <div class="pull-right">
                  <a href="{{url('logout')}}" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>