<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <h2 class="display-4 font-weight-bold">HRM</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <a href="<?= base_url('users/profile'); ?>" class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></a>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i><span class="font-weight-light">Office Back Reports</span> | <a href="<?=base_url('users');?>" class="text-light">Home</a></h4>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid my-3 py-3">
  <!-- Section: Leaves record -->
  <section>
    <div class="row">
      <div class="col-12">
			<?php if($success = $this->session->flashdata('success')): ?>
				<div class="alert alert-success"><?= $success; ?></div>
			<?php elseif($failed = $this->session->flashdata('failed')): ?>
				<div class="alert alert-danger"><?= $failed; ?></div>
			<?php endif; ?>
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
						<th class="font-weight-bold">Description</th>
                  <th class="font-weight-bold">Status</th>
                  <th class="font-weight-bold">Date</th>
						<th class="font-weight-bold">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($ob_reports)): foreach($ob_reports as $rep): ?>
                  <tr>
							<th scope="row"><?= 'CTC-0'.$rep->id; ?></th>
							<td><?= $rep->travel_description; ?></td>
							<td>
								<?php if($rep->status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }elseif($rep->status == 1){ echo "<span class='badge badge-warning' title='pending for director approval'>approved</span>"; }elseif($rep->status == 2){ echo "<span class='badge badge-success'>approved</span>"; }else{ echo "<span class='badge badge-danger'>rejected</span>"; } ?>
							</td>
							<td><?= date('M d, Y', strtotime($rep->created_at)); ?></td>
							<td>
								<a data-id="<?= $rep->id; ?>" class="btn btn-outline-primary btn-sm obrDetail" title="DSA Claim">detail</a>
							</td>
                  </tr>
                <?php endforeach; else: echo "<tr class='table-danger'><td colspan='12' align='center'>No record found.</td></tr>"; endif; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer white py-3 d-flex justify-content-start">
            <?= $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Leaves record -->
</div>

<!-- Full Height Modal Right > office back report -->
<div class="modal fade" id="obrDetail" tabindex="-1" role="dialog" aria-labelledby="dsaClaimModalLabel"
  aria-hidden="true">
	<div class="modal-dialog modal-full-height" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dsaClaimModalLabel">Office Back Report Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form action="<?= base_url('users/update_officeBackReport'); ?>" method="post">
				<input type="hidden" name="travelIdObr" class="travelIdObr">
				<div class="row font-weight-bold">
					<div class="col-md-3">Name</div>
					<div class="col-md-9"><?= $this->session->userdata('fullname'); ?></div>
				</div>
				<div class="md-form">
					<select name="status" id="" class="brower-default custom-select status">
						<option value="" disabled selected>Status</option>
						<option value="1">Approve</option>
						<option value="2">Reject</option>
					</select>
				</div>
				<div class="md-form">
					<textarea name="description" class="md-textarea form-control" rows="5" required></textarea>
					<label for="description">Description</label>
				</div>
				<button type="submit" class="btn btn-primary">Save Changes</button>
				<button type="reset" class="btn btn-warning">Clear</button>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(document).ready(function(){
		$('.obrDetail').click(function(){
			var obrId = $(this).data('id');
			var userId = '<?= $this->session->userdata('id') ?>';
			$.ajax({
				url: '<?= base_url('users/obr_detail/') ?>' + obrId,
				method: 'POST',
				dataType: 'json',
				data: { obrId: obrId },
				success: function(res){
					if(userId == res.user_id){
						$('.status').attr('disabled', true);
					}else{
						$('.status').attr('disabled', false);
					}
					$('.md-textarea').html(res.travel_description);
					$('#obrDetail').modal('show');
				}
			})
		});
	});
</script>
