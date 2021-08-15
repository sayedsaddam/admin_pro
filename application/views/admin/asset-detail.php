<?php 
/*
* Filename: add_items.php
* Author: Saddam
*/
?>
<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid">
    <div class="row">
     <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid">
      </div>
      <div class="col-lg-7 col-md-7">
        <h2 class="display-4 font-weight-bold mb-0">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-dark">AH Group of Companies (Pvt.) Ltd.</h3>
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
                <label>Category</label>
                <input type="text" name="category" class="form-control" placeholder="category" value="<?php if(!empty($edit)){ echo $edit->category; } ?>">
                <label>Quantity</label>
                <input type="text" name="quantity" class="form-control" placeholder="quantity" value="<?php if(!empty($edit)){ echo $edit->quantity; } ?>">
                <label>Purchase Date</label>
                <input type="date" name="purchase_date" class="form-control" placeholder="purchase_date" value="<?php if(!empty($edit)){ echo $edit->purchase_date; } ?>">
                <label>Location</label>
                <input type="text" name="location" class="form-control" placeholder="Location" value="<?php if(!empty($edit)){ echo $edit->location; } ?>"> 
                <label>Description</label>
                <textarea name="Descri[tion" class="form-control" placeholder="Description..."><?php if(!empty($edit)){ echo $edit->description; } ?></textarea>
              </div>
              <div class="col-lg-6">  
                <label>User</label>
                <input type="text" name="user" class="form-control" placeholder="User" value="<?php if(!empty($edit)){ echo $edit->user; } ?>">
                <label>Remarks</label>
                <input type="text" name="remarks" class="form-control" placeholder="remarks" value="<?php if(!empty($edit)){ echo $edit->remarks; } ?>">
                <label>GiveAway</label>
                <input type="text" name="giveaway" class="form-control" placeholder="Give Away" value="<?php if(!empty($edit)){ echo $edit->giveaway; } ?>"> 
                <label>Designation</label>
                <input type="text" name="designation" class="form-control" placeholder="designation" value="<?php if(!empty($edit)){ echo $edit->designation; } ?>">
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