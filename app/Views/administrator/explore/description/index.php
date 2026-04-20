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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Description page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Description page </a>
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
            <h3 class="card-label"> Data Description <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
            </h3>
        </div>
        <!-- <div class="card-toolbar">
            
            
            <a href="<?= base_url('adminsite/explore/description/add');?>" class="btn btn-primary font-weight-bolder">
            <span class="svg-icon svg-icon-md">
                
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24" />
                    <circle fill="#000000" cx="9" cy="15" r="6" />
                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                </g>
                </svg>
                
            </span> New Record </a>
            
        </div> -->
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
        <!--begin: Datatable-->
        <table class="table table-bordered table-checkable" id="kt_datatable">
            <thead>
            <tr>
                <th>Record ID</th>
                <th>Title ID</th>
                <th>Title EN</th>
                <th>Desc ID</th>
                <th>Desc EN</th>
                <th>Positon</th>
                <th style="width: 150px !important;">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach($getdesc AS $rs) {?>
            <tr>
                <td><?= $i;?></td>
                <td><?= $rs["masterdesc_title"];?></td>
                <td><?= $rs["masterdesc_title_en"];?></td>
                <td><?= $rs["masterdesc_desc"];?></td>
                <td><?= $rs["masterdesc_desc_en"];?></td>
                <td><span class="label label-pill label-inline label-lg"><?= $rs["masterdesc_position"];?></span></td>
                <td>
                    <a class="btn btn-icon btn-sm btn-light-warning pulse pulse-warning mr-5" href="<?= base_url('adminsite/explore/description/update/'.$rs["masterdesc_id"])?>">
                        <i class="flaticon-edit-1 icon-lg" title="Edit Content"></i>
                        <span class="pulse-ring"></span>
                    </a>
                    <!-- <a onclick="return confirm('Are you sure you want to delete this data ?')" class="btn btn-sm btn-icon btn-light-danger pulse pulse-danger mr-5" href="<?= base_url('adminsite/explore/description/delete/'.$rs["masterdesc_id"])?>">
                        <i class="flaticon2-trash icon-lg" title="Delete Content"></i>
                        <span class="pulse-ring"></span>
                    </a> -->
                </td>
            </tr>
            <?php $i++;} ?>
            </tbody>
        </table>
        <!--end: Datatable-->
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