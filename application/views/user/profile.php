<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <h2 class="display-4 font-weight-bold">HRM</h2>
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
        <div class="col-md-3 col-lg-3 col-sm-12">
            <div class="card">
                <div class="card-header blue-gradient text-light">
                    <h5 class="card-title">Personal Info</h5>
                </div>
                <div class="card-body">
                    <p>Name: <strong><?= $profile->fullname; ?></strong></p>
                    <p>Email: <strong><?= $profile->email; ?></strong></p>
                    <p>Username: <strong><?= $profile->username; ?></strong></p>
                    <p>Dept: <strong><?= ucfirst($profile->department); ?></strong></p>
                    <p>Location: <strong><?= ucfirst($profile->name); ?></strong></p>
                    <p>Role: <strong><?= ucfirst($profile->user_role); ?></strong></p>
                    <p>Designation: <strong><?= ucfirst($profile->designation); ?></strong></p>
                    <p>Project: <strong><?= ucfirst($profile->project_name); ?></strong></p>
                    <p>Gender: <strong><?= ucfirst($profile->gender); ?></strong></p>
                    <p>CNIC: <strong><?= $profile->cnic; ?></strong></p>
                    <p>Contact: <strong><?= $profile->personal_contact; ?></strong></p>
                    <p>Contact (Office): <strong><?= $profile->official_contact; ?></strong></p>
                    <p>Birthday: <strong><?= date('M d, Y', strtotime($profile->dob)); ?></strong></p>
                    <p>Joining Date: <strong><?= date('M d, Y', strtotime($profile->doj)); ?></strong></p>
                    <p>Registered: <strong><?= date('M d, Y', strtotime($profile->created_at)); ?></strong></p>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-lg-9 col-sm-12">
            <div class="card mb-5">
                <div class="card-header blue-gradient text-light">
                    <h5 class="card-title">Update Profile</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('users/update_profile'); ?>" method="post">
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
                                    <input type="text" name="department" id="materialLoginFormDept" class="form-control">
                                    <label for="materialLoginFormDept">Department</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="md-form">
                                    <select name="location" id="defaultRegisterFormLocation" class="browser-default custom-select mb-4" required>
                                        <option value="" disabled selected>Location</option>
                                        <?php foreach($locations as $loc): ?>
                                        <option value="<?= $loc->id; ?>" <?php if(!empty($edit) && $edit->location == $loc->id){ echo 'selected'; } ?>><?= $loc->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="text" name="designation" id="materialLoginFormDept" class="form-control">
                                    <label for="materialLoginFormDept">Designation</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="text" name="province" id="materialLoginFormUsername" class="form-control">
                                    <label for="materialLoginFormUsername">Province</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="md-form">
                                    <select name="gender" id="defaultRegisterFormLocation" class="browser-default custom-select mb-4" required>
                                        <option value="" disabled selected>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="text" name="cnic" id="materialLoginFormUsername" class="form-control">
                                    <label for="materialLoginFormUsername">CNIC</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="text" name="personal_contact" id="materialLoginFormDept" class="form-control">
                                    <label for="materialLoginFormDept">Personal Contact</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="text" name="official_contact" id="materialLoginFormUsername" class="form-control">
                                    <label for="materialLoginFormUsername">Official Contact</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="text" name="grader" id="materialLoginFormDept" class="form-control">
                                    <label for="materialLoginFormDept">Grader</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="date" name="dob" id="materialLoginFormUsername" class="form-control">
                                    <label for="materialLoginFormUsername">Date of Birth</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="md-form">
                                    <input type="date" name="doj" id="materialLoginFormDept" class="form-control">
                                    <label for="materialLoginFormDept">Date of Joining</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="md-form">
                                <textarea name="address" id="materialContactFormAddress" class="form-control md-textarea" rows="3"></textarea>
                                <label for="materialContactFormAddress">Address</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-info btn-block">Update Profile</button>
                            </div>
                            <div class="col-6">
                                <button type="reset" class="btn btn-orange btn-block">clear form</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
