<style>
    body {
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        padding: 10px;
        <?php if ($parkiran->nama_kategori == 'mobil') : ?>
            background-color: red;
        <?php elseif ($parkiran->nama_kategori == 'motor') : ?>
            background-color: yellow;
        <?php endif; ?>
    }
</style>

<h1>Karcis Parkir</h1>
<p>Plat Nomor: <?php echo $parkiran->plat_nomer; ?></p>
<p>Tanggal Masuk: <?php echo $parkiran->tanggal_masuk; ?></p>
<p>Kategori: <?php echo $parkiran->nama_kategori; ?></p>
<p>Harga: <?php echo $parkiran->harga; ?></p>
