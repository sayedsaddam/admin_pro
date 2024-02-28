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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light">Travels Info | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
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
                        <p class="h5-responsive font-weight-bold mb-0"><?php if(empty($results)){ echo 'Travel History'; }else{ echo 'Search Results for: <span class="text-info">'.$_GET['search'].'</span>'; } ?> | <small><a href="javascript:history.go(-1)" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small></p>
                        <form class="form-inline" action="<?= base_url('admin/search_travel_requisitions'); ?>" method="get">
                            <input type="text" name="search" class="form-control" placeholder="Search in travels...">
                            <input type="submit" class="btn btn-outline-info btn-md rounded" value="Search">
                        </form>
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
                            <?php if(empty($results)): ?>
                                <tbody>
                                    <?php if(!empty($travels)): foreach($travels as $travel): ?>
                                        <tr>
                                            <td><?= 'CTC-0'.$travel->id; ?></td>
                                            <td><?= $travel->fullname; ?></td>
                                            <td><?= ucfirst($travel->visit_of); ?></td>
                                            <td title="<?= $travel->assignment; ?>"><?= substr($travel->assignment, 0, 10).' &hellip;'; ?></td>
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
                                                <a href="<?= base_url('admin/print_travel/'.$travel->id); ?>" class="badge badge-secondary" title="Print request..."><i class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; else: echo "<tr class='table-danger'><td colspan='14' align='center'>No record found.</td></tr>"; endif; ?>
                                </tbody>
                            <?php else: ?>
                                <tbody>
                                    <?php if(!empty($results)): foreach($results as $travel): ?>
                                        <tr>
                                            <td><?= 'CTC-0'.$travel->id; ?></td>
                                            <td><?= $travel->fullname; ?></td>
                                            <td><?= ucfirst($travel->visit_of); ?></td>
                                            <td title="<?= $travel->assignment; ?>"><?= substr($travel->assignment, 0, 10).' &hellip;'; ?></td>
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
                                                <a href="<?= base_url('admin/print_travel/'.$travel->id); ?>" class="badge badge-secondary" title="Print request..."><i class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; else: echo "<tr class='table-danger'><td colspan='14' align='center'>No record found.</td></tr>"; endif; ?>
                                </tbody>
                            <?php endif; ?>
                        </table>
                    </div>
                    <div class="card-footer white py-3 d-flex justify-content-between">
                        <?php if(!empty($travels) & empty($results)){ echo $this->pagination->create_links(); } ?>
                    </div>
                </div>
            </div>
        </div>
  </section>
  <!-- Section: Requisitions -->
</div>
