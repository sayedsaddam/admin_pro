<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" id="custom-sidebar">
		<?php $this->view('requisitions/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section py-5">
				<div class="columns">
					<div class="column is-hidden-print">
						<?php $this->view('requisitions/commons/breadcrumb'); ?>
					</div>
				</div>
				<div class="columns is-hidden-print" >
					<div class="column is-hidden-print">
						<form action="<?= base_url('requisitions/search_request'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" id="myInput" type="search"
										placeholder="Search Request"
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
						<div class="field has-addons is-hidden-print">
							<p class="control is-hidden-print">
								<a href='<?= base_url('requisitions/request_list'); ?>'
									class="button is-small <?= isset($add_page) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Request List</span>
								</a>
							</p>
							<p class="control is-hidden-print">
								<a href="<?= base_url("requisitions/add_request") ?>"
									class="button is-small <?= (isset($addRequestPage)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add Request</span>
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
					action="<?= empty($view) ? base_url('requisitions/save_request') : base_url('requisitions/edit_request') ?>"
					method="POST">
					<input type="hidden" value="<?php echo $this->uri->segment(3); ?>">
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Employee Name </label>
									<div class="control has-icons-left">
										<input type="text" class="input is-small"
											value="<?= $view->fullname; ?>" type="text"
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
									<label class="label is-small">Employee Code </label>
									<div class="control has-icons-left">
										<input type="text" class="input is-small"
											value="S2S-<?= $view->id; ?>" type="text"
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
							<fieldset>
								<div class="field">
									<label class="label is-small">Location</label>
									<div class="control has-icons-left">
										<input type="text" class="input is-small"
											value="<?= $view->loc_name; ?>" type="text"
											placeholder="e.g location" required disabled>
								<span class="icon is-small is-left">
									<i class="fas fa-street-view"></i>
								</span>
									</div>
								</div>
							</fieldset>
						</div> 
						<div class="column">
							<div class="control">

								<fieldset>
									<div class="field">
										<label class="label is-small">Requisition Date </label>
										<div class="control has-icons-left">
											<input type="" class="input is-small" 
												value="<?= date('M d, Y', strtotime($view->date)); ?>" required disabled>
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
							<fieldset>
								<div class="field">
									<label class="label is-small">Department</label>
									<div class="control has-icons-left">
										<input type="text" class="input is-small"
											value="<?= $view->department; ?>" type="text" required disabled>
								<span class="icon is-small is-left">
									<i class="fas fa-building"></i>
								</span>
									</div>
								</div>
							</fieldset>
						</div> 					
					
                        <div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Company</label>
									<div class="control has-icons-left">
										<input type="text" class="input is-small"
											value="<?= $view->company_name; ?>" type="text" required disabled>
								<span class="icon is-small is-left">
									<i class="fas fa-building"></i>
								</span>
									</div>
								</div>
							</fieldset>
						</div> 
					</div>
					<hr>
                    <div class="columns">
						<div class="column">
							<div class="columns"> 
								<div class="column">


								<fieldset>
								<div class="field">
									<label class="label is-small">Item</label>
									<div class="control has-icons-left">
										<input type="text" class="input is-small"
											value="<?= $view->item_name; ?>" type="text" readonly>
								<span class="icon is-small is-left">
									<i class="fas fa-luggage-cart"></i>
								</span>
									</div>
								</div>
							</fieldset>
									
 								</div>
								<div class="column">

								<fieldset>
								<div class="field">
									<label class="label is-small">Requirements</label>
									<div class="control has-icons-left">
										<input type="text" class="input is-small"
											value="<?= $view->item_requirement; ?>" type="text" readonly>
								<span class="icon is-small is-left">
									<i class="fas fa-asterisk"></i>
								</span>
									</div>
								</div>
							</fieldset>
								</div>
							</div>
						</div>
						
					</div> 

					<div class="columns">
						<div class="column">
						<fieldset>
								<div class="field">
									<label class="label is-small">Quantity</label>
									<div class="control has-icons-left">
										<input type="number" class="input is-small"
											value="<?= $view->item_qty; ?>" type="text" readonly>
								<span class="icon is-small is-left">
									<i class="fas fa-sort-numeric-up"></i>
								</span>
									</div>
								</div>
							</fieldset>
						</div> 
						<div class="column"></div>

					</div> 
					
					<hr>
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Reason for Purchase </label>
									<div class="control">
										<textarea name="reason" class="textarea is-small" rows="4" value="" readonly><?= $view->item_desc; ?></textarea>
									</div>
								</div>
							</fieldset>
						</div>
					</div> 

					<div class="columns">
						<div class="column"></div>
						<div class="column">

						<div class="buttons is-pulled-right is-hidden-print">
						<button onClick="window.print();" type="button" class="button is-small print">
									<span class="icon is-small">
										<i class="fas fa-print"></i>
									</span>
									<span>Print</span>
								</button>
										</div>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	$(".print").focus(function () {
		$("input").css("border", "none"); 
		$("textarea").css("border", "none"); 
	});

</script>
