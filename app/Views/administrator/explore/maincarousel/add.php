<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Add Main Carousel</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Explore</a></li>
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Add Main Carousel</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Tambah Data Carousel <span class="d-block text-muted pt-2 font-size-sm">Explore Main Journey Carousel</span></h3>
                </div>
            </div>
            <div class="card-body">
                <?php if(session()->getFlashdata('failed')):?>
                    <div class="alert alert-danger alert-dismissible"><strong>Warning!</strong> Gagal menyimpan data.</div>
                <?php endif;?>
                <?php if(session()->getFlashdata('invalidate')):?>
                    <div class="alert alert-danger alert-dismissible"><strong>Error!</strong> File tidak valid.</div>
                <?php endif;?>
                <div class="card card-custom">
                    <form method="POST" action="<?= base_url('adminsite/explore/maincarousel/runadd');?>" enctype="multipart/form-data">
                        <div class="card-body" style="background-color:#F3F6F9;">
                            <div class="form-group">
                                <label>Title ID <span class="text-danger">*</span></label>
                                <input name="carousel_title_id" type="text" class="form-control" placeholder="Judul (ID)" required/>
                            </div>
                            <div class="form-group">
                                <label>Zone</label>
                                <input name="carousel_zone" type="text" class="form-control" placeholder="Contoh: Zona A, Zona Laut"/>
                            </div>
                            <div class="form-group">
                                <label>Title EN <span class="text-danger">*</span></label>
                                <input name="carousel_title_en" type="text" class="form-control" placeholder="Title (EN)" required/>
                            </div>
                            <div class="form-group">
                                <label>Description ID</label>
                                <textarea name="carousel_desc_id" class="form-control" rows="4" placeholder="Deskripsi (ID)"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Description EN</label>
                                <textarea name="carousel_desc_en" class="form-control" rows="4" placeholder="Description (EN)"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Image <span class="text-danger">*</span></label>
                                <input type="file" name="carousel_image" class="form-control" accept=".png,.jpg,.jpeg" required/>
                                <small class="text-muted">Format: JPG, JPEG, PNG</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" name="submit" value="Simpan Data" class="btn btn-success mr-2">
                            <a href="<?= base_url('adminsite/explore/maincarousel');?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
