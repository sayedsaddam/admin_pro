<section class="columns is-gapless mb-0 pb-0 ">
	<div class="column is-narrow is-fullheight is-hidden-print" id="custom-sidebar">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>

	<div class="column">
		<div class="columns">
			<div class="column section">

			<div class="columns is-hidden-touch">
					<div class="column is-hidden-print">
						<form action="<?= base_url('admin/search_project'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" id="myInput" type="search"
										placeholder="Search Project"
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
									<a href="<?= base_url('report/invoice_report') ?>" class="button is-small">
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
								<button onclick="location.href='<?= base_url('admin/invoices'); ?>'"
									class="button is-small <?= isset($invoices) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Invoice List</span>
								</button>
							</p>
							<?php if($AssetsAccess->write == 1) : ?>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/add_invoice'); ?>'"
									data-target="#add_supplier"
									class="button is-small <?= (isset($add_invoice)) ? 'has-background-primary-light' : '' ?>">
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

				<div class='container'>
					<div class='columns is-mobile'>
						<div class='column is-12'>
							<div class="card py-5 px-5"> 
								<p class="subtitle has-text-centered"><strong>AH Group of Companies (Pvt.) Ltd.
									Islamabad, 44000</strong></p>
								<p class="subtitle has-text-centered"><strong>Invoice</strong>
									 </p>
								<div class="card-content">
									<div class="columns is-12">
										<div class="column">
											<div class="columns">
												<table class="table table-striped table-sm is-fullwidth">
													<tbody>
														<tr>
															<th>Invoice #</th>
															 <td><?=$invoice->inv_no;?></td> 
                                                             <th>Project</th>
															 <td><?=$invoice->project_name;?></td> 
														</tr>
														<tr>
															<th>Supplier</th>
															<td><?=$invoice->sup_name;?></td>
                                                            <th>Location</th>
															 <td><?=ucfirst($invoice->name);?></td> 
															 
														</tr>
														<tr>
															<th>Item Name</th>
															<td><?=$invoice->item;?></td>
                                                            <th>Amount</th>
															 <td><?=number_format($invoice->amount);?></td> 
															 
														</tr>
														<tr>
															 
															<th>Invoice Date</th>
															 <td><?php if($invoice->inv_date){echo date('F d, Y', strtotime($invoice->inv_date)); }else{ echo '--/--/--'; } ?></td> 
                                                            <th>Entry Date</th>
															 <td><?=date('F d, Y', strtotime($invoice->created_at));?></td> 
															 
														</tr>
                                                        <tr>
                                                            <th>Status</th>
															<td><?php if($invoice->status == 0){echo "<span class='tag is-warning'>pending</span>"; }else{ echo "<span class='tag is-success'>cleared</span>"; } ?></td>
															
														</tr>
                                                        <tr>
                                                            <th>Description</th>
															<td colspan="3"><?=$invoice->inv_desc;?></td>
                                                        </tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>  
									 
									<div class="card-content">
										

										<div class="buttons is-pulled-right">
											<button onclick="window.print();" type="button"
												class="button is-normal is-hidden-print">
												<span class="icon is-small">
													<i class="fas fa-print"></i>
												</span>
												<span>Print</span>
											</button>
										</div>
										<br>

									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
</section>

 
