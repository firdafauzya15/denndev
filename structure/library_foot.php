  <script>
    function toggle(source) {
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
          checkboxes[i].checked = source.checked;
      }
    }
    </script>
    
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
      <script>
        $(function () {
          $(".select2").select2();

          var datepicker = $.fn.datepicker.noConflict();
          $.fn.bootstrapDP = datepicker;  
          $("#datepicker").bootstrapDP({
            format: 'yyyy-mm-dd'
          });

          $("#datepicker2").bootstrapDP({
            format: 'yyyy-mm-dd'
          });

          $("#datepicker3").bootstrapDP({
            format: 'yyyy-mm-dd'
          });

          $("#example1").DataTable();

          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
          });
        });
      </script>
  </body>
</html>