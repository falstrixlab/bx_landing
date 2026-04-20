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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Map update page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Map update page </a>
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
            <h3 class="card-label"> Update Map <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
            </h3>
        </div>
        <div class="card-toolbar">
            
            <!--begin::Button-->
            <a href="<?= base_url('adminsite/visit/guide/update');?>" class="btn btn-primary font-weight-bolder">
            <span class="svg-icon svg-icon-md">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24" />
                    <circle fill="#000000" cx="9" cy="15" r="6" />
                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                </g>
                </svg>
                <!--end::Svg Icon-->
            </span> Update Data </a>
            <!--end::Button-->
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
                <form method="POST" action="<?= base_url('adminsite/visit/map/runupdate');?>" enctype="multipart/form-data">
                    <?php foreach($getdata AS $rs) {?>
                    <div class="card-body" style="background-color:#F3F6F9;">
                        <div class="form-group">
                            <label>Title ID <span class="text-danger">*</span></label>
                            <input type="text" name="map_title" class="form-control" value="<?= $rs["map_title"];?>"/>
                            <input type="hidden" name="map_id" value="<?= $rs["map_id"];?>">
                        </div>
                        <div class="form-group">
                            <label>Title EN <span class="text-danger">*</span></label>
                            <input type="text" name="map_title_en" class="form-control" value="<?= $rs["map_title_en"];?>"/>
                        </div>
                        <div class="form-group">
                            <label>Description ID <span class="text-danger">*</span></label>
                            <textarea name="map_desc" class="form-control" placeholder="Enter Description ID" id="kt-ckeditor-1" rows="6"><?= $rs["map_desc"];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Description EN <span class="text-danger">*</span></label>
                            <textarea name="map_desc_en" class="form-control" placeholder="Enter Description EN" id="kt-ckeditor-2" rows="6"><?= $rs["map_desc_en"];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Picture <span class="text-danger">*</span></label><br>
                            <div class="image-input image-input-outline" id="kt_image_1">
                                <div class="image-input-wrapper" style="background-image: url(<?= base_url('assets/upload/map/'.$rs["map_pict"])?>)"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="map_pict" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" value="<?= $rs["map_pict"];?>" name="map_pict_temp">
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel logo">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>File<span class="text-danger">*</span></label><br>
                            <a href="<?= base_url('assets/upload/map/'.$rs["map_file"])?>"><h3>Download Link File</h3></a>
                            <input type="file" name="map_file" class="form-control">
                            <input type="hidden" value="<?= $rs["map_file"];?>" name="map_file_temp">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="submit" value="Submit Data" class="btn btn-success mr-2">
                        <a href="<?= base_url('adminsite/visit/map');?>" type="reset" class="btn btn-secondary">Cancel</a>
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