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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Pending Requests</span></h4>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table table-sm">
                <caption>List of Pending Requests</caption>
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
                    <?php if(!empty($pending_requisitions)): foreach($pending_requisitions as $pen_req): ?>
                    <tr>
                        <td><?= 'CTC-0'.$pen_req->id; ?></td>
                        <td><?= $pen_req->fullname; ?></td>
                        <td><?= ucfirst($pen_req->item_name); ?></td>
                        <td><?= ucfirst($pen_req->item_qty); ?></td>
                        <td>
                            <span class="badge badge-warning">Pending</span>
                        </td>
                        <td><?= date('M d, Y', strtotime($pen_req->created_at)); ?></td>
                        <td>
                            <a href=""><span class="badge badge-primary"><i class="fa fa-check"></i></span></a>
                          <a href=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                          <a href="<?= base_url('admin/request_detail/'.$pen_req->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                        </td>
                    </tr>
                    <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='7'>No record found.</td></tr>"; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>