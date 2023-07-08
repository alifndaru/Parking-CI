<section class="content-header">
  <h1>
    Kategori
    <small>Version 2.0</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Kategori</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Form kategori</h3>
    </div>

    <form action="<?php echo site_url('kategori/tambah'); ?>" method="post">
      <?php echo validation_errors('<div style="color: red;">', '</div>'); ?>
      <div class="box-body">
        <div class="form-group">
          <label for="nama_kategori">Nama Kategori:</label>
          <input class="form-control" type="text" name="nama_kategori" value="<?php echo set_value('nama_kategori'); ?>" required>
        </div>

        <div class="form-group">
          <label for="harga">Harga:</label>
          <input type="text" class="form-control" name="harga" value="<?php echo set_value('harga'); ?>" required>
        </div>

        <div class="form-group">
          <label for="kode_kategori">Kode Kategori:</label>
          <input type="text" class="form-control" name="kode_kategori" value="<?php echo $kode_kategori; ?>" disabled>
        </div>

        <input type="submit" value="Simpan" class="btn btn-primary">
      </div>
    </form>
  </div>

  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Kategori</h3>
      <div class="box-tools">
        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
          <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
          <div class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tr>
          <th>Kode Kategori</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>action</th>
          <!-- <th>Action</th> -->
        </tr>
        <?php foreach ($kategori as $row) { ?>
          <tr>
            <td><?php echo $row->kode_kategori; ?></td>
            <td><?php echo $row->nama_kategori; ?></td>
            <td><?php echo $row->harga; ?></td>
            <td>
              <a href="<?php echo site_url('kategori/edit/' . $row->id_kategori); ?>" class="btn btn-warning">Edit</a>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
  <!-- /.row -->
</section>