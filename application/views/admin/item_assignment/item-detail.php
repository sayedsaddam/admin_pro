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
									<input class="input is-small is-fullwidth" name="search" type="search" placeholder="Search Items" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" required>
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
					<div class="column is-hidden-touch">
						<div class="field has-addons">
							<p class="control">
								<a href='<?= base_url('admin/item_register'); ?>'"
									class="button is-small <?= isset($item_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Items List</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/available_item_list'); ?>'"
									class="button is-small <?= isset($available_page) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="far fa-list-alt"></i>
									</span>
									<span>Available List</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/get_assign_item'); ?>'"
									class="button is-small <?= isset($assign_page) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-bars"></i>
									</span>
									<span>Assigned List</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/get_damaged_item'); ?>'"
									class="button is-small <?= isset($damaged_page) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-unlink"></i>
									</span>
									<span>Damaged Item</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/add_item'); ?>'"
									class="button is-small <?= isset($add_page) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</a>
							</p>
						</div>
					</div>
				</div>
				<form action="<?php if(empty($edit)){ echo base_url('admin/item_save'); }else{ echo base_url('admin/modify_item'); } ?>"
					method="POST">
					<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Location <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="location" id="supplier_location" required <?= isset($edit) ? 'disabled' : '' ?>>
												<?php if(!isset($edit)): ?>
												<option selected disabled value="">Select a City</option>
												<?php endif ?>
												<?php if(!empty($locations)): foreach($locations as $loc): ?>
												<option value="<?= $loc->id; ?>"
													<?php !empty($edit) && $edit->id == $loc->id ? 'selected' : '' ?>><?= ucwords($loc->name); ?>
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
							<label class="label is-small">Dapartment</label>
							<div class="select select is-small is-fullwidth">

							<select name="department" <?= isset($edit) ? 'disabled' : '' ?>>
									<?php if(!isset($edit)): ?>
									<option selected disabled value="">Select a departments</option>
									<?php endif ?>
									<?php if(!empty($departments)): foreach($departments as $department): ?> 
									<option value="<?= $department->id; ?>"
									<?php if(!empty($edit) && $edit->dep_id == $department->id){ echo 'selected';$department->department;  } ?>
									><?= ucwords($department->department); ?>
									</option>
									<?php endforeach; endif; ?>
							</select>
							 
							</div>
						</div>
					</div>
					<div class="columns"> 

					<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Supplier <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth"> 
											<?php  $role = ($this->session->userdata('user_role')); 
											if($role == '1' && !isset($edit)) {?> 
											<select name="supplier" id="supplier" class="browser-default custom-select" <?= isset($edit) ? 'disabled' : '' ?>>
												<option value="" disabled selected>Select a Supplier</option>
											</select>
											<?php } else {?>
											<select name="supplier" id="" required <?= isset($edit) ? 'disabled' : '' ?>> 
												<option selected disabled value="">Select a Supplier</option>
												<?php $suppliers = $this->admin_model->get_location_suplier($role);
												if(!empty($suppliers)): foreach($suppliers as $sup): ?>
												<option value="<?= $sup->id; ?>" <?= isset($edit) && $edit->supplier == $sup->id ? 'selected' : '' ?>>
													<?= ucwords($sup->name); ?>
												</option>
												<?php endforeach; endif; ?>
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
									<label class="label is-small">Category <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="category" id="category" required <?= isset($edit) ? 'disabled' : '' ?>>
												<option selected disabled value="">Select a Category</option>
												<?php if(!empty($categories)): foreach($categories as $cat): ?>
												<option value="<?= $cat->id; ?>"
													<?= isset($edit) && $edit->category == $cat->id ? 'selected' : '' ?>>
													<?= ucwords($cat->cat_name); ?>
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
									<label class="label is-small">Subcategory <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="sub_category" id="item_name" required <?= isset($edit) ? 'disabled' : '' ?>>
												<option selected disabled value="">Select a Subcategory</option>
												<?php if(!empty($sub_categories)): foreach($sub_categories as $cat): ?>
												<option value="<?= $cat->id; ?>"
													<?= isset($edit) && $edit->sub_category == $cat->id ? 'selected' : '' ?>>
													<?= ucwords($cat->name); ?>
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

						<div class="column">
							<label class="label is-small">Project / Company <span class="has-text-danger">*</span></label>
							<div class="select select is-small is-fullwidth">  
								<select name="project" required <?= isset($edit) ? 'disabled' : '' ?>>
									<?php if(!isset($edit)): ?>
									<option selected disabled value="">Select a Project / Company</option>
									<?php endif ?>
									<?php if(!empty($projects)): foreach($projects as $project): ?> 
									<option value="<?= $project->id; ?>"
									<?php if(!empty($edit) && $edit->project == $project->id){ echo 'selected';$project->project_name;  } ?>
									><?= ucwords($project->project_name); ?>
									</option>
									<?php endforeach; endif; ?>
							</select>

							</div>
						</div> 
						
					</div>
					<div class="columns">
					<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Item Company <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input name="item_name" id="sub_item_name" value="<?= !empty($edit) ? ucwords($edit->type_name) : '' ?>" class="input is-small"
											type="text" placeholder="e.g Apple" required>
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
										<input name="quantity" id="item-quantity" value="<?= !empty($edit) ? $edit->quantity : '1'; ?>"
											class="input is-small" type="number" min="1" max="99" placeholder="1-99" required <?= isset($edit) ? 'disabled' : '' ?>>
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
										<input name="model" value="<?= !empty($edit) ? ucwords($edit->model) : '' ?>" class="input is-small"
											type="text" placeholder="e.g 110 4G" required>
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
									<label class="label is-small">Serial Number / IMEI <span class="has-text-danger" id="serial-required"
											style="display:none;">*</span></label>
									<div class="control has-icons-left">
										<input name="serial_number" value="<?= !empty($edit) ? $edit->serial_number : '' ?>"
											class="input is-small" id="serial-number" type="text" placeholder="e.g X12X34Y5XYXY">
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
									<label class="label is-small">Price (PKR) <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input name="price" value="<?= !empty($edit) ? $edit->price : '' ?>" class="input is-small"
											type="number" min="1" max="9999999" placeholder="1-9,999,999" required>
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
									<label class="label is-small">Depreciation (%) <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="depreciation" id="depreciation" required>
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
									<label class="label is-small">Status <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="status" id="status" required>
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
									<label class="label is-small">Purchase Date <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input name="purchasedate" class="input is-small" type="date" required
											value="<?= !empty($edit) ? $edit->purchasedate : '' ?>">
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
									<button class="button is-small is-success" type="submit">
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
			if (category_text.includes('Electronics')) {
				$("#item-quantity").val(1);
				$("#item-quantity").attr('disabled', true);
				$("#serial-number").attr('required', true);
				$("#serial-required").show();
			} else {
				$("#item-quantity").attr('disabled', false);
				$("#serial-number").attr('required', false);
				$("#serial-required").hide();
			}
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

</script>
