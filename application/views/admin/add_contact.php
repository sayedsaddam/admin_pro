<?php 
/*
* Filename: add_items.php
* Author: Saddam
*/
?>
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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text"><?php if(empty($edit)){ echo 'Add Contact'; }else{ echo 'Edit Contact'; } ?> | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>

<section class="secMainWidth container mt-4 mb-4">
  <section class="secFormLayout">
    <div class="mainInputBg">
      <div class="row">
        <div class="col-lg-12">
          <h3><?php if(empty($edit)){ echo "Add Contact"; }else{ echo "Update Contact"; } ?></h3><hr>
          <?php if($success = $this->session->flashdata('success')): ?>
            <div class="alert alert-success text-center">
              <?php echo $success; ?>
            </div>
          <?php endif; ?>
          <form action="<?php if(empty($edit)){ echo base_url('admin/save_contact'); }else{ echo base_url('admin/update_contact'); } ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name..." value="<?php if(!empty($edit)){ echo $edit->name; } ?>">
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" name="designation" class="form-control" placeholder="Designation..." value="<?php if(!empty($edit)){ echo $edit->designation; } ?>">
                    </div>
                    <div class="form-group">
                        <label>Project</label>
                        <input type="text" name="project" class="form-control" placeholder="Project..." value="<?php if(!empty($edit)){ echo $edit->project; } ?>">
                    </div>
                    <div class="form-group">
                        <label>District</label>
                        <input type="text" name="district" class="form-control" placeholder="District..." value="<?php if(!empty($edit)){ echo $edit->district; } ?>">
                    </div>
                    <div class="form-group">
                        <label>Province</label>
                        <input type="text" name="province" class="form-control" placeholder="Province..." value="<?php if(!empty($edit)){ echo $edit->province; } ?>">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="" disabled selected>-- Select Gender --</option>
                            <option value="Male" <?php if(!empty($edit) AND $edit->gender == 'Male'){ echo 'selected'; } ?>>Male</option>
                            <option value="Female" <?php if(!empty($edit) AND $edit->gender == 'Female'){ echo 'selected'; } ?>>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>CNIC</label>
                        <input type="text" name="cnic" class="form-control" placeholder="CNIC..." value="<?php if(!empty($edit)){ echo $edit->cnic; } ?>"> 
                    </div>
                    <div class="form-group">
                        <label>Personal Contact</label>
                        <input type="text" name="personal_contact" class="form-control" placeholder="Personal Contact..." value="<?php if(!empty($edit)){ echo $edit->personal_contact; } ?>">
                    </div>
                    <div class="form-group">
                        <label>Official Contact</label>
                        <input type="text" name="official_contact" class="form-control" placeholder="Offical Contact..." value="<?php if(!empty($edit)){ echo $edit->official_contact; } ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email..." value="<?php if(!empty($edit)){ echo $edit->email; } ?>"> 
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Address..."><?php if(!empty($edit)){ echo $edit->address; } ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Grader</label>
                        <input type="text" name="grader" class="form-control" placeholder="Grader..." value="<?php if(!empty($edit)){ echo $edit->grader; } ?>">
                    </div>
                    <div class="form-group">
                        <label>Supervisor</label>
                        <input type="text" name="supervisor" class="form-control" placeholder="Supervisor..." value="<?php if(!empty($edit)){ echo $edit->supervisor; } ?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" placeholder="DoB" value="<?php if(!empty($edit)){ echo $edit->dob; } ?>">
                    </div>
                    <div class="form-group">
                    <label>Date of Joining</label>
                        <input type="date" name="doj" class="form-control" placeholder="DoJ" value="<?php if(!empty($edit)){ echo $edit->doj; } ?>"> 
                    </div>
                </div>
            </div><br>
            <div class="row">
              <div class="col-lg-12 text-right">
                <a href="javascript:history.go(-1);" class="btn btn-default">Back</a>
                <?php if(empty($edit)): ?>
                  <button type="submit" class="btn btn-default">Add Contact</button>
                <?php else: ?>
                  <button type="submit" class="btn btn-default">Save Changes</button>
                <?php endif; ?>
              </div>
            </div>
          </form>
        </div>
      </div>  
    </div>
  </section>
</section>