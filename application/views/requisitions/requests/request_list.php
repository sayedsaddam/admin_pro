<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" id="custom-sidebar">
		<?php $this->view('requisitions/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section py-5">
				<div class="columns">
					<div class="column">
						<?php $this->view('requisitions/commons/breadcrumb'); ?>
					</div>
				</div>

				<div class="columns is-hidden-touch">
					<div class="column is-hidden-print">
						<form action="<?= base_url('requisitions/search_request'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" id="myInput" type="search"
										placeholder="Search Request"
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
								<div class="ml-1 control">
									<a href="<?= base_url('report/asset_report') ?>" class="button is-small">
										<span class="icon is-small">
											<i class="fas fa-sort-alpha-down"></i>
										</span>
										<span>Filter</span>
									</a>
								</div>
							</div>
						</form>
					</div>
					<div class="column is-hidden-print is-narrow">
						<div class="field has-addons">
							<p class="control">
								<a href='<?= base_url('admin/asset_register'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Assets List</span>
								</a>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a href='<?= base_url('admin/add_asset'); ?>'"
									data-target="#add_supplier"
									class="button is-small <?= (isset($add_asset)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</a>
							</p>
							<?php endif ?>
						</div>
					</div>
				</div>

				<?php if($this->session->flashdata('success')) : ?>
				<div class="columns">
					<div class="column">
						<div class="notification is-success is-light">
							<button class="delete"></button>
							<?= $message = $this->session->flashdata('success'); ?>
						</div>
					</div>
				</div>
				<?php elseif($this->session->flashdata('failed')) : ?>
				<div class="columns">
					<div class="column">
						<div class="notification is-danger is-light">
							<button class="delete"></button>
							<?= $message = $this->session->flashdata('failed'); ?>
						</div>
					</div>
				</div>
				<?php endif ?>

				<div class="tile is-ancestor">
					<div class="tile is-parent">
						<div class="tile is-child box">
							<div class="columns" style="display: grid">
								<div class="column table-container ">
									<table class="table is-hoverable table-sm is-fullwidth">
										<thead>
											<tr>
												<th class="has-text-weight-semibold">ID</th>
												<th class="has-text-weight-semibold">Item</th>
												<th class="has-text-weight-semibold">Description</th>
												<th class="has-text-weight-semibold">Requested By</th> 
												<th class="has-text-weight-semibold">Quantity</th>
												<th class="has-text-weight-semibold">Date</th>
 												<th class="has-text-weight-semibold">Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
                                            <th class="has-text-weight-semibold">ID</th>
												<th class="has-text-weight-semibold">Item</th>
												<th class="has-text-weight-semibold">Description</th>
												<th class="has-text-weight-semibold">Requested By</th> 
												<th class="has-text-weight-semibold">Quantity</th>
												<th class="has-text-weight-semibold">Date</th>
 												<th class="has-text-weight-semibold">Action</th>
											</tr>
										</tfoot>
										<?php if(empty($results)): ?>
										<tbody>
											<?php if(!empty($requests)): foreach($requests as $request): ?>
											<tr>
												<td><?= 'S2S-0'.$request->id; ?></td> 
                                                <td><?= ucwords($request->type_name); ?></td>
												<td><span class="is-size-7"><?= ucwords(substr($request->item_desc,0,75)); ?></span></td>
												<td><?= ucwords($request->fullname); ?></td>
                                                <td><?= ucwords($request->item_qty); ?></td>
												<td><?= ucwords($request->date); ?></td> 
												<td class="is-narrow">
													<div class="field has-addons"> 
														<p class="control">
															<a href="<?= base_url('admin/asset_detail/'.$request->id); ?>"
																class="button is-small">
																<span class="icon is-small">
																	<i class="fas fa-edit"></i>
																</span>
															</a>
														</p>  
														<a data-no-instant href="<?=base_url('admin/delete_asset/'.$request->id);?>"
															onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"
															class="button is-small"><span
																class="icon is-small has-text-danger"><i
																	class="fa fa-times"></i></span></a> 
													</div>
												</td> 
											</tr>
											<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
										</tbody>
										<?php else: ?>
										<tbody>
											<?php if(!empty($results)): foreach($results as $res): ?>
                                                <tr>
												<td><?= 'S2S-0'.$res->id; ?></td> 
                                                <td><?= ucwords($res->type_name); ?></td>
												<td><span class="is-size-7"><?= ucwords(substr($res->item_desc,0,75)); ?></span></td>
												<td><?= ucwords($res->fullname); ?></td>
                                                <td><?= ucwords($res->item_qty); ?></td>
												<td><?= ucwords($res->date); ?></td> 
												<td class="is-narrow">
													<div class="field has-addons"> 
														<p class="control">
															<a href="<?= base_url('admin/asset_detail/'.$res->id); ?>"
																class="button is-small">
																<span class="icon is-small">
																	<i class="fas fa-edit"></i>
																</span>
															</a>
														</p>  
														<a data-no-instant href="<?=base_url('admin/delete_asset/'.$res->id);?>"
															onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"
															class="button is-small"><span
																class="icon is-small has-text-danger"><i
																	class="fa fa-times"></i></span></a> 
													</div>
												</td> 
											</tr>
											<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
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
								<?php if(empty($results) AND !empty($requests)){ echo $this->pagination->create_links(); } ?>
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
								<a href="javascript:exportTableToExcel('myTable','Item  Records');" type="button"
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
</section>
<script>
	$(document).ready(function () {
		$(".result_limit").on('change', function () {
			var val = $(this).val();
			$(location).prop('href', '<?= current_url() ?>?<?= $this->uri->segment(2) == 'search_request' ? 'search=' . $this->input->get('search') . '&' : '' ?>limit=' + val)
		})
	})
</script>