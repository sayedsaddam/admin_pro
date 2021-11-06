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
									<span>Project List</span>
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
				<div class="columns" style="display: grid">
					<div class="column table-container ">
          <table class="table table-sm is-fullwidth"> 
             <thead>
            <tr>
              <th class="has-text-weight-semibold">ID</th>
              <th class="has-text-weight-semibold">Inv No.</th>
              <th class="has-text-weight-semibold">Vendor</th>
              <th class="has-text-weight-semibold">Region</th>
              <th class="has-text-weight-semibold">Item</th>
              <th class="has-text-weight-semibold">Amount</th>
              <th class="has-text-weight-semibold">Date</th>
              <th class="has-text-weight-semibold">Status</th>
              <th class="has-text-weight-semibold">Action</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody>
              <?php if(!empty($invoices)): foreach($invoices as $inv): ?>
                <tr>
                  <td><?= 'Inv-0'.$inv->id; ?></td>
                  <td><?= $inv->inv_no; ?></td>
                  <td><?= $inv->vendor; ?></td>
                  <td><?= ucfirst($inv->region); ?></td>
                  <td><?= $inv->item; ?></td>
                  <td><?= number_format($inv->amount); ?></td>
                  <td><?php if($inv->inv_date){ echo date('M d, Y', strtotime($inv->inv_date)); }else{ echo '--/--/--'; } ?></td>
                  <td><?php if($inv->status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }else{ echo "<span class='badge badge-success'>cleared</span>"; } ?></td>
                 
                  <td class="">
										<div class="field has-addons">
                      <a href="<?=base_url('admin/print_invoice/'.$inv->id);?>"><span class="icon is-small has-text-primary"><i class="fa fa-print"></i></span></a>
                      <a href="<?=base_url('admin/delete_invoice/'.$inv->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');" ><span class='icon is-small has-text-danger'><i class="fa fa-trash"></i></span></a>
                      <a href="<?= base_url('admin/invoice_status/'.$inv->id); ?>"><span class="icon is-small has-text-success"><i class="fa fa-check"></i></span></a>
										</div>
									</td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='9'>No record found.</td></tr>"; endif; ?>
            </tbody>
          <?php else: ?>
            <tbody>
              <?php if(!empty($results)): $expenses = 0; foreach($results as $res): $expenses += $res->amount; ?>
                <tr>
                  <td><?= 'Inv-0'.$res->id; ?></td>
                  <td><?= $res->inv_no; ?></td>
                  <td><?= $res->vendor; ?></td>
                  <td><?= ucfirst($res->region); ?></td>
                  <td><?= $res->item; ?></td>
                  <td><?= number_format($res->amount); ?></td>
                  <td><?php if($res->inv_date){ echo date('M d, Y', strtotime($res->inv_date)); }else{ echo '--/--/--'; } ?></td>
                  <td><?php if($res->status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }else{ echo "<span class='badge badge-success'>cleared</span>"; } ?></td>
                  <td>
                      <a href="<?=base_url('admin/print_invoice/'.$res->id);?>"><span class="badge badge-primary"><i class="fa fa-print"></i></span></a>
                      <a href="<?=base_url('admin/delete_invoice/'.$res->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                      <a href="<?= base_url('admin/invoice_status/'.$res->id); ?>"><span class="badge badge-success"><i class="fa fa-check"></i></span></a>
                  </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='9'>No record found.</td></tr>"; endif; ?>
              <tr class="bg-success">
                <td colspan="5" class="text-white font-weight-bold">Total</td>
                <td class="text-white font-weight-bold"><?= number_format($expenses); ?></td>
                <td colspan="3"></td>
              </tr>
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