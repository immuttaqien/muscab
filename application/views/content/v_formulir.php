<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

switch($page){

case 'index':
?>

<!-- <div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Konfirmasi Kehadiran Peserta</h2>
    </div>
</div> -->

<?php
if($this->session->flashdata()){
    echo '<div class="alert alert-'.$this->session->flashdata('type').' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$this->session->flashdata('message').'</div>';
}            
?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Pengecekan Peserta Muscab
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo form_open('formulir/cek_kehadiran'); ?>
                            <!-- <h3>Data Pribadi</h3> -->
                            <center><img id="qrcode" style="display: none; width: 100px"></center>
                            <div class="form-group">
                                <label>Nama Anggota</label>
                                <input id="nama" type="text" class="form-control" name="nama" required>
                                <input id="anggota_id" type="hidden" name="anggota_id" required>
                            </div>
                            <div class="form-group">
                                <label>NIAT</label>
                                <input id="npa" readonly type="text" class="form-control" name="npa">
                            </div>
                            <div class="form-group">
                                <label>Pimpinan Jama'ah</label>
                                <input id="jamaah" readonly type="text" class="form-control" name="jamaah">
                            </div>
                            <div class="form-group">
                                <label>Check In</label>
                                <input id="checkin" readonly type="text" class="form-control" name="checkin">
                            </div>
                            <div class="form-group">
                                <label>Pemilihan</label>
                                <input id="election" readonly type="text" class="form-control" name="election">
                            </div>
                            <!-- <button type="submit" class="btn btn-success">Lihat</button> -->
                            <!-- <a id="download" class="btn btn-success" href="<?php echo base_url('formulir/download/1'); ?>" style="float: right; display: none;">Download</a> -->
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<?php
break;

case 'detail':
?>

<!-- <div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Form Inventarisasi Data Pokok Anggota Pemuda Persis Cabang Banjaran</h2>
    </div>
</div> -->

<?php
if($this->session->flashdata()){
    echo '<div class="alert alert-'.$this->session->flashdata('type').' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$this->session->flashdata('message').'</div>';
}            
?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Detail Kehadiran Peserta
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <!-- <h3>Data Pribadi</h3> -->
                        <div class="form-group">
                            <label>NIAT</label>
                            <p class="form-control-static" style="display: inline-block; float: right;"><?php echo $detail->npa ?></p>
                        </div>
                        <div class="form-group">
                            <label>Nama Anggota</label>
                            <p class="form-control-static" style="display: inline-block; float: right;"><?php echo $detail->nama_lengkap ?></p>
                        </div>
                        <div class="form-group">
                            <label>Pimpinan Jama'ah</label>
                            <p class="form-control-static" style="display: inline-block; float: right;"><?php echo $detail->jamaah ?></p>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <p class="form-control-static" style="display: inline-block; float: right;"><?php echo $detail->email ?></p>
                        </div>
                        <div class="form-group">
                            <label>Nomor HP Aktif</label>
                            <p class="form-control-static" style="display: inline-block; float: right;"><?php echo $detail->handphone ?></p>
                        </div>
                        <div class="form-group">
                            <p class="form-control-static" style="display: inline-block;">
                                <b>Check In Peserta</b><br>
                                Hari, Tanggal : Ahad, 18 Desember 2022<br>
                                Waktu : 06:00 - 07:00 WIB<br>
                                Lokasi : Aula Pesantren Persis 31 Banjaran
                            </p>
                            <p class="form-control-static" style="display: inline-block; float: right; text-align: right;">
                                <b>Pakaian</b><br>
                                Kemeja Batik<br>
                                Celana Panjang<br>
                                Bersepatu
                            </p>
                        </div>
                        <p class="text-center"><img width="120" src="<?php echo base_url('media/qrcode/'.$detail->qrcode) ?>"></p>
                        <p class="text-center">Silakan klik tombol Download untuk mendapatkan bukti konfirmasi kehadiran peserta.</p>
                        <hr>
                        <!-- <div class="form-group">
                            <label style="display:block;">Hadir Muscab</label>
                            <p class="form-control-static" style="display: inline-block; float: right;"><?php echo $detail->kehadiran ?></p>
                        </div> -->
                        <!-- <div class="form-group" id="form_alasan" style="display:none">
                            <label>Alasan</label>
                            <p class="form-control-static"><?php echo $detail->alasan ?></p>
                        </div> -->
                        <a class="btn btn-default" href="<?php echo base_url(); ?>">Kembali</a>
                        <a class="btn btn-success" href="<?php echo base_url('formulir/download/'.$detail->anggota_id); ?>" style="float: right;">Download</a>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<?php
break;
} 
?>