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
 						<form action="<?= base_url('admin/search_asset_register'); ?>" method="get">
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
								<button onclick="location.href='<?= base_url('admin/asset_register'); ?>'"
									class="button is-small <?= isset($asset_register) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Asset List</span>
								</button>
							</p> 
 							<p class="control">
  								<button onclick="location.href='<?= base_url('admin/add_asset'); ?>'" data-target="#add_supplier"
 									class="button is-small <?= (isset($add_asset)) ? 'has-background-primary-light' : '' ?>">
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
          <caption><?php if(empty($results)){ echo ''; }else{ echo 'Search Results'; } ?></caption>
          <thead>
            <tr>
                <th class="has-text-weight-semibold">ID</th>
                <th class="has-text-weight-semibold">Category</th>
                <th class="has-text-weight-semibold">Description</th>
                <th class="has-text-weight-semibold"><abbr title="Quantity">Q</abbr></th> 
                <th class="has-text-weight-semibold"><abbr title="Purchase Date">PD</abbr></th>
                <th class="has-text-weight-semibold">Location</th> 
                <th class="has-text-weight-semibold">Designation</th>
                <th class="has-text-weight-semibold">User</th>
                <th class="has-text-weight-semibold">Remarks</th>
                <th class="has-text-weight-semibold"><abbr title="Give Away">GA</abbr></th>
                <th class="has-text-weight-semibold">Action</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody>
              <?php if(!empty($assets)): foreach($assets as $asset): ?>
                <tr>
                  <td><?= 'S2S-0'.$asset->id; ?></td>
                  <td><div class="tag"><?= $asset->category; ?></div></td>
                  <td><?= ucfirst($asset->description); ?></td>
                  <td><?= ucfirst($asset->quantity); ?></td>
                  <td><?= ucfirst($asset->purchase_date); ?></td>
                  <td><?= ucfirst($asset->location); ?></td>
                  <td><?= ucfirst($asset->designation); ?></td>
                  <td><?= ucfirst($asset->user); ?></td>
                  <td><?= ucfirst($asset->remarks); ?></td>
                  <td><?= ucfirst($asset->giveaway); ?></td> 
                  <!-- <td><?= date('M d, Y', strtotime($asset->purchase_date)); ?></td> -->
                  <!-- <td>
                    <?php $recDate = date('Y-m-d', strtotime($asset->purchase_date));
                          $today = date("Y-m-d"); // Today's date
                          $diff = date_diff(date_create($recDate), date_create($today));
                          echo $diff->format('%yyr %mm %dd'); ?> 
                  </td> --> 

                    <td class="is-narrow"> 
                    <div class="field has-addons">
						<p class="control">
							<a  href="<?= base_url('admin/asset_detail/'.$asset->id); ?>"
								class="button is-small">
								<span class="icon is-small">
									<i class="fas fa-edit"></i>
								</span>
							</a>
						</p> 
                      <?php if($session == 'admin'){ ?>
                      <a href="<?=base_url('admin/delete_asset/'.$asset->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');" class="button is-small"><span class="icon is-small has-text-danger"><i class="fa fa-times"></i></span></a>
                     <?php } ?>
                    </div>
                    </td> 
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
            </tbody> 
          <?php else: ?>
            <tbody>
              <?php if(!empty($results)): foreach($results as $res): ?>
                <tr>
                 
                <td><?= 'CTC-0'.$res->id; ?></td>
                  <td><?= $res->category; ?></td>
                  <td><?= ucfirst($res->description); ?></td>
                  <td><?= ucfirst($res->quantity); ?></td>
                   <td><?= ucfirst($res->purchase_date); ?></td>
                  <td><?= ucfirst($res->location); ?></td>
                  <td><?= ucfirst($res->designation); ?></td>
                  <td><?= ucfirst($res->user); ?></td>
                  <td><?= ucfirst($res->remarks); ?></td>
                  <td><?= ucfirst($res->giveaway); ?></td> 
                  <!-- <td><?= date('M d, Y', strtotime($res->purchase_date)); ?></td> -->
                  <!-- <td>
                    <?php $recDate = date('Y-m-d', strtotime($res->purchase_date));
                          $today = date("Y-m-d"); // Today's date
                          $diff = date_diff(date_create($recDate), date_create($today));
                          echo $diff->format('%yyr %mm %dd'); ?> 
                  </td> -->
                  <td class="is-narrow"> 
                    <div class="field has-addons">
						<p class="control">
							<a  href="<?= base_url('admin/asset_detail/'.$res->id); ?>"
								class="button is-small">
								<span class="icon is-small">
									<i class="fas fa-edit"></i>
								</span>
							</a>
						</p> 
                      <?php if($session == 'admin'){ ?>
                      <a href="<?=base_url('admin/delete_asset/'.$res->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');" class="button is-small"><span class="icon is-small has-text-danger"><i class="fa fa-times"></i></span></a>
                     <?php } ?>
                    </div>
                    </td> 
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
            </tbody>
        <?php endif; ?>
        </table>
		<div class="column is-hidden-print">
						<nav class="pagination is-small" role="navigation" aria-label="pagination"
							style="justify-content: center;">
							<?php if(empty($results) AND !empty($assets)){ echo $this->pagination->create_links(); } ?>
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
				url: '<?= base_url('admin/edit_employ/'); ?>' + supplier_id,
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