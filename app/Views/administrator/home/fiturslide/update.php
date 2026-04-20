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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Fitur slide update page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Fitur slide update page </a>
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
            <h3 class="card-label"> Update Fitur Slide <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
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
                <form method="POST" action="<?= base_url('adminsite/home/fiturslide/runupdate');?>" enctype="multipart/form-data">
                    <?php foreach($getdata AS $rs) {?>
                    <div class="card-body" style="background-color:#F3F6F9;">
                        <div class="form-group">
                            <label>Title ID <span class="text-danger">*</span></label>
                            <input type="text" name="homefiturslide_title" class="form-control" value="<?= $rs["homefiturslide_title"];?>"/>
                            <input type="hidden" name="homefiturslide_id" value="<?= $rs["homefiturslide_id"];?>">
                        </div>
                        <div class="form-group">
                            <label>Title EN <span class="text-danger">*</span></label>
                            <input type="text" name="homefiturslide_title_en" class="form-control" value="<?= $rs["homefiturslide_title_en"];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Short Desc ID <span class="text-danger">*</span></label>
                            <textarea maxlength="105" name="homefiturslide_shortdesc" class="form-control" placeholder="Maximum 105 Charactes" rows="6"><?= $rs["homefiturslide_shortdesc"];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Short Desc EN <span class="text-danger">*</span></label>
                            <textarea maxlength="105" name="homefiturslide_shortdesc_en" class="form-control" placeholder="Maximum 105 Charactes" rows="6"><?= $rs["homefiturslide_shortdesc_en"];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Image <span class="text-danger">*</span></label><br>
                            <div class="image-input image-input-outline" id="kt_image_1">
                                <div class="image-input-wrapper" style="background-image: url(<?= base_url('assets/upload/fiturslide/'.$rs["homefitureslide_pict"])?>)"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="homefitureslide_pict" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" value="<?= $rs["homefitureslide_pict"];?>" name="homefitureslide_pict_temp">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel logo">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Link <span class="text-danger">*</span></label>
                            <input type="text" name="homefitureslide_link" class="form-control" value="<?= $rs["homefitureslide_link"];?>"/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="submit" value="Submit Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/home/fiturslide');?>" type="reset" class="btn btn-secondary">Cancel</a>
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