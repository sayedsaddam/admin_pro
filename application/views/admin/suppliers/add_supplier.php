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
						<form action="<?= base_url('admin/search_suppliers') ?>" method="GET">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Suppliers"
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
					<div class="column is-narrow is-hidden-touch">
						<div class="field has-addons">
							<p class="control">
								<a href="<?= base_url("admin/suppliers") ?>"
									class="button is-small <?= (isset($suppliers_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Suppliers List</span>
								</a>
							</p>
							<?php if($SuppliersAccess->write == 1) : ?>
							<p class="control">
								<a href="<?= base_url("admin/add_supplier") ?>"
									class="button is-small <?= (isset($add_supplier_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</a>
							</p>
							<?php endif ?>
						</div>
					</div>
				</div>
				<form
					action="<?= empty($edit_supplier) ? base_url('admin/add_supplier_request') : base_url('admin/edit_supplier_request') ?>"
					method="POST">
					<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
					<div class="columns">
						<div class="column">
							<div class="control">
								<label class="label is-small">Location <span class="has-text-danger">*</span></label>
								<div class="control has-icons-left">
									<span class="select is-small is-fullwidth">
										<select name="location" id="" class="browser-default custom-select ">
											<?php if(!isset($edit_item)): ?>
											<option disabled value="">Select Location</option>
											<?php endif ?>
											<?php if(!empty($locations)): foreach($locations as $loc): ?>
											<?php if ($loc->id == $this->session->userdata('location') || $this->session->userdata('user_role') == '1') : ?>
											<option value="<?= $loc->id; ?>"
												<?= !empty($edit) && $edit->id == $loc->id ? 'selected' : '' ?>>
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
						<div class="column">
							<div class="field">
								<label class="label is-small">Name <span class="has-text-danger">*</span></label>
								<div class="control has-icons-left">
									<input type="text" name="name" id="" class="input is-small" value="" type="text"
										placeholder="e.g John Doe" required="">
									<span class="icon is-small is-left">
										<i class="fas fa-user"></i>
									</span>
								</div>
							</div>
						</div>
					</div>

					<div class="columns">
						<div class="column">
							<div class="control">
								<div class="field">
									<label class="label is-small">Email <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="email" name="email" id="" class="input is-small" value=""
											type="text" placeholder="e.g example@domain.com" required="">
										<span class="icon is-small is-left">
											<i class="far fa-envelope"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="column">
							<div class="control">
								<label class="label is-small">Phone No <span class="has-text-danger">*</span></label>
								<div class="control has-icons-left">
									<input type="text" name="phone" id="" class="input is-small" value="" type="text"
										placeholder="e.g +92-333-1234567" required="">
									<span class="icon is-small is-left">
										<i class="fas fa-phone"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="columns">
						<div class="column">
							<div class="control">
								<label class="label is-small">Catergory <span class="has-text-danger">*</span></label>
								<div class="control has-icons-left">
									<span class="select is-small is-fullwidth">
										<select name="category" class="browser-default custom-select" required>
											<?php if(!isset($edit_item)): ?>
											<option disabled value="">Select Category</option>
											<?php endif ?>
											<?php if(!empty($categories)): foreach($categories as $cat): ?>
											<option value="<?= $cat->id; ?>"
												<?= !empty($edit) && $edit->id == $cat->id ? 'selected' : '' ?>>
												<?= ucwords($cat->cat_name); ?>
											</option>
											<?php endforeach; endif; ?>
										</select>
									</span>
									<span class="icon is-small is-left">
										<i class="fas fa-tag"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">NTN</label>
									<div class="control has-icons-left">
										<input type="text" name="ntn_number" id="" class="input is-small" value=""
											placeholder="e.g 0622438-9">
										<span class="icon is-small is-left">
											<i class="fas fa fa-list-ol"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
					</div>

					<div class="columns">
						<div class="column">
							<div class="control">
								<label class="label is-small">Rating <span class="has-text-danger">*</span></label>
								<div class="control has-icons-left">
									<input type="number" name="rating" class="input is-small" min="1" max="5"
										type="text" placeholder="1-5" required>
									<span class="icon is-small is-left">
										<i class="fas fa-sort-numeric-up"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Address <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="text" name="address" class="input is-small"
											placeholder="e.g House No. 5, ST No. 1, Main Boulevard" required>
										<span class="icon is-small is-left">
											<i class="fas fa fa-home"></i>
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
									<button class="button is-small is-success" type="submit"  <?= $SuppliersAccess->write != 1 ? 'disabled' : '' ?>>
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
