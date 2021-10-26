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
				<div class="columns is-hidden-touch">
					<div class="column is-hidden-print">
						<form action="<?= base_url('admin/search_suppliers') ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" id="myInput" type="search"
										placeholder="Search Suppliers" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" required>
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
					<div class="column is-hidden-print is-narrow">
						<div class="field has-addons">
						<p class="control">
								<a href="<?= base_url("admin/suppliers") ?>"
									class="button is-small <?= (isset($suppliers_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Suppliers List</span>
								</a>
							</p>
							<p class="control">
								<a href="<?= base_url("admin/add_supplier") ?>"
									class="button is-small <?= (isset($add_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</a>
							</p>
						</div>
					</div>
				</div> 
				<div class="columns" style="display: grid">
					<div class="column table-container ">
						<table class="table table-sm is-fullwidth">
							<caption><?php if(empty($results)){ echo ''; }else{ echo ''; } ?></caption>
							<thead>
								<tr>
									<th class="has-text-weight-semibold">ID</th>
									<th class="has-text-weight-semibold">Name</th>
									<th class="has-text-weight-semibold">Phone</th>
									<th class="has-text-weight-semibold">Location</th>
									<th class="has-text-weight-semibold">NTN</th>
									<th class="has-text-weight-semibold">Rating <small>(*)</th>
									<th class="has-text-weight-semibold">Category</th>
									<th class="has-text-weight-semibold">Status</th>
									<th class="has-text-weight-semibold">Date</th>
									<th class="has-text-weight-semibold">Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th class="has-text-weight-semibold">ID</th>
									<th class="has-text-weight-semibold">Name</th>
									<th class="has-text-weight-semibold">Phone</th>
									<th class="has-text-weight-semibold">Location</th>
									<th class="has-text-weight-semibold">NTN</th>
									<th class="has-text-weight-semibold">Rating(*)</th>
									<th class="has-text-weight-semibold">Category</th>
									<th class="has-text-weight-semibold">Status</th>
									<th class="has-text-weight-semibold">Date</th>
									<th class="has-text-weight-semibold">Action</th>
								</tr>
							</tfoot>
							<?php if(empty($results)): ?>
							<tbody>
								<?php if(!empty($suppliers)): foreach($suppliers as $sup): ?>
								<tr>
									<td><?= 'S2S-'.$sup->sup_id; ?></td>
									<td><abbr title="<?= $sup->email; ?>"><?= ucwords($sup->sup_name); ?></abbr></td>
									<td><?= $sup->phone; ?></td>
									<td><?= ucwords($sup->name); ?></td>
									<td><?= $sup->ntn_number; ?></td>
									<td>
										<?php if(!empty($sup->rating)) : ?>
											<?php if ($sup->rating >= 5) : ?>
												<span style="color:  orange;font-size: 18px;font-weight: bold" class="icon is-small">5</span> <span class="fa fa-star checked" style="color: orange"></span> 
											<?php elseif ($sup->rating <= 1) : ?>
												<span style="color:  orange;font-size: 18px;font-weight: bold" class="icon is-small">1</span> <span class="fa fa-star checked" style="color: orange"></span>
											<?php else : ?>
												<span style="color:  orange;font-size: 18px;font-weight: bold" class="icon is-small"><?= $sup->rating ?></span> <span class="fa fa-star checked" style="color: orange"></span>
											<?php endif ?>
										<?php endif ?>
									</td>
									<td><?= ucwords($sup->cat_name); ?></td>
									<td>
										<?php if($sup->status == 1): ?>
										<span class="tag is-success is-light">Active</span>
										<?php else: ?>
										<span class="tag is-warning is-light">Inactive</span>
										<?php endif; ?>
									</td>
									<td><?= date('M d, Y', strtotime($sup->created_at)); ?></td>
									<td class="is-narrow">
										<a href="<?= base_url('admin/edit_supplier/' . $sup->sup_id) ?>" class="supplier_info button is-small"><span class="icon is-small"><i
													class="fa fa-edit"></i></span></a>
                          <?php if($session == 'admin'){ ?>
										<a href="<?=base_url('admin/delete_supplier/'.$sup->sup_id);?>"	class="button is-small"><span class="icon is-small has-text-danger"><i
													class="fa fa-times"></i></span></a>
                          <?php } ?>
									</td>
								</tr>
								<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='10'>No record found.</td></tr>"; endif; ?>
							</tbody>
							<?php else: ?>
							<tbody>
								<?php if(!empty($results)): foreach($results as $sup): ?>
                  <tr>
									<td><?= 'S2S-'.$sup->id; ?></td>
									<td><span title="<?= $sup->email; ?>"><?= ucwords($sup->name); ?></td>
									<td><?= $sup->phone; ?></td>
									<td><?= ucwords($sup->name); ?></td>
									<td><?= $sup->ntn_number; ?></td>
									<td>
										<?php if(!empty($sup->rating)) : ?>
											<?php if ($sup->rating >= 5) : ?>
												<span style="color:  orange;font-size: 18px;font-weight: bold" class="icon is-small">5</span> <span class="fa fa-star checked" style="color: orange"></span> 
											<?php elseif ($sup->rating <= 1) : ?>
												<span style="color:  orange;font-size: 18px;font-weight: bold" class="icon is-small">1</span> <span class="fa fa-star checked" style="color: orange"></span>
											<?php else : ?>
												<span style="color:  orange;font-size: 18px;font-weight: bold" class="icon is-small"><?= $sup->rating ?></span> <span class="fa fa-star checked" style="color: orange"></span>
											<?php endif ?>
										<?php endif ?>
									</td>
									<td><?= ucwords($sup->category); ?></td>
									<td>
										<?php if($sup->status == 1): ?>
										<span class="badge badge-success">Active</span>
										<?php else: ?>
										<span class="badge badge-danger">Inactive</span>
										<?php endif; ?>
									</td>
									<td><?= date('M d, Y', strtotime($sup->created_at)); ?></td>
									<td class="is-narrow">
										<a href="<?= base_url('admin/edit_supplier/' . $sup->id) ?>" class="supplier_info button is-small"><span class="icon is-small"><i
													class="fa fa-edit"></i></span></a>
                          <?php if($session == 'admin'){ ?>
										<a href="<?=base_url('admin/delete_supplier/'.$sup->id);?>" 
											class="button is-small"><span class="icon is-small has-text-danger"><i
													class="fa fa-times"></i></span></a>
                          <?php } ?>
									</td>
								</tr>
								<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='7'>No record found.</td></tr>"; endif; ?>
							</tbody>
							<?php endif; ?>
						</table>
					</div>
				</div>
			</div>
</section>

<!-- Update employ code start -->
<div class="modal" id="edit_suppliers">
	<div class="modal-background"></div>
	<form action="<?=base_url('admin/update_supplier');?>" method="post" class="md-form">
	<input type="hidden" name="sup_id" id="supplierId" value="">
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title">Update Suppliers</p>
				<button class="delete" aria-label="close" id="exit-edit-modal" type="button"></button>
			</header>
			<section class="modal-card-body">
				<div class="columns">
					<div class="column">
						<div class="control">
							<label class="label is-small">Location <span class="has-text-danger">*</span></label>
							<div class="select select is-small is-fullwidth">
								<select name="location" id="supplier_location" class="browser-default custom-select ">
									<?php if(!empty($locations)): foreach($locations as $loc): ?>
									<option value="<?= $loc->id ?>"><?= ucfirst($loc->name); ?> </option>
									<?php endforeach; endif; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="column">
						<fieldset>
							<div class="field">
								<label class="label is-small">Name <span class="has-text-danger">*</span></label>
								<div class="control has-icons-left">
									<input type="text" name="name" id="supplier_name" class="input is-small" value="" type="text"
										placeholder="name ..." required="">
									<span class="icon is-small is-left">
										<i class="fas fa-user"></i>
									</span>
								</div>
							</div>
						</fieldset>
					</div>
				</div>

				<div class="columns">
					<div class="column">
						<div class="control">

							<fieldset>
								<div class="field">
									<label class="label is-small">Email <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="email" name="email" id="supplier_email" class="input is-small" value="" type="text"
											placeholder="example@yahoo.com ..." required="">
										<span class="icon is-small is-left">
											<i class="fas fa-envelope-square"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
					</div>
					<div class="column">
						<div class="control">
							<label class="label is-small">Phone No <span class="has-text-danger">*</span></label>
							<div class="select select is-small is-fullwidth select is-multiple">
								<input type="number" name="phone" id="supplier_phone" class="input is-small" value="" type="text"
									placeholder="example@yahoo.com ..." required="">
							</div>
						</div>
					</div>
				</div>

        <div class="columns">
					<div class="column">
						<label class="label is-small">Catergory <span class="has-text-danger">*</span></label>
						<div class="select is-small is-fullwidth select is-multiple">
							<select name="category" id="category" multiple size="2" required>
                <?php if(!isset($edit_item)): ?>
												<option selected disabled>Select Category</option>
												<?php endif ?>
												<?php if(!empty($categories)): foreach($categories as $cat): ?>
												<option value="<?= $cat->id; ?>"
													<?= !empty($edit) && $edit->id == $cat->id ? 'selected' : '' ?>><?= $cat->cat_name; ?>
												</option>
												<?php endforeach; endif; ?>
							</select>
						</div>
					</div>

					<div class="column">
						<fieldset>
							<div class="field">
								<label class="label is-small">NTN </label>
								<div class="control has-icons-left">
									<input type="text" name="ntn_number" id="supplier_ntn" class="input is-small" value="" placeholder="ntn_number ...">
									<span class="icon is-small is-left">
										<i class="fas fa fa-globe"></i>
									</span>
								</div>
							</div>
						</fieldset>
					</div>
				</div>

				<div class="columns">
					<div class="column">
						<label class="label is-small"> Rating <span class="has-text-danger">*</span></label>
						<div class="is-small is-fullwidth">
							<input type="number" name="rating" id="supplier_rating"  class="input is-small" value="" placeholder="rating ...">
						</div>
					</div>

					<div class="column">
						<fieldset>
							<div class="field">
								<label class="label is-small">Address</label>
								<div class="control has-icons-left">
									<textarea class="textarea is-small" name="address" rows="1" id="supplier_address"
										placeholder="some detail"></textarea>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
 

			</section>
			<footer class="modal-card-foot">
				<button class="button is-success" type="submit">Apply</button>
				<button class="button" aria-label="close" id="close-edit-modal" type="button">Cancel</button>

			</footer>
		</div>
	</form>
</div>
<!-- update eploy code end -->

<script>
  // code to updat suppliers
  var empedt1 = $("#exit-edit-modal")
 	var empedt2 = $("#close-edit-modal")
 	var empedtmdl = new BulmaModal("#edit_suppliers")
 	empedt1.click(function (ev) {
 		empedtmdl.close();
 		ev.stopPropagation();
 	});
 	empedt2.click(function (ev) {
 		empedtmdl.close();
 		ev.stopPropagation();
 	});  

	$(document).ready(function () {
		$('.supplier_info').click(function () {
			var supplier_id = $(this).data('id');
			// AJAX request
			$.ajax({
				url: '<?= base_url('admin/edit_supplier/'); ?>' + supplier_id,
				method: 'POST',
				dataType: 'JSON',
				data: {
					supplier_id: supplier_id
				},
				success: function (response) {
					console.log(response);
					$('#supplierId').val(response.id);
					$('#supplier_location').val(response.location);
					$('#supplier_name').val(response.name);
					$('#category').val(response.category);
					$('#supplier_email').val(response.email);
					$('#supplier_phone').val(response.phone);
					$('#supplier_ntn').val(response.ntn_number);
					$('#supplier_rating').val(response.rating);
					$('#supplier_address').val(response.address);
					// $('.edit-modal-body').html(response);
					// Display Modal
					// $('#edit_supplier').modal('show');
          empedtmdl.show(); 
				}
			});
      event.stopPropagation();
		});
	});

</script>
