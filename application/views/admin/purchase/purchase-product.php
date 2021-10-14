<?php 
/*
* Filename: add_items.php
* Author: Saddam
*/
?>
<style>
	#demo {
		height: 50px;
	}

</style>
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
				<a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold"
					title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
				<h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span
						class="font-weight-light orange-text">Asset Detail | <a href="<?=base_url('admin');?>"
							class="text-light font-weight-bold">Home</a></span></h4>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12 col-md-12 text-right">
	<a href="<?= base_url('admin/suppliers'); ?>" data-target="#add_supplier" class="btn btn-outline-info"><i
			class="fa fa-plus"></i> Add Supplier </a>
	<a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
</div>

<section class="secMainWidth container mt-4 mb-4">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<h3><?php if(empty($edit)){ echo "Purchase Product"; }else{ echo "Update purchase"; } ?></h3>
					<hr>
					<?php if($success = $this->session->flashdata('success')): ?>
					<div class="alert alert-success text-center">
						<?php echo $success; ?>
					</div>
					<?php endif; ?>
					<form action="<?php if(empty($edit)){ echo base_url('Purchase/purchase_order_save'); }else{ echo base_url('admin/modify_purchase_order'); } ?>"
						method="post">
						<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
						<div class="row">
							<div class="col-lg-6">
								<label>Location</label>
								<select name="location" id="location" class="browser-default custom-select" required>
									<option value="" disabled selected>--select Location--</option>
									<?php if(!empty($locations)): foreach($locations as $loc): ?>
									<option value="<?= $loc->id; ?>"
										<?php if(!empty($edit) && $edit->location_id == $loc->id){ echo 'selected'; } ?>>
										<?= $loc->name; ?></option>
									<?php endforeach; endif; ?>
								</select>

								<label>Quantity</label>
								<input type="number" name="quantity[]" class="form-control" placeholder="quantity ..."
									value="">
							</div>
							<div class="col-lg-5">
								<label>Product</label>
						<input type="text" name="product_name[]" class="form-control" placeholder="product ..." value="">
						<label>Remarks</label> 
						<textarea name="description" id="description" cols="20" rows="1" class="form-control">description ...</textarea>
							</div>
						<div class="col-sm-1"> 
							<br>
							<label class="btn btn-primary btn-sm add_field_button">+</label>
						</div>
						</div>


						<div class="row input_fields_wrap">
							<div class="col-sm-5">
								
							</div>
						
						</div>
				</div><br>
				<div class="row">
					<div class="col-sm-12">
						<button type="submit" class="btn btn-default" id="submit-data"
							data-loading-text="Creating...">Generate Order</button>
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
     url:'<?=base_url('Purchase/get_location_suplier/')?>' + location,
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
        $('#supplier').append("<option value="+data['id']+'/'+data['email']+">"+data['name']+"</option>");  
       });
     }
  });
});
}); 

	$(document).ready(function () {
		var max_fields = 10; //maximum input boxes allowed
		var wrapper = $(".input_fields_wrap"); //Fields wrapper
		var add_button = $(".add_field_button"); //Add button ID
		var x = 1; //initlal text box count
		$(add_button).click(function (e) { //on add input button click
			e.preventDefault();
			if (x < max_fields) { //max input box allowed
				x++; //text box increment
				$(wrapper).append(`
            <div class="col-sm-12 d-flex remove-product">
      <div class="col-sm-6 mt-3 pl-0">
        <input type="text" name="product_name[]" class="form-control w-100" placeholder="product . . ." />
        </div>   
        <div class="col-sm-6 mt-3  d-flex justify-content-between pr-0">
          <input type="text" class="form-control w-100 col-sm-10"  placeholder="quantity . . ." name="quantity[]"/>
          <a href="#" class="remove_field btn btn-sm btn-danger col-sm-1 inline-block ml-auto">-</a>
        </div>
        </div>
     `);
			}
		});
		$(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
			e.preventDefault();
			$(this).parent().parent().remove();
			x--;
			console.log();
		})
	});


	$('input').bind('input', function () {
		var c = this.selectionStart,
			r = /[^a-z0-9 .]/gi,
			v = $(this).val();
		if (r.test(v)) {
			$(this).val(v.replace(r, ''));
			c--;
		}
		this.setSelectionRange(c, c);
	});

	$("#add_supplier").hide();
	$('.suppliers').click(function () {
		$("#add_supplier").show();
	});

</script>
