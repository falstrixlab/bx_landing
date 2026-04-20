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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Setup page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Setup page </a>
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
            <h3 class="card-label"> Data Setup <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
            </h3>
        </div>
        <div class="card-toolbar">
            
            <!--begin::Button-->
            <a href="<?= base_url('adminsite/master/setup/update');?>" class="btn btn-primary font-weight-bolder">
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
                <form>
                    <?php foreach($getdata AS $rs) {?>
                    <div class="card-body" style="background-color:#F3F6F9;">
                        <div class="form-group">
                            <label>Title Landing</label>
                            <p class="form-control-plaintext text-muted"><h5><?= $rs["setup_title"];?></h5></p>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Logo Website</label><br>
                                    <div class="image-input image-input-outline image-input-circle" id="kt_image_1">
                                        <div class="image-input-wrapper" style="background-image: url(<?= base_url('assets/upload/setup/'.$rs["setup_logo"])?>)"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Favicon Website</label><br>
                                    <div class="image-input image-input-outline image-input-circle" id="kt_image_1">
                                        <div class="image-input-wrapper" style="background-image: url(<?= base_url('assets/upload/setup/'.$rs["setup_favicon"])?>)"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Footer Holding Picture</label><br>
                                    <div class="image-input image-input-outline image-input-circle" id="kt_image_1">
                                        <div class="image-input-wrapper" style="background-image: url(<?= base_url('assets/upload/setup/'.$rs["setup_footer_holding_pict"])?>)"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Footer Company Picture</label><br>
                                    <div class="image-input image-input-outline image-input-circle" id="kt_image_1">
                                        <div class="image-input-wrapper" style="background-image: url(<?= base_url('assets/upload/setup/'.$rs["setup_footer_company_pict"])?>)"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea">Company Address</label>
                            <textarea class="form-control" id="exampleTextarea" rows="6" readonly><?= $rs["setup_address"];?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Google Maps Link</label>
                            <input type="text" class="form-control" value="<?= $rs["setup_gmaps"];?>" readonly/>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Operation Day</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" readonly value="<?= $rs["setup_operation_day"];?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Operation Duration</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" readonly value="<?= $rs["setup_operation_duration"];?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" readonly value="<?= $rs["setup_email"];?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Customer Support</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" readonly value="<?= $rs["setup_customer"];?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Phone Number</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" readonly value="<?= $rs["setup_phone"];?>"/>
                                </div>
                            </div>
                        </div>
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