<div class="container my-5 py-5 z-depth-1">

 
<!--Section: Content-->
<section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">


  <!--Grid row-->
  <div class="row d-flex">
    
    <!--Grid column-->
    <div class="col-md-6">
    <h1 class="font-weight-bold grey-text display-4">CHIP Training and Consulting (Pvt.) Ltd. <span class="font-weight-light dark-text">Islamabad 44000.</span></h1>
        <h3 class="font-weight-light text-success">Admin & Procurement <br>department</h3>
        <p class="text-grey font-weight-light">While CHIP Training & Consulting Pvt. Ltd. (CTC) was launched as an independent consultancy firm fairly recently, its roots go back to 1993 when it was initially a Swiss NGO Programme Office (SNPO as part of SDC / Embassy of Switzerland) later becoming an independent non-profit organization, namely CHIP (Civil Society Human & Institutional Development Programme).</p>
    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-md-6">

      <!-- Default form register -->
      <form class="text-center" action="<?= base_url('login/register'); ?>" method="post">

        <p class="h4 mb-4">Sign up | <span class="font-weight-light grey-text">Register a user.</span></p>
            <!-- First name -->
            <input type="text" name="fullname" id="defaultRegisterFormFullName" class="form-control mb-4" placeholder="Full name">

        <!-- E-mail -->
        <input type="email" name="email" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Email">

        <!-- username -->
        <input type="text" name="username" id="defaultRegisterFormEmail" class="form-control mb-4" placeholder="Username">

        <!-- Password -->
        <input type="password" name="password" id="defaultRegisterFormPassword" class="form-control mb-4" placeholder="Password"
          aria-describedby="defaultRegisterFormPasswordHelpBlock">

        <!-- Location -->
        <select name="location" id="defaultRegisterFormLocation" class="form-control mb-4">
            <option value="">Location</option>
            <option value="islamabad">Islamabad</option>
            <option value="kp">KP</option>
            <option value="balochistan">Balochistan</option>
            <option value="punjab">Punjab</option>
        </select>

        <!-- Sign up button -->
        <button class="btn btn-info my-4" type="submit">Sign up</button> already a member?
        <a href="<?= base_url('login'); ?>" class="btn btn-success my-4" type="submit">Login</a>
        <!-- Social register -->
        <p>or sign up with:</p>

            <a href="#" class="mx-1" role="button"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="mx-1" role="button"><i class="fab fa-twitter"></i></a>
            <a href="#" class="mx-1" role="button"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" class="mx-1" role="button"><i class="fab fa-github"></i></a>

        <hr>

        <!-- Failure message if there is any. -->
        <?php if($failed = $this->session->flashdata('failed')): ?>
          <div class="alert alert-danger">
            <?php $failed; ?>
          </div>
        <?php else: echo "&copy; ".date('Y')." <span class='font-weight-bold text-success'>CHIP</span> Training & Consulting (Pvt.) Ltd."; endif; ?>
      </form>
      <!-- Default form register -->

    </div>
    <!--Grid column-->

  </div>
  <!--Grid row-->


</section>
<!--Section: Content-->


</div>