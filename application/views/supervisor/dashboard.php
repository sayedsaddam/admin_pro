<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid">
      </div>
      <div class="col-lg-7 col-md-7">
        <h1 class="font-weight-bold mb-0">Admin & Procurement</h1>
        <h5 class="font-weight-bold text-light">AH Group of Companies (Pvt.) Ltd.</h5>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?= $this->session->userdata('fullname'); ?></button>
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
                  <?= $success; unset($_SESSION['success']);?>
              </div>
          </div>
      </div>
    <?php endif; ?>
    <!-- Grid row -->
    <div class="row mb-4">
      <div class="col-12 text-center">
        <button class="btn btn-outline-unique btn-sm" data-toggle="modal" data-target="#fullHeightModalLeft"><i class="fa fa-envelope"></i> Place requisisition</button>
        <a href="<?= base_url('supervisor/view_all_requisitions'); ?>" class="btn btn-outline-dark btn-sm"><i class="fa fa-envelope"></i> View requisitions <span class="badge badge-info"><?= $total_requisitions; ?></span></a>
        <button data-toggle="modal" data-target="#apply_travel" class="btn btn-outline-info btn-sm"><i class="fa fa-plane"></i> Apply Travel</button>
        <a href="<?= base_url('supervisor/view_travel_history'); ?>" class="btn btn-outline-purple btn-sm"><i class="fa fa-plane"></i> Travel History <span class="badge badge-info"><?= $total_travels; ?></span></a>
        <a href="<?= base_url('supervisor/profile'); ?>" class="btn btn-outline-info btn-sm"><i class="fa fa-user"></i> User Profile</a>
      </div>
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
                  <p class="h5-responsive font-weight-bold mb-0">Requisition Requests</p>
                  <small>Hover the mouse cursor over the description to view complete detail.</small>
                  </ul>
              </div>
              <div class="card-body">
                  <table class="table table-sm">
                      <thead>
                          <tr>
                          <th class="font-weight-bold"><abbr title="Order ID">ID</abbr></th>
                          <th class="font-weight-bold">Employee</th>
                          <th class="font-weight-bold">Item</th>
                          <th class="font-weight-bold">Category</th>
                          <th class="font-weight-bold">Quantity</th>
                          <th class="font-weight-bold">Description</th>
                          <th class="font-weight-bold">Requested On</th>
                          <th class="font-weight-bold">Status</th>
                          <th class="font-weight-bold">Action</th>
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
            <small>Hover the mouse cursor over the description to view complete detail.</small>
          </div>
          <div class="card-body">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th class="font-weight-bold"><abbr title="Order ID">ID</abbr></th>
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
<!-- Full Height Modal Left > Place requisition -->
<div class="modal fade left" id="fullHeightModalLeft" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-full-height modal-left" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title w-100" id="myModalLabel">Create Requisition</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h4 class="font-weight-lighter mb-5">Please fill out the form below.</h4>
                    <!-- Form -->
                    <form action="<?= base_url('supervisor/create_requisition'); ?>" method="post">
                        <!-- item name -->
                        <div class="form-group">
                            <label for="itemName">Employee</label>
                            <select name="employees" id="employees" class="browser-default custom-select" required>
                                <option value="" disabled selected>-- Employee --</option>
                                <?php if(!empty($employees)): foreach($employees as $item): ?>
                                  <option value="<?=$item->id;?>"><?=$item->fullname;?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <!-- item name -->
                        <div class="form-group">
                            <label for="itemName">Category</label>
                            <select name="category" id="category" class="browser-default custom-select" required>
                                <option value="" disabled selected>-- Main Category --</option>
                                <?php if(!empty($items)): foreach($items as $item): ?>
                                  <option value="<?=$item->cat_id;?>"><?=$item->cat_name;?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="itemName">Item name</label>
                            <select name="sub_category" id="sub_category" class="browser-default custom-select" required>
                              <option value="" disabled selected>-- Sub Category --</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea name="description" id="description" class="form-control" placeholder="Description..."></textarea>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" placeholder="Item quantity..." required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Save Changes">
                        </div>
                    </form>
                    <!-- Form -->
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
</div>
<!-- Full Height Modal Left -->

<!-- Full Height Modal Right > Export Travels Data -->
<div class="modal fade left" id="export-requisitions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
  aria-hidden="true">
  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-xl modal-right" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title w-100" id="myModalLabel">Exporting Requisition Records</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <h4 class="font-weight-lighter mb-5 text-center">Please select the date range.</h4>
              <!-- Form -->
              <form action="<?= base_url('supervisor/export_requisitions'); ?>" method="post">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="visit_start">From</label>
                        <input type="date" name="date_from" class="form-control">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="check_out">To</label>
                        <input type="date" name="date_to" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="submit" class="btn btn-primary" value="Submit Request">
                      <input type="reset" class="btn btn-danger" value="clear form">
                    </div>
                  </div>
              </form>
              <!-- Form -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- Full Height Modal Right -->

<!-- Full Height Modal Right > Export Data -->
<div class="modal fade left" id="export-travels" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
  aria-hidden="true">
  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-xl modal-right" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title w-100" id="myModalLabel">Exporting Travel Records</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <h4 class="font-weight-lighter mb-5 text-center">Please select the date range.</h4>
              <!-- Form -->
              <form action="<?= base_url('supervisor/export_travel'); ?>" method="post">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="visit_start">From</label>
                        <input type="date" name="date_from" class="form-control">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="check_out">To</label>
                        <input type="date" name="date_to" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="submit" class="btn btn-primary" value="Submit Request">
                      <input type="reset" class="btn btn-danger" value="clear form">
                    </div>
                  </div>
              </form>
              <!-- Form -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- Full Height Modal Right -->

<!-- Full Height Modal Right > Apply Travel -->
<div class="modal fade left" id="apply_travel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
  aria-hidden="true">
  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-xl modal-right" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title w-100" id="myModalLabel">Travel Application Form</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <h4 class="font-weight-lighter mb-5 text-center">Please fill out the form below.</h4>
              <!-- Form -->
              <form action="<?= base_url('supervisor/apply_travel'); ?>" method="post">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="visit_of">Visit of</label>
                        <select name="visit_of" class="browser-default custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <option value="staff">Staff</option>
                          <option value="other">Other</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="assignment">Assignment</label>
                        <input type="text" name="assignment" class="form-control" placeholder="assignment...">
                      </div>
                      <div class="form-group">
                        <label for="place_of_visit">Place of Visit</label>
                        <input type="text" name="place_of_visit" class="form-control" placeholder="place of visit...">
                      </div>
                      <div class="form-group">
                        <label for="visit_start">Visit Start Date</label>
                        <input type="date" name="visit_start" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="visit_end">Visit End Date</label>
                        <input type="date" name="visit_end" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="charge">Charge To</label>
                        <input type="text" name="charge_to" class="form-control" placeholder="charge to...">
                      </div>
                      <div class="form-group">
                        <label for="travel_request_type">Travel Request Type</label>
                        <select name="request_type" class="browser-default custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <option value="by air">By Air</option>
                          <option value="rented car">Rented Car</option>
                          <option value="self">Self</option>
                          <option value="public transport">Public Transport</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="stay_request">Hotel Stay Request</label>
                        <div class="row">
                          <div class="col-3"><input type="radio" name="stay_request" value="Male"> Male</div>
                          <div class="col-6"><input type="radio" name="stay_request" value="Female"> Female</div>
                        </div>
                        <div class="row">
                          <div class="col-3"><input type="radio" name="stay_request_one" value="Single Room"> Single Room</div>
                          <div class="col-6"><input type="radio" name="stay_request_one" value="Twins"> Twins</div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="staying_at">Staying at</label>
                        <select name="staying_at" class="browser-default custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <option value="hotel">Hotel</option>
                          <option value="guest house">Guest House</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="check_in">Check In</label>
                        <input type="date" name="check_in" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="check_out">Check Out</label>
                        <input type="date" name="check_out" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="payment_mode">Payment Mode</label>
                        <select name="payment_mode" class="browser-default custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <option value="bill to CTC">Bill to CTC</option>
                          <option value="cash">Cash</option>
                          <option value="credit card">Credit Card</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="approx_cash">Approx. Cash Needed</label>
                        <input type="text" name="approx_cash" class="form-control" placeholder="approximate cash...">
                      </div>
                      <div class="form-group">
                        <label for="travel_request_type">Employee</label>
                        <select name="requested_by" class="browser-default custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <?php if(!empty($employees)): foreach($employees as $item): ?>
                                  <option value="<?=$item->id;?>"><?=$item->fullname;?></option>
                                <?php endforeach; endif; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="submit" class="btn btn-primary" value="Submit Request">
                      <input type="reset" class="btn btn-danger" value="clear form">
                    </div>
                  </div>
              </form>
              <!-- Form -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- Full Height Modal Right -->
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

  // City change
  $('#category').on('change', function(){
    var category = $(this).val();

    // AJAX request
    $.ajax({
      url:'<?=base_url('supervisor/get_sub_categories/')?>' + category,
      method: 'post',
      data: {category: category},
      dataType: 'json',
      success: function(response){
        console.log(response);
        // Remove options 
        $('#sub_category').find('option').not(':first').remove();

        // Add options
        $.each(response,function(index, data){
            $('#sub_category').append('<option value="'+data['id']+'">'+data['name']+'</option>');
        });
      }
    });
  });
});
</script>