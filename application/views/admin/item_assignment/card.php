<section class="columns is-gapless mb-0 pb-0 ">
	<div class="column is-narrow is-fullheight is-hidden-print" id="custom-sidebar">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>

	<div class="column">
		<div class="columns">
			<div class="column section">

				<div class="columns is-hidden-touch">
					<div class="column is-hidden-print">
						<form action="<?= base_url('admin/search_item') ?>" method="GET">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Items" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" required>
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
					<div class="column is-hidden-print">
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
							<p class="control">
								<button
									class="button is-small <?= (isset($product_report)) ? 'has-background-primary-light' : '' ?>"
									id="report-btn">
									<span class="icon is-small">
										<i class="fas fa-paperclip"></i>
									</span>
									<span>Report</span>
								</button>
							</p>
						</div>
					</div>
				</div>

				<div class='container has-text-centered'>
					<div class='columns is-mobile is-centered'>
						<div class='column is-12'>
							<div class="card">


							<?php if(!empty($items)): ?>


								<p class="subtitle has-text-centered"><strong>Category</strong> &raquo; <?= $items[0]->cat_name ?>
									<strong>Subcategory</strong> &raquo; <?= ucfirst($items[0]->names); ?> <strong>Product</strong> <?=$items[0]->type_name."(".$items[0]->quantity.")";?></p>
								<p class="card-title is-size-4">

								<div class="card-content">


<div class="columns">

	<div class="column has-text-left ml-6">
		<p><strong>Product</strong></p>
		<p><strong>Serial No</strong> &raquo; <?=ucfirst($items[0]->serial_number);?></p>
		<p><strong>Purchase Date</strong> &raquo; <?= date('M d, Y', strtotime($items[0]->purchasedate)); ?></p>
		<p><strong>Price</strong> &raquo; <<?php echo "<p id='price'>". $items[0]->price.'</p>';?> </p>
		<p><strong>Depreciation</strong> &raquo; <?php echo "<span id='dep'>".$items[0]->depreciation .'</span>'. "(%)"; ?> </p>
		<p><strong>Current Value</strong> &raquo; <p id="current"> </p> </p>
	</div>

	<div class="column has-text-left">
		<p><strong>Employee</strong></p>
		<p> <strong> Employee </strong> &raquo; <?= ucfirst($items[0]->names); ?></p>
		<p> <strong> Designation</strong> &raquo; <?= ucfirst($items[0]->names); ?></p>
		<p> <strong> Department</strong> &raquo; <?= ucfirst($items[0]->names); ?></p>
		<p> <strong> Date Of Joining </strong>&raquo; oct-1st-2021</p>
		<p> <strong> Contact </strong>&raquo; <?= ucfirst($items[0]->names); ?> 0345-587684969</p>
	</div>
</div>

<?php else : ?>
	<p class="subtitle has-text-centered"><strong>Category</strong> &raquo; Electronic
									<strong>Subcategory</strong> &raquo; Laptop <strong>Product</strong> Dell</p>
								<p class="card-title is-size-4">

								</p>

								<div class="card-content">


									<div class="columns">

										<div class="column has-text-left ml-6">
											<p><strong>Product</strong></p>
											<p><strong>Serial No</strong> &raquo; <?= $item->cat_name; ?></p>
											<p><strong>Purchase Date</strong> &raquo; <?= date('M d, Y', strtotime($item->purchasedate)); ?></p>
											<p><strong>Price</strong> &raquo; <?= $item->price;?> </p>
											<p><strong>Depreciation</strong> &raquo; <?php echo $item->depreciation . " (%)"; ?> </p>
											<p><strong>Current Value</strong> &raquo; 	<?php  
											error_reporting(0);
											if($item->depreciation > 0){ 
											$depreciation = ($item->price*$item->depreciation / 100) ;  
											echo $item->price - $depreciation;
											
											}
											?> </p>
										</div>

										<div class="column has-text-left">
											<p><strong>Employee</strong></p>
											<p> <strong> Employee </strong> &raquo;  <?= $item->fullname;?></p>
											<p> <strong> Designation</strong> &raquo; Developer</p>
											<p> <strong> Department</strong> &raquo;  <?= $item->department;?></p>
											<p> <strong> Date Of Joining </strong>&raquo;  <?= $item->doj;?></p>
											<p> <strong> Contact </strong>&raquo;  <?= $item->phone;?></p>
										</div>
									</div>

	<?php endif; ?> 


									<div class="columns">
										<div class="column">
											
											<table class="table is-fullwidth">
												<thead>
													
													<tr>
														<th>NO</th>
														<th>Name</th>
														<th>assign to</th>
														<th>date</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>samad</td>
														<td>aug-12-2021</td>
														<td>aug-12-2021</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div> 

                                    <div class="buttons is-pulled-right">
							<button onclick="window.print();" type="button" class="button is-normal is-hidden-print">
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
