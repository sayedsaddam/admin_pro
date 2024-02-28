<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
			<h2 class="display-4 font-weight-bold" title="Human resource Information Management">HRIM</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <a href="<?= base_url('users/profile'); ?>" class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></a>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i><span class="font-weight-light">Track Leaves Record</span> | <a href="<?=base_url('users');?>" class="text-light">Home</a></h4>
      </div>
    </div>
  </div>
</div>

<div class="container my-3 py-3">

  <!-- Section: Leaves record -->
  <section>
    <div class="row">
      <div class="col-12">
      	<div class="card card-list">
          <div class="card-header white d-flex justify-content-between align-items-center py-3">
            <p class="h5-responsive font-weight-bold mb-0">Leaves Record | <small><a href="javascript:history.go(-1)" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small></p>
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
                  <th class="font-weight-bold">Leave Type</th>
                  <th class="font-weight-bold">From</th>
                  <th class="font-weight-bold">To</th>
                  <th class="font-weight-bold">No of Days</th>
                  <th class="font-weight-bold">Status</th>
                  <th class="font-weight-bold">Applied</th>
                  <th class="font-weight-bold">Detail</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($leaves)): foreach($leaves as $leave): ?>
                  <tr>
                    <th scope="row"><?= 'CTC-0'.$leave->id; ?></th>
                    <td><?= ucfirst($leave->leave_type); ?></td>
                    <td><?= date('M d, Y', strtotime($leave->leave_from)); ?></td>
                    <td><?= date('M d, Y', strtotime($leave->leave_to)); ?></td>
                    <td><?= $leave->no_of_days; ?></td>
                    <td>
                        <?php if($leave->leave_status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }elseif($leave->leave_status == 1){ echo "<span class='badge badge-warning' title='pending for director approval'>approved</span>"; }elseif($leave->leave_status == 2){ echo "<span class='badge badge-success'>approved</span>"; }else{ echo "<span class='badge badge-danger'>rejected</span>"; } ?>
                    </td>
                    <td><?= date('M d, Y', strtotime($leave->created_at)); ?></td>
                    <td><a data-id="<?= $leave->id; ?>" class="btn btn-outline-info btn-sm leave_detail">Detail</a></td>
                  </tr>
                <?php endforeach; else: echo "<tr class='table-danger'><td colspan='7' align='center'>No record found.</td></tr>"; endif; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer white py-3 d-flex justify-content-between">
            <button type="button" class="btn btn-primary btn-md px-3 my-0 ml-0" data-toggle="modal" data-target="#apply_leave">
                <i class="fa fa-plane"></i> Apply Leave
            </button>
            <?= $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Leaves record -->
</div>

<!-- Full Height Modal Right > Apply Leave -->
<div class="modal fade right" id="apply_leave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-right" role="document">
    <div class="modal-content">
			<div class="modal-header">
					<h4 class="modal-title w-100" id="myModalLabel">Apply Leave</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<h4 class="font-weight-lighter mb-5 text-center">Pleas fill out the form below.</h4>
						<!-- Form -->
						<form action="<?= base_url('users/apply_leave'); ?>" method="post">
							<!-- First name -->
							<div class="form-group">
								<label for="itemName">Leave Type</label>
								<select name="leave_type" id="leave_type" class="browser-default custom-select">
									<option value="" disabled selected>-- Select Type --</option>
									<option value="Annual">Annual</option>
									<option value="Emergency">Emergency</option>
									<option value="Medical">Medical</option>
									<option value="Maternity">Maternity</option>
									<option value="Other">Other</option>
								</select>
							</div>
							<div class="form-group">
								<label for="from_date">Date From</label>
								<input type="date" name="from_date" id="from_date" class="form-control">
							</div>
							<div class="form-group">
								<label for="to_date">Date To</label>
								<input type="date" name="to_date" id="to_date" class="form-control">
							</div>
							<div class="form-group">
								<label for="no_of_days">Number of Days</label>
								<input type="number" name="no_of_days" id="no_of_days" placeholder="No. of days..." class="form-control">
							</div>
							<div class="form-group">
								<label for="reason">Reason for Leave</label>
								<textarea name="leave_reason" id="leave_reason" rows="3" class="form-control" placeholder="Reason for leave..."></textarea>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" class="btn btn-primary" value="Apply Leave">
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

<!-- Leave detail > Reason for leave -->
<div class="modal fade right" id="leave_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-lg modal-right" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title w-100" id="myModalLabel">Leave Detail</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="row mb-3">
								<div class="col-4">Leave Reason: </div>
								<div class="col-8 leave_reason"></div>
							</div>
							<div class="row mb-3">
								<div class="col-4">Supervisor Remarks: </div>
								<div class="col-8 sup_remarks"></div>
							</div>
							<div class="row mb-3">
								<div class="col-4">Director Remarks: </div>
								<div class="col-8 dir_remarks"></div>
							</div>
							<div class="row mb-3">
								<div class="col-4">Progress: </div>
								<div class="col-8 leaveProcess"></div>
							</div>
							<div class="row">
								<div class="col-4">Last Updated: </div>
								<div class="col-8 lastUpdated"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
  </div>
</div>
<!-- Leave detail > Reason for leave -->
<script>
  $(document).ready(function(){
    $('.leave_detail').click(function(){
      var leave_id = $(this).data('id');
      $.ajax({
        url: '<?= base_url('users/leave_detail/'); ?>' + leave_id,
        method: 'POST',
        dataType: 'JSON',
        data:{leave_id: leave_id},
        success: function(response){
				console.log(response);
				var status = response.leave_status;
				if(status == 1){
					status = "Pending for director\'s approval."
				}
			$('.leave_reason').html(response.leave_reason);
			$('.sup_remarks').html(response.sup_remarks);
			$('.dir_remarks').html(response.dir_remarks);
			$('.leaveProcess').html(status);
			$('.lastUpdated').html(response.updated_at);
			$('#leave_detail').modal('show');
        }
      });
    });
  });
</script>
