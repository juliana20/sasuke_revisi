<section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel" style="border: 0px solid #ddd;background-color: #0e1315">
        <div class="pull-left image">
          <img src="{{ url('public/image/foto_staff/'.Session::get('foto')) }}" class="img-circle" alt="User Image" >
        </div>

        <div class="pull-left info">
          <p>{{Session::get('jabatan')}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> {{Session::get('nama_pegawai')}}</a>
        </div>

      </div>


      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
         
       <!--  <li class="header">MASTER DATA</li> -->
       <!-- JIKA STATUS LOGIN WAKIL KEPALA -->
        @if((Session::get('user_tipe')=='Wakil Kepala'))
          <li class="{{ Request::is('dashboard')?'active':null}}"><a href="{{url('/dashboard')}}"><i class="fa fa-university"></i><span> Dashboard</span></a></li>
          <li class="{{ Request::is('surat_masuk')?'active':null}} {{ Request::is('surat_masuk/create')?'active':null}}"><a href="{{url('/surat_masuk')}}"><i class="fa fa-envelope"></i> <span>Surat Masuk</span></a></li>
          <li class="{{ Request::is('surat_keluar')?'active':null}} {{ Request::is('surat_keluar/create')?'active':null}}"><a href="{{url('/surat_keluar')}}"><i class="fa fa-paper-plane-o"></i> <span>Surat Keluar</span></a></li>
        @else
          <li class="{{ Request::is('dashboard')?'active':null}}"><a href="{{url('/dashboard')}}"><i class="fa fa-university"></i><span> Dashboard</span></a></li>
          <!-- <li class="header">MASTER DATA</li> -->
          <li class="treeview {{ Request::is('admin')?'active':null}} {{ Request::is('kepala_sekolah')?'active':null}} {{ Request::is('wakil_kepala')?'active':null}}">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('admin')?'active':null}}"><a href="{{url('/admin')}}"><i class="fa fa-user"></i> <span>Admin</span></a></li>
            <li class="{{ Request::is('kepala_sekolah')?'active':null}}"><a href="{{url('/kepala_sekolah')}}"><i class="fa fa-user"></i> <span>Kepala Sekolah</span></a></li>
            <li class="{{ Request::is('wakil_kepala')?'active':null}}"><a href="{{url('/wakil_kepala')}}"><i class="fa fa-user"></i> <span>Wakil Kepala</span></a></li>
          </ul>
        </li>
        <li class="{{ Request::is('surat_masuk')?'active':null}} {{ Request::is('surat_masuk/create')?'active':null}}"><a href="{{url('/surat_masuk')}}"><i class="fa fa-envelope"></i> <span>Surat Masuk</span></a></li>
        <li class="{{ Request::is('surat_keluar')?'active':null}} {{ Request::is('surat_keluar/create')?'active':null}}"><a href="{{url('/surat_keluar')}}"><i class="fa fa-paper-plane-o"></i> <span>Surat Keluar</span></a></li>
        @if((Session::get('user_tipe')=='Admin'))
        <li class="{{ Request::is('kode_surat')?'active':null}}"><a href="{{url('kode_surat')}}"><i class="fa fa-list-alt"></i> <span>Kode Surat</span></a></li>
        @else
        @endif
         <!--  <li class="header">LAPORAN</li> -->
        <li class="treeview {{ Request::is('laporan_surat_masuk')?'active':null}} {{ Request::is('laporan_surat_keluar')?'active':null}}">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('laporan_surat_masuk')?'active':null}}"><a href="{{url('/laporan_surat_masuk')}}"><i class="fa fa-file-text-o"></i> <span>Surat Masuk</span></a></li>
            <li class="{{ Request::is('laporan_surat_keluar')?'active':null}}"><a href="{{url('/laporan_surat_keluar')}}"><i class="fa fa-file-text-o"></i> <span>Surat Keluar</span></a></li>
          </ul>
        </li>
        @endif
        
      </ul>
      <!-- /.sidebar-menu -->
</section>