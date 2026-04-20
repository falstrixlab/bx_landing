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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Experience page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Experience page </a>
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
            <h3 class="card-label">Add Data Experience <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
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
                <form method="POST" action="<?= base_url('adminsite/ticketing/experience/runadd');?>" enctype="multipart/form-data">
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
                            <label>Title ID <span class="text-danger">*</span></label>
                            <input name="experience_title" type="text" class="form-control"  placeholder="Enter Title ID" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Title EN <span class="text-danger">*</span></label>
                            <input name="experience_title_en" type="text" class="form-control"  placeholder="Enter Title EN" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea">Description ID <span class="text-danger">*</span></label>
                            <textarea name="experience_desc" class="form-control" placeholder="Enter Description ID" id="exampleTextarea" rows="6" required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea">Description EN <span class="text-danger">*</span></label>
                            <textarea name="experience_desc_en" class="form-control" placeholder="Enter Description EN" id="exampleTextarea" rows="6" required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Schedule ID <span class="text-danger">*</span></label>
                            <input name="experience_schedule" type="text" class="form-control"  placeholder="Enter Schedule ID" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Schedule EN <span class="text-danger">*</span></label>
                            <input name="experience_schedule_en" type="text" class="form-control"  placeholder="Enter Schedule EN" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Duration ID <span class="text-danger">*</span></label>
                            <input name="experience_duration" type="text" class="form-control"  placeholder="Enter Duration ID" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Duration EN <span class="text-danger">*</span></label>
                            <input name="experience_duration_en" type="text" class="form-control"  placeholder="Enter Duration EN" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Age ID <span class="text-danger">*</span></label>
                            <input name="experience_age" type="text" class="form-control"  placeholder="Enter Age ID" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Age EN <span class="text-danger">*</span></label>
                            <input name="experience_age_en" type="text" class="form-control"  placeholder="Enter Age EN" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea">Price <span class="text-danger">*</span></label>
                            <textarea name="experience_price" class="form-control" placeholder="Enter Price" id="exampleTextarea" rows="6" required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto Experience</label>
                            <input type="file" name="experience_pict" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG</small>
                        </div>
                        <div class="form-group">
                            <label>Link Pembelian (URL)</label>
                            <input name="experience_link" type="url" class="form-control" placeholder="https://"/>
                        </div>
                        <div class="form-group">
                            <label>Status Experience <span class="text-danger">*</span></label>
                            <select class="form-control" name="experience_status" required="required">
                                <option value="">Select Status Experience</option>
                                <option value="1">Available</option>
                                <option value="0">coming soon</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="submit" value="Submit Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/ticketing/experience');?>" type="reset" class="btn btn-secondary">Cancel</a>
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