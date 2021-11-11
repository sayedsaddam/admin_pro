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
						<form action="<?= base_url('admin/search_asset_register'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" id="myInput" type="search"
										placeholder="Search Assets"
										value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" required>
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
								<button onclick="location.href='<?= base_url('admin/asset_register'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Assets List</span>
								</button>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/add_asset'); ?>'"
									data-target="#add_supplier"
									class="button is-small <?= (isset($add_asset)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</button>
							</p>
							<?php endif ?>
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
									<th class="has-text-weight-semibold">Description</th>
									<th class="has-text-weight-semibold"><abbr title="Quantity">Quantity</abbr></th>
									<th class="has-text-weight-semibold"><abbr title="Purchase Date">PD</abbr></th>
									<th class="has-text-weight-semibold">Location</th>
									<th class="has-text-weight-semibold">User</th>
									<th class="has-text-weight-semibold">Remarks</th>
									<?php if($AssetsAccess->update == 1 || $AssetsAccess->delete == 1) : ?>
									<th class="has-text-weight-semibold">Action</th>
									<?php endif ?>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th class="has-text-weight-semibold">ID</th>
									<th class="has-text-weight-semibold">Category</th>
									<th class="has-text-weight-semibold">Description</th>
									<th class="has-text-weight-semibold"><abbr title="Quantity">Quantity</abbr></th>
									<th class="has-text-weight-semibold"><abbr title="Purchase Date">PD</abbr></th>
									<th class="has-text-weight-semibold">Location</th>
									<th class="has-text-weight-semibold">User</th>
									<th class="has-text-weight-semibold">Remarks</th>
									<?php if($AssetsAccess->update == 1 || $AssetsAccess->delete == 1) : ?>
									<th class="has-text-weight-semibold">Action</th>
									<?php endif ?>
								</tr>
							</tfoot>
							<?php if(empty($results)): ?>
							<tbody>
								<?php if(!empty($assets)): foreach($assets as $asset): ?>
								<tr>
									<td><?= 'S2S-0'.$asset->id; ?></td>
									<td>
										<div class="tag"><?= $asset->cat_name; ?></div>
									</td> 
									<td><?= ucfirst(substr($asset->description,0,50)); ?></td>
									<td><?= ucfirst($asset->quantity); ?></td>
									<td><?= ucfirst($asset->purchase_date); ?></td>
									<td><?= ucfirst($asset->name); ?></td>
									<td><?= ucfirst($asset->fullname); ?></td>
									<td><?= ucfirst($asset->remarks); ?></td>
									<?php if($AssetsAccess->update == 1 || $AssetsAccess->delete == 1) : ?>
									<td class="is-narrow">
										<div class="field has-addons">
											<?php if($AssetsAccess->update == 1) : ?>
											<p class="control">
												<a href="<?= base_url('admin/asset_detail/'.$asset->id); ?>"
													class="button is-small">
													<span class="icon is-small">
														<i class="fas fa-edit"></i>
													</span>
												</a>
											</p>
											<?php endif ?>
											<?php if ($AssetsAccess->delete == 1) : ?>
											<a href="<?=base_url('admin/delete_asset/'.$asset->id);?>"
												onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"
												class="button is-small"><span class="icon is-small has-text-danger"><i
														class="fa fa-times"></i></span></a>
											<?php endif ?>
										</div>
									</td>
									<?php endif ?>
								</tr>
								<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
							</tbody>
							<?php else: ?>
							<tbody>
								<?php if(!empty($results)): foreach($results as $res): ?>
								<tr>

									<td><?= 'CTC-0'.$res->id; ?></td>
									<td><?= $res->cat_name; ?></td>
									<td><?= ucfirst(substr($res->description,0,50)); ?></td>
									<td><?= ucfirst($res->quantity); ?></td>
									<td><?= ucfirst($res->purchase_date); ?></td>
									<td><?= ucfirst($res->location); ?></td> 
									<td><?= ucfirst($res->user); ?></td>
									<td><?= ucfirst($res->remarks); ?></td>  
                   
                  </td>  
									<td class="is-narrow">
										<div class="field has-addons">
											<?php if($AssetsAccess->update == 1) : ?>
											<p class="control">
												<a href="<?= base_url('admin/asset_detail/'.$res->id); ?>"
													class="button is-small">
													<span class="icon is-small">
														<i class="fas fa-edit"></i>
													</span>
												</a>
											</p>
											<?php endif ?>
											<?php if ($AssetsAccess->delete == 1) : ?>
											<a href="<?=base_url('admin/delete_asset/'.$res->id);?>"
												onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"
												class="button is-small"><span class="icon is-small has-text-danger"><i
														class="fa fa-times"></i></span></a>
											<?php endif ?>
										</div>
									</td>
								</tr>
								<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
							</tbody>
							<?php endif; ?>
						</table>
						<div class="column" style="display: flex; justify-content: center;">
						<label class="mr-2">Number of Records:</label>
						<select class="result_limit">
							<option <?= $this->input->get('limit') == 25 ? 'selected' : '' ?> value="25">25</option>
							<option <?= $this->input->get('limit') == 50 ? 'selected' : '' ?> value="50">50</option>
							<option <?= $this->input->get('limit') == 100 ? 'selected' : '' ?> value="100">100</option>
						</select>
					</div>
					<div class="column is-hidden-print">
						<nav class="pagination is-small" role="navigation" aria-label="pagination"
							style="justify-content: center;">
							<?php if(empty($results) AND !empty($assets)){ echo $this->pagination->create_links(); } ?>
						</nav>
					</div> 
					</div>
				</div>
			</div>
</section>
<script>
	$(document).ready(function() {
		$(".result_limit").on('change', function() {
			var val = $(this).val();
			$(location).prop('href', '<?= current_url() ?>?limit=' + val)
		})
	})
</script>