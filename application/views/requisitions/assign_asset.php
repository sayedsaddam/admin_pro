<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" id="custom-sidebar">
		<?php $this->view('requisitions/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section py-5">
				<div class="columns is-hidden-print">
					<div class="column is-hidden-print">
						<?php $this->view('admin/commons/breadcrumb'); ?>
					</div>
				</div>
				<div class="columns is-hidden-touch">
					<div class="column is-hidden-print">
						<form action="<?= base_url('requisitions/search_user_asset') ?>" method="GET">
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
								<a  href='<?= base_url('requisitions/user_asset_list'); ?>'"
									class="button is-small <?= (isset($item_register)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Asset List</span>
								</a>
							</p> 
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

				<?php
$id = $this->uri->segment(3);

?>
<div class="tabs is-left is-hidden-print">
  <ul>
  <li class="<?php if($id == null){ echo "is-active";} ?>">
		<a href="<?= base_url('requisitions/user_asset_list') ?>">All</a>
	</li>  
    <li class="<?php if($id == 1){ echo "is-active";} ?>">
		<a href="<?= base_url('requisitions/user_asset_list/1') ?>">Assigned</a>
	</li>
    <li class="<?php if($id == '0'){ echo "is-active";} ?>"><a href="<?= base_url('requisitions/user_asset_list/0') ?>">Returned</a></li> 
  </ul>
</div>

				<div class="tile is-ancestor">
					<div class="tile is-parent">
						<div class="tile is-child box">
							<div class="columns" style="display: grid">
								<div class="column table-container">
									<table class="table is-hoverable is-fullwidth" id="myTable">
										<thead>
											<tr>
												<th class="has-text-weight-semibold"><abbr
														title="Item Identification Number">ID</abbr></th> 
												<th class="has-text-weight-semibold">Assigned To</th>
												<th class="has-text-weight-semibold">Category</th>
												<th class="has-text-weight-semibold">Company</th>
												<th class="has-text-weight-semibold">Model</th> 
											 
												<th class="has-text-weight-semibold"><abbr
														title="Depreciation Percentage">D%</abbr>
												</th>
												<th class="has-text-weight-semibold">Status</th>
												<th class="has-text-weight-semibold"> <abbr
														title="Purchase Date">PD</abbr></th>
 											</tr>
										</thead>
										<tfoot class="is-hidden-print">
											<tr>
												<th class="has-text-weight-semibold"><abbr
														title="Item Identification Number">ID</abbr></th>
												<th class="has-text-weight-semibold">Assigned To</th>
												<th class="has-text-weight-semibold">Category</th>
												<th class="has-text-weight-semibold">Company</th>
												<th class="has-text-weight-semibold">Model</th> 
											 
												<th class="has-text-weight-semibold"><abbr
														title="Depreciation Percentage">D%</abbr>
												</th>
												<th class="has-text-weight-semibold">Status</th>
												<th class="has-text-weight-semibold"> <abbr
														title="Purchase Date">PD</abbr></th>
											</tr>
										</tfoot>
										<tbody>
											<?php if(!empty($items)): foreach($items as $item): ?>
											<tr>
												<td><span><?= 'S2S-'.$item->id; ?></a></td> 
												<td><?= $item->employ_name; ?></td>
												<td>
													<div class="tags"><span
															class="tag"><?= ucwords($item->cat_name); ?></span><span
															class="tag is-info is-light"><?= ucwords($item->names); ?></span>
													</div>
												</td>
												<td><?= ucwords($item->type_name); ?></td>
												<td><?= ucwords($item->model); ?></td>  
												<td><?= $item->depreciation.' (%)'; ?></td>
												<td>
													<?php if($status = $item->quantity > 0 && $item->status != 1 && (!isset($damaged_item))){
											echo '<span class="tag is-success is-light">Available</span>';
										}elseif((isset($damaged_item)) && $item->status != 1){
											echo '<span class="tag is-danger is-light">'. ucwords($item->remarks);'</span>';
										}else{
											echo  '<span class="tag is-warning is-light">Assigned</span>';
										} ?>
												</td>
												<td><?= date('M d, Y', strtotime($item->purchasedate)); ?></td>		
											</tr>
											<?php endforeach; else: echo "<tr class='has-background-danger-light'><td colspan='17'>No records found.</td></tr>"; endif; ?>
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
								<a data-no-instant href="javascript:exportTableToExcel('myTable','User Asset Records');" type="button"
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
</section> 
<script>
	$(document).ready(function () {
		$(".result_limit").on('change', function () {
			var val = $(this).val();
			$(location).prop('href', '<?= current_url() ?>?<?= $this->uri->segment(2) == 'search_item' ? 'search=' . $this->input->get('search') . ' & ' : '' ?>limit=' + val)
		})
	})

</script>