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
						<form action="<?= base_url('admin/search_item') ?>" method="GET">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Items"
										value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" required>
									<span class="icon is-small is-left">
										<i class="fas fa-search"></i>
									</span>
								</div>
								<div class="control has-addons">
									<button class="button is-small" type="submit">
										<span class="icon is-small">
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
								<button onclick="location.href='<?= base_url('admin/item_register'); ?>'"
									class="button is-small <?= (isset($item_register)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Items List</span>
								</button>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/available_item_list'); ?>'"
									class="button is-small <?= (isset($available_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="far fa-list-alt"></i>
									</span>
									<span>Available List</span>
								</button>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/get_assign_item'); ?>'"
									class="button is-small <?= (isset($assign_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-bars"></i>
									</span>
									<span>Assigned List</span>
								</button>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/add_item'); ?>'"
									class="button is-small <?= (isset($add_page)) ? 'has-background-primary-light' : '' ?>">
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
					<div class="column table-container">
						<table class="table is-hoverable is-fullwidth" id="myTable">
							<thead>
								<tr>
									<th class="has-text-weight-semibold"><abbr
											title="Item Identification Number">ID</abbr></th>
									<th class="has-text-weight-semibold">Location</th>
									<th class="has-text-weight-semibold">Category</th>
									<th class="has-text-weight-semibold">Company</th>
									<th class="has-text-weight-semibold">Model</th>
									<th class="has-text-weight-semibold">Supplier</th>
									<?php if(isset($assign_page)) : ?>
									<th class="has-text-weight-semibold">Assign To</th>
									<?php endif ?>
									<th class="has-text-weight-semibold"><abbr title="Depreciation Percentage">D%</abbr>
									</th>
									<th class="has-text-weight-semibold">Status</th>
									<th class="has-text-weight-semibold"><abbr title="Purchase Date">PD</abbr></th>
									<th class="has-text-weight-semibold is-hidden-print">Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th class="has-text-weight-semibold"><abbr
											title="Item Identification Number">ID</abbr></th>
									<th class="has-text-weight-semibold">Location</th>
									<th class="has-text-weight-semibold">Category</th>
									<th class="has-text-weight-semibold">Company</th>
									<th class="has-text-weight-semibold">Model</th>
									<th class="has-text-weight-semibold">Supplier</th>
									<?php if(isset($assign_page)) : ?>
									<th class="has-text-weight-semibold">Assigned To</th>
									<?php endif ?>
									<th class="has-text-weight-semibold"><abbr title="Depreciation Percentage">D%</abbr>
									</th>
									<th class="has-text-weight-semibold">Status</th>
									<th class="has-text-weight-semibold"><abbr title="Purchase Date">PD</abbr></th>
									<th class="has-text-weight-semibold is-hidden-print">Action</th>
								</tr>
							</tfoot>
							<tbody>
								<?php if(!empty($items)): foreach($items as $item): ?>
								<tr onclick="window.location='<?= base_url('admin/product_card/'.$item->id) ?>';">
									<td><span><?= 'S2S-'.$item->id; ?></a></td>
									<td><?= $item->name; ?></td>
									<td>
										<div class="tags"><span class="tag"><?= ucwords($item->cat_name); ?></span><span
												class="tag is-info is-light"><?= ucwords($item->names); ?></span>
										</div>
									</td>
									<td><?= ucwords($item->type_name); ?></td>
									<td><?= ucwords($item->model); ?></td>
									<td><?= ucwords($item->sup_name); ?></td>
									<?php if(isset($assign_page)) : ?>
									<td><?= ucwords($item->employ_name); ?></td>
									<?php endif; ?>
									<td><?= $item->depreciation.' (%)'; ?></td>
									<td>
										<?= $status = $item->quantity > 0 && $item->status != 1 || isset($available_page) ? '<span class="tag is-success is-light">Available</span>' : '<span class="tag is-warning is-light">Assigned</span>'; ?>
									</td>
									<td><?= date('M d, Y', strtotime($item->purchasedate)); ?></td>
									<td class="is-hidden-print is-narrow">
										<div class="field has-addons">
											<p class="control">
												<a href="<?= base_url('admin/item_detail/'.$item->id); ?>"
													class="button is-small">
													<span class="icon is-small">
														<i class="fas fa-edit"></i>
													</span>
												</a>
											</p>
											<?php if($item->quantity > 0 && $item->status != 1 || isset($available_page)): ?>
											<p class="control">
												<a href="<?= base_url('admin/assign_item/'.$item->id); ?>"
													class="button is-small">
													<span class="icon is-small has-text-success">
														<i class="fas fa-check"></i>
													</span>
												</a>
											</p>
											<?php else: ?>
											<p class="control return-btn">
												<button type="button" data-id="<?= $item->item_ids.'/'.$item->id; ?>"
													class="button is-small has-text-danger return-btn">
													<span class="icon is-small">
														<i class="fas fa-ban"></i>
													</span>
												</button>
											</p>
											<?php endif; ?>
										</div>
								</tr>
								<?php endforeach; else: echo "<tr class='has-background-danger-light'><td colspan='17'>No records found.</td></tr>"; endif; ?>
							</tbody>
						</table>
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
			</div>
		</div>
		<div class="modal" id="modal-ter">
			<div class="modal-background"></div>
			<form action="<?= base_url('admin/product_report'); ?>" method="GET">
				<div class="modal-card">
					<header class="modal-card-head">
						<p class="modal-card-title">Filter Report</p>
						<button class="delete" aria-label="close" id="exit-report-modal" type="button"></button>
					</header>
					<section class="modal-card-body">
						<div class="columns">
							<div class="column">
								<p class="control">
									From:
									<input class="input" type="date" placeholder="From" name="from_date">
								</p>
							</div>
							<div class="column">
								<p class="control">
									To:
									<input class="input" type="date" placeholder="From" name="to_date">
								</p>
							</div>
						</div>
					</section>
					<footer class="modal-card-foot">
						<button class="button is-success" type="submit">Apply</button>
						<button class="button" aria-label="close" id="close-report-modal" type="button">Cancel</button>
					</footer>
				</div>
			</form>
		</div>

		<div class="modal" id="modal-rej">
			<div class="modal-background"></div>
			<form action="<?= base_url('admin/return_item'); ?>" method="POST" enctype="multipart/form-data">
				<div class="modal-card">
					<input type="hidden" name="id" id="item-id" value="">
					<header class="modal-card-head">
						<p class="modal-card-title">Return Item</p>
						<button class="delete" aria-label="close" id="exit-return-modal" type="button"></button>
					</header>
					<section class="modal-card-body">
						<div class="columns">
							<div class="column">
								<div class="control has-icons-left">
									<div class="select is-small is-fullwidth">
										<select name="remarks" required>
											<option value="" disabled selected>Reason for Returning</option>
											<option value="damage">Damaged Item</option>
											<option value="disabled">Disabled Item</option>
										</select>
									</div>
									<span class="icon is-small is-left">
										<i class="fas fa-random"></i>
									</span>
								</div>
							</div>
							<div class="column">
								<div class="file is-small has-name is-fullwidth">
									<label class="file-label">
										<input class="file-input" name="userfile" type="file" required>
										<span class="file-cta">
											<span class="file-icon">
												<i class="fas fa-upload"></i>
											</span>
											<span class="file-label">
												Choose a file…
											</span>
										</span>
										<span class="file-name">
											Example.png
										</span>
									</label>
								</div>
							</div>
						</div>
						<div class="columns">
							<div class="column">
								<textarea name="description" class="textarea"
									placeholder="Please elaboratly describe your reason for returning the item."></textarea>
							</div>
						</div>
					</section>
					<footer class="modal-card-foot">
						<button class="button is-success" type="submit">Apply</button>
						<button class="button" aria-label="close" id="close-return-modal" type="reset">Cancel</button>
					</footer>
				</div>
			</form>
		</div>
	</div>
</section>
<script>
	$(document).ready(function () {
		$(".result_limit").on('change', function () {
			var val = $(this).val();
			$(location).prop('href', '<?= current_url() ?>?<?= $this->uri->segment(2) == 'product_report' ? 'from_date=' . $this->input->get('from_date') . '&to_date=' . $this->input->get('to_date ') . ' & ' : '' ?>limit=' + val)
		})
	})

</script>
<script>
	$('.return-btn').click(function () {
		var item_id = $(this).data('id');
		$('#item-id').val(item_id);
	});

	$(".file-input").change(function () {
		$(".file-name").text(this.files[0].name);
	});

	var btn1 = $("#report-btn")
	var btn2 = $(".return-btn")
	var btn3 = $("#exit-report-modal")
	var btn4 = $("#close-report-modal")
	var btn5 = $("#exit-return-modal")
	var btn6 = $("#close-return-modal")

	var mdl = new BulmaModal("#modal-ter")
	var md2 = new BulmaModal("#modal-rej")

	btn1.click(function (ev) {
		mdl.show();
		$(".modal-card-head").show();
		ev.stopPropagation();
	});
	btn2.click(function (ev) {
		md2.show();
		$(".modal-card-head").show();
		ev.stopPropagation();
	});
	btn3.click(function (ev) {
		mdl.close();
		ev.stopPropagation();
	});
	btn4.click(function (ev) {
		mdl.close();
		ev.stopPropagation();
	});
	btn5.click(function (ev) {
		md2.close();
		ev.stopPropagation();
	});
	btn6.click(function (ev) {
		md2.close();
		ev.stopPropagation();
	});

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
