<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid">
      </div>
      <div class="col-lg-7 col-md-7">
        <h1 class="display-4 font-weight-bold mb-0">Admin & Procurement <?php if($this->session->userdata('user_role') == 'supervisor'): ?>|<a href="<?= base_url('supervisor'); ?>" class="btn btn-outline-light btn-sm">Supervisor board</a><?php endif; ?></h1>
        <h2 class="font-weight-bold text-light">AH Group of Companies (Pvt.) Ltd.</h2>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i><span class="font-weight-light"><br>User Profile</span> | <a href="<?= base_url('users'); ?>" class="text-light">Home</a></h4>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
    <?php if($success = $this->session->flashdata('success')): ?>
    <div class="row">
        <div class="col-11">
            <div class="alert alert-success"><?= $success; ?></div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card testimonial-card">
            <div class="card-up morpheus-den-gradient lighten-1"></div>
                <div class="avatar mx-auto white">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20%2810%29.jpg" class="rounded-circle"
                    alt="profile avatar">
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?= $profile->fullname; ?></h4>
                    <hr>
                    <div class="row">
                        <div class="col-4 text-left">
                            <p>Email</p>
                        </div>
                        <div class="col-6 text-left">
                            <p></i> <?= $profile->email; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-left">
                            <p>Username</p>
                        </div>
                        <div class="col-6 text-left">
                            <p></i> <?= $profile->username; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-left">
                            <p>Department</p>
                        </div>
                        <div class="col-6 text-left">
                            <p></i> <?= ucfirst($profile->department); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-left">
                            <p>Role</p>
                        </div>
                        <div class="col-6 text-left">
                            <p></i> <?= ucfirst($profile->user_role); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-left">
                            <p>Registered on</p>
                        </div>
                        <div class="col-8 text-left">
                            <p></i> <?= date('M d, Y', strtotime($profile->created_at)).' at '. date('h:m:i A', strtotime($profile->created_at)); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <h5 class="card-header morpheus-den-gradient white-text text-center py-4">
                    <strong>Update Profile</strong>
                </h5>
                <div class="card-body px-lg-5 pt-0">
                    <form class="mt-2 mb-2" style="color: #757575;" action="<?= base_url('users/update_profile'); ?>" method="post">
                        <input type="hidden" name="user_id" value="<?= $profile->id; ?>">
                        <div class="form-row">
                            <div class="col">
                                <div class="md-form">
                                    <input name="fullname" type="text" id="materialRegisterFormFirstName" class="form-control" required>
                                    <label for="materialRegisterFormFirstName">Full Name</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form">
                                    <input name="username" type="text" id="materialRegisterFormLastName" class="form-control" required>
                                    <label for="materialRegisterFormLastName">Username</label>
                                </div>
                            </div>
                        </div>
                        <div class="md-form mt-0">
                            <input name="email" type="email" id="materialRegisterFormEmail" class="form-control" required>
                            <label for="materialRegisterFormEmail">Email</label>
                        </div>
                        <div class="md-form mb-5">
                            <input name="password" type="password" id="materialRegisterFormPassword" class="form-control" required>
                            <label for="materialRegisterFormPassword">Password</label>
                            <small class="deep-orange-text">Enter your existing password if you're not updating your password.</small>
                        </div>
                        <button class="btn btn-outline-success my-4 waves-effect z-depth-0" type="submit">Update</button>
                        <a href="javascript:history.go(-1)" class="btn btn-outline-orange my-4 waves-effect z-deprth-0">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4 text-right mb-2">
            <small>Copyright &copy; <?= '2019 - '.date('Y'); ?> <span class="purple-text">AH Group of Companies (Pvt.) Ltd.</span></small>
        </div>
    </div>
</div>
