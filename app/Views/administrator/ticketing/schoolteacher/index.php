<?= $this->extend('administrator/layoutadmin'); ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">Teacher Testimonials</h5>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Teacher Testimonials <span class="d-block text-muted pt-2 font-size-sm">Latest entry will be displayed</span></h3>
                </div>
                <div class="card-toolbar">
                    <a href="<?= base_url('adminsite/ticketing/schoolteacher/add');?>" class="btn btn-primary font-weight-bolder"><span class="svg-icon svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="9" cy="15" r="6"/><path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"/></g></svg></span> Add New</a>
                </div>
            </div>
            <div class="card-body">
                <?php if(session()->getFlashdata('success')):?>
                    <div class="alert alert-success alert-dismissible"><strong>Success!</strong> Data processed successfully.</div>
                <?php endif;?>
                <table class="table table-bordered table-checkable" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Title ID</th>
                            <th>Image</th>
                            <th>Created</th>
                            <th style="width:150px !important;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($getdata AS $rs) {?>
                        <tr>
                            <td><?= $i;?></td>
                            <td><?= esc($rs["teacher_name"]);?></td>
                            <td><?= esc($rs["teacher_title_id"]);?></td>
                            <td>
                                <?php if(!empty($rs['teacher_image'])): ?>
                                <div class="image-input image-input-outline image-input-circle" style="background-image: url(<?= base_url('assets/upload/school_teacher/'.$rs["teacher_image"])?>);width:50px;height:50px;background-size:cover;"></div>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d M Y H:i', strtotime($rs['teacher_created_at']));?></td>
                            <td>
                                <a class="btn btn-icon btn-sm btn-light-warning pulse pulse-warning mr-2" href="<?= base_url('adminsite/ticketing/schoolteacher/update/'.$rs["teacher_id"])?>"><i class="flaticon2-pen"></i></a>
                                <a onclick="return confirm('Delete this testimonial?')" class="btn btn-sm btn-icon btn-light-danger pulse pulse-danger" href="<?= base_url('adminsite/ticketing/schoolteacher/delete/'.$rs["teacher_id"])?>"><i class="flaticon2-rubbish-bin-delete-button"></i></a>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
