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
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i> <br><span class="font-weight-light">DSA Claims</span> | <a href="<?=base_url('users');?>" class="text-light">Home</a></h4>
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
            <p class="h5-responsive font-weight-bold mb-0">DSA Claims | <small><a href="javascript:history.go(-1)" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small></p>
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
                  <th class="font-weight-bold">Facilities</th>
                  <th class="font-weight-bold">Amount</th>
                  <th class="font-weight-bold">Status</th>
                  <th class="font-weight-bold">Created</th>
                  <th class="font-weight-bold">Updated</th>
                  <th class="font-weight-bold">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($dsa_claims)): foreach($dsa_claims as $claim): ?>
                  <tr>
                    <th scope="row"><?= 'CTC-0'.$claim->id; ?></th>
                    <td><?= $claim->facilities; ?></td>
                    <td><?= number_format($claim->amount_released); ?></td>
                    <td>
                      <?php if($claim->dsa_status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }elseif($claim->dsa_status == 1){ echo "<span class='badge badge-success''>approved</span>"; }else{ echo "<span class='badge badge-danger'>rejected</span>"; } ?>
                    </td>
                    <td><?= date('M d, Y', strtotime($claim->created_at)); ?></td>
                    <td><?= !empty($claim->updated_at) ? date('M d, Y', strtotime($claim->updated_at)) : '-/-'; ?></td>
                    <td>
                      <a data-id="<?= $claim->id; ?>" class="btn btn-outline-primary btn-sm dsa_detail">Detail</a>
                    </td>
                  </tr>
                <?php endforeach; else: echo "<tr class='table-danger'><td colspan='12' align='center'>No record found.</td></tr>"; endif; ?>
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

<div class="modal fade" id="dsa_claim" tabindex="-1" role="dialog" aria-labelledby="dsaClaimModalLabel"
  aria-hidden="true">
	<div class="modal-dialog modal-full-height" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dsaClaimModalLabel">DSA Claim</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form action="<?= base_url('users/update_dsa_info'); ?>" method="post">
				<input type="hidden" name="dsaId" class="dsaId">
				<div class="md-form">
					<select name="status" id="defaultRegisterFormLocation" class="browser-default custom-select mb-4" required>
						<option value="" disabled selected>Status</option>
						<option value="1">Accept</option>
						<option value="2">Reject</option>
					</select>
				</div>
				<div class="md-form">
					<input type="number" name="amount" class="form-control" required>
					<label for="materialLoginFormUsername">Amount</label>
				</div>
				<div class="md-form">
					<textarea name="remarks" id="remarks" rows="3" class="md-textarea form-control" "></textarea>
					<label for="remarks">Remarks</label>
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
		$('.dsa_detail').click(function(){
			var dsaId = $(this).data('id');
			$('.dsaId').val(dsaId);
			$('#dsa_claim').modal('show');
		});
	});
</script>
