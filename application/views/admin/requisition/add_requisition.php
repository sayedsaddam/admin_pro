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
						<form action="<?= base_url('admin/search_requistion') ?>" method="GET">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Employees"
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
								<div class="ml-1 control">
									<a href="<?= base_url('report/employee_report') ?>" class="button is-small">
										<span class="icon is-small">
											<i class="fas fa-sort-alpha-down"></i>
										</span>
										<span>Filter</span>
									</a>
								</div>
							</div>
						</form>
					</div>
					<div class="column is-hidden-touch is-narrow">
						<div class="field has-addons">
							<p class="control">
								<a href="<?= base_url("admin/add_requisition") ?>"
									class="button is-small <?= (isset($employees_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add Requsition</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/requisition_list'); ?>'"
									class="button is-small <?= isset($add_page) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Request List</span>
								</a>
							</p>
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

				<form
					action="<?php if(empty($edit)){ echo base_url('admin/employee_save'); }else{ echo base_url('admin/update_employ'); } ?>"
					method="POST">
					<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Employee Name <span
											class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="text" class="input is-small"
											value="<?= $this->session->userdata('fullname') ?>" type="text"
											placeholder="e.g John Doe" required disabled>
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
									<label class="label is-small">Employee Code <span
											class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="text" class="input is-small"
											value="S2S-<?= $this->session->userdata('id') ?>" type="text"
											placeholder="e.g S2S-123" required disabled>
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
								<label class="label is-small">Location <span class="has-text-danger">*</span></label>
								<div class="select is-small is-fullwidth">
									<select required disabled>
										<option selected disabled value="">Select a City</option>
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
										<label class="label is-small">Requisition Date <span
												class="has-text-danger">*</span></label>
										<div class="control has-icons-left">
											<input type="date" class="input is-small"
												value="<?= date("Y-m-d") ?>" required disabled>
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
							<div class="control has-icons-left">
								<label class="label is-small">Department <span class="has-text-danger">*</span></label>
								<div class="select is-small is-fullwidth">
									<select required disabled>
										<option selected disabled value="">Select a City</option>
									</select>
									
								<span class="icon is-small is-left">
									<i class="fas fa-street-view"></i>
								</span>
								</div>
							</div>
						</div>					
						<div class="column">
							<div class="control has-icons-left">
								<label class="label is-small">Company <span class="has-text-danger">*</span></label>
								<div class="select is-small is-fullwidth">
									<select required disabled>
										<option selected disabled value="">Select a City</option>
									</select>
									
								<span class="icon is-small is-left">
									<i class="fas fa-street-view"></i>
								</span>
								</div>
							</div>
						</div>
					</div>
                    <hr>
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Region </label>
									<div class="control has-icons-left">
										<input type="text" name="region" id="" class="input is-small"
											value="<?= !empty($edit) ? $edit->region : '' ?>" placeholder="e.g KPK">
										<span class="icon is-small is-left">
											<i class="fas fa fa-location-arrow"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>

						<div class="column">
							<label class="label is-small">Date of Birth <span class="has-text-danger">*</span></label>
							<div class="is-small is-fullwidth">
								<?php if(!empty($edit)){ $dateob = strtotime($edit->dob); $date_of_birth= date('Y-m-d', $dateob);}?>
								<div class="control has-icons-left">
									<input type="date" name="dob" id="" class="input is-small"
									value="<?= !empty($edit) ? $date_of_birth : '' ?>" placeholder="e.g 31/01/1990">
									<span class="icon is-small is-left">
										<i class="fas fa fa-birthday-cake"></i>
									</span>
								</div>
							</div>
						</div>
					</div>

					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Joining Date</label>
									<div class="control has-icons-left">
										<?php if(!empty($edit)){ $dateoj = strtotime($edit->doj); $date_of_joining = date('Y-m-d', $dateoj); }?>
										<input name="doj" class="input is-small" type="date" required
											value="<?= !empty($edit) ? $date_of_joining : '' ?>"
											placeholder="e.g 31/01/2010">
										<span class="icon is-small is-left">
											<i class="fas fa fa-table"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>

						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Address</label>
									<div class="control has-icons-left">
										<input class="input is-small" name="address" rows="1" id=""
											placeholder="e.g Street No.1, Block No.E, Sector 11" value="<?= !empty($edit) ? $edit->address : '' ?>"></input>
										<span class="icon is-small is-left">
											<i class="fas fa-compass"></i>
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
									<label class="label is-small">User Role <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
									<div class="select select is-small is-fullwidth">
										<select name="user_role" required>
											<option selected disabled value="">Select User Role</option>
											<?php foreach ($user_roles as $data) : ?>
												<option value="<?= $data->id ?>" <?= isset($edit->user_role) && $edit->user_role == $data->id ? 'selected' : '' ?>><?= $data->title ?></option>
											<?php endforeach ?>
										</select>
										<div class="icon is-small is-left">
											<i class="fas fa-user-tag"></i>
										</div>
									</div>
								</div>
							</fieldset>
						</div>

						<div class="column">
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