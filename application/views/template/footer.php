<?php $uri = $this->uri->segment(1); ?>

<!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="<?php echo base_url().'asset/plugins/jquery/jquery.min.js' ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url().'asset/plugins/jquery-ui/jquery-ui.min.js' ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url().'asset/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url().'asset/plugins/chart.js/Chart.min.js' ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url().'asset/plugins/sparklines/sparkline.js' ?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url().'asset/plugins/jqvmap/jquery.vmap.min.js' ?>"></script>
<script src="<?php echo base_url().'asset/plugins/jqvmap/maps/jquery.vmap.usa.js' ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url().'asset/plugins/jquery-knob/jquery.knob.min.js' ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url().'asset/plugins/moment/moment.min.js' ?>"></script>
<script src="<?php echo base_url().'asset/plugins/daterangepicker/daterangepicker.js' ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url().'asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js' ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url().'asset/plugins/summernote/summernote-bs4.min.js' ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url().'asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js' ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'asset/dist/js/adminlte.js' ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url().'asset/dist/js/pages/dashboard.js' ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'asset/dist/js/demo.js' ?>"></script>
<script src="<?php  echo base_url(). 'asset/sweet_alert/sweet_alert.js' ?>"></script>

<!-- src js datatables -->
<script type="text/javascript" src="<?php echo base_url().'asset/datatables/media/js/dataTables.bootstrap.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'asset/datatables/media/js/jquery.dataTables.js' ?>"></script>


<script type="text/javascript">
    $(document).ready(function() {
    
      var  uri = "<?php echo $uri; ?>";
      if (uri == 'list-terima-sm' ) {
         getSMPOS();
      } else {
         $('#myTable').DataTable();
      }
 
    });

    function getExit() {
      swal({
        text: "Apakah anda ingin logout ? ",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
              url : "<?php echo base_url().'login/doLogout' ?>",
            success:function(res){
                window.location.href="<?php echo base_url().'login' ?>";
            }
              });
          
        } else {
          swal("Data masih tersimpan");
        }
      });
    }
 
</script>