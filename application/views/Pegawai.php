<section class="content-header">
  <h1>
    Pegawai
    <small>Version 2.0</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Pegawai</a></li>
    <li class="active">Data Pegawai</li>
  </ol>
</section>

<section class="content">
  <?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success">
      <?php echo $this->session->flashdata('success'); ?>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <!-- <h3 class="box-title">Responsive Hover Table</h3> -->
          <!-- modal create -->

          <!-- Tombol "Tambah Data" -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahData">
            Tambah Data
          </button>

          <!-- Modal Tambah Data -->
          <div class="modal fade" id="modalTambahData" tabindex="-1" role="dialog" aria-labelledby="modalTambahDataLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title" id="modalTambahDataLabel">Tambah Data</h4>
                </div>
                <div class="modal-body">
                  <!-- Form tambah data -->
                  <form id="formTambahData" action="<?php echo site_url('pegawai/create'); ?>" method="post">
                    <div class="form-group">
                      <label for="username">Username:</label>
                      <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label for="password">Password:</label>
                      <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label for="alamat">Alamat:</label>
                      <input type="text" name="alamat" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label for="noHp">No. HP:</label>
                      <input type="text" name="noHp" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label for="role">Role:</label>
                      <select name="role" class="form-control" required>
                        <option value="" class="disable">-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="pegawai">Pegawai</option>
                      </select>
                    </div>


                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Create</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                  <!-- Akhir form -->
                </div>
              </div>
            </div>
          </div>
          <!-- Akhir Modal Tambah Data -->

          <!-- end modal create -->



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
              <th>ID</th>
              <th>Username</th>
              <th>Alamat</th>
              <th>No.HP</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
            <?php $i = 1;
            foreach ($users as $data) :  ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $data->username; ?></td>
                <td><?= $data->alamat; ?></td>
                <td><?= $data->noHp; ?></td>

                <td>
                  <?php if ($data->role == 'admin') { ?>
                    <p class="btn btn-primary">Admin</p>
                  <?php } elseif ($data->role == 'pegawai') { ?>
                    <p class="btn btn-danger">Pegawai</p>
                  <?php } else { ?>
                    <p class="btn-secondary">Role Tidak Valid</p>
                  <?php } ?>
                </td>

                <td>
                  <a href="<?php echo site_url('pegawai/edit/' . $data->users_id); ?>" class="btn btn-primary">Edit</a>
                  <a href="<?php echo site_url('pegawai/delete/' . $data->users_id); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>

      </div>

    </div>
  </div>


</section>


<script>
  $(document).ready(function() {
    $('#formTambahData').on('submit', function(event) {
      event.preventDefault(); // Mencegah form submit secara default

      // Kirim form secara asynchronous menggunakan AJAX
      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        success: function(response) {
          // Tangani respon dari server
          var data = JSON.parse(response);
          if (data.success) {
            // Jika validasi berhasil, tutup modal dan tampilkan flash data berhasil
            $('#modalTambahData').modal('hide');
            $('.alert-success').html('Data berhasil ditambahkan.').show();
            window.location.href = "<?php echo site_url('pegawai'); ?>"; // Redirect ke halaman /pegawai
          } else {
            // Jika validasi gagal, tampilkan pesan error dalam modal
            $('#modalTambahData .modal-body').find('.alert-danger').remove();
            $('#modalTambahData .modal-body').prepend('<div class="alert alert-danger">' + data.error + '</div>');
          }
        }
      });
    });

    // Reset form dan pesan error saat modal ditampilkan
    $('#modalTambahData').on('shown.bs.modal', function() {
      $('#formTambahData')[0].reset(); // Reset form input
      $('#modalTambahData .modal-body').find('.alert-danger').remove(); // Hapus pesan error sebelumnya
    });
  });
</script>