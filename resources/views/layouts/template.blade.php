<!DOCTYPE html>
<html>
	@include('layouts.head')
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('layouts.top')
		<aside class="main-sidebar">
			@include('layouts.left')
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<div>
     <!-- -->
      </div>
		      @yield('bread')
   			</section>
   			<section class="content container-fluid">
  
		      @yield('content')
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

		    </section>
		</div>
		<footer class="main-footer">
    		<strong> Copyright &copy; 2019</strong> SASUKE
  		</footer>
  		@include('layouts.right')

	</div>
	@include('layouts.foot')@stack('scripts')

	@stack('scripts')

</body>
</html>