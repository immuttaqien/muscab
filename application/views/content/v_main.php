<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div id="page-wrapper" style="margin:0">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dasbor</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Persentase Kehadiran Pimpinan Jamaah
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="kehadiran"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>

<!-- <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Persentase Kehadiran Keseluruhan
            </div>
            <div class="panel-body">
                <div id="keseluruhan"></div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Kehadiran Pimpinan Jamaah
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">No</th>
                            <th class="center">Pimpinan Jamaah</th>
                            <th class="center">Hadir</th>
                            <th class="center">Tidak Hadir</th>
                            <th class="center">Pemilihan</th>
                            <th class="center">Jumlah Anggota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1; $total_hadir = 0; $total_tidak = 0; $total_anggota = 0; $total_pemilihan = 0;
                        foreach($data_jamaah as $data){
                            $total_hadir += $data->hadir;
                            $total_tidak += $data->tidak;
                            $total_pemilihan += $data->pemilihan;
                            $total_anggota += $data->total;

                            echo '<tr>
                                    <td class="center" width="10">'.$i.'</td>
                                    <td>'.$data->jamaah.'</td>
                                    <td class="center">'.$data->hadir.'</td>
                                    <td class="center">'.$data->tidak.'</td>
                                    <td class="center">'.$data->pemilihan.'</td>
                                    <td class="center">'.$data->total.'</td>
                                 </tr>';
                            $i++;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="center" colspan="2">Total Keseluruhan</th>
                            <th class="center"><?php echo $total_hadir ?></th>
                            <th class="center"><?php echo $total_tidak ?></th>
                            <th class="center"><?php echo $total_pemilihan ?></th>
                            <th class="center"><?php echo $total_anggota ?></th>
                        </tr>
                    </tfoot>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>