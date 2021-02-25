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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Suppliers</span></h4>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="row mb-4">
        <div class="col-lg-6 col-md-6">
            <form action="#0" method="get" class="md-form form-inline">
                <input type="text" name="search" id="" class="form-control md-form col-5">
                <label for="">Search Query</label>
                <input type="submit" value="go" class="btn btn-outline-info btn-sm">
            </form>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
            <button class="btn btn-outline-primary"><i class="fa fa-plus"></i> Add New</button>
            <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
        <table class="table table-sm">
            <caption>List of Suppliers</caption>
            <thead>
            <tr>
                <th class="font-weight-bold">ID</th>
                <th class="font-weight-bold">Supplier Name</th>
                <th class="font-weight-bold">Supplier Email</th>
                <th class="font-weight-bold">Supplier Phone</th>
                <th class="font-weight-bold">Status</th>
                <th class="font-weight-bold">Date</th>
                <th class="font-weight-bold">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($supplierr)): foreach($supplierr as $sup): ?>
                <tr>
                <td><?= 'CTC-0'.$sup->id; ?></td>
                <td><?= $sup->name; ?></td>
                <td><?= ucfirst($sup->email); ?></td>
                <td><?= ucfirst($sup->phone); ?></td>
                <td>
                    <?php if($sup->status == 1): ?>
                        <span class="badge badge-success">Active</span>
                    <?php else: ?>
                        <span class="badge badge-danger">Inactive</span>
                    <?php endif; ?>
                </td>
                <td><?= date('M d, Y', strtotime($sup->created_at)); ?></td>
                <td>
                    <a href=""><span class="badge badge-primary"><i class="fa fa-check"></i></span></a>
                    <a href=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                    <a href="<?= base_url('admin/request_detail/'.$sup->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                </td>
                </tr>
            <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='7'>No record found.</td></tr>"; endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>