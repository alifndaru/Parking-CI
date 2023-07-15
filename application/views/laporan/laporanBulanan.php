<section class="content-header">
  <h1>
    Laporan Bulanan
    <small>Version 2.0</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Laporan bulanan</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <h1>Laporan Bulanan</h1>
  <form action="<?php echo site_url('laporan/generateLaporanBulanan'); ?>" method="post">
    <div class="form-group">
      <label for="bulan">Pilih Bulan:</label>
      <select name="bulan" class="form-control">
        <?php foreach ($pilihanBulan as $bulan => $namaBulan) { ?>
          <option value="<?php echo $bulan; ?>"><?php echo $namaBulan; ?></option>
        <?php } ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Generate Laporan</button>
  </form>

  <!-- /.row -->
</section>