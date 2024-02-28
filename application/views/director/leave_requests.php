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
					<p class="h5-responsive font-weight-bold mb-0">Leave Requests, <small>pending for director's approval.</small> | <small><a href="javascript:history.go(-1)" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small></p>
					<ul class="list-unstyled d-flex align-items-center mb-0">
						<li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
						<li><i class="fas fa-times fa-sm pl-3"></i></li>
					</ul>
				</div>
				<div class="card-body">
					<table class="table table-sm">
					<caption>Leave Requests, <small>pending for director's approval.</small></caption>
						<thead>
							<tr>
								<th class="font-weight-bold">ID</th>
								<th class="font-weight-bold">Employee</th>
								<th class="font-weight-bold">Leave From</th>
								<th class="font-weight-bold">Leave To</th>
								<th class="font-weight-bold">Days</th>
								<th class="font-weight-bold">Requested</th>
								<th class="font-weight-bold">Status</th>
								<th class="font-weight-bold">Action</th>
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
								<td><?php if($leave->leave_status == 1){ echo '<span class="badge badge-warning" title="pending for director\'s approval">pending</span>'; }elseif($leave->leave_status == 2){ echo '<span class="badge badge-success">approved</span>'; }else{ echo '<span class="badge badge-danger">rejected</span>'; } ?></td>
								<td>
										<a data-id="<?= $leave->id; ?>" class="badge badge-primary approve_leave" title="Approve leave..."><i class="fa fa-check"></i></a>
										<a data-id="<?= $leave->id; ?>" class="badge badge-danger reject_leave" title="Reject leave..."><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<?php endforeach; else: echo '<tr class="table-danger"><td colspan="8" align="center">No record found.</td></tr>'; endif; ?>
						</tbody>
					</table>
				</div>
				<div class="card-footer white py-3 d-flex justify-content-end">
					<?= $this->pagination->create_links(); ?>
				</div>
			</div>
			</div>
		</div>
	</section>
	<!-- Section: Leaves record -->
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
						<h5>Leave Reason</h5>
						<p class="leave_reason"></p>
						<h5>Supervisor's Remarks</h5>
						<p class="sup_remarks"></p>
						<form action="<?= base_url('director/approve_leave'); ?>" method="post">
							<input type="hidden" name="id" id="app_leave_id" value="">
							<div class="form-group">
								<label for="remarks">Director Remarks</label>
								<textarea name="remarks" rows="3" id="app_sup_remarks" class="form-control" placeholder="Director Remarks..."></textarea>
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
						<h5>Leave Reason</h5>
						<p class="leave_reason"></p>
						<h5>Supervisor's Remarks</h5>
						<p class="sup_remarks"></p>
						<form action="<?= base_url('director/reject_leave'); ?>" method="post">
							<input type="hidden" name="id" id="rej_leave_id" value="">
							<div class="form-group">
								<label for="remarks">Director Remarks</label>
								<textarea name="remarks" id="rej_sup_remarks" rows="3" class="form-control" placeholder="Director Remarks..."></textarea>
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
			$('.leave_reason').html(response.leave_reason);
			$('.sup_remarks').html(response.sup_remarks);
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
			$('.leave_reason').html(response.leave_reason);
			$('.sup_remarks').html(response.sup_remarks);
			$('#rej_sup_remarks').val(response.sup_remarks);
			// Display Modal
			$('#reject_leave').modal('show'); 
			}
		});
	});
});
</script>
