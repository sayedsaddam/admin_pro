<style>
	.print:focus {
  outline: none;
  border: none;
  box-shadow: none;
}
</style>

<div class="container ">
	<div class="columns is-centered ">

		<div class="column is-three-quarters ">
			<img src="https://s2smark.com/assets/img/logo/s2s-logo-1.png" class="logo">
			<!-- <img src="<?= base_url('assets/img/logo/s2s-logo-1.png')?>" class="logo"> -->
			<br><br><br>
			<?php   
                  $email_id = $this->uri->segment(3); 
                  $id = base64_decode($email_id);
                //  echo $id;
$quotations = $this->Requisition_Model->VendorQuotation($id);
 
            ?>

<?php if($this->session->flashdata('success')) : ?>
				<div class="columns">
					<div class="column">
						<div class="notification is-success is-light">
							<button class="delete is-small"></button>
							<div class="columns is-vcentered">
								<div class="column is-size-14">
									<i class="fas fa-check pr-1"></i> <?= $message = $this->session->flashdata('success'); ?>
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
									<i class="fas fa-exclamation pr-1"></i> <?= $message = $this->session->flashdata('failed'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endif ?>


			<?php if(!empty($quotations->qut_id)){ ?>

			<form action="<?= base_url('login/save_quotation')?>" method="POST">
				<input type="hidden" name="quot_id" value="<?php echo $id; ?>">
				<div class="columns">
					<div class="column">
						<fieldset>
							<div class="field">
								<label class="label is-small">Request From </label>
								<div class="control has-icons-left">
									<input type="text" class="input is-small" value="<?= $quotations->fullname; ?>"
										type="text" placeholder="e.g John Doe" required disabled>
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
								<label class="label is-small">Requested To</label>
								<div class="control has-icons-left">
									<input type="text" class="input is-small" value="<?= $quotations->sup_name; ?>"
										type="text" placeholder="e.g S2S-123" required disabled>
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
									<input type="text" class="input is-small" value="<?= $quotations->loc_name; ?>"
										type="text" placeholder="e.g location" required disabled>
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
										<input type="" class="input is-small" value="<?=  date('M d, Y', strtotime($quotations->date)); ?>" required
											disabled>
										<span class="icon is-small is-left">
											<i class="fas fa-envelope"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
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
											<input type="text" class="input is-small" value="<?= $quotations->item; ?>"
												type="text" readonly>
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
										<label class="label is-small">Requirement</label>
										<div class="control has-icons-left">
											<input type="text" class="input is-small" name="requirement"
												value="<?= $quotations->item_requirement; ?>" placeholder="e.g laptop core i5 6th Gen">
											<span class="icon is-small is-left">
												<i class="fas fa-asterisk"></i>
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
										<label class="label is-small">Quantity</label>
										<div class="control has-icons-left">
											<input type="number" class="input is-small"
												value="<?= $quotations->quantity; ?>" type="text" readonly>
											<span class="icon is-small is-left">
												<i class="fas fa-sort-numeric-up"></i>
											</span>
										</div>
									</div>
								</fieldset>
							</div>
							<div class="column">
								<fieldset>
									<div class="field">
										<label class="label is-small">Price</label>
										<div class="control has-icons-left">
											<input type="text" class="input is-small" name="price" required
												value="<?= $quotations->price; ?>" type="text" placeholder="30,000 e.g">
											<span class="icon is-small is-left">
												<i class="fas fa-rupee-sign"></i>
											</span>
										</div>
									</div>
								</fieldset>
							</div>
						</div>

					</div>

				</div>
				<hr>
				<div class="columns">
					<div class="column">
						<fieldset>
							<div class="field">
								<label class="label is-small">Description (Quotation) </label>
								<div class="control">
									<textarea name="quotation" class="textarea is-small" rows="4" value=""
										placeholder="Quotation for product"><?= $quotations->description; ?></textarea>
								</div>
							</div>
						</fieldset>
					</div>
				</div>

				<div class="columns">
					<div class="column"></div>
					<div class="column">

						<div class="buttons is-pulled-right">
								<?php if(empty($quotations->price)){ ?>
							<button class="button is-danger is-small is-outlined" type="reset">Reset Form</button>
							<p class="control">
								<button class="button is-small is-success" type="submit">
									<span>Save and continue</span>
									<span class="icon is-small">
										<i class="fas fa-arrow-right"></i>
									</span>
								</button>
							</p>
							<?php } ?>
							<p class="control">
						<button onClick="window.print();" type="button" class="button is-small print">
									<span class="icon is-small">
										<i class="fas fa-print"></i>
									</span>
									<span>Print</span>
								</button>
							</p>
										</div>

						</div>
 
				</div> 

			</form>
			<?php } ?>
		</div>
	</div>

	<div class="columns is-centered">

		<div class="column is-half has-text-centered">

			<label class="has-text-grey">

				Department of Admin & Operations - S2S Marketing (Pvt.) Ltd. Islamabad, 44000.

			</label>

		</div>

	</div>

</div>
</section>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<script>
	$("#login-form").submit(function (event) {
		$(".button").addClass('is-loading');
		var userPassword = document.getElementById('user-password').value;
		var passwordBytes = CryptoJS.enc.Utf8.parse(userPassword);
		var sha1Hash = CryptoJS.SHA1(passwordBytes); 
		$("#user-password").val(sha1Hash);
	});

	$(".print").focus(function () {
		$("input").css("border", "none"); 
		$("textarea").css("border", "none"); 
	});
</script>
