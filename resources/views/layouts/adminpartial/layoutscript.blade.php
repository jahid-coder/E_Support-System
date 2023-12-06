
<!-- jQuery -->
<script src="{{asset('/')}}backend/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/')}}backend/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('/')}}backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('/')}}backend/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('/')}}backend/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('/')}}backend/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('/')}}backend/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('/')}}backend/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('/')}}backend/plugins/moment/moment.min.js"></script>
<script src="{{asset('/')}}backend/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('/')}}backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('/')}}backend/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('/')}}backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('/')}}backend/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('/')}}backend/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('/')}}backend/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="{{asset('/')}}backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('/')}}backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('/')}}backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('/')}}backend/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('/')}}backend/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('/')}}backend/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('/')}}backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('/')}}backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('/')}}backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Toastr and sweetalert -->
<script type="text/javascript" src="{{asset('/')}}backend/plugins/toastr/toastr.min.js"></script>
<script src="{{asset('/')}}backend/plugins/sweetalert/sweetalert.min.js"></script>
<script src="{{asset('/')}}backend/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">

@stack('script')
<script>
      $(document).on("click",".delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        console.log('delete world!');
        swal({
          title:"Are you want to delete",
          text:"Once Delete, This will be Parmanently Delete!",
          icon:"warnig",
          buttons:true,
          dangerMode: true,
        })
        .then((willDelete)=>{
            if(willDelete){
              window.location.href = link;
            }else{
              swal("Safe Data!");
            }
        });
      });
</script>

<script>
    @if(Session:: has('messege'))
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
        case 'info':
          toastr.info("{{Session::get('messege')}}");
          break;
        case 'success':
          toastr.success("{{Session::get('messege')}}");
          break;
        case 'warning':
          toastr.warning("{{Session::get('messege')}}");
          break;
        case 'error':
          toastr.error("{{Session::get('messege')}}");
          break;
      }
    @endif
</script>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>

<script type="text\javascript">
      $(document).ready(function(){
        console.log('hello world!');
      });
  </script>

