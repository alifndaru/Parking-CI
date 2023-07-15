<section class="content-header">
  <h1>
    Parkiran Keluar
    <small>Version 2.0</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Parkiran Keluar</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Pengecekan Kendaraan Keluar</h3>
    </div>

    <div class="box-body">
      <form action="<?php echo base_url('parkiran/keluarBener'); ?>" method="post">
        <div class="form-group">
          <label for="kode_karcis">Kode Karcis:</label>
          <input type="text" name="kode_karcis" id="kode_karcis" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cek Kendaraan Keluar</button>
      </form>
    </div>
  </div>

  <!-- Tabel Kendaraan Keluar -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Kendaraan Keluar</h3>
    </div>

    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>kode_karcis</th>
            <th>Jenis Kendaraan</th>
            <th>Waktu Masuk</th>
            <th>Waktu Keluar</th>
            <th>Durasi Parkir</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data_parkir_keluar as $row) : ?>
            <tr>
              <td><?php echo $row->kode_karcis; ?></td>
              <td><?php echo $row->nama_kategori; ?></td>
              <td><?php echo date('H:i', strtotime($row->tanggal_masuk)); ?> WIB</td>
              <td><?php echo date('H:i', strtotime($row->waktu_keluar)); ?> WIB</td>
              <td><?php echo $row->durasi_parkir; ?></td>
              <td><?php echo $row->harga; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- /.row -->
</section>