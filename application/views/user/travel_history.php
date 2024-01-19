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
											<a data-id="<?= $travel->id; ?>" class="btn btn-outline-primary btn-sm dsaClaim">DSA Claim</a>
										</td>
                  </tr>
                <?php endforeach; else: echo "<tr class='table-danger'><td colspan='12' align='center'>No record found.</td></tr>"; endif; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer white py-3 d-flex justify-content-between">
            <button type="button" class="btn btn-primary px-3 my-0 ml-0" data-toggle="modal" data-target="#apply_travel">
                <i class="fa fa-plane"></i> Apply travel
            </button>
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
					<h4 class="modal-title w-100" id="myModalLabel">Travel Application Form</h4>
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
                        <label for="charge">Charge To</label>
                        <input type="text" name="charge_to" class="form-control" placeholder="charge to...">
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
                        <label for="stay_request">Hotel Stay Request</label>
                        <div class="row">
                          <div class="col-3"><input type="radio" name="stay_request" value="Male"> Male</div>
                          <div class="col-6"><input type="radio" name="stay_request" value="Female"> Female</div>
                        </div>
                        <div class="row">
                          <div class="col-3"><input type="radio" name="stay_request_one" value="Single Room"> Single Room</div>
                          <div class="col-6"><input type="radio" name="stay_request_one" value="Twins"> Twins</div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="staying_at">Staying at</label>
                        <select name="staying_at" class="browser-default custom-select" required>
                          <option value="" selected disabled>Select one</option>
                          <option value="hotel">Hotel</option>
                          <option value="guest house">Guest House</option>
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
                        <label for="approx_cash">Approx. Cash Needed</label>
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
<div class="modal-dialog modal-full-height" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dsaClaimModalLabel">DSA Claim Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
					<div class="col-md-12">
						
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
		$('.dsaClaim').click(function(){
			var travelId = $(this).data('id');
			$.ajax({
				url: '<?= base_url('users/dsa_claim/') ?>' + travelId,
				method: 'POST',
				dataType: 'json',
				data: { travelId: travelId },
				success: function(res){
					console.log(res);
					$('#dsa_claim').modal('show');
				}
			});
		});
	});
</script>

