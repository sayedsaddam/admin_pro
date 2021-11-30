<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" id="custom-sidebar">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section py-5">
				<div class="columns">
					<div class="column">
						<?php $this->view('admin/commons/breadcrumb'); ?>
					</div>
				</div>
				<div class="columns is-hidden-touch">
					<div class="column is-hidden-print">
						<form action="<?= base_url('admin/search_sub_categories'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input type="hidden" name="cat_id" value="<?= isset($cat_id) ? $cat_id : $this->input->get('cat_id') ?>">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Subcategories" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
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
									class="button is-small <?= isset($categories_page) || isset($search_sub_categories_page) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Categories List</span>
								</a>
							</p>
							<p class="control">
								<button
									class="add_inventory button is-small <?= (isset($add_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add Subcategory</span>
								</button>
							</p>
						</div>
					</div>
				</div>
				<div class="tile is-ancestor">
 					<div class="tile is-parent">
 						<div class="tile is-child box">
							<div class="columns" style="display: grid">
								<div class="column table-container">
									<table class="table is-hoverable is-fullwidth">
									<thead>
											<tr>
												<th class="has-text-weight-semibold">ID</th>
												<th class="has-text-weight-semibold">Subcategory</th>
												<th class="has-text-weight-semibold">Added By</th>
												<th class="has-text-weight-semibold">Date Added</th>
												<th class="has-text-weight-semibold">Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th class="has-text-weight-semibold">ID</th>
												<th class="has-text-weight-semibold">Subcategory</th>
												<th class="has-text-weight-semibold">Added By</th>
												<th class="has-text-weight-semibold">Date Added</th>
												<th class="has-text-weight-semibold">Action</th>
											</tr>
										</tfoot>
										<?php if(empty($results)): ?>
										<tbody id="myTable">
											<?php if(!empty($sub_categories)): foreach($sub_categories as $cat): ?>
											<tr>
												<td><?= 'S2S-'.$cat->id; ?></td>
												<td><div class="tag is-info is-light"><?= ucwords($cat->name); ?></div></td>
												<td><?= ucwords($cat->fullname); ?></td>
												<td><?= date('M d, Y', strtotime($cat->created_at)); ?></td>
												<td class="is-narrow">
													<a title="Edit" data-id="<?= $cat->id; ?>"
														class="edit_inventory button is-small"><span class="icon is-small"><i
																class="fa fa-edit"></i></span></a>
													<a data-no-instant title="Delete" href="<?=base_url('admin/delete_sub_category/'.$cat->id);?>"
														onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"
														class="button is-small"><span class="icon is-small has-text-danger"><i
																class="fa fa-times"></i></span></a>
												</td>
											</tr>
											<?php endforeach; else: echo "<tr class='has-background-danger-light'><td colspan='17'>No record found.</td></tr>"; endif; ?>
										</tbody>
										<?php else: ?>
										<tbody>
											<?php if(!empty($results)): foreach($results as $res): ?>
											<tr>
												<td><?= 'S2S-'.$res->id; ?></td>
												<td><div class="tag is-light is-success"><?= ucwords($res->name); ?></div></td>
												<td><?= ucwords($res->fullname); ?></td>
												<td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
												<td class="is-narrow">
													<a title="Edit" data-id="<?= $res->id; ?>"
														class="edit_inventory button is-small"><span class="icon is-small"><i
																class="fa fa-edit"></i></span></a>
													<a data-no-instant title="Delete" href="<?=base_url('admin/delete_sub_category/'.$res->id);?>"
														onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"
														class="button is-small"><span class="icon is-small has-text-danger"><i
																class="fa fa-times"></i></span></a>
												</td>
											</tr>
											<?php endforeach; else: echo "<tr class='has-background-danger-light text-center'><td colspan='17'>No record found.</td></tr>"; endif; ?>
										</tbody>
										<?php endif; ?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="columns">
						<div class="column is-hidden-print">
							<label class="mr-2">Number of Records:</label>
							<select class="result_limit">
								<option <?= $this->input->get('limit') == 25 ? 'selected' : '' ?> value="25">25
								</option>
								<option <?= $this->input->get('limit') == 50 ? 'selected' : '' ?> value="50">50
								</option>
								<option <?= $this->input->get('limit') == 100 ? 'selected' : '' ?> value="100">100
								</option>
							</select>
						</div>
						<div class="column is-hidden-print">
							<nav class="pagination is-small" role="navigation" aria-label="pagination"
								style="justify-content: center;">
								<?php if(empty($results) AND !empty($items)){ echo $this->pagination->create_links(); } ?>
							</nav>
						</div>
						<div class="column is-hidden-print">
							<div class="buttons is-pulled-right">
								<button onClick="window.print();" type="button" class="button is-small ">
									<span class="icon is-small">
										<i class="fas fa-print"></i>
									</span>
									<span>Print</span>
								</button>
								<a data-no-instant href="javascript:exportTableToExcel('myTable','Item  Records');" type="button"
									class="button is-small ">
									<span class="icon is-small">
										<i class="fas fa-file-export"></i>
									</span>
									<span>Export</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>
 <script>
	$(document).ready(function () {
		$(".result_limit").on('change', function () {
			var val = $(this).val();
			$(location).prop('href', '<?= current_url() ?>?<?= $this->uri->segment(2) == 'search_sub_categories' ? 'search=' . $this->input->get('search') . '&' : '' ?><?= $this->input->get('cat_id') ? 'cat_id=' . $this->input->get('cat_id') . '&' : '' ?>limit=' + val)
		})
	})
</script>
<div class="modal" id="add_inventory">
	<div class="modal-background"></div>
	<form action="<?=base_url('admin/add_sub_category');?>" method="post">
		<input type="hidden" name="parent_category" value="<?= $this->uri->segment(3); ?>">
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title">Add Subcategory</p>
				<button class="delete" aria-label="close" id="exit-subcat-modal" type="button"></button>
			</header>
			<section class="modal-card-body">
				<div class="columns">
					<div class="column">
						<div class="field">
							<label for="Category Name" class="label is-small has-text-weight-semibold">Subcategory Title
								<span class="has-text-danger">*</span></label>
							<div class="control has-icons-left">
								<input name="name" id="form34" type="text" class="input is-small" type="text"
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
	<form action="<?=base_url('admin/update_sub_category');?>" method="post" method="post">
		<input type="hidden" name="sub_cat_id" id="subId" value="">
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title">Update Subcategory</p>
				<button class="delete" aria-label="close" id="exit-catedt-modal" type="button"></button>
			</header>
			<section class="modal-card-body">
				<div class="columns">
					<div class="column">
						<div class="field">
							<label for="Category Name" class="label is-small has-text-weight-semibold">Subcategory Title
								<span class="has-text-danger">*</span></label>
							<div class="control has-icons-left">
								<input name="name" id="name" type="text" class="input is-small" type="text"
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
	// add subcategories code 
	var subcat1 = $("#exit-subcat-modal")
	var subcat2 = $("#close-cat-modal")
	var subedt1 = $("#exit-catedt-modal")
	var subedt2 = $("#close-catedt-modal")

	var subcatmdl = new BulmaModal("#add_inventory")
	var subedtmdl = new BulmaModal("#edit_inventory")

	subcat1.click(function (ev) {
		subcatmdl.close();
		ev.stopPropagation();
	});

	subcat2.click(function (ev) {
		subcatmdl.close();
		ev.stopPropagation();
	});

	$('.add_inventory').click(function (ev) {
		subcatmdl.show();
		$(".modal-card-head").show();
		ev.stopPropagation();
	});

	// code for edit 
	subedt1.click(function (ev) {
		subedtmdl.close();
		ev.stopPropagation();
	});

	subedt2.click(function (ev) {
		subedtmdl.close();
		ev.stopPropagation();
	});

	$(document).ready(function () {
		$('.edit_inventory').click(function () {
			var category_id = $(this).data('id');
			// AJAX request
			$.ajax({
				url: '<?= base_url('admin/edit_sub_category/'); ?>' + category_id,
				method: 'POST',
				dataType: 'JSON',
				data: {
					category_id: category_id
				},
				success: function (response) {
					console.log(response);
					$('#subId').val(response.id);
					$('#name').val(response.name);
					// $('.edit-modal-body').html(response);
					// // Display Modal 
					subedtmdl.show();
					$(".modal-card-head").show();
				}
			});
		});
	});

</script>
<script>
	$(document).ready(function () {
		$("#myInput").on("keyup", function () {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function () {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});

</script>
