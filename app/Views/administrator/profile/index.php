<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Profile</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted"><a href="<?= base_url(getenv('bxsea.admin').'/dashboard');?>" class="text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item text-muted">Profile</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <?php if(session()->getFlashdata('success')):?>
            <div class="alert alert-success alert-dismissible fade show">
                <strong>Berhasil!</strong> <?= session()->getFlashdata('success');?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif;?>
        <?php if(session()->getFlashdata('error')):?>
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> <?= session()->getFlashdata('error');?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif;?>

        <div class="row">
            <div class="col-lg-8">
                <div class="card card-custom gutter-b">
                    <div class="card-header py-3">
                        <div class="card-title"><h3 class="card-label">Informasi Profil</h3></div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= base_url(getenv('bxsea.admin').'/profile/runupdate');?>">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="user_fullname" class="form-control" value="<?= esc($user['user_fullname'] ?? '');?>" required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="user_username" class="form-control" value="<?= esc($user['user_username'] ?? '');?>" required>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" class="form-control" value="<?= esc($user['user_role'] ?? '');?>" disabled>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="<?= base_url(getenv('bxsea.admin').'/profile/changepassword');?>" class="btn btn-secondary ml-2">Ganti Password</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>
