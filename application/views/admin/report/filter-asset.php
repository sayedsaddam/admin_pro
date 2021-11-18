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
						<form action="<?= base_url('admin/filter_asset'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" id="myInput" type="search"
										placeholder="Search Assets Report"
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
										<i class="fas fa-file"></i>
									</span>
									<span>Assets</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('report/supplier_report'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Supplier</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/asset_register'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Employee</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/asset_register'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Item Category</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('admin/asset_register'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Item</span>
								</a>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a href='<?= base_url('admin/add_asset'); ?>'"
									class="button is-small <?= isset($add_asset) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
									</span>
									<span>Project</span>
								</a>
							</p>
							<?php endif ?>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a href='<?= base_url('admin/add_asset'); ?>'"
									class="button is-small <?= isset($add_asset) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-file"></i>
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
								<div class="column table-container ">
									<table class="table table-sm is-fullwidth" id="myTable">
										<thead>
											<tr>
												<th class="has-text-weight-semibold">ID</th>
												<th class="has-text-weight-semibold">Category</th> 
												<th class="has-text-weight-semibold"><abbr
														title="Quantity">Quantity</abbr></th>
												<th class="has-text-weight-semibold"><abbr
														title="Purchase Date">PD</abbr></th>
												<th class="has-text-weight-semibold">Location</th>
												<th class="has-text-weight-semibold">User</th> 
												<?php if($AssetsAccess->update == 1 || $AssetsAccess->delete == 1) : ?>
												<th class="has-text-weight-semibold is-hidden-print">Action</th>
												<?php endif ?>
											</tr>
										</thead>
										<tfoot class="is-hidden-print">
											<tr>
												<th class="has-text-weight-semibold">ID</th>
												<th class="has-text-weight-semibold">Category</th> 
												<th class="has-text-weight-semibold"><abbr
														title="Quantity">Quantity</abbr></th>
												<th class="has-text-weight-semibold"><abbr
														title="Purchase Date">PD</abbr></th>
												<th class="has-text-weight-semibold">Location</th>
												<th class="has-text-weight-semibold">User</th> 
												<?php if($AssetsAccess->update == 1 || $AssetsAccess->delete == 1) : ?>
												<th class="has-text-weight-semibold is-hidden-print">Action</th>
												<?php endif ?>
											</tr>
										</tfoot>
										<?php if(empty($results)): ?>
										<?php else: ?>
										<tbody>
											<?php if(!empty($results)): foreach($results as $res): ?>
											<tr> 
												<td><?= 'S2S-0'.$res->id; ?></td>
												<td><?= $res->cat_name; ?></td> 
												<td><?= ucfirst($res->quantity); ?></td>
												<td><?= ucfirst($res->purchase_date); ?></td>
												<td><?= ucfirst($res->loc_name); ?></td>
												<td><?= ucfirst($res->user); ?></td>  
												</td>
												<td class="is-narrow is-hidden-print">
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
															class="button is-small"><span
																class="icon is-small has-text-danger"><i
																	class="fa fa-times"></i></span></a>
														<?php endif ?>
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
							<div class="buttons is-pulled-right">
								<button onClick="window.print();" type="button" class="button is-small ">
									<span class="icon is-small">
										<i class="fas fa-print"></i>
									</span>
									<span>Print</span>
								</button>
								<a href="javascript:exportTableToExcel('myTable','Assets Reports');" type="button"
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
			$(location).prop('href', '<?= current_url() ?>?<?= $this->uri->segment(2) == 'search_asset_register' ? 'search=' . $this->input->get('search') . '&' : '' ?>limit=' + val)
		})
	})

	function exportTableToExcel(tableId, filename) {
		let dataType = 'application/vnd.ms-excel';
		let extension = '.xls';

		let base64 = function (s) {
			return window.btoa(unescape(encodeURIComponent(s)))
		};

		let template =
			'<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';
		let render = function (template, content) {
			var r1 = template.replace(/{(\w+)}/g, function (m, p) {
				return content[p];
			});
			var r2 = r1.replace(/{(\w+)}/g, function (m, p) {
				return content[p];
			});
			return r2
		};

		let tableElement = document.getElementById(tableId);

		let tableExcel = render(template, {
			worksheet: filename,
			table: tableElement.innerHTML
		});

		filename = filename + extension;

		if (navigator.msSaveOrOpenBlob) {
			let blob = new Blob(
				['\ufeff', tableExcel], {
					type: dataType
				}
			);

			navigator.msSaveOrOpenBlob(blob, filename);
		} else {
			let downloadLink = document.createElement("a");

			document.body.appendChild(downloadLink);

			downloadLink.href = 'data:' + dataType + ';base64,' + base64(tableExcel);

			downloadLink.download = filename;

			downloadLink.click();
		}
	}

</script>
