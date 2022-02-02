<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('assets/css/fontawesome/all.min.css'); ?>">

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
	<button class="navbar-burger toggle" id="menu">
      <span></span>
      <span></span>
      <span></span>
    </button>
	
<!-- <div class="column is-centered has-text-centered">
	
</div> -->
<body>
	<?php else: ?>

	<body style="background-color:#fcfcfc;">
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
