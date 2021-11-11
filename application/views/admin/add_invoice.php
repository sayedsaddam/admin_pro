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
						<form action="<?= base_url('admin/search_invoices'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Invoices"
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
								<button onclick="location.href='<?= base_url('admin/invoices'); ?>'"
									class="button is-small <?= isset($invoices) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Invoices List</span>
								</button>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/add_invoice'); ?>'"
									class="button is-small <?= isset($add_invoice) ? 'has-background-primary-light' : '' ?>">
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
					action="<?php if(empty($edit)){ echo base_url('admin/save_invoice'); }else{ echo base_url('admin/update_invoice'); } ?>"
					method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Invoice Number <span
											class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="number" name="inv_no" id="" class="input is-small" <?php if(!empty($edit)){echo 'disabled';} ?>
											value="<?php if(!empty($edit)){ echo $edit->inv_no; } ?>" type="text"
											placeholder="Invoice number ..." required="">
										<span class="icon is-small is-left">
										<i class="fas fa-file-invoice"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>

						<div class="column">
							<label class="label is-small">Supplier <span class="has-text-danger">*</span></label>
							<div class="control has-icons-left">
							<span class="select select is-small is-fullwidth">

								<select name="supplier" required <?php if(!empty($edit)){echo 'disabled';} ?>>
									<?php if(!isset($edit)): ?>
									<option selected disabled value="">Select a Supplier</option>
									<?php endif ?>
									<?php if(!empty($suppliers)): foreach($suppliers as $supplier): ?>
									<option value="<?= $supplier->id; ?>" <?php !empty($edit) ? 'selected' : '' ?>>
										<?= ucwords($supplier->sup_name); ?>
									</option>
									<?php endforeach; endif; ?>
								</select>
							</span>
							
							<span class="icon is-small is-left">
											<i class="fas fa-user"></i>
										</span>
							</div>
						</div>
					</div>
					<div class="columns">

						<div class="column">
							<label class="label is-small">Location <span class="has-text-danger">*</span></label>
							<div class="control has-icons-left">
							<span class="select select is-small is-fullwidth">
								<select name="region" id="" required <?php if(!empty($edit)){echo 'disabled';} ?>>
									<?php if(!isset($edit)): ?>
									<option selected disabled value="">Select a Location</option>
									<?php endif ?>
									<?php if(!empty($locations)): foreach($locations as $loc): ?>
									<option value="<?= $loc->id; ?>"
										<?php !empty($edit) && $edit->region == $loc->id ? 'selected' : '' ?>>
										<?= $loc->name; ?>
									</option>
									<?php endforeach; endif; ?>
								</select>
								
								<span class="icon is-small is-left">
											<i class="fas fa-globe"></i>
										</span>
							</span>
							</div>
						</div>

						<div class="column">
							<label class="label is-small">Project <span class="has-text-danger">*</span></label>
							<div class="control has-icons-left">
										<span class="select is-small is-fullwidth">
								<select name="project" required <?php if(!empty($edit)){echo 'disabled';} ?>>
									<?php if(!isset($edit)): ?>
									<option selected disabled value="">Select a Project</option>
									<?php endif ?>
									<?php if(!empty($projects)): foreach($projects as $proj): ?>
									<option value="<?= $proj->id; ?>" <?php !empty($edit) ? 'selected' : '' ?>>
										<?= ucwords($proj->project_name); ?>
									</option>
									<?php endforeach; endif; ?>
								</select>
										</span>
										<span class="icon is-small is-left">
										<i class="fa fa-tasks" aria-hidden="true"></i>
										</span>
							</div>
						</div>
					</div>
					<div class="columns">
						
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Item <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="text" name="item_name" id="" class="input is-small"
											value="<?php if(!empty($edit)){ echo $edit->item; } ?>" type="text"
											placeholder="Item name ..." required="">
										<span class="icon is-small is-left">
										<i class="fas fa-list"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
						
					<div class="column">
					<label class="label is-small">File <span class="has-text-danger">*</span></label>
								<div class="file is-small has-name is-fullwidth">
									<label class="file-label">
										<?php if(!empty($edit)){ ?>
										<input class="file-input" name="userfile" type="file" value="<?= $edit->file; ?>">
										<?php } else {?>
											  <input class="file-input" name="userfile" type="file" required> 
											  <?php } ?>
										<span class="file-cta">
											<span class="file-icon">
												<i class="fas fa-upload"></i>
											</span>
											<span class="file-label">
												Choose a file…
											</span>
										</span>
										<span class="file-name">
											Example.png
										</span>
									</label>
								</div>
							</div>

					</div>

					<div class="columns">

						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Amount <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="number" name="amount" id="" class="input is-small"
											value="<?php if(!empty($edit)){ echo $edit->amount; } ?>"
											placeholder="1-9,999,999" required="">
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
									<label class="label is-small">Date <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="date" name="inv_date" id="" class="input is-small"
											value="<?php if(!empty($edit)){ echo $edit->inv_date; } ?>" required="">
										<span class="icon is-small is-left">
											<i class="far fa-calendar-alt"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
					</div>
					<div class="columns">
						<div class="column is-6">
							<fieldset>
								<div class="field">
									<label class="label is-small">Description</label>
									<div class="control has-icons-left">
										<textarea class="textarea is-small" name="inv_desc" rows="1"
											placeholder="some detail"><?php if(!empty($edit)){ echo $edit->inv_desc; } ?></textarea>
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
									<button class="button is-small is-success" type="submit"
										<?= isset($edit) && $AssetsAccess->update == 0 || $AssetsAccess->write == 0 ? 'disabled' : '' ?>>
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


</script>
