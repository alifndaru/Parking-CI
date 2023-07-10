<section class="content-header">
  <h1>
    Parkiran Masuk
    <small>Version 2.0</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Parkiran Masuk</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Input Kendaraan Masuk</h3>
    </div>

    <form action="" method="post">
      <div class="box-body">
        <div class="form-group">
          <label for="nama_kategori">Nomor Plat:</label>
          <input class="form-control" type="text" name="plat_nomor" value="" required>
        </div>

        <div class="form-group">
          <label for="kategori">Kategori Kendaraan:</label>
          <select class="form-control" name="kategori" required>
            <option value="">Pilih Kategori Kendaraan</option>
            <?php foreach ($kategori as $row) { ?>
              <option value="<?php echo $row->kode_kategori; ?>"><?php echo $row->nama_kategori; ?></option>
            <?php } ?>
          </select>
        </div>
        <input type="submit" value="Simpan" class="btn btn-primary">
      </div>
    </form>
  </div>

  <div class="box box-primary">
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tr>
          <th>Kode Parkir</th>
          <th>Nomer Kendaraan</th>
          <th>Jenis Kendaraan</th>
          <th>Waktu Masuk</th>
        </tr>
        <?php foreach ($data_parkir as $row) { ?>
          <tr>
            <td><?php echo $row->kode_kendaraan; ?></td>
            <td><?php echo $row->plat_nomor; ?></td>
            <td><?php echo $row->tanggal_masuk; ?></td>
            <td><?php echo $row->harga; ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>

  <!-- /.row -->
</section>