<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<style type="text/css">
html, body {
    min-height: 100%;
}
body {
    background-image: url('<?php echo base_url('static/img/background.png') ?>');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    position: relative;
}
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background: rgba(255, 255, 255, 0.90);
    z-index: 0;
    pointer-events: none;
}
#wrapper,
#page-wrapper {
    background-color: transparent;
    position: relative;
    z-index: 1;
}
.logo{
    color: #449240;
}
.logo:hover{
    color: #449240;
    text-decoration: none;
}
.header{
    font-size: 2.5rem;
}
</style>

<body>

<div id="wrapper">

<div id="page-wrapper" style="margin: 0">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top: 20px; text-align: center;">
            <a href="<?php echo base_url() ?>" class="logo"><img src="<?php echo base_url('static/img/logo.png') ?>" width="300"></a>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <h2 class="text-center"><a href="<?php echo base_url() ?>" class="logo header">MUSYAWARAH CABANG XIII<br>PEMUDA PERSIS BANJARAN</a></h2>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <p class="text-center"><a href="<?php echo base_url() ?>" class="logo">"Meneguhkan Kader Berjiwa Pemimpin dan Mendakwahkan Qur'an Sunnah dalam Segala Ruang dan Waktu"<br>Kamis, 25 Desember 2025 M / 5 Rajab 1447 H</a></p>
        </div>
    </div>
