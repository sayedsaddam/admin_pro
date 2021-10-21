<?php $session = $this->session->userdata('user_role'); ?>
<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" id="custom-sidebar">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section">
				<div class="columns">
					<div class="column">
						<?php $this->view('admin/commons/breadcrumb'); ?>
					</div>
				</div>
				<div class="columns">
					<div class="column">
						<div class="tile is-ancestor">
							<div class="tile is-parent">
								<div class="card tile is-child">
									<div class="card-content">
										<div class="level is-mobile has-text-centered">
											<div class="level-item">
												<div class="is-widget-label">
													<h3 class="subtitle is-spaced">
														Employees
													</h3>
													<small>(Total)</small>
													<h1 class="title">
														<?= $employee_count ?>
													</h1>
												</div>
											</div>
											<div class="level-item has-widget-icon">
												<div class="is-widget-icon"><span
														class="icon has-text-primary is-large"><i
															class="fas fa-user-tie" style="font-size: 48px;"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tile is-parent">
								<div class="card tile is-child">
									<div class="card-content">
										<div class="level is-mobile has-text-centered">
											<div class="level-item">
												<div class="is-widget-label">
													<h3 class="subtitle is-spaced">
														Items
													</h3>
													<small>(Total)</small>
													<h1 class="title">
														<?= $total_items ?>
													</h1>
												</div>
											</div>
											<div class="level-item has-widget-icon">
												<div class="is-widget-icon"><span class="icon has-text-info is-large"><i
															class="fas fa-sitemap" style="font-size: 48px;"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tile is-parent">
								<div class="card tile is-child">
									<div class="card-content">
										<div class="level is-mobile">
											<div class="level-item">
												<div class="is-widget-label">
													<h3 class="subtitle is-spaced">
														Suppliers
													</h3>
													<h1 class="title">
														256
													</h1>
												</div>
											</div>
											<div class="level-item has-widget-icon">
												<div class="is-widget-icon"><span
														class="icon has-text-success is-large"><i class="fas fa-users"
															style="font-size: 48px;"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="columns">
					<div class="column">
						<div class="tile is-ancestor">
							<div class="tile is-parent">
								<div class="card tile is-child">
									<div class="card-content">
										<div class="level is-mobile has-text-centered">
											<div class="level-item">
												<div class="is-widget-label">
													<h3 class="subtitle is-spaced">
														Items 
													</h3>
													<small>(Available)</small>
													<h1 class="title">
														321
													</h1>
												</div>
											</div>
											<div class="level-item has-widget-icon">
												<div class="is-widget-icon"><span
														class="icon has-text-info is-large"><i
															class="fas fa-check-circle" style="font-size: 48px;"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tile is-parent">
								<div class="card tile is-child">
									<div class="card-content">
										<div class="level is-mobile has-text-centered">
											<div class="level-item">
												<div class="is-widget-label">
													<h3 class="subtitle is-spaced">
														Items
													</h3>
													<small>(Assigned)</small>
													<h1 class="title">
														235
													</h1>
												</div>
											</div>
											<div class="level-item has-widget-icon">
												<div class="is-widget-icon"><span class="icon has-text-primary is-large"><i
															class="fas fa-thumbs-up" style="font-size: 48px;"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tile is-parent">
								<div class="card tile is-child">
									<div class="card-content">
										<div class="level is-mobile has-text-centered">
											<div class="level-item">
												<div class="is-widget-label">
													<h3 class="subtitle is-spaced">
														Items
													</h3>
													<small>(Damaged)</small>
													<h1 class="title">
														754
													</h1>
												</div>
											</div>
											<div class="level-item has-widget-icon">
												<div class="is-widget-icon"><span
														class="icon has-text-danger is-large"><i class="fas fa-cookie-bite"
															style="font-size: 48px;"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
