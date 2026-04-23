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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Tenant update page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Tenant update page </a>
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
            <h3 class="card-label"> Tenant Program <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
            </h3>
        </div>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('success')):?>
                <div class="alert alert-success alert-dismissible">
                    <strong>Success!</strong> Successfully perform the data process.
                </div>
            <?php endif;?>
            <?php if(session()->getFlashdata('failed')):?>
                <div class="alert alert-danger alert-dismissible">
                    <strong>Failed!</strong> Failed perform the data process.
                </div>
            <?php endif;?>
            <div class="card card-custom">
                <!--begin::Form-->
                <form method="POST" action="<?= base_url('adminsite/visit/tenant/runupdate');?>" enctype="multipart/form-data">
                    <?php foreach($getdata AS $rs) {?>
                    <div class="card-body" style="background-color:#F3F6F9;">
                        <div class="form-group">
                            <label>Title <span class="text-danger">*</span></label>
                            <input name="tenant_title" value="<?= $rs["tenant_title"];?>" type="text" class="form-control"  placeholder="Enter Tenant Title" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Desc ID <span class="text-danger">*</span></label>
                            <textarea name="tenant_desc" class="form-control" placeholder="Entry Desc ID" id="kt-ckeditor-1" rows="6"><?= $rs["tenant_desc"];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Desc EN <span class="text-danger">*</span></label>
                            <textarea name="tenant_desc_en" class="form-control" placeholder="Entry Desc ID" id="kt-ckeditor-2" rows="6"><?= $rs["tenant_desc_en"];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Location ID</label>
                            <input name="tenant_location" type="text" class="form-control" value="<?= esc($rs['tenant_location'] ?? '');?>" placeholder="Enter Tenant Location ID (e.g. Zona A, Lantai 1)"/>
                        </div>
                        <div class="form-group">
                            <label>Location EN</label>
                            <input name="tenant_location_en" type="text" class="form-control" value="<?= esc($rs['tenant_location_en'] ?? '');?>" placeholder="Enter Tenant Location EN (e.g. Zone A, Level 1)"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thumbnail Image <span class="text-danger">*</span></label><br>
                            <div class="image-input image-input-outline" id="kt_image_1">
                                <div class="image-input-wrapper" style="background-image: url(<?= base_url('assets/upload/tenant/'.$rs["tenant_thumbnail_pict"])?>)"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="tenant_thumbnail_pict" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" value="<?= $rs["tenant_thumbnail_pict"];?>" name="tenant_thumbnail_pict_temp">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel logo">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Main Image <span class="text-danger">*</span></label><br>
                            <div class="image-input image-input-outline" id="kt_image_1_x">
                                <div class="image-input-wrapper" style="background-image: url(<?= base_url('assets/upload/tenant/'.$rs["tenant_main_pict"])?>)"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="tenant_main_pict" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" value="<?= $rs["tenant_main_pict"];?>" name="tenant_main_pict_temp">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel logo">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <hr>
                        <h5 class="mb-4">Button & Popup Content</h5>
                        <div class="form-group">
                            <label>Button Text ID <small class="text-muted">(teks tombol, default: "Lihat Detail")</small></label>
                            <input type="text" name="tenant_btn_text" class="form-control" value="<?= esc($rs['tenant_btn_text']??'');?>" placeholder="Lihat Detail">
                        </div>
                        <div class="form-group">
                            <label>Button Text EN <small class="text-muted">(button text, default: "View Details")</small></label>
                            <input type="text" name="tenant_btn_text_en" class="form-control" value="<?= esc($rs['tenant_btn_text_en']??'');?>" placeholder="View Details">
                        </div>
                        <div class="form-group">
                            <label>Popup Image</label><br>
                            <?php if(!empty($rs['tenant_popup_image'])):?>
                            <div class="mb-2"><img src="<?= base_url('assets/upload/tenant/'.esc($rs['tenant_popup_image']));?>" style="max-height:100px;"></div>
                            <?php endif;?>
                            <input type="file" name="tenant_popup_image" class="form-control" accept=".png,.jpg,.jpeg">
                            <input type="hidden" name="tenant_popup_image_temp" value="<?= esc($rs['tenant_popup_image']??'');?>">
                            <small class="text-muted">Gambar khusus untuk popup. Biarkan kosong jika tidak diganti.</small>
                        </div>
                        <div class="form-group">
                            <label>Popup Description ID</label>
                            <textarea name="tenant_popup_desc_id" class="form-control" id="kt-ckeditor-popup-id" rows="6"><?= $rs['tenant_popup_desc_id']??'';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Popup Description EN</label>
                            <textarea name="tenant_popup_desc_en" class="form-control" id="kt-ckeditor-popup-en" rows="6"><?= $rs['tenant_popup_desc_en']??'';?></textarea>
                        </div>
                        <?php foreach(['tenant_gallery1','tenant_gallery2','tenant_gallery3'] as $gi => $gKey):?>
                        <div class="form-group">
                            <label>Gallery Image <?= $gi+1; ?> <?= $gi===0 ? '<span class="text-danger">*</span>' : '';?></label><br>
                            <?php if(!empty($rs[$gKey])):?>
                            <div class="mb-2"><img src="<?= base_url('assets/upload/tenant/'.esc($rs[$gKey]));?>" style="max-height:80px;"></div>
                            <?php endif;?>
                            <input type="file" name="<?= $gKey;?>" class="form-control" accept=".png,.jpg,.jpeg">
                            <input type="hidden" name="<?= $gKey;?>_temp" value="<?= esc($rs[$gKey]??'');?>">
                        </div>
                        <?php endforeach;?>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="tenant_id" value="<?= $rs["tenant_id"];?>">
                        <input type="submit" name="submit" value="Submit Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/visit/tenant');?>" type="reset" class="btn btn-secondary">Cancel</a>
                    </div>
                    <?php } ?>
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