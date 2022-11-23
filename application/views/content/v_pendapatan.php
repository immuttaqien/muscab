<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

switch($page){

case 'index':
?>

<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Data Pendapatan <a href="<?php echo base_url('pendapatan/tambah') ?>" class="btn btn-primary" style="float:right">+ Tambah</a></h2>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <?php
        if($this->session->flashdata()){
            echo '<div class="alert alert-'.$this->session->flashdata('type').' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$this->session->flashdata('message').'</div>';
        }            
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Daftar Data Pendapatan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pendapatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach($pendapatan as $list){
                            echo '<tr>
                                    <td class="center" width="10">'.$i.'</td>
                                    <td>'.$list->nama.'</td>
                                    <td class="center">'.anchor('pendapatan/edit/'.$list->pendapatan_id, 'Edit').' | '.anchor('pendapatan/hapus_pendapatan/'.$list->pendapatan_id, 'Hapus', 'onclick="return confirm(\'Apakah Anda yakin akan menghapus data pendapatan ini ?\')"').'</td>
                                 </tr>';
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<?php
break;

case 'tambah':
?>

<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Tambah Data Pendapatan <a href="<?php echo base_url('pendapatan') ?>" class="btn btn-primary" style="float:right"><i class="fa fa-angle-double-left"></i> Kembali</a></h2>
    </div>
    <!-- /.col-lg-12 -->
</div>

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
                Form Tambah Data Pendapatan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo form_open('pendapatan/tambah_pendapatan'); ?>
                            <div class="form-group">
                                <label>Nama Pendapatan</label>
                                <input type="text" class="form-control" name="nama" required="">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <button type="reset" class="btn btn-default">Reset</button>
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

case 'edit':
?>

<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Edit Data Pendapatan <a href="<?php echo base_url('pendapatan') ?>" class="btn btn-primary" style="float:right"><i class="fa fa-angle-double-left"></i> Kembali</a></h2>
    </div>
    <!-- /.col-lg-12 -->
</div>

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
                Form Edit Data Pendapatan
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo form_open('pendapatan/edit_pendapatan/'.$edit->pendapatan_id); ?>
                            <div class="form-group">
                                <label>Nama Pendapatan</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $edit->nama ?>" required="">
                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
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
} 
?>