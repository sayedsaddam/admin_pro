<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/chip.png'); ?>" alt="admin-and-procurement" class="img-thumbnail" width="200">
      </div>
      <div class="col-lg-7 col-md-7">
        <h1 class="font-weight-bold">Admin & Procurement | 
					<button data-toggle="modal" data-target="#add_request" class="btn btn-outline-light btn-md">add request</button>
					<button data-toggle="modal" data-target="#cash_issuance" class="btn btn-outline-light btn-md">cash issuance</button>
        <h5 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h5>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Finance Dashboard <i class="fa fa-chart-bar"></i><br>
					<?php if($this->session->userdata('user_role') == 'admin'): ?>
						<a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a>
					<?php endif; ?>
					<?php if($this->session->userdata('user_role') == 'finance'): ?>
						<a href="<?= base_url('users'); ?>" class="btn btn-outline-light btn-sm">Employee Board</a>
					<?php endif; ?>
				</h4>
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
                  <?= $success; ?>
              </div>
          </div>
      </div>
    <?php endif; ?>
    <!--Grid row-->
    <div class="row mb-4">

      <!--Grid column-->
      <div class="col-lg-3 col-md-12 mb-3">
        <div class="media blue lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-paper-plane fa-3x blue z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
              <p class="text-uppercase mt-2 mb-1 ml-3"><small>cash issued &raquo; <a href="<?= base_url('finance/petty_cash_issued'); ?>" class="text-light font-weight-bold">read more</a></small></p>
              <p class="font-weight-bold mb-1 ml-3"><?= !empty($cash_issued) ? number_format($cash_issued->total_amount) : '0'; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-3">
        <div class="media deep-purple lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-envelope fa-3x deep-purple z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>cash in hand &raquo; <a href="" class="text-light font-weight-bold">read more</a></small></p>
            <p class="font-weight-bold mb-1 ml-3"><?= !empty($cash_issued) && !empty($petty_cash_requested) ? number_format($cash_issued->total_amount - $petty_cash_requested->requested_amount) : '0'; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->
      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-3">
        <div class="media red lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-pen fa-3x red z-depth-1 p-4 rounded-left"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>expense requests &raquo; <a href="<?= base_url('finance/petty_cash_requests'); ?>" class="text-light font-weight-bold">more</a></small></p>
            <p class="font-weight-bold mb-1 ml-3"><?= !empty($pending_cash_requests) ? number_format($pending_cash_requests->requested_amount) : '0'; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->
			<!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-3">
        <div class="media green lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-check fa-3x green z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>expenses approved</small></p>
            <p class="font-weight-bold mb-1 ml-3"><?= !empty($petty_cash_requested) ? number_format($petty_cash_requested->requested_amount) : '0'; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </section>
  <!--Section: Blocks Content-->

<!-- Add request -->
<div class="modal fade" id="add_request" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Add Request</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('finance/add_petty_cash_request');?>" method="post" class="md-form">
            <div class="md-form mb-5">
              <input name="amount" type="number" id="form34" class="form-control validate" required>
              <label data-error="wrong" data-success="right" for="form34">Amount Required</label>
            </div>

            <div class="md-form">
              <textarea name="reason" type="text" class="md-textarea form-control" rows="3" required></textarea>
              <label data-error="wrong" data-success="right" for="form8">Justification / Reason</label>
            </div>

            <div class="md-form mb-5">
              <input type="submit" class="btn btn-primary" value="Save Changes">
            </div>
        </form>
      </div>
      <div class="modal-footer d-flex justify-content-right">
        <button class="btn btn-unique" data-dismiss="modal" aria-label="Close">Close <i class="fas fa-paper-plane-o ml-1"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- cash issuance -->
<div class="modal fade" id="cash_issuance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Cash Issuance</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('finance/cash_issuance');?>" method="post" class="md-form">
					<div class="md-form mb-5">
              <select name="location" id="location" class="browser-default custom-select">
                <option value="" disabled selected>--Select location--</option>
                <?php if(!empty($locations)): foreach($locations as $loc): ?>
                  <option value="<?= $loc->id ?>"><?= $loc->name; ?></option>
                <?php endforeach; endif; ?>
              </select>
            </div>

            <div class="md-form mb-5">
              <input name="amount_issued" type="number" id="form34" class="form-control validate">
              <label data-error="wrong" data-success="right" for="form34">Amount Issued</label>
            </div>

            <div class="md-form">
              <textarea name="remarks" type="text" class="md-textarea form-control" rows="3"></textarea>
              <label data-error="wrong" data-success="right" for="form8">Remarks</label>
            </div>

            <div class="md-form mb-5">
              <input type="submit" class="btn btn-primary" value="Save Changes">
            </div>
        </form>
      </div>
      <div class="modal-footer d-flex justify-content-right">
        <button class="btn btn-unique" data-dismiss="modal" aria-label="Close">Close <i class="fas fa-paper-plane-o ml-1"></i></button>
      </div>
    </div>
  </div>
</div>
