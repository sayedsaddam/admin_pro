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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Daily Attendance | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
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
    <div class="col-7 text-right">
      <form action="<?= base_url('admin/attendance_report'); ?>" method="get" class="form-inline">
        <input type="date" name="date_from" class="form-control mr-4" title="Date from...">
        <input type="date" name="date_to" class="form-control mr-3" title="Date to...">
        <select name="employee" id="employee" class="browser-default custom-select">
          <option value="">Select Employee</option>
          <?php foreach($users as $user): ?>
            <option value="<?= $user->id; ?>"><?= $user->fullname; ?></option>
          <?php endforeach; ?>
        </select>
        <input type="submit" class="btn btn-primary btn-md" value="Go">
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-12 table-responsive">
      <h3>Report</h3>
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th class="font-weight-bold">Name/Date</th>
            <th colspan="31" class="font-weight-bold text-center">Attendance</th>
            <?php //for($date = 1; $date <= 31; $date++){ echo '<th class="font-weight-bold">'.$date.'</th>'; } ?>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($users)): foreach($users as $user): ?>
          <tr>
            <td><?= $user->fullname; ?></td>
            <?php $emp_attendance = $this->admin_model->get_employee_attendance($user->id);
                  $total_hours = 0;
                  $total_minutes = 0;
                  foreach($emp_attendance as $att){ // @startforeach
                    $check_in = date_create($att->time_in);
                    $check_out = date_create($att->time_out);
                    $diff = date_diff($check_out, $check_in);
                    echo '<td>'.date('d/m ', strtotime($att->created_at)).'- '.$att->time_in.'-'.$att->time_out.'</td>'; 
                    $total_hours += $diff->h*60; $total_minutes += $diff->i; $total_time = ($total_hours+$total_minutes);
                  } // @endforeach
                  if(!empty($emp_attendance)){ echo '<td>Total = '.(@$total_time/60).'</td>'; } ?>
          </tr>
          <?php endforeach; endif; ?>
          <tr>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card card-list">
        <div class="card-header white d-flex justify-content-between align-items-center py-3 d-print-none">
          <p class="h5-responsive font-weight-bold mb-0"><?php if(empty($results)){ echo 'Daily Attendance Register'; }else{ echo 'Search Results - Daily Attendance Register'; } ?> | <small class="d-print-none"><a href="javascript:history.go(-1)">&laquo; Back</a></small></p>
          <ul class="list-unstyled d-flex align-items-center mb-0">
            <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
            <li><i class="fas fa-times fa-sm pl-3"></i></li>
          </ul>
        </div>
        <div class="card-body">
          <?php if(!empty($results)): ?>
            <h2 class="mb-4 d-none d-print-block text-center">Attendance Report | <small class="font-weight-lighter">from <?= date('F jS', strtotime($_GET['date_from'])).' to '.date('F jS, Y', strtotime($_GET['date_to'])); ?></small></h2>
          <?php else: echo "<h2 class='mb-4 d-none d-print-block text-center'>Attendance Report</h2>"; endif; ?>
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="font-weight-bold">ID</th>
                <th class="font-weight-bold">Employee</th>
                <th class="font-weight-bold">App. Timings</th>
                <th class="font-weight-bold">Check In</th>
                <th class="font-weight-bold">Check Out</th>
                <th class="font-weight-bold">Total Hours</th>
                <th class="font-weight-bold">Late Arrival</th>
                <th class="font-weight-bold">Early Leave</th>
                <th class="font-weight-bold">Date</th>
                <th class="font-weight-bold d-print-none">Action</th>
              </tr>
            </thead>
            <?php if(empty($results)): ?>
            <tbody>
              <?php if(!empty($attendance)): foreach($attendance as $att): ?>
              <?php $check_in = date_create($att->time_in);
                    $check_out = date_create($att->time_out);
                    $diff = date_diff($check_out, $check_in); 
                    // Late arrival calculations
                    $approved_time = date_create($att->approved_timings);
                    $arrival_time = date_create($att->time_in);
                    $late_arrival = date_diff($approved_time, $arrival_time); 
                    $allowed_timings = $att->approved_timings;
                    $leaving_time = '';
                    if($allowed_timings == '09:00'){ $leaving_time .= '18:00'; }elseif($allowed_timings == '09:30'){ $leaving_time .= '18:30'; }elseif($allowed_timings == '10:00'){ $leaving_time .= '19:00'; }
                    $approved_time_leave = date_create($leaving_time); // Approved time for leaving - taking off.
                    $time_to_leave = date_create($att->time_out); // Time of employee leaving / taking off.
                    $early_leave = date_diff($approved_time_leave, $time_to_leave); // Time difference b/w leaving times. ?>
              <tr>
                <td scope="row"><?= 'CTC-'.$att->id; ?></td>
                <td><?= ucfirst($att->fullname); ?></td>
                <td><?= date('h:ia', strtotime($att->approved_timings)).' - '.date('h:ia', strtotime($leaving_time)); ?></td>
                <td><?= date('h:ia', strtotime($att->time_in)); ?></td>
                <td><?= date('h:ia', strtotime($att->time_out)); ?></td>
                <td><?= $diff->h.'h '.$diff->i.'m'; ?></td>
                <td>
                  <?php if($att->time_in > $att->approved_timings){ echo $late_arrival->h.'h '.$late_arrival->i.'m'; }else{ echo 'In time.'; } ?>
                </td>
                <td>
                  <?php if($att->time_out < $leaving_time){ echo $early_leave->h.'h '.$early_leave->i.'m'; }else{ echo 'In time.'; } ?>
                </td>
                <td><?= date('M d, Y', strtotime($att->created_at)); ?></td>
                <td class="d-print-none">
                  <a href="#" class="badge badge-primary" title="Leave detail..."><i class="fa fa-print"></i></a>
                  <a data-id="<?= $att->id; ?>" class="badge badge-danger reject_leave" title="Reject leave..."><i class="fa fa-times"></i></a>
                </td>
              </tr>
              <?php endforeach; else: echo '<th class="table-danger"><td colspan="10" align="center">No record found.</td></th>'; endif; ?>
            </tbody>
            <?php elseif(!empty($results)): ?>
              <tbody>
              <?php $total_hrs = 0;
                    $total_mins = 0;
                    foreach($results as $res): ?>
              <?php $check_in = date_create($res->time_in);
                  $check_out = date_create($res->time_out);
                  $diff = date_diff($check_out, $check_in); 
                  // Late arrival calculations
                  $approved_time = date_create($res->approved_timings);
                  $arrival_time = date_create($res->time_in);
                  $late_arrival = date_diff($approved_time, $arrival_time); 
                  $allowed_timings = $res->approved_timings;
                  $leaving_time = '';
                  if($allowed_timings == '09:00'){ $leaving_time .= '18:00'; }elseif($allowed_timings == '09:30'){ $leaving_time .= '18:30'; }elseif($allowed_timings == '10:00'){ $leaving_time .= '19:00'; }
                  $approved_time_leave = date_create($leaving_time); // Approved time for leaving - taking off.
                  $time_to_leave = date_create($res->time_out); // Time of employee leaving / taking off.
                  $early_leave = date_diff($approved_time_leave, $time_to_leave); ?>
              <tr>
                <td scope="row"><?= 'CTC-'.$res->id; ?></td>
                <td><?= ucfirst($res->fullname); ?></td>
                <td><?= date('h:ia', strtotime($res->approved_timings)).' - '.date('h:ia', strtotime($leaving_time)); ?></td>
                <td><?= date('h:ia', strtotime($res->time_in)); ?></td>
                <td><?= date('h:ia', strtotime($res->time_out)); ?></td>
                <td><?= $diff->h.'h '.$diff->i.'m'; ?></td>
                <td>
                  <?php if($res->time_in > $res->approved_timings){ echo $late_arrival->h.'h '.$late_arrival->i.'m'; }else{ echo 'In time.'; } ?>
                </td>
                <td>
                  <?php if($res->time_out < $leaving_time){ echo $early_leave->h.'h '.$early_leave->i.'m'; }else{ echo 'In time.'; } ?>
                </td>
                <td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
                <td class="d-print-none">
                  <a href="#" class="badge badge-primary" title="Leave detail..."><i class="fa fa-print"></i></a>
                  <a data-id="<?= $res->id; ?>" class="badge badge-danger reject_leave" title="Reject leave..."><i class="fa fa-times"></i></a>
                </td>
              </tr>
              <?php $total_hrs += $diff->h*60; $total_mins += $diff->i; $total_time = ($total_hrs+$total_mins); ?>
              <?php endforeach; echo '<tr class="table-success"><td colspan="5" class="font-weight-bold">Total Hours</td><td colspan="5" class="font-weight-bold">'.number_format($total_time/60, 2) .'h </td></tr><tr class="d-print-none"><td colspan="10"><button class="btn btn-primary" onclick="javascript:window.print();">Print Report</button></td></tr>'; else: echo '<tr class="table-danger"><td colspan="9" align="center">No record found.</td></tr>'; ?>
            </tbody>
            <?php endif; ?>
          </table>
        </div>
        <div class="card-footer white py-3 d-flex justify-content-between">
          <?php if(!empty($attendance) && empty($results)){ $this->pagination->create_links(); } ?>
        </div>
      </div>
    </div> 
  </div>
  <div class="row">
    <div class="col-6 d-none d-print-block">_______________________<br>Approved By</div>
    <div class="col-6 d-none d-print-block text-right">_______________________<br>Verified By</div>
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
     // Check all
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
  });
</script>