<?php $session = $this->session->userdata('user_role'); ?>
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
						<form action="<?= base_url('admin/search_suppliers') ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" id="myInput" type="search"
										placeholder="Search Suppliers Report"
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
                    <div class="column is-hidden-touch is-narrow is-hidden-print">
						<div class="field has-addons">
							<p class="control">
								<a href='<?= base_url('report/asset_report'); ?>'
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Assets</span>
								</a>
							</p>
							<p class="control">
								<a data-no-instant href='<?= base_url('report/supplier_report'); ?>'"
									class="button is-small <?= isset($filter_supplier) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Supplier</span>
								</a>
							</p>
							<p class="control">
								<a data-no-instant href='<?= base_url('report/employee_report'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Employee</span>
								</a>
							</p> 
							<p class="control">
								<a data-no-instant href='<?= base_url('report/item_report'); ?>'
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Item</span>
								</a>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a data-no-instant href='<?= base_url('report/project_report'); ?>'
									class="button is-small <?= isset($add_asset) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Project</span>
								</a>
							</p>
							<?php endif ?>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a data-no-instant href='<?= base_url('report/invoice_report'); ?>'
									class="button is-small <?= isset($add_asset) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Invoice</span>
								</a>
							</p>
							<?php endif ?>
						</div>
					</div>
				</div>
				<div class="tile is-ancestor">
					<div class="tile is-parent">
						<div class="tile is-child box">

							<div class="columns" style="display: grid">
								<div class="column table-container">
									<table class="table is-hoverable is-fullwidth">
										<caption><?php if(empty($results)){ echo ''; }else{ echo ''; } ?></caption>
										<thead>
											<tr>
												<th class="has-text-weight-semibold">ID</th>
												<th class="has-text-weight-semibold">Name</th>
												<th class="has-text-weight-semibold">Phone</th>
												<th class="has-text-weight-semibold">Location</th>
												<th class="has-text-weight-semibold">NTN</th>
												<th class="has-text-weight-semibold">Rating</th>
												<th class="has-text-weight-semibold">Category</th> 
												<th class="has-text-weight-semibold">Date</th>
												<?php if($SuppliersAccess->update == 1 || $SuppliersAccess->delete == 1) : ?>
												<th class="has-text-weight-semibold">Action</th>
												<?php endif ?>
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
												<th class="has-text-weight-semibold">Date</th>
												<?php if($SuppliersAccess->update == 1 || $SuppliersAccess->delete == 1) : ?>
												<th class="has-text-weight-semibold">Action</th>
												<?php endif ?>
											</tr>
										</tfoot> 
											<?php if(!empty($results)): foreach($results as $sup): ?>
											<tr
												onclick="window.location='<?= base_url('admin/edit_supplier/' . $sup->id); ?>';">
												<td><?= 'S2S-'.$sup->id; ?></td>
												<td><span title="<?= $sup->email; ?>"><?= ucwords($sup->name); ?></td>
												<td><?= $sup->phone; ?></td>
												<td><?= ucwords($sup->loc_name); ?></td>
												<td><?= $sup->ntn_number; ?></td>
												<td>
													<?php if(!empty($sup->rating)) : ?>
													<?php if ($sup->rating >= 5) : ?>
													<span style="color:  orange;font-size: 18px;font-weight: bold"
														class="icon is-small">5</span> <span class="far fa-star"
														style="color: orange"></span>
													<?php elseif ($sup->rating <= 1) : ?>
													<span style="color:  orange;font-size: 18px;font-weight: bold"
														class="icon is-small">1</span> <span class="far fa-star"
														style="color: orange"></span>
													<?php else : ?>
													<span style="color:  orange;font-size: 18px;font-weight: bold"
														class="icon is-small"><?= $sup->rating ?></span> <span
														class="far fa-star" style="color: orange"></span>
													<?php endif ?>
													<?php endif ?>
												</td>
												<td><?= ucwords($sup->category); ?></td> 
												<td><?= date('M d, Y', strtotime($sup->created_at)); ?></td>
												<?php if($SuppliersAccess->update == 1 || $SuppliersAccess->delete == 1) : ?>
												<td class="is-narrow">
													<?php if($SuppliersAccess->update == 1) : ?>
													<a data-no-instant href="<?= base_url('admin/edit_supplier/' . $sup->id) ?>"
														class="supplier_info button is-small"><span
															class="icon is-small"><i class="fa fa-edit"></i></span></a>
													<?php endif ?>
													<?php if($SuppliersAccess->delete == 1) : ?>
													<a data-no-instant href="<?=base_url('admin/delete_supplier/'.$sup->id);?>"
														class="button is-small"><span
															class="icon is-small has-text-danger"><i
																class="fa fa-times"></i></span></a>
													<?php endif ?>
												</td>
												<?php endif ?>
											</tr>
											<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='7'>No record found.</td></tr>"; endif; ?>
										</tbody> 
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
								<?php if(!empty($results)){ echo $this->pagination->create_links(); } ?>
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
</section>
<script>
	$(document).ready(function () {
		$(".result_limit").on('change', function () {
			var val = $(this).val();
			$(location).prop('href', '<?= current_url() ?>?<?= $this->uri->segment(2) == 'search_suppliers' ? 'search=' . $this->input->get('search') . '&' : '' ?>limit=' + val)
		})
	})
</script>