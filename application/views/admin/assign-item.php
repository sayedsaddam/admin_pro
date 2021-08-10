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
            <div class="col-lg-2"> 
              <label for="">Detail message <span class="fa fa-arrow-down"></span></label> 
<p id="message" style="font-weight: bold"></p>
            </div>
              <div class="col-lg-5">  
                

               <!-- Select Location -->
               <label>Select Location</label>
            <select name="location" id="location" class="browser-default custom-select">
              <option value="" disabled selected>--select location--</option>
              <?php if(!empty($locations)): foreach($locations as $loc): ?>
                <option value="<?= $loc->id; ?>" <?php if(!empty($edit) && $edit->id == $loc->id){ echo 'selected'; } ?>><?= $loc->name; ?></option>
              <?php endforeach; endif; ?>
            </select>

               <!-- Select Category -->
               <label>Select Category</label>
            <select name="category" id="category" class="browser-default custom-select">
              <option value="" disabled selected>--select category--</option>
              <?php if(!empty($get_category)): foreach($get_category as $cat): ?>
                <option value="<?= $cat->id; ?>" <?php if(!empty($edit) && $edit->id == $loc->id){ echo 'selected'; } ?>><?= $cat->cat_name; ?></option>
              <?php endforeach; endif; ?>
            </select>
            

            
          <!-- <label>Item status</label> -->                 
             <label for="">Item Type</label>
             <select name="item_type" id="item_type" class="browser-default custom-select">
             <option value="" disabled selected>--select item type--</option>
             </select>

             <!-- <label>Item status</label> -->                 
             <label for="">Item Status</label>
                <select name="item_status" id="item_status" class="browser-default custom-select">
                  <option value="" disabled selected>--Item Status--</option>  
                  <option value="new">New</option>
                  <option value="used">Used</option>
                  <option value="Reforbished">Reforbished</option> 
                </select>  
         
              </div>
              <div class="col-lg-5">
                <!-- <label>Assign By</label> -->
                <input type="hidden" name="assign_by" class="form-control" placeholder="assign_by " value="<?php echo $this->session->userdata('id');  ?>">
                
                 
              <lsbel>Assign To</label>
                <select name="employ" id="employ" class="browser-default custom-select">
              <option value="" disabled selected>--select employee--</option>
            </select> 


            
            <!-- <label for="">Select Item</label>
            <select name="item_id" id="item_id" class="browser-default custom-select">
              <option value="" disabled selected>--select Item--</option>
              <?php if(!empty($get_item)): foreach($get_item as $cat): ?>
                <option value="<?= $cat->id; ?>" <?php if(!empty($edit) && $edit->id == $cat->id){ echo 'selected'; } ?>><?= $cat->name; ?></option>
              <?php endforeach; endif; ?>
            </select>  -->
            

            <lsbel>Select Item</label>
                <select name="item_id" id="item_id" class="browser-default custom-select item_ids">
              <option value="" disabled selected>--select item--</option>
            </select> 

               <!-- ------ item model get on base of item type ------ -->
               <label for="">Item Model</label>
             <select name="item_model" id="item_model" class="browser-default custom-select">
             <option value="" disabled selected>--select item model--</option>
             </select> 

     
  
             <!-- item description -->
             <label>Description</label>
                <textarea name="description" id="description" cols="64" rows="2" class="form-control"></textarea>
             
                 
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

<script>
$(document).ready(function(){
 
 // City change
 $('#location').on('change', function(){
   var location = $(this).val(); 
   // AJAX request
   $.ajax({
     url:'<?=base_url('admin/get_location_employ/')?>' + location,
     method: 'post',
     data: {location: location},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#employ').find('option').not(':first').remove();

       // Add options
       $.each(response,function(index, data){
        $('#employ').append('<option value="'+data['id']+'">'+data['fullname']+'</option>'); 
       });
     }
  });
});
});

// item type auto load against item
$(document).ready(function(){
 // City change
 $('#item_id').on('change', function(){
   var item_id = $(this).val();   
   // AJAX request
   $.ajax({
     url:'<?=base_url('admin/get_item_type/')?>' + item_id,
     method: 'post',
     data: {item_id: item_id},
     dataType: 'json',
     success: function(response){
      console.log(response[0].quantity); 
       // Remove options 
       $('#item_type').find('option').not(':first').remove();
       // Add options
       $.each(response,function(index, data){ 
        $('#item_type').append('<option value="'+data['id']+'">'+data['type_name']+' ('+data['quantity']+')'+'</option>'); 
       });
     }
  });
});
});


// load item model against item type
$(document).ready(function(){
 // City change
 $('#item_type').on('change', function(){
   var item_type = $(this).val();   
   // AJAX request
   $.ajax({
     url:'<?=base_url('admin/get_item_model/')?>' + item_type,
     method: 'post',
     data: {item_type: item_type},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#item_model').find('option').not(':first').remove();
       // Add options
       $.each(response,function(index, data){
        if (data['quantity'] == '0') {
          var res = "OOPS! We are sorry your item "+response[0].type_name+" <span style='color: blue'> ( "+response[0].model+" )</span> quantity  <span style='color: red'> is not available </span>  select the another one";  
          $('#message').append(res); 
             return true  
        }
        $('#item_model').append('<option value="'+data['id']+'">'+data['model']+'</option>');
       });
     }
  });
});
});


// get category
$(document).ready(function(){
 // City change
 $('#category').on('change', function(){
   var category = $(this).val(); 
   // AJAX request
   $.ajax({
     url:'<?=base_url('admin/get_assign_category/')?>' + category,
     method: 'post',
     data: {category: category},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#item_id').find('option').not(':first').remove();

       // Add options
       $.each(response,function(index, data){
        $('#item_id').append('<option value="'+data['id']+'">'+data['name']+'</option>'); 
       });
     }
  });
});
});

</script>