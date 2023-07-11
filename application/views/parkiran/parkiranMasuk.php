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

    <form action="<?php echo site_url('parkiran/simpan'); ?>" method="post">
      <div class="box-body">
        <?php echo validation_errors('<div style="color: red;">', '</div>'); ?>


        <?php if (isset($error_message)) { ?>
          <div style="color: red;"><?php echo $error_message; ?></div>
        <?php } ?>

        <input type="hidden" name="status" value="1"> <!-- Set nilai status sebagai 1 (Masuk) secara default -->  

        <div class="form-group">
          <label for="plat_nomer">Nomor Plat:</label>
          <input class="form-control" type="text" name="plat_nomer" value="<?php echo set_value('plat_nomer'); ?>" required>
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
          <th>Kode Kendaraan</th>
          <th>Plat Nomer</th>
          <th>tanggal masuk</th>
          <th>harga</th>
          <th>Cetak</th>
        </tr>
        <?php foreach ($data_parkir as $row) { ?>
          <tr>
            <td><?php echo $row->nama_kategori; ?></td>
            <td><?php echo $row->plat_nomer; ?></td>
            <td><?php echo date('d-m-Y H:i', strtotime($row->tanggal_masuk)); ?></td>
            <td><?php echo $row->harga; ?></td>
            <td>
              <!-- <a href="<?php echo site_url('parkiran/generate-karcis-pdf/' . $row->id_masuk); ?>" target="_blank">Cetak Karcis</a> -->
              <a href="<?php echo site_url('parkiran/generate-karcis-pdf/' . $row->id_masuk); ?>" target="_blank">Cetak Karcis</a>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>

  <!-- /.row -->
</section>