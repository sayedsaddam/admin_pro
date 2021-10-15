<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" style="background-color:#fafafa;">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section">
				<div class="columns is-hidden-touch">

					<div class="column is-hidden-print">
						<div class="field has-addons">
							<p class="control">
								<button onclick="location.href='<?= base_url('Purchase/purchase_product'); ?>'"
									class="button is-small  <?= (isset($add_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Purchase Order</span>
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
									<!-- <?php echo phpinfo(); ?> -->
									<th class="font-weight-bold">ID </th>
									<th class="font-weight-bold">Supplier</th>
									<th class="font-weight-bold">Location</th>
									<th class="font-weight-bold">Product</th>
									<th class="font-weight-bold">Quantity</th>
									<th class="font-weight-bold"> Date</th>
									<th class="font-weight-bold"> Price</th>
									<th class="font-weight-bold"> Quotation</th>
									<th class="font-weight-bold">Status</th>
									<th class="font-weight-bold">Action</th>
								</tr>
							</thead>
							<?php if(empty($results)): ?>
							<tbody id="myTable">
								<?php if(!empty($items)):  $lowest_price = array_column($items, 'price'); foreach($items as $item): ?>
								<?php if($item->qut_status == 'rejected'){ ?>
								<tr style="display: none;"
									class="<?php if(min($lowest_price) == $item->price){ echo 'table-success text-dark'; } ?>">
									<td><?= 'CTC-0'.$item->purchase_id; ?></td>
									<td><?= ucfirst($item->sup_name); ?></td>
									<td><?= $item->name;?></td>
									<td><?= ucfirst($item->product); ?></span></td>
									<td><?= ucfirst($item->quantity); ?></td>
									<td> <?= date('M d, Y', strtotime($item->created_at)); ?> </td>
									<td> <?= $item->price; ?> </td>
									<td> <?= $item->description; ?> </td>
									<?php if($item->qut_status == 1) { ?>
									<td><span class="badge badge-success">Approved</span></td>
									<?php } elseif($item->qut_status == null ){ ?>
									<td><span class="tag is-secondary">Pending <span></td>
									<?php } elseif($item->qut_status == 'rejected'){ ?>
									<td><span class="badge badge-danger"><?=$item->qut_status; ?> <span></td>
									<?php } elseif($item->qut_status == 0){ ?>
									<td><span class="badge badge-warning">process <span></td>
									<?php } ?>
									<td>
										<?php "<span id='qutation'>".$quotations = $this->admin_model->count_qutation($item->purchase_id)."</span>"; ?>
										<?php if($quotations < 3) { ?>
										<a data-id="<?= $item->purchase_id.'/'.$item->sup_id; ?>"
											class="modal-add-qutation button is-small"><span class="icon is-small has-text-primary"><i
													class="fas fa-check"></i></span></a>
										<?php } else { ?>
										<?php   $quotations; ?>

										<a data-id="<?= $item->purchase_id.'/'.$item->sup_id; ?>"
											class="modal-add-qutation disabled button -s-small"><span class="icon is-small has-text-danger"><i
													class="fas fa-check"></i></span></a>
										<!-- echo "qutation is completed"; -->
										<?php } ?>
										<a href="<?= base_url('Purchase/order_detail/'.$item->purchase_id); ?>" class="button"><span
												class="icon is-small has-text-info"><i class="fa fa-eye"></i></span></a>
									</td>
								</tr>
								<?php } else{ ?>
								<tr
									class="<?php if(min($lowest_price) == $item->price){ echo 'table-success text-dark'; } ?>">
									
									<td><?= 'CTC-0'.$item->purchase_id; ?></td>
									<td><?= ucfirst($item->sup_name); ?></td>
									<td><?= $item->name;?></td>
									<td><?= ucfirst($item->product); ?></span></td>
									<td><?= ucfirst($item->quantity); ?></td>
									<td> <?= date('M d, Y', strtotime($item->created_at)); ?> </td>
									<td> <?= $item->price; ?> </td>
									<td> <?= $item->description; ?> </td>
									<?php if($item->qut_status == 1) { ?>
									<td><span class="badge badge-success">Approved</span></td>
									<?php } elseif($item->qut_status == null ){ ?>
									<td><span class="tag is-loading">Pending <span></td>
									<?php } elseif($item->qut_status == 'rejected'){ ?>
									<td><span class="tag is-danger"><?=$item->qut_status; ?> <span></td>
									<?php } elseif($item->qut_status == 0){ ?>
									<td><span class="tag is-warning">process <span></td>
									<?php } ?>
									<td>
										<?php "<span id='qutation'>".$quotations = $this->admin_model->count_qutation($item->purchase_id)."</span>"; ?>
										<?php if($quotations < 3) { ?>
										<a data-id="<?= $item->purchase_id.'/'.$item->sup_id; ?>"
											class="add_qutations button is-small"><span class="icon is-small has-text-primary"><i
													class="fas fa-check"></i></span></a>
										<?php } else { ?>
										<?php   $quotations; ?>
										<a data-id="<?= $item->purchase_id.'/'.$item->sup_id; ?>"
											class="add_qutations disabled button is-small"><span class="icon is-small has-text-danger"><i
													class="fas fa-check"></i></span></a>
										<!-- echo "qutation is completed"; -->
										<?php } ?>
										<a href="<?= base_url('Purchase/order_detail/'.$item->purchase_id); ?>" class="button is-small"><span
												class="icon is-small has-text-primary"><i class="fa fa-eye"></i></span></a>
									</td>
								</tr>
								<?php } ?>
								<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
							</tbody>
							<!-- code to show alert -->
							<!-- <?php $quotations = $this->admin_model->count_qutation($item->purchase_id); 
   if($quotations == 3) { ?>
   <h3 style="color: red;">
     Qutation range is completed
     <?php } ?> -->
							</h3>
							<?php endif; ?>
						</table>
					</div>

					<!-- code to select supplier and send order start -->
					<div class="modal" id="modal-po-supplier">
						<div class="modal-background"></div>
						<form action="<?=base_url('Purchase/po_supplier_order');?>" method="post" class="md-form">
							<div class="modal-card">
								<header class="modal-card-head">
									<p class="modal-card-title">Po Order Forward</p>
									<button class="delete" aria-label="close" id="exit-supplier-modal"
										type="button"></button>
								</header>
								<input type="hidden" name="purchaseid" id="purchaseid" value="">
								<section class="modal-card-body">
									<div class="columns">
										<div class="column">
											<div class="control">
												<div class="select select is-small is-fullwidth">
													<select name="location" id="supplier_location"
														class="browser-default custom-select ">
														<?php if(!empty($locations)): foreach($locations as $loc): ?>
														<option value="<?= $loc->id ?>"><?= ucfirst($loc->name); ?>
														</option>
														<?php endforeach; endif; ?>
													</select>
												</div>
											</div>
										</div>
										<div class="column ">
											<div class="select select is-small is-fullwidth">
												<select name="supplier" id="supplier"
													class="browser-default custom-select">
													<option value="" disabled selected>--Select Supplier--</option>
												</select>
											</div>
										</div>
									</div>
								</section>
								<footer class="modal-card-foot">
									<button class="button is-success" type="submit">Apply</button>
									<button class="button" aria-label="close" id="close-supplier-modal"
										type="button">Cancel</button>

								</footer>
							</div>
						</form>
					</div>
					<!-- code select supplier to send order end -->


					<!-- filter report model -->
					<div class="modal" id="modal-ter">
						<div class="modal-background"></div>
						<form action="<?= base_url('purchase/po_report'); ?>" method="get">
							<div class="modal-card">
								<header class="modal-card-head">
									<p class="modal-card-title">Filter Report</p>
									<button class="delete" aria-label="close" id="exit-report-modal"
										type="button"></button>
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
									<button class="button" aria-label="close" id="close-report-modal"
										type="button">Cancel</button>
								</footer>
							</div>
						</form>
					</div>
					<!-- filter report model end -->
				</div>

				<!-- code to add qutation start -->
				<div class="modal" id="modal-qutation">
					<div class="modal-background"></div>
					<form action="<?= base_url('Purchase/add_qutation'); ?>" method="post">
						<input type="hidden" name="purchase_id" id="purchase_id" value="">
						<div class="modal-card">
							<header class="modal-card-head">
								<p class="modal-card-title">Add Qutation</p>
								<button class="delete" aria-label="close" id="exit-qut-modal" type="button"></button>
							</header>
							<input type="hidden" name="purchaseid" id="purchaseid" value="">
							<section class="modal-card-body">
								<div class="columns">
									<div class="column">
										<div class="field">
											<div class="control">
												<label data-error="wrong" data-success="right"
													for="orangeForm-name">price</label>
												<input name="price" class="input is-small" type="text"
													placeholder="price ..." required="">
											</div>
										</div>
									</div>
								</div>
								<div class="columns">
									<div class="column ">
										<div class="field">
											<div class="control">
												<textarea class="textarea is-small" name="description" id="description"
													placeholder="Small textarea"></textarea>
											</div>
										</div>
									</div>
								</div>

							</section>
							<footer class="modal-card-foot">
								<button class="button is-success" type="submit">Submit</button>
								<button class="button" aria-label="close" id="close-qut-modal"
									type="button">Cancel</button>

							</footer>
						</div>
					</form>
				</div>
				<!-- code add qutation end -->

</section>

<script>
	// code to add qutations
	var qut1 = $("#exit-qut-modal")
	var qut2 = $("#close-qut-modal")
	var qutmdl = new BulmaModal("#modal-qutation")
	qut1.click(function (ev) {
		qutmdl.close();
		ev.stopPropagation();
	});
	qut2.click(function (ev) {
		qutmdl.close();
		ev.stopPropagation();
	});

	$(document).ready(function () {
		$('.add_qutations').click(function () {
			var po_id = $(this).data('id'); 
			$('#purchase_id').val(po_id);
			qutmdl.show();
			// $('#modal-add_qutations').modal('show');
		});
	});

	$(document).ready(function () {
		$("#myInput").on("keyup", function () {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function () {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
	// code to show range completion message
	$(document).ready(function () {
		var a = $('#qutation').val();
		// alert(a);
	});

</script>
