<!-- REQUIRED JS SCRIPTS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

<!-- jQuery 2.1.4 -->

<!-- Bootstrap 3.3.2 JS -->

<!-- AdminLTE App -->
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>

<!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
     This must be loaded before fileinput.min.js -->
<script src="js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
     This must be loaded before fileinput.min.js -->
<script src="js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
     This must be loaded before fileinput.min.js -->
<script src="js/plugins/purify.min.js" type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="js/fileinput.min.js"></script>
<script src="js/locales/es.js"></script>
<!-- bootstrap.js below is needed if you wish to zoom and view file content
     in a larger detailed modal dialog -->
     <script type="text/javascript" src="js/moment.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
<!-- optionally if you need a theme like font awesome theme you can include
    it as mentioned below -->
    <!-- bootstrap time picker -->

    <script type="text/javascript" src="js/transition.js"></script>
    <script type="text/javascript" src="js/collapse.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>


<script src="plugins/select2/select2.full.min.js"></script>



<script src="themes/fa/theme.js"></script>
<script src="js/locales/ar.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
$('#msjsnuevos').load("{!!url('/actualizarcontador')!!}");
$(document).ready(function(){
setInterval(msjsf,15000);
});
function msjsf() {
$('#msjsnuevos').load("{!!url('/actualizarcontador')!!}");
}



$("#input-700").fileinput({
    language: "es",
    uploadUrl: "http://localhost/file-upload-single/1", // server upload action
    uploadAsync: true,
    maxFileCount: 10
});

    $(function () {
        $('#datetimepicker1').datetimepicker({

        });
        $(".select2").select2();
        $('#datetimepicker2').datetimepicker();
    });


</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
