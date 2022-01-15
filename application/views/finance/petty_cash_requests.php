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
        <h4 class="font-weight-bold orange-text mt-2">Finance Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light">Petty Cash Requests</span> | <a href="<?=base_url('finance');?>" class="text-light">Home</a></h4>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid my-3 py-3">

  <!-- Section: Leaves record -->
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
    <div class="row">
      <div class="col-12">
      	<div class="card card-list">
          <div class="card-header white d-flex justify-content-between align-items-center py-3">
            <p class="h5-responsive font-weight-bold mb-0">Petty Cash Requests | <small><a href="javascript:history.go(-1)" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small></p>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
              <li><i class="fas fa-times fa-sm pl-3"></i></li>
            </ul>
          </div>
          <div class="card-body">
            <table class="table table-sm">
            <caption>Petty Cash Requests</caption>
                <thead>
                    <tr>
                        <th class="font-weight-bold">ID</th>
                        <th class="font-weight-bold">Amount</th>
                        <th class="font-weight-bold">Requested By</th>
                        <th class="font-weight-bold">Location</th>
                        <th class="font-weight-bold">Justification</th>
												<th class="font-weight-bold">Status</th>
                        <th class="font-weight-bold">Date</th>
												<th class="font-weight-bold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($cash_requests)): foreach($cash_requests as $cr): ?>
                    <tr>
                        <td scope="row"><?= 'CTC-'.$cr->id; ?></td>
                        <td><?= number_format($cr->amount); ?></td>
                        <td><?= ucfirst($cr->fullname); ?></td>
                        <td><?= $cr->location_name; ?></td>
                        <td><?= ucfirst($cr->justification); ?></td>
												<td>
													<?php if($cr->status == 0){ echo 'Pending'; }elseif($cr->status == 1){ echo 'Approved'; }else{ echo 'Rejected'; } ?>
												</td>
                        <td><?= date('M d, Y', strtotime($cr->created_at)); ?></td>
                        <td>
													<?php if($cr->requested_by == $this->session->userdata('id') OR $cr->status == 1): ?>
														<span type="button" class="badge badge-danger">NFA</span>
													<?php else: ?>
                          	<a data-id="<?= $cr->id; ?>" class="badge badge-primary edit_cash_issuance" title="Update request status..."><i class="fa fa-eye"></i></a>
													<?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; else: echo '<tr class="table-danger"><td colspan="7" align="center">No record found.</td></tr>'; endif; ?>
                </tbody>
            </table>
          </div>
          <div class="card-footer white py-3 d-flex justify-content-between">
            <?= $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Leaves record -->
</div>

<!-- cash issuance -->
<div class="modal fade" id="edit_cash_issuance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Request Approval or Rejection</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('finance/update_request_status');?>" method="post" class="md-form">
					<input type="hidden" name="id" class="id">
					<input type="hidden" name="location" class="location">
					<input type="hidden" name="amount_requested" class="amount_requested">
			
					<div class="row">
						<div class="col-md-3">
							Justification
						</div>
						<div class="col-md-9 justification"></div>
					</div>

						<div class="md-form">
              <select name="status" id="status" class="browser-default custom-select">
								<option value="" disabled selected>--Select Status--</option>
								<option value="1">Accept</option>
								<option value="2">Reject</option>
              </select>
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

<script>
$(document).ready(function(){
  $('.edit_cash_issuance').click(function(){  // Leave approval modal will be displayed.
    var id = $(this).data('id');
    // AJAX request
    $.ajax({
    url: '<?= base_url('finance/petty_cash_request_detail/'); ?>' + id,
    method: 'POST',
    dataType: 'JSON',
    data: {id: id},
      success: function(response){ 
        console.log(response);
        $('.id').val(response.id);
				$('.location').val(response.location);
				$('.amount_requested').val(response.amount);
        $('.justification').html(response.justification);
        // Display Modal
        $('#edit_cash_issuance').modal('show'); 
      }
    });
  });
});
</script>
