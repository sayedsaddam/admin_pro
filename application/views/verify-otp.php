
	<div class="container">
		<div class="columns is-centered">

			<div class="column is-half">

				<?php if($success = $this->session->flashdata('otp_sent')): ?>
					<div class="notification is-info">
						<button class="delete"></button>
						<?= $success; ?>
					</div>
				<?php elseif($failed = $this->session->flashdata('login_failed')): ?>
					<div class="notification is-danger">
						<button class="delete"></button>
						<?= $failed; ?>
					</div>
				<?php endif; ?>

				<form id="login-form" class="box" action="<?= base_url('login/verify_and_login'); ?>" method="post">

					<div class="field">
						<label class="label">Verification Code</label>
						<div class="control">
							<input class="input is-medium" id="user-password" name="otp" type="password" placeholder="********">
							<small>Please enter the 6-digit code sent to your email.</small>
						</div>
					</div>

					<div class="columns">	

					</div>

					<button class="button is-primary is-fullwidth is-medium">Continue Sign In</button>
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