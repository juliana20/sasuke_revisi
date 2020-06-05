<html>
<head>
<title>SASUKE |     Login    </title>
   <link rel="shortcut icon" href="{{url('public/image/House.ico')}}">
    {!! Html::style('public/assets/plugin/bootstrap/dist/css/bootstrap.min.css') !!}
   <link rel="stylesheet" type="text/css" href="{{ url('public/css/login/AdminLTE.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ url('public/css/login/ionicons.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ url('public/css/login/goggle_font.css')}}"> 
   <link rel="stylesheet" href="{{ url('public/css/login/font-awesome.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ url('public/css/login/adds.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ url('public/css/login/jquery-ui.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ url('public/css/login/cmxform.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ url('public/css/login/pace.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ url('public/css/login/select2.css')}}">

   <script src="{{ url('public/js/jquery.js')}}"></script>
   {!! Html::style('public/css/toastr.min.css') !!}
   <script type="text/javascript" src="{{url('public/js/toastr.min.js')}}"></script>

   <script src="{{ url('public/js/login/jquery.min.js')}}"></script>
   <script src="{{ url('public/js/login/bootstrap.min.js')}}"></script>

</head>
<body class="hold-transition" style="background-image: url('public/image/company-profile.jpg')">
<script type="text/javascript">
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>
<div class="login-box" style="border: 1px solid #ddd;padding: 3px;">
  <p class="login-box-msg"><h3 align="center">SMK (SMEA) SARASWATI 1 DENPASAR</h3></p>
        <div class="login-logo">
            <img src="{{url('public/image/logo_smk.jpg')}}" width="220">
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">  
            <form action="{{url('/login_post')}}" method="post">
                 {{ csrf_field() }}
                <div class="form-group has-feedback ">
                    <input type="text" name="txtUsername" class="form-control" placeholder="Username" required="" autofocus autocomplete="off">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback ">
                    <input type="password" name="txtPassword" class="form-control" placeholder="Password" required="">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
               <!--  <div class="form-group has-feedback ">
                    <select name="txtStatus" class="form-control" required="" value="{{ old('txtStatus') }}">
                        <option value="" disabled selected hidden>- Jabatan - </option>
                        <option value="Admin">Admin</option>
                        <option value="Kepala Sekolah">Kepala Sekolah</option>
                        <option value="Waka Humas">Waka Humas</option>
                        <option value="Waka Kesiswaan">Waka Kesiswaan</option>
                        <option value="Waka Kurikulum">Waka Kurikulum</option>
                        <option value="Waka Sarana Prasarana">Waka Sarana Prasarana</option>
                        <option value="Kaprog AK">Kaprog AK</option>
                        <option value="Kaprog AP">Kaprog AP</option>
                        
                    </select>
                </div> -->
                <div class="row">
                    <div class="col-xs-8">
                        <div>
                            <label>
                               <!--  <input type="checkbox" name="remember"> Ingat Saya -->
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat"> Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </div>


</body>
</html>