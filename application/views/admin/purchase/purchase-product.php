<?php 
/*
* Filename: add_items.php
* Author: Saddam
*/
?> 
<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight" style="background-color:#fafafa;">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section">
				 
				<div class="columns">
					<div class="column">
						<h1 class="subtitle is-5"><?= (!isset($edit_item)) ? 'Add Item' : 'Editing Item' ?>
							<?= (isset($edit->id)) ? '<span class="has-text-grey-light">(ID: ' . $edit->id . ')</span>' : '' ?></h1>
					</div>
				</div> s
				<form
					action="<?php if(empty($edit)){ echo base_url('admin/item_save'); }else{ echo base_url('admin/modify_item'); } ?>"
					method="POST">
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Location <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="location" id="location" required>
												<?php if(!isset($edit_item)): ?>
												<option selected disabled value="">Select a City</option>
												<?php endif ?>
												<?php if(!empty($locations)): foreach($locations as $loc): ?>
												<option value="<?= $loc->id; ?>"
													<?php if(!empty($edit) && $edit->id == $loc->id){ echo 'selected'; } ?>><?= $loc->name; ?>
												</option>
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
									<label class="label is-small">Supplier <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="supplier" class="supplier" required>
												<?php if(!isset($edit_item)): ?>
												<option selected disabled value="">Select a Supplier</option>
												<?php endif ?>
												<?php if(!empty($supplier)): foreach($supplier as $sup): ?>
												<option value="<?= $sup->name; ?>"
													<?= !empty($edit) && $edit->id == $sup->id ? 'selected' : '' ?>><?= $sup->name; ?>
												</option>
												<?php endforeach; endif; ?>
											</select>
										</span>
										<span class="icon is-small is-left">
											<i class="fas fa-user"></i>
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
									<label class="label is-small">Category <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="category" id="category" required>
												<?php if(!isset($edit_item)): ?>
												<option selected disabled value="">Select a Category</option>
												<?php endif ?>
												<?php if(!empty($categories)): foreach($categories as $cat): ?>
												<option value="<?= $cat->id; ?>"
													<?php if(!empty($edit) && $edit->id == $cat->id){ echo 'selected'; } ?>><?= $cat->cat_name; ?>
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
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Item Name <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="sub_category" id="item_name" required>
												<?php if(!isset($edit_item)): ?>
												<option selected disabled value="">Select an Item</option>
												<?php endif ?>
												<?php if(!empty($sub_categories)): foreach($sub_categories as $cat): ?>
												<option value="<?= $cat->id; ?>"
													<?php if(!empty($edit) && $edit->id == $cat->id){ echo 'selected'; } ?>><?= $cat->name; ?>
												</option>
												<?php endforeach; endif; ?>
											</select>
										</span>
										<span class="icon is-small is-left">
											<i class="fas fa-luggage-cart"></i>
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
									<label class="label is-small">Item Type</label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="item_type" id="item_type">
												<?php if(!isset($edit_item)): ?>
												<option selected disabled value="">Select a Type</option>
												<?php endif ?>
											</select>
										</span>
										<span class="icon is-small is-left">
											<i class="fas fa-quote-left"></i>
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
										<input name="quantity" value="<?= !empty($edit) ? $edit->quantity : '1' ?>" class="input is-small" type="number" min="1" max="9999" placeholder="1-9,999"
											required>
										<span class="icon is-small is-left">
											<i class="fas fa-sort-numeric-up"></i>
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
									<label class="label is-small">Model <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input name="model" value="<?= !empty($edit) ? $edit->model : '1' ?>" class="input is-small" type="text" placeholder="e.g 110 4G" required>
										<span class="icon is-small is-left">
											<i class="fas fa-bookmark"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Serial Number</label>
									<div class="control has-icons-left">
										<input name="serial_number" value="<?= !empty($edit) ? $edit->serial_number : '' ?>" class="input is-small" type="text" placeholder="e.g X12X34Y5XYXY">
										<span class="icon is-small is-left">
											<i class="fas fa-hashtag"></i>
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
									<label class="label is-small">Price <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input name="price" value="<?= !empty($edit) ? $edit->price : '' ?>" class="input is-small" type="number" min="1" max="9999999"
											placeholder="1-9,999,999" required>
										<span class="icon is-small is-left">
											<i class="fas fa-dollar-sign"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Depreciation (%) <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="depreciation" id="depreciation" required>
												<?php if(!isset($edit_item)): ?>
												<option selected disabled value="">Select a Value</option>
												<?php endif ?>
												<option value="5">5%</option>
												<option value="10">10%</option>
												<option value="15">15%</option>
												<option value="20">20%</option>
												<option value="30">30%</option>
											</select>
										</span>
										<span class="icon is-small is-left">
											<i class="fas fa-percentage"></i>
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
									<label class="label is-small">Status <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="status" id="status" required>
												<?php if(!isset($edit_item)): ?>
												<option selected disabled value="">Select Status</option>
												<?php endif ?>
												<?php if(!empty($status)): foreach($status as $stat): ?>
												<option value="<?= $stat->id; ?>"
													<?php if(!empty($edit) && $edit->id == $stat->id){ echo 'selected'; } ?>><?= $stat->status; ?>
												</option>
												<?php endforeach; endif; ?>
												<option value="new">New</option>
												<option value="used">Used</option>
												<option value="refurbished">Refurbished</option>
											</select>
										</span>
										<span class="icon is-small is-left">
											<i class="far fa-check-circle"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Purchase Date <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input name="purchasedate" class="input is-small" type="date" required>
										<span class="icon is-small is-left">
											<i class="far fa-calendar-alt"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
					</div>
					<div class="columns">
						<div class="column has-text-right">
							<div class="buttons is-pulled-right">
                <?php if(!isset($edit_item)): ?>
								<button class="button is-danger is-small is-outlined" type="reset">Reset Form</button>
                <?php endif ?>
                <p class="control">
								<button class="button is-small is-success"  type="submit">
									<span><?= !isset($edit_item) ? 'Save and continue' : 'Save Changes' ?></span>
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

		<div class="modal" id="modal-ter">
			<div class="modal-background"></div>
			<form action="<?= base_url('admin/product_report'); ?>" method="POST">
				<div class="modal-card">
					<header class="modal-card-head">
						<p class="modal-card-title">Filter Report</p>
						<button class="delete" aria-label="close" id="exit-report-modal" type="button"></button>
					</header>
					<section class="modal-card-body">
						<div class="columns">
							<div class="column">
								<p class="control">
									From:
									<input class="input" type="date" placeholder="From" name="from_date">
								</p>
							</div>
							<div class="column">
								<p class="control">
									To:
									<input class="input" type="date" placeholder="From" name="to_date">
								</p>
							</div>
						</div>
					</section>
					<footer class="modal-card-foot">
						<button class="button is-success" type="submit">Apply</button>
						<button class="button" aria-label="close" id="close-report-modal" type="button">Cancel</button>
					</footer>
				</div>
			</form>
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
