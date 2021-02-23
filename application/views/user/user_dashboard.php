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
        <h4 class="font-weight-bold orange-text mt-2">User Dashboard <i class="fa fa-chart-bar"></i></h4>
      </div>
    </div>
  </div>
</div>
<div class="container my-3 py-3">
<!--Section: Block Content-->
<section>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="alert alert-success">
                Request submission was successful.
            </div>
        </div>
    </div>
  <!--Grid row-->
  <div class="row">

    <!--Grid column-->
    <div class="col-lg-4 col-md-12 mb-4">
        <div class="media blue lighten-2 text-white z-depth-1 rounded">
        <i class="far fa-money-bill-alt fa-3x blue z-depth-1 p-4 rounded-left text-white"></i>
        <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>pending requests</small></p>
            <p class="font-weight-bold mb-1 ml-3">23</p>
        </div>
        </div>


    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-4 col-md-6 mb-4">

      <div class="media deep-purple lighten-2 text-white z-depth-1 rounded">
        <i class="fas fa-chart-bar fa-3x deep-purple z-depth-1 p-4 rounded-left text-white"></i>
        <div class="media-body">
          <p class="text-uppercase mt-2 mb-1 ml-3"><small>Approved Requests</small></p>
          <p class="font-weight-bold mb-1 ml-3">32</p>
        </div>
      </div>


    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-4 col-md-6 mb-4">

      <div class="media pink lighten-2 text-white z-depth-1 rounded">
        <i class="fas fa-download fa-3x pink z-depth-1 p-4 rounded-left text-white"></i>
        <div class="media-body">
          <p class="text-uppercase mt-2 mb-1 ml-3"><small>rejected requests</small></p>
          <p class="font-weight-bold mb-1 ml-3">13</p>
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
            <p class="h5-responsive font-weight-bold mb-0">Previous Orders</p>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
              <li><i class="fas fa-times fa-sm pl-3"></i></li>
            </ul>
          </div>
          <div class="card-body">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th scope="col">Order ID</th>
                  <th scope="col">Item</th>
                  <th scope="col">Status</th>
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"><a class="text-primary">OR1848</a></th>
                  <td>Samsung Smart TV</td>
                  <td><span class="badge badge-warning">Pending</span></td>
                  <td>Feb 20, 2021</td>
                </tr>
                <tr>
                  <th scope="row"><a class="text-primary">OR7429</a></th>
                  <td>iPhone 6 Plus</td>
                  <td><span class="badge badge-danger">Delivered</span></td>
                  <td>Feb 20, 2021</td>
                </tr>
                <tr>
                  <th scope="row"><a class="text-primary">OR9842</a></th>
                  <td>Call of Duty IV</td>
                  <td><span class="badge badge-success">Shipped</span></td>
                  <td>Feb 20, 2021</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer white py-3 d-flex justify-content-between">
            <button type="button" class="btn btn-primary btn-md px-3 my-0 ml-0" data-toggle="modal" data-target="#fullHeightModalLeft">
                Place new order
            </button>
            <button class="btn btn-light btn-md px-3 my-0 ml-0">View All Orders</button>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- Section: Block Content -->

</div>

<!-- Full Height Modal Right -->
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
                                <option selected>select item</option>
                                <option value="chalk">Chalk</option>
                                <option value="pen">Pen</option>
                                <option value="printing paper">Printing Paper</option>
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
<!-- Full Height Modal Right -->