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
<div class="jumbotron jumbotron-fluid purple-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <h2 class="display-4 font-weight-bold">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
      </div>
    </div>
  
  </div>
</div>
<div class="container my-5 py-5">

  <!-- Section: Block Content -->
  <section>

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
              <div class="col-lg-6">
                Pending Requests
              </div>
              <div class="col-lg-6 col-md-6 text-right">
                <a href="" class="badge badge-dark text-uppercase">view <i class="fa fa-eye"></i></a>
              </div>
            </div>
          </div>

          <div class="card-body text-center px-4">
            <table class="table table-sm">
              <thead class="black white-text">
                <tr>
                  <th>Sr</th>
                  <th>By</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>John Doe</td>
                  <td>Feb 20, 2021</td>
                  <td><i class="fa fa-edit"></i></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jane Doe</td>
                  <td>Feb 20, 2021</td>
                  <td><i class="fa fa-edit"></i></td>
                </tr>
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
              <div class="col-lg-6 col-md-8">
                Approved Requests
              </div>
              <div class="col-lg-6 col-md-6 text-right">
                <a href="" class="badge badge-dark text-uppercase">view <i class="fa fa-eye"></i></a>
              </div>
            </div>
          </div>

          <div class="card-body text-center px-4">
          <table class="table table-sm">
              <thead class="black white-text">
                <tr>
                  <th>Sr</th>
                  <th>By</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>John Doe</td>
                  <td>Feb 20, 2021</td>
                  <td><i class="fa fa-edit"></i></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jane Doe</td>
                  <td>Feb 20, 2021</td>
                  <td><i class="fa fa-edit"></i></td>
                </tr>
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
              <div class="col-lg-6 col-md-6">
                Rejected Requests
              </div>
              <div class="col-lg-6 col-md-6 text-right">
                <a href="" class="badge badge-dark text-right text-uppercase">view <i class="fa fa-eye"></i></a>
              </div>
            </div>
          </div>

          <div class="card-body text-center px-4">
          <table class="table table-sm">
              <thead class="black white-text">
                <tr>
                  <th>Sr</th>
                  <th>By</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>John Doe</td>
                  <td>Feb 20, 2021</td>
                  <td><i class="fa fa-edit"></i></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Jane Doe</td>
                  <td>Feb 20, 2021</td>
                  <td><i class="fa fa-edit"></i></td>
                </tr>
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