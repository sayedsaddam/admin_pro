<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <h2 class="display-4 font-weight-bold">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <a href="#0" class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></a>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i><span class="font-weight-light"><br>Profile</span> | <a href="<?=base_url('users');?>" class="text-light">Home</a></h4>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header blue-gradient text-light">
                    <h5 class="card-title">Personal Info</h5>
                </div>
                <div class="card-body">
                    <ul>
                        <li><?= $profile->fullname; ?></li>
                        <li><?= $profile->email; ?></li>
                        <li><?= $profile->username; ?></li>
                        <li><?= ucfirst($profile->department); ?></li>
                        <li><?= ucfirst($profile->name); ?></li>
                        <li><?= ucfirst($profile->user_role); ?></li>
                        <li><?= ucfirst($profile->designation); ?></li>
                        <li><?= ucfirst($profile->project_name); ?></li>
                        <li><?= ucfirst($profile->gender); ?></li>
                        <li><?= $profile->cnic; ?></li>
                        <li><?= $profile->personal_contact; ?></li>
                        <li><?= $profile->official_contact; ?></li>
                        <li><?= $profile->address; ?></li>
                        <li><?= date('M d, Y', strtotime($profile->dob)); ?></li>
                        <li><?= date('M d, Y', strtotime($profile->doj)); ?></li>
                        <li><?= date('M d, Y', strtotime($profile->created_at)); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header blue-gradient text-light">
                    <h5 class="card-title">Update Profile</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="text" name="fullname" id="materialLoginFormName" class="form-control">
                                    <label for="materialLoginFormName">Full Name</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="email" name="email" id="materialLoginFormEmail" class="form-control">
                                    <label for="materialLoginFormEmail">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="text" name="username" id="materialLoginFormUsername" class="form-control">
                                    <label for="materialLoginFormUsername">Userame</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="text" name="email" id="materialLoginFormDept" class="form-control">
                                    <label for="materialLoginFormDept">Department</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
