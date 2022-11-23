<?php if(!defined('BASEPATH')) exit('No direct script access allowed') ?>

<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse">
      <ul class="nav" id="side-menu">
          <li>
              <a href="<?php echo base_url('main') ?>"><i class="fa fa-home fa-fw"></i> Beranda</a>
          </li>
          <li>
              <a href="<?php echo base_url('anggota') ?>"><i class="fa fa-users fa-fw"></i> Anggota</a>
          </li>
          <!-- <li>
              <a href="<?php echo base_url('admin') ?>"><i class="fa fa-user fa-fw"></i> Admin</a>
          </li> -->
          <li>
              <a href="#"><i class="fa fa-database fa-fw"></i> Master Data<span class="fa arrow"></span></a>
              <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                  <li>
                      <a href="<?php echo base_url('jamaah') ?>">Jamaah</a>
                  </li>
                  <li>
                      <a href="<?php echo base_url('pendidikan') ?>">Pendidikan</a>
                  </li>
                  <li>
                      <a href="<?php echo base_url('pekerjaan') ?>">Pekerjaan</a>
                  </li>
                  <li>
                      <a href="<?php echo base_url('pendapatan') ?>">Pendapatan</a>
                  </li>
                  <li>
                      <a href="<?php echo base_url('tanggungan') ?>">Tanggungan</a>
                  </li>
              </ul>
              <!-- /.nav-second-level -->
          </li>
      </ul>
  </div>
  <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>