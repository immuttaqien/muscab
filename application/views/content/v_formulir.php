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
                Konfirmasi Kehadiran Peserta
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

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Form Inventarisasi Data Pokok Anggota Pemuda Persis Cabang Banjaran</h2>
    </div>
</div>

<?php
if($this->session->flashdata()){
    echo '<div class="alert alert-'.$this->session->flashdata('type').' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$this->session->flashdata('message').'</div>';
}            
?>

<?php
break;
} 
?>