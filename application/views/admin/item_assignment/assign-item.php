<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight" id="custom-sidebar">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section py-5">
				<div class="columns">
					<div class="column">
						<?php $this->view('admin/commons/breadcrumb'); ?>
					</div>
				</div>
				<div class="columns is-hidden-touch">
					<div class="column">
						<form action="<?= base_url('admin/search_item') ?>" method="GET">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Item"
										value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
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
								<div class="ml-1 control">
									<a href="<?= base_url('report/item_report') ?>" class="button is-small">
										<span class="icon is-small">
											<i class="fas fa-sort-alpha-down"></i>
										</span>
										<span>Filter</span>
									</a>
								</div>
							</div>
						</form>
					</div>
					<div class="column">
						<div class="field has-addons">
							<p class="control">
								<a href='<?= base_url('admin/item_register'); ?>'"
									class="button is-small <?= (isset($item_register)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Items List</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/available_item_list'); ?>'"
									class="button is-small <?= (isset($available_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="far fa-list-alt"></i>
									</span>
									<span>Available List</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/get_assign_item'); ?>'"
									class="button is-small <?= (isset($assign_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-bars"></i>
									</span>
									<span>Assigned List</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/get_damaged_item'); ?>'"
									class="button is-small <?= (isset($damaged_item)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-unlink"></i>
									</span>
									<span>Damaged List</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/add_item'); ?>'"
									class="button is-small <?= (isset($add_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</a>
							</p>
						</div>
					</div>
				</div>

				<form action="<?= base_url("admin/assign_item_save") ?>" method="POST">
					<input type="hidden" name="item_id" value="<?php echo $this->uri->segment(3); ?>">

					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Category</label>
									<div class="control has-icons-left">
										<input class="input is-small" type="text"
											value="<?= ucwords($returning_items->cat_name) ?>" disabled>
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
									<label class="label is-small">Product</label>
									<div class="control has-icons-left">
										<input class="input is-small" type="text"
											value="<?= ucwords($returning_items->names) ?>" disabled>
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
									<label class="label is-small">Company</label>
									<div class="control has-icons-left">
										<input class="input is-small" type="text" value="<?= $returning_items->type_name ?>"
											disabled>
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
									<label class="label is-small">Model</label>
									<div class="control has-icons-left">
										<input class="input is-small" type="text" value="<?= $returning_items->model ?>"
											disabled>
										<span class="icon is-small is-left">
											<i class="far fa-money-bill-alt"></i>
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
									<label class="label is-small">Price</label>
									<div class="control has-icons-left">
										<input class="input is-small" type="text" value="<?= $returning_items->price ?>"
											disabled>
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
									<label class="label is-small">IMEI</label>
									<div class="control has-icons-left">
										<input class="input is-small" type="text" value="<?= $returning_items->serial_number ?>"
											disabled>
										<span class="icon is-small is-left">
											<i class="far fa-money-bill-alt"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
					</div>
					<hr>
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Location <span
											class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">

											<?php  $role = ($this->session->userdata('user_role')); 
											if($role == 'admin') {?>
											<select name="location" id="location" required>
												<option selected disabled value="">Select a City</option>
												<?php if(!empty($locations)): foreach($locations as $loc): ?>
												<option value="<?= $loc->id; ?>"
													<?php if(!empty($edit) && $edit->id == $loc->id){ echo 'selected'; } ?>>
													<?= $loc->name; ?>
												</option>
												<?php endforeach; endif; ?>
												<?php } else { ?>
												<select name="location" id="" required>
													<?php if(!empty($locations)): foreach($locations as $loc): ?>
													<option value="<?= $loc->id; ?>"
														<?php if(!empty($edit) && $edit->id == $loc->id){ echo 'selected'; } ?>>
														<?= $loc->name; ?>
													</option>
													<?php endforeach; endif; ?>
													<?php } ?>
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
									<label class="label is-small">Assign To <span
											class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<input type="hidden" name="assign_by" class="form-control"
												value="<?= $this->session->userdata('id');  ?>">
											<?php  $role = ($this->session->userdata('user_role')); 
											if($role == 'admin') {?>
											<select name="employ" class="employ" id="employ" required>
												<option selected disabled value="">Select an Employee</option>
												<?php foreach($assign_to as $loc){ ?>
												<option value="<?= $loc->id; ?>">
													<?= $loc->fullname; ?>
												</option>
												<?php } ?>
											</select>
											<?php } else {?>
											<select name="employ" id="" required>
												<?php echo $role; $employee = $this->admin_model->get_location_employ($role);
												if(!empty($employee)): foreach($employee as $loc): ?>
												<option value="<?= $loc->id; ?>">
													<?= $loc->name; ?>
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
		// City change
		$('#location').on('change', function () {
			var location = $(this).val();
			// alert(location)
			// AJAX request
			$.ajax({
				url: "<?=base_url("admin/get_location_employ/")?>" + location,
				method: "POST",
				data: {
					location: location
				},
				dataType: 'json',
				success: function (response) {
					// Remove options 
					$('#employ').find('option').not(':first').remove();

					// Add options
					$.each(response, function (index, data) {
						$('#employ').append('<option value="' + data['id'] + '">' +
							data['name'] + '</option>');
					});
				}
			});
		});
	});

	// get employ which have some items 
	$(document).ready(function () {
		// City change
		$('#employ').on('change', function () {
			var employ = $(this).val();
			// AJAX request
			$.ajax({
				url: "<?=base_url("admin/get_employ_data/")?>" + employ,
				method: "POST",
				data: {
					employ: employ
				},
				dataType: 'json',
				success: function (response) {
					// Remove options
					$('#employ_data').find('option').not(':first').remove();
					// Add options
					$('#employ_data').html('');
					$.each(response, function (index, data) {
						if (data['assignd_to'] != null) {
							var res = " <span style='color: blue'> ( " + response[0]
								.name +
								" ) is already have  </span> Product  <span style='color: red'>" +
								response[0].sub_cat;
							$('#employ_data').append(res).show();
							return true
						}
						$('#employ_data').append('<option value="' + data['id'] + data[
							'model'] + '">' + data[
							'model'] + '</option>');
					});
				}
			});
		});
	});

</script>
