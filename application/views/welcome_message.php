<section class="content-header">
  <h1>
    Dashboard
    <small>Version 2.0</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->

  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Kendaraan</span>
            <span class="info-box-number">
              <small><?php echo $jumlahKendaraan; ?></small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Kategori</span>
            <span class="info-box-number"><?php echo $jumlahKategori; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
  
      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>
  
         <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Pegawai</span>
            <span class="info-box-number"><?php echo $jumlahPegawai; ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <!-- <?php echo print_r($this->session->all_userdata()); ?> -->
  
    </div>
  </div>
  <!-- /.row -->
</section>