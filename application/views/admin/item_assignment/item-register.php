<section class="hero is-small is-primary" style="background-color:#15BCA1;">
	<div class="hero-body">
		<div class="columns is-vcentered">
			<div class="column is-narrow">
				<img src="https://s2smark.com/assets/img/logo/s2s-logo-1.png" style="filter: invert(.5) brightness(2);"
					width="140">
			</div>
			<div class="column">
				<p class="title">
					Admin & Procurement
				</p>
				<p class="subtitle">
					AH Group of Companies (Pvt.) Ltd.
				</p>
			</div>
		</div>
	</div>
</section>

<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight" style="background-color:#fafafa;">
		<aside class="section is-narrow-mobile is-hidden-mobile" id="categories">
			<p class="menu-label">
				General
			</p>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin_pro/admin') ?>">Dashboard</a></li>
			</ul>
			<p class="menu-label">
				Procurement
			</p>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin/suppliers') ?>">Suppliers</a></li>
			</ul>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin/employ') ?>">Employees</a></li>
			</ul>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin/categories') ?>">Categories</a></li>
			</ul>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin/travels_info') ?>">Travels Info</a></li>
			</ul>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin/locations') ?>">Locations</a></li>
			</ul>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin/inventory') ?>">Inventory</a></li>
			</ul>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin/users') ?>">Users</a></li>
			</ul>
			<ul class="menu-list">
				<li><a href="<?=  base_url('admin/invoices') ?>">Invoices</a></li>
			</ul>
			<ul class="menu-list">
				<li><a href="<?= base_url('/admin/projects') ?>">Projects</a></li>
			</ul>
			<ul class="menu-list">
				<li><button class="button is-primary has-text-weight-bold is-inverted" id="category"
						style="background-color:#ebfffc;">Item Register</button>
					<ul id="sub-categories">
						<li><a href="<?= base_url('admin/item_register'); ?>">Item List</a></li>
						<li><a href="<?= base_url('admin/available_item_list'); ?>">Available List</a></li>
						<li><a href="<?= base_url('admin/get_assign_item'); ?>">Assign List</a></li>
						<li><a href="<?= base_url('admin/add_item'); ?>">Add New</a></li>
					</ul>
				</li>

			</ul>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin/item_register') ?>">Purchase</a></li>
			</ul>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin/asset_register') ?>">Asset Register</a></li>
			</ul>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin/maintenance') ?>">Maintenance</a></li>
			</ul>
			<ul class="menu-list">
				<li><a href="<?= base_url('admin/contact_list') ?>">Contact List</a></li>
			</ul>
			<!-- <ul class="menu-list">
			<li><a><b class="has-text-grey">Travel</b> Requests <span class="tag is-info is-light">2</span></a></li>
		</ul> -->
		</aside>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section">
				<div class="columns">
					<div class="column">
						<form action="<?= base_url('admin/search_item') ?>" method="GET">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Query">
									<span class="icon is-small is-left">
										<i class="fas fa-search"></i>
									</span>
								</div>
								<div class="control">
									<button class="button is-small" type="submit"><span class="icon is-small">
											<i class="fas fa-arrow-right"></i>
										</span>
									</button>
								</div>
							</div>
						</form>
					</div>
					<div class="column">
						<div class="field has-addons">
							<p class="control">
								<button class="button is-small" id="report-btn">
									<span class="icon is-small">
										<i class="fas fa-paperclip"></i>
									</span>
									<span>Report</span>
								</button>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/item_register'); ?>'"
									class="button is-small">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Items List</span>
								</button>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/available_item_list'); ?>'"
									class="button is-small">
									<span class="icon is-small">
										<i class="far fa-list-alt"></i>
									</span>
									<span>Available List</span>
								</button>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/get_assign_item'); ?>'"
									class="button is-small">
									<span class="icon is-small">
										<i class="fas fa-bars"></i>
									</span>
									<span>Assign List</span>
								</button>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/add_item'); ?>'"
									class="button is-small">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</button>
							</p>
						</div>
					</div>
				</div>
				<div class="columns " style="display: grid">
					<div class="column table-container">
						<table class="table is-narrow is-hoverable">
							<thead>
								<tr>
									<th><abbr title="Item Identification Number">ID</abbr></th>
									<th>Location</th>
									<th>Category</th>
									<th>Product</th>
									<th>Model</th>
									<th>Supplier</th>
									<?php if($items[0]->status == 1) : ?>
									<th>Assigned To</th>
									<?php endif ?>
									<th><abbr title="Depreciation Percentage">D%</abbr></th>
									<th>Status</th>
									<th><abbr title="Purchase Date">PD</abbr></th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th><abbr title="Item Identification Number">ID</abbr></th>
									<th>Location</th>
									<th>Category</th>
									<th>Product</th>
									<th>Model</th>
									<th>Supplier</th>
									<?php if($items[0]->status == 1) : ?>
									<th>Assigned To</th>
									<?php endif ?>
									<th><abbr title="Depreciation Percentage">D%</abbr></th>
									<th>Status</th>
									<th><abbr title="Purchase Date">PD</abbr></th>
									<th>Action</th>
								</tr>
							</tfoot>
							<?php if(empty($results)): ?>
							<tbody>
								<?php if(!empty($items)): foreach($items as $item): ?>
								<tr onclick="window.location='<?= base_url('admin/item_card/'.$item->id) ?>';"
									style="cursor: pointer;">
									<td><span><?= 'CTC-0'.$item->id; ?></a></td>
									<td><?= $item->name; ?></td>
									<td>
										<div class="tags"><span class="tag"><?= ucfirst($item->cat_name); ?></span><span
												class="tag is-success is-light"><?= ucfirst($item->names); ?></span>
										</div>
									</td>
									<td><span><?= ucfirst($item->type_name); ?></span></td>
									<td><?= ucfirst($item->model); ?></td>
									</td>
									<td><?= ucfirst($item->supplier); ?></td>
									<?php if($item->status == 1) : ?>
									<td><?= ucfirst($item->employ_name); ?></td>
									<?php else : ?>
									<?php endif; ?>
									<td><?= $item->depreciation.' (%)'; ?></td>
									<td>
										<?= $status = $item->quantity > 0 ? '<span class="tag is-primary">Available</span>' : '<span class="tag is-warning">Assigned</span>'; ?>
									</td>
									<td><?= date('M d, Y', strtotime($item->purchasedate)); ?></td>
									<td>
										<div class="field has-addons">
											<p class="control">
												<a href="<?= base_url('admin/item_detail/'.$item->id); ?>"
													class="button is-small">
													<span class="icon is-small">
														<i class="fas fa-edit"></i>
													</span>
												</a>
											</p>
											<?php if($item->quantity >= 1): ?>
											<p class="control">
												<a href="<?= base_url('admin/assign_item/'.$item->id); ?>"
													class="button is-small">
													<span class="icon is-small has-text-success">
														<i class="fas fa-check"></i>
													</span>
												</a>
											</p>
											<?php endif; ?>
											<?php if($item->status == 1): ?>
											<p class="control">
												<a data-id="<?= $item->item_ids.'/'.$item->id; ?>"
													class="button is-small has-text-danger">
													<span class="icon is-small">
														<i class="fas fa-times"></i>
													</span>
												</a>
											</p>
											<?php endif; ?>
										</div>
								</tr>
								<?php endforeach; else: echo "<tr class='has-background-danger-light text-center'><td colspan='17'>No records found.</td></tr>"; endif; ?>
							</tbody>
							<?php else: ?>
							<tbody>
								<?php if(!empty($results)): foreach($results as $item): ?>
								<tr onclick="window.location='<?= base_url('admin/item_card/'.$item->id) ?>';"
									style="cursor: pointer;">
									<td><span><?= 'CTC-0'.$item->id; ?></td>
									<td><?= $item->name; ?></td>
									<td>
										<div class="tags"><span class="tag"><?= ucfirst($item->cat_name); ?></span><span
												class="tag is-success is-light"><?= ucfirst($item->names); ?></span>
										</div>
									</td>
									<td><span><?= ucfirst($item->type_name); ?></span></td>
									<td><?= ucfirst($item->model); ?></td>
									<td><?= ucfirst($item->supplier); ?></td>
									<?php if($item->status == 1) : ?>
									<td><?= ucfirst($item->employ_name); ?></td>
									<?php else : ?>
									<?php endif; ?>
									<td><?= $item->depreciation.' (%)'; ?></td>
									<td>
										<?= $status = $item->quantity > 0 ? '<span class="tag is-primary">Available</span>' : '<span class="tag is-warning">Assigned</span>'; ?>
									</td>

									<td><?= date('M d, Y', strtotime($item->purchasedate)); ?></td>
									<!-- <td><?= ucfirst($item->created_at); ?></td>  -->
									<td>
										<div class="field has-addons">
											<p class="control">
												<a href="<?= base_url('admin/item_detail/'.$item->id); ?>"
													class="button is-small">
													<span class="icon is-small">
														<i class="fas fa-edit"></i>
													</span>
												</a>
											</p>
											<?php if($item->quantity >= 1): ?>
											<p class="control">
												<a href="<?= base_url('admin/assign_item/'.$item->id); ?>"
													class="button is-small">
													<span class="icon is-small has-text-success">
														<i class="fas fa-check"></i>
													</span>
												</a>
											</p>
											<?php endif; ?>
											<?php if($item->status == 1): ?>
											<p class="control">
												<a data-id="<?= $item->item_ids.'/'.$item->id; ?>"
													class="button is-small has-text-danger">
													<span class="icon is-small">
														<i class="fas fa-times"></i>
													</span>
												</a>
											</p>
											<?php endif; ?>
										</div>
									</td>
								</tr>
								<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
							</tbody>
							<?php endif; ?>
						</table>
					</div>
					<div class="column">
						<nav class="pagination is-small" role="navigation" aria-label="pagination">
							<?php if(empty($results) AND !empty($items)){ echo $this->pagination->create_links(); } ?>
						</nav>
					</div>
				</div>
			</div>
		</div>


		<div class="modal" id="modal-ter">
			<div class="modal-background"></div>
			<form action="<?= base_url('admin/product_report'); ?>" method="post">
				<div class="modal-card">
					<header class="modal-card-head">
						<p class="modal-card-title">Filter Report</p>
						<button class="delete" aria-label="close" id="exit-report-modal" type="button"></button>
					</header>
					<section class="modal-card-body">

						<div class="columns">
							<div class="column">
								<p class="control">
									From:
									<input class="input" type="date" placeholder="From" name="from_date">
								</p>
							</div>
							<div class="column">
								<p class="control">
									To:
									<input class="input" type="date" placeholder="From" name="to_date">
								</p>
							</div>
						</div>

					</section>
					<footer class="modal-card-foot">
						<button class="button is-success" type="submit">Apply</button>
						<button class="button" aria-label="close" id="close-report-modal" type="button">Cancel</button>
					</footer>
				</div>
			</form>
		</div>

		<script>
			$(document).ready(function () {
				$('.return_item').click(function () {
					var item_id = $(this).data('id');
					// AJAX request

					$('#item_id').val(item_id);
					$('#item_return').modal('show');

				});
			});


			$(document).ready(function () {
				$("#myInput").on("keyup", function () {
					var value = $(this).val().toLowerCase();
					$("#myTable tr").filter(function () {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});

			$(document).ready(function () {
				$("#exit-report-modal").click(function () {
					$(".modal").removeClass('is-active');
				});
				$("#close-report-modal").click(function () {
					$(".modal").removeClass('is-active');
				});
				$("#report-btn").click(function () {
					$(".modal").addClass('is-active');
				});
				$("#category").click(function () {
					$(this).siblings().toggle('fast');
				});
			})

		</script>
