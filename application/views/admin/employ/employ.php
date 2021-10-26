<?php $session = $this->session->userdata('user_role'); ?>
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
 						<form action="<?= base_url('admin/search_employ') ?>" method="get">
 							<div class="field has-addons">
 								<div class="control has-icons-left is-expanded">
 									<input class="input is-small is-fullwidth" name="search" id="myInput" type="search"
 										placeholder="Search Employees" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" required>
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
 								<a href="<?= base_url("admin/employee") ?>"
 									class="button is-small <?= (isset($employees_page)) ? 'has-background-primary-light' : '' ?>">
 									<span class="icon is-small">
 										<i class="fas fa-list"></i>
 									</span>
 									<span>Employees List</span>
 								</a>
 							</p>
 							<p class="control">
 								<button onclick="location.href='<?= base_url('admin/add_employee'); ?>'"
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
 					<div class="column table-container ">
           <table class="table table-sm is-fullwidth">
          <caption><?php if(empty($results)){ echo ''; }else{ echo ''; } ?></caption>
          <thead>
            <tr>
                <th class="font-weight-bold">ID</th>
                <th class="font-weight-bold">Name</th>
                <th class="font-weight-bold">Phone</th>
                <th class="font-weight-bold">Location</th>  
                <th class="font-weight-bold">Department</th>  
                <th class="font-weight-bold">DOJ</th>  
                <th class="font-weight-bold">Status</th>
                <th class="font-weight-bold">Date</th>
                <th class="font-weight-bold">Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th class="font-weight-bold">ID</th>
                <th class="font-weight-bold">Name</th>
                <th class="font-weight-bold">Phone</th>
                <th class="font-weight-bold">Location</th>  
                <th class="font-weight-bold">Department</th>  
                <th class="font-weight-bold">DOJ</th>  
                <th class="font-weight-bold">Status</th>
                <th class="font-weight-bold">Date</th>
                <th class="font-weight-bold">Action</th>
            </tr>
          </tfoot>
          <?php if(empty($results)): ?>
            <tbody id="myTable">
              <?php if(!empty($employ)): foreach($employ as $sup): ?>
                <tr>
                  <td><?= 'S2S-'.$sup->emp_id; ?></td>
                  <td><abbr title="<?= $sup->email; ?>"><?= ucwords($sup->emp_name); ?></abbr></td>
                  <td><?= $sup->phone; ?></td>
                  <td><?= ucwords($sup->name); ?></td>  
                  <td><?= ucwords($sup->department); ?></td>  
                  <td><?= date('M d, Y', strtotime($sup->doj)); ?></td>  
                  <td>
                      <?php if($sup->status == 1): ?>
                          <span class="tag is-success is-light">Active</span>
                      <?php else: ?>
                          <span class="tag is-warning is-light">Inactive</span>
                      <?php endif; ?>
                  </td>
                  <td><?= date('M d, Y', strtotime($sup->created_at)); ?></td> 
                  <td class="is-narrow"> 
                    <div class="field has-addons">
						<p class="control">
							<a href="<?= base_url('admin/edit_employ/'.$sup->emp_id); ?>"
								class="button is-small">
								<span class="icon is-small">
									<i class="fas fa-edit"></i>
								</span>
							</a>
						</p> 
                      <?php if($session == 'admin'){ ?>
                      <a href="<?=base_url('admin/delete_employ/'.$sup->emp_id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');" class="button is-small"><span class="icon is-small has-text-danger"><i class="fa fa-times"></i></span></a>
                     <?php } ?>
                    </div>
                    </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='10'>No record found.</td></tr>"; endif; ?>
            </tbody>
          <?php else: ?>
            <tbody id="myTable">
              <?php if(!empty($results)): foreach($results as $res): ?>
                <tr>
                <td><?= 'S2S-'.$res->id; ?></td>
                  <td><abbr title="<?= $res->email; ?>"><?= ucwords($res->fullname); ?></abbr></td>
                  <td><?= $res->phone; ?></td>
                  <td><?= ucwords($res->name); ?></td>  
                  <td><?= ucwords($res->department); ?></td>  
                  <td><?= date('M d, Y', strtotime($res->doj)); ?></td>  
                  <td>
                      <?php if($res->status == 1): ?>
                          <span class="badge badge-success">Active</span>
                      <?php else: ?>
                          <span class="badge badge-danger">Inactive</span>
                      <?php endif; ?>
                  </td>
                  <td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
                  <td class="is-narrow">
                      <a data-id="<?= $res->id; ?>" class="supplier_info button is-small"><span class="icon is-small"><i class="fa fa-edit"></i></span></a>
                      <?php if($session == 'admin'){ ?>
                      <a href="<?=base_url('admin/delete_employ/'.$res->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');" class="button is-small"><span class="icon is-small has-text-danger"><i class="fa fa-times"></i></span></a>
                      <?php } ?>
                    </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='7'>No record found.</td></tr>"; endif; ?>
            </tbody>
            <?php endif; ?>
        </table>
		<div class="column is-hidden-print">
						<nav class="pagination is-small" role="navigation" aria-label="pagination"
							style="justify-content: center;">
							<?php if(empty($results) AND !empty($employ)){ echo $this->pagination->create_links(); } ?>
						</nav>
					</div>
					<div class="column is-hidden-print is-narrow">
						<div class="field has-addons">
							<p class="control">
								<a href="<?= base_url("admin/employee") ?>"
									class="button is-small <?= (isset($employees_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Employees List</span>
								</a>
							</p>
							<p class="control">
								<button onclick="location.href='<?= base_url('admin/add_employee'); ?>'"
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
						<table class="table is-hoverable is-fullwidth">
							<caption><?php if(empty($results)){ echo ''; }else{ echo ''; } ?></caption>
							<thead>
								<tr>
									<th class="font-weight-bold">ID</th>
									<th class="font-weight-bold">Name</th>
									<th class="font-weight-bold">Phone</th>
									<th class="font-weight-bold">Location</th>
									<th class="font-weight-bold">Department</th>
									<th class="font-weight-bold">DOJ</th>
									<th class="font-weight-bold">Status</th>
									<th class="font-weight-bold">Date</th>
									<th class="font-weight-bold">Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th class="font-weight-bold">ID</th>
									<th class="font-weight-bold">Name</th>
									<th class="font-weight-bold">Phone</th>
									<th class="font-weight-bold">Location</th>
									<th class="font-weight-bold">Department</th>
									<th class="font-weight-bold">DOJ</th>
									<th class="font-weight-bold">Status</th>
									<th class="font-weight-bold">Date</th>
									<th class="font-weight-bold">Action</th>
								</tr>
							</tfoot>
							<?php if(empty($results)): ?>
							<tbody id="myTable">
								<?php if(!empty($employ)): foreach($employ as $sup): ?>
								<tr onclick="window.location='<?= base_url('admin/edit_employ/'.$sup->emp_id); ?>';">
									<td><?= 'S2S-'.$sup->emp_id; ?></td>
									<td><abbr title="<?= $sup->email; ?>"><?= ucwords($sup->emp_name); ?></abbr></td>
									<td><?= $sup->phone; ?></td>
									<td><?= ucwords($sup->name); ?></td>
									<td><?= ucwords($sup->department); ?></td>
									<td><?= date('M d, Y', strtotime($sup->doj)); ?></td>
									<td>
										<?php if($sup->status == 1): ?>
										<span class="tag is-success is-light">Active</span>
										<?php else: ?>
										<span class="tag is-warning is-light">Inactive</span>
										<?php endif; ?>
									</td>
									<td><?= date('M d, Y', strtotime($sup->created_at)); ?></td>
									<td class="is-narrow">
										<div class="field has-addons">
											<p class="control">
												<a href="<?= base_url('admin/edit_employ/'.$sup->emp_id); ?>"
													class="button is-small">
													<span class="icon is-small">
														<i class="fas fa-edit"></i>
													</span>
												</a>
											</p>
											<?php if($session == 'admin'){ ?>
											<a href="<?=base_url('admin/delete_employ/'.$sup->emp_id);?>"
												onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"
												class="button is-small"><span class="icon is-small has-text-danger"><i
														class="fa fa-times"></i></span></a>
											<?php } ?>
										</div>
									</td>
								</tr>
								<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='10'>No record found.</td></tr>"; endif; ?>
							</tbody>
							<?php else: ?>
							<tbody id="myTable">
								<?php if(!empty($results)): foreach($results as $res): ?>
								<tr>
									<td><?= 'S2S-'.$res->id; ?></td>
									<td><abbr title="<?= $res->email; ?>"><?= ucwords($res->fullname); ?></abbr></td>
									<td><?= $res->phone; ?></td>
									<td><?= ucwords($res->name); ?></td>
									<td><?= ucwords($res->department); ?></td>
									<td><?= date('M d, Y', strtotime($res->doj)); ?></td>
									<td>
										<?php if($res->status == 1): ?>
										<span class="badge badge-success">Active</span>
										<?php else: ?>
										<span class="badge badge-danger">Inactive</span>
										<?php endif; ?>
									</td>
									<td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
									<td class="is-narrow">
										<a data-id="<?= $res->id; ?>" class="supplier_info button is-small"><span
												class="icon is-small"><i class="fa fa-edit"></i></span></a>
										<?php if($session == 'admin'){ ?>
										<a href="<?=base_url('admin/delete_employ/'.$res->id);?>"
											onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"
											class="button is-small"><span class="icon is-small has-text-danger"><i
													class="fa fa-times"></i></span></a>
										<?php } ?>
									</td>
								</tr>
								<?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='7'>No record found.</td></tr>"; endif; ?>
							</tbody>
							<?php endif; ?>
						</table>
						<div class="column is-hidden-print">
							<nav class="pagination is-small" role="navigation" aria-label="pagination"
								style="justify-content: center;">
								<?php if(empty($results) AND !empty($employ)){ echo $this->pagination->create_links(); } ?>
							</nav>
						</div>
					</div>
				</div>
			</div>
</section>

<script>
	// add employ code start 
	var cat1 = $("#exit-add-modal")
	var cat2 = $("#close-add-modal")
	var catmdl = new BulmaModal("#add_employ")

	cat1.click(function (ev) {
		catmdl.close();
		ev.stopPropagation();
	});
	cat2.click(function (ev) {
		catmdl.close();
		ev.stopPropagation();
	});

	$('.add_employ').click(function (ev) {
		catmdl.show();
		$(".modal-card-head").show();
		ev.stopPropagation();
	});

	// code for updat employ
	var empedt1 = $("#exit-edit-modal")
	var empedt2 = $("#close-edit-modal")
	var empedtmdl = new BulmaModal("#edit_employ")
	empedt1.click(function (ev) {
		empedtmdl.close();
		ev.stopPropagation();
	});
	empedt2.click(function (ev) {
		empedtmdl.close();
		ev.stopPropagation();
	});

	$(document).ready(function () {
		$('.supplier_info').click(function () {
			var supplier_id = $(this).data('id');
			// alert(supplier_id)
			// AJAX request
			$.ajax({
				url: '<?= base_url('
				admin / edit_employ / '); ?>' + supplier_id,
				method: 'POST',
				dataType: 'JSON',
				data: {
					supplier_id: supplier_id
				},
				success: function (response) {
					console.log(response);
					$('#employId').val(response.id);
					$('#employ_location').val(response.location);
					$('#f_name').val(response.fullname);
					$('#department').val(response.department);
					$('#employ_email').val(response.email);
					$('#phone').val(response.phone);
					$('#employ_address').val(response.address);
					$('#region').val(response.region);

					document.getElementById("dob").valueAsDate = new Date(response.dob)
					document.getElementById("doj").valueAsDate = new Date(response.doj)

					// $('.edit-modal-body').html(response);
					// Display Modal
					// $('#edit_employ').modal('show'); 
					empedtmdl.show();
				}
			});
			event.stopPropagation();
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

</script>
