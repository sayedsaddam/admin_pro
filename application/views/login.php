
	<div class="container">
		<div class="columns is-centered">

			<div class="column is-half">
				<?php if($failed = $this->session->flashdata('not_found')): ?>
					<div class="notification is-danger">
						<button class="delete"></button>
						<?= $failed; ?>
					</div>
				<?php endif; ?>
				<form id="login-form" class="box" action="<?= base_url('login/authenticate'); ?>" method="post">

					<div class="field">
						<label class="label">Email</label>
						<div class="control">
							<input class="input is-medium" id="user-name" name="email" type="email"
								placeholder="e.g. abc@example.com">
						</div>
					</div>

					<div class="field">
						<label class="label">Password</label>
						<div class="control">
							<input class="input is-medium" id="user-password" name="password" type="password" placeholder="********">
						</div>
					</div>

					<div class="columns">

						<div class="column">

							<div class="field">
								<label class="checkbox">
									<input type="checkbox"> Remember me
								</label>
							</div>

						</div>

						<div class="column">

							<div class="field has-text-right">

								<label>

									<a class="has-text-primary" href="<?php echo base_url('/reset'); ?>">Forgot password</a>

								</label>

							</div>

						</div>

					</div>

					<button class="button is-primary is-fullwidth is-medium">Sign in</button>
				</form>
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
</script>
