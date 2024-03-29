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
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i><span class="font-weight-light">Travel History</span> | <a href="<?=base_url('users');?>" class="text-light">Home</a></h4>
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
                  <th class="font-weight-bold">Visit of</th>
                  <th class="font-weight-bold">Assignment</th>
                  <th class="font-weight-bold">Place of Visit</th>
                  <th class="font-weight-bold">Request Type</th>
                  <th class="font-weight-bold">Stay Req. Type</th>
                  <th class="font-weight-bold">Staying At</th>
                  <th class="font-weight-bold">From</th>
                  <th class="font-weight-bold">To</th>
                  <th class="font-weight-bold">Charge To</th>
                  <th class="font-weight-bold">Status</th>
                  <th class="font-weight-bold">Requested On</th>
									<th class="font-weight-bold">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($travels)): foreach($travels as $travel): ?>
                  <tr>
                    <th scope="row"><?= 'CTC-0'.$travel->id; ?></th>
                    <td><?= ucfirst($travel->visit_of); ?></td>
                    <td><?= $travel->assignment; ?></td>
                    <td><?= $travel->place_of_visit; ?></td>
                    <td><?= ucfirst($travel->request_type); ?></td>
                    <td><?= ucfirst($travel->stay_request_type); ?></td>
                    <td><?= ucfirst($travel->staying_at); ?></td>
                    <td><?= date('M d, Y', strtotime($travel->visit_date_start)); ?></td>
                    <td><?= date('M d, Y', strtotime($travel->visit_date_end)); ?></td>
                    <td><?= ucfirst($travel->charge_to); ?></td>
                    <td>
                      <?php if($travel->travel_status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }elseif($travel->travel_status == 1){ echo "<span class='badge badge-warning' title='pending for director approval'>approved</span>"; }elseif($travel->travel_status == 2){ echo "<span class='badge badge-success'>approved</span>"; }else{ echo "<span class='badge badge-danger'>rejected</span>"; } ?>
                    </td>
                    <td><?= date('M d, Y', strtotime($travel->created_at)); ?></td>
										<td>
											<a data-id="<?= $travel->id; ?>" class="btn btn-outline-primary btn-sm dsaClaim" title="DSA Claim">dsa</a>
											<a data-id="<?= $travel->id; ?>" class="btn btn-outline-primary btn-sm obr" title="Office back report">obr</a>
										</td>
                  </tr>
                <?php endforeach; else: echo "<tr class='table-danger'><td colspan='12' align='center'>No record found.</td></tr>"; endif; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer white py-3 d-flex justify-content-start">
            <button type="button" class="btn btn-primary px-3 my-0 ml-0" data-toggle="modal" data-target="#apply_travel">
              <i class="fa fa-plane"></i> Apply travel
            </button>
						<a href="<?= base_url('users/dsa_claims'); ?>" class="btn btn-info px-3 my-0 ml-0">DSA Claims</a>
						<a href="<?= base_url('users/office_back_reports'); ?>" class="btn btn-success px-3 my-0 ml-0">Office Back Reports</a>
            <?= $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Leaves record -->
</div>

<!-- Full Height Modal Right > Apply Travel -->
<div class="modal fade left" id="apply_travel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-xl modal-right" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title w-100" id="myModalLabel">Travel Request Form</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <h4 class="font-weight-lighter mb-5 text-center">Please fill out the form below.</h4>
              <!-- Form -->
              <form action="<?= base_url('users/apply_travel'); ?>" method="post">
                  <input type="hidden" name="requested_by" value="<?= $this->session->userdata('id'); ?>">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="visit_of">Visit of</label>
                        <select name="visit_of" class="browser-default custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <option value="staff">Staff</option>
                          <option value="other">Other</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="assignment">Assignment</label>
                        <input type="text" name="assignment" class="form-control" placeholder="assignment...">
                      </div>
                      <div class="form-group">
                        <label for="place_of_visit">Place of Visit</label>
                        <input type="text" name="place_of_visit" class="form-control" placeholder="place of visit...">
                      </div>
                      <div class="form-group">
                        <label for="visit_start">Visit Start Date</label>
                        <input type="date" name="visit_start" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="visit_end">Visit End Date</label>
                        <input type="date" name="visit_end" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="travel_request_type">Travel Request Type</label>
                        <select name="request_type" class="browser-default custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <option value="by air">By Air</option>
                          <option value="rented car">Rented Car</option>
                          <option value="self">Self</option>
                          <option value="public transport">Public Transport</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="stay_request">Gender</label>
                        <div class="row">
                          <div class="col-3"><input type="radio" name="stay_request" value="Male"> Male</div>
                          <div class="col-6"><input type="radio" name="stay_request" value="Female"> Female</div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="staying_at">Stay Type</label>
                        <select name="staying_at" class="browser-default custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <option value="hotel">Hotel</option>
                          <option value="guest house">Guest House</option>
													<option value="other">Other</option>
                          <option value="none">None</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="check_in">Check In</label>
                        <input type="date" name="check_in" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="check_out">Check Out</label>
                        <input type="date" name="check_out" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="payment_mode">Payment Mode</label>
                        <select name="payment_mode" class="browser-default custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <option value="bill to CTC">Bill to CTC</option>
                          <option value="cash">Cash</option>
                          <option value="credit card">Credit Card</option>
                          <option value="none">None</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="approx_cash">Advance Request</label>
                        <input type="number" name="approx_cash" class="form-control" value="0">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="submit" class="btn btn-primary" value="Submit Request">
                      <input type="reset" class="btn btn-danger" value="clear form">
                    </div>
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
<!-- Full Height Modal Right > claim dsa -->
<div class="modal fade" id="dsa_claim" tabindex="-1" role="dialog" aria-labelledby="dsaClaimModalLabel"
  aria-hidden="true">
	<div class="modal-dialog modal-lg modal-full-height modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dsaClaimModalLabel">DSA Claim Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<h5 class="modal-title font-weight-bold mb-3">Traveler Info</h5>
				<form action="<?= base_url('users/add_dsa_claim'); ?>" method="post">
					<input type="hidden" name="travelId" class="travelId">
					<div class="row">
						<div class="col-md-12">
							<div class="row font-weight-bold">
								<div class="col-md-4">Name</div>
								<div class="col-md-8"><?= $this->session->userdata('fullname') ?></div>
							</div>
							<div class="row">
								<div class="col-md-4">Destination</div>
								<div class="col-md-8 destination"></div>
							</div>
							<div class="row">
								<div class="col-md-4">Transport</div>
								<div class="col-md-8 transport"></div>
							</div>
							<div class="row">
								<div class="col-md-4">Stay</div>
								<div class="col-md-8 stay"></div>
							</div>
							<div class="row">
								<div class="col-md-4">Starts</div>
								<div class="col-md-8 starts"></div>
							</div>
							<div class="row">
								<div class="col-md-4">Ends</div>
								<div class="col-md-8 ends"></div>
							</div>
							<div class="row">
								<div class="col-md-4">Days</div>
								<div class="col-md-8 days"></div>
							</div>
							<div class="row">
								<div class="col-md-4">Charge To</div>
								<div class="col-md-8 chargeTo"></div>
							</div>
							<div class="row">
								<div class="col-md-4">Cash</div>
								<div class="col-md-8 cash"></div>
							</div>
							<div class="row">
								<div class="col-md-4">Payment</div>
								<div class="col-md-8 paymentMode"></div>
							</div>
							<div class="row">
								<div class="col-md-4">Assignment</div>
								<div class="col-md-8 assignment"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12 mt-3">
									<h5 class="modal-title font-weight-bold">Facilities claimed</h5>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-12 facilities">
									
								</div>
							</div>
							<div class="row mt-5">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary">Save Changes</button>
									<button type="reset" class="btn btn-warning">Clear</button>
								</div>
							</div>
						</div>
					</div>
				</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Full Height Modal Right > office back report -->
<div class="modal fade" id="officeBackReport" tabindex="-1" role="dialog" aria-labelledby="dsaClaimModalLabel"
  aria-hidden="true">
	<div class="modal-dialog modal-full-height" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dsaClaimModalLabel">Office Back Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form action="<?= base_url('users/add_officeBackReport'); ?>" method="post">
					<input type="hidden" name="travelIdObr" class="travelIdObr">
					<div class="row font-weight-bold">
						<div class="col-md-3">Name</div>
						<div class="col-md-9"><?= $this->session->userdata('fullname'); ?></div>
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
		$('.dsaClaim').click(function(){
			var travelId = $(this).data('id');
			$.ajax({
				url: '<?= base_url('users/dsa_claim/') ?>' + travelId,
				method: 'POST',
				dataType: 'json',
				data: { travelId: travelId },
				success: function(res){
					console.log(res);
					var checkBoxes = '';
					const diffInMs = new Date(res.visit_date_end) - new Date(res.visit_date_start);
					const diffInDays = diffInMs / (1000 * 60 * 60 * 24);
					const startDate = new Date(res.visit_date_start);
					for(var i = 0; i < diffInDays + 1; i++){
						const currentDate = new Date(startDate);
						currentDate.setDate(startDate.getDate() + i);
						checkBoxes += `
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="facilities[]" class="custom-control-input" id="breakfast${currentDate.toLocaleDateString().split('T')[0]}" value="breakfast - ${currentDate.toLocaleDateString().split('T')[0]},">
								<label class="custom-control-label" for="breakfast${currentDate.toLocaleDateString().split('T')[0]}">Breakfast</label> 
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="facilities[]" class="custom-control-input" id="lunch${currentDate.toLocaleDateString().split('T')[0]}" value="lunch - ${currentDate.toLocaleDateString().split('T')[0]},">
								<label class="custom-control-label" for="lunch${currentDate.toLocaleDateString().split('T')[0]}">Lunch</label>
							</div>
							<div class="custom-control custom-checkbox custom-control-inline">
								<input type="checkbox" name="facilities[]" class="custom-control-input" id="dinner${currentDate.toLocaleDateString().split('T')[0]}" value="dinner - ${currentDate.toLocaleDateString().split('T')[0]}">
								<label class="custom-control-label" for="dinner${currentDate.toLocaleDateString().split('T')[0]}">Dinner</label>
							</div> - Date - ${currentDate.toLocaleDateString().split('T')[0]}
							<hr>
						`;
					}
					$('.facilities').html(checkBoxes);
					$('.travelId').val(travelId);
					$('.destination').html(res.place_of_visit);
					$('.transport').html(res.request_type);
					$('.stay').html(res.staying_at);
					$('.starts').html(new Date(res.visit_date_start).toDateString());
					$('.ends').html(new Date(res.visit_date_end).toDateString());
					$('.days').html(diffInDays);
					$('.chargeTo').html(res.charge_to);
					$('.cash').html(Number(res.approx_cash).toLocaleString());
					$('.paymentMode').html(res.payment_mode);
					$('.assignment').html(res.assignment);
					$('#dsa_claim').modal('show');
				}
			});
		});
		// office back report
		$('.obr').click(function(){
			var travelIdObr = $(this).data('id');
			$('.travelIdObr').val(travelIdObr);
			$('#officeBackReport').modal('show');
		})
	});
</script>

