<section class="hero is-small is-primary" style="background-color:#15BCA1;">
	<div class="hero-body">
		<p class="title">
			Admin & Procurement
		</p>
		<p class="subtitle">
			AH Group of Companies (Pvt.) Ltd.
		</p>
	</div>
</section>

<div class="columns section">
	<aside class="column is-2 is-narrow-mobile is-fullheight is-hidden-mobile has-background-white">
		<p class="menu-label">
			General
		</p>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Dashboard</b></a></li>
		</ul>
		<p class="menu-label">
			Procurement
		</p>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Suppliers</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Employees</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Categories</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Travels Info</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Locations</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Inventory</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Users</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Invoices</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Projects</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Item Register</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Purchase</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Asset Register</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Maintenance</b></a></li>
		</ul>
		<ul class="menu-list">
			<li><a><b class="has-text-grey">Contact List</b></a></li>
		</ul>
		<!-- <ul class="menu-list">
			<li><a><b class="has-text-grey">Travel</b> Requests <span class="tag is-info is-light">2</span></a></li>
		</ul> -->
		<p class="menu-label">
			Controls
		</p>
		<ul class="menu-list">
			<li><a>Logout</a></li>
		</ul>
	</aside>
	<div class="column">
		<div class="columns">
			<div class="column">
				<div class="control has-icons-left has-icons-right">
					<input class="input is-small" type="search" placeholder="Search Query">
					<span class="icon is-small is-left">
						<i class="fas fa-search"></i>
					</span>
					<span class="icon is-small is-right">
						<i class="fas fa-arrow-right"></i>
					</span>
				</div>
			</div>
			<div class="column">
				<div class="field has-addons">
					<p class="control">
						<button class="button is-small">
							<span class="icon is-small">
								<i class="fas fa-paperclip"></i>
							</span>
							<span>Report</span>
						</button>
					</p>
					<p class="control">
						<button class="button is-small">
							<span class="icon is-small">
								<i class="fas fa-list"></i>
							</span>
							<span>Items List</span>
						</button>
					</p>
					<p class="control">
						<button class="button is-small">
							<span class="icon is-small">
								<i class="far fa-list-alt"></i>
							</span>
							<span>Available List</span>
						</button>
					</p>
					<p class="control">
						<button class="button is-small">
							<span class="icon is-small">
								<i class="fas fa-bars"></i>
							</span>
							<span>Assign List</span>
						</button>
					</p>
					<p class="control">
						<button class="button is-small">
							<span class="icon is-small">
								<i class="fas fa-plus"></i>
							</span>
							<span>Add New</span>
						</button>
					</p>
					<p class="control">
						<button class="button is-small">
							<span class="icon is-small">
								<i class="fas fa-arrow-left"></i>
							</span>
							<span>Back</span>
						</button>
					</p>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="container-fluid">
	<?php if($success = $this->session->flashdata('success')): ?>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="alert alert-success"><?=$success;?></div>
		</div>
	</div>
	<?php endif; ?>
	<div class="row mb-4">
		<div class="col-lg-4 col-md-4">
			<form action="<?= base_url('admin/search_item'); ?>" method="get" class="md-form form-inline">
				<input type="text" name="search" id="myInput" class="form-control md-form col-5">
				<label for="">Search Query</label>
				<input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
			</form>
		</div>
		<div class="col-lg-8 col-md-8 text-right">
			<button class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#fullWidthtModalLeft"><i
					class="fa fa-filter"></i> Report</button>
			<a href="<?= base_url('admin/item_register'); ?>" data-target="#item_list"
				class="btn btn-outline-primary btn-sm"><i class="fa fa-plus"></i> All Item List</a>
			<a href="<?= base_url('admin/available_item_list'); ?>" data-target="#available_lists"
				class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i> Available List</a>
			<a href="<?= base_url('admin/get_assign_item'); ?>" data-target="#assign_list"
				class="btn btn-outline-danger btn-sm"><i class="fa fa-sub"></i> Assign List</a>
			<a href="<?= base_url('admin/add_item'); ?>" data-target="#add_supplier"
				class="btn btn-outline-info btn-sm "><i class="fa fa-plus"></i> Add New</a>
			<a href="<?= base_url('admin/'); ?>" class="btn btn-outline-danger btn-sm"><i class="fa fa-angle-left"></i>
				Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<table class="table table-sm">
				<caption><?php if(empty($results)){ echo 'List of Assets'; }else{ echo 'Search Results'; } ?></caption>
				<thead>
					<tr>
						<th class="font-weight-bold">ID </th>
						<th class="font-weight-bold">Location</th>
						<th class="font-weight-bold">Category</th>
						<th class="font-weight-bold">Sub Category</th>
						<!-- <th class="font-weight-bold">Model</th> -->
						<th class="font-weight-bold">Type Name</th>
						<th class="font-weight-bold">Model</th>
						<th class="font-weight-bold">Serial Number</th>
						<th class="font-weight-bold">Supplier</th>
						<th class="font-weight-bold">Assignd To</th>
						<th class="font-weight-bold">Price</th>
						<th class="font-weight-bold">Depreciation %</th>
						<th class="font-weight-bold">Status</th>
						<th class="font-weight-bold">Purchase Date</th>
						<th class="font-weight-bold">Action</th>
					</tr>
				</thead>
				<?php if(empty($results)): ?>
				<tbody id="myTable">
					<?php if(!empty($items)): foreach($items as $item): ?>
					<tr>
						<td><a href="<?= base_url('admin/item_card/'.$item->id) ?>"><span
									style="color: blue;"><?= 'CTC-0'.$item->id; ?></span></a></td>
						<td><?= $item->name; ?></td>
						<td><?= ucfirst($item->cat_name); ?></td>
						<td><?= ucfirst($item->names); ?></td>
						<td><a href="<?= base_url('admin/item_card/'.$item->id) ?>"><span
									style="color: blue;"><?= ucfirst($item->type_name); ?></span></a></td>
						<td><?= ucfirst($item->model); ?></td>
						<td><?= ucfirst($item->serial_number); ?></td>
						<td><?= ucfirst($item->supplier); ?></td>
						<td><strong> - - - - -</strong></td>
						<td><?= number_format(floatval($item->price)); ?></td>
						<td><?= $item->depreciation.' (%)'; ?></td>
						<td>
							<?= $status = $item->quantity > 0 ? '<span class="badge badge-success">Available</span>' : '<span class="badge badge-warning">Assigned</span>'; ?>
						</td>
						<td><?= date('M d, Y', strtotime($item->purchasedate)); ?></td>
						<td>
							<a href="<?= base_url('admin/item_detail/'.$item->id); ?>"><span
									class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
							<!-- <a href="<?= base_url('admin/assign_item_list/'.$item->id); ?>"><span class="badge badge-info"><i class="fa fa-check"></i></span></a> -->
							<?php if($item->quantity >= 1): ?>
							<a href="<?= base_url('admin/assign_item/'.$item->id); ?>"><span class="badge badge-info"><i
										class="fa fa-check"></i></span></a>
							<?php endif; ?>
							<?php if($item->status == 1): ?>
							<a data-id="<?= $item->item_ids.'/'.$item->id; ?>" class="return_item"><span
									class="badge badge-danger"><i class="fa fa-times"></i></span></a>
							<?php endif; ?>
						<td>
						</td>
					</tr>
					<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
				</tbody>
				<?php else: ?>
				<tbody>
					<?php if(!empty($results)): foreach($results as $item): ?>
					<tr>
						<td><a href="<?= base_url('admin/item_card/'.$item->id) ?>"><span
									style="color: blue;"><?= 'CTC-0'.$item->id; ?></a></td>
						<td><?= $item->name; ?></td>
						<td><?= ucfirst($item->cat_name); ?></td>
						<td><?= ucfirst($item->names); ?></td>
						<td><a href="<?= base_url('admin/item_card/'.$item->id); ?>"><span
									style="color: blue;"><?= ucfirst($item->type_name); ?></span></a></td>
						<td><?= ucfirst($item->model); ?></td>
						<td><?= ucfirst($item->serial_number); ?></td>
						<td><?= ucfirst($item->supplier); ?></td>
						<?php if($item->status == 0) : ?>
						<?php //if(!empty($item->assignd_to)): ?>
						<td><strong><?= ucfirst($item->employ_name); ?></strong></td>
						<?php else : ?>
						<td><strong> - - - - -</strong></td>
						<?php //endif; ?>
						<?php endif; ?>

						<td><?= $item->price; ?></td>
						<td><?= $item->depreciation.' (%)'; ?></td>
						<td>
							<?= $status = $item->quantity > 0 ? '<span class="badge badge-success">Available</span>' : '<span class="badge badge-warning">Assigned</span>'; ?>
						</td>

						<td><?= date('M d, Y', strtotime($item->purchasedate)); ?></td>
						<!-- <td><?= ucfirst($item->created_at); ?></td>  -->
						<td>
							<a href="<?= base_url('admin/item_detail/'.$item->id); ?>"><span
									class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
							<!-- <a href="<?= base_url('admin/assign_item_list/'.$item->id); ?>"><span class="badge badge-info"><i class="fa fa-check"></i></span></a> -->
							<!-- <a href="<?=base_url('admin/delete_item/'.$item->id);?>" onclick="javascript:return confirm('<input type='text' name='name'>Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a> -->
							<?php if($item->quantity >= 1): ?>
							<a href="<?= base_url('admin/assign_item/'.$item->id); ?>"><span class="badge badge-info"><i
										class="fa fa-check"></i></span></a>
							<?php endif; ?>
							<?php if($item->status == 1): ?>
							<a data-id="<?= $item->item_ids.'/'.$item->id; ?>" class="return_item"><span
									class="badge badge-danger"><i class="fa fa-times"></i></span></a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
				</tbody>
				<?php endif; ?>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<?php if(empty($results) AND !empty($items)){ echo $this->pagination->create_links(); } ?>
		</div>
	</div>
</div>

<!-- Modal to edit location -->
<div class="modal fade" id="item_return" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100 font-weight-bold">Return Item</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body mx-3">
				<form action="<?= base_url('admin/return_item'); ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="id" id="item_id" value="">
					<div class="md-form mb-5">
						<select name="remarks" class="form-control validate">
							<option value="damage">Damage</option>
							<option value="disabled">Disabled</option>
						</select>
					</div>

					<div class="md-form mb-5">
						<input type="file" name="file" id="userfile" class="form-control validate">
					</div>
					<div class="md-form mb-5">
						<textarea name="description" id="description" cols="30" rows="3"
							class="form-control"></textarea>
						<!-- <input type="text" name="description" id="description" class="form-control validate"> -->
						<label data-error="wrong" data-success="right" for="orangeForm-name">Description</label>
					</div>

					<div class="md-form">
						<button type="submit" class="btn btn-deep-purple">Save Changes</button>
						<button type="reset" class="btn btn-orange">Reset</button>
					</div>
			</div>
			</form>
			<div class="modal-footer d-flex justify-content-left">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!-- Full Width Modal Left > show report -->
<div class="modal fade left" id="fullWidthtModalLeft" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
	<!-- Add class .modal-full-width and then add class .modal-right (or other classes from list above) to set a position to the modal -->
	<div class="modal-dialog modal-full-width modal-left modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100" id="myModalLabel">Assignment Report</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<!-- Form -->
						<form action="<?= base_url('admin/product_report'); ?>" method="post">
							<!-- item name -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="from_date">From Date</label>
										<input type="date" name="from_date" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="from_date">To Date</label>
										<input type="date" name="to_date" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" class="btn btn-primary" value="Save Changes">
							</div>
						</form>
						<!-- Form -->
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- Full Width Modal Left -->


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

</script>
