<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight" style="background-color:#fafafa;">
    <?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section">
				<div class="columns">
					<div class="column">
						<form action="<?= base_url('admin/search_item') ?>" method="GET">
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
					<div class="column">
						<div class="field has-addons">
							<p class="control">
								<button class="button is-small" id="report-btn">
									<span class="icon is-small">
										<i class="fas fa-paperclip"></i>
									</span>
									<span>Report</span>
								</button>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/item_register'); ?>'"
									class="button is-small <?= (isset($item_register)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Items List</span>
								</button>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/available_item_list'); ?>'"
									class="button is-small <?= (isset($available_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="far fa-list-alt"></i>
									</span>
									<span>Available List</span>
								</button>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/get_assign_item'); ?>'"
									class="button is-small <?= (isset($assign_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-bars"></i>
									</span>
									<span>Assigned List</span>
								</button>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/add_item'); ?>'"
									class="button is-small <?= (isset($add_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</button>
							</p>
						</div>
					</div>
				</div>
				<div class="columns">
					<div class="column">
						<h1 class="subtitle is-5"><?= (!isset($edit_item)) ? 'Add Item' : 'Editing Item' ?> <?= (isset($edit->id)) ? '<span class="has-text-grey-light">(ID: ' . $edit->id . ')</span>' : '' ?></h1>
					</div>
				</div>
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
												<option selected disabled value="">Select a City</option>
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
												<option selected disabled value="">Select a Supplier</option>
												<?php if(!empty($supplier)): foreach($supplier as $sup): ?>
												<option value="<?= $sup->name; ?>"
													<?php if(!empty($edit) && $edit->id == $sup->id){ echo 'selected'; } ?>><?= $sup->name; ?>
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
												<option selected disabled value="">Select a Category</option>
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
												<option selected disabled value="">Select an Item</option>
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
												<option selected disabled value="">Select a Type</option>
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
										<input name="quantity" class="input is-small" type="number" min="1" max="9999" placeholder="1-9,999"
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
										<input name="model" class="input is-small" type="text" placeholder="e.g 110 4G" required>
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
										<input name="serial_number" class="input is-small" type="text" placeholder="e.g X12X34Y5XYXY">
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
										<input name="price" class="input is-small" type="number" min="1" max="9999999"
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
												<option selected disabled value="">Select a Value</option>
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
												<option selected disabled value="">Select Status</option>
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
								<button class="button is-danger is-small is-outlined" type="button">Reset</button>
								<button class="button is-success is-small" type="submit">Save and continue</button>
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
	$(document).ready(function () {
		$("#nav-category").click(function () {
			$(this).siblings().toggle('fast');
		});
	});

	class BulmaModal {
		constructor(selector) {
			this.elem = document.querySelector(selector)
			this.close_data()
		}

		show() {
			this.elem.classList.toggle('is-active')
			this.on_show()
		}

		close() {
			this.elem.classList.toggle('is-active')
			this.on_close()
		}

		close_data() {
			var modalClose = this.elem.querySelectorAll("[data-bulma-modal='close'], .modal-background")
			var that = this
			modalClose.forEach(function (e) {
				e.addEventListener("click", function () {

					that.elem.classList.toggle('is-active')

					var event = new Event('modal:close')

					that.elem.dispatchEvent(event);
				})
			})
		}

		on_show() {
			var event = new Event('modal:show')

			this.elem.dispatchEvent(event);
		}

		on_close() {
			var event = new Event('modal:close')

			this.elem.dispatchEvent(event);
		}

		addEventListener(event, callback) {
			this.elem.addEventListener(event, callback)
		}
	}

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
		$('#category').on('change', function () {
			var category = $(this).val();
			//  alert(category)
			// AJAX request
			$.ajax({
				url: '<?=base_url('admin/get_item_sub_categories/')?>' + category,
				method: 'post',
				data: {
					category: category
				},
				dataType: 'json',
				success: function (response) {
					console.log(response);
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



	// item type auto load against item
	$(document).ready(function () {
		// City change
		$('#item_name').on('change', function () {
			var item_id = $(this).val();
			// AJAX request
			$.ajax({
				url: '<?=base_url('admin/get_item_type/')?>' + item_id,
				method: 'post',
				data: {
					item_id: item_id
				},
				dataType: 'json',
				success: function (response) {
					console.log(response[0].quantity);
					// Remove options 
					$('#item_type').find('option').not(':first').remove();
					// Add options
					$.each(response, function (index, data) {
						$('#item_type').append('<option value="' + data['id'] + '">' + data['type_name'] + ' (' +
							data['quantity'] + ')' + '</option>');
					});
				}
			});
		});
	});

</script>
