<?php 
/*
* Filename: add_items.php
* Author: Saddam
*/
?>
<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light" style="">
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
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in...">
          <?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Asset Detail | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12 text-right">   
        <a href="<?= base_url('admin/suppliers'); ?>" data-target="#add_supplier" class="btn btn-outline-info"><i class="fa fa-plus"></i> Add Supplier </a>
            <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
          </div>

<section class="secMainWidth container mt-4 mb-4">
  <section class="secFormLayout">
    <div class="mainInputBg">
      <div class="row">
        <div class="col-lg-12">
          <h3><?php if(empty($edit)){ echo "Purchase Product"; }else{ echo "Update purchase"; } ?></h3><hr>
          <?php if($success = $this->session->flashdata('success')): ?>
            <div class="alert alert-success text-center">
              <?php echo $success; ?>
            </div>
          <?php endif; ?>
          <form action="<?php if(empty($edit)){ echo base_url('admin/purchase_order_save'); }else{ echo base_url('admin/modify_purchase_order'); } ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
            <div class="row">
              <div class="col-lg-6">    

            <select name="location" id="location" class="browser-default custom-select" required>
            <option value="" disabled selected>--select Location--</option>
              <?php if(!empty($locations)): foreach($locations as $loc): ?>
                <option value="<?= $loc->id.'/'.$loc->name; ?>" <?php if(!empty($edit) && $edit->location_id == $loc->id){ echo 'selected'; } ?>><?= $loc->name; ?></option>
              <?php endforeach; endif; ?>
            </select>  
            <br> 
            <!-- <select name="category" id="category" class="browser-default custom-select">
              <option value="" disabled selected>--select category--</option>
              <?php if(!empty($categories)): foreach($categories as $cat): ?>
                <option value="<?= $cat->id; ?>" <?php if(!empty($edit) && $edit->purchase_id == $cat->id){ echo 'selected'; } ?>><?= $cat->cat_name; ?></option>
              <?php endforeach; endif; ?>
            </select>   -->

                <label>Product Name</label>
                <input type="text" name="product_name" class="form-control" placeholder="product name  ..." value="<?php if(!empty($edit)){ echo $edit->order_number; } ?>"> 
 
              </div>
              <div class="col-lg-6">   

                <input type="hidden" name="email" id="email" value="" >

            <select name="supplier" id="supplier" class="browser-default custom-select">
              <option value="" disabled selected>--select Suplier--</option>
              <!-- <?php if(!empty($supplier)): foreach($supplier as $sup): ?>
                <option value="<?= $sup->id; ?>" <?php if(!empty($edit) && $edit->supplier_id == $sup->id){ echo 'selected'; } ?>><?= $sup->name; ?></option>
              <?php endforeach; endif; ?> -->
            </select>  

                <!-- <label>Type Name</label>  
                <input type="text" name="type_name" class="form-control" required placeholder="plz enter type...">
                 -->     
            <!-- <label for="">Sub Category <small>(optional)</small></label>
             <select name="sub_category" id="item_name" class="browser-default custom-select">
             <option value="" disabled selected>--select sub category--</option>
             </select>  -->
              

             <label>Order Number</label>
                <input type="text" name="order_number" class="form-control" placeholder="order number ..." value="<?php if(!empty($edit)){ echo $edit->order_number; } ?>"> 
 
              </div>
            </div><br>
             <div class="row">
<div class="col-sm-12" > 
    <button type="submit" class="btn btn-default" id="submit-data" data-loading-text="Creating...">Generate Order</button>
 
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>  
    </div>
  </section>
</section>
<script>

// item type auto load against item
$(document).ready(function(){
 // City change
 $('#location').on('change', function(){
   var location = $(this).val();  
   // AJAX request
   $.ajax({
     url:'<?=base_url('admin/get_location_suplier/')?>' + location,
     method: 'post',
     data: {location: location},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#supplier').find('option').not(':first').remove();
       $('#email').find('option').not(':first').remove();

       // Add options
       $.each(response,function(index, data){
        $('#supplier').append('<option value="'+data['id']+'">'+data['name']+'</option>'); 
        $('#email').append('<option value="'+data['id']+'">'+data['email']+'</option>'); 
       });
     }
  });
});
}); 

// supplier email load against supplier
$(document).ready(function(){
 // City change
 $('#supplier').on('change', function(){
   var supplier = $(this).val();   
   // AJAX request
   $.ajax({
     url:'<?=base_url('admin/get_suplier_email/')?>' + supplier,
     method: 'post',
     data: {supplier: supplier},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#email').find('option').not(':first').remove(); 
       // Add options
       $.each(response,function(index, data){  

        $('#email').val(data['email']); 
       });
     }
  });
});
}); 
</script>