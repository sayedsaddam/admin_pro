<div class="jumbotron jumbotron-fluid blue-gradient text-light d-print-none">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
			<h2 class="display-4 font-weight-bold" title="Human resource Information Management">HRIM</h2>
      	<h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <a href="<?= base_url('users/profile'); ?>" class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></a>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i> <br><span class="font-weight-light">DSA Claim Detail</span> | <a href="<?=base_url('users');?>" class="text-light">Home</a></h4>
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
            <p class="h5-responsive font-weight-bold mb-0">DSA Claim Detail | <small class="d-print-none"><a href="javascript:history.go(-1)" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small></p>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
              <li><i class="fas fa-times fa-sm pl-3"></i></li>
            </ul>
          </div>
          <div class="card-body">
				<div class="row">
					<div class="col-md-3 border-left">
						<p class="h5-responsive font-weight-bold">Claim Info</p><hr>
						<p class="mb-0"><?= $this->session->userdata('fullname'); ?></p>
						<p class="mb-0">Amount Released: <?= number_format($dsa_claim->amount_released); ?></p>
						<p class="mb-0">Status: <?= $dsa_claim->dsa_status == 0 ? '<span class="badge badge-warning rounded-pill">pending</span>' : '<span class="badge badge-primary">approved</span>'; ?></p>
						<p class="mb-0">Created: <?= date('M d, Y', strtotime($dsa_claim->created_at)); ?></p>
						<p class="mb-0">Updated: <?= !empty($dsa_claim->updated_at) ? date('M d, Y', strtotime($dsa_claim->updated_at)) : 'No action taken!'; ?></p>
					</div>
					<div class="col-md-3 border-left">
						<p class="h5-responsive font-weight-bold">Facilities availed</p><hr>
						<?php 
							$facilities = json_decode($dsa_claim->facilities, true);
							foreach($facilities as $facility){
								foreach($facility as $key => $value){
									$data = explode(',', $value);
									echo implode('<p class="mb-0">', $data) . '</p>';
								}
							}
						?>
					</div>
					<div class="col-md-3 border-left d-print-none">
						<p class="h5-responsive font-weight-bold">Approval Form</p><hr>
						<form action="<?= base_url('users/update_dsa_info'); ?>" method="post">
							<input type="hidden" name="dsaId" class="<?= $dsa_claim->id; ?>">
							<div class="md-form">
								<select name="status" id="defaultRegisterFormLocation" class="browser-default custom-select mb-1" required>
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
								<textarea name="remarks" id="remarks" rows="3" class="md-textarea form-control" required></textarea>
								<label for="remarks">Remarks</label>
							</div>
							<button type="submit" class="btn btn-primary">Save Changes</button>
							<button type="reset" class="btn btn-warning">Clear</button>
						</form>
					</div>
					<div class="col-md-3">
						<p class="h5-responsive font-weight-bold">Other Info</p><hr>
						<p class="mb-0">
							<span class="mdb-color text-white px-2 rounded-pill">Grade 5:</span> Per day <span class="mdb-color text-white px-2 rounded-pill">Rs. 3,000/-</span> claim.
						</p>
						<p class="mb-0">
							<span class="mdb-color text-white px-2 rounded-pill">Grade 4:</span> Per day <span class="mdb-color text-white px-2 rounded-pill">Rs. 2,500/-</span> claim.
						</p>
						<p class="mb-0">
							<span class="mdb-color text-white px-2 rounded-pill">Grade 3:</span> Per day <span class="mdb-color text-white px-2 rounded-pill">Rs. 2,000/-</span> claim.
						</p>
						<p class="mb-0">
							<span class="mdb-color text-white px-2 rounded-pill">Grade 2:</span> Per day <span class="mdb-color text-white px-2 rounded-pill">Rs. 1,500/-</span> claim.
						</p>
						<p class="mb-0">
							<span class="mdb-color text-white px-2 rounded-pill">Grade 1:</span> Per day <span class="mdb-color text-white px-2 rounded-pill">Rs. 1,000/-</span> claim.
						</p>
					</div>
				</div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Leaves record -->
</div>
