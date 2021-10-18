 <section class="columns is-gapless mb-0 pb-0">
 	<div class="column is-narrow is-fullheight is-hidden-print" style="background-color:#fafafa;">
 		<?php $this->view('admin/commons/sidebar'); ?>
 	</div>
 	<div class="column">
 		<div class="columns">
 			<div class="column section">


 				<div class="columns is-hidden-touch">
 					<div class="column is-hidden-print">
 						<form action="<?= base_url('admin/search_categories'); ?>" method="GETbadge">
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
 					<div class="column is-hidden-print is-narrow">
 						<div class="field has-addons">
 							<p class="control">
 								<a href="<?= base_url("admin/categories") ?>"
 									class="button is-small <?= (isset($categories_page)) ? 'has-background-primary-light' : '' ?>">
 									<span class="icon is-small">
 										<i class="fas fa-plus"></i>
 									</span>
 									<span>Categories List</span>
 								</a>
 							</p>
 							<p class="control">
 								<button
 									class="add_categories button is-small <?= (isset($add_page)) ? 'has-background-primary-light' : '' ?>">
 									<span class="icon is-small">
 										<i class="fas fa-plus"></i>
 									</span>
 									<span>Add New</span>
 								</button>
 							</p>
 						</div>
 					</div>
 				</div>


 				<div class="columns" style="display: grid">
 					<div class="column table-container ">
 						<table class="table table-sm is-fullwidth">
						 <thead>
 								<tr>
 									<th class="has-text-weight-semibold">ID</th>
 									<th class="has-text-weight-semibold">Category</th>
 									<th class="has-text-weight-semibold">Added By</th>
 									<th class="has-text-weight-semibold">Date Added</th>
 									<th class="has-text-weight-semibold">Action</th>
 								</tr>
 							</thead>
							<tfoot>
 								<tr>
 									<th class="has-text-weight-semibold">ID</th>
 									<th class="has-text-weight-semibold">Category</th>
 									<th class="has-text-weight-semibold">Added By</th>
 									<th class="has-text-weight-semibold">Date Added</th>
 									<th class="has-text-weight-semibold">Action</th>
 								</tr>
 							</tfoot>
 							<?php if(empty($results)): ?>
 							<tbody>
 								<?php if(!empty($categories)): foreach($categories as $cat): ?>

 								<tr onclick="window.location='<?= base_url('admin/sub_categories/'.$cat->id) ?>';"
 									style="cursor: pointer;">
 									<td><?= 'S2S-'.$cat->id; ?></td>
 									<td><div class="tag"><?= ucwords($cat->cat_name); ?></tag></td>
 									<td><?= ucwords($cat->fullname); ?></td>
 									<td><?= date('M d, Y', strtotime($cat->created_at)); ?></td>
 									<td class="is-narrow">
 										<button type="button" title="Edit" data-id="<?= $cat->id; ?>"
 											class="category button is-small"><span class="icon is-small"><i
 													class="fa fa-edit"></i></span></button>
 										<a title="Delete" href="<?=base_url('admin/delete_category/'.$cat->id);?>"
 											class="button is-small has-text-danger"
 											onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');">
 											<span class="icon is-small"><i class="fa fa-times"></i></span></a>
 									</td>
 								</tr>
 								<?php endforeach; else: echo "<tr class='has-background-danger-light'><td colspan='17'>No record found.</td></tr>"; endif; ?>
 							</tbody>
 							<?php else: ?>
 							<tbody>
 								<?php if(!empty($results)): foreach($results as $res): ?>
 								<tr onclick="window.location='<?= base_url('admin/sub_categories/'.$res->id) ?>';"
 									style="cursor: pointer;">
 									<td><?= 'S2S-'.$res->id; ?></td>
 									<td><div class="tag"><?= ucwords($res->cat_name); ?></div></td>
 									<td><?= ucwords($res->fullname); ?></td>
 									<td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
 									<td class="is-narrow">
 										<a title="Edit" data-id="<?= $res->id; ?>"
 											class="category button is-small"><span class="icon is-small"><i
 													class="fa fa-edit"></i></span></a>
 										<a title="Delete" href="<?=base_url('admin/delete_category/'.$res->id);?>"
 											class="button is-small has-text-danger"
 											onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"
 											class=""><span class="icon is-small "><i
 													class="fa fa-times"></i></span></a>
 									</td>
 								</tr>
 								<?php endforeach; else: echo "<tr class='has-background-danger-light'><td colspan='7'>No record found.</td></tr>"; endif; ?>
 							</tbody>
 							<?php endif; ?>
 						</table>
 					</div>
 				</div>
 			</div>
 </section>

 <!-- Add inventory -->
 <div class="modal" id="add_inventory">
 	<div class="modal-background"></div>
 	<form action="<?=base_url('admin/add_category');?>" method="post">
 		<div class="modal-card">
 			<header class="modal-card-head">
 				<p class="modal-card-title">Add Category</p>
 				<button class="delete" aria-label="close" id="exit-cat-modal" type="button"></button>
 			</header>
 			<section class="modal-card-body">
 				<div class="columns is-vcentered">
 					<div class="column">
 						<div class="field">
 							<label for="Category Name" class="label is-small has-text-weight-semibold">Category Title
 								<span class="has-text-danger">*</span></label>
 							<div class="control has-icons-left">
 								<input name="cat_name" type="text" id="form34" class="input is-small" type="text"
 									placeholder="e.g Electronics" required>
 								<span class="icon is-small is-left">
 									<i class="fas fa-tags"></i>
 								</span>
 							</div>
 						</div>
 					</div>
 				</div>
 			</section>
 			<footer class="modal-card-foot">
 				<button class="button is-success" type="submit">Add</button>
 				<button class="button" aria-label="close" id="close-cat-modal" type="button">Cancel</button>

 			</footer>
 		</div>
 	</form>
 </div>
 <!-- Update inventory -->
 <div class="modal" id="edit_inventory">
 	<div class="modal-background"></div>
 	<form action="<?=base_url('admin/update_category');?>" method="post" method="post">
 		<div class="modal-card">
 			<header class="modal-card-head">
 				<p class="modal-card-title">Update Category</p>
 				<button class="delete" aria-label="close" id="exit-catedt-modal" type="button"></button>
 			</header>
 			<section class="modal-card-body">
 				<div class="columns">
 					<div class="column">
 						<div class="field">
 							<label for="Category Name" class="label is-small has-text-weight-semibold">Category Title
 								<span class="has-text-danger">*</span></label>
 							<div class="control has-icons-left">
 								<input name="cat_name" id="cat_name" type="text" class="input is-small" type="text"
 									placeholder="e.g Electronics" required>
 								<span class="icon is-small is-left">
 									<i class="fas fa-tags"></i>
 								</span>
 							</div>
 						</div>
 					</div>
 				</div>

 			</section>
 			<footer class="modal-card-foot">
 				<button class="button is-success" type="submit">Update</button>
 				<button class="button" aria-label="close" id="close-catedt-modal" type="button">Cancel</button>

 			</footer>
 		</div>
 	</form>
 </div>
 <!-- Script for showing up the modal -->
 <script>
 	var cat1 = $("#exit-cat-modal")
 	var cat2 = $("#close-cat-modal")
 	var catmdl = new BulmaModal("#add_inventory")

 	cat1.click(function (ev) {
 		catmdl.close();
 		ev.stopPropagation();
 	});
 	cat2.click(function (ev) {
 		catmdl.close();
 		ev.stopPropagation();
 	});

 	$('.add_categories').click(function (ev) {
 		catmdl.show();
 		$(".modal-card-head").show();
 		ev.stopPropagation();
 	});

 	// code for updat categories
 	var catedt1 = $("#exit-catedt-modal")
 	var catedt2 = $("#close-catedt-modal")
 	var catedtmdl = new BulmaModal("#edit_inventory")
 	catedt1.click(function (ev) {
 		catedtmdl.close();
 		ev.stopPropagation();
 	});
 	catedt2.click(function (ev) {
 		catedtmdl.close();
 		ev.stopPropagation();
 	});

 	$(document).ready(function () {
 		$('.category').click(function (event) {
 			var category_id = $(this).data('id');
 			// AJAX request
 			$.ajax({
 				url: '<?= base_url('admin/edit_category/'); ?>' + category_id,
 				method: 'POST',
 				dataType: 'JSON',
 				data: {
 					category_id: category_id
 				},
 				success: function (response) {
 					$('#cat_id').val(response.id);
 					$('#cat_location').val(response.cat_location);
 					$('#cat_name').val(response.cat_name);
 					// $('.edit-modal-body').html(response);
 					// // Display Modal
 					catedtmdl.show();
 					$(".modal-card-head").show();
 				}
 			});
 			event.stopPropagation();
 		});
 	});

 </script>
