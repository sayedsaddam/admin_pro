<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/chip.png'); ?>" alt="admin-and-procurement" class="img-thumbnail" width="200">
      </div>
      <div class="col-lg-7 col-md-7">
        <h1 class="font-weight-bold">Admin & Procurement</h1>
        <h5 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h5>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Supervisor Dashboard <i class="fa fa-chart-bar"></i></h4>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid my-3 py-3">
  <!--Section: Block Content-->
  <section>
    <?php if($success = $this->session->flashdata('success')): ?>
      <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="alert alert-success">
                  <?= $success; ?>
              </div>
          </div>
      </div>
    <?php endif; ?>
    <!--Grid row-->
    <div class="row mb-4">

      <!--Grid column-->
      <div class="col-lg-6 col-md-12 mb-6">
        <div class="media blue lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-paper-plane fa-3x blue z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
              <p class="text-uppercase mt-2 mb-1 ml-3"><small>leave requests</small></p>
              <p class="font-weight-bold mb-1 ml-3">100</p>
          </div>
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-6 col-md-6 mb-6">
        <div class="media deep-purple lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-envelope fa-3x deep-purple z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>item requests</small></p>
            <p class="font-weight-bold mb-1 ml-3">100</p>
          </div>
        </div>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </section>
  <!--Section: Blocks Content-->

  <!-- Section: Requisitions list -->
  <section>
    <div class="row">
        <div class="col-6">
            <div class="card card-list">
                <div class="card-header white d-flex justify-content-between align-items-center py-3">
                    <p class="h5-responsive font-weight-bold mb-0">Leave Requests</p>
                    <ul class="list-unstyled d-flex align-items-center mb-0">
                    <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
                    <li><i class="fas fa-times fa-sm pl-3"></i></li>
                    </ul>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                            <th class="font-weight-bold">ID</th>
                            <th class="font-weight-bold">Employee</th>
                            <th class="font-weight-bold">Leave From</th>
                            <th class="font-weight-bold">Leave To</th>
                            <th class="font-weight-bold">Days</th>
                            <th class="font-weight-bold">Requested</th>
                            <th class="font-weight-bold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($leaves)): foreach($leaves as $leave): ?>
                            <tr>
                                <td scope="row"><?= 'CTC-'.$leave->id; ?></td>
                                <td><?= ucfirst($leave->fullname); ?></td>
                                <td><?= date('M d, Y', strtotime($leave->leave_from)); ?></td>
                                <td><?= date('M d, Y', strtotime($leave->leave_to)); ?></td>
                                <td><?= $leave->no_of_days; ?></td>
                                <td><?= date('M d, Y', strtotime($leave->created_at)); ?></td>
                                <td><?php if($leave->leave_status == 0){ echo '<span class="badge badge-warning">pending</span>'; }elseif($leave->leave_status == 1){ echo '<span class="badge badge-success">approved</span>'; }else{ echo '<span class="badge badge-dander">rejected</span>'; } ?></td>
                            </tr>
                            <?php endforeach; else: echo '<tr class="table-danger"><td colspan="7" align="center">No record found.</td></tr>'; endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer white py-3 d-flex justify-content-between">
                    <?php echo 'Pagination will be displayed here....'; ?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card card-list">
                <div class="card-header white d-flex justify-content-between align-items-center py-3">
                    <p class="h5-responsive font-weight-bold mb-0">Item Requests</p>
                    <ul class="list-unstyled d-flex align-items-center mb-0">
                    <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
                    <li><i class="fas fa-times fa-sm pl-3"></i></li>
                    </ul>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                            <th class="font-weight-bold">Order ID</th>
                            <th class="font-weight-bold">Item</th>
                            <th class="font-weight-bold">Quantity</th>
                            <th class="font-weight-bold">Desciption</th>
                            <th class="font-weight-bold">Status</th>
                            <th class="font-weight-bold">Requested</th>
                            <th class="font-weight-bold">Processed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($requisitions)): foreach($requisitions as $req): ?>
                            <tr>
                                <td scope="row"><?= 'CTC-0'.$req->id; ?></td>
                                <td><?= ucfirst($req->inv_name); ?></td>
                                <td><?= $req->item_qty; ?></td>
                                <td><?= $req->item_desc; ?></td>
                                <td>
                                <?php if($req->status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }elseif($req->status == 1){ echo "<span class='badge badge-success'>approved</span>"; }else{ echo "<span class='badge badge-danger'>rejected</span>"; } ?>
                                </td>
                                <td><?= date('M d, Y', strtotime($req->created_at)); ?></td>
                                <td>
                                <?php if($req->updated_at != NULL){ echo date('M d, Y', strtotime($req->updated_at)); }else{ echo "<span class='purple-text'>Nothing yet.</span>"; } ?>
                                </td>
                            </tr>
                            <?php endforeach; else: echo '<tr class="table-danger"><td colspan="7" align="center">No record found.</td></tr>'; endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer white py-3 d-flex justify-content-between">
                    <?php echo 'Pagination will be displayed here....'; ?>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!-- Section: Block Content -->
</div>