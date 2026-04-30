<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Konten Halaman Partnership</h5>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Partnership</a></li>
                    <li class="breadcrumb-item text-muted"><a href="#" class="text-muted">Konten Halaman</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <?php if(session()->getFlashdata('success')):?>
            <div class="alert alert-success alert-dismissible"><strong>Berhasil!</strong> Data berhasil disimpan.</div>
        <?php endif;?>
        <?php if(session()->getFlashdata('failed')):?>
            <div class="alert alert-danger alert-dismissible"><strong>Gagal!</strong> Data gagal disimpan.</div>
        <?php endif;?>

        <?php $pc = $partnershipContent ?? []; ?>

        <!-- ===== SECTION 1: Meaningful Section ===== -->
        <div class="card card-custom gutter-b">
            <div class="card-header py-3" data-toggle="collapse" data-target="#pSec1" style="cursor:pointer;">
                <div class="card-title">
                    <h3 class="card-label"><i class="flaticon2-edit text-primary mr-2"></i> Section 1 — Meaningful Section <span class="d-block text-muted pt-2 font-size-sm">(.meaningful-section) Judul, Deskripsi &amp; 2 Gambar</span></h3>
                </div>
            </div>
            <div id="pSec1" class="collapse show">
            <form method="POST" action="<?= base_url('adminsite/partnership/content/update/meaningful');?>" enctype="multipart/form-data">
                <?= csrf_field(); ?><input type="hidden" name="submit" value="1">
                <div class="card-body" style="background:#F3F6F9;">
                    <div class="form-group">
                        <label>Title ID</label>
                        <input type="text" name="meaningful_title_id" class="form-control" value="<?= esc($pc['meaningful_title_id']??'');?>"/>
                    </div>
                    <div class="form-group">
                        <label>Title EN</label>
                        <input type="text" name="meaningful_title_en" class="form-control" value="<?= esc($pc['meaningful_title_en']??'');?>"/>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi ID</label>
                        <textarea name="meaningful_desc_id" class="form-control" rows="4"><?= esc($pc['meaningful_desc_id']??'');?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description EN</label>
                        <textarea name="meaningful_desc_en" class="form-control" rows="4"><?= esc($pc['meaningful_desc_en']??'');?></textarea>
                    </div>
                    <?php foreach([1,2] as $img): ?>
                    <div class="card mb-3">
                        <div class="card-header bg-light"><strong>Gambar <?= $img; ?></strong></div>
                        <div class="card-body">
                            <?php if(!empty($pc['meaningful_img'.$img])): ?>
                            <div class="mb-2"><img src="<?= base_url('assets/upload/partnership/'.$pc['meaningful_img'.$img]);?>" style="max-height:130px;border-radius:8px;" class="img-fluid"></div>
                            <?php endif; ?>
                            <div class="form-group mb-0">
                                <label>Upload Gambar <?= $img; ?> <small class="text-muted">(JPG/PNG)</small></label>
                                <input type="file" name="meaningful_img<?= $img; ?>" class="form-control" accept=".jpg,.jpeg,.png"/>
                                <input type="hidden" name="meaningful_img<?= $img; ?>_temp" value="<?= esc($pc['meaningful_img'.$img]??'');?>"/>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer"><button type="submit" class="btn btn-success">Simpan Section 1</button></div>
            </form>
            </div>
        </div>

        <!-- ===== SECTION 2: Partnership Opportunity Cards ===== -->
        <div class="card card-custom gutter-b">
            <div class="card-header py-3" data-toggle="collapse" data-target="#pSec2" style="cursor:pointer;">
                <div class="card-title">
                    <h3 class="card-label"><i class="flaticon2-edit text-primary mr-2"></i> Section 2 — Partnership Opportunity Cards <span class="d-block text-muted pt-2 font-size-sm">(.partnership-section)</span></h3>
                </div>
                <div class="card-toolbar">
                    <a href="<?= base_url('adminsite/partnership/opportunity/add');?>" class="btn btn-primary btn-sm font-weight-bolder">+ Tambah Card</a>
                </div>
            </div>
            <div id="pSec2" class="collapse show">
                <div class="card-body">
                    <?php if(!empty($opportunities)): ?>
                    <div class="row">
                    <?php foreach($opportunities as $opp): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card border">
                                <?php if(!empty($opp['opp_image'])): ?>
                                <img src="<?= base_url('assets/upload/partnership/'.$opp['opp_image']);?>" class="card-img-top" style="height:160px;object-fit:cover;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h6 class="card-title"><?= esc($opp['opp_title_id']??'');?></h6>
                                    <p class="card-text text-muted small"><?= esc($opp['opp_title_en']??'');?></p>
                                    <p class="card-text small"><?= esc(mb_strimwidth($opp['opp_desc_id']??'', 0, 80, '...'));?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <a href="<?= base_url('adminsite/partnership/opportunity/update/'.$opp['opp_id']);?>" class="btn btn-sm btn-warning"><i class="flaticon-edit-1"></i> Edit</a>
                                    <a href="<?= base_url('adminsite/partnership/opportunity/delete/'.$opp['opp_id']);?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus card ini?')"><i class="flaticon2-trash"></i> Hapus</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <p class="text-muted">Belum ada data opportunity. <a href="<?= base_url('adminsite/partnership/opportunity/add');?>">Tambah sekarang</a>.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<?= $this->endSection() ?>
