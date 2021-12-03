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
						<form action="<?= base_url('admin/search_invoices'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" id="myInput" type="search"
										placeholder="Filter Invoices"
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
									class="button is-small <?= isset($asset_report) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Assets</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('report/supplier_report'); ?>'
									class="button is-small <?= isset($supplier_report) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Supplier</span>
								</a>
							</p>
							<p class="control">
								<a href='<?= base_url('report/employee_report'); ?>'
									class="button is-small <?= isset($employees_filter) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Employee</span>
								</a>
							</p> 
							<p class="control">
								<a href='<?= base_url('report/item_report'); ?>'
									class="button is-small <?= isset($item_report) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Item</span>
								</a>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a href='<?= base_url('report/project_report'); ?>'
									class="button is-small <?= isset($project_report) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Project</span>
								</a>
							</p>
							<?php endif ?>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<a href='<?= base_url('report/invoice_report'); ?>'
									class="button is-small <?= isset($filter_invoice) ? 'has-background-primary-light' : '' ?>">
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
								<div class="column table-container ">
									<table class="table table-sm is-fullwidth">
										<thead>
											<tr>
												<th class="has-text-weight-semibold">ID</th>
												<th class="has-text-weight-semibold">Inv No.</th>
												<th class="has-text-weight-semibold">Supplier</th>
												<th class="has-text-weight-semibold">Location</th>
												<th class="has-text-weight-semibold">Project</th>
												<th class="has-text-weight-semibold">Item</th>
												<th class="has-text-weight-semibold">Amount</th>
												<th class="has-text-weight-semibold">Date</th>
												<th class="has-text-weight-semibold">R/Reason</th>
												<th class="has-text-weight-semibold">Status</th>
												<th class="has-text-weight-semibold">Action</th>
											</tr>
										</thead>
										 
										<tbody id="myTable">
											<?php if(!empty($results)): $expenses = 0; foreach($results as $res): $expenses += $res->amount; ?>
											<tr>
												<td><?= 'S2S-'.$res->id; ?></td>
												<td><?= $res->inv_no; ?></td>
												<td><?= $res->sup_name; ?></td>
												<td><?= ucfirst($res->name); ?></td>
												<td><?= $res->project_name; ?></td>
												<td><?= $res->item; ?></td>
												<td><?= number_format($res->amount); ?></td>
												<td><?php if($res->inv_date){ echo date('M d, Y', strtotime($res->inv_date)); }else{ echo '--/--/--'; } ?>
											    <td><?= $res->status_reason; ?></td>	
											</td>
												<td><?php if($res->status == 0){ echo "<span class='tag is-warning is-light'>Pending</span>"; }else{ echo "<span class='tag is-success is-light'>Cleared</span>"; } ?>
												</td>
												<td class="">
													<div class="field has-addons">
														<a href="<?= base_url('admin/edit_invoice/' . $res->id) ?>"
															class="button is-small"><span class="icon is-small"><i
																	class="fa fa-edit"></i></span></a>
																	<?php if($res->status == 0) {?>			
														<a href="<?= base_url('admin/invoice_status/' . $res->id) ?>"
															class="button is-small"><span class="icon is-small"><i
																	class="fa fa-check"></i></span></a>
														<?php } else {?> 
																	<?php } ?> 
														<a href="<?= base_url('admin/print_invoice/' . $res->id) ?>"
															class="button is-small"><span class="icon is-small"><i
																	class="fa fa-print"></i></span></a>
													</div>
												</td>
											</tr>
											<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='9'>No record found.</td></tr>"; endif; ?>

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
								<a href="javascript:exportTableToExcel('myTable','Invoice  Records');" type="button"
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
	
				 
</section>

<script>
	$(document).ready(function () {
		$(".result_limit").on('change', function () {
			var val = $(this).val();
			$(location).prop('href', '<?= current_url() ?>?<?= $this->uri->segment(2) == 'search_invoices' ? 'search=' . $this->input->get('search') . ' & ' : '' ?>limit=' + val)
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
