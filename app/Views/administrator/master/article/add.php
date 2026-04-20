<?= $this->extend('administrator/layoutadmin2'); ?>
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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> News & article page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> News & article page </a>
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
            <h3 class="card-label">Add News & Article <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
            </h3>
        </div>
        
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('failed')):?>
                <div class="alert alert-danger alert-dismissible">
                    <strong>Warning!</strong> <?= esc(session()->getFlashdata('failed'));?>
                </div>
            <?php endif;?>
            <?php if(session()->getFlashdata('failedmovefile')):?>
                <div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> Failed to upload file.
                </div>
            <?php endif;?>
            <?php if(session()->getFlashdata('invalidate')):?>
                <div class="alert alert-danger alert-dismissible">
                    <strong>Error!</strong> <?= esc(session()->getFlashdata('invalidate'));?>
                </div>
            <?php endif;?>
            <div class="card card-custom">
                <!--begin::Form-->
                <form method="POST" action="<?= base_url('adminsite/master/article/runadd');?>" enctype="multipart/form-data">
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
                            <input name="article_title" type="text" class="form-control"  placeholder="Enter Title ID" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Title EN <span class="text-danger">*</span></label>
                            <input name="article_title_en" type="text" class="form-control"  placeholder="Enter Title EN" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Description ID <span class="text-danger">*</span></label>
                            <textarea name="article_desc" class="form-control js-quill-editor" data-editor="quill" placeholder="Enter Description ID" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Description EN <span class="text-danger">*</span></label>
                            <textarea name="article_desc_en" class="form-control js-quill-editor" data-editor="quill" placeholder="Enter Description EN" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea">Picture <span class="text-danger">*</span></label>
                            <input type="file" name="article_pict" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Author <span class="text-danger">*</span></label>
                            <input name="article_author" type="text" class="form-control"  placeholder="Enter Name Social Media" required="required"/>
                        </div>
                        <div class="form-group">
                            <label>Category <span class="text-danger">*</span></label>
                            <select class="form-control" name="article_category" required="required">
                                <option value="">Select Category</option>
                                <?php foreach($getdata AS $rs) {?>
                                    <option value="<?= $rs["articlecat_id"];?>"><?= $rs["articlecat_name"];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="submit" value="Submit Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/master/article');?>" type="reset" class="btn btn-secondary">Cancel</a>
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