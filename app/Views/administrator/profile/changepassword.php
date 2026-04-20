<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Ganti Password</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted"><a href="<?= base_url(getenv('bxsea.admin').'/dashboard');?>" class="text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item text-muted"><a href="<?= base_url(getenv('bxsea.admin').'/profile');?>" class="text-muted">Profile</a></li>
                    <li class="breadcrumb-item text-muted">Ganti Password</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <?php if(session()->getFlashdata('error')):?>
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> <?= session()->getFlashdata('error');?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif;?>

        <div class="row">
            <div class="col-lg-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header py-3">
                        <div class="card-title"><h3 class="card-label">Ganti Password</h3></div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= base_url(getenv('bxsea.admin').'/profile/runchangepassword');?>">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label>Password Lama</label>
                                <input type="password" name="old_password" class="form-control" required placeholder="Masukkan password lama">
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" name="new_password" class="form-control" required placeholder="Minimal 8 karakter">
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password Baru</label>
                                <input type="password" name="confirm_password" class="form-control" required placeholder="Ulangi password baru">
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                            <a href="<?= base_url(getenv('bxsea.admin').'/profile');?>" class="btn btn-secondary ml-2">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>
