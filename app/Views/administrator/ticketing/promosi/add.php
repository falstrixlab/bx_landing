<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
    <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap mr-1">
        <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Tambah Promosi Tiket </h5>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted"><a href="#" class="text-muted"> Base </a></li>
            <li class="breadcrumb-item text-muted"><a href="#" class="text-muted"> Tambah Promosi Tiket </a></li>
        </ul>
        </div>
    </div>
    </div>
</div>
<!--end::Subheader-->
<div class="d-flex flex-column-fluid">
    <div class=" container ">
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">Tambah Promosi Tiket <span class="d-block text-muted pt-2 font-size-sm">Isi data promosi beserta syarat &amp; ketentuan</span></h3>
        </div>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('failed')):?>
                <div class="alert alert-danger alert-dismissible"><strong>Gagal!</strong> Proses insert data gagal.</div>
            <?php endif;?>
            <?php if(session()->getFlashdata('failedmovefile')):?>
                <div class="alert alert-danger alert-dismissible"><strong>Error!</strong> Gagal mengupload file.</div>
            <?php endif;?>
            <div class="card card-custom">
                <form method="POST" action="<?= base_url('adminsite/ticketing/promosi/runadd');?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group mb-8">
                            <div class="alert alert-custom alert-default" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                                <div class="alert-text">Pastikan data yang dimasukkan sudah benar dan sesuai aturan.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Judul ID <span class="text-danger">*</span></label>
                            <input name="promosi_title" type="text" class="form-control" placeholder="Masukkan judul promosi (ID)" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi ID <span class="text-danger">*</span></label>
                            <textarea name="promosi_desc" class="form-control" placeholder="Masukkan deskripsi promosi (ID)" id="kt-ckeditor-1" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Judul EN</label>
                            <input name="promosi_title_en" type="text" class="form-control" placeholder="Masukkan judul promosi (EN)"/>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi EN</label>
                            <textarea name="promosi_desc_en" class="form-control" placeholder="Masukkan deskripsi promosi (EN)" id="kt-ckeditor-2" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Syarat &amp; Ketentuan ID</label>
                            <textarea name="promosi_tnc" class="form-control" placeholder="Masukkan syarat &amp; ketentuan (ID)" id="kt-ckeditor-3" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Syarat &amp; Ketentuan EN</label>
                            <textarea name="promosi_tnc_en" class="form-control" placeholder="Masukkan syarat &amp; ketentuan (EN)" id="kt-ckeditor-4" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gambar <span class="text-danger">*</span></label>
                            <input type="file" name="promosi_pict" class="form-control" accept=".png,.jpg,.jpeg">
                        </div>
                        <div class="form-group">
                            <label>Link Promosi (URL)</label>
                            <input name="promosi_link" type="url" class="form-control" placeholder="https://"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="submit" value="Simpan Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/ticketing/promosi');?>" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
<!--end::Content-->
<?= $this->endSection() ?>
