<div class="container my-5 py-5 z-depth-1">


<!--Section: Content-->
<section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">


  <!--Grid row-->
  <div class="row d-flex">

    <!--Grid column-->
    <div class="col-md-6">

        <h1 class="font-weight-bold grey-text display-4">CHIP Training and Consulting (Pvt.) Ltd. <span class="font-weight-light grey-text">Islamabad 44000.</span></h1>
        <h3 class="font-weight-light text-success">Admin & Procurement <br>department</h3>
        <p class="text-grey font-weight-light">While CHIP Training & Consulting Pvt. Ltd. (CTC) was launched as an independent consultancy firm fairly recently, its roots go back to 1993 when it was initially a Swiss NGO Programme Office (SNPO as part of SDC / Embassy of Switzerland) later becoming an independent non-profit organization, namely CHIP (Civil Society Human & Institutional Development Programme).</p>

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-6 justify-content-right">

      <!-- Default form login -->
      <form class="text-center" action="<?= base_url('login/authenticate'); ?>" method="post">

        <p class="h4 mb-4">Sign in</p>

        <!-- Email -->
        <input type="text" name="username" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="username">

        <!-- Password -->
        <input type="password" name="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">

        <div class="d-flex justify-content-around">
          <div>
            <!-- Remember me -->
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
              <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
            </div>
          </div>
          <div>
            <!-- Forgot password -->
            <a href="">Forgot password?</a>
          </div>
        </div>

        <!-- Sign in button -->
        <button class="btn btn-info btn-block my-4" type="submit">Sign in</button>

        <!-- Register -->
        <p>Not a member?
          <a href="<?= base_url('login/signup'); ?>">Register</a>
        </p>

        <!-- Social login -->
        <p>or sign in with:</p>

            <a href="#" class="mx-1" role="button"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="mx-1" role="button"><i class="fab fa-twitter"></i></a>
            <a href="#" class="mx-1" role="button"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" class="mx-1" role="button"><i class="fab fa-github"></i></a>
        
        <hr>
        <?php if($login_failed = $this->session->flashdata('login_failed')): ?>
          <div class="alert alert-danger">
            <?= $login_failed; ?>
          </div>
        <?php endif; ?>
        <!-- Failure or Success message if there is any. -->
        <?php if($success = $this->session->flashdata('success')): ?>
          <div class="alert alert-danger">
            <?php $success; ?>
          </div>
        <?php else: echo "&copy; ".date('Y')." <span class='font-weight-bold text-success'>CHIP</span> Training & Consulting (Pvt.) Ltd."; endif; ?>
      </form>
      <!-- Default form login -->

    </div>
    <!--Grid column-->

  </div>
  <!--Grid row-->


</section>
<!--Section: Content-->


</div>