<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid">
      </div>
      <div class="col-lg-7 col-md-7">
        <h1 class="font-weight-bold mb-0">Admin & Procurement |<a href="<?= base_url('users'); ?>" class="btn btn-outline-light" title="Click to go to employee board where you can place requisition, apply leave & other stuff...">employee dashboard</a></h1>
        <h5 class="font-weight-bold text-light">AH Group of Companies (Pvt.) Ltd.</h5>
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
    <div class="row mb-6">

      <!--Grid column-->
      <div class="col-lg-6 col-md-6 mb-4">
        <div class="media deep-purple lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-envelope fa-3x deep-purple z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>item requests</small></p>
            <p class="font-weight-bold mb-1 ml-3"><?= $total_requisitions; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->
      <!--Grid column-->
      <div class="col-lg-6 col-md-6 mb-4">
        <div class="media green lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-plane fa-3x green z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>travel requests</small></p>
            <p class="font-weight-bold mb-1 ml-3"><?= $total_travels; ?></p>
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
      <div class="col-12">
          <div class="card card-list">
              <div class="card-header white d-flex justify-content-between align-items-center py-3">
                  <p class="h5-responsive font-weight-bold mb-0">Item Requests</p>
                  <small>Hover the mouse cursor over the description to view complete detail.</small>
                  </ul>
              </div>
              <div class="card-body">
                  <table class="table table-sm">
                      <thead>
                          <tr>
                          <th class="font-weight-bold">Order ID</th>
                          <th class="font-weight-bold">Employee</th>
                          <th class="font-weight-bold">Item</th>
                          <th class="font-weight-bold">Category</th>
                          <th class="font-weight-bold">Quantity</th>
                          <th class="font-weight-bold">Description</th>
                          <th class="font-weight-bold">Requested</th>
                          <th class="font-weight-bold">Status</th>
                          <th class="font-weight-bold">Processed</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if(!empty($requisitions)): foreach($requisitions as $req): ?>
                          <tr>
                              <td scope="row"><?= 'AHG-'.$req->id; ?></td>
                              <td><?= ucfirst($req->fullname); ?></td>
                              <td><?= ucfirst($req->sub_cat_name); ?></td>
                              <td><?= ucfirst($req->cat_name); ?></td>
                              <td><?= $req->item_qty; ?></td>
                              <td title="<?= $req->item_desc; ?>"><?= substr($req->item_desc, 0, 10).' &hellip;'; ?></td>
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
                  <a href="<?= base_url('supervisor/view_all_requisitions') ?>" class="btn btn-outline-primary">View All</a>
              </div>
          </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
        <div class="card card-list">
          <div class="card-header white d-flex justify-content-between align-items-center py-3">
            <p class="h5-responsive font-weight-bold mb-0">Travel History</p>
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
                    <td><?= 'AHG-0'.$travel->id; ?></td>
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
  <!-- Section: Block Content -->
</div>
<!-- Modal > Leave approval -->
<div class="modal fade" id="approve_leave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Leave Approval Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <form action="<?= base_url('supervisor/approve_leave'); ?>" method="post">
                    <input type="hidden" name="id" id="app_leave_id" value="">
                    <div class="form-group">
                        <label for="remarks">Supervisor Remarks</label>
                        <textarea name="remarks" rows="3" id="app_sup_remarks" class="form-control" placeholder="Supervisor Remarks..."></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal > Leave rejection. -->
<div class="modal fade" id="reject_leave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Leave Rejection Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <form action="<?= base_url('supervisor/reject_leave'); ?>" method="post">
                    <input type="hidden" name="id" id="rej_leave_id" value="">
                    <div class="form-group">
                        <label for="remarks">Supervisor Remarks</label>
                        <textarea name="remarks" id="rej_sup_remarks" rows="3" class="form-control" placeholder="Supervisor Remarks..."></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $('.approve_leave').click(function(){  // Leave approval modal will be displayed.
    var leave_id = $(this).data('id');
    // AJAX request
    $.ajax({
    url: '<?= base_url('supervisor/leave_info/'); ?>' + leave_id,
    method: 'POST',
    dataType: 'JSON',
    data: {leave_id: leave_id},
      success: function(response){ 
        console.log(response);
        $('#app_leave_id').val(response.id);
        $('#app_sup_remarks').val(response.sup_remarks);
        // Display Modal
        $('#approve_leave').modal('show'); 
      }
    });
  });
  // 
  $('.reject_leave').click(function(){  
    var leave_id = $(this).data('id');
    // AJAX request
    $.ajax({
    url: '<?= base_url('supervisor/leave_info/'); ?>' + leave_id,
    method: 'POST',
    dataType: 'JSON',
    data: {leave_id: leave_id},
      success: function(response){ 
        console.log(response);
        $('#rej_leave_id').val(response.id);
        $('#rej_sup_remarks').val(response.sup_remarks);
        // Display Modal
        $('#reject_leave').modal('show'); 
      }
    });
  });
});
</script>