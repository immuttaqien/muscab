<?php //print_r($detail); die();
$path_logo = './static/img/logo-2.png';
$type_logo = pathinfo($path_logo, PATHINFO_EXTENSION);
$data_logo = file_get_contents($path_logo);
$img_logo = 'data:image/' . $type_logo . ';base64,' . base64_encode($data_logo);

$path_qr = './media/qrcode/'.$detail->qrcode;
$type_qr = pathinfo($path_qr, PATHINFO_EXTENSION);
$data_qr = file_get_contents($path_qr);
$img_qr = 'data:image/' . $type_qr . ';base64,' . base64_encode($data_qr);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $detail->npa.'_'.$detail->nama_lengkap ?></title>
	<style type="text/css">
		@page { margin: 18px; }
		body { margin: 18px; }
	</style>
</head>
<body>
<div style="width: 20%; float: left; text-align: center;"><img width="80" src="<?php echo $img_logo ?>"></div>
<div style="width: 80%; float: right;">
    <h2 style="text-align: center; margin: 0;">MUSYAWARAH CABANG XIII<br>PEMUDA PERSIS BANJARAN</h2>
    <p style="text-align: center; margin: 0; font-size: 13px;">"Meneguhkan Kader Berjiwa Pemimpin dan Mendakwahkan Qur'an Sunnah dalam Segala Ruang dan Waktu"</p>
</div>
<div style="clear: both;"></div><hr>
<h3 style="text-align: center; font-weight: bold;">BUKTI PENDAFTARAN</h3>

<!-- <p style="text-align: center;"><img width="120" src="<?php echo $img_logo ?>"></p>
<h2 style="text-align: center;">MUSYAWARAH CABANG XII<br>PEMUDA PERSIS BANJARAN</h2>
<p style="text-align: center;">"Meneguhkan Kader Berjiwa Pemimpin dan Mendakwahkan Qur'an Sunnah dalam Segala Ruang dan Waktu"</p> -->
<!-- <br>Kamis, 18 Desember 2022 M / 24 Jumadil Ula 1444 H -->
<table style="border-collapse: collapse; width: 100%; height: 36px; border-width: 0px;" border="1">
<!-- <colgroup><col style="width: 50%;"><col style="width: 50%;"></colgroup> -->
<tbody>
<tr style="height: 18px;">
<td style="border-width: 0px; height: 18px; padding: 5px;"><strong>NPA</strong></td>
<td style="border-width: 0px; height: 18px; text-align: right; padding: 5px;"><?php echo $detail->npa ?></td>
</tr>
<tr style="height: 18px;">
<td style="border-width: 0px; height: 18px; padding: 5px;"><strong>Nama Lengkap</strong></td>
<td style="border-width: 0px; height: 18px; text-align: right; padding: 5px;"><?php echo $detail->nama_lengkap ?></td>
</tr>
<tr style="height: 18px;">
<td style="border-width: 0px; height: 18px; padding: 5px;"><strong>Pimpinan Jamaah</strong></td>
<td style="border-width: 0px; height: 18px; text-align: right; padding: 5px;"><?php echo $detail->jamaah ?></td>
</tr>
<tr style="height: 18px;">
<td style="border-width: 0px; height: 18px; padding: 5px;"><strong>Email</strong></td>
<td style="border-width: 0px; height: 18px; text-align: right; padding: 5px;"><?php echo $detail->email ?></td>
</tr>
<tr style="height: 18px;">
<td style="border-width: 0px; height: 18px; padding: 5px;"><strong>Nomor HP Aktif</strong></td>
<td style="border-width: 0px; height: 18px; text-align: right; padding: 5px;"><?php echo $detail->handphone ?></td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; width: 100%; height: 36px; border-width: 0px;" border="1">
<tbody>
<tr style="height: 18px;">
<td style="border-width: 0px; height: 18px; padding: 5px;"><b>Check In Peserta</b><br>
    Hari, Tanggal : Kamis, 25 Desember 2025<br>
    Waktu : 06:00 - 07:00 WIB<br>
    Lokasi : Aula Pesantren Persis 31 Banjaran</td>
<td style="border-width: 0px; height: 18px; text-align: right; padding: 5px;"><b>Pakaian</b><br>
    Kemeja Batik<br>
    Celana Panjang<br>
    Bersepatu</td>
</tr>
</tbody>
</table>
<!-- <p>
    <b>Check In Peserta</b><br>
    Hari, Tanggal : Kamis, 18 Desember 2022<br>
    Waktu : 06:30 - 07:30 WIB<br>
    Lokasi : Aula Pesantren Persis 31 Banjaran
</p>
<p>
    <b>Pakaian :</b><br>
    - Kemeja Batik<br>
    - Celana Panjang<br>
    - Bersepatu
</p> -->
<p style="text-align: center;"><img width="120" src="<?php echo $img_qr ?>"></p>
<p style="text-align: center;">Silakan bawa bukti konfirmasi kehadiran peserta ini ketika melakukan check in di tempat.</p>
</body>
</html>