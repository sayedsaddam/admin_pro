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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Asset Detail | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>

<section class="secMainWidth container mt-4 mb-4">
  <section class="secFormLayout">
    <div class="mainInputBg">
      <div class="row">
        <div class="col-lg-12">
          <h3><?php if(empty($edit)){ echo "Add Item"; }else{ echo "Update Item"; } ?></h3><hr>
          <?php if($success = $this->session->flashdata('success')): ?>
            <div class="alert alert-success text-center">
              <?php echo $success; ?>
            </div>
          <?php endif; ?>
          <form action="<?php if(empty($edit)){ echo base_url('admin/save_item'); }else{ echo base_url('admin/update_item'); } ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
            <div class="row">
              <div class="col-lg-6">
                <label>Year</label>
                <input type="text" name="year" class="form-control" placeholder="Year" value="<?php if(!empty($edit)){ echo $edit->year; } ?>">
                <label>Project</label>
                <input type="text" name="project" class="form-control" placeholder="Project" value="<?php if(!empty($edit)){ echo $edit->project; } ?>">
                <label>Category</label>
                <input type="text" name="category" class="form-control" placeholder="Category" value="<?php if(!empty($edit)){ echo $edit->category; } ?>">
                <label>Item</label>
                <input type="text" name="item" class="form-control" placeholder="Item" value="<?php if(!empty($edit)){ echo $edit->item; } ?>">
                <label>Description</label>
                <textarea name="description" class="form-control" placeholder="Desctiption..."><?php if(!empty($edit)){ echo $edit->description; } ?></textarea>
                <label>Model</label>
                <input type="text" name="model" class="form-control" placeholder="Model" value="<?php if(!empty($edit)){ echo $edit->model; } ?>">
                <label>Asset Code</label>
                <input type="text" name="asset_code" class="form-control" placeholder="Asset Code" value="<?php if(!empty($edit)){ echo $edit->asset_code; } ?>">
                <label>P.O No.</label>
                <input type="text" name="po_no" class="form-control" placeholder="P.O Number" value="<?php if(!empty($edit)){ echo $edit->po_no; } ?>">
                <label>Contact</label>
                <input type="text" name="contact" class="form-control" placeholder="Contact" value="<?php if(!empty($edit)){ echo $edit->contact; } ?>">
              </div>
              <div class="col-lg-6">
                <label>Serial Number</label>
                <input type="text" name="serial_no" class="form-control" placeholder="Serial Number" value="<?php if(!empty($edit)){ echo $edit->serial_number; } ?>">
                <label>Custodian</label>
                <input type="text" name="custodian" class="form-control" placeholder="Custodian" value="<?php if(!empty($edit)){ echo $edit->custodian_location; } ?>">
                <label>Designation</label>
                <input type="text" name="designation" class="form-control" placeholder="Designation" value="<?php if(!empty($edit)){ echo $edit->designation; } ?>">
                <label>Department</label>
                <input type="text" name="department" class="form-control" placeholder="Department" value="<?php if(!empty($edit)){ echo $edit->department; } ?>">
                <label>Quantity</label>
                <input type="text" name="quantity" class="form-control" placeholder="Quantity" value="<?php if(!empty($edit)){ echo $edit->quantity; } ?>">
                <label>District/Region</label>
                <input type="text" name="district" class="form-control" placeholder="District" value="<?php if(!empty($edit)){ echo $edit->district_region; } ?>">
                <label>Status</label>
                <textarea name="status" class="form-control" placeholder="Status..."><?php if(!empty($edit)){ echo $edit->status; } ?></textarea>
                <label>Receiving Date</label>
                <input type="<?php if(!empty($edit)){ echo 'text'; }else{ echo 'date'; } ?>" name="receive_date" class="form-control" placeholder="Receiving Date" value="<?php if(!empty($edit)){ echo $edit->receive_date; } ?>">
                <label>Purchasing Date</label>
                <input type="<?php if(!empty($edit)){ echo 'text'; }else{ echo 'date'; } ?>" name="purchase_date" class="form-control" placeholder="Purchasing Date" value="<?php if(!empty($edit)){ echo $edit->purchase_date; } ?>">
              </div>
            </div><br>
            <div class="row">
              <div class="col-lg-12 text-right">
                <a href="javascript:history.go(-1);" class="btn btn-default">Back</a>
                <?php if(empty($edit)): ?>
                  <button type="submit" class="btn btn-default">Add Item</button>
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