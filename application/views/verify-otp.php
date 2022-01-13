
	<div class="container">
		<div class="columns is-centered">

			<div class="column is-half">

				<?php if($success = $this->session->flashdata('otp_sent')): ?>
					<div class="notification is-info is-light">
						<button class="delete"></button>
						<?= $success; ?>
					</div>
				<?php elseif($failed = $this->session->flashdata('login_failed')): ?>
					<div class="notification is-danger is-light">
						<button class="delete"></button>
						<?= $failed; ?>
					</div>
				<?php endif; ?>

				<form id="login-form" class="box" action="<?= base_url('login/verify_and_login'); ?>" method="post">

					<div class="field">
						<label class="label">Verification Code (OTP)</label>
						<div class="control">
							<input type="hidden" name="otp" id="otp-full" />
							<div id="otp" class="is-flex justify-center">
								<input class="input is-medium form-control form-control-solid" type="text" id="first" maxlength="1" autocomplete="off" />
								<input class="ml-4 input is-medium form-control form-control-solid" type="text" id="second" maxlength="1" autocomplete="off" />
								<input class="ml-4 input is-medium form-control form-control-solid" type="text" id="third" maxlength="1" autocomplete="off" />
								<input class="ml-4 input is-medium form-control form-control-solid" type="text" id="fourth" maxlength="1" autocomplete="off" />
								<input class="ml-4 input is-medium form-control form-control-solid" type="text" id="fifth" maxlength="1" autocomplete="off" />
								<input class="ml-4 input is-medium form-control form-control-solid" type="text" id="sixth" maxlength="1" autocomplete="off" />
							</div>
							<div class="mt-2">Please enter the 6-digit code sent to your email.</div>
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
<script>
	function OTPInput() {
	const inputs = document.querySelectorAll('#otp > *[id]');
	for (let i = 0; i < inputs.length; i++) {
		inputs[i].addEventListener('keydown', function(event) {
		if (event.key === "Backspace") {
			inputs[i].value = '';
			if (i !== 0)
			inputs[i - 1].focus();
		} else {
			if (i === inputs.length - 1 && inputs[i].value !== '') {
			return true;
			} else if (event.keyCode > 47 && event.keyCode < 58) {
			inputs[i].value = event.key;
			if (i !== inputs.length - 1)
				inputs[i + 1].focus();
			event.preventDefault();
			} else if (event.keyCode > 64 && event.keyCode < 91) {
			inputs[i].value = String.fromCharCode(event.keyCode);
			if (i !== inputs.length - 1)
				inputs[i + 1].focus();
			event.preventDefault();
			}
		}
		});
	}
	}
	$("#login-form").submit(function (event) {
		$(".button").addClass('is-loading');
		var otp_first = document.getElementById('first').value;
		var otp_second = document.getElementById('second').value;
		var otp_third = document.getElementById('third').value;
		var otp_fourth = document.getElementById('fourth').value;
		var otp_fifth = document.getElementById('fifth').value;
		var otp_sixth = document.getElementById('sixth').value;
		$("#otp-full").val(otp_first + otp_second + otp_third + otp_fourth + otp_fifth + otp_sixth);
	});
	OTPInput();
</script>
<style>
	.form-control {
		-webkit-transition: none;
		transition: none;
		text-align: center
	}

	.form-control:focus {
		outline: 0;
	}

	.form-control.form-control-solid {
		transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
	}
	.form-control.form-control-solid:active,
	.form-control.form-control-solid.active,
	.form-control.form-control-solid:focus,
	.form-control.form-control-solid.focus {
		transition: color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
	} 
	</style>