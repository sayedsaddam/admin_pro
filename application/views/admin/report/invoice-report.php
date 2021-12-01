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
						<form action="<?= base_url('admin/search_invoices'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Invoices Report"
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
								<a href='<?= base_url('report/supplier_report'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Supplier</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('report/employee_report'); ?>'
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Employee</span>
								</a>
							</p> 
							<p class="control">
								<a href='<?= base_url('report/item_report'); ?>'
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Item</span>
								</a>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a href='<?= base_url('report/project_report'); ?>'
									class="button is-small <?= isset($add_asset) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Project</span>
								</a>
							</p>
							<?php endif ?>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a href='<?= base_url('report/invoice_report'); ?>'"
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
				<form action="<?php echo base_url('report/filter_invoice'); ?>" method="get"> 
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Invoice Number </label>
									<div class="control has-icons-left">
										<input type="number" name="inv_no" id="" class="input is-small"
											value="" type="text"
											placeholder="Invoice number ...">
										<span class="icon is-small is-left">
											<i class="fas fa-file-invoice"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
						<div class="column">
							<div class="control">
								<label class="label is-small">Suppliers</label>
								<div class="control has-icons-left">
									<span class="select is-small is-fullwidth">
										<select name="supplier" id="supplier">
											<option selected disabled value="">Select a Supplier</option>
											<?php foreach($suppliers as $supplier): ?>
											<option value="<?= $supplier->id; ?>">												<?= ucwords($supplier->sup_name); ?>
											</option>
											<?php endforeach; ?>
										</select>
									</span>
								</div>
							</div>
						</div> 

					</div>
					<div class="columns">

						<div class="column">
							<label class="label is-small">Location</label>
							<div class="control has-icons-left">
								<span class="select select is-small is-fullwidth">
									<select name="region" > 
										<option selected disabled value="">Select a Location</option>
										<?php foreach($locations as $loc): ?>
										<option value="<?= $loc->id; ?>">
											<?= $loc->name; ?>
										</option>
										<?php endforeach;?>
									</select>

									<span class="icon is-small is-left">
										<i class="fas fa-globe"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="column">
							<label class="label is-small">Project</label>
							<div class="control has-icons-left">
								<span class="select is-small is-fullwidth">
									<select name="project" > 
										<option selected disabled value="">Select a Project</option>
										<?php foreach($projects as $proj): ?>
										<option value="<?= $proj->id; ?>">
											<?= ucwords($proj->project_name); ?>
										</option>
										<?php endforeach;?>
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
									<label class="label is-small">Item</label>
									<div class="control has-icons-left">
										<input type="text" name="item_name" id="" class="input is-small"
											value="" type="text"
											placeholder="Item name ...">
										<span class="icon is-small is-left">
											<i class="fas fa-list"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div> 


						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Amount</label>
									<div class="control has-icons-left">
										<input type="number" name="amount" id="" class="input is-small"
											value=""
											placeholder="1-9,999,999">
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
									<label class="label is-small">Date</label>
									<div class="control has-icons-left">
										<input type="date" name="inv_date" id="" class="input is-small" value="">
										<span class="icon is-small is-left">
											<i class="far fa-calendar-alt"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
                        <div class="column"></div>
					</div> 

					<div class="columns">
						<div class="column has-text-right">
							<div class="buttons is-pulled-right"> 
								<button class="button is-danger is-small is-outlined" type="reset">Reset Form</button>
								<p class="control">
									<button class="button is-small is-success" type="submit"
										<?= isset($edit) && $AssetsAccess->update == 0 || $AssetsAccess->write == 0 ? 'disabled' : '' ?>>
										<span><?= 'Report' ?></span>
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
	$("#supplier").select2();

</script>
