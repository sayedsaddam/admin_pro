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
						<form action="<?= base_url('report/filter_asset'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Assets Reports"
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
							</div>
						</form>
					</div>

					<div class="column is-hidden-touch is-narrow">
						<div class="field has-addons">
							<p class="control">
								<a href='<?= base_url('report/asset_report'); ?>'
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Assets</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('report/supplier_report'); ?>'
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Supplier</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/asset_register'); ?>'
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Employee</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/asset_register'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Item Category</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/asset_register'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Item</span>
								</a>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a href='<?= base_url('admin/add_asset'); ?>'"
									class="button is-small <?= isset($add_asset) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Project</span>
								</a>
							</p>
							<?php endif ?>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a href='<?= base_url('admin/add_asset'); ?>'"
									class="button is-small <?= isset($add_asset) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Invoice</span>
								</a>
							</p>
							<?php endif ?>
						</div>
					</div>

				</div>

				<?php if($this->session->flashdata('success')) : ?>
				<div class="columns">
					<div class="column">
						<div class="notification is-success is-light">
							<button class="delete"></button>
							<?= $message = $this->session->flashdata('success'); ?>
						</div>
					</div>
				</div>
				<?php elseif($this->session->flashdata('failed')) : ?>
				<div class="columns">
					<div class="column">
						<div class="notification is-danger is-light">
							<button class="delete"></button>
							<?= $message = $this->session->flashdata('failed'); ?>
						</div>
					</div>
				</div>
				<?php endif ?>

				<form action="<?php echo base_url('report/filter_asset')?>"
					method="get"> 
					<div class="columns">
						
					<div class="column">
						<fieldset>
								<div class="field">
									<label class="label is-small">Category</label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											<select name="category" id="category">
												<option selected disabled value="">Select a Category</option>
												<?php if(!empty($categories)): foreach($categories as $cat): ?>
												<option value="<?= $cat->id; ?>">
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

						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Subcategory</label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											 
											<select name="sub_categories" id="sub_categories">
												<option selected disabled value="">Select a Subcategory</option>
												<?php if(!empty($sub_categories)): foreach($sub_categories as $cat): ?>
												<option value="<?= $cat->id; ?>"
													>
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

					</div>

					<div class="columns"> 
						<div class="column">
							<div class="control">
								<label class="label is-small">Quantity</label>
								<div class="select is-small is-fullwidth">
									<div class="control has-icons-left">
										<input type="number" name="quantity" id="" class="input is-small"
											value="" type="text"
											placeholder="1-99">
										<span class="icon is-small is-left">
											<i class="fas fa-sort-numeric-up"></i>
										</span>
									</div>
								</div>
							</div>
						</div> 
						
						<div class="column">
							<div class="control">
								<label class="label is-small">Price (PKR)</label>
								<div class="select is-small is-fullwidth">
									<div class="control has-icons-left">
										<input type="number" name="price" id="" class="input is-small"
											value="" type="text"
											placeholder="1-9,999,999">
										<span class="icon is-small is-left">
											<i class="far fa-money-bill-alt"></i>
										</span>
									</div>
								</div>
							</div>
						</div> 
					</div>


					<div class="columns">
						<div class="column">
							<div class="control">
								<label class="label is-small">Purchase Date</label>
								<div class="is-small is-fullwidth">
									<div class="control has-icons-left">
										<input name="purchase_date" class="input is-small" type="date"
											value="">
										<span class="icon is-small is-left">
											<i class="far fa-calendar-alt"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="column">
							<div class="control">
								<label class="label is-small">Location </label>
								<div class="control has-icons-left">
									<span class="select is-small is-fullwidth">
										<select name="location" id="" class="browser-default custom-select ">
											<option disabled value="" selected>Select Category</option>
											<?php foreach($locations as $loc): ?>
											<?php if ($loc->id == $this->session->userdata('location') || $this->session->userdata('user_role') == '1') : ?>
											<option value="<?= $loc->id; ?>">												
												<?= ucwords($loc->name); ?>
											</option>
											<?php endif ?>
											<?php endforeach; ?>
										</select>
									</span>
									<span class="icon is-small is-left">
										<i class="fas fa-globe"></i>
									</span>
								</div>
							</div>
						</div>
					</div> 
					<div class="columns">
						<div class="column has-text-right">
							<div class="buttons is-pulled-right"> 
								<button class="button is-danger is-small is-outlined" type="reset">Reset Form</button>
								<p class="control" >
									<button class="button is-small is-success" type="submit">
										<span><?= 'Filter ' ?></span>
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
$(document).ready(function () {

// category change
$('#category').on('change', function () {
	// AJAX request
	var category = $(this).val();
	$.ajax({
		url: '<?= base_url("admin/get_item_sub_categories/"); ?>' + category,
		method: 'POST',
		data: {
			category: category
		},
		dataType: 'json',
		success: function (response) {
			// Remove options 
			$('#sub_categories').find('option').not(':first').remove();

			// Add options
			$.each(response, function (index, data) {
				$('#sub_categories').append('<option value="' + data['id'] + '">' + data['name'] + '</option>');
			});
		}
	});
});
});


</script>