<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid">
      </div>
      <div class="col-lg-7 col-md-7">
        <h1 class="display-4 font-weight-bold mb-0">Admin & Procurement <?php if($this->session->userdata('user_role') == 'supervisor'): ?>|<a href="<?= base_url('supervisor'); ?>" class="btn btn-outline-light btn-sm">Supervisor board</a><?php endif; ?></h1>
        <h2 class="font-weight-bold text-light">AH Group of Companies (Pvt.) Ltd.</h2>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i></h4>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid my-2 py-2">
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
    <!-- Grid row -->
    <div class="row mb-4">
      <div class="col-12 text-right">
        <button class="btn btn-outline-unique" data-toggle="modal" data-target="#fullHeightModalLeft"><i class="fa fa-envelope"></i> Place requisisition</button>
        <a href="<?= base_url('users/requisitions'); ?>" class="btn btn-outline-dark"><i class="fa fa-envelope"></i> View requisitions</a>
        <button data-toggle="modal" data-target="#apply_travel" class="btn btn-outline-info"><i class="fa fa-plane"></i> Apply Travel</button>
        <a href="<?= base_url('users/travel_history'); ?>" class="btn btn-outline-purple"><i class="fa fa-plane"></i> Travel History <span class="badge badge-info"><?= $total_travels; ?></span></a>
      </div>
    </div>
    <!--Grid row-->
    <div class="row">

      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-3">
        <div class="media blue lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-spinner fa-3x blue z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
              <p class="text-uppercase mt-2 mb-1 ml-3"><small>pending requests</small></p>
              <p class="font-weight-bold mb-1 ml-3"><?= $pending; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-3">
        <div class="media deep-purple lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-check-double fa-3x deep-purple z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>Approved Requests</small></p>
            <p class="font-weight-bold mb-1 ml-3"><?= $approved; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-3">
        <div class="media pink lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-times fa-3x pink z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>rejected requests</small></p>
            <p class="font-weight-bold mb-1 ml-3"><?= $rejected; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </section>
  <!--Section: Blocks Content-->

  <!-- Section: Requisitions list -->
  <section>
    <div class="row">
      <div class="col-12">
      	<div class="card card-list">
          <div class="card-header white d-flex justify-content-between align-items-center py-3">
            <p class="h5-responsive font-weight-bold mb-0">Recent Requisitions</p>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
              <li><i class="fas fa-times fa-sm pl-3"></i></li>
            </ul>
          </div>
          <div class="card-body">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th class="font-weight-bold">Order ID</th>
                  <th class="font-weight-bold">Item</th>
                  <th class="font-weight-bold">Quantity</th>
                  <th class="font-weight-bold">Desciption</th>
                  <th class="font-weight-bold">Status</th>
                  <th class="font-weight-bold">Requested</th>
                  <th class="font-weight-bold">Processed</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($requisitions)): foreach($requisitions as $req): ?>
                  <tr>
                    <th scope="row"><?= 'AHG-0'.$req->id; ?></th>
                    <td><?= ucfirst($req->sub_cat_name); ?></td>
                    <td><?= $req->item_qty; ?></td>
                    <td><?= $req->item_desc; ?></td>
                    <td>
                      <?php if($req->status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }elseif($req->status == 1){ echo "<span class='badge badge-success'>approved</span>"; }else{ echo "<span class='badge badge-danger'>rejected</span>"; } ?>
                    </td>
                    <td><?= date('M d, Y', strtotime($req->created_at)); ?></td>
                    <td>
                      <?php if($req->updated_at != NULL){ echo date('M d, Y', strtotime($req->updated_at)); }else{ echo "<span class='purple-text'>Nothing yet.</span>"; } ?>
                    </td>
                  </tr>
                <?php endforeach; else: echo '<tr class="table-danger"><td colspan="7" align="center">Looks like you have no requisistions yet.</td></tr>'; endif; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer white py-3 d-flex justify-content-between">
            <!-- <button type="button" class="btn btn-primary btn-md px-3 my-0 ml-0" data-toggle="modal" data-target="#fullHeightModalLeft">
                <i class="fa fa-plus"></i> Place requisisition
            </button>
            <a href="<?= base_url('users/requisitions'); ?>" class="btn btn-light btn-md px-3 my-0 ml-0"><i class="fa fa-eye"></i> View All requisitions</a>
          </div> -->
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Block Content -->
</div>

<!-- Full Height Modal Left > Place requisition -->
<div class="modal fade left" id="fullHeightModalLeft" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-full-height modal-left" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title w-100" id="myModalLabel">Create Requisition</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h4 class="font-weight-lighter mb-5">Please fill out the form below.</h4>
                    <!-- Form -->
                    <form action="<?= base_url('users/create_requisition'); ?>" method="post">
                        <!-- item name -->
                        <div class="form-group">
                            <label for="itemName">Category</label>
                            <select name="category" id="category" class="browser-default custom-select">
                                <option value="" disabled selected>-- Main Category --</option>
                                <?php if(!empty($items)): foreach($items as $item): ?>
                                  <option value="<?=$item->cat_id;?>"><?=$item->cat_name;?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="itemName">Item name</label>
                            <select name="sub_category" id="sub_category" class="browser-default custom-select">
                              <option value="" disabled selected>-- Sub Category --</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea name="description" id="description" class="form-control" placeholder="Description..."></textarea>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" placeholder="Item quantity...">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Save Changes">
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
<!-- Full Height Modal Left -->

<!-- Full Height Modal Right > Apply Travel -->
<div class="modal fade left" id="apply_travel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
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
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="approx_cash">Approx. Cash Needed</label>
                        <input type="text" name="approx_cash" class="form-control" placeholder="approximate cash...">
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
<!-- Full Height Modal Right -->
<script>
$(document).ready(function(){
 
 // City change
 $('#category').on('change', function(){
   var category = $(this).val();

   // AJAX request
   $.ajax({
     url:'<?=base_url('users/get_sub_categories/')?>' + category,
     method: 'post',
     data: {category: category},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#sub_category').find('option').not(':first').remove();

       // Add options
       $.each(response,function(index, data){
          $('#sub_category').append('<option value="'+data['id']+'">'+data['name']+'</option>');
       });
     }
  });
});
});
</script>