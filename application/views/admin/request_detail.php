<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <h2 class="display-4 font-weight-bold">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light">Request Detail</span></h4>
      </div>
    </div>
  </div>
</div>
<!-- Container -->
<div class="container my-3 py-3">
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <!-- Card -->
            <div class="card purple-gradient">
                <!-- Card content -->
                <div class="card-body white-text">
                <!-- Title -->
                <h4 class="card-title">Requester Info</h4>
                <hr>
                <h3 class="font-weight-light"><?= $request_detail->fullname; ?></h3>
                <h3 class="font-weight-light"><?= $request_detail->email; ?></h3>
                <h3 class="font-weight-light"><?= ucfirst($request_detail->location); ?></h3>
                <h3 class="font-weight-light"><?php if($request_detail->user_role == 'user'){ echo "Employee"; }else{ echo "Admininstrator"; } ?></h3>
                </div>
            </div>
            <!-- Card -->
        </div>
        <div class="col-lg-8 col-md-8">
            <!-- Card -->
            <div class="card">
                <!-- Card content -->
                <div class="card-body font-weight-light">
                    <!-- Title -->
                    <h4 class="card-title">Item Info</h4>
                    <hr>
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-3">
                            Item Name
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <?= ucfirst($request_detail->item_name); ?>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-3">
                            Item Description
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <?= ucfirst($request_detail->item_desc); ?>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-3">
                            Item Quantity
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <?= $request_detail->item_qty; ?>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-3">
                            Requested On
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <?= date('M d, Y', strtotime($request_detail->created_at)); ?>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-12 col-md-12">
                            <a href="<?= base_url('admin/approve_request/'.$request_detail->id); ?>" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                            <a href="<?= base_url('admin/reject_request/'.$request_detail->id); ?>" class="btn btn-secondary"><i class="fa fa-times"></i> Reject</a>
                            <a href="javascript:history.go(-1)" class="btn btn-danger"><i class="fa fa-angle-left"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card -->
        </div>
    </div>
</div>