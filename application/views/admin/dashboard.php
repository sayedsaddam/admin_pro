<?php $session = $this->session->userdata('user_role'); ?>
<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" id="custom-sidebar">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section py-5">
				
				<?php $this->view('admin/commons/breadcrumb'); ?>

				<div class="tile is-ancestor">
					<div class="tile is-parent">
						<div class="tile is-child box bg-secondary">
							<div class="tile is-parent">
								<div class="tile is-child">
									<div class="columns is-vcentered">
										<div class="column">
											<div class="is-size-5">General Statistics</div>
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
								<a href="<?= base_url('admin/employee') ?>"
									class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Staff</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_employees ?></div>
									<?php if($count_employ_week_change > $count_employ_last_week_change) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $count_employ_week_change ?></span> <span
											class="has-text-success">(+<?= number_format(( ($count_employ_week_change - $count_employ_last_week_change) / $count_employ_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php elseif($count_employ_week_change == $count_employ_last_week_change || ($count_employ_week_change == 0 AND $count_employ_last_week_change == 0)) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $count_employ_week_change ?></span> <span
											class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-grey">+<?= $count_employ_week_change ?></span> <span
											class="has-text-danger">(<?= number_format(( ($count_employ_week_change - $count_employ_last_week_change) / $count_employ_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php endif ?>
								</a>
								<a href="<?= base_url('admin/item_register') ?>"
									class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Items</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_items ?></div>
									<?php if($total_items_week_change > $total_items_last_week_change) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_items_week_change ?></span> <span
											class="has-text-success">(+<?= number_format(( ($total_items_week_change - $total_items_last_week_change) / $total_items_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php elseif($total_items_week_change == $total_items_last_week_change || ($total_items_week_change == 0 AND $total_items_last_week_change == 0)) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_items_week_change ?></span> <span
											class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-grey">+<?= $total_items_week_change ?></span> <span
											class="has-text-danger">(<?= number_format(( ($total_items_week_change - $total_items_last_week_change) / $total_items_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php endif ?>
								</a>
								<a href="<?= base_url('admin/suppliers') ?>"
									class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Suppliers</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_suppliers ?></div>
									<?php if($total_suppliers_week_change > $total_suppliers_last_week_change) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_suppliers_week_change ?></span> <span
											class="has-text-success">(+<?= number_format(( ($total_suppliers_week_change - $total_suppliers_last_week_change) / $total_suppliers_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php elseif($total_suppliers_week_change == $total_suppliers_last_week_change || ($total_suppliers_week_change == 0 AND $total_suppliers_last_week_change == 0)) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_suppliers_week_change ?></span> <span
											class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-grey">+<?= $total_suppliers_week_change ?></span> <span
											class="has-text-danger">(<?= number_format(( ($total_suppliers_week_change - $total_suppliers_last_week_change) / $total_suppliers_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php endif ?>
								</a>
							</div>
							<div class="tile is-parent">
								<a href="<?= base_url('admin/categories') ?>"
									class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Categories</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_categories ?></div>
									<?php if($total_categories_week_change > $total_categories_last_week_change) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_categories_week_change ?></span> <span
											class="has-text-success">(+<?= number_format(( ($total_categories_week_change - $total_categories_last_week_change) / $total_categories_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php elseif($total_categories_week_change == $total_categories_last_week_change || ($total_categories_week_change == 0 AND $total_categories_last_week_change == 0)) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_categories_week_change ?></span> <span
											class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-grey">+<?= $total_categories_week_change ?></span> <span
											class="has-text-danger">(<?= number_format(( ($total_categories_week_change - $total_categories_last_week_change) / $total_categories_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php endif ?>
								</a>
								<!-- <a href="<?= base_url('admin/dashboard') ?>"
									class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Offices</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_offices ?></div>
									<?php if($total_offices_week_change > $total_offices_last_week_change) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_offices_week_change ?></span> <span
											class="has-text-success">(+<?= number_format(( ($total_offices_week_change - $total_offices_last_week_change) / $total_offices_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php elseif($total_offices_week_change == $total_offices_last_week_change || ($total_offices_week_change <= 0 && $total_offices_last_week_change <= 0)) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_offices_week_change ?></span> <span
											class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-grey">+<?= $total_offices_week_change ?></span> <span
											class="has-text-danger">(<?= number_format(( ($total_offices_week_change - $total_offices_last_week_change) / $total_offices_last_week_change) * 100, 2, '.', '') ?>%)
										</span></div>
									<?php endif ?>
								</a> -->

								<a href="<?= base_url('admin/asset_register') ?>"
									class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Assets</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_assets ?></div>
									<?php if($total_assets_week_change > $count_asset_last_week_change) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_assets_week_change ?></span> <span
											class="has-text-success">(+<?= number_format(( ($total_assets_week_change - $count_asset_last_week_change) / $count_asset_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php elseif($total_assets_week_change == $count_asset_last_week_change || ($total_assets_week_change == 0 AND $count_asset_last_week_change == 0)) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_assets_week_change ?></span> <span
											class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-grey">+<?= $total_assets_week_change ?></span> <span
											class="has-text-danger">(<?= number_format(( ($total_assets_week_change - $count_asset_last_week_change) / $count_asset_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php endif ?>
								</a>

								<a href="<?= base_url('admin/dashboard') ?>"
									class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Locations</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_offices ?></div>
									<?php if($total_offices_week_change > $total_offices_last_week_change) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_offices_week_change ?></span> <span
											class="has-text-success">(+<?= number_format(( ($total_offices_week_change - $total_offices_last_week_change) / $total_offices_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php elseif($total_offices_week_change == $total_offices_last_week_change || ($total_offices_week_change == 0 AND $total_offices_last_week_change == 0)) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_offices_week_change ?></span> <span
											class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-grey">+<?= $total_offices_week_change ?></span> <span
											class="has-text-danger">(<?= number_format(( ($total_offices_week_change - $total_offices_last_week_change) / $total_offices_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php endif ?>
								</a>
							</div>
							
							<div class="tile is-parent">
								<a href="<?= base_url('admin/available_item_list') ?>"
									class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Available</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_available_items ?></div>
									<?php if($total_available_items_week_change > $total_available_items_last_week_change) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_available_items_week_change ?></span>
										<span
											class="has-text-success">(+<?= number_format(( ($total_available_items_week_change - $total_available_items_last_week_change) / $total_available_items_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php elseif($total_available_items_week_change == $total_available_items_last_week_change || ($total_available_items_week_change == 0 AND $total_available_items_last_week_change == 0)) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_available_items_week_change ?></span>
										<span class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-grey">+<?= $total_available_items_week_change ?></span>
										<span
											class="has-text-danger">(<?= number_format(( ($total_available_items_week_change - $total_available_items_last_week_change) / $total_available_items_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php endif ?>
								</a>
								<a href="<?= base_url('admin/get_assign_item') ?>"
									class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Assigned</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_assigned_items ?></div>
									<?php if($total_assigned_items_week_change > $total_assigned_items_last_week_change) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_assigned_items_week_change ?></span>
										<span
											class="has-text-success">(+<?= number_format(( ($total_assigned_items_week_change - $total_assigned_items_last_week_change) / $total_assigned_items_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php elseif($total_assigned_items_week_change == $total_assigned_items_last_week_change || ($total_assigned_items_week_change == 0 AND $total_assigned_items_last_week_change == 0)) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-success">+<?= $total_assigned_items_week_change ?></span>
										<span class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-grey">+<?= $total_assigned_items_week_change ?></span> <span
											class="has-text-danger">(<?= number_format(( ($total_assigned_items_week_change - $total_assigned_items_last_week_change) / $total_assigned_items_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php endif ?>
								</a>
								<a href="<?= base_url('admin/get_damaged_item') ?>"
									class="tile is-child clickable hoverable has-text-dark">
									<div class="has-text-weight-light has-text-grey">Total Damaged</div>
									<div class="has-text-weight-semibold is-size-4"><?= $total_damaged_items ?></div>
									<?php if($total_damaged_items_week_change > $total_damaged_items_last_week_change) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-danger">+<?= $total_damaged_items_week_change ?></span>
										<span
											class="has-text-danger">(+<?= number_format(( ($total_damaged_items_week_change - $total_damaged_items_last_week_change) / $total_damaged_items_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php elseif($total_damaged_items_week_change == $total_damaged_items_last_week_change || ($total_damaged_items_week_change == 0 AND $total_damaged_items_last_week_change == 0)) : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-danger">+<?= $total_damaged_items_week_change ?></span>
										<span class="has-text-grey">(0.00%)</span></div>
									<?php else : ?>
									<div class="has-text-weight-light is-size-7"><span
											class="has-text-grey">+<?= $total_damaged_items_week_change ?></span> <span
											class="has-text-success">(<?= number_format(( ($total_damaged_items_week_change - $total_damaged_items_last_week_change) / $total_damaged_items_last_week_change) * 100, 2, '.', '') ?>%)</span>
									</div>
									<?php endif ?>
								</a>
							</div>
						</div>
					</div>
					<div class="tile is-parent">
						<div class="tile is-child box bg-secondary">
							<div class="tile is-parent">
								<div class="tile is-child">
									<div class="columns is-vcentered">
										<div class="column">
											<div class="is-size-5">Graph Statistics - Items</div>
											<div class="is-size-6 has-text-grey">Total, Assigned & Damaged</div>
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
								<div class="tile is-child">
									<canvas id="myChartAvailable" height="60"></canvas>
								</div>
							</div>

							<div class="tile is-parent">
								<div class="tile is-child">
									<canvas id="myChartAssigned" height="60"></canvas>
								</div>
							</div>

							<div class="tile is-parent">
								<div class="tile is-child">
									<canvas id="myChartDamaged" height="60"></canvas>
								</div>

							</div>
							
						</div>
					</div>
				</div>
				<?php if($this->session->userdata('user_role') == 1) : ?>
				<div class="tile is-ancestor">
					<div class="tile is-parent">
						<div class="tile is-child box bg-secondary">
							<div class="tile is-parent">
								<div class="tile is-child">
									<div class="columns is-vcentered">
										<div class="column">
											<div class="is-size-5">Employees Statistics</div>
											<div class="is-size-6 has-text-grey">Overall Days</div>
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
								<div class="tile is-child">
									<table class="table is-hoverable is-fullwidth">
										<thead>
											<tr>
												<th class="has-text-weight-semibold"><abbr title="Item Identification Number">ID</abbr></th>
												<th class="has-text-weight-semibold">Employee Name</th>
												<th class="has-text-weight-semibold">Employee Location</th>
												<th class="has-text-weight-semibold">Items Added</th>
												<th class="has-text-weight-semibold">Items Assigned</th>
												<th class="has-text-weight-semibold">Suppliers Added</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($employees_statistics as $data) : ?>
												<?php if($data->role_type == 'employee' || $data->role_type == 'supervisor') : ?>
													<tr onclick="window.location='<?= base_url('admin/edit_employ/'.$data->id) ?>';">
														<td><?= $data->id ?></td>
														<td><?= ucwords($data->fullname) ?></td>
														<td><?= ucwords($data->location) ?></td>
														<td><span class="tag"><?= $this->admin_model->EmployeeAddedItems($data->id)[0]->total ?></span><span class="tag is-light <?= ($this->admin_model->EmployeeAddedItems($data->id)[0]->total / $total_items) * 100 == 0 ? 'is-danger' : '' ?><?= ($this->admin_model->EmployeeAddedItems($data->id)[0]->total / $total_items) * 100 >= 20 ? 'is-success' : '' ?><?= ($this->admin_model->EmployeeAddedItems($data->id)[0]->total / $total_items) * 100 < 20 && ($this->admin_model->EmployeeAddedItems($data->id)[0]->total / $total_items) * 100 > 0  ? 'is-warning' : '' ?> ml-2"><?= number_format(($this->admin_model->EmployeeAddedItems($data->id)[0]->total / $total_items) * 100, 2, '.', '') ?>%</span></td>
														<td><span class="tag"><?= $this->admin_model->EmployeeAssignedItems($data->id)[0]->total ?></span><span class="tag is-light <?= ($this->admin_model->EmployeeAssignedItems($data->id)[0]->total / $total_assigned_items) * 100 == 0 ? 'is-danger' : '' ?><?= ($this->admin_model->EmployeeAssignedItems($data->id)[0]->total / $total_assigned_items) * 100 >= 20 ? 'is-success' : '' ?><?= ($this->admin_model->EmployeeAssignedItems($data->id)[0]->total / $total_assigned_items) * 100 < 20 && ($this->admin_model->EmployeeAssignedItems($data->id)[0]->total / $total_assigned_items) * 100 > 0 ? 'is-warning' : '' ?> ml-2"><?= number_format(($this->admin_model->EmployeeAssignedItems($data->id)[0]->total / $total_assigned_items) * 100, 2, '.', '') ?>%</span></td>
														<td><span class="tag"><?= $this->admin_model->EmployeeAddedSuppliers($data->id)[0]->total ?></span><span class="tag is-light <?= ($this->admin_model->EmployeeAddedSuppliers($data->id)[0]->total / $total_suppliers) * 100 == 0 ? 'is-danger' : '' ?><?= ($this->admin_model->EmployeeAddedSuppliers($data->id)[0]->total / $total_suppliers) * 100 >= 20 ? 'is-success' : '' ?><?= ($this->admin_model->EmployeeAddedSuppliers($data->id)[0]->total / $total_suppliers) * 100 < 20 && ($this->admin_model->EmployeeAddedSuppliers($data->id)[0]->total / $total_suppliers) * 100 > 0 ? 'is-warning' : '' ?> ml-2"><?= number_format(($this->admin_model->EmployeeAddedSuppliers($data->id)[0]->total / $total_suppliers) * 100, 2, '.', '') ?>%</span></td>
													</tr>
												<?php endif ?>
											<?php endforeach ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>
<script>
	var d = new Date();
	var weekday = new Array(7);
	weekday[0] = "Sunday";
	weekday[1] = "Monday";
	weekday[2] = "Tuesday";
	weekday[3] = "Wednesday";
	weekday[4] = "Thursday";
	weekday[5] = "Friday";
	weekday[6] = "Saturday";
	
	function _getDay(int = null) {
		d.setDate(d.getDate() - int)
		let day = weekday[d.getDay()];
		return day;
	}

	new Chart(document.getElementById("myChartAvailable"), {
		type: 'line',
		data: {
			labels: [_getDay(6), _getDay(5), _getDay(4), _getDay(3), _getDay(2), _getDay(1), _getDay()],
			datasets: [{
				label: "Added",
				type: "line",
				borderColor: "#5DADE2",
				backgroundColor: "#f4f9ff",
				borderDash: [5, 5],
				data: [<?php $count = count($total_items_count_by_days); foreach(array_reverse($total_items_count_by_days) as $key => $data) { echo $data; if($key + 1 < $count) {echo ', ';} } ?>],
				spanGaps: true,
				tension: 0.4,
				fill: true
			} ]
		},
		options: {
			responsive: true,
			maintainAspectRatio: true,
			plugins: {
				legend: false // Hide legend
			},
			scales: {
				y: {
					display: true // Hide Y axis labels
				},
				x: {
					display: false // Hide X axis labels
				}
			}
		},
	});
	new Chart(document.getElementById("myChartAssigned"), {
		type: 'line',
		data: {
			labels: [_getDay(6), _getDay(5), _getDay(4), _getDay(3), _getDay(2), _getDay(1), _getDay()],
			datasets: [{
				label: "Assigned",
				type: "line",
				borderColor: "#82E0AA",
				backgroundColor: "#f6fffb",
				borderDash: [5, 5],
				data: [<?php $count = count($assigned_items_count_by_days); foreach(array_reverse($assigned_items_count_by_days) as $key => $data) { echo $data; if($key + 1 < $count) {echo ', ';} } ?>],
				spanGaps: true,
				tension: 0.4,
				fill: true
			} ]
		},
		options: {
			responsive: true,
			maintainAspectRatio: true,
			plugins: {
				legend: false // Hide legend
			},
			scales: {
				y: {
					display: true // Hide Y axis labels
				},
				x: {
					display: false // Hide X axis labels
				}
			}
		},
	});
	new Chart(document.getElementById("myChartDamaged"), {
		type: 'line',
		data: {
			labels: [_getDay(6), _getDay(5), _getDay(4), _getDay(3), _getDay(2), _getDay(1), _getDay()],
			datasets: [{
				label: "Damaged",
				type: "line",
				borderColor: "#E74C3C",
				backgroundColor: "#ffedf1",
				borderDash: [5, 5],
				data: [<?php $count = count($damaged_items_count_by_days); foreach(array_reverse($damaged_items_count_by_days) as $key => $data) { echo $data; if($key + 1 < $count) {echo ', ';} } ?>],
				spanGaps: true,
				tension: 0.4,
				fill: true
			} ]
		},
		options: {
			responsive: true,
			maintainAspectRatio: true,
			plugins: {
				legend: false // Hide legend
			},
			scales: {
				y: {
					display: true // Hide Y axis labels
				},
				x: {
					display: false // Hide X axis labels
				}
			}
		},
	});
</script>
