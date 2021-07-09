<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid" width="200">
      </div>
      <div class="col-lg-7 col-md-7">
        <h2 class="display-4 font-weight-bold">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-light">AH Group of Companies (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text"><?php if(empty($results)){ echo 'Inventory'; }else{ echo 'Search Results'; } ?> | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <?php if($success = $this->session->flashdata('success')): ?>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="alert alert-success"><?=$success;?></div>
      </div>
    </div>
  <?php endif; ?>
  <div class="row mb-4">
    <div class="col-lg-6 col-md-6">
      <form action="<?= base_url('admin/search_inventory'); ?>" method="get" class="md-form form-inline">
        <input type="text" name="search" id="" class="form-control md-form col-5">
        <label for="">Search Query</label>
        <input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
      </form>
    </div>
    <div class="col-lg-6 col-md-6 text-right">
      <button data-toggle="modal" data-target="#add_inventory" class="btn btn-outline-info"><i class="fa fa-plus"></i> Add New</button>
      <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <table class="table table-sm">
        <caption><?php if(empty($results)){ echo 'List of Inventory'; }else{ echo 'Search Results'; } ?></caption>
        <thead>
          <tr>
            <th class="font-weight-bold">ID</th>
            <th class="font-weight-bold">Location</th>
            <th class="font-weight-bold">Name</th>
            <th class="font-weight-bold">Category</th>
            <th class="font-weight-bold">Quantity</th>
            <th class="font-weight-bold">Unit Price</th>
            <th class="font-weight-bold">Total Cost</th>
            <th class="font-weight-bold">Date Added</th>
            <th class="font-weight-bold">Action</th>
          </tr>
        </thead>
        <?php if(empty($results)): ?>
          <tbody>
            <?php if(!empty($inventory)): foreach($inventory as $inv): ?>
              <tr>
                <td><?= 'Inv-0'.$inv->id; ?></td>
                <td><?= $inv->loc_name; ?></td>
                <td><?= $inv->sub_cat_name; ?></td>
                <td><?= $inv->cat_name; ?></td>
                <td><?= $inv->item_qty; ?></td>
                <td><?= number_format($inv->unit_price) ?></td>
                <td><?= number_format($inv->unit_price * $inv->item_qty); ?></td>
                <td><?= date('M d, Y', strtotime($inv->created_at)); ?></td>
                <td>
                    <a data-id="<?= $inv->id; ?>" class="inventory"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                    <a href="<?=base_url('admin/delete_inventory/'.$inv->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                    <a href="<?= base_url('admin/inventory_detail/'.$inv->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                </td>
              </tr>
            <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='8'>No record found.</td></tr>"; endif; ?>
          </tbody>
        <?php else: ?>
          <tbody>
            <?php if(!empty($results)): foreach($results as $res): ?>
              <tr>
                <td><?= 'Inv-0'.$res->id; ?></td>
                <td><?= $res->loc_name; ?></td>
                <td><?= $res->sub_cat_name; ?></td>
                <td><?= $res->cat_name; ?></td>
                <td><?= $res->item_qty; ?></td>
                <td><?= number_format($res->unit_price) ?></td>
                <td><?= number_format($res->unit_price * $res->item_qty); ?></td>
                <td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
                <td>
                    <a data-id="<?= $res->id; ?>" class="inventory"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                    <a href="<?=base_url('admin/delete_inventory/'.$res->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                    <a href="<?= base_url('admin/inventory_detail/'.$res->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                </td>
              </tr>
            <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='8'>No record found.</td></tr>"; endif; ?>
          </tbody>
        <?php endif; ?>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <?php if(!empty($inventory) AND empty($results)){ echo $this->pagination->create_links(); } ?>
    </div>
  </div>
</div>

<!-- Add inventory -->
<div class="modal fade" id="add_inventory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Add Inventory</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('admin/add_inventory');?>" method="post" class="md-form">
          <div class="md-form mb-5">
            <select name="location" id="for32" class="browser-default custom-select">
              <option value="" disabled selected>--select location--</option>
              <?php foreach($locations as $loc): ?>
                <option value="<?= $loc->id; ?>"><?= ucfirst($loc->name); ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="md-form mb-5">
            <select name="category" id="category" class="browser-default custom-select">
              <option value="" disabled selected>--select category--</option>
              <?php if(!empty($categories)): foreach($categories as $cat): ?>
                <option value="<?= $cat->id; ?>"><?= $cat->cat_name; ?></option>
              <?php endforeach; endif; ?>
            </select>
          </div>

          <div class="md-form mb-5">
            <select name="item_name" id="item_name" class="browser-default custom-select">
              <option value="" disabled selected>--select item--</option>
            </select>
          </div>

          <div class="md-form mb-5">
            <input type="text" name="item_qty" id="item_qty" class="form-control" required>
            <label for="item-qty">Quantity</label>
          </div>

          <div class="md-form mb-5">
            <input type="number" name="unit_price" id="unit_price" class="form-control" required>
            <label for="item-qty">Unit Price</label>
          </div>
        
          <div class="md-form">
            <textarea name="item_desc" id="form7" class="md-textarea form-control" rows="3"></textarea>
            <label for="form7">Item Desctiption</label>
          </div>

          <div class="md-form mb-5">
            <input type="submit" class="btn btn-primary" value="Save Changes">
          </div>
        </form>
      </div>
      <div class="modal-footer d-flex justify-content-right">
        <button class="btn btn-unique" data-dismiss="modal" aria-label="Close">Close <i class="fas fa-paper-plane-o ml-1"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- Update inventory -->
<div class="modal fade" id="edit_inventory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Update Inventory</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('admin/add_inventory');?>" method="post" class="md-form">
          <input type="hidden" name="category" value="<?php  ?>">
          <div class="md-form mb-5">
            <select name="location" id="for32" class="browser-default custom-select">
              <option value="" disabled selected>--select location--</option>
              <?php foreach($locations as $loc): ?>
                <option value="<?= $loc->id; ?>"><?= ucfirst($loc->name); ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="md-form mb-5">
            <select name="category" id="for32" class="browser-default custom-select">
              <option value="" disabled selected>--select category--</option>
              <?php if(!empty($categories)): foreach($categories as $cat): ?>
                <option value="<?= $cat->id; ?>"><?= $cat->cat_name; ?></option>
              <?php endforeach; endif; ?>
            </select>
          </div>

          <div class="md-form mb-5">
            <select name="item_name" id="for32" class="browser-default custom-select">
              <option value="" disabled selected>--select item--</option>
            </select>
          </div>

          <div class="md-form mb-5">
            <input type="text" name="item_qty" id="item_qty" class="form-control" required>
            <label for="item-qty">Quantity</label>
          </div>

          <div class="md-form mb-5">
            <input type="number" name="unit_price" id="unit_price" class="form-control" required>
            <label for="item-qty">Unit Price</label>
          </div>
        
          <div class="md-form">
            <textarea name="item_desc" id="form7" class="md-textarea form-control" rows="3"></textarea>
            <label for="form7">Item Desctiption</label>
          </div>

          <div class="md-form mb-5">
            <input type="submit" class="btn btn-primary" value="Save Changes">
          </div>
        </form>
      </div>
      <div class="modal-footer d-flex justify-content-right">
        <button class="btn btn-unique" data-dismiss="modal" aria-label="Close">Close <i class="fas fa-paper-plane-o ml-1"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- Script for showing up the modal -->
<script>
$(document).ready(function(){
  $('.inventory').click(function(){  
    var inventory_id = $(this).data('id');
    // AJAX request
    $.ajax({
    url: '<?= base_url('admin/edit_inventory/'); ?>' + inventory_id,
    method: 'POST',
    dataType: 'JSON',
    data: {inventory_id: inventory_id},
      success: function(response){ 
        console.log(response);
        $('#inventoryId').val(response.id);
        $('#item_name').val(response.item_name);
        $('#item_desc').val(response.item_desc);
        $('#unit_price').val(response.unit_price);
        $('#item_qty').val(response.item_qty);
        $('#item_cat').val(response.item_category);
        $('#item_loc').val(response.item_loc);
        // $('.edit-modal-body').html(response);
        // // Display Modal
        $('#edit_inventory').modal('show'); 
      }
    });
  });
});
</script>
<script>
$(document).ready(function(){
 
 // City change
 $('#category').on('change', function(){
   var category = $(this).val();

   // AJAX request
   $.ajax({
     url:'<?=base_url('admin/get_sub_categories/')?>' + category,
     method: 'post',
     data: {category: category},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#item_name').find('option').not(':first').remove();

       // Add options
       $.each(response,function(index, data){
          $('#item_name').append('<option value="'+data['id']+'">'+data['name']+'</option>');
       });
     }
  });
});
});
</script>