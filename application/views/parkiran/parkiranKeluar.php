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
  <h1>Parkir Keluar</h1>

  <?php if (isset($error_message)) : ?>
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
  <?php endif; ?>

  <!-- Form Pengecekan Plat Nomer -->
  <form action="<?php echo base_url('parkiran/keluar'); ?>" method="post">
    <div class="form-group">
      <label for="plat_nomer">Plat Nomer</label>
      <input type="text" name="plat_nomer" id="plat_nomer" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Cek Kendaraan Keluar</button>
  </form>

  <!-- Tabel Kendaraan Keluar -->
  <table class="table">
    <thead>
      <tr>
        <th>Plat Nomer</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Durasi Parkir</th>
        <th>Total Biaya</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data_kendaraan_keluar as $kendaraan_keluar) : ?>
        <tr>
          <td><?php echo $kendaraan_keluar->plat_nomer; ?></td>
          <td><?php echo $kendaraan_keluar->tanggal_masuk; ?></td>
          <td><?php echo $kendaraan_keluar->waktu_keluar; ?></td>
          <td>
            <?php
            if ($kendaraan_keluar->durasi_parkir < 1) {
              // Ubah ke menit
              $durasiParkirMenit = round($kendaraan_keluar->durasi_parkir * 60);
              echo $durasiParkirMenit . ' Menit';
            } elseif ($kendaraan_keluar->durasi_parkir >= 24) {
              // Ubah ke hari
              $durasiParkirHari = floor($kendaraan_keluar->durasi_parkir / 24);
              echo $durasiParkirHari . ' Hari';
            } else {
              // Tampilkan dalam jam
              echo round($kendaraan_keluar->durasi_parkir) . ' Jam';
            }
            ?>
          </td>




          <td><?php echo $kendaraan_keluar->harga; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>


  <!-- /.row -->
</section>