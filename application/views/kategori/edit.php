<section class="content-header">
    <h1>
        Edit
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Kategori</a></li>
        <li class="active">Edit</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Kategori</h3>
        </div>

        <form action="<?php echo site_url('kategori/update'); ?>" method="post">
            <?php echo validation_errors('<div style="color: red;">', '</div>'); ?>
            <div class="box-body">
                <input type="hidden" name="id_kategori" value="<?php echo $kategori->id_kategori; ?>">
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori:</label>
                    <input class="form-control" type="text" name="nama_kategori" value="<?php echo set_value('nama_kategori', $kategori->nama_kategori); ?>" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="text" class="form-control" name="harga" value="<?php echo set_value('harga', $kategori->harga); ?>" required>
                </div>

                <div class="form-group">
                    <label for="kode_kategori">Kode Kategori:</label>
                    <input type="text" class="form-control" name="kode_kategori" value="<?php echo $kategori->kode_kategori; ?>" disabled>
                </div>

                <input type="submit" value="Simpan" class="btn btn-primary">
                <a href="<?php echo site_url('kategori'); ?>" class="btn btn-default">Kembali</a>
            </div>
        </form>
    </div>
</section>