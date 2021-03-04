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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Asset Register | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
    <?php if($success = $this->session->flashdata('success')): ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="alert alert-success"><?=$success;?></div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row mb-4">
        <div class="col-lg-6 col-md-6">
            <form action="#0" method="get" class="md-form form-inline">
                <input type="text" name="search" id="" class="form-control md-form col-5">
                <label for="">Search Query</label>
                <input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
            </form>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
            <a href="<?= base_url('admin/add_asset'); ?>" data-target="#add_supplier" class="btn btn-outline-info"><i class="fa fa-plus"></i> Add New</a>
            <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <table class="table table-sm">
          <caption>List of Assets</caption>
          <thead>
            <tr>
                <th class="font-weight-bold">ID</th>
                <th class="font-weight-bold">Year</th>
                <th class="font-weight-bold">Project</th>
                <th class="font-weight-bold">Item</th>
                <!-- <th class="font-weight-bold">Model</th> -->
                <th class="font-weight-bold">Asset Code</th>
                <th class="font-weight-bold">Serial #</th>
                <th class="font-weight-bold">Custodian</th>
                <th class="font-weight-bold">Designation</th>
                <th class="font-weight-bold">Department</th>
                <th class="font-weight-bold">Purchase</th>
                <th class="font-weight-bold">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($assets)): foreach($assets as $asset): ?>
              <tr>
                <td><?= 'CTC-0'.$asset->id; ?></td>
                <td><?= $asset->year; ?></td>
                <td><?= ucfirst($asset->project); ?></td>
                <td><?= ucfirst($asset->item); ?></td>
                <!-- <td><?= ucfirst($asset->model); ?></td> -->
                <td><?= ucfirst($asset->asset_code); ?></td>
                <td><?= ucfirst($asset->serial_number); ?></td>
                <td><?= ucfirst($asset->custodian_location); ?></td>
                <td><?= ucfirst($asset->designation); ?></td>
                <td><?= ucfirst($asset->department); ?></td>
                <td><?= date('M d, Y', strtotime($asset->purchase_date)); ?></td>
                <td>
                    <a href="<?= base_url('admin/asset_detail/'.$asset->id); ?>"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                    <a href="<?=base_url('admin/delete_asset/'.$asset->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                </td>
              </tr>
            <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='11'>No record found.</td></tr>"; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <?= $this->pagination->create_links(); ?>
      </div>
    </div>
</div>