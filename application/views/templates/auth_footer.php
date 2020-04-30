 <!-- Bootstrap core JavaScript-->
 <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
 <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

 <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/jquery-ui/jquery-ui.css">

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <script>
     $(function() {
         $("#tanggallahir").datepicker({
             changeMonth: true,
             changeYear: true,
             yearRange: '1950:2020',
             format: 'yyyy-mm-dd',
             autoclose: true,
             todayHighlight: true,
         });
     });
 </script>

 </body>


 </html>