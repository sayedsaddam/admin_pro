<div class="jumbotron jumbotron-fluid purple-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <h2 class="display-4 font-weight-bold">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout</a>
      </div>
    </div>
  
  </div>
</div>
<div class="container my-5 py-5">

  <!-- Section: Block Content -->
  <section class="">

    <!--Grid row-->
    <div class="row">

      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4">

        <!-- Admin card -->
        <div class="card mt-3">

          <div class="">
            <i class="far fa-money-bill-alt fa-lg primary-color z-depth-2 p-4 ml-3 mt-n3 rounded text-white"></i>
            <div class="float-right text-right p-3">
              <p class="text-uppercase text-muted mb-1"><small>sales</small></p>
              <h4 class="font-weight-bold mb-0">23 000$</h4>
            </div>
          </div>

          <div class="card-body pt-0">
            <div class="progress md-progress">
              <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
            <p class="card-text">Better than last week (75%)</p>
          </div>

        </div>
        <!-- Admin card -->

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4">

        <!-- Admin card -->
        <div class="card mt-3">

          <div class="">
            <i class="fas fa-chart-line fa-lg teal z-depth-2 p-4 ml-3 mt-n3 rounded text-white"></i>
            <div class="float-right text-right p-3">
              <p class="text-uppercase text-muted mb-1"><small>subscriptions</small></p>
              <h4 class="font-weight-bold mb-0">3534</h4>
            </div>
          </div>

          <div class="card-body pt-0">
            <div class="progress md-progress">
              <div class="progress-bar bg-danger" role="progressbar" style="width: 46%" aria-valuenow="46" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
            <p class="card-text">Worse than last week (46%)</p>
          </div>

        </div>
        <!-- Admin card -->

      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4">

        <!-- Admin card -->
        <div class="card mt-3">

          <div class="">
            <i class="fas fa-chart-pie fa-lg purple z-depth-2 p-4 ml-3 mt-n3 rounded text-white"></i>
            <div class="float-right text-right p-3">
              <p class="text-uppercase text-muted mb-1"><small>traffic</small></p>
              <h4 class="font-weight-bold mb-0">656 234</h4>
            </div>
          </div>

          <div class="card-body pt-0">
            <div class="progress md-progress">
              <div class="progress-bar bg-success" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0"
                aria-valuemax="100"></div>
            </div>
            <p class="card-text">Better than last week (31%)</p>
          </div>

        </div>
        <!-- Admin card -->

      </div>
      <!--Grid column-->

    </div>
    <!--Grid row-->

  </section>
  <!--Section: Content-->
<hr>
  <!-- Section: tasks list -->
  <section>

    <div class="row">

      <!-- Grid column -->
      <div class="col-lg-4 col-md-12 mb-4">

        <!-- Panel -->
        <div class="card">

          <div class="card-header white-text primary-color">
            Things to improve
          </div>

          <div class="card-body text-center px-4">
            <div class="list-group list-group-flush">
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Cras justo odio
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i>
              </a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Dapibus ac facilisi
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i>
              </a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Morbi leo risus
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i>
              </a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Porta ac consectet
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i>
              </a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Vestibulum at eros 
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i>
              </a>
            </div>
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
            Tasks to do
          </div>

          <div class="card-body text-center px-4">
            <div class="list-group list-group-flush">
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Cras justo odio
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Dapibus ac facilisi
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Morbi leo risus
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Porta ac consectet
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Vestibulum at eros 
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
            </div>
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
            Statistics
          </div>

          <div class="card-body text-center px-4">
            <div class="list-group list-group-flush">
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Cras justo odio
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Dapibus ac facilisi
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Morbi leo risus
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Porta ac consectet
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
              <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Vestibulum at eros 
                <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
            </div>
          </div>

        </div>
        <!-- Panel -->

      </div>
      <!-- Grid column -->

    </div>

  </section>
  <!-- Section -->

</div>