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
	<!-- Select2 cdn link -->
	<link rel='stylesheet' type='text/css'
		href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css' />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js">
	</script>


</head>

<?php if(!isset($login_page)) : ?>

<header>
	<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
		<div class="navbar-brand">
			<a class="navbar-item" href="https://bulma.io">
				<img src="https://s2smark.com/assets/img/logo/s2s-logo-1.png" width="100%"
					style="filter: invert(.5) brightness(2);">
			</a>

			<a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
				data-target="navbarBasicExample">
				<span aria-hidden="true"></span>
				<span aria-hidden="true"></span>
				<span aria-hidden="true"></span>
			</a>
		</div>

		<div id="navbarBasicExample" class="navbar-menu">
			<div class="navbar-start">
				<a href="<?= base_url('admin/dashboard') ?>" class="navbar-item">
					Home
				</a>
				<div class="navbar-item">
					<span class="has-text-white viewing mr-1">0</span>others online, including management.
				</div>
			</div>

			<div class="navbar-end">
				<div class="navbar-item">
					<div class="navbar-item has-dropdown is-hoverable">
						<a class="navbar-link">
							<?= $this->session->userdata('fullname') ?>
						</a>
						<div class="navbar-dropdown is-right">
							<a href="<?= base_url('/admin/dashboard/') ?>" class="dropdown-item">
								<i class="fas fa-user-tie mr-2" aria-hidden="true"></i> Profile Information
							</a>
							<?php if($this->session->userdata('user_role') == 1) : ?>
							<a href="<?= base_url('/admin/acl/') ?>" class="dropdown-item">
								<i class="fas fa-sliders-h mr-2" aria-hidden="true"></i> Access Control List
							</a>
							<?php endif ?>
							<hr class="navbar-divider">
							<a href="<?= base_url('login/logout') ?>" class="dropdown-item" data-no-instant>
								<i class="fas fa-sign-out-alt mr-2" aria-hidden="true"></i> Logout
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>
<!-- <div class="column is-centered has-text-centered">
	
</div> -->
<body>
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
