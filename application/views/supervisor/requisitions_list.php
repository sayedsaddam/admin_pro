<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
				<h2 class="display-4 font-weight-bold" title="Human resource Information Management">HRIM</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i><span class="font-weight-light">Requisitions List</span> | <a href="<?=base_url('users');?>" class="text-light">Home</a></h4>
      </div>
    </div>
  </div>
</div>

<div class="container my-3 py-3">

  <!-- Section: Requisitions list -->
  <section>
    <div class="row">
      <div class="col-12">
      	<div class="card card-list">
          <div class="card-header white d-flex justify-content-between align-items-center py-3">
            <p class="h5-responsive font-weight-bold mb-0">Recent Requisitions | <small><a href="javascript:history.go(-1)" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small></p>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
              <li><i class="fas fa-times fa-sm pl-3"></i></li>
            </ul>
          </div>
          <div class="card-body">
            <table class="table table-sm">
            <caption>Requisitions List</caption>
                <thead>
                    <tr>
                        <th class="font-weight-bold">Order ID</th>
                        <th class="font-weight-bold">Employee</th>
                        <th class="font-weight-bold">Item</th>
                        <th class="font-weight-bold">Quantity</th>
                        <th class="font-weight-bold">Desciption</th>
                        <th class="font-weight-bold">Requested</th>
                        <th class="font-weight-bold">Status</th>
                        <th class="font-weight-bold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($requisitions)): foreach($requisitions as $req): ?>
                    <tr>
                        <td><?= 'CTC-'.$req->id; ?></td>
                        <td><?= $req->fullname; ?></td>
                        <td><?= ucfirst($req->inv_name); ?></td>
                        <td><?= $req->item_qty; ?></td>
                        <td><?= $req->item_desc; ?></td>
                        <td><?= date('M d, Y', strtotime($req->created_at)); ?></td>
                        <td>
                        <?php if($req->status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }elseif($req->status == 1){ echo "<span class='badge badge-success'>approved</span>"; }else{ echo "<span class='badge badge-danger'>rejected</span>"; } ?>
                        </td>
                        <td>
                        <a href="<?= base_url('supervisor/approve_request/'.$req->id); ?>" class="badge badge-primary" title="Approve request..." onclick="javascript: return confirm('Are you sure to perform this action?');"><i class="fa fa-check"></i></a>
                        <a href="<?= base_url('supervisor/reject_request/'.$req->id); ?>" class="badge badge-danger" title="Reject request..." onclick="javascript: return confirm('Are you sure to perform this action?');"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; else: echo '<tr class="table-danger"><td colspan="7" align="center">No record found.</td></tr>'; endif; ?>
                </tbody>
            </table>
          </div>
          <div class="card-footer white py-3 d-flex justify-content-between">
            <?= $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Requisitions -->
</div>
