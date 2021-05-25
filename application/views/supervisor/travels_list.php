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
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light">Travel History</span> | <a href="<?=base_url('users');?>" class="text-light">Home</a></h4>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid my-3 py-3">
  <!-- Section: Requisitions list -->
  <section>
    <div class="row mt-4">
        <div class="col-12">
                <div class="card card-list">
                    <div class="card-header white d-flex justify-content-between align-items-center py-3">
                        <p class="h5-responsive font-weight-bold mb-0">Travel History | <small><a href="javascript:history.go(-1)" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small></p>
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
                                    <th class="font-weight-bold">Visit of</th>
                                    <th class="font-weight-bold">Assignment</th>
                                    <th class="font-weight-bold">Place of Visit</th>
                                    <th class="font-weight-bold">Request Type</th>
                                    <th class="font-weight-bold">Stay Req. Type</th>
                                    <th class="font-weight-bold">Staying At</th>
                                    <th class="font-weight-bold">From</th>
                                    <th class="font-weight-bold">To</th>
                                    <th class="font-weight-bold">Charge To</th>
                                    <th class="font-weight-bold">Status</th>
                                    <th class="font-weight-bold">Requested On</th>
                                    <th class="font-weight-bold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($travels)): foreach($travels as $travel): ?>
                                <tr>
                                    <td><?= 'CTC-0'.$travel->id; ?></td>
                                    <td><?= $travel->fullname; ?></td>
                                    <td><?= ucfirst($travel->visit_of); ?></td>
                                    <td><?= $travel->assignment; ?></td>
                                    <td><?= $travel->place_of_visit; ?></td>
                                    <td><?= ucfirst($travel->request_type); ?></td>
                                    <td><?= ucfirst($travel->stay_request_type); ?></td>
                                    <td><?= ucfirst($travel->staying_at); ?></td>
                                    <td><?= date('M d, Y', strtotime($travel->visit_date_start)); ?></td>
                                    <td><?= date('M d, Y', strtotime($travel->visit_date_end)); ?></td>
                                    <td><?= ucfirst($travel->charge_to); ?></td>
                                    <td>
                                        <?php if($travel->travel_status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }elseif($travel->travel_status == 1){ echo "<span class='badge badge-success'>approved</span>"; }else{ echo "<span class='badge badge-danger'>rejected</span>"; } ?>
                                    </td>
                                    <td><?= date('M d, Y', strtotime($travel->created_at)); ?></td>
                                    <td>
                                        <a href="<?= base_url('supervisor/approve_travel/'.$travel->id); ?>" class="badge badge-primary" title="Approve request..." onclick="javascript: return confirm('Are you sure to perform this action?');"><i class="fa fa-check"></i></a>
                                        <a href="<?= base_url('supervisor/reject_travel/'.$travel->id); ?>" class="badge badge-danger" title="Reject request..." onclick="javascript: return confirm('Are you sure to perform this action?');"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; else: echo "<tr class='table-danger'><td colspan='7' align='center'>No record found.</td></tr>"; endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer white py-3 d-flex justify-content-between">
                        <a href="<?= base_url('supervisor/view_travel_history'); ?>" class="btn btn-outline-primary">view all</a>
                    </div>
                </div>
            </div>
        </div>
  </section>
  <!-- Section: Requisitions -->
</div>