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
      <div class="col-12 text-center">
        <button data-toggle="modal" data-target="#apply_leave" type="button" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Apply Leave</button>
        <a href="<?= base_url('users/track_leaves'); ?>" class="btn btn-outline-secondary"><i class="fa fa-eye"></i> Track Leaves</a>
        <button type="button" class="btn btn-outline-unique" data-toggle="modal" data-target="#fullHeightModalLeft"><i class="fa fa-plus"></i> Place requisisition</button>
        <a href="<?= base_url('users/requisitions'); ?>" class="btn btn-outline-dark"><i class="fa fa-eye"></i> View requisitions</a>
        <a href="" class="btn btn-outline-info"><i class="fa fa-plus"></i> Apply Travel</a>
        <a href="" class="btn btn-outline-purple"><i class="fa fa-eye"></i> Travel History</a>
      </div>
    </div>
    <!--Grid row-->
    <div class="row">

      <!--Grid column-->
      <div class="col-lg-3 col-md-12 mb-3">
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
      <div class="col-lg-3 col-md-6 mb-3">
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
      <div class="col-lg-3 col-md-6 mb-3">
        <div class="media pink lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-times fa-3x pink z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>rejected requests</small></p>
            <p class="font-weight-bold mb-1 ml-3"><?= $rejected; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-3">
        <div class="media green lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-times fa-3x green z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small class="font-weight-bold">leaves - 22</small></p>
            <p class="font-weight-lighter mb-1 ml-3 mb-0"><?php if(!empty($availed_leaves)){ echo 'Availed : '. $availed_leaves->no_of_days; } ?></p>
            <p class="font-weight-lighter mb-1 ml-3"><?php if(!empty($availed_leaves)){ echo 'Balance : '. (22 - $availed_leaves->no_of_days); } ?></p>
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
                    <th scope="row"><?= 'CTC-0'.$req->id; ?></th>
                    <td><?= ucfirst($req->inv_name); ?></td>
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
                <?php endforeach; endif; ?>
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
                    <h4 class="font-weight-lighter mb-5">Pleas fill out the form below.</h4>
                    <!-- Form -->
                    <form action="<?= base_url('users/create_requisition'); ?>" method="post">
                        <!-- First name -->
                        <div class="form-group">
                            <label for="itemName">Item name</label>
                            <select name="item_name" id="item_name" class="browser-default custom-select">
                                <option value="" disabled selected>-- Select Item --</option>
                                <?php if(!empty($items)): foreach($items as $item): ?>
                                  <option value="<?=$item->id;?>"><?=$item->item_name;?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control">
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
                          <option value="Casual">Casual</option>
                          <option value="Medical">Medical</option>
                          <option value="Maternity">Maternity</option>
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