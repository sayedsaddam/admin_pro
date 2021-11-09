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
						<form action="<?= base_url('admin/search_asset_register'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Assets"
										value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" required>
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
								<button onclick="location.href='<?= base_url('admin/asset_register'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Assets List</span>
								</button>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/add_asset'); ?>'"
									class="button is-small <?= isset($add_asset) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</button>
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

				<form
					action="<?php if(empty($edit)){ echo base_url('admin/save_item'); }else{ echo base_url('admin/update_item'); } ?>"
					method="post">
					<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
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
													<?= !empty($edit) && $edit->category == $cat->id ? 'selected' : '' ?>>
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
									<label class="label is-small">Subcategory <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
											 
											<select name="sub_categories" id="sub_categories" required>
												<option selected disabled value="">Select a Sub Categories</option>
												<?php if(!empty($sub_categories)): foreach($sub_categories as $cat): ?>
												<option value="<?= $cat->id; ?>"
													<?= !empty($edit) && $edit->sub_categories == $cat->id ? 'selected' : '' ?>>
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
								<label class="label is-small">Quantity <span class="has-text-danger">*</span></label>
								<div class="select is-small is-fullwidth">
									<div class="control has-icons-left">
										<input type="number" name="quantity" id="" class="input is-small"
											value="<?php if(!empty($edit)){ echo $edit->quantity; } ?>" type="text"
											placeholder="1-9,99" required="">
										<span class="icon is-small is-left">
											<i class="fas fa-sort-numeric-up"></i>
										</span>
									</div>
								</div>
							</div>
						</div> 
						
						<div class="column">
							<div class="control">
								<label class="label is-small">Price <span class="has-text-danger">*</span></label>
								<div class="select is-small is-fullwidth">
									<div class="control has-icons-left">
										<input type="number" name="price" id="" class="input is-small"
											value="<?php if(!empty($edit)){ echo $edit->price; } ?>" type="text"
											placeholder="50,00" required="">
										<span class="icon is-small is-left">
											<i class="fas fa-sort-numeric-up"></i>
										</span>
									</div>
								</div>
							</div>
						</div> 
					</div>


					<div class="columns">
						<div class="column">
							<div class="control">
								<label class="label is-small">Purchase Date <span
										class="has-text-danger">*</span></label>
								<div class="is-small is-fullwidth">
									<div class="control has-icons-left">
										<?php if(!empty($edit)){
            $date = strtotime($edit->purchase_date); 
            $purchase_date = date('Y-m-d', $date); 
            }?>
										<input name="purchase_date" class="input is-small" type="date" required
											value="<?php if(!empty($edit)){ echo $purchase_date; } ?>">
										<span class="icon is-small is-left">
											<i class="far fa-calendar-alt"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="column">
							<div class="control">
								<label class="label is-small">Location <span class="has-text-danger">*</span></label>
								<div class="control has-icons-left">
									<span class="select is-small is-fullwidth">
										<select name="location" id="" class="browser-default custom-select ">
											<option disabled value="">Select Category</option>
											<?php if(!empty($locations)): foreach($locations as $loc): ?>
											<?php if ($loc->id == $this->session->userdata('location') || $this->session->userdata('user_role') == '1') : ?>
											<option value="<?= $loc->id; ?>"
												<?= !empty($edit) && $edit->location == $loc->id ? 'selected' : '' ?>>												
												<?= ucwords($loc->name); ?>
											</option>
											<?php endif ?>
											<?php endforeach; endif; ?>
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


						<div class="column column is-6">
							<fieldset>
								<div class="field">
									<label class="label is-small">Description</label>
									<div class="control has-icons-left">
										<textarea class="textarea is-small" name="description" rows="2" id=""
											placeholder="some detail"><?php if(!empty($edit)){ echo $edit->description; } ?></textarea>

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
									<button class="button is-small is-success" type="submit" <?= isset($edit) && $AssetsAccess->update == 0 || $AssetsAccess->write == 0 ? 'disabled' : '' ?>>
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
	</div>
</section>
<script>
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
