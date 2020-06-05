{!! Html::script('public/assets/plugin/jquery/dist/jquery.min.js') !!}
{!! Html::script('public/assets/plugin/bootstrap/dist/js/bootstrap.min.js') !!}
{!! Html::script('public/assets/dist/js/adminlte.min.js') !!}
{!! Html::script('public/assets/dist/js/demo.js') !!}
{!! Html::script('public/assets/plugin/datatables/jquery.dataTables.min.js') !!}
{!! Html::script('public/assets/plugin/datatables/dataTables.bootstrap.min.js') !!}
{!! Html::script('public/assets/plugin/datatables/dataTables.responsive.min.js') !!}
{!! Html::script('public/assets/plugin/datatables/responsive.bootstrap.min.js') !!}
{!! Html::script('public/assets/select2/select2.min.js') !!}
{!! Html::script('public/assets/main.js') !!}
{!! Html::script('public/assets/penjualan.js') !!}
{!! Html::script('public/assets/dist/js/bootstrap-datepicker.min.js') !!}
{!! Html::script('public/js/dataTables.buttons.min.js') !!}
{!! Html::script('public/js/buttons.flash.min.js') !!}
{!! Html::script('public/js/jszip.min.js') !!}
{!! Html::script('public/js/pdfmake.min.js') !!}
{!! Html::script('public/js/vfs_fonts.js') !!}
{!! Html::script('public/js/buttons.html5.min.js') !!}
{!! Html::script('public/js/buttons.print.min.js') !!}
{!! Html::script('public/js/fileinput.js') !!}
{!! Html::script('public/js/theme.js') !!}
{!! Html::script('public/js/popper.min.js') !!}


<script type="text/javascript" src="{{url('public/js/loading.js')}}"></script>
<script type="text/javascript">
 $(function(){
  $(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
  });
 });
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="modal"]').tooltip();   
});
</script>
