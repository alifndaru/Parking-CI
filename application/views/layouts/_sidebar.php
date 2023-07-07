<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url('assets/uploads/images/admin.png'); ?>" class="img-circle">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('user')['username'];?></p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Fitur Management Parking</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="active"><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

      <!-- khusus admin -->

      <?php if ($this->session->userdata('user')['role'] === 'admin'): ?>
        <li><a href="<?= base_url('pegawai') ?>"><i class="fa fa-link"></i> <span>Pegawai</span></a></li>
        <li><a href="<?= site_url('kategori/index') ?>"><i class="fa fa-link"></i> <span>Kategori</span></a></li>

        <li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-share"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="<?= site_url('laporan/laporanBulanan'); ?>"><i class="fa fa-circle-o"></i> Laporan bulanan</a></li>
            <li><a href="<?= site_url('laporan/laporanHarian'); ?>"><i class="fa fa-circle-o"></i> Laporan harian</a></li>
          </ul>
        </li>
        <?php endif; ?>
      <!-- end fitur admin -->

      <li><a href="<?= site_url('listKendaraan/index') ?>"><i class="fa fa-link"></i> <span>List Kendaraan Terparkir></a></li>
      <li class="treeview" style="height: auto;">
        <a href="#">
          <i class="fa fa-share"></i> <span>Data Parkir</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: none;">
          <li><a href="<?= site_url('parkiran/parkiranMasuk'); ?>"><i class="fa fa-circle-o"></i> Parkir masuk</a></li>
          <li><a href="<?= site_url('parkiran/parkiranKeluar'); ?>"><i class="fa fa-circle-o"></i> Parkir keluar</a></li>
        </ul>
      </li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>