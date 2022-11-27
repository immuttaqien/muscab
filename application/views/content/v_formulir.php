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
                Pendaftaran Peserta Muscab
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo form_open('formulir/simpan_kehadiran'); ?>
                            <!-- <h3>Data Pribadi</h3> -->
                            <div class="form-group">
                                <label>Nama Anggota</label>
                                <input id="nama" type="text" class="form-control" name="nama" required>
                                <input id="anggota_id" type="hidden" name="anggota_id" required>
                            </div>
                            <div class="form-group">
                                <label>NPA</label>
                                <input id="npa" readonly type="text" class="form-control" name="npa">
                            </div>
                            <div class="form-group">
                                <label>Pimpinan Jama'ah</label>
                                <input id="jamaah" readonly type="text" class="form-control" name="jamaah">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" type="email" class="form-control" name="email" required="">
                            </div>
                            <div class="form-group">
                                <label>Nomor HP Aktif</label>
                                <input id="handphone" type="number" class="form-control" name="handphone" required="">
                            </div>
                            <div class="form-group">
                                <label style="display:block;">Hadir Muscab</label>
                                <label class="radio-inline">
                                    <input type="radio" name="kehadiran" id="hadir" value="1" checked=""> Hadir
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="kehadiran" id="tidak" value="2"> Tidak Hadir
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="kehadiran" id="ragu" value="3"> Ragu-Ragu
                                </label>
                            </div>
                            <div class="form-group" id="form_alasan" style="display:none">
                                <label>Alasan</label>
                                <textarea id="alasan" name="alasan" class="form-control" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a id="download" class="btn btn-success" href="<?php echo base_url('formulir/download/1'); ?>" style="float: right; display: none;">Download</a>
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
                            <label>NPA</label>
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