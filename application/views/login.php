<div class="container my-5 py-5 z-depth-1">


<!--Section: Content-->
<section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">


  <!--Grid row-->
  <div class="row d-flex">

    <!--Grid column-->
    <div class="col-md-6">

        <h1 class="font-weight-bold grey-text display-4">AH Group of Companies (Pvt.) Ltd. <span class="font-weight-light grey-text">Islamabad, 44000.</span></h1>
        <h3 class="font-weight-light text-success">Admin & Procurement.</h3>
        <p class="text-grey font-weight-light text-justify">We are an emerging group of various businesses like real estate development, architecture development, construction services and planning, corporate brand building, Investment planning, sales & marketing services, and digital services.</p>

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-6 justify-content-right">

        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="<?= base_url('login/authenticate'); ?>" method="post">

          <!-- Username -->
          <div class="md-form">
            <input type="text" name="username" class="form-control" required>
            <label for="materialLoginFormUsername">Username</label>
          </div>

          <!-- Password -->
          <div class="md-form">
            <input type="password" name="password" class="form-control" required>
            <label for="materialLoginFormPassword">Password</label>
          </div>

          <div class="d-flex justify-content-around">
            <div>
              <!-- Remember me -->
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
                <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
              </div>
            </div>
            <div>
              <!-- Forgot password -->
              <a href="">Forgot password?</a>
            </div>
          </div>

          <!-- Sign in button -->
          <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

          <!-- Register -->
          <p>Not a member?
            <a href="<?= base_url('login/signup'); ?>">Register</a>
          </p>

          <!-- Social login -->
          <p>or sign in with:</p>
          <a type="button" class="btn-floating btn-fb btn-sm">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a type="button" class="btn-floating btn-tw btn-sm">
            <i class="fab fa-twitter"></i>
          </a>
          <a type="button" class="btn-floating btn-li btn-sm">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a type="button" class="btn-floating btn-git btn-sm">
            <i class="fab fa-github"></i>
          </a>
      </form>
      <!-- Form -->
      <!-- Failute message -->
      <?php if($login_failed = $this->session->flashdata('login_failed')): ?>
        <div class="alert alert-danger mt-4"><?= $login_failed; ?></div>
      <?php endif; ?>
    </div>
    <!--Grid column-->

  </div>
  <!--Grid row-->


</section>
<!--Section: Content-->


</div>