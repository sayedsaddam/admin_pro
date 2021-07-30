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
          <h3><?php if(empty($edit)){ echo "Assign Item"; }else{ echo "Update Item"; } ?></h3><hr>
          <?php if($success = $this->session->flashdata('success')): ?>
            <div class="alert alert-success text-center">
              <?php echo $success; ?>
            </div>
          <?php endif; ?>
          <form action="<?php if(empty($edit)){ echo base_url('admin/assign_item_save'); }else{ echo base_url('admin/modify_item'); } ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
            <div class="row">
              <div class="col-lg-6">   
                  <label>Assign To</label>
            <select name="assign_to" id="assign_to" class="browser-default custom-select">
              <option value="" disabled selected>--Select--</option>
              <?php if(!empty($assign_to)): foreach($assign_to as $assign): ?>
                <option value="<?= $assign->id; ?>"><?= $assign->fullname; ?></option>
              <?php endforeach; endif; ?>
            </select>
            <label>Description</label>
                <textarea name="description" id="description" cols="64" rows="2" class="form-control"></textarea>   
              </div>
              <div class="col-lg-6">
                <!-- <label>Assign By</label> -->
                <input type="hidden" name="assign_by" class="form-control" placeholder="assign_by " value="<?php echo $this->session->userdata('id');  ?>">
                
            <label for="">Select Item</label>
            <select name="item_id" id="item_id" class="browser-default custom-select">
              <option value="" disabled selected>--select Item--</option>
              <?php if(!empty($get_item)): foreach($get_item as $cat): ?>
                <option value="<?= $cat->id; ?>" <?php if(!empty($edit) && $edit->id == $cat->id){ echo 'selected'; } ?>><?= $cat->name; ?></option>
              <?php endforeach; endif; ?>
            </select>   
              </div>
            </div><br>
            <div class="row">
              <div class="col-lg-12 text-right">
                <a href="javascript:history.go(-1);" class="btn btn-danger">Back</a>
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