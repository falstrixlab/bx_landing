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
        <h5 class="text-dark font-weight-bold my-1 mr-5"> Contact page </h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Base </a>
            </li>
            <li class="breadcrumb-item text-muted">
            <a href="#" class="text-muted"> Contact page </a>
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
            <h3 class="card-label"> Contact Page <span class="d-block text-muted pt-2 font-size-sm">sorting & pagination remote datasource</span>
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
        <!--begin: Datatable-->
        <table class="table table-bordered table-checkable" id="kt_datatable">
            <thead>
            <tr>
                <th>Record ID</th>
                <th>Fullname</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Desc</th>
                <th style="width: 150px !important;">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach($getdata AS $rs) {?>
            <tr>
                <td><?= $i;?></td>
                <td><?= $rs["contact_fullname"];?></td>
                <td><?= $rs["contact_phone"];?></td>
                <td><?= $rs["contact_email"];?></td>
                <td><?= $rs["contact_desc"];?></td>
                <td>
                    <a onclick="return confirm('Are you sure you want to delete this data ?')" class="btn btn-sm btn-icon btn-light-danger pulse pulse-danger mr-5" href="<?= base_url('adminsite/visit/contact/delete/'.$rs["contact_id"])?>">
                        <i class="flaticon2-trash icon-lg" title="Delete Content"></i>
                        <span class="pulse-ring"></span>
                    </a>
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