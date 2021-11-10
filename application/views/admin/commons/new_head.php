<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	

	<!-- Bulma Core CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">

	<!-- Bulma Modal Core File -->
	<script src="<?= base_url('assets/js/bulma-modal.js'); ?>"></script>

	<!-- JQuery -->
	<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>

	<!-- Chart Library -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

	<!-- JQuery UI -->
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
	<link href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css" rel="stylesheet">
	
	<!-- custom css -->
	<link href="<?= base_url('assets/custom/custom.css'); ?>" rel="stylesheet">
	<title><?= $title; ?></title>
</head>

<?php if(!isset($login_page)) : ?>

<body>
	<section class="hero is-small is-primary is-hidden-print" style="background-color:#15BCA1;">
		<div class="hero-body">
			<div class="columns is-vcentered">
				<div class="column has-text-left is-narrow">
					<img src="https://s2smark.com/assets/img/logo/s2s-logo-1.png"
						style="filter: invert(.5) brightness(2);" width="200" title="S2S Marketing Logo">
				</div>
				<div class="column is-centered has-text-centered">
					<h3 class="is-title" style="font-size: 30px;"><span class="viewing"></span> people are watching, be careful...</h3>
				</div>
				<div class="column is-right is-narrow is-hidden-touch">
					<div class="dropdown is-right is-hoverable">
						<div class="dropdown-trigger">
							<button class="button is-primary" aria-haspopup="true" aria-controls="dropdown-menu2"
								style="background-color: #15BCA1;">
								<span class="is-capitalized"><?= $this->session->userdata('fullname') ?></span>
								<span class="icon is-small is-size-7">
									<i class="fas fa-angle-down" aria-hidden="true"></i>
								</span>
							</button>
						</div>
						<div class="dropdown-menu" id="dropdown-menu2" role="menu">
							<div class="dropdown-content">
								<a href="<?= base_url('/admin/dashboard/') ?>" class="dropdown-item">
									<i class="fas fa-user-tie mr-2" aria-hidden="true"></i> Profile Information
								</a>
								<?php if($this->session->userdata('user_role') == 1) : ?>
								<a href="<?= base_url('/admin/acl/') ?>" class="dropdown-item">
									<i class="fas fa-sliders-h mr-2" aria-hidden="true"></i> Access Control List
								</a>
								<?php endif ?>
								<hr class="dropdown-divider">
								<a href="<?= base_url('login/logout') ?>" class="dropdown-item">
									<i class="fas fa-sign-out-alt mr-2" aria-hidden="true"></i> Logout
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php else: ?>

	<body style="background-color:#fbfbfb;">
		<section class="section" style="height: 100vh;">
			<section class="hero is-small is-primary is-hidden-print" style="background-color:#fbfbfb;">
				<div class="hero-body">
					<div class="columns is-centered">
						<div class="column has-text-centered">
							<img src="https://s2smark.com/assets/img/logo/s2s-logo-1.png" width="200"
								title="S2S Marketing Logo">
						</div>
					</div>
				</div>
			</section>
			<?php endif ?>
