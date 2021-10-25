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

				<div class="tile is-ancestor">
					<div class="tile is-parent">
						<div class="tile is-child box">
							<div class="tile is-parent">
								<div class="tile is-child">
									<div class="columns is-vcentered">
										<div class="column">
											<div class="is-size-5">General</div>
											<div class="is-size-6 has-text-grey">Last 7 days vs Previous 7 days</div>
										</div>
										<div class="column is-narrow">
											<button class="card-header-icon" aria-label="more options">
												<span class="icon">
													<i class="fas fa-ellipsis-v" aria-hidden="true"></i>
												</span>
											</button>
										</div>
									</div>

								</div>
							</div>
							<div class="tile is-parent">
								<a href="<?= base_url('admin/employee') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Staff</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_employees ?></div>
									<?php if($count_employ_week_change > $count_employ_last_week_change) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $count_employ_week_change ?></span> <span class="has-text-success">(<?= number_format(( ($count_employ_week_change - $count_employ_last_week_change) / $count_employ_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php elseif($count_employ_week_change == $count_employ_last_week_change || ($count_employ_week_change == 0 AND $count_employ_last_week_change == 0)) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $count_employ_week_change ?></span> <span class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-grey">+<?= $count_employ_week_change ?></span> <span class="has-text-danger">(<?= number_format(( ($count_employ_week_change - $count_employ_last_week_change) / $count_employ_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php endif ?>
								</a>
								<a href="<?= base_url('admin/item_register') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Items</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_items ?></div>
									<?php if($total_items_week_change > $total_items_last_week_change) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_items_week_change ?></span> <span class="has-text-success">(<?= number_format(( ($total_items_week_change - $total_items_last_week_change) / $total_items_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php elseif($total_items_week_change == $total_items_last_week_change || ($total_items_week_change == 0 AND $total_items_last_week_change == 0)) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_items_week_change ?></span> <span class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-grey">+<?= $total_items_week_change ?></span> <span class="has-text-danger">(<?= number_format(( ($total_items_week_change - $total_items_last_week_change) / $total_items_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php endif ?>
								</a>
								<a href="<?= base_url('admin/suppliers') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Suppliers</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_suppliers ?></div>
									<?php if($total_suppliers_week_change > $total_suppliers_last_week_change) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_suppliers_week_change ?></span> <span class="has-text-success">(<?= number_format(( ($total_suppliers_week_change - $total_suppliers_last_week_change) / $total_suppliers_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php elseif($total_suppliers_week_change == $total_suppliers_last_week_change || ($total_suppliers_week_change == 0 AND $total_suppliers_last_week_change == 0)) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_suppliers_week_change ?></span> <span class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-grey">+<?= $total_suppliers_week_change ?></span> <span class="has-text-danger">(<?= number_format(( ($total_suppliers_week_change - $total_suppliers_last_week_change) / $total_suppliers_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php endif ?>
								</a>
							</div>
							<div class="tile is-parent">
								<a href="<?= base_url('admin/categories') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Categories</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_categories ?></div>
									<?php if($total_categories_week_change > $total_categories_last_week_change) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_categories_week_change ?></span> <span class="has-text-success">(<?= number_format(( ($total_categories_week_change - $total_categories_last_week_change) / $total_categories_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php elseif($total_categories_week_change == $total_categories_last_week_change || ($total_categories_week_change == 0 AND $total_categories_last_week_change == 0)) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_categories_week_change ?></span> <span class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-grey">+<?= $total_categories_week_change ?></span> <span class="has-text-danger">(<?= number_format(( ($total_categories_week_change - $total_categories_last_week_change) / $total_categories_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php endif ?>
								</a>
								<a href="<?= base_url('admin/dashboard') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Offices</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_offices ?></div>
									<?php if($total_offices_week_change > $total_offices_last_week_change) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_offices_week_change ?></span> <span class="has-text-success">(<?= number_format(( ($total_offices_week_change - $total_offices_last_week_change) / $total_offices_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php elseif($total_offices_week_change == $total_offices_last_week_change || ($total_offices_week_change <= 0 && $total_offices_last_week_change <= 0)) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_offices_week_change ?></span> <span class="has-text-grey">(0.00%)</span></div> 
									<?php else : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-grey">+<?= $total_offices_week_change ?></span> <span class="has-text-danger">(<?= number_format(( ($total_offices_week_change - $total_offices_last_week_change) / $total_offices_last_week_change) * 100, 2, '.', '') ?>%) </span></div>
									<?php endif ?>
								</a>
								<a href="<?= base_url('admin/dashboard') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Locations</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_offices ?></div>
									<?php if($total_offices_week_change > $total_offices_last_week_change) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_offices_week_change ?></span> <span class="has-text-success">(<?= number_format(( ($total_offices_week_change - $total_offices_last_week_change) / $total_offices_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php elseif($total_offices_week_change == $total_offices_last_week_change || ($total_offices_week_change == 0 AND $total_offices_last_week_change == 0)) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_offices_week_change ?></span> <span class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-grey">+<?= $total_offices_week_change ?></span> <span class="has-text-danger">(<?= number_format(( ($total_offices_week_change - $total_offices_last_week_change) / $total_offices_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php endif ?>
								</a>
							</div>
						</div>
					</div>
					<div class="tile is-parent">
						<div class="tile is-child box">
							<div class="tile is-parent">
								<div class="tile is-child">
									<div class="columns is-vcentered">
										<div class="column">
											<div class="is-size-5">Items</div>
											<div class="is-size-6 has-text-grey">Last 7 days vs Previous 7 days</div>
										</div>
										<div class="column is-narrow">
											<button class="card-header-icon" aria-label="more options">
												<span class="icon">
													<i class="fas fa-ellipsis-v" aria-hidden="true"></i>
												</span>
											</button>
										</div>
									</div>

								</div>
							</div>
							<div class="tile is-parent">
								<a href="<?= base_url('admin/available_item_list') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Available</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_available_items ?></div>
									<?php if($total_available_items_week_change > $total_available_items_last_week_change) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_available_items_week_change ?></span> <span class="has-text-success">(<?= number_format(( ($total_available_items_week_change - $total_available_items_last_week_change) / $total_available_items_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php elseif($total_available_items_week_change == $total_available_items_last_week_change || ($total_available_items_week_change == 0 AND $total_available_items_last_week_change == 0)) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_available_items_week_change ?></span> <span class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-grey">+<?= $total_available_items_week_change ?></span> <span class="has-text-danger">(<?= number_format(( ($total_available_items_week_change - $total_available_items_last_week_change) / $total_available_items_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php endif ?>
								</a>
								<a href="<?= base_url('admin/get_assign_item') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Assigned</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_assigned_items ?></div>
									<?php if($total_assigned_items_week_change > $total_assigned_items_last_week_change) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_assigned_items_week_change ?></span> <span class="has-text-success">(<?= number_format(( ($total_assigned_items_week_change - $total_assigned_items_last_week_change) / $total_assigned_items_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php elseif($total_assigned_items_week_change == $total_assigned_items_last_week_change || ($total_assigned_items_week_change == 0 AND $total_assigned_items_last_week_change == 0)) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_assigned_items_week_change ?></span> <span class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-grey">+<?= $total_assigned_items_week_change ?></span> <span class="has-text-danger">(<?= number_format(( ($total_assigned_items_week_change - $total_assigned_items_last_week_change) / $total_assigned_items_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php endif ?>
								</a>
								<a href="<?= base_url('admin/dashboard') ?>" class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Damaged</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_damaged_items ?></div>
									<?php if($total_damaged_items_week_change > $total_damaged_items_last_week_change) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_damaged_items_week_change ?></span> <span class="has-text-success">(<?= number_format(( ($total_damaged_items_week_change - $total_damaged_items_last_week_change) / $total_damaged_items_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php elseif($total_damaged_items_week_change == $total_damaged_items_last_week_change || ($total_damaged_items_week_change == 0 AND $total_damaged_items_last_week_change == 0)) : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-success">+<?= $total_damaged_items_week_change ?></span> <span class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
										<div class="has-text-weight-light is-size-7"><span class="has-text-grey">+<?= $total_damaged_items_week_change ?></span> <span class="has-text-danger">(<?= number_format(( ($total_damaged_items_week_change - $total_damaged_items_last_week_change) / $total_damaged_items_last_week_change) * 100, 2, '.', '') ?>%)</span></div>
									<?php endif ?>
								</a>
							</div>
							<div class="tile is-parent">
								<div class="tile is-child">
									<canvas id="myChart" height="70"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- <div class="column">
					<div class="is-size-5">General</div>
					<div class="is-size-6 has-text-grey">Last 7 days vs previous 7 days</div>
				</div>
				<div class="column is-narrow">
					<button class="card-header-icon" aria-label="more options">
						<span class="icon">
							<i class="fas fa-ellipsis-v" aria-hidden="true"></i>
						</span>
					</button>
				</div>
				 -->
			</div>
		</div>
	</div>
</section>
<script>
	new Chart(document.getElementById("myChart"), {
		type: 'line',
		data: {
			labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
			datasets: [{
				label: "Damaged",
				type: "line",
				borderColor: "#E74C3C",
				backgroundColor: "#ffedf1",
				borderDash: [5, 5],
				data: [<?= $fetch_damaged_item_sum_by_last_7 ?>, <?= $fetch_damaged_item_sum_by_last_6 ?>, 
				<?= $fetch_damaged_item_sum_by_last_5 ?>, <?= $fetch_damaged_item_sum_by_last_4 ?>,
				<?= $fetch_damaged_item_sum_by_last_3 ?>, <?= $fetch_damaged_item_sum_by_last_2 ?>,
				<?= $fetch_damaged_item_sum_by_last_1 ?>],
				spanGaps: true,
				tension: 0.4,
				fill: true
			}, {
				label: "Assigned",
				type: "line",
				borderColor: "#82E0AA",
				backgroundColor: "#f6fffb",
				borderDash: [5, 5],
				data: [<?= $fetch_assigned_item_sum_by_last_7 ?>, <?= $fetch_assigned_item_sum_by_last_6 ?>, 
				<?= $fetch_assigned_item_sum_by_last_5 ?>, <?= $fetch_assigned_item_sum_by_last_4 ?>,
				<?= $fetch_assigned_item_sum_by_last_3 ?>, <?= $fetch_assigned_item_sum_by_last_2 ?>,
				<?= $fetch_assigned_item_sum_by_last_1 ?>],
				spanGaps: true,
				tension: 0.4,
				fill: true
			}, {
				label: "Available",
				type: "line",
				borderColor: "#5DADE2",
				backgroundColor: "#fcfcfc",
				data: [<?= $fetch_item_sum_by_last_7 ?>, <?= $fetch_item_sum_by_last_6 ?>, 
				<?= $fetch_item_sum_by_last_5 ?>, <?= $fetch_item_sum_by_last_4 ?>,
				<?= $fetch_item_sum_by_last_3 ?>, <?= $fetch_item_sum_by_last_2 ?>,
				<?= $fetch_item_sum_by_last_1 ?>],
				spanGaps: true,
				tension: 0.4,
				fill: true
			}, ]
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
        plugins: {
            legend: false // Hide legend
        },
        scales: {
            y: {
                display: false // Hide Y axis labels
            },
            x: {
                display: false // Hide X axis labels
            }
        }  
		},
	});

</script>
