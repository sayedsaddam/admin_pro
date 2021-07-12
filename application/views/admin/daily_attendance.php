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
      <a href="<?= base_url('admin/daily_attendance'); ?>" class="btn btn-outline-unique btn-sm"><i class="fa fa-eye"></i> attendance register</a>
      <button data-toggle="modal" data-target="#add_attendance" type="button" class="btn btn-outline-info btn-sm"><i class="fa fa-plus"></i> add attendance</button>
      <a href="javascript:history.go(-1)" class="btn btn-outline-danger btn-sm">&laquo; Back</a>
    </div>
    <div class="col-7 text-right">
      <form action="<?= base_url('admin/attendance_report'); ?>" method="get" class="form-inline">
        <input type="date" name="date_from" class="form-control mr-2 ml-5" title="Date from...">
        <input type="date" name="date_to" class="form-control mr-2" title="Date to...">
        <select name="location" id="location" class="browser-default custom-select mr-3">
          <option value="" selected>--Select Location--</option>
          <?php foreach($locations as $location): ?>
            <option value="<?= $location->id; ?>"><?= ucfirst($location->name); ?></option>
          <?php endforeach; ?>
        </select>
        <input type="submit" class="btn btn-primary btn-md" value="Go &raquo;">
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-12 table-responsive">
      <h3 class="mb-3">
        <?php if(empty($results)){ echo 'Daily Attendance Report'; }else{ echo 'Search Results -> <small>'. date('M d, Y', strtotime($_GET['date_from'])).' - '.date('M d, Y', strtotime($_GET['date_to'])).'</small>'; } ?>
      </h3>
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th class="font-weight-bold">Name/Date</th>
            <th colspan="31" class="font-weight-bold text-center">Attendance</th>
            <?php //for($date = 1; $date <= 31; $date++){ echo '<th class="font-weight-bold">'.$date.'</th>'; } ?>
          </tr>
        </thead>
        <?php if(empty($results)): ?>
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
                        echo '<td>'.date('d/m ', strtotime($att->attendance_date)).'- '.$att->time_in.'-'.$att->time_out.'</td>'; 
                        $total_hours += $diff->h*60; $total_minutes += $diff->i; $total_time = ($total_hours+$total_minutes);
                      } // @endforeach
                      if(!empty($emp_attendance)){ echo '<td>Total hrs = '.(@$total_time/60).', Avg '.number_format((@$total_time/60)/count($emp_attendance), 2).', No. of Days '.count($emp_attendance).'</td>'; } ?>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        <?php elseif(!empty($results)): ?>
          <tbody>
            <?php if(!empty($users)): foreach($users as $user): ?>
              <tr>
                <td><?= $user->fullname; ?></td>
                <?php $emp_attendance = $this->admin_model->search_employee_attendance($_GET['date_from'], $_GET['date_to'], $user->id);
                      $total_hours = 0;
                      $total_minutes = 0;
                      foreach($emp_attendance as $att){ // @startforeach
                        $check_in = date_create($att->time_in);
                        $check_out = date_create($att->time_out);
                        $diff = date_diff($check_out, $check_in);
                        echo '<td>'.date('d/m ', strtotime($att->attendance_date)).'- '.$att->time_in.'-'.$att->time_out.'</td>'; 
                        $total_hours += $diff->h*60; $total_minutes += $diff->i; $total_time = ($total_hours+$total_minutes);
                      } // @endforeach
                      if(!empty($emp_attendance)){ echo '<td>Total hrs = '.(@$total_time/60).', Avg '.number_format((@$total_time/60)/count($emp_attendance), 2).', No. of Days '.count($emp_attendance).'</td>'; } ?>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        <?php else: echo 'Record not found!'; endif; ?>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <button class="btn btn-primary d-print-none" onclick="javascript:window.print();">Print</button>
    </div>
  </div>
  <div class="row pt-5 mt-3">
    <div class="col-6 d-none d-print-block">_______________________<br>Approved By</div>
    <div class="col-6 d-none d-print-block text-right">_______________________<br>Verified By</div>
  </div>
</div>

<!-- Modal > Add Attendance -->
<div class="modal fade" id="add_attendance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-fluid" role="document">
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
                <option value="<?= $loc->id; ?>"><?= $loc->name; ?></option>
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
                    <th class="font-weight-bold">Attendace Date</th>
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
                      <td><input type="date" name="attendance_date[]" class="form-control form-control-sm"></td>
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