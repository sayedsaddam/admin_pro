<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <h2 class="display-4 font-weight-bold">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i><span class="font-weight-light">Requisitions List</span> | <a href="<?=base_url('users');?>" class="text-light">Home</a></h4>
      </div>
    </div>
  </div>
</div>

<div class="container my-3 py-3">

  <!-- Section: Requisitions list -->
  <section>
    <div class="row">
      <div class="col-12">
      	<div class="card card-list">
          <div class="card-header white d-flex justify-content-between align-items-center py-3">
            <p class="h5-responsive font-weight-bold mb-0">Recent Requisitions | <small><a href="javascript:history.go(-1)" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small></p>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
              <li><i class="fas fa-times fa-sm pl-3"></i></li>
            </ul>
          </div>
          <div class="card-body">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th class="font-weight-bold">Order ID</th>
                  <th class="font-weight-bold">Item</th>
                  <th class="font-weight-bold">Quantity</th>
                  <th class="font-weight-bold">Desciption</th>
                  <th class="font-weight-bold">Status</th>
                  <th class="font-weight-bold">Requested</th>
                  <th class="font-weight-bold">Processed</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($requisitions)): foreach($requisitions as $req): ?>
                  <tr>
                    <td scope="row"><?= 'AHG-0'.$req->id; ?></td>
                    <td><?= ucfirst($req->sub_cat_name); ?></td>
                    <td><?= $req->item_qty; ?></td>
                    <td><?= $req->item_desc; ?></td>
                    <td>
                      <?php if($req->status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }elseif($req->status == 1){ echo "<span class='badge badge-success'>approved</span>"; }else{ echo "<span class='badge badge-danger'>rejected</span>"; } ?>
                    </td>
                    <td><?= date('M d, Y', strtotime($req->created_at)); ?></td>
                    <td>
                      <?php if($req->updated_at != NULL){ echo date('M d, Y', strtotime($req->updated_at)); }else{ echo "<span class='purple-text'>Nothing yet.</span>"; } ?>
                    </td>
                  </tr>
                <?php endforeach; else: echo '<tr class="table-danger"><td colspan="7" align="center">Looks like you have no requisistions yet.</td></tr>'; endif; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer white py-3 d-flex justify-content-between">
            <button type="button" class="btn btn-primary btn-lg px-3 my-0 ml-0" data-toggle="modal" data-target="#fullHeightModalLeft">
                <i class="fa fa-plus"></i> Place requisisition
            </button>
            <?= $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Requisitions -->
</div>

<!-- Full Height Modal Left > Place requisition -->
<div class="modal fade left" id="fullHeightModalLeft" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-full-height modal-left" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title w-100" id="myModalLabel">Create Requisition</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h4 class="font-weight-lighter mb-5">Please fill out the form below.</h4>
                    <!-- Form -->
                    <form action="<?= base_url('users/create_requisition'); ?>" method="post">
                        <!-- item name -->
                        <div class="form-group">
                            <label for="itemName">Category</label>
                            <select name="category" id="category" class="browser-default custom-select">
                                <option value="" disabled selected>-- Main Category --</option>
                                <?php if(!empty($items)): foreach($items as $item): ?>
                                  <option value="<?=$item->cat_id;?>"><?=$item->cat_name;?></option>
                                <?php endforeach; endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="itemName">Item name</label>
                            <select name="sub_category" id="sub_category" class="browser-default custom-select">
                              <option value="" disabled selected>-- Sub Category --</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea name="description" id="description" class="form-control" placeholder="Description..."></textarea>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" class="form-control" placeholder="Item quantity...">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Save Changes">
                        </div>
                    </form>
                    <!-- Form -->
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- Full Height Modal Left -->
<script>
$(document).ready(function(){
 
 // City change
 $('#category').on('change', function(){
   var category = $(this).val();

   // AJAX request
   $.ajax({
     url:'<?=base_url('users/get_sub_categories/')?>' + category,
     method: 'post',
     data: {category: category},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#sub_category').find('option').not(':first').remove();

       // Add options
       $.each(response,function(index, data){
          $('#sub_category').append('<option value="'+data['id']+'">'+data['name']+'</option>');
       });
     }
  });
});
});
</script>