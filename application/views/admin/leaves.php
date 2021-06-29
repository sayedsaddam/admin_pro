<div class="jumbotron jumbotron-fluid blue-gradient text-light d-print-none">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <h2 class="display-4 font-weight-bold">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Leaves | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <?php if($success = $this->session->flashdata('success')): ?>
    <div class="row">
      <div class="col-12">
        <div class="alert alert-success">
          <?= $success; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="row mb-4 d-print-none">
    <div class="col-5">
      <a href="<?= base_url('admin/daily_attendance'); ?>" class="btn btn-outline-unique"><i class="fa fa-eye"></i> attendance register</a>
      <button data-toggle="modal" data-target="#add_attendance" type="button" class="btn btn-outline-info"><i class="fa fa-plus"></i> add attendance</button>
    </div>
    <div class="col-7">
      <form action="<?= base_url('admin/leaves_report'); ?>" method="get" class="form-inline">
          <input type="date" name="date_from" class="form-control mr-2" title="Date from...">
          <input type="date" name="date_to" class="form-control mr-2" title="Date to...">
          <select name="location" id="location" class="browser-default custom-select mr-3">
            <option value="" selected>--Select Location--</option>
            <?php foreach($locations as $location): ?>
              <option value="<?= $location->id; ?>"><?= ucfirst($location->name); ?></option>
            <?php endforeach; ?>
          </select>
          <input type="submit" class="btn btn-primary btn-md" value="Go">
        </form>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card card-list">
        <div class="card-header white d-flex justify-content-between align-items-center py-3">
          <p class="h5-responsive font-weight-bold mb-0">
            <?php if(!empty($leaves)){ echo 'Leave Requests'; }else{ echo 'Leaves Report &raquo; '.ucfirst($results[0]->name).' <a class="d-print-none" href="javascript:history.go(-1)">&laquo; Back</a>'; } ?>
          </p>
          <ul class="list-unstyled d-flex align-items-center mb-0 d-print-none">
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
                <th class="font-weight-bold">
                  <?php if(empty($results)){ echo 'Leave From'; }else{ echo 'Accrued Leaves'; } ?>
                </th>
                <th class="font-weight-bold">
                  <?php if(empty($results)){ echo 'Leave To'; }else{ echo 'Availed'; } ?>
                </th>
                <th class="font-weight-bold">
                  <?php if(empty($results)){ echo 'Days'; }else{ echo 'Balance'; } ?>
                </th>
                <?php if(empty($results)): ?>
                  <th class="font-weight-bold">
                    Requested
                  </th>
                <?php endif; ?>
                <th class="font-weight-bold">Status</th>
                <th class="font-weight-bold d-print-none">Action</th>
              </tr>
            </thead>
            <?php if(empty($results)): ?>
              <tbody>
                <?php if(!empty($leaves)): foreach($leaves as $leave): ?>
                <tr>
                  <td scope="row"><?= 'CTC-'.$leave->id; ?></td>
                  <td><?= ucfirst($leave->fullname); ?></td>
                  <td><?= date('M d, Y', strtotime($leave->leave_from)); ?></td>
                  <td><?= date('M d, Y', strtotime($leave->leave_to)); ?></td>
                  <td><?= $leave->no_of_days; ?></td>
                  <td><?= date('M d, Y', strtotime($leave->created_at)); ?></td>
                  <td><?php if($leave->leave_status == 0){ echo '<span class="badge badge-warning">pending</span>'; }elseif($leave->leave_status == 1){ echo '<span class="badge badge-success">approved</span>'; }else{ echo '<span class="badge badge-danger">rejected</span>'; } ?></td>
                  <td class="d-print-none">
                    <a href="<?= base_url('admin/leave_detail/'.$leave->id); ?>" class="badge badge-primary" title="Leave detail..."><i class="fa fa-print"></i></a>
                    <a data-id="<?= $leave->id; ?>" class="badge badge-danger reject_leave" title="Reject leave..."><i class="fa fa-times"></i></a>
                  </td>
                </tr>
                <?php endforeach; else: echo '<tr class="table-danger"><td colspan="8" align="center">No record found.</td></tr>'; endif; ?>
              </tbody>
            <?php elseif(empty($leaves)): ?>
              <tbody>
                <?php if(!empty($results)): foreach($results as $res): ?>
                <tr>
                  <td scope="row"><?= 'CTC-'.$res->id; ?></td>
                  <td><?= ucfirst($res->fullname); ?></td>
                  <td><?= '22'; ?></td>
                  <td><?= $res->total_availed_leaves; ?></td>
                  <td><?= (22 - $res->total_availed_leaves); ?></td>
                  <td>--</td>
                  <td class="d-print-none">
                    --
                  </td>
                </tr>
                <?php endforeach; else: echo '<tr class="table-danger"><td colspan="8" align="center">No record found.</td></tr>'; endif; ?>
              </tbody>
            <?php endif; ?>
          </table>
          <div class="row">
            <div class="col-12">
              <button class="btn btn-primary d-print-none" onclick="javascript:window.print();">Print</button>
            </div>
          </div>
        </div>
        <div class="card-footer white py-3 d-flex justify-content-between">
          <?php if(empty($results) && !empty($leaves)){ echo $this->pagination->create_links(); } ?>
        </div>
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
<!-- Modal > Add Attendance -->
<div class="modal fade" id="add_attendance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Add Attendance | <small class="font-weight-light">The time format to be used, must be 24hrs.</small></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center mx-3">
        <div class="row">
            <div class="col-12">
              <select name="city" id="city" class="brower-default custom-select mb-4">
                <option value="" selected disabled>--select region--</option>
                <?php if(!empty($locations)): foreach($locations as $loc): ?>
                  <option value="<?= $loc->name; ?>"><?= $loc->name; ?></option>
                <?php endforeach; endif; ?>
              </select>
            </div>
          </div>
          <form action="<?= base_url('admin/add_daily_attendance'); ?>" method="post">
            <div class="row">
              <div class="col-12 table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th class="font-weight-bold">Employee</th>
                    <th class="font-weight-bold">Approved Timings</th>
                    <th class="font-weight-bold">Time In</th>
                    <th class="font-weight-bold">Time Out</th>
                    <th class="font-weight-bold">Remarks</th>
                  </tr>
                </thead>
                <tbody id="employees_attendance">
                </tbody>
              </table>     
              </div>
            </div>
            <div class="row">
              <div class="col-12 text-left">
                <input type="submit" class="btn btn-primary btn-md" value="Submit">
                <input type="reset" class="btn btn-danger btn-md" value="clear">
              </div>
            </div>
          </form>
      </div>
      <div class="modal-footer d-flex justify-content-right">
        <button class="btn btn-unique" data-dismiss="modal" aria-label="Close">Close <i class="fas fa-paper-plane-o ml-1"></i></button>
      </div>
    </div>
  </div>
</div>
<script>
 $(document).ready(function(){
   // Filter employees by region for attendance
   $('#city').on('change', function(){
      var filterEmployees = $(this).val();
      $.ajax({
        url: '<?= base_url(); ?>admin/filter_by_region/' + filterEmployees,
        method:'POST',
        dataType: 'json',
        data: {filterEmployees: filterEmployees},
        success: function(data){
          console.log(data);
          if(data){
            $('#employees_attendance').html('');
            $.each(data, function(index, res){
              $('#employees_attendance').append(`<tr>
                      <td><input type="checkbox" name="emp_id[]" value="${res.id}"></td>
                      <td>${res.fullname}</td>
                      <td><input type="text" name="approved_time[]" id="approved_time" class="form-control form-control-sm" placeholder="Approved timing" value="09:00"></td>
                      <td><input type="text" name="time_in[]" id="time_in" class="form-control form-control-sm" placeholder="Time in"></td>
                      <td><input type="text" name="time_out[]" id="time_out" class="form-control form-control-sm" placeholder="Time Out"></td>
                      <td><input type="text" name="remarks[]" id="remarks" class="form-control form-control-sm" placeholder="Remarks"></td>
                    </tr>`);
            });
          }
        }
      });
    });
  // Leaves rejection of approval.
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
  // Check all
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
});
</script>