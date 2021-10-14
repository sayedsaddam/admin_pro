<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<!-- Google Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

	<!-- Bulma Core CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">

	<!-- Material Design Bootstrap -->
	<link href="<?= base_url('assets/css/mdb.min.css'); ?>" rel="stylesheet">
	<!-- JQuery -->
	<script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/select2.full.min.js'); ?>"></script>
	<!-- custom css -->
	<link href="<?= base_url('assets/custom/custom.css'); ?>" rel="stylesheet">
	<title><?php echo $title; ?></title>
	<!-- <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Open+Sans:400,700,800|Roboto:400,700,900" rel="stylesheet"> -->
</head>

<?php if(!isset($login_page)) : ?>

<body>
	<section class="hero is-small is-primary is-hidden-print" style="background-color:#15BCA1;">
		<div class="hero-body">
			<div class="columns is-centered">
				<div class="column has-text-centered">
					<img src="https://s2smark.com/assets/img/logo/s2s-logo-1.png"
						style="filter: invert(.5) brightness(2);" width="200">
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
							<img src="https://s2smark.com/assets/img/logo/s2s-logo-1.png" width="200">
						</div>
					</div>
				</div>
			</section>
			<?php endif ?>
