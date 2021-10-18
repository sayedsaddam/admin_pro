<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" style="background-color:#fafafa;">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column"> 
		<div class="columns">
			<div class="column section"> 

      <div class="columns is-hidden-touch">
					<div class="column is-hidden-print">
						<form action="<?= base_url('admin/search_sub_categories'); ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
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
 								<a href="<?= base_url("admin/categories") ?>"
 									class="button is-small <?= (isset($categories_page)) ? 'has-background-primary-light' : '' ?>">
 									<span class="icon is-small">
 										<i class="fas fa-plus"></i>
 									</span>
 									<span>Categories List</span>
 								</a>
 							</p>
							<p class="control"> 
                <button	class="add_inventory button is-small <?= (isset($add_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</button>
							</p>
						</div>
					</div>
				</div>

  <?php if($success = $this->session->flashdata('success')): ?>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="alert alert-success"><?=$success;?></div>
      </div>
    </div>
  <?php elseif($failed = $this->session->flashdata('failed')): ?>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="alert alert-danger"><?=$failed;?></div>
      </div>
    </div>
  <?php endif; ?>
 
  <div class="columns" style="display: grid">
					<div class="column table-container ">
        <?php if(!empty($sub_categories)){ echo '<h5>Sub categories for <span class="purple-text font-italic"> '.$sub_categories[0]->cat_name.'</span></h5>'; } ?>
        <table class="table table-sm is-fullwidth">
            <caption><?php if(empty($results)){ echo ''; }else{ echo 'Search Results'; } ?></caption>
            <thead>
            <tr>
                <th class="font-weight-bold">ID</th>
                <th class="font-weight-bold">Name</th>
                <th class="font-weight-bold">Added By</th>
                <th class="font-weight-bold">Date Added</th>
                <th class="font-weight-bold">Action</th>
            </tr>
            </thead>
            <?php if(empty($results)): ?>
            <tbody id="myTable">
                <?php if(!empty($sub_categories)): foreach($sub_categories as $cat): ?>
                <tr>
                    <td><?= 'S2S-0'.$cat->id; ?></td>
                    <td><?= ucfirst($cat->name); ?>'s</td>
                    <td><?= $cat->fullname; ?></td>
                    <td><?= date('M d, Y', strtotime($cat->created_at)); ?></td>
                    <td class="is-narrow">
                        <a title="Edit" data-id="<?= $cat->id; ?>" class="edit_inventory button is-small"><span class="icon is-small"><i class="fa fa-edit"></i></span></a>
                        <a title="Delete" href="<?=base_url('admin/delete_sub_category/'.$cat->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');" class="button is-small"><span class="icon is-small has-text-danger"><i class="fa fa-times"></i></span></a>
                    </td>
                </tr>
                <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='9'>No record found.</td></tr>"; endif; ?>
            </tbody>
            <?php else: ?>
            <tbody>
                <?php if(!empty($results)): foreach($results as $res): ?>
                <tr>
                    <td><?= 'AHG-0'.$res->id; ?></td>
                    <td><?= $res->name; ?></td>
                    <td><?= $res->fullname; ?></td>
                    <td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
                    <td>
                        <a title="Edit" data-id="<?= $res->id; ?>" class="edit_inventory button is-small"><span class="icon is-small"><i class="fa fa-edit"></i></span></a>
                        <a title="Delete" href="<?=base_url('admin/delete_sub_category/'.$res->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');" class="button is-small"><span class="icon is-small has-text-danger"><i class="fa fa-times"></i></span></a>
                    </td>
                </tr>
                <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='10'>No record found.</td></tr>"; endif; ?>
            </tbody>
            <?php endif; ?>
        </table>
    </div>
  </div>
  <div class="column is-hidden-print">
						<nav class="pagination is-small" role="navigation" aria-label="pagination"
							style="justify-content: center;">
							<!-- <?php if(!empty($sub_categories) AND empty($results)){ echo $this->pagination->create_links(); } ?> -->
						</nav>
					</div>
</div>
</div> 
 </section>

<!-- Add sub categories --> 
<div class="modal" id="add_inventory">
	<div class="modal-background"></div>
	<form action="<?=base_url('admin/add_sub_category');?>" method="post">
  <input type="hidden" name="parent_category" value="<?= $this->uri->segment(3); ?>">
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title">Add Sub Categories</p>
				<button class="delete" aria-label="close" id="exit-subcat-modal" type="button"></button>
			</header>
      <section class="modal-card-body">
				<div class="columns">
					<div class="column">
						<div class="field">
							<div class="control">
								<label>Sub Categories</label>
								<input name="name" type="text" id="form34" class="input is-small" type="text"
									placeholder="example .. " required="">
							</div>
						</div>
					</div>
				</div>
			</section>
			<footer class="modal-card-foot">
				<button class="button is-success" type="submit">Submit</button>
				<button class="button" aria-label="close" id="close-cat-modal" type="button">Cancel</button>

			</footer>
		</div>
	</form>
</div> 
<!-- Update inventory -->
<div class="modal" id="edit_inventory">
	<div class="modal-background"></div>
	<form action="<?=base_url('admin/update_sub_category');?>" method="post" method="post">
		<div class="modal-card">
			<header class="modal-card-head">
				<p class="modal-card-title">Update Categories</p>
				<button class="delete" aria-label="close" id="exit-catedt-modal" type="button"></button>
			</header>
			<section class="modal-card-body"> 
				<div class="columns">
					<div class="column">
						<div class="field"> 
            <input type="hidden" name="sub_cat_id" id="subId" value="">
							<input name="name" type="text" id="name" class="input is-small" type="text"
								placeholder="sub categories" required="">
						</div>
					</div>
				</div>

			</section>
			<footer class="modal-card-foot">
				<button class="button is-success" type="submit">Submit</button>
				<button class="button" aria-label="close" id="close-catedt-modal" type="button">Cancel</button>
			</footer>
		</div>
	</form>
</div> 
<!-- Script for showing up the modal -->
<script>
// add subcategories code 
	var subcat1 = $("#exit-subcat-modal")
	var subcat2 = $("#close-cat-modal")
	var subedt1 = $("#exit-catedt-modal")
	var subedt2 = $("#close-catedt-modal")
    
	var subcatmdl = new BulmaModal("#add_inventory")
	var subedtmdl = new BulmaModal("#edit_inventory")
	
	subcat1.click(function (ev) {
		subcatmdl.close();
		ev.stopPropagation();
	});

	subcat2.click(function (ev) {
		subcatmdl.close();
		ev.stopPropagation();
	}); 

    $('.add_inventory').click(function (ev) { 
      subcatmdl.show();
		ev.stopPropagation();
	});

// code for edit 
subedt1.click(function (ev) {
  subedtmdl.close();
		ev.stopPropagation();
	});

	subedt2.click(function (ev) {
		subedtmdl.close();
		ev.stopPropagation();
	});  

$(document).ready(function(){
  $('.edit_inventory').click(function(){  
    var category_id = $(this).data('id'); 
    // AJAX request
    $.ajax({
    url: '<?= base_url('admin/edit_sub_category/'); ?>' + category_id,
    method: 'POST',
    dataType: 'JSON',
    data: {category_id: category_id},
      success: function(response){ 
        console.log(response);
        $('#subId').val(response.id);
        $('#name').val(response.name);
        // $('.edit-modal-body').html(response);
        // // Display Modal 
        subedtmdl.show(); 
      }
    });
  });
});
</script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>