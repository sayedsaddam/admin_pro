<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/chip.png'); ?>" alt="admin-and-procurement" class="img-thumbnail" width="200">
      </div>
      <div class="col-lg-7 col-md-7">
        <h1 class="font-weight-bold">Admin & Procurement | <a href="" class="btn btn-outline-light btn-md">add request</a>
        <h5 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h5>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Finance Dashboard <i class="fa fa-chart-bar"></i></h4>
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
              <p class="text-uppercase mt-2 mb-1 ml-3"><small>cash issued</small></p>
              <p class="font-weight-bold mb-1 ml-3"><?= '100,000'; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-3">
        <div class="media deep-purple lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-envelope fa-3x deep-purple z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>cash in hand</small></p>
            <p class="font-weight-bold mb-1 ml-3"><?= '92,000'; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->
      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-3">
        <div class="media red lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-plane fa-3x red z-depth-1 p-4 rounded-left"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>expense requests</small></p>
            <p class="font-weight-bold mb-1 ml-3"><?= '10,000'; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->
			<!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-3">
        <div class="media green lighten-2 text-white z-depth-1 rounded">
          <i class="fas fa-plane fa-3x green z-depth-1 p-4 rounded-left text-white"></i>
          <div class="media-body">
            <p class="text-uppercase mt-2 mb-1 ml-3"><small>expenses approved</small></p>
            <p class="font-weight-bold mb-1 ml-3"><?= '8,000'; ?></p>
          </div>
        </div>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </section>
  <!--Section: Blocks Content-->
