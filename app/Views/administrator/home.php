<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6  subheader-solid " id="kt_subheader">
    <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-1">
        <!--begin::Page Heading-->
        <div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Dashboard page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Dashboard page </a>
            </li>
        </ul>
        <!--end::Breadcrumb-->
        </div>
        <!--end::Page Heading-->
    </div>
    <!--end::Info-->
    </div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <img src="<?= base_url()?>assets/image/bxseahd.png" alt="" style="width:40%; max-width:300px;">
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Artikel</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_articles ?? 0;?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-newspaper fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pesan Kontak</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_contacts ?? 0;?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-envelope fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Partnership</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_partnership ?? 0;?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-handshake fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Subscriber</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_subscribed ?? 0;?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">User Admin</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_users ?? 0;?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-user-shield fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">File Media</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_media_files ?? 0;?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-images fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4"><a href="<?= base_url('adminsite/whatsnew');?>" class="btn btn-primary btn-block">Kelola Artikel</a></div>
            <div class="col-md-4"><a href="<?= base_url('adminsite/partnership');?>" class="btn btn-info btn-block">Kelola Partnership</a></div>
            <div class="col-md-4"><a href="<?= base_url('adminsite/visit/contact');?>" class="btn btn-success btn-block">Lihat Pesan Kontak</a></div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4"><a href="<?= base_url('adminsite/media');?>" class="btn btn-secondary btn-block">Buka Media Manager</a></div>
            <div class="col-md-4"><a href="<?= base_url('adminsite/settings');?>" class="btn btn-dark btn-block">Pengaturan Global</a></div>
            <div class="col-md-4"><a href="<?= base_url('adminsite/profile');?>" class="btn btn-warning btn-block">Profil Admin</a></div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-6 mb-5">
                <div class="card card-custom shadow-sm h-100">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title font-weight-bolder">Artikel Terbaru</h3>
                    </div>
                    <div class="card-body pt-2">
                        <?php if (!empty($recent_articles)): ?>
                            <?php foreach ($recent_articles as $article): ?>
                                <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                    <div class="mr-3">
                                        <div class="font-weight-bolder text-dark"><?= esc($article['article_title'] ?? '-');?></div>
                                        <div class="text-muted font-size-sm"><?= esc($article['article_author'] ?? '-');?></div>
                                    </div>
                                    <a href="<?= base_url('adminsite/master/article/update/'.($article['article_id'] ?? 0));?>" class="btn btn-sm btn-light-primary">Edit</a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted">Belum ada artikel.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-5">
                <div class="card card-custom shadow-sm h-100">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title font-weight-bolder">Pesan Kontak Terbaru</h3>
                    </div>
                    <div class="card-body pt-2">
                        <?php if (!empty($recent_contacts)): ?>
                            <?php foreach ($recent_contacts as $contact): ?>
                                <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                    <div class="mr-3">
                                        <div class="font-weight-bolder text-dark"><?= esc($contact['contact_fullname'] ?? '-');?></div>
                                        <div class="text-muted font-size-sm"><?= esc($contact['contact_email'] ?? '-');?></div>
                                    </div>
                                    <span class="badge badge-light-info text-uppercase"><?= esc($contact['contact_type'] ?? 'contact');?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted">Belum ada pesan masuk.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->
<?= $this->endSection() ?>