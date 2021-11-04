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
										placeholder="Search Employees"
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
								<button onclick="location.href='<?= base_url('admin/projects'); ?>'"
									class="button is-small <?= isset($project_list) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Project List</span>
								</button>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/add_project'); ?>'"
									data-target="#add_supplier"
									class="button is-small <?= (isset($add_project)) ? 'has-background-primary-light' : '' ?>">
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
									<th class="has-text-weight-semibold">Projects</th>
									<th class="has-text-weight-semibold">Description</th>
									<th class="has-text-weight-semibold">Status</th>
								
									<th class="has-text-weight-semibold">Action</th>
								</tr>
							</thead>
							<?php if(empty($results)): ?>
							<tbody>
								<?php if(!empty($projects)): foreach($projects as $project): ?>
								<tr>
									<td><?= 'S2S-0'.$project->id; ?></td>
									<td>
										<div class="tag"><?= $project->project_name; ?></div>
									</td>
									<td><?= ucfirst($project->project_desc); ?></td>
									<td><?php  if($project->status == 1){echo "<span class='tag is-warning'>Progress</span>";}else{echo "<span class='tag is-primary'>Complete</span>";} ?></td> 
								
									<td class="is-narrow">
										<div class="field has-addons"> 
											<p class="control">
												<a href="<?= base_url('admin/edit_project/'.$project->id); ?>"
													class="button is-small">
													<span class="icon is-small">
														<i class="fas fa-edit"></i>
													</span>
												</a>
											</p> 
											<a href="<?=base_url('admin/complete_project/'.$project->id);?>"
												class="button is-small"><span class="icon is-small has-text-success"><i
														class="fa fa-check"></i></span></a> 
										</div>
									</td> 
								</tr>
								<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
							</tbody>
							<?php else: ?>
							<tbody>
								<?php if(!empty($results)): foreach($results as $res): ?>
								<tr>

									<td><?= 'CTC-0'.$res->id; ?></td>
									<td><?= $res->project_name; ?></td>
									<td><?= ucfirst($res->project_desc); ?></td>
									<td><?= ucfirst($res->status); ?></td> 
									<td class="is-narrow">
										<div class="field has-addons"> 
											<p class="control">
												<a href="<?= base_url('admin/edit_project/'.$res->id); ?>"
													class="button is-small">
													<span class="icon is-small">
														<i class="fas fa-edit"></i>
													</span>
												</a>
											</p> 
											<a href="<?=base_url('admin/complete_project/'.$res->id);?>"
												class="button is-small"><span class="icon is-small has-text-success"><i
														class="fa fa-check"></i></span></a>
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
							<?php if(empty($results) AND !empty($projects)){ echo $this->pagination->create_links(); } ?>
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