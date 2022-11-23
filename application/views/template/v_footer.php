<?php if(!defined('BASEPATH')) exit('No direct script access allowed') ?>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('static/vendor/jquery/jquery.min.js') ?>"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('static/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url('static/vendor/metisMenu/metisMenu.min.js') ?>"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url('static/vendor/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('static/vendor/datatables-plugins/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('static/vendor/datatables-responsive/dataTables.responsive.js') ?>"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('static/dist/js/sb-admin-2.js') ?>"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>

$(document).ready(function() {
    var base_url = window.location.origin;
    
    $('#dataTables-example').DataTable({
        responsive: true
    });

    $('#pekerjaan').on('change',function(){
        var pekerjaanId = $(this).val();
        if(pekerjaanId==6){
            $('#lainnya').show();
        }else{
            $('#lainnya').hide();
        }
    });

    $("input[type='radio']").click(function(){
        var kehadiran = $("input[name='kehadiran']:checked").val();
        if(kehadiran==1){
            $('#form_alasan').hide();
        }else{
            $('#form_alasan').show();
        }
    });
});

$( function() {
    var anggota = [
        <?php
        foreach($anggota as $list){
            echo '"'.$list->nama_lengkap.'", ';
        }
        ?>
    ];
    $( "#nama" ).autocomplete({
      source: anggota
    });
  } );
</script>

</body>

</html>
