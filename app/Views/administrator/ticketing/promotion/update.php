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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Promotion update page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Promotion update page </a>
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
            <h3 class="card-label"> Update Promotion <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
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
                <form method="POST" action="<?= base_url('adminsite/ticketing/promotion/runupdate');?>" enctype="multipart/form-data">
                    <?php foreach($getdata AS $rs) {?>
                    <div class="card-body" style="background-color:#F3F6F9;">
                        <div class="form-group">
                            <label>Title ID <span class="text-danger">*</span></label>
                            <input type="text" name="promotion_title" class="form-control" value="<?= $rs["promotion_title"];?>"/>
                            <input type="hidden" name="promotion_id" value="<?= $rs["promotion_id"];?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea">Description ID <span class="text-danger">*</span></label>
                            <textarea name="promotion_desc" class="form-control" placeholder="Enter Description ID" id="kt-ckeditor-1" rows="6"><?= $rs["promotion_desc"];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Title EN <span class="text-danger">*</span></label>
                            <input type="text" name="promoton_title_en" class="form-control" value="<?= $rs["promoton_title_en"];?>"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea">Description EN <span class="text-danger">*</span></label>
                            <textarea name="promotion_desc_en" class="form-control" placeholder="Enter Description ID" id="kt-ckeditor-2" rows="6"><?= $rs["promotion_desc_en"];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Image <span class="text-danger">*</span></label><br>
                            <div class="image-input image-input-outline" id="kt_image_1">
                                <div class="image-input-wrapper" style="background-image: url(<?= base_url('assets/upload/promotion/'.$rs["promotion_pict"])?>)"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="promotion_pict" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" value="<?= $rs["promotion_pict"];?>" name="promotion_pict_temp">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel logo">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Link Promosi (URL)</label>
                            <input name="promotion_link" type="url" class="form-control" placeholder="https://" value="<?= $rs['promotion_link'] ?? ''?>"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="submit" value="Submit Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/ticketing/promotion');?>" type="reset" class="btn btn-secondary">Cancel</a>
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