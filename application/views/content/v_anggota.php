<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

switch($page){

case 'index':
?>

<div id="page-wrapper" style="margin:0">
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Anggota 
            <a href="<?php echo base_url('anggota/download/'.$jamaah_id) ?>" class="btn btn-primary" style="float:right; margin-right: 5px"><i class="fa fa-download"></i> Download</a>  

            <select class="form-control" onchange="window.location.href='<?php echo base_url('anggota/index/'); ?>'+ this.value" style="width: 13%;margin-right:5px;height:34px;display:inline;float:right">
            <option value="0">Pilih Jamaah</option>
            <?php
            foreach($jamaah as $j){
                echo '<option value="'.$j->jamaah_id.'"'; if($j->jamaah_id==$jamaah_id) echo ' selected'; echo '>'.$j->nama.'</option>';
            }
            ?>
            </select>
        </h2>
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
                Daftar Kehadiran Anggota
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th class="center">No</th>
                            <th class="center">NIAT</th>
                            <th class="center">Nama Lengkap</th>
                            <th class="center">Jamaah</th>
                            <th class="center">Check In</th>
                            <th class="center">Pemilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach($anggota as $list){
                            if($list->checkin==1) $checkin = date('H:i:s', strtotime($list->time_checkin)); else $checkin = '-';
                            if($list->election==1) $election = date('H:i:s', strtotime($list->time_election)); else $election = '-';
                
                            echo '<tr>
                                    <td class="center" width="10">'.$i.'</td>
                                    <td class="center">'.$list->npa.'</td>
                                    <td>'.$list->nama_lengkap.'</td>
                                    <td class="center">'.$list->jamaah.'</td>
                                    <td class="center">'.$checkin.'</td>
                                    <td class="center">'.$election.'</td>
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

<div class="modal fade" id="myModal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="judul">Alasan</h4>
            </div>
            <div class="modal-body" id="tampil_modal"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php
break;

case 'tambah':
?>

<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Tambah Data Anggota <a href="<?php echo base_url('anggota') ?>" class="btn btn-primary" style="float:right"><i class="fa fa-angle-double-left"></i> Kembali</a></h2>
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
                Data Pribadi & Data Keluarga
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo form_open_multipart('anggota/tambah_anggota'); ?>
                            <h3>Data Pribadi</h3>
                            <div class="form-group">
                                <label>Nomor Anggota</label>
                                <input type="text" class="form-control" name="npa">
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" required="">
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" required="">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" required="">
                            </div>
                            <div class="form-group">
                                <label>Status Menikah</label>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input type="radio" name="status_nikah" value="N" checked=""> Belum Menikah
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status_nikah" value="Y"> Menikah
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Golongan Darah</label>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="-" checked=""> -
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="A+"> A+
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="A-"> A-
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="B+"> B+
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="B-"> B-
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="AB+"> AB+
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="AB-"> AB-
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="O"> O
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Aktif</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="number" class="form-control" name="telepon">
                            </div>
                            <div class="form-group">
                                <label>No WhatsApp Aktif</label>
                                <input type="number" class="form-control" name="whatsapp">
                            </div>
                            <div class="form-group">
                                <label>Alamat Tinggal Saat Ini</label>
                                <textarea name="alamat" class="form-control" rows="5" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nomor KTP</label>
                                <input type="number" class="form-control" name="nomor_ktp">
                            </div>
                            <div class="form-group">
                                <label>Tahun Masuk Anggota</label>
                                <input type="number" class="form-control" name="tahun_masuk">
                            </div>
                            <div class="form-group">
                                <label>Jamaah</label>
                                <select class="form-control" name="jamaah" required="">
                                    <option>-- Silakan Pilih</option>
                                    <?php
                                    foreach($jamaah as $j){
                                        echo '<option value="'.$j->jamaah_id.'">'.$j->nama.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hobi</label>
                                <input type="text" class="form-control" name="hobi">
                            </div>
                            <div class="form-group">
                                <label>Keahlian</label>
                                <input type="text" class="form-control" name="keahlian">
                            </div>
                            <div class="form-group">
                                <label>Pekerjaan Pokok</label>
                                <select id="pekerjaan" class="form-control" name="pekerjaan" required="">
                                    <option>-- Silakan Pilih</option>
                                    <?php
                                    foreach($pekerjaan as $k){
                                        echo '<option value="'.$k->pekerjaan_id.'">'.$k->nama.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="lainnya" class="form-group" style="display: none;">
                                <label>Pekerjaan Lainnya</label>
                                <input type="text" class="form-control" name="pekerjaan_lain">
                            </div>
                            <div class="form-group">
                                <label>Nama Instansi Pekerjaan</label>
                                <input type="text" class="form-control" name="nama_instansi">
                            </div>
                            <div class="form-group">
                                <label>Apakah Mempunyai Pekerjaan Sampingan ?</label>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input type="radio" name="sampingan" value="Y" checked=""> Ya
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sampingan" value="N"> Tidak
                                    </label>
                                </div>
                            </div>
                            <div id="pekerjaan_sampingan" class="form-group">
                                <label>Pekerjaan Sampingan</label>
                                <input type="text" class="form-control" name="pekerjaan_sampingan">
                            </div>
                            <div class="form-group">
                                <label>Pendidikan Terakhir</label>
                                <select class="form-control" name="pendidikan" required="">
                                    <option>-- Silakan Pilih</option>
                                    <?php
                                    foreach($pendidikan as $d){
                                        echo '<option value="'.$d->pendidikan_id.'">'.$d->nama.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pendapatan Total Rata-Rata Selama Sebulan</label>
                                <select class="form-control" name="pendapatan" required="">
                                    <option>-- Silakan Pilih</option>
                                    <?php
                                    foreach($pendapatan as $t){
                                        echo '<option value="'.$t->pendapatan_id.'">'.$t->nama.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Berapa Jumlah Tanggungan</label>
                                <select class="form-control" name="tanggungan" required="">
                                    <option>-- Silakan Pilih</option>
                                    <?php
                                    foreach($tanggungan as $g){
                                        echo '<option value="'.$g->tanggungan_id.'">'.$g->nama.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Apakah Anda Menjadi Anggota Organisasi Kemasyarakatan, Intra atau Ekstra Kampus ?</label>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input type="radio" name="organisasi_lain" value="Y" checked=""> Ya
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="organisasi_lain" value="N"> Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" id="nama_organisasi">
                                <label>Jika Iya Sebutkan Nama Organisasinya</label>
                                <input type="text" class="form-control" name="nama_organisasi">
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="foto" class="form-control">
                            </div>

                            <h3>Data Keluarga</h3>
                            <div class="form-group">
                                <label>Nama Istri</label>
                                <input type="text" class="form-control" name="nama_istri">
                            </div>
                            <div class="form-group">
                                <label>Anggota Otonom Persis ?</label>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input type="radio" name="anggota_otonom" value="Y" checked=""> Ya
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="anggota_otonom" value="N"> Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Anak</label>
                                <input type="number" class="form-control" name="jumlah_anak">
                            </div>
                            <button type="submit" class="btn btn-primary">Lanjutkan</button>
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

case 'detail':
?>

<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Detail Data Anggota <a href="<?php echo base_url('anggota') ?>" class="btn btn-primary" style="float:right"><i class="fa fa-angle-double-left"></i> Kembali</a></h2>
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
                Data Pribadi & Data Keluarga
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <h3>Data Pribadi</h3>
                        <div class="form-group">
                            <label>Nomor Anggota</label>
                            <input readonly type="text" class="form-control" name="npa" value="<?php echo $detail->npa ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input readonly type="text" class="form-control" name="nama_lengkap" required="" value="<?php echo $detail->nama_lengkap ?>">
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input readonly type="text" class="form-control" name="tempat_lahir" required="" value="<?php echo $detail->tempat_lahir ?>">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input readonly type="date" class="form-control" name="tanggal_lahir" required="" value="<?php echo $detail->tanggal_lahir ?>">
                        </div>
                        <div class="form-group">
                            <label>Status Menikah</label>
                            <div class="radio">
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="status_nikah" value="N" <?php if($detail->status_nikah=='N') echo ' checked'; ?>> Belum Menikah
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="status_nikah" value="Y" <?php if($detail->status_nikah=='Y') echo ' checked'; ?>> Menikah
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Golongan Darah</label>
                            <div class="radio">
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="golongan_darah" value="-" <?php if($detail->golongan_darah=='-') echo ' checked'; ?>> -
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="golongan_darah" value="A+" <?php if($detail->golongan_darah=='A+') echo ' checked'; ?>> A+
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="golongan_darah" value="A-" <?php if($detail->golongan_darah=='A-') echo ' checked'; ?>> A-
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="golongan_darah" value="B+" <?php if($detail->golongan_darah=='B+') echo ' checked'; ?>> B+
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="golongan_darah" value="B-" <?php if($detail->golongan_darah=='B-') echo ' checked'; ?>> B-
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="golongan_darah" value="AB+" <?php if($detail->golongan_darah=='AB+') echo ' checked'; ?>> AB+
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="golongan_darah" value="AB-" <?php if($detail->golongan_darah=='AB-') echo ' checked'; ?>> AB-
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="golongan_darah" value="O" <?php if($detail->golongan_darah=='O') echo ' checked'; ?>> O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email Aktif</label>
                            <input readonly type="email" class="form-control" name="email" value="<?php echo $detail->email ?>">
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input readonly type="number" class="form-control" name="telepon" value="<?php echo $detail->telepon ?>">
                        </div>
                        <div class="form-group">
                            <label>No WhatsApp Aktif</label>
                            <input readonly type="number" class="form-control" name="whatsapp" value="<?php echo $detail->whatsapp ?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat Tinggal Saat Ini</label>
                            <textarea readonly="" name="alamat" class="form-control" rows="5" required=""><?php echo $detail->alamat ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Nomor KTP</label>
                            <input readonly type="number" class="form-control" name="nomor_ktp" value="<?php echo $detail->nomor_ktp ?>">
                        </div>
                        <div class="form-group">
                            <label>Tahun Masuk Anggota</label>
                            <input readonly type="number" class="form-control" name="tahun_masuk" value="<?php echo $detail->tahun_masuk ?>">
                        </div>
                        <div class="form-group">
                            <label>Jamaah</label>
                            <select readonly class="form-control" name="jamaah" required="">
                                <option>-- Silakan Pilih</option>
                                <?php
                                foreach($jamaah as $j){
                                    echo '<option value="'.$j->jamaah_id.'"'; if($detail->jamaah_id==$j->jamaah_id) echo ' selected'; echo '>'.$j->nama.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hobi</label>
                            <input readonly type="text" class="form-control" name="hobi" value="<?php echo $detail->hobi ?>">
                        </div>
                        <div class="form-group">
                            <label>Keahlian</label>
                            <input readonly type="text" class="form-control" name="keahlian" value="<?php echo $detail->keahlian ?>">
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan Pokok</label>
                            <select readonly id="pekerjaan" class="form-control" name="pekerjaan" required="">
                                <option>-- Silakan Pilih</option>
                                <?php
                                foreach($pekerjaan as $k){
                                    echo '<option value="'.$k->pekerjaan_id.'"'; if($detail->pekerjaan_id==$k->pekerjaan_id) echo ' selected'; echo '>'.$k->nama.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div id="lainnya" class="form-group" <?php if($detail->pekerjaan_id!=6) echo ' style="display: none;"'; ?>>
                            <label>Pekerjaan Lainnya</label>
                            <input readonly type="text" class="form-control" name="pekerjaan_lain" value="<?php echo $detail->pekerjaan_lain ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Instansi Pekerjaan</label>
                            <input readonly type="text" class="form-control" name="nama_instansi" value="<?php echo $detail->nama_instansi ?>">
                        </div>
                        <div class="form-group">
                            <label>Apakah Mempunyai Pekerjaan Sampingan ?</label>
                            <div class="radio">
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="sampingan" value="Y" <?php if($detail->sampingan=='Y') echo ' checked'; ?>> Ya
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="sampingan" value="N" <?php if($detail->sampingan=='N') echo ' checked'; ?>> Tidak
                                </label>
                            </div>
                        </div>
                        <div id="pekerjaan_sampingan" class="form-group" <?php if($detail->sampingan=='N') echo ' style="display: none;"'; ?>>
                            <label>Pekerjaan Sampingan</label>
                            <input readonly type="text" class="form-control" name="pekerjaan_sampingan" value="<?php echo $detail->pekerjaan_sampingan ?>">
                        </div>
                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <select readonly class="form-control" name="pendidikan" required="">
                                <option>-- Silakan Pilih</option>
                                <?php
                                foreach($pendidikan as $d){
                                    echo '<option value="'.$d->pendidikan_id.'" '; if($detail->pendidikan_id==$d->pendidikan_id) echo ' selected'; echo '>'.$d->nama.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pendapatan Total Rata-Rata Selama Sebulan</label>
                            <select readonly class="form-control" name="pendapatan" required="">
                                <option>-- Silakan Pilih</option>
                                <?php
                                foreach($pendapatan as $t){
                                    echo '<option value="'.$t->pendapatan_id.'" '; if($detail->pendapatan_id==$t->pendapatan_id) echo ' selected'; echo '>'.$t->nama.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Berapa Jumlah Tanggungan</label>
                            <select readonly class="form-control" name="tanggungan" required="">
                                <option>-- Silakan Pilih</option>
                                <?php
                                foreach($tanggungan as $g){
                                    echo '<option value="'.$g->tanggungan_id.'" '; if($detail->tanggungan_id==$g->tanggungan_id) echo ' selected'; echo '>'.$g->nama.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Apakah Anda Menjadi Anggota Organisasi Kemasyarakatan, Intra atau Ekstra Kampus ?</label>
                            <div class="radio">
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="organisasi_lain" value="Y" <?php if($detail->organisasi_lain=='Y') echo ' checked'; ?>> Ya
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="organisasi_lain" value="N" <?php if($detail->organisasi_lain=='N') echo ' checked'; ?>> Tidak
                                </label>
                            </div>
                        </div>
                        <div class="form-group" id="nama_organisasi" <?php if($detail->organisasi_lain=='N') echo ' style="display: none;"'; ?>>
                            <label>Jika Iya Sebutkan Nama Organisasinya</label>
                            <input readonly type="text" class="form-control" name="nama_organisasi" value="<?php echo $detail->nama_organisasi ?>">
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <p class="help-block"><?php if($detail->foto) echo '<a target="_blank" href="'.base_url('media/foto/'.$detail->foto).'">Lihat Foto</a>' ?></p>
                        </div>

                        <h3>Data Keluarga</h3>
                        <div class="form-group">
                            <label>Nama Istri</label>
                            <input readonly type="text" class="form-control" name="nama_istri" value="<?php echo $detail->nama_istri ?>">
                        </div>
                        <div class="form-group">
                            <label>Anggota Otonom Persis ?</label>
                            <div class="radio">
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="anggota_otonom" value="Y" <?php if($detail->anggota_otonom=='Y') echo ' checked'; ?>> Ya
                                </label>
                                <label class="radio-inline">
                                    <input disabled="" type="radio" name="anggota_otonom" value="N" <?php if($detail->anggota_otonom=='N') echo ' checked'; ?>> Tidak
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Anak</label>
                            <input readonly type="number" class="form-control" name="jumlah_anak" value="<?php echo $detail->jumlah_anak ?>">
                        </div>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->

        
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Riwayat Pendidikan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tingkat</th>
                            <th>Nama Sekolah</th>
                            <th>Jurusan</th>
                            <th>Tahun Masuk</th>
                            <th>Tahun Lulus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach($riwayat as $list){
                            echo '<tr>
                                    <td class="center" width="10">'.$i.'</td>
                                    <td>'.$list->tingkat.'</td>
                                    <td>'.$list->nama_sekolah.'</td>
                                    <td>'.$list->jurusan.'</td>
                                    <td>'.$list->tahun_masuk.'</td>
                                    <td>'.$list->tahun_lulus.'</td>
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
        <h2 class="page-header">Edit Data Anggota <a href="<?php echo base_url('anggota') ?>" class="btn btn-primary" style="float:right"><i class="fa fa-angle-double-left"></i> Kembali</a></h2>
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
                Data Pribadi & Data Keluarga
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo form_open_multipart('anggota/edit_anggota/'.$anggota_id); ?>
                            <h3>Data Pribadi</h3>
                            <div class="form-group">
                                <label>Nomor Anggota</label>
                                <input type="text" class="form-control" name="npa" value="<?php echo $edit->npa ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" required="" value="<?php echo $edit->nama_lengkap ?>">
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir" required="" value="<?php echo $edit->tempat_lahir ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" required="" value="<?php echo $edit->tanggal_lahir ?>">
                            </div>
                            <div class="form-group">
                                <label>Status Menikah</label>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input type="radio" name="status_nikah" value="N" <?php if($edit->status_nikah=='N') echo ' checked'; ?>> Belum Menikah
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status_nikah" value="Y" <?php if($edit->status_nikah=='Y') echo ' checked'; ?>> Menikah
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Golongan Darah</label>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="-" <?php if($edit->golongan_darah=='-') echo ' checked'; ?>> -
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="A+" <?php if($edit->golongan_darah=='A+') echo ' checked'; ?>> A+
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="A-" <?php if($edit->golongan_darah=='A-') echo ' checked'; ?>> A-
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="B+" <?php if($edit->golongan_darah=='B+') echo ' checked'; ?>> B+
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="B-" <?php if($edit->golongan_darah=='B-') echo ' checked'; ?>> B-
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="AB+" <?php if($edit->golongan_darah=='AB+') echo ' checked'; ?>> AB+
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="AB-" <?php if($edit->golongan_darah=='AB-') echo ' checked'; ?>> AB-
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="golongan_darah" value="O" <?php if($edit->golongan_darah=='O') echo ' checked'; ?>> O
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Aktif</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $edit->email ?>">
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="number" class="form-control" name="telepon" value="<?php echo $edit->telepon ?>">
                            </div>
                            <div class="form-group">
                                <label>No WhatsApp Aktif</label>
                                <input type="number" class="form-control" name="whatsapp" value="<?php echo $edit->whatsapp ?>">
                            </div>
                            <div class="form-group">
                                <label>Alamat Tinggal Saat Ini</label>
                                <textarea name="alamat" class="form-control" rows="5" required=""><?php echo $edit->alamat ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nomor KTP</label>
                                <input type="number" class="form-control" name="nomor_ktp" value="<?php echo $edit->nomor_ktp ?>">
                            </div>
                            <div class="form-group">
                                <label>Tahun Masuk Anggota</label>
                                <input type="number" class="form-control" name="tahun_masuk" value="<?php echo $edit->tahun_masuk ?>">
                            </div>
                            <div class="form-group">
                                <label>Jamaah</label>
                                <select class="form-control" name="jamaah" required="">
                                    <option>-- Silakan Pilih</option>
                                    <?php
                                    foreach($jamaah as $j){
                                        echo '<option value="'.$j->jamaah_id.'"'; if($edit->jamaah_id==$j->jamaah_id) echo ' selected'; echo '>'.$j->nama.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hobi</label>
                                <input type="text" class="form-control" name="hobi" value="<?php echo $edit->hobi ?>">
                            </div>
                            <div class="form-group">
                                <label>Keahlian</label>
                                <input type="text" class="form-control" name="keahlian" value="<?php echo $edit->keahlian ?>">
                            </div>
                            <div class="form-group">
                                <label>Pekerjaan Pokok</label>
                                <select id="pekerjaan" class="form-control" name="pekerjaan" required="">
                                    <option>-- Silakan Pilih</option>
                                    <?php
                                    foreach($pekerjaan as $k){
                                        echo '<option value="'.$k->pekerjaan_id.'"'; if($edit->pekerjaan_id==$k->pekerjaan_id) echo ' selected'; echo '>'.$k->nama.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="lainnya" class="form-group" <?php if($edit->pekerjaan_id!=6) echo ' style="display: none;"'; ?>>
                                <label>Pekerjaan Lainnya</label>
                                <input type="text" class="form-control" name="pekerjaan_lain" value="<?php echo $edit->pekerjaan_lain ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Instansi Pekerjaan</label>
                                <input type="text" class="form-control" name="nama_instansi" value="<?php echo $edit->nama_instansi ?>">
                            </div>
                            <div class="form-group">
                                <label>Apakah Mempunyai Pekerjaan Sampingan ?</label>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input type="radio" name="sampingan" value="Y" <?php if($edit->sampingan=='Y') echo ' checked'; ?>> Ya
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sampingan" value="N" <?php if($edit->sampingan=='N') echo ' checked'; ?>> Tidak
                                    </label>
                                </div>
                            </div>
                            <div id="pekerjaan_sampingan" class="form-group" <?php if($edit->sampingan=='N') echo ' style="display: none;"'; ?>>
                                <label>Pekerjaan Sampingan</label>
                                <input type="text" class="form-control" name="pekerjaan_sampingan" value="<?php echo $edit->pekerjaan_sampingan ?>">
                            </div>
                            <div class="form-group">
                                <label>Pendidikan Terakhir</label>
                                <select class="form-control" name="pendidikan" required="">
                                    <option>-- Silakan Pilih</option>
                                    <?php
                                    foreach($pendidikan as $d){
                                        echo '<option value="'.$d->pendidikan_id.'" '; if($edit->pendidikan_id==$d->pendidikan_id) echo ' selected'; echo '>'.$d->nama.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pendapatan Total Rata-Rata Selama Sebulan</label>
                                <select class="form-control" name="pendapatan" required="">
                                    <option>-- Silakan Pilih</option>
                                    <?php
                                    foreach($pendapatan as $t){
                                        echo '<option value="'.$t->pendapatan_id.'" '; if($edit->pendapatan_id==$t->pendapatan_id) echo ' selected'; echo '>'.$t->nama.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Berapa Jumlah Tanggungan</label>
                                <select class="form-control" name="tanggungan" required="">
                                    <option>-- Silakan Pilih</option>
                                    <?php
                                    foreach($tanggungan as $g){
                                        echo '<option value="'.$g->tanggungan_id.'" '; if($edit->tanggungan_id==$g->tanggungan_id) echo ' selected'; echo '>'.$g->nama.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Apakah Anda Menjadi Anggota Organisasi Kemasyarakatan, Intra atau Ekstra Kampus ?</label>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input type="radio" name="organisasi_lain" value="Y" <?php if($edit->organisasi_lain=='Y') echo ' checked'; ?>> Ya
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="organisasi_lain" value="N" <?php if($edit->organisasi_lain=='N') echo ' checked'; ?>> Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" id="nama_organisasi" <?php if($edit->organisasi_lain=='N') echo ' style="display: none;"'; ?>>
                                <label>Jika Iya Sebutkan Nama Organisasinya</label>
                                <input type="text" class="form-control" name="nama_organisasi" value="<?php echo $edit->nama_organisasi ?>">
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="foto" class="form-control">
                                <input type="hidden" name="old_foto" value="<?php echo $edit->foto ?>">
                                <p class="help-block"><?php if($edit->foto) echo '<a target="_blank" href="'.base_url('media/foto/'.$edit->foto).'">Lihat Foto</a>' ?></p>
                            </div>

                            <h3>Data Keluarga</h3>
                            <div class="form-group">
                                <label>Nama Istri</label>
                                <input type="text" class="form-control" name="nama_istri" value="<?php echo $edit->nama_istri ?>">
                            </div>
                            <div class="form-group">
                                <label>Anggota Otonom Persis ?</label>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input type="radio" name="anggota_otonom" value="Y" <?php if($edit->anggota_otonom=='Y') echo ' checked'; ?>> Ya
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="anggota_otonom" value="N" <?php if($edit->anggota_otonom=='N') echo ' checked'; ?>> Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Anak</label>
                                <input type="number" class="form-control" name="jumlah_anak" value="<?php echo $edit->jumlah_anak ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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

        <h2 style="text-align: right;"><a href="<?php echo base_url('history/tambah/'.$anggota_id) ?>" class="btn btn-primary">+ Tambah</a></h2>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Riwayat Pendidikan
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tingkat</th>
                            <th>Nama Sekolah</th>
                            <th>Jurusan</th>
                            <th>Tahun Masuk</th>
                            <th>Tahun Lulus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach($riwayat as $list){
                            echo '<tr>
                                    <td class="center" width="10">'.$i.'</td>
                                    <td>'.$list->tingkat.'</td>
                                    <td>'.$list->nama_sekolah.'</td>
                                    <td>'.$list->jurusan.'</td>
                                    <td>'.$list->tahun_masuk.'</td>
                                    <td>'.$list->tahun_lulus.'</td>
                                    <td class="center">'.anchor('history/edit/'.$list->riwayat_id, 'Edit').' | '.anchor('riwayat/hapus_riwayat/'.$list->riwayat_id, 'Hapus', 'onclick="return confirm(\'Apakah Anda yakin akan menghapus data riwayat pendidikan ini ?\')"').'</td>
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
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<?php
break;
} 
?>