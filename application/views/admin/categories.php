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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text"><?php if(empty($results)){ echo 'Categories'; }else{ echo 'Search Results'; } ?> | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
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
      <form action="<?= base_url('admin/search_categories'); ?>" method="get" class="md-form form-inline">
        <input type="text" name="search" id="" class="form-control md-form col-5">
        <label for="">Search Query</label>
        <input type="submit" value="go &raquo;" class="btn btn-outline-primary btn-sm rounded-pill">
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
        <caption><?php if(empty($results)){ echo 'List of Categories'; }else{ echo 'Search Results'; } ?></caption>
        <thead>
          <tr>
            <th class="font-weight-bold">ID</th>
            <th class="font-weight-bold">Category Name</th>
            <th class="font-weight-bold">Category Location</th>
            <th class="font-weight-bold">Added By</th>
            <th class="font-weight-bold">Date Added</th>
            <th class="font-weight-bold">Action</th>
          </tr>
        </thead>
        <?php if(empty($results)): ?>
          <tbody>
            <?php if(!empty($categories)): foreach($categories as $cat): ?>
              <tr>
                <td><?= 'AHG-0'.$cat->id; ?></td>
                <td><a href="<?= base_url('admin/sub_categories/'.$cat->id); ?>" class="text-info"><?= $cat->cat_name; ?></a></td>
                <td><?= ucfirst($cat->name); ?></td>
                <td><?= $cat->fullname; ?></td>
                <td><?= date('M d, Y', strtotime($cat->created_at)); ?></td>
                <td>
                    <a title="Edit" data-id="<?= $cat->id; ?>" class="category"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                    <a title="Delete" href="<?=base_url('admin/delete_category/'.$cat->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                </td>
              </tr>
            <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='6'>No record found.</td></tr>"; endif; ?>
          </tbody>
        <?php else: ?>
          <tbody>
            <?php if(!empty($results)): foreach($results as $res): ?>
              <tr>
                <td><?= 'AHG-0'.$res->id; ?></td>
                <td><a href="<?= base_url('admin/sub_categories/'.$res->id); ?>" class="text-info"><?= $res->cat_name; ?></a></td>
                <td><?= ucfirst($res->name); ?></td>
                <td><?= $res->fullname; ?></td>
                <td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
                <td>
                    <a title="Edit" data-id="<?= $res->id; ?>" class="category"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                    <a title="Delete" href="<?=base_url('admin/delete_category/'.$res->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
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
      <?php if(!empty($categories) AND empty($results)){ echo $this->pagination->create_links(); } ?>
    </div>
  </div>
</div>

<!-- Add inventory -->
<div class="modal fade" id="add_inventory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Add Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('admin/add_category');?>" method="post" class="md-form">
            
           <div class="md-form mb-5">
              <select name="cat_location" id="for32" class="browser-default custom-select">
                  <option value="" disabled selected>--select location--</option>
                  <?php foreach($locations as $loc): ?>
                    <option value="<?= $loc->id; ?>"><?= ucfirst($loc->name); ?></option>
                  <?php endforeach; ?>
              </select>
            </div>

            <div class="md-form mb-5">
                <input name="cat_name" type="text" id="form34" class="form-control validate">
                <label data-error="wrong" data-success="right" for="form34">Category name</label>
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
        <h4 class="modal-title w-100 font-weight-bold">Update Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('admin/update_category');?>" method="post" class="md-form">
          <input type="hidden" name="id" id="cat_id" value="">
          <div class="md-form mb-5">
            <select name="cat_location" id="cat_location" class="browser-default custom-select">
                <option value="" disabled selected>--select location--</option>
                <?php foreach($locations as $loc): ?>
                  <option value="<?= $loc->id; ?>"><?= ucfirst($loc->name); ?></option>
                <?php endforeach; ?>
            </select>
          </div>

          <div class="md-form mb-5">
              <input name="cat_name" type="text" id="cat_name" class="form-control validate">
              <label data-error="wrong" data-success="right" for="cat_name">Category name</label>
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
  $('.category').click(function(){  
    var category_id = $(this).data('id');
    // AJAX request
    $.ajax({
    url: '<?= base_url('admin/edit_category/'); ?>' + category_id,
    method: 'POST',
    dataType: 'JSON',
    data: {category_id: category_id},
      success: function(response){ 
        console.log(response);
        $('#cat_id').val(response.id);
        $('#cat_location').val(response.cat_location);
        $('#cat_name').val(response.cat_name);
        // $('.edit-modal-body').html(response);
        // // Display Modal
        $('#edit_inventory').modal('show'); 
      }
    });
  });
});
</script>