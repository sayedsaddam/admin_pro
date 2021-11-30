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
						<form action="<?= base_url('report/filter_employee') ?>" method="GET">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Filter Employees"
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
                    
					<div class="column is-hidden-touch is-narrow is-hidden-print">
						<div class="field has-addons">
							<p class="control">
								<a href='<?= base_url('report/asset_report'); ?>'
									class="button is-small <?= isset($asset_report) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Assets</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('report/supplier_report'); ?>'"
									class="button is-small <?= isset($supplier_report) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Supplier</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('report/employee_report'); ?>'
									class="button is-small <?= isset($employees_filter) ? 'has-background-primary-light' : '' ?>">
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

				<?php if($this->session->flashdata('success')) : ?>
				<div class="columns">
					<div class="column">
						<div class="notification is-success is-light">
							<button class="delete is-small"></button>
							<div class="columns is-vcentered">
								<div class="column is-size-7">
									<i class="fas fa-check pr-1"></i>
									<?= $message = $this->session->flashdata('success'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php elseif($this->session->flashdata('failed')) : ?>
				<div class="columns">
					<div class="column">
						<div class="notification is-danger is-light">
							<button class="delete is-small"></button>
							<div class="columns is-vcentered">
								<div class="column is-size-7">
									<i class="fas fa-exclamation pr-1"></i>
									<?= $message = $this->session->flashdata('failed'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endif ?>

				<form action="<?php echo base_url('report/filter_employee'); ?>" method="get"> 
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Username </label>
									<div class="control has-icons-left">
										<input type="text" name="user_name" id="" class="input is-small"
											value="" type="text"
											placeholder="e.g john_doe">
										<span class="icon is-small is-left">
											<i class="fas fa-user-tie"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Fullname </label>
									<div class="control has-icons-left">
										<input type="text" name="full_name" id="" class="input is-small"
											value="" type="text"
											placeholder="e.g John Doe">
										<span class="icon is-small is-left">
											<i class="fas fa-signature"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
					</div>

					<div class="columns">
						<div class="column">
							<div class="control has-icons-left">
								<label class="label is-small">Location</label>
								<div class="select is-small is-fullwidth">
									<select name="location" id="location"> 
										<option selected disabled value="">Select a City</option> 
										<?php foreach($locations as $loc): ?>
										<option value="<?= $loc->id; ?>">
											<?= $loc->name; ?>
										</option>
										<?php endforeach; ?>
									</select> 
								<span class="icon is-small is-left">
									<i class="fas fa-street-view"></i>
								</span>
								</div>
							</div>
						</div>
						<div class="column">
							<div class="control">

								<fieldset>
									<div class="field">
										<label class="label is-small">Email</label>
										<div class="control has-icons-left">
											<input type="email" name="email" id="" class="input is-small"
												value="" type="text"
												placeholder="e.g user@example.com">
											<span class="icon is-small is-left">
												<i class="fas fa-envelope"></i>
											</span>
										</div>
									</div>
								</fieldset>
							</div>
						</div>
					</div>


					<div class="columns">
						<div class="column">
							<label class="label is-small">Phone No</label>
							<div class="control has-icons-left">
								<div class="is-small is-fullwidth">
									<input type="number" name="phone" id="" class="input is-small"
										value="" type="text"
										placeholder="e.g 03311234567">
									<span class="icon is-small is-left">
										<i class="fas fa-phone"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="column">
							<label class="label is-small">Dapartment</label>
							<div class="control has-icons-left">
								<div class="select select is-small is-fullwidth">
									<select name="department" id="">  
									<option selected disabled value="">Select Department</option> 
                                    <?php foreach($departments as $department): ?>
										<option value="<?= $department->id; ?>">
											<?= $department->department; ?>
										</option>
										<?php endforeach; ?> 
									</select>
									<div class="icon is-small is-left">
										<i class="fas fa-building"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="columns"> 

						<div class="column">
							<label class="label is-small">Date of Birth</label>
							<div class="is-small is-fullwidth"> 
								<div class="control has-icons-left">
									<input type="date" name="dob" id="" class="input is-small"
									value="" placeholder="e.g 31/01/1990">
									<span class="icon is-small is-left">
										<i class="fas fa fa-birthday-cake"></i>
									</span>
								</div>
							</div>
						</div>
						
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Joining Date</label>
									<div class="control has-icons-left">
 										<input name="doj" class="input is-small" type="date"
											value=""
											placeholder="e.g 31/01/2010">
										<span class="icon is-small is-left">
											<i class="fas fa fa-table"></i>
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
										<span><?=  'Report' ?></span>
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
