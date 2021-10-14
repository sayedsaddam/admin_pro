  <div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-lg-1 col-md-1">
  				<img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid"
  					width="200">
  			</div>
  			<div class="col-lg-7 col-md-7">
  				<h2 class="display-4 font-weight-bold mb-0">Admin & Procurement</h2>
  				<h3 class="font-weight-bold text-light">AH Group of Companies (Pvt.) Ltd.</h3>
  			</div>
  			<div class="col-lg-4 col-md-4 text-right">
  				<button class="btn btn-outline-light font-weight-bold"
  					title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
  				<a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i
  						class="fa fa-sign-out-alt"></i></a>
  				<h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span
  						class="font-weight-light orange-text"><?php if(empty($results)){ echo ' Asset List'; }else{ echo 'Search Results'; } ?>
  						| <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
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
  			<a href="<?= base_url('admin/item_register'); ?>" data-target="#item_list" class="btn btn-outline-primary"><i
  					class="fa fa-plus"></i> All Item List</a>
  			<a href="<?= base_url('admin/available_item_list'); ?>" data-target="#available_lists"
  				class="btn btn-outline-success"><i class="fa fa-plus"></i> Available List</a>
  			<a href="<?= base_url('admin/get_assign_item'); ?>" data-target="#assign_list" class="btn btn-outline-danger"><i
  					class="fa fa-sub"></i> Assign List</a>
  			<a href="<?= base_url('admin/add_item'); ?>" data-target="#add_supplier" class="btn btn-outline-info"><i
  					class="fa fa-plus"></i> Add New</a>
  			<a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
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
  						<td><a href="<?= base_url('admin/item_card/'.$item->id.'/'.$item->employ_id) ?>"><span
  									style="color: blue;"><?= ucfirst($item->type_name); ?></span></a></td>
  						<td><?= ucfirst($item->model); ?></td>
  						<td><?= ucfirst($item->serial_number); ?></td>
  						<td><?= ucfirst($item->supplier); ?></td>
  						<?php if($item->status != 0): ?>
  						<td><strong><?= ucfirst($item->employ_name); ?></strong></td>
  						<?php else : ?>
  						<td><strong> - - - - -</strong></td>
  						<?php endif; ?>
  						<td><?= number_format(floatval($item->price)); ?></td>
  						<td><?= $item->depreciation.' (%)'; ?></td>

  						<td>
  							<?= $status = $item->quantity > 0 ? '<span class="badge badge-success">Available</span>' : '<span class="badge badge-warning">Assigned</span>'; ?>
  						</td>
  						<td><?= date('M d, Y', strtotime($item->purchasedate)); ?></td>
  						<td>
  							<a href="<?= base_url('admin/item_detail/'.$item->id); ?>"><span class="badge badge-primary"><i
  										class="fa fa-edit"></i></span></a>
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
  							<a href="<?= base_url('admin/item_detail/'.$item->id); ?>"><span class="badge badge-primary"><i
  										class="fa fa-edit"></i></span></a>
  							<a href="<?= base_url('admin/assign_item_list/'.$item->id); ?>"><span class="badge badge-info"><i
  										class="fa fa-check"></i></span></a>
  							<!-- <a href="<?=base_url('admin/delete_item/'.$item->id);?>" onclick="javascript:return confirm('<input type='text' name='name'>Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a> -->
  							<?php if($item->quantity >= 1): ?>
  							<a href="<?= base_url('admin/assign_item/'.$item->id); ?>"><span class="badge badge-info"><i
  										class="fa fa-check"></i></span></a>
  							<?php endif; ?>
  							<a data-id="<?= $item->item_ids; ?>" class="return_item"><span class="badge badge-danger"><i
  										class="fa fa-times"></i></span></a>

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

  <!-- Modal to edit assign -->
  <div class="modal fade" id="item_return" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  	aria-hidden="true">
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
  						<input type="file" name="userfile" class="form-control validate">
  					</div>

  					<div class="md-form mb-5">
  						<textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
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
