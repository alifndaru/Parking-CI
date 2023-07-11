<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Kendaraan Terparkir</h3>
    </div>
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tr>
          <th>Jenis Kendaraan</th>
          <th>Plat Nomer</th>
          <th>Tanggal Masuk</th>
        </tr>
        <?php foreach ($data_parkir_masuk as $row) { ?>
          <tr>
            <td><?php echo $row->nama_kategori; ?></td>
            <td><?php echo $row->plat_nomer; ?></td>
            <td><?php echo date('d-m-Y H:i', strtotime($row->tanggal_masuk)); ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</section>