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
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Items"
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
								<a href="<?= base_url("admin/employee") ?>"
									class="button is-small <?= (isset($employees_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Employees List</span>
								</a>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/add_employee'); ?>'"
									class="button is-small <?= isset($add_page) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</button>
							</p>
						</div>
					</div>
				</div>

				<form
					action="<?php if(empty($edit)){ echo base_url('admin/employee_save'); }else{ echo base_url('admin/update_employ'); } ?>"
					method="POST">
					<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">User Name <span
											class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="text" name="user_name" id="" class="input is-small"
											value="<?= !empty($edit) ? $edit->username : '' ?>" type="text"
											placeholder="user name ..." required="">
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
									<label class="label is-small">Full Name <span
											class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="text" name="full_name" id="" class="input is-small"
											value="<?= !empty($edit) ? $edit->fullname : '' ?>" type="text"
											placeholder="full name ..." required="">
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
							<div class="control">
								<label class="label is-small">Location <span class="has-text-danger">*</span></label>
								<div class="select is-small is-fullwidth"> 

                                    <select name="location" id="location" required>
												<?php if(!isset($edit)): ?>
												<option selected disabled value="">Select a City</option>
												<?php endif ?>
												<?php if(!empty($edit)): ?>
												<option value="<?= $edit->location; ?>"
													<?php !empty($edit) ? 'selected' : '' ?>><?= $edit->name; ?>
												</option>
												<?php endif; ?>
											</select>
								</div>
							</div>
						</div>
						<div class="column">
							<div class="control">

								<fieldset>
									<div class="field">
										<label class="label is-small">Email <span
												class="has-text-danger">*</span></label>
										<div class="control has-icons-left">
											<input type="email" name="email" id="" class="input is-small"
												value="<?= !empty($edit) ? $edit->email : '' ?>" type="text"
												placeholder="example@yahoo.com ..." required="">
											<span class="icon is-small is-left">
												<i class="fas fa-envelope-square"></i>
											</span>
										</div>
									</div>
								</fieldset>
							</div>
						</div>
					</div>


					<div class="columns">
						<div class="column">
							<div class="control">
								<label class="label is-small">Phone No <span class="has-text-danger">*</span></label>
								<div class="is-small is-fullwidth">
									<input type="number" name="phone" id="" class="input is-small"
										value="<?= !empty($edit) ? $edit->phone : '' ?>" type="text"
										placeholder="034354556554 ..." required="">
								</div>
							</div>
						</div>
						<div class="column">
							<label class="label is-small">Dapartment <span class="has-text-danger">*</span></label>
							<div class="select select is-small is-fullwidth">

								<select name="department" id="" required>
									<?php if(!isset($edit)): ?>
									<option selected disabled value="">Select Department</option>
									<?php endif ?>
									<?php if(!empty($edit)): ?>
									<option value="<?= $edit->department; ?>" <?php !empty($edit)? 'selected' : '' ?>>
										<?= $edit->department; ?>
									</option>
									<?php endif; ?>
                                    
									<option value="Marketing">Marketing</option>
									<option value="Operations">Operations</option>
									<option value="Sales">Sales</option>
									<option value="Finance">Finance</option>
									<option value="Admin (Super Admin)">Admin (Super Admin)</option>
									<option value="Design">Design</option>
									<option value="Construction">Construction</option>
									<option value="Human Resource">Human Resource</option>
									<option value="Senior Management">Senior Management</option>
									<option value="CCD">CCD</option> 
								</select>
							</div>
						</div>
					</div>
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Region </label>
									<div class="control has-icons-left">
										<input type="text" name="region" id="" class="input is-small"
											value="<?= !empty($edit) ? $edit->region : '' ?>" placeholder="region ...">
										<span class="icon is-small is-left">
											<i class="fas fa fa-globe"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>

						<div class="column">
							<label class="label is-small"> DOB <span class="has-text-danger">*</span></label>
							<div class="is-small is-fullwidth">
								<input type="date" name="dob" id="" class="input is-small"
									value="<?= !empty($edit) ? $edit->dob : '' ?>" placeholder="region ...">
							</div>
						</div>
					</div>

					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Joining Date</label>
									<div class="control">
										<input type="date" name="doj" id="" class="input is-small"
											value="<?= !empty($edit) ? $edit->doj : '' ?>" placeholder="joining ...">
									</div>
								</div>
							</fieldset>
						</div>

						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Address</label>
									<div class="control has-icons-left">
										<textarea class="textarea is-small" name="address" rows="1" id=""
											placeholder="some detail"><?= !empty($edit) ? $edit->address : '' ?></textarea>
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
	</div>
</section>
<script>
 

</script>
