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
          <form action="<?php if(empty($edit)){ echo base_url('admin/item_save'); }else{ echo base_url('admin/modify_item'); } ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
            <div class="row">
              <div class="col-lg-6">   
            <select name="location" id="location" class="browser-default custom-select">
              <option value="" disabled selected>--select Location--</option>
              <?php if(!empty($locations)): foreach($locations as $loc): ?>
                <option value="<?= $loc->id; ?>"><?= $loc->name; ?></option>
              <?php endforeach; endif; ?>
            </select>
            <br><br>
            
            <select name="sub_category" id="item_name" class="browser-default custom-select">
              <option value="" disabled selected>--select item--</option>
            </select> 
            </select>
                <label>Model</label>
                <input type="text" name="model" class="form-control" placeholder="model" value="<?php if(!empty($edit)){ echo $edit->model; } ?>">
                <label>Supplier</label>
                <input type="text" name="supplier" class="form-control" placeholder="supplier" value="<?php if(!empty($edit)){ echo $edit->supplier; } ?>">
                <label>Depreciation</label>
                <input type="number" name="depreciation" class="form-control" placeholder="depreciation" value="<?php if(!empty($edit)){ echo $edit->depreciation; } ?>">  
              </div>
              <div class="col-lg-6">  
            <select name="category" id="category" class="browser-default custom-select">
              <option value="" disabled selected>--select category--</option>
              <?php if(!empty($categories)): foreach($categories as $cat): ?>
                <option value="<?= $cat->id; ?>" <?php if(!empty($edit) && $edit->id == $cat->id){ echo 'selected'; } ?>><?= $cat->cat_name; ?></option>
              <?php endforeach; endif; ?>
            </select>
                <label>Type Name</label>
                <input type="text" name="type_name" class="form-control" placeholder="type name" value="<?php if(!empty($edit)){ echo $edit->type_name; } ?>">
                <label>Serial Number</label>
                <input type="text" name="serial_number" class="form-control" placeholder="serial number" value="<?php if(!empty($edit)){ echo $edit->serial_number; } ?>">
                <label>Price</label>
                <input type="number" name="price" class="form-control" placeholder="price" value="<?php if(!empty($edit)){ echo $edit->price; } ?>">
                <label>Purchase Date</label>
                <input type="date" name="purchasedate" class="form-control" placeholder="purchase_date" value="<?php if(!empty($edit)){ echo $edit->purchasedate; } ?>">   
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
<script>
$(document).ready(function(){
 
 // City change
 $('#category').on('change', function(){
   var category = $(this).val(); 
   // AJAX request
   $.ajax({
     url:'<?=base_url('admin/get_item_sub_categories/')?>' + category,
     method: 'post',
     data: {category: category},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#item_name').find('option').not(':first').remove();

       // Add options
       $.each(response,function(index, data){
        $('#item_name').append('<option value="'+data['id']+'">'+data['name']+'</option>'); 
       });
     }
  });
});
});
</script>