<style>
  .footer-hover {
    background-color: rgba(0, 0, 0, 0.1);
    -webkit-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out
  }

  .footer-hover:hover {
    background-color: rgba(0, 0, 0, 0.2)
  }

  .text-black-40 {
    color: rgba(0, 0, 0, 0.4)
  }
</style>
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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i></h4>
      </div>
    </div>
  
  </div>
</div>
<div class="container-fluid my-3 py-3">
  <div class="row">
    <div class="col-lg-2 col-md-2">
      <ul class="list-group list-group-flush">
        <ul class="list-group">
          <li class="list-group-item">
            <a class="text-white btn-floating btn-fb btn-sm"><i class="fas fa-truck-moving"></i></a> Suppliers
          </li>
          <li class="list-group-item">
            <a class="btn-floating btn-tw btn-sm"><i class="fas fa-warehouse"></i></a>Inventory
          </li>
          <li class="list-group-item">
            <a class="text-white btn-floating btn-li btn-sm"><i class="fas fa-users-cog"></i></a>Users
          </li>
          <li class="list-group-item">
            <a class="text-white btn-floating btn-slack btn-sm"><i class="fas fa-user-clock"></i></a>Requisitions
          </li>
          <li class="list-group-item">
            <a class="text-white btn-floating btn-yt btn-sm"><i class="fas fa-tachometer-alt"></i></a>Misc.
          </li>
        </ul>
      </ul>
    </div>
    <div class="col-lg-10 col-md-10">
      <!-- Section: Block Content -->
      <section>
        <?php if($success = $this->session->flashdata('success')): ?>
          <!-- Grid row -->
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="alert alert-success">
                <?= $success; ?>
              </div>
            </div>
          </div>
          <!-- Grid row -->
        <?php endif; ?>
        <!-- Grid row -->
        <div class="row">

          <!-- Grid column -->
          <div class="col-md-6 col-lg-3 mb-4">

            <!-- Card -->
            <div class="card primary-color white-text">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <p class="h2-responsive font-weight-bold mt-n2 mb-0">150</p>
                  <p class="mb-0">Islamabad</p>
                </div>
                <div>
                  <i class="fas fa-shopping-bag fa-4x text-black-40"></i>
                </div>
              </div>
              <a class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-6 col-lg-3 mb-4">

            <!-- Card -->
            <div class="card success-color white-text">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <p class="h2-responsive font-weight-bold mt-n2 mb-0">53 %</p>
                  <p class="mb-0">Balochistan</p>
                </div>
                <div>
                  <i class="fas fa-chart-bar fa-4x text-black-40"></i>
                </div>
              </div>
              <a class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-6 col-lg-3 mb-4">

            <!-- Card -->
            <div class="card light-blue lighten-1 white-text">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <p class="h2-responsive font-weight-bold mt-n2 mb-0">44</p>
                  <p class="mb-0">KP</p>
                </div>
                <div>
                  <i class="fas fa-user-plus fa-4x text-black-40"></i>
                </div>
              </div>
              <a class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-6 col-lg-3 mb-4">

            <!-- Card -->
            <div class="card red accent-2 white-text">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <p class="h2-responsive font-weight-bold mt-n2 mb-0">65</p>
                  <p class="mb-0">Punjab</p>
                </div>
                <div>
                  <i class="fas fa-chart-pie fa-4x text-black-40"></i>
                </div>
              </div>
              <a class="card-footer footer-hover small text-center white-text border-0 p-2">More info<i class="fas fa-arrow-circle-right pl-2"></i></a>
            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

        </div>
        <!-- Grid row -->

      </section>
      <!-- Section: Block Content -->
      <hr>
      <!-- Section: tasks list -->
      <section>
        <div class="row">

          <!-- Grid column -->
          <div class="col-lg-4 col-md-12 mb-4">

            <!-- Panel -->
            <div class="card">

              <div class="card-header white-text primary-color">
                <div class="row">
                  <div class="col-lg-8 col-md-8">
                    Pending Requests <span class="badge badge-light"><?= $pending; ?></span>
                  </div>
                  <div class="col-lg-4 col-md-4 text-right">
                    <a href="" class="badge badge-dark text-uppercase">view <i class="fa fa-eye"></i></a>
                  </div>
                </div>
              </div>

              <div class="card-body text-center px-4">
                <table class="table table-sm">
                  <thead class="black white-text">
                    <tr>
                      <th>ID</th>
                      <th>By</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($pending_requisitions)): foreach($pending_requisitions as $pen_req): ?>
                      <tr>
                        <td><?= 'CTC-0'.$pen_req->id; ?></td>
                        <td><?= $pen_req->fullname; ?></td>
                        <td><?= date('M d, Y', strtotime($pen_req->created_at)); ?></td>
                        <td>
                          <a href=""><span class="badge badge-primary"><i class="fa fa-check"></i></span></a>
                          <a href=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                          <a href="<?= base_url('admin/request_detail/'.$pen_req->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                        </td>
                      </tr>
                    <?php endforeach; else: echo "<tr class='table-danger'><td colspan='4'>No requisitions yet.</td></tr>"; endif;  ?>
                  </tbody>
                </table>
              </div>

            </div>
            <!-- Panel -->

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-lg-4 col-md-6 mb-4">

            <!-- Panel -->
            <div class="card">

              <div class="card-header white-text primary-color">
                <div class="row">
                  <div class="col-lg-8 col-md-8">
                    Approved Requests <span class="badge badge-light"><?= $approved; ?></span>
                  </div>
                  <div class="col-lg-4 col-md-4 text-right">
                    <a href="" class="badge badge-dark text-uppercase">view <i class="fa fa-eye"></i></a>
                  </div>
                </div>
              </div>

              <div class="card-body text-center px-4">
              <table class="table table-sm">
                  <thead class="black white-text">
                    <tr>
                      <th>ID</th>
                      <th>By</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($approved_requisitions)): foreach($approved_requisitions as $app_req): ?>
                      <tr>
                        <td><?= 'CTC-0'.$app_req->id; ?></td>
                        <td><?= $app_req->fullname; ?></td>
                        <td><?= date('M d, Y', strtotime($app_req->created_at)); ?></td>
                        <td>
                          <a href=""><span class="badge badge-primary"><i class="fa fa-check"></i></span></a>
                          <a href=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                          <a href="<?= base_url('admin/request_detail/'.$app_req->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                        </td>
                      </tr>
                    <?php endforeach; else: echo "<tr class='table-danger'><td colspan='4'>No requisitions yet.</td></tr>"; endif; ?>
                  </tbody>
                </table>
              </div>

            </div>
            <!-- Panel -->

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-lg-4 col-md-6 mb-4">

            <!-- Panel -->
            <div class="card">

              <div class="card-header white-text primary-color">
                <div class="row">
                  <div class="col-lg-8 col-md-8">
                    Rejected Requests <span class="badge badge-light"><?= $rejected; ?></span>
                  </div>
                  <div class="col-lg-4 col-md-4 text-right">
                    <a href="" class="badge badge-dark text-right text-uppercase">view <i class="fa fa-eye"></i></a>
                  </div>
                </div>
              </div>

              <div class="card-body text-center px-4">
              <table class="table table-sm">
                  <thead class="black white-text">
                    <tr>
                      <th>ID</th>
                      <th>By</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($rejected_requisitions)): foreach($rejected_requisitions as $rej_req): ?>
                      <tr>
                        <td><?= 'CTC-0'.$rej_req->id; ?></td>
                        <td><?= $rej_req->fullname; ?></td>
                        <td><?= date('M d, Y', strtotime($rej_req->created_at)); ?></td>
                        <td>
                          <a href=""><span class="badge badge-primary"><i class="fa fa-check"></i></span></a>
                          <a href=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                          <a href="<?= base_url('admin/request_detail/'.$rej_req->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                        </td>
                      </tr>
                    <?php endforeach; else: echo "<tr class='table-danger'><td colspan='4'>No requisitions yet.</td></tr>"; endif; ?>
                  </tbody>
                </table>
              </div>

            </div>
            <!-- Panel -->

          </div>
          <!-- Grid column -->

        </div>
      </section>
      <!-- Section -->
    </div>
  </div>
  

</div>