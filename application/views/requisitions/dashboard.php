<?php $session = $this->session->userdata('user_role'); ?>
<?php $session = $this->session->userdata('user_role'); ?>
<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" id="custom-sidebar">
		<?php $this->view('requisitions/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section py-5">

				<?php $this->view('admin/commons/breadcrumb'); ?>

				<div class="tile is-ancestor">
					<!-- left card start -->
					<div class="tile is-parent">
						<div class="tile is-child box bg-secondary">
							<div class="tile is-parent">
								<div class="tile is-child">
									<div class="columns is-vcentered">
										<div class="column">
											<div class="is-size-5">Request Statistics</div>

										</div>
									</div>

								</div>
							</div>
							<div class="tile is-parent">
								<a href="<?= base_url('requisitions/request_list/3') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Pending Request</div> 

									<div class="has-text-weight-semibold is-size-10"><span
											class="has-text-warning is-centered is-half"> <?= $pending_requests; ?> </span>
									</div>

								</a>
								<a href="<?= base_url('requisitions/request_list/2') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Process Request</div>
									<!-- <div class="has-text-weight-semibold is-size-6">Process</div> -->

									<div class="has-text-weight-semibold is-size-10"><span class="has-text-info"><?= $process_requests; ?></span>
									</div>
								</a>

							</div>

							<div class="tile is-parent">
								<a href="<?= base_url('requisitions/request_list/1') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Approved Request</div>
									<!-- <div class="has-text-weight-semibold is-size-6">Approved</div> -->

									<div class="has-text-weight-semibold is-size-10"><span
											class="has-text-success is-centered is-half"> <?= $approved_requests; ?> </span>
									</div>

								</a>
								<a href="<?= base_url('requisitions/request_list/0') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Rejected Request</div>
									<!-- <div class="has-text-weight-semibold is-size-6">Rejected</div> -->

									<div class="has-text-weight-semibold is-size-10"><span class="has-text-danger"><?= $rejected_requests; ?></span>
									</div>
								</a>

							</div>


						</div>
					</div>
					<!-- left card end -->

					<!-- right card start -->

					<div class="tile is-parent">
						<div class="tile is-child box bg-secondary">
							<div class="tile is-parent">
								<div class="tile is-child">
									<div class="columns is-vcentered">
										<div class="column">
											<div class="is-size-5">Item Statistics</div>

										</div>
									</div>

								</div>
							</div>
							<div class="tile is-parent">
								<a href="<?= base_url('requisitions/user_asset_list')?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Assigned</div>
									<!-- <div class="has-text-weight-semibold is-size-6">Electronics</div> -->

									<div class="has-text-weight-light is-size-10"><span
											class="has-text-info is-centered is-half"> <?= $CountTotalAssignItem; ?> </span>
									</div>

								</a>
								<a href="<?= base_url('requisitions/user_asset_list/1')?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Assigned</div>
									<!-- <div class="has-text-weight-semibold is-size-6">Furniture</div> -->

									<div class="has-text-weight-light is-size-10"><span class="has-text-success"><?= $CountAssignedItem; ?></span>
									</div>
								</a>

							</div>

							<div class="tile is-parent">
								<a href="<?= base_url('requisitions/user_asset_list/0')?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Returned Item</div>
									<div class="has-text-weight-light is-size-10"><span
											class="has-text-danger is-centered is-half"> <?= $CountReturnedItem; ?> </span>
									</div>

								</a> 

							</div>

						</div>
					</div>

					<!-- right card end -->

				</div>

			</div>
		</div>
	</div>
</section>
