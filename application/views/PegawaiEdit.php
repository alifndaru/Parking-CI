<section class="content-header">
    <h1>
        Pegawai Edit
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        <li class="active">Edit</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit data pegawai</h3>
        </div>

        <form role="form" action="<?php echo site_url('pegawai/update'); ?>" method="post">
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            <div class="box-body">
                <input type="hidden" name="users_id" value="<?php echo $pegawai->users_id; ?>">

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $pegawai->username; ?>" required>
                    <label for=""></label>
                    <?php echo form_error('username'); ?> <!-- Display the validation error message -->
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="text" name="password" class="form-control" value="<?php echo $pegawai->password; ?>" required>
                    <?php if (form_error('password')) : ?>
                        <div class="alert alert-danger">
                            <?php echo form_error('password'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" name="alamat" class="form-control" value="<?php echo $pegawai->alamat; ?>" required>
                    <?php if (form_error('alamat')) : ?>
                        <div class="alert alert-danger">
                            <?php echo form_error('alamat'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="noHp">No. HP:</label>
                    <input type="text" name="noHp" class="form-control" value="<?php echo $pegawai->noHp; ?>" required>
                    <?php if (form_error('noHp')) : ?>
                        <div class="alert alert-danger">
                            <?php echo form_error('noHp'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" class="form-control" required>
                        <option value="" disabled>-- Pilih Role --</option>
                        <option value="admin" <?php echo ($pegawai->role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        <option value="pegawai" <?php echo ($pegawai->role == 'pegawai') ? 'selected' : ''; ?>>Pegawai</option>
                    </select>
                    <?php if (form_error('role')) : ?>
                        <div class="alert alert-danger">
                            <?php echo form_error('role'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</section>