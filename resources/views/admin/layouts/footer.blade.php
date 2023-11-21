  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright &copy; 2023 <a href="#">{{ $company->name  }} - Administrator</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ URL::to('/') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::to('/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::to('/') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ URL::to('/') }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Summernote -->
<script src="{{ URL::to('/') }}/plugins/summernote/summernote-bs4.min.js"></script>
{{-- <script src="{{ URL::to('/'); }}/dist/js/demo.js"></script> --}}
<script src="{{ URL::to('/') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ URL::to('/') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ URL::to('/') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ URL::to('/') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ URL::to('/') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ URL::to('/') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ URL::to('/') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ URL::to('/') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ URL::to('/') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ URL::to('/') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ URL::to('/') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ URL::to('/') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{ URL::to('/') }}/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap Switch -->
<script src="{{ URL::to('/') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.summernote').summernote()
    $('#summernote').summernote()
  })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })  
</script>
<script>
  $(function () {
    $("#example1").DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],"responsive": true, "lengthChange": true, "autoWidth": true,
      "buttons": ["copy", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'print',
            'pdfHtml5'
        ],
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": false,        
    } );
    
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })    
});

</script>

</body>
</html>


