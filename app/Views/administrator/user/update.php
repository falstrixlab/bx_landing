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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> User update page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> User update page </a>
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
            <h3 class="card-label">Update Data User <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
            </h3>
        </div>
        
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('failed')):?>
                <div class="alert alert-danger alert-dismissible">
                    <strong>Warning!</strong> Failed perform the data update process.
                </div>
            <?php endif;?>
            <?php if(session()->getFlashdata('failedmovefile')):?>
                <div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> Failed to upload file.
                </div>
            <?php endif;?>
            <div class="card card-custom">
                <?php foreach($getdata AS $rs) {?>
                <!--begin::Form-->
                <form method="POST" action="<?= base_url('adminsite/user/runupdate');?>" enctype="multipart/form-data">
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
                            <label>Fullname<span class="text-danger">*</span></label>
                            <input name="user_fullname" value="<?= $rs["user_fullname"];?>" type="text" class="form-control"  placeholder="Enter Full Name" required="required"/>
                            <input type="hidden" name="user_id" value="<?= $rs["user_id"];?>">
                        </div>
                        <div class="form-group">
                            <label>Username<span class="text-danger">*</span></label>
                            <input name="user_username" value="<?= $rs["user_username"];?>" type="text" class="form-control"  placeholder="Enter User Name" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Role <span class="text-danger">*</span></label>
                            <select class="form-control" name="user_role" required="required">
                                <option value="">Select Role</option>
                                <option value="1" <?= ($rs["user_role"] == 1) ? 'selected="selected"' : '';?>>Super Administrator</option>
                                <option value="2" <?= ($rs["user_role"] == 2) ? 'selected="selected"' : '';?>>Administrator</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="submit" value="Submit Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/user');?>" type="reset" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
                <!--end::Form-->
                <?php } ?>
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