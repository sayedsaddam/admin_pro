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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Daily Attendance | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <?php if($success = $this->session->flashdata('success')): ?>
    <div class="row">
      <div class="col-12">
        <div class="alert alert-success">
          <?= $success; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="row mb-4">
    <div class="col-6">
      <a href="<?= base_url('admin/daily_attendance'); ?>" class="btn btn-outline-unique"><i class="fa fa-eye"></i> attendance register</a>
      <button data-toggle="modal" data-target="#add_attendance" type="button" class="btn btn-outline-info"><i class="fa fa-plus"></i> add attendance</button>
    </div>
    <div class="col-6 text-right">
      <form action="<?= base_url('admin/attendance_report'); ?>" method="get" class="form-inline">
        <input type="date" name="date_from" class="form-control mr-4" title="Date from...">
        <input type="date" name="date_to" class="form-control mr-3" title="Date to...">
        <input type="submit" class="btn btn-primary btn-md" value="Go">
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card card-list">
        <div class="card-header white d-flex justify-content-between align-items-center py-3">
          <p class="h5-responsive font-weight-bold mb-0"><?php if(empty($results)){ echo 'Daily Attendance'; }else{ echo 'Search Results'; } ?> | <small><a href="javascript:history.go(-1)">&laquo; Back</a></small></p>
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
                <th class="font-weight-bold">App. Timings</th>
                <th class="font-weight-bold">Check In</th>
                <th class="font-weight-bold">Check Out</th>
                <th class="font-weight-bold">Total Hours</th>
                <th class="font-weight-bold">Late / Early</th>
                <th class="font-weight-bold">Date</th>
                <th class="font-weight-bold">Action</th>
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
                    $late_arrival = date_diff($approved_time, $arrival_time); ?>
              <tr>
                <td scope="row"><?= 'CTC-'.$att->id; ?></td>
                <td><?= ucfirst($att->fullname); ?></td>
                <td><?= $att->approved_timings; ?></td>
                <td><?= date('h:i', strtotime($att->time_in)); ?></td>
                <td><?= date('h:i', strtotime($att->time_out)); ?></td>
                <td><?= $diff->h.'h '.$diff->i.'m'; ?></td>
                <td><?= $late_arrival->h.'h '.$late_arrival->i.'m'; ?></td>
                <td><?= date('M d, Y', strtotime($att->created_at)); ?></td>
                <td>
                  <a href="#" class="badge badge-primary" title="Leave detail..."><i class="fa fa-print"></i></a>
                  <a data-id="<?= $att->id; ?>" class="badge badge-danger reject_leave" title="Reject leave..."><i class="fa fa-times"></i></a>
                </td>
              </tr>
              <?php endforeach; else: echo '<tr class="table-danger"><td colspan="8" align="center">No record found.</td></tr>'; endif; ?>
            </tbody>
            <?php elseif(!empty($results)): ?>
              <tbody>
              <?php foreach($results as $res): ?>
              <?php $check_in = date_create($res->time_in);
                    $check_out = date_create($res->time_out);
                    $diff = date_diff($check_out, $check_in); 
                    // Late arrival calculations
                    $approved_time = date_create($res->approved_timings);
                    $arrival_time = date_create($res->time_in);
                    $late_arrival = date_diff($approved_time, $arrival_time); ?>
              <tr>
                <td scope="row"><?= 'CTC-'.$res->id; ?></td>
                <td><?= ucfirst($res->fullname); ?></td>
                <td><?= $res->approved_timings; ?></td>
                <td><?= date('h:i', strtotime($res->time_in)); ?></td>
                <td><?= date('h:i', strtotime($res->time_out)); ?></td>
                <td><?= $diff->h.'h '.$diff->i.'m'; ?></td>
                <td><?= $late_arrival->h.'h '.$late_arrival->i.'m'; ?></td>
                <td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
                <td>
                  <a href="#" class="badge badge-primary" title="Leave detail..."><i class="fa fa-print"></i></a>
                  <a data-id="<?= $res->id; ?>" class="badge badge-danger reject_leave" title="Reject leave..."><i class="fa fa-times"></i></a>
                </td>
              </tr>
              <?php endforeach; else: echo '<tr class="table-danger"><td colspan="8" align="center">No record found.</td></tr>'; ?>
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
</div>

<!-- Modal > Add Attendance -->
<div class="modal fade" id="add_attendance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Add Attendance</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center mx-3">
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
              <tbody>
                <?php if(!empty($users)): foreach($users as $user): ?>
                  <tr>
                    <td><input type="checkbox" name="emp_id[]" value="<?= $user->id; ?>"></td>
                    <td><?= $user->fullname; ?></td>
                    <td><input type="text" name="approved_time[]" id="approved_time" class="form-control form-control-sm" placeholder="Approved timing" value="09:00"></td>
                    <td><input type="text" name="time_in[]" id="time_in" class="form-control form-control-sm" placeholder="Time in"></td>
                    <td><input type="text" name="time_out[]" id="time_out" class="form-control form-control-sm" placeholder="Time Out"></td>
                    <td><input type="text" name="remarks[]" id="remarks" class="form-control form-control-sm" placeholder="Remarks"></td>
                  </tr>
                <?php endforeach; endif; ?>
                <tr>
                  <td colspan="6" align="left">
                    <input type="submit" class="btn btn-primary btn-md" value="Submit">
                    <input type="reset" class="btn btn-danger btn-md" value="clear">
                  </td>
                </tr>
              </tbody>
            </table>     
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