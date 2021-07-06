<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid">
      </div>
      <div class="col-lg-7 col-md-7">
        <h2 class="display-4 font-weight-bold">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-dark">AH Group of Companies (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Approved Requests | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <table class="table table-sm">
        <caption>List of Approved Requests</caption>
        <thead>
          <tr>
            <th class="font-weight-bold">ID</th>
            <th class="font-weight-bold">Requested by</th>
            <th class="font-weight-bold">Item Name</th>
            <th class="font-weight-bold">Item Qty</th>
            <th class="font-weight-bold">Status</th>
            <th class="font-weight-bold">Date</th>
            <th class="font-weight-bold">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($approved_requisitions)): foreach($approved_requisitions as $app_req): ?>
          <tr>
            <th><?= 'CTC-0'.$app_req->id; ?></th>
            <td><?= $app_req->fullname; ?></td>
            <td><?= ucfirst($app_req->inv_name); ?></td>
            <td><?= ucfirst($app_req->item_qty); ?></td>
            <td>
                <span class="badge badge-success">Approved</span>
            </td>
            <td><?= date('M d, Y', strtotime($app_req->created_at)); ?></td>
            <td>
                <a href=""><span class="badge badge-primary"><i class="fa fa-check"></i></span></a>
              <a href=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
              <a href="<?= base_url('admin/request_detail/'.$app_req->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
            </td>
          </tr>
          <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='7'>No record found.</td></tr>"; endif;  ?>
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