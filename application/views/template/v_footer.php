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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

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
            $("#alasan").prop('required', false);
        }else{
            $('#form_alasan').show();
            $("#alasan").prop('required', true);
        }
    });

    // $('.lihat').click(function(){
    // $('.lihat').on('click',function(){
    $('#dataTables-example').on('click', '.lihat', function(){
        var anggota_id = $(this).attr("anggota_id");

        $.ajax({
            url: '<?php echo base_url('anggota/lihat_alasan'); ?>',
            method: 'post',
            data: {anggota_id:anggota_id},
            success:function(data){
                $('#myModal').modal("show");
                $('#tampil_modal').html(data);            
            }
        });
    });
});

$( function() {
    var anggota = [
        <?php
        if(isset($anggota)){
            foreach($anggota as $list){
                // echo '"'.$list->nama_lengkap.'", ';
                echo '{
                        value: "'.$list->anggota_id.'",
                        label: "'.$list->nama_lengkap.'",
                        npa: "'.$list->npa.'",
                        jamaah: "'.$list->jamaah.'"
                      }, ';
            }
        }
        ?>
    ];
    $( "#nama" ).autocomplete({
      // source: anggota
      minLength: 0,
      source: anggota,
      focus: function( event, ui ) {
        $( "#nama" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#nama" ).val( ui.item.label );
        $( "#anggota_id" ).val( ui.item.value );
        $( "#npa" ).val( ui.item.npa );
        $( "#jamaah" ).val( ui.item.jamaah );
 
        return false;
      }
    });
  } );
</script>

<script type="text/javascript">
Highcharts.chart('kehadiran', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
            <?php
            if(isset($stat_jamaah)){                
                foreach($stat_jamaah as $jamaah){
                    $persen = ($jamaah->hadir/$jumlah_anggota)*100;

                    echo '{
                        name: "'.$jamaah->jamaah.'",
                        y: '.$persen.'
                    },';
                }
            }
            ?>
        ]
    }]
});

Highcharts.chart('keseluruhan', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
            {
                name: 'Hadir',
                y: <?php if(isset($stat_seluruh)) echo ($stat_seluruh->hadir/$jumlah_anggota)*100; else echo 0; ?>
            }, {
                name: 'Tidak Hadir',
                y: <?php if(isset($stat_seluruh)) echo ($stat_seluruh->tidak/$jumlah_anggota)*100; else echo 0; ?>
            },  {
                name: 'Ragu-Ragu',
                y: <?php if(isset($stat_seluruh)) echo ($stat_seluruh->ragu/$jumlah_anggota)*100; else echo 0; ?>
            }, {
                name: 'Belum Konfirmasi',
                y: <?php if(isset($stat_seluruh)) echo ($stat_seluruh->alfa/$jumlah_anggota)*100; else echo 0; ?>
            }
        ]
    }]
});
</script>

</body>

</html>
