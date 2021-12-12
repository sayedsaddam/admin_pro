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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text"><?php if(empty($results)){ echo 'Suppliers'; }else{ echo 'Search Results'; } ?> | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <?php if($success = $this->session->flashdata('success')): ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="alert alert-success"><?=$success;?></div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row mb-4">
        <div class="col-lg-6 col-md-6">
            <form action="<?=base_url('admin/search_suppliers');?>" method="get" class="md-form form-inline">
                <input type="text" name="search" id="" class="form-control md-form col-5" required>
                <label for="">Search Query</label>
                <input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
            </form>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
            <button data-toggle="modal" data-target="#add_supplier" class="btn btn-outline-info"><i class="fa fa-plus"></i> Add New</button>
            <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <table class="table table-sm">
          <caption><?php if(empty($results)){ echo 'List of Suppliers'; }else{ echo 'Search Results'; } ?></caption>
          <thead>
            <tr>
                <th class="font-weight-bold">ID</th>
                <th class="font-weight-bold">Name</th>
                <th class="font-weight-bold">Email</th>
                <th class="font-weight-bold">Phone</th>
                <th class="font-weight-bold">Location</th>
                <th class="font-weight-bold">Region</th>
                <th class="font-weight-bold">Category</th>
                <th class="font-weight-bold">Status</th>
                <th class="font-weight-bold">Date</th>
                <th class="font-weight-bold">Action</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody>
              <?php if(!empty($suppliers)): foreach($suppliers as $sup): ?>
                <tr>
                  <td><?= 'SUP-0'.$sup->id; ?></td>
                  <td><?= $sup->name; ?></td>
                  <td><?= ucfirst($sup->email); ?></td>
                  <td><?= ucfirst($sup->phone); ?></td>
                  <td><?= ucfirst($sup->location); ?></td>
                  <td><?= ucfirst($sup->region); ?></td>
                  <td><?= ucfirst($sup->category); ?></td>
                  <td>
                      <?php if($sup->status == 1): ?>
                          <span class="badge badge-success">Active</span>
                      <?php else: ?>
                          <span class="badge badge-danger">Inactive</span>
                      <?php endif; ?>
                  </td>
                  <td><?= date('M d, Y', strtotime($sup->created_at)); ?></td>
                  <td>
                      <a data-id="<?= $sup->id; ?>" class="supplier_info"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                      <a href="<?=base_url('admin/delete_supplier/'.$sup->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                      <a href="<?= base_url('admin/supplier_detail/'.$sup->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                  </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='10'>No record found.</td></tr>"; endif; ?>
            </tbody>
          <?php else: ?>
            <tbody>
              <?php if(!empty($results)): foreach($results as $res): ?>
                <tr>
                  <td><?= 'SUP-0'.$res->id; ?></td>
                  <td><?= $res->name; ?></td>
                  <td><?= ucfirst($res->email); ?></td>
                  <td><?= ucfirst($res->phone); ?></td>
                  <td><?= ucfirst($res->location); ?></td>
                  <td><?= ucfirst($res->region); ?></td>
                  <td><?= ucfirst($res->category); ?></td>
                  <td>
                      <?php if($res->status == 1): ?>
                          <span class="badge badge-success">Active</span>
                      <?php else: ?>
                          <span class="badge badge-danger">Inactive</span>
                      <?php endif; ?>
                  </td>
                  <td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
                  <td>
                      <a data-id="<?= $res->id; ?>" class="supplier_info"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                      <a href="<?=base_url('admin/delete_supplier/'.$res->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                      <a href="<?= base_url('admin/supplier_detail/'.$res->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                  </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='7'>No record found.</td></tr>"; endif; ?>
            </tbody>
            <?php endif; ?>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <?php if(empty($results) AND !empty($suppliers)){ echo $this->pagination->create_links(); } ?>
      </div>
    </div>
</div>

<!-- Add supplier -->
<div class="modal fade" id="add_supplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Add Supplier</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('admin/add_supplier');?>" method="post" class="md-form">
            <div class="md-form mb-5">
              <input name="name" type="text" id="form34" class="form-control validate">
              <label data-error="wrong" data-success="right" for="form34">Supplier name</label>
            </div>

            <div class="md-form mb-5">
              <select name="category" id="selectListCat" class="browser-default custom-select">
                <option value="" disabled selected>--Select category--</option>
                <option value="hotel">Hotel</option>
                <option value="travel">Travel</option>
                <option value="stationary">Stationary</option>
                <option value="computers">Computers</option>
                <option value="communications">Commnunications</option>
                <option value="furnitures">Furnitures</option>
                <option value="others">Others</option>
              </select>
            </div>

            <div class="md-form mb-5">
              <input name="email" type="email" id="form29" class="form-control validate">
              <label data-error="wrong" data-success="right" for="form29">Supplier email</label>
            </div>

            <div class="md-form mb-5">
              <input name="phone" type="number" id="form32" class="form-control validate">
              <label data-error="wrong" data-success="right" for="form32">Supplier phone</label>
            </div>

            <div class="md-form mb-5">
              <select name="location" id="supplier_location" class="browser-default custom-select">
                <option value="" disabled selected>--Select location--</option>
                <?php if(!empty($locations)): foreach($locations as $loc): ?>
                  <option value="<?php echo $loc->name ?>"><?php echo $loc->name; ?></option>
                <?php endforeach; endif; ?>
              </select>
            </div>

            <div class="md-form mb-5">
              <select name="region" id="selectListRegion" class="browser-default custom-select">
                <option value="" disabled selected>--Select region--</option>
                <option value="islamabad">Islamabad</option>
                <option value="balochistan">Balochistan</option>
                <option value="khyber PK">Khyber PK</option>
                <option value="sindh">Sindh</option>
                <option value="punjab">Punjab</option>
              </select>
            </div>

            <div class="md-form">
              <textarea name="address" type="text" class="md-textarea form-control" rows="3"></textarea>
              <label data-error="wrong" data-success="right" for="form8">Supplier Address</label>
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

<!-- Edit supplier -->
<div class="modal fade" id="edit_supplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Update Supplier</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body edit-modal-body mx-3">
        <form action="<?=base_url('admin/update_supplier');?>" method="post" class="md-form">
            <input type="hidden" name="sup_id" id="supplierId" value="">
            <div class="md-form mb-5">
              <input name="name" type="text" id="supplier_name" class="form-control validate" value="">
              <label data-error="wrong" data-success="right" for="form34">Supplier name</label>
            </div>

            <div class="md-form mb-5">
              <select name="category" id="category" class="browser-default custom-select">
                <option value="" disabled selected>--Select category--</option>
                <option value="hotel">Hotel</option>
                <option value="travel">Travel</option>
                <option value="stationary">Stationary</option>
                <option value="computers">Computers</option>
                <option value="communications">Commnunications</option>
                <option value="furnitures">Furnitures</option>
                <option value="others">Others</option>
              </select>
            </div>

            <div class="md-form mb-5">
              <input name="email" type="email" id="supplier_email" class="form-control validate" value="">
              <label data-error="wrong" data-success="right" for="form29">Supplier email</label>
            </div>

            <div class="md-form mb-5">
              <input name="phone" type="number" id="supplier_phone" class="form-control validate" value="">
              <label data-error="wrong" data-success="right" for="form32">Supplier phone</label>
            </div>
            
            <div class="md-form mb-5">
              <select name="location" id="supplier_location" class="browser-default custom-select">
                <option value="" disabled selected>--Select location--</option>
                <?php if(!empty($locations)): foreach($locations as $loc): ?>
                  <option value="<?= $loc->name ?>"><?= $loc->name; ?></option>
                <?php endforeach; endif; ?>
              </select>
            </div>

            <div class="md-form mb-5">
              <select name="region" id="region" class="browser-default custom-select">
                <option value="" disabled selected>--Select region--</option>
                <option value="islamabad">Islamabad</option>
                <option value="balochistan">Balochistan</option>
                <option value="khyber PK">Khyber PK</option>
                <option value="sindh">Sindh</option>
                <option value="punjab">Punjab</option>
              </select>
            </div>

            <div class="md-form">
              <textarea name="address" id="supplier_address" type="text" class="md-textarea form-control" rows="3"></textarea>
              <label data-error="wrong" data-success="right" for="form8">Supplier Address</label>
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

<script>
$(document).ready(function(){
  $('.supplier_info').click(function(){  
    var supplier_id = $(this).data('id');
    // AJAX request
    $.ajax({
    url: '<?= base_url('admin/edit_supplier/'); ?>' + supplier_id,
    method: 'POST',
    dataType: 'JSON',
    data: {supplier_id: supplier_id},
      success: function(response){ 
        console.log(response);
        $('#supplierId').val(response.id);
        $('#supplier_name').val(response.name);
        $('#category').val(response.category);
        $('#supplier_email').val(response.email);
        $('#supplier_phone').val(response.phone);
        $('#supplier_location').val(response.location);
        $('#region').val(response.region);
        $('#supplier_address').val(response.address);
        // $('.edit-modal-body').html(response);
        // Display Modal
        $('#edit_supplier').modal('show'); 
      }
    });
  });
});
</script>
