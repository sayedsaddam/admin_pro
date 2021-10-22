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
 
<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight" style="background-color:#fafafa;">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section">
				<div class="columns">
					<div class="column">
						<form action="">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search" placeholder="Search Query">
									<span class="icon is-small is-left">
										<i class="fas fa-search"></i>
									</span>
								</div>
								<div class="control">
									<button class="button is-small" type="submit"><span class="icon is-small">
											<i class="fas fa-arrow-right"></i>
										</span>
									</button>
								</div>
							</div>
						</form>
					</div>
					<div class="column is-hidden-touch is-narrow">
						<div class="field has-addons">  
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/suppliers'); ?>'"
									class="button is-small <?= isset($add_page) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add Supplier</span>
								</button>
							</p>
						</div>
					</div>
				</div>
				<div class="columns">	
					<div class="column">
						<h1 class="subtitle is-5">Purchase Product</h1>
					</div> 
				</div>
				<form	action="<?php if(empty($edit)){ echo base_url('Purchase/purchase_order_save'); }else{ echo base_url('admin/modify_purchase_order'); } ?>"
					method="POST">
					<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Location <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="location" id="location" required>
											<option value="" disabled selected>--select Location--</option>
									<?php if(!empty($locations)): foreach($locations as $loc): ?>
									<option value="<?= $loc->id; ?>"
										<?php if(!empty($edit) && $edit->location_id == $loc->id){ echo 'selected'; } ?>>
										<?= $loc->name; ?></option>
									<?php endforeach; endif; ?>
											</select>
										</span>
										<span class="icon is-small is-left">
											<i class="fas fa-globe"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>


						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Category <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="category" id="category" required>
												<?php if(!isset($edit_item)): ?>
												<option selected disabled value="">Select a Category</option>
												<?php endif ?>
												<?php if(!empty($categories)): foreach($categories as $cat): ?>
												<option value="<?= $cat->id; ?>"
													<?= !empty($edit) && $edit->id == $cat->id ? 'selected' : '' ?>><?= ucwords($cat->cat_name); ?>
												</option>
												<?php endforeach; endif; ?>
											</select>
										</span>
										<span class="icon is-small is-left">
											<i class="fas fa-tags"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div> 
					</div>
					<div class="columns">

					<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Product <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="product_name[]" class="item_name" required> 
												<option selected disabled value="">Select an Product</option> 
											</select>
										</span>
										<span class="icon is-small is-left">
											<i class="fas fa-luggage-cart"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>

						<div class="column">
						<fieldset>
								<div class="field">
									<label class="label is-small">Quantity <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
									<input type="number" name="quantity[]" class="input is-small" value="" type="text" placeholder=" 1 2 3 ..." required="">
										<span class="icon is-small is-left">
											<i class="fas fa-sort-amount-up"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>

						<div class="column is-narrow">  
							<fieldset>
								<div class="field">  
									<br>
						<button class="button is-small is-success add_field_button">+</button>
								</div>
							</fieldset> 
						</div>
					</div>  
<!-- description row below
					<div class="columns">
					<div class="column">  
							<fieldset>
								<div class="field">
									<label class="label is-small">Description</label>
									<div class="control has-icons-left">
									<input type="text" name="description" id="description" class="input is-small" value="" type="text" placeholder="some detail . . ." required="">
									</div>
								</div>
							</fieldset> 
						</div>
					</div>
description above					 -->
					<div class="input_fields_wrap"> 
					</div>

					<div class="columns">
						<div class="column has-text-right">
							<div class="buttons is-pulled-right">
								<?php if(!isset($edit_item)): ?>
								<button class="button is-danger is-small is-outlined" type="reset">Reset Form</button>
								<?php endif ?>
								<p class="control">
									<button class="button is-small is-success" type="submit" id="submit-data">
										<span><?= !isset($edit_item) ? 'Generate Order' : 'Save Changes' ?></span>
										<span class="icon is-small">
											<i class="fas fa-arrow-right"></i>
										</span>
									</button>
								</p>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
 
	</div>
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

// category change
$('#category').on('change', function () {
	var category = $(this).val();  
	// AJAX request
	$.ajax({
		url: '<?= base_url("admin/get_item_sub_categories/"); ?>' + category,
		method: 'POST',
		data: {
			category: category
		},
		dataType: 'json',
		success: function (response) {
			// Remove options 
			$('.item_name').find('option').not(':first').remove();

			// Add options
			$.each(response, function (index, data) {
				$('.item_name').append('<option value="' + data['id'] + '">' + data['name'] + '</option>');
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
				<div class="columns">
						<div class="column">
						<fieldset>
								<div class="field">
									<label class="label is-small">Product <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="product_name[]" class="item_name" required> 
												<option selected disabled value="">Select an Product</option> 
											</select>
										</span>
										<span class="icon is-small is-left">
											<i class="fas fa-luggage-cart"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Quantity <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
									<input type="number" name="quantity[]" class="input is-small" value="" type="text" placeholder=" 1 2 3 ..." required="">
										<span class="icon is-small is-left">
											<i class="fas fa-sort-numeric-up"></i>
										</span>
									</div>
								</div>
							</fieldset>  
							</div> 

							<div class="column is-narrow">
							<fieldset>
								<div class="field">
								<br>
								<a href="#" class="remove_field button is-small is-danger">-</a>
								</div>
							</fieldset>  
							</div>  
					</div>
     `);
			}
		});

		$(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
			e.preventDefault();
			$(this).parent().parent().parent().parent().remove();
			// $(this).parent().remove();
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
