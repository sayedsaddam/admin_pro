<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid">
      </div>
      <div class="col-lg-7 col-md-7">
        <h2 class="display-4 font-weight-bold mb-0">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-light">AH Group of Companies (Pvt.) Ltd.</h3>
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
            <form action="#" method="get" class="md-form form-inline"> 
                <input type="text" name="search" id="myInput" class="form-control md-form col-5" required>
                <label for="">Search Query</label>
                <input type="submit" value="go &raquo;" class="btn btn-outline-primary btn-sm rounded-pill">
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
                <th class="font-weight-bold">Department</th>  
                <th class="font-weight-bold">Status</th>
                <th class="font-weight-bold">Date</th>
                <th class="font-weight-bold">Action</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody id="myTable">
              <?php if(!empty($employ)): foreach($employ as $sup): ?>
                <tr>
                  <td><?= 'SUP-0'.$sup->emp_id; ?></td>
                  <td><?= $sup->emp_name; ?></td>
                  <td><?= ucfirst($sup->email); ?></td>
                  <td><?= ucfirst($sup->phone); ?></td>
                  <td><?= ucfirst($sup->name); ?></td>  
                  
                  <td><?= ucfirst($sup->department); ?></td>  
                  
                  <td>
                      <?php if($sup->status == 1): ?>
                          <span class="badge badge-success">Active</span>
                      <?php else: ?>
                          <span class="badge badge-danger">Inactive</span>
                      <?php endif; ?>
                  </td>
                  <td><?= date('M d, Y', strtotime($sup->created_at)); ?></td>
                  <td>
                      <a data-id="<?= $sup->emp_id; ?>" class="supplier_info"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                      <a href="<?=base_url('admin/delete_employ/'.$sup->emp_id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                   </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='10'>No record found.</td></tr>"; endif; ?>
            </tbody>
          <?php else: ?>
            <tbody id="myTable">
              <?php if(!empty($results)): foreach($results as $res): ?>
                <tr>
                  <td><?= 'SUP-0'.$res->emp_id; ?></td>
                  <td><?= $res->emp_name; ?></td>
                  <td><?= ucfirst($res->email); ?></td>
                  <td><?= ucfirst($res->phone); ?></td>
                  <td><?= ucfirst($res->location); ?></td> 
                  <td><?php  echo '<span style="color:  orange;font-size: 18px;font-weight: bold">'.ucfirst($res->rating).'</span>'.'<span class="fa fa-star checked" style="color: orange"></span>'; ?></td> 
                  <td><?= ucfirst($res->region); ?></td>
                  <td><?= ucfirst($res->department); ?></td>
                  <td>
                      <?php if($res->status == 1): ?>
                          <span class="badge badge-success">Active</span>
                      <?php else: ?>
                          <span class="badge badge-danger">Inactive</span>
                      <?php endif; ?>
                  </td>
                  <td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
                  <td>
                      <a data-id="<?= $res->emp_id; ?>" class="supplier_info"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
        <a href="<?=base_url('admin/delete_employ/'.$res->emp_id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
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
        <h4 class="modal-title w-100 font-weight-bold">Add Employ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('admin/add_employ');?>" method="post" class="md-form">
          <div class="md-form mb-5">
            <select name="location" id="location" class="browser-default custom-select">
              <option value="" disabled selected>--Select location--</option>
              <?php if(!empty($locations)): foreach($locations as $loc): ?>
                <option value="<?php echo $loc->id ?>"><?php echo ucfirst($loc->name); ?></option>
              <?php endforeach; endif; ?>
            </select>
          </div>
            
          <div class="md-form mb-5">
            <input name="name" type="text" id="form34" class="form-control validate">
            <label data-error="wrong" data-success="right" for="form34">Employ name</label>
          </div>

          <div class="md-form mb-5">
            <!-- <select name="category" id="selectListCat" class="browser-default custom-select"> -->
            <select name="department[]" id="selectListCat" class="form-control" required multiple>
              <option value="" disabled selected>--Select Department--</option>
              <option value="IT">IT</option>
              <option value="sale">Sale</option>
              <option value="marketing">marketing</option>
              <option value="media">media</option>
              <option value="finance">Finance</option> 
              <option value="others">Others</option>
            </select>
          </div>

          <div class="md-form mb-5">
            <input name="email" type="email" id="form29" class="form-control validate">
            <label data-error="wrong" data-success="right" for="form29">Employ email</label>
          </div>
          

          <div class="md-form mb-5">
            <input name="phone" type="number" id="form32" class="form-control validate">
            <label data-error="wrong" data-success="right" for="form32">Employ phone</label>
          </div>  

          <div class="md-form">
            <textarea name="address" type="text" class="md-textarea form-control" rows="3"></textarea>
            <label data-error="wrong" data-success="right" for="form8">Employ Address</label>
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
<div class="modal fade" id="edit_employ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Update Employ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body edit-modal-body mx-3">
        <form action="<?=base_url('admin/update_employ');?>" method="post" class="md-form">
          <input type="hidden" name="sup_id" id="employId" value="">
          <div class="md-form mb-5">
            <select name="location" id="employ_location" class="browser-default custom-select">
              <option value="" disabled selected>--Select location--</option>
              <?php if(!empty($locations)): foreach($locations as $loc): ?>
                <option value="<?= $loc->id ?>"><?= ucfirst($loc->name); ?></option>
              <?php endforeach; endif; ?>
            </select>
          </div>
          <div class="md-form mb-5">
            <input name="name" type="text" id="employ_name" class="form-control validate" value="">
            <label data-error="wrong" data-success="right" for="form34">Employ name</label>
          </div> 
          <div class="md-form mb-5">
            <select name="department[]" id="department" class="browser-default custom-select" required multiple>
              <option value="" disabled selected>--Select Department--</option>  
              <option value="IT">IT</option>
              <option value="sale">Sale</option>
              <option value="marketing">marketing</option>
              <option value="media">media</option>
              <option value="finance">Finance</option> 
              <option value="others">Others</option>
            </select>
          </div>

          <div class="md-form mb-5">
            <input name="email" type="email" id="employ_email" class="form-control validate" value="">
            <label data-error="wrong" data-success="right" for="form29">Employ email</label>
          </div>

          <div class="md-form mb-5">
            <input name="phone" type="number" id="employ_phone" class="form-control validate" value="">
            <label data-error="wrong" data-success="right" for="form32">Employ phone</label>
          </div>  

          <div class="md-form">
            <textarea name="address" id="employ_address" type="text" class="md-textarea form-control" rows="3"></textarea>
            <label data-error="wrong" data-success="right" for="form8">Employ Address</label>
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
        $('#employ_name').val(response.name);
        $('#department').val(response.category);
        $('#employ_email').val(response.email);
        $('#employ_phone').val(response.phone);
        $('#employ_ntn').val(response.ntn_number);
        $('#employ_rating').val(response.rating);
        $('#employ_address').val(response.address);
        // $('.edit-modal-body').html(response);
        // Display Modal
        $('#edit_employ').modal('show'); 
      }
    });
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