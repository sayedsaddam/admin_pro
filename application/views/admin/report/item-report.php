<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight" id="custom-sidebar">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section">
				<div class="columns">
					<div class="column">
						<?php $this->view('admin/commons/breadcrumb'); ?>
					</div>
				</div>
				<div class="columns">
					<div class="column">
						<form action="<?= base_url('admin/search_item') ?>" method="GET">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search" placeholder="Filter Items" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
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

				<div class="column is-hidden-touch is-narrow is-hidden-print">
						<div class="field has-addons">
							<p class="control">
								<a href='<?= base_url('report/asset_report'); ?>'
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Assets</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('report/supplier_report'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Supplier</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('report/employee_report'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Employee</span>
								</a>
							</p> 
							<p class="control">
								<a href='<?= base_url('report/item_report'); ?>'
									class="button is-small <?= isset($item_report) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Item</span>
								</a>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a href='<?= base_url('report/project_report'); ?>'
									class="button is-small <?= isset($project_report) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Project</span>
								</a>
							</p>
							<?php endif ?>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a href='<?= base_url('report/invoice_report'); ?>'
									class="button is-small <?= isset($invoice_report) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Invoice</span>
								</a>
							</p>
							<?php endif ?>
						</div>
					</div>
				</div>
				<form action="<?php echo base_url('report/filter_item');?>" method="GET"> 
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Location</label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="location" id="supplier_location"> 
												<option selected disabled value="">Select a City</option> 
												<?php foreach($locations as $loc): ?>
												<option value="<?= $loc->id; ?>"
													<?php !empty($edit) && $edit->id == $loc->id ? 'selected' : '' ?>><?= ucwords($loc->name); ?>
												</option>
												<?php endforeach;?>
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
							<label class="label is-small">Dapartment</label>
							<div class="select select is-small is-fullwidth"> 
							<select name="department"> 
									<option selected disabled value="">Select a departments</option> 
									<?php foreach($departments as $department): ?> 
									<option value="<?= $department->id; ?>"><?= ucwords($department->department); ?>
									</option>
									<?php endforeach; ?>
							</select>
							 
							</div>
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
							 <option value="" selected disabled>Select Item</option>
							 <option value="available_item">Available Item</option>
							 <option value="assigned_item">Assigned Item</option>
							 <option value="damaged_item">Damaged Item</option>
						 </select>
					</span>
					<span class="icon is-small is-left">
							<i class="fas fa-list"></i>
						</span>
							</div>
						</div>
					</fieldset>
				</div> 

					<div class="column">
							<div class="control">
								<label class="label is-small">Employee</label>
								<div class="control has-icons-left">
									<span class="select is-small is-fullwidth">
										<select name="employee" id="employee">
											<option selected disabled value="">Select a Employee</option>
											<?php if(!empty($employees)): foreach($employees as $employee): ?>
											<option value="<?= $employee->id; ?>"
												<?= !empty($edit) && $edit->employee == $employee->id ? 'selected' : '' ?>>
												<?= ucwords($employee->fullname); ?>
											</option>
											<?php endforeach; endif; ?>
										</select>
									</span>
								</div>
							</div>
						</div>
					
				</div>
					<div class="columns"> 

					<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Supplier</label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth"> 
											<?php  $role = ($this->session->userdata('user_role')); 
											if($role == '1') {?> 
											<select name="supplier" id="supplier" class="browser-default custom-select" <?= isset($edit) ? 'disabled' : '' ?>>
												<option value="" disabled selected>Select a Supplier</option>
											</select>
											<?php } else {?>
											<select name="supplier" id=""> 
												<option selected disabled value="">Select a Supplier</option>
												<?php $suppliers = $this->admin_model->get_location_suplier($role);
												foreach($suppliers as $sup): ?>
												<option value="<?= $sup->id; ?>" <?= isset($edit) && $edit->supplier == $sup->id ? 'selected' : '' ?>>
													<?= ucwords($sup->name); ?>
												</option>
												<?php endforeach;?>
											</select>
											<?php } ?>  
										</span>
										<span class="icon is-small is-left">
											<i class="fas fa-user"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div> 

						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Category</label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="category" id="category">
												<option selected disabled value="">Select a Category</option>
												<?php foreach($categories as $cat): ?>
												<option value="<?= $cat->id; ?>"
													<?= isset($edit) && $edit->category == $cat->id ? 'selected' : '' ?>>
													<?= ucwords($cat->cat_name); ?>
												</option>
												<?php endforeach; ?>
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
									<label class="label is-small">Subcategory</label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="sub_category" id="item_name">
												<option selected disabled value="">Select a Subcategory</option>
												<?php foreach($sub_categories as $cat): ?>
												<option value="<?= $cat->id; ?>">
													<?= ucwords($cat->name); ?>
												</option>
												<?php endforeach;?>
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
							<label class="label is-small">Project / Company</label>
							<div class="select select is-small is-fullwidth">  
								<select name="project"> 
									<option selected disabled value="">Select a Project / Company</option> 
									<?php foreach($projects as $project): ?> 
									<option value="<?= $project->id; ?>"
 									><?= ucwords($project->project_name); ?>
									</option>
									<?php endforeach; ?>
							</select>

							</div>
						</div> 
						
					</div>
					<div class="columns">
					<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Item Company</label>
									<div class="control has-icons-left">
										<input name="item_name" id="sub_item_name" value="" class="input is-small"
											type="text" placeholder="e.g Apple">
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
									<label class="label is-small">Quantity</label>
									<div class="control has-icons-left">
										<input name="quantity" id="item-quantity" value=""
											class="input is-small" type="number" min="1" max="99" placeholder="1-99">
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
									<label class="label is-small">Model</label>
									<div class="control has-icons-left">
										<input name="model" value="" class="input is-small"
											type="text" placeholder="e.g 110 4G">
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
									<label class="label is-small">Serial Number / IMEI <span class="has-text-danger"
											style="display:none;"></span></label>
									<div class="control has-icons-left">
										<input name="serial_number" value=""
											class="input is-small" id="" type="text" placeholder="e.g X12X34Y5XYXY">
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
									<label class="label is-small">Price (PKR)</label>
									<div class="control has-icons-left">
										<input name="price" value="" class="input is-small"
											type="number" min="1" max="9999999" placeholder="1-9,999,999">
										<span class="icon is-small is-left">
											<i class="far fa-money-bill-alt"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
					<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Depreciation (%)</label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="depreciation" id="depreciation">
												<?php if(empty($depreciation)): ?>
												<option disabled value="" selected>Select a Value</option>
												<option value="5">5%</option>
												<option value="10">10%</option>
												<option value="15">15%</option>
												<option value="20">20%</option>
												<option value="30">30%</option>
												<?php else: foreach($depreciation as $dep): ?>
												<?php $option_flag = false ?>
												<option disabled value="" <?php if(!isset($edit_item)){ echo 'selected'; } ?>>Select a Value
												</option>
												<option value="5"
													<?php if(!empty($edit) && $dep->depreciation == 5 && $option_flag == false){ echo 'selected'; $option_flag = true; } ?>>
													5%</option>
												<option value="10"
													<?php if(!empty($edit) && $dep->depreciation == 10  && $option_flag == false){ echo 'selected'; $option_flag = true; } ?>>
													10%</option>
												<option value="15"
													<?php if(!empty($edit) && $dep->depreciation == 15 && $option_flag == false){ echo 'selected'; $option_flag = true; } ?>>
													15%</option>
												<option value="20"
													<?php if(!empty($edit) && $dep->depreciation == 20 && $option_flag == false){ echo 'selected'; $option_flag = true; } ?>>
													20%</option>
												<option value="30"
													<?php if(!empty($edit) && $dep->depreciation == 30 && $option_flag == false){ echo 'selected'; $option_flag = true; } ?>>
													30%</option>
												<?php endforeach; endif; ?>
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
									<label class="label is-small">Status</label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="status" id="status">
												<option selected disabled value="">Select Status</option>
												<?php if(!empty($status_list)): foreach($status_list as $stat): ?>
													<option value="<?= $stat->id; ?>"
														<?= !empty($edit) && $edit->status == $stat->id ? 'selected' : '' ?>><?= $stat->type; ?>
													</option>
												<?php endforeach; endif; ?>
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
									<label class="label is-small">Purchase Date</label>
									<div class="control has-icons-left">
										<input name="purchasedate" class="input is-small" type="date"
											value="">
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
								<button class="button is-danger is-small is-outlined" type="reset">Reset Form</button>
								<p class="control">
									<button class="button is-small is-success" type="submit">
										<span><?= 'Filter' ?></span>
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
	var btn1 = $("#report-btn")
	var btn3 = $("#exit-report-modal")
	var btn4 = $("#close-report-modal")

	var mdl = new BulmaModal("#modal-ter")

	btn1.click(function (ev) {
		mdl.show();
		$(".modal-card-head").show();
		ev.stopPropagation();
	});
	btn3.click(function (ev) {
		mdl.close();
		ev.stopPropagation();
	});
	btn4.click(function (ev) {
		mdl.close();
		ev.stopPropagation();
	});

</script>

<script>
	$(document).ready(function () {

		// category change
		$('#category').on('change', function () {
			var category = $(this).val();
			var category_text = $("#category option:selected").text();;
		 
			//  alert(category)
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
					$('#item_name').find('option').not(':first').remove();

					// Add options
					$.each(response, function (index, data) {
						$('#item_name').append('<option value="' + data['id'] + '">' + data['name'] + '</option>');
					});
				}
			});
		});
	});

  var itemSuggestions = [];

	// item type auto load against item
	$(document).ready(function () {
		// City change
		$('#item_name').on('change', function () {
      itemSuggestions = [];
			var item_id = $(this).val();
			// AJAX request
			$.ajax({
				url: '<?= base_url("admin/get_item_type/"); ?>' + item_id,
				method: 'POST',
				data: {
					item_id: item_id
				},
				dataType: 'json',
				success: function (response) {
					$.each(response, function (index, data) {
            			itemSuggestions.push(data['type_name']);
					});
				}
			});
      $("#sub_item_name").autocomplete({
        source: itemSuggestions
      });
		});
	});

// load supplier against location
$(document).ready(function(){
 // City change
 $('#supplier_location').on('change', function(){
   var location = $(this).val();
   // AJAX request
   $.ajax({
     url:'<?=base_url('admin/supplier_against_location/')?>' + location,
     method: 'post',
     data: {location: location},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#supplier').find('option').not(':first').remove();
       $('#supplier_email').find('option').not(':first').remove();
       // Add options
       $.each(response,function(index, data){
        $('#supplier').append('<option value="'+data['id']+'">'+data['name']+'</option>'); 
        $('#supplier_email').append('<option value="'+data['id']+'">'+data['email']+'</option>'); 
       });
     }
  });
  event.stopPropagation();
});
});

$(document).ready(function () {
	// item type to select employe detail
	$('#item_type').on('change', function () {
			var item_type = $(this).val();
			var item_type_text = $("#item_type option:selected").text(); 
			if (item_type_text.includes('Assigned Item')) {
				$("#employee").attr('disabled', false);
			} else {
				$("#employee").attr('disabled', true);
			}
		});
})
$("#employee").select2();
</script>
