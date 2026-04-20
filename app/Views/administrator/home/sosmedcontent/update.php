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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Sosmed Content update page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Sosmed Content update page </a>
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
            <h3 class="card-label"> Update Sosmed Content <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
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
                <form method="POST" action="<?= base_url('adminsite/home/sosmedcontent/runupdate');?>" enctype="multipart/form-data">
                    <?php foreach($getdata AS $rs) {?>
                    <div class="card-body" style="background-color:#F3F6F9;">
                        <?php $extension = explode('.',$rs["sosmedcontent_file"]);?>
                        <?php if ($extension[1] == 'mp4') {?>
                        <div class="form-group">
                            <label for="exampleInputPassword1">File <span class="text-danger">*</span></label><br>
                            <video width="200" height="200" controls>
                                <source src="<?= base_url('assets/upload/sosmedcontent/'.$rs["sosmedcontent_file"])?>" type="video/mp4">
                            </video>
                            <input type="file" class="form-control" name="sosmedcontent_file"><br>
                          <p>The video format accepted by the system is <b>MP4</b></p>
                            <input type="hidden" value="<?= $rs["sosmedcontent_file"];?>" name="sosmedcontent_file_temp">
                        </div>
                        <?php } else { ?>
                            <div class="form-group">
                            <label for="exampleInputPassword1">File <span class="text-danger">*</span></label><br>
                            <img src="<?= base_url('assets/upload/sosmedcontent/'.$rs["sosmedcontent_file"])?>" alt="" style="width:300px; height:300px;">
                            <input type="file" class="form-control" name="sosmedcontent_file"><br>
                              <p>The video format accepted by the system is <b>MP4</b></p>
                            <input type="hidden" value="<?= $rs["sosmedcontent_file"];?>" name="sosmedcontent_file_temp">
                        </div>
                        <?php }?>
                        <div class="form-group">
                            <label>Link <span class="text-danger">*</span></label>
                            <input type="text" name="sosmedcontent_link" class="form-control" value="<?= $rs["sosmedcontent_link"];?>"/>
                            <input type="hidden" name="sosmedcontent_id" value="<?= $rs["sosmedcontent_id"];?>">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="submit" value="Submit Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/home/sosmedcontent');?>" type="reset" class="btn btn-secondary">Cancel</a>
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