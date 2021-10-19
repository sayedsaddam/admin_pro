<?php $session = $this->session->userdata('user_role'); ?>
<section class="columns is-gapless mb-0 pb-0">
 	<div class="column is-narrow is-fullheight is-hidden-print" style="background-color:#fafafa;">
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
 										placeholder="Search Query">
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
 								<button
 									class="add_employ button is-small <?= (isset($add_page)) ? 'has-background-primary-light' : '' ?>">
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
                <th class="font-weight-bold">Email</th>
                <th class="font-weight-bold">Phone</th>
                <th class="font-weight-bold">Location</th>  
                <th class="font-weight-bold">Department</th>  
                <th class="font-weight-bold">DOJ</th>  
                <th class="font-weight-bold">Status</th>
                <th class="font-weight-bold">Date</th>
                <th class="font-weight-bold">Action</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody id="myTable">
              <?php if(!empty($employ)): foreach($employ as $sup): ?>
                <tr>
                  <td><?= 'S2S-0'.$sup->emp_id; ?></td>
                  <td><?= $sup->emp_name; ?></td>
                  <td><?= ucfirst($sup->email); ?></td>
                  <td><?= ucfirst($sup->phone); ?></td>
                  <td><?= ucfirst($sup->name); ?></td>  
                  
                  <td><?= ucfirst($sup->department); ?></td>  
                  <td><?= ucfirst($sup->doj); ?></td>  
                  
                  <td>
                      <?php if($sup->status == 1): ?>
                          <span class="badge badge-success">Active</span>
                      <?php else: ?>
                          <span class="badge badge-danger">Inactive</span>
                      <?php endif; ?>
                  </td>
                  <td><?= date('M d, Y', strtotime($sup->created_at)); ?></td> 
                  <td class="is-narrow"> 
                      <a data-id="<?= $sup->emp_id; ?>" class="supplier_info button is-small"><span class="icon is-small"><i class="fa fa-edit"></i></span></a>
                     <?php if($session == 'admin'){ ?>
                      <a href="<?=base_url('admin/delete_employ/'.$sup->emp_id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');" class="button is-small"><span class="icon is-small has-text-danger"><i class="fa fa-times"></i></span></a>
                     <?php } ?>
                    </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='10'>No record found.</td></tr>"; endif; ?>
            </tbody>
          <?php else: ?>
            <tbody id="myTable">
              <?php if(!empty($results)): foreach($results as $res): ?>
                <tr>
                  <td><?= 'S2S-0'.$res->id; ?></td>
                  <td><?= $res->fullname; ?></td>
                  <td><?= ucfirst($res->email); ?></td>
                  <td><?= ucfirst($res->phone); ?></td>
                  <td><?= ucfirst($res->location); ?></td>   
                  <td><?= ucfirst($res->department); ?></td>  
                  <td><?= ucfirst($res->doj); ?></td>  
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
 					</div>
 				</div>
 			</div>
 </section>

  <!-- add employ code start -->
  <div class="modal" id="add_employ">
    <div class="modal-background"></div>
    <form action="<?=base_url('admin/add_employ');?>" method="post" class="md-form">
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add Employee</p>
                <button class="delete" aria-label="close" id="exit-add-modal" type="button"></button>
            </header>
            <input type="hidden" name="purchaseid" id="purchaseid" value="">
            <section class="modal-card-body">
                <div class="columns">
                    <div class="column">
                        <div class="control">
                        <label class="label is-small">Location <span class="has-text-danger">*</span></label>
                            <div class="select select is-small is-fullwidth"> 
                                <select name="location" id="" class="browser-default custom-select ">
                                    <?php if(!empty($locations)): foreach($locations as $loc): ?>
                                    <option value="<?= $loc->id ?>"><?= ucfirst($loc->name); ?> </option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="column">
						<fieldset>
								<div class="field">
									<label class="label is-small">Name <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
									<input type="text" name="name" id="" class="input is-small" value="" type="text" placeholder="name ..." required="">
										<span class="icon is-small is-left">
											<i class="fas fa-user"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="control">

                        <fieldset>
								<div class="field">
									<label class="label is-small">Email <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
									<input type="email" name="email" id="" class="input is-small" value="" type="text" placeholder="example@yahoo.com ..." required="">
										<span class="icon is-small is-left">
											<i class="fas fa-envelope-square"></i>
										</span>
									</div>
								</div>
							</fieldset>
                        </div>
                    </div>
                    <div class="column"> 
                        <div class="control">
                        <label class="label is-small">Phone No <span class="has-text-danger">*</span></label>
                            <div class="is-small is-fullwidth"> 
                            <input type="number" name="phone" id="" class="input is-small" value="" type="text" placeholder="034354556554 ..." required="">
                            </div>
                        </div> 
						</div>
                </div>  
                <div class="columns"> 
                  <div class="column">                
                    <label class="label is-small">Dapartment <span class="has-text-danger">*</span></label>
                            <div class="select select is-small is-fullwidth"> 
                                <select name="department" id="">
                                <option value="" disabled selected>--Select Department--</option>
                                  <option value="IT">IT</option>
                                  <option value="sale">Sale</option>
                                  <option value="marketing">marketing</option>
                                  <option value="media">media</option>
                                  <option value="finance">Finance</option> 
                                  <option value="others">Others</option>
                                </select>
                            </div>
                            </div>

                    <div class="column">
						<fieldset>
								<div class="field">
									<label class="label is-small">Region </label>
									<div class="control has-icons-left">
                  <input type="text" name="region" id="" class="input is-small" value="" placeholder="region ..." >
                  <span class="icon is-small is-left">
											<i class="fas fa fa-globe"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
                </div>  
                 
                <div class="columns"> 
                  <div class="column">                
                    <label class="label is-small"> DOB <span class="has-text-danger">*</span></label>
                            <div class="is-small is-fullwidth"> 
                            <input type="date" name="dob" id="" class="input is-small" value="" placeholder="region ..." >
                            </div>
                            </div>

                    <div class="column">
						<fieldset>
								<div class="field">
									<label class="label is-small">Joining Date</label>
									<div class="control">
                  <input type="date" name="doj" id="" class="input is-small" value="" placeholder="joining ..." >
									</div>
								</div>
							</fieldset>
						</div>
                </div>    
<div class="columns">
<div class="column">
<fieldset>
								<div class="field">
									<label class="label is-small">Address</label>
									<div class="control has-icons-left">
									<textarea class="textarea is-small" name="address" rows="2" id=""
													placeholder="some detail"></textarea>
									</div>
								</div>
							</fieldset>
</div>
</div>

            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" type="submit">Apply</button>
                <button class="button" aria-label="close" id="close-add-modal" type="button">Cancel</button>

            </footer>
        </div>
    </form>
</div>
    <!-- code add empoloy end -->

 <!-- Update employ code start -->
 <div class="modal" id="edit_employ">
    <div class="modal-background"></div>
    <form action="<?=base_url('admin/update_employ');?>" method="post" class="md-form">
    <input type="hidden" name="sup_id" id="employId" value="">
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Update Employee</p>
                <button class="delete" aria-label="close" id="exit-edit-modal" type="button"></button>
            </header> 
            <section class="modal-card-body">
                <div class="columns">
                    <div class="column">
                        <div class="control">
                        <label class="label is-small">Location <span class="has-text-danger">*</span></label>
                            <div class="select select is-small is-fullwidth"> 
                                <select name="location" id="employ_location" class="browser-default custom-select ">
                                    <?php if(!empty($locations)): foreach($locations as $loc): ?>
                                    <option value="<?= $loc->id ?>"><?= ucfirst($loc->name); ?> </option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="column">
						<fieldset>
								<div class="field">
									<label class="label is-small">Name <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
									<input type="text" name="name" id="employ_name" class="input is-small" value="" type="text" placeholder="name ..." required="">
										<span class="icon is-small is-left">
											<i class="fas fa-user"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="control">

                        <fieldset>
								<div class="field">
									<label class="label is-small">Email <span class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
									<input type="email" name="email" id="employ_email" class="input is-small" value="" type="text" placeholder="example@yahoo.com ..." required="">
										<span class="icon is-small is-left">
											<i class="fas fa-envelope-square"></i>
										</span>
									</div>
								</div>
							</fieldset>
                        </div>
                    </div>
                    <div class="column"> 
                        <div class="control">
                        <label class="label is-small">Phone No <span class="has-text-danger">*</span></label>
                            <div class="select select is-small is-fullwidth select is-multiple"> 
                            <input type="number" name="phone" id="employ_phone" class="input is-small" value="" type="text" placeholder="example@yahoo.com ..." required="">
                            </div>
                        </div> 
						</div>
                </div>  

                  
                <div class="columns"> 
                  <div class="column">                
                    <label class="label is-small">Dapartment <span class="has-text-danger">*</span></label>
                            <div class="select select is-small is-fullwidth"> 
                                <select name="department" id="department">
                                <option value="" disabled selected>--Select Department--</option>
                                  <option value="IT">IT</option>
                                  <option value="sale">Sale</option>
                                  <option value="marketing">marketing</option>
                                  <option value="media">media</option>
                                  <option value="finance">Finance</option> 
                                  <option value="others">Others</option>
                                </select> 

                            </div>
                            </div>

                    <div class="column">
						<fieldset>
								<div class="field">
									<label class="label is-small">Region </label>
									<div class="control has-icons-left">
                  <input type="text" name="region" id="region" class="input is-small" value="" placeholder="region ..." >
                  <span class="icon is-small is-left">
											<i class="fas fa fa-globe"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
                </div>  

                <div class="columns"> 
                  <div class="column">             
                       <label class="label is-small">DOB <span class="has-text-danger">*</span></label>
                            <div class="select select is-small is-fullwidth select is-multiple"> 
                            <input type="date" name="dob" id="dob" class="input is-small" value="" placeholder="region ..." >
                            </div>
                            </div>

                    <div class="column">
						<fieldset>
								<div class="field">
									<label class="label is-small">Joining Date</label>
									<div class="control">
                  <input type="date" name="doj" id="doj" class="input is-small" value="" placeholder="joining ..." >
									</div>
								</div>
							</fieldset>
						</div>
                </div>  
                
                <div class="columns">
<div class="column">
<fieldset>
								<div class="field">
									<label class="label is-small">Address</label>
									<div class="control has-icons-left">
									<textarea class="textarea is-small" name="address" rows="2" id=""
													placeholder="some detail"></textarea>
									</div>
								</div>
							</fieldset>
</div>
</div>

            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" type="submit">Apply</button>
                <button class="button" aria-label="close" id="close-edit-modal" type="button">Cancel</button>

            </footer>
        </div>
    </form>
</div>
<!-- update eploy code end -->

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

$(document).ready(function(){
  $('.supplier_info').click(function(){  
    var supplier_id = $(this).data('id');
    // alert(supplier_id)
    // AJAX request
    $.ajax({
    url: '<?= base_url('admin/edit_employ/'); ?>' + supplier_id,
    method: 'POST',
    dataType: 'JSON',
    data: {supplier_id: supplier_id},
      success: function(response){ 
        console.log(response);
        $('#employId').val(response.id);
        $('#employ_location').val(response.location);
        $('#employ_name').val(response.username);
        $('#department').val(response.department);
        $('#employ_email').val(response.email);
        $('#employ_phone').val(response.phone); 
        $('#address').val(response.address); 
        $('#region').val(response.region);
        $('#dob').val(response.dob); 
        $('#doj').val(response.doj); 
        
        // $('.edit-modal-body').html(response);
        // Display Modal
        // $('#edit_employ').modal('show'); 
        empedtmdl.show();
      }
    });
    event.stopPropagation();
  });
});
 
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>