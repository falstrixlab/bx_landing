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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Tenant page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Tenant page </a>
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
    <div class=" container ">
    
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">Add Tenant <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
            </h3>
        </div>
        
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('failed')):?>
                <div class="alert alert-danger alert-dismissible">
                    <strong>Warning!</strong> Failed perform the data insert process.
                </div>
            <?php endif;?>
            <?php if(session()->getFlashdata('failedmovefile')):?>
                <div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> Failed to upload file.
                </div>
            <?php endif;?>
            <div class="card card-custom">
                <!--begin::Form-->
                <form method="POST" action="<?= base_url('adminsite/visit/tenant/runadd');?>" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group mb-8">
                            <div class="alert alert-custom alert-default" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
                                <div class="alert-text">
                                    The data you enter must be correct and also in accordance with the applicable data input rules, if it does not match then the data will be damaged.
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Title <span class="text-danger">*</span></label>
                            <input name="tenant_title" type="text" class="form-control"  placeholder="Enter Tenant Title" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Desc ID <span class="text-danger">*</span></label>
                            <textarea name="tenant_desc" class="form-control" placeholder="Entry Desc ID" id="kt-ckeditor-1" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Desc EN <span class="text-danger">*</span></label>
                            <textarea name="tenant_desc_en" class="form-control" placeholder="Entry Desc ID" id="kt-ckeditor-2" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Location ID</label>
                            <input name="tenant_location" type="text" class="form-control" placeholder="Enter Tenant Location ID (e.g. Zona A, Lantai 1)"/>
                        </div>
                        <div class="form-group">
                            <label>Location EN</label>
                            <input name="tenant_location_en" type="text" class="form-control" placeholder="Enter Tenant Location EN (e.g. Zone A, Level 1)"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea">Thumbnail Pict <span class="text-danger">*</span></label>
                            <input type="file" name="tenant_thumbnail_pict" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea">Main Pict <span class="text-danger">*</span></label>
                            <input type="file" name="tenant_main_pict" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Button Text ID <small class="text-muted">(teks tombol, default: "Lihat Detail")</small></label>
                            <input type="text" name="tenant_btn_text" class="form-control" placeholder="Lihat Detail">
                        </div>
                        <div class="form-group">
                            <label>Button Text EN <small class="text-muted">(button text, default: "View Details")</small></label>
                            <input type="text" name="tenant_btn_text_en" class="form-control" placeholder="View Details">
                        </div>
                        <hr>
                        <h5 class="mb-4">Popup Content</h5>
                        <div class="form-group">
                            <label>Popup Image <span class="text-danger">*</span></label>
                            <input type="file" name="tenant_popup_image" class="form-control" accept=".png,.jpg,.jpeg">
                            <small class="text-muted">Gambar khusus untuk popup (berbeda dari main image)</small>
                        </div>
                        <div class="form-group">
                            <label>Popup Description ID</label>
                            <textarea name="tenant_popup_desc_id" class="form-control" id="kt-ckeditor-popup-id" rows="6" placeholder="Deskripsi popup (ID)"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Popup Description EN</label>
                            <textarea name="tenant_popup_desc_en" class="form-control" id="kt-ckeditor-popup-en" rows="6" placeholder="Popup description (EN)"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Gallery Image 1 <span class="text-danger">*</span> <small class="text-muted">(min 1, maks 3)</small></label>
                            <input type="file" name="tenant_gallery1" class="form-control" accept=".png,.jpg,.jpeg">
                        </div>
                        <div class="form-group">
                            <label>Gallery Image 2</label>
                            <input type="file" name="tenant_gallery2" class="form-control" accept=".png,.jpg,.jpeg">
                        </div>
                        <div class="form-group">
                            <label>Gallery Image 3</label>
                            <input type="file" name="tenant_gallery3" class="form-control" accept=".png,.jpg,.jpeg">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="submit" value="Submit Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/visit/tenant');?>" type="reset" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->
<?= $this->endSection() ?>