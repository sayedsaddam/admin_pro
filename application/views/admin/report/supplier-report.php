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
				<div class="columns">
					<div class="column">
						<form action="<?= base_url('admin/search_suppliers') ?>" method="GET">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Suppliers Report"
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
								<a href='<?= base_url('report/supplier_report'); ?>'
									class="button is-small <?= isset($supplier_report) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Supplier</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('report/employee_report'); ?>'
									class="button is-small <?= isset($asset_report) ? 'has-background-primary-light' : '' ?>">
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
				<form action="<?= base_url('report/filter_supplier') ?>" method="get"> 
					<div class="columns">
						<div class="column">
							<div class="control">
								<label class="label is-small">Location</label>
								<div class="control has-icons-left">
									<span class="select is-small is-fullwidth">
										<select name="location" id="" class="browser-default custom-select "> 
											<option disabled value="" selected>Select Location</option>
											<?php foreach($locations as $loc): ?>
											<?php if ($loc->id == $this->session->userdata('location') || $this->session->userdata('user_role') == '1') : ?>
											<option value="<?= $loc->id; ?>" >
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
						<div class="column">
							<div class="field">
								<label class="label is-small">Name</label>
								<div class="control has-icons-left">
									<input type="text" name="name" id="" class="input is-small" value="" type="text"
										placeholder="e.g John Doe">
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
									<label class="label is-small">Email</label>
									<div class="control has-icons-left">
										<input type="email" name="email" id="" class="input is-small" value=""
											type="text" placeholder="e.g example@domain.com">
										<span class="icon is-small is-left">
											<i class="far fa-envelope"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="column">
							<div class="control">
								<label class="label is-small">Phone No</label>
								<div class="control has-icons-left">
									<input type="text" name="phone" id="" class="input is-small" value="" type="text"
										placeholder="e.g +92-333-1234567">
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
								<label class="label is-small">Catergory</label>
								<div class="control has-icons-left">
									<span class="select is-small is-fullwidth">
										<select name="category" class="browser-default custom-select" > 
											<option disabled value="" selected>Select Category</option> 
											<?php foreach($categories as $cat): ?>
											<option value="<?= $cat->id; ?>">
												<?= ucwords($cat->cat_name); ?>
											</option>
											<?php endforeach;?>
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
								<label class="label is-small">Rating</label>
								<div class="control has-icons-left">
									<input type="number" name="rating" class="input is-small" min="1" max="5"
										type="text" placeholder="1-5">
									<span class="icon is-small is-left">
										<i class="fas fa-sort-numeric-up"></i>
									</span>
								</div>
							</div>
						</div> 
                        <div class="column">

                        </div>
					</div>
					<div class="columns">
						<div class="column has-text-right">
							<div class="buttons is-pulled-right"> 
								<button class="button is-danger is-small is-outlined" type="reset">Reset Form</button>
								<p class="control">
									<button class="button is-small is-success" type="submit"  <?= $SuppliersAccess->write != 1 ? 'disabled' : '' ?>>
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
