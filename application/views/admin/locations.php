<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
				<h2 class="display-4 font-weight-bold" title="Human resource Information Management">HRIM</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Locations | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
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
            <form action="<?= base_url('admin/search_locations'); ?>" method="get" class="md-form form-inline">
                <input type="text" name="search" id="" class="form-control md-form col-5" required>
                <label for="">Search Query</label>
                <input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
            </form>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
            <a data-toggle="modal" data-target="#add_location" class="btn btn-outline-info"><i class="fa fa-plus"></i> Add New</a>
            <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <table class="table table-sm">
          <caption><?php if(empty($results)){ echo 'List of Locations'; }else{ echo 'Search Results'; } ?></caption>
          <thead>
            <tr>
               <th class="font-weight-bold">Serial #</th>
               <th class="font-weight-bold">Name</th>
               <th class="font-weight-bold">Province</th>
               <th class="font-weight-bold">Date</th>
               <th class="font-weight-bold">Action</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody>
              <?php if(!empty($locations)): $serial= $this->uri->segment(3) + 1; foreach($locations as $loc): ?>
                <tr>
                    <td><?= $serial++; ?></td>
                    <td><?= $loc->name; ?></td>
                    <td><?= $loc->province; ?></td>
                    <td><?= date('M d, Y', strtotime($loc->created_at)); ?></td>
                    <td>
                        <a data-id="<?= $loc->id; ?>" class="location_info"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                        <a href="<?=base_url('admin/delete_location/'.$loc->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                    </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='14'>No record found.</td></tr>"; endif; ?>
            </tbody> 
          <?php else: ?>
            <tbody>
              <?php if(!empty($results)): $serial = 1; foreach($results as $res): ?>
                <tr>
                  <td><?= $serial++; ?></td>
                  <td><?= $res->name; ?></td>
                  <td><?= $res->province ?></td>
                  <td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
                  <td>
                      <a data-id="<?= $res->id; ?>" class="location_info"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                      <a href="<?=base_url('admin/delete_location/'.$res->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                  </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
            </tbody>
        <?php endif; ?>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <?php if(empty($results) AND !empty($locations)){ echo $this->pagination->create_links(); } ?>
      </div>
    </div>
</div>
<!-- Modal to add location -->
<div class="modal fade" id="add_location" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Add Location</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?= base_url('admin/add_location'); ?>" method="post">
            <div class="md-form mb-5">
                <input type="text" name="location_name" id="orangeForm-name" class="form-control validate">
                <label data-error="wrong" data-success="right" for="orangeForm-name">Location name</label>
                </div>
                <div class="md-form mb-5">
                <input type="text" name="province" id="orangeForm-email" class="form-control validate">
                <label data-error="wrong" data-success="right" for="orangeForm-email">Province</label>
                </div>
                
                <div class="md-form">
                    <button type="submit" class="btn btn-deep-purple">Save Changes</button>
                    <button type="reset" class="btn btn-orange">Reset</button>
                </div>
            </div>
        </form>
      <div class="modal-footer d-flex justify-content-left">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal to edit location -->
<div class="modal fade" id="edit_location" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Update Location</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?= base_url('admin/update_location'); ?>" method="post">
            <input type="hidden" name="id" id="location-id">
            <div class="md-form mb-5">
                <input type="text" name="location_name" id="location-name" class="form-control validate">
                <label data-error="wrong" data-success="right" for="orangeForm-name">Location name</label>
                </div>
                <div class="md-form mb-5">
                <input type="text" name="province" id="province-name" class="form-control validate">
                <label data-error="wrong" data-success="right" for="orangeForm-name">Province</label>
                </div>
                
                <div class="md-form">
                    <button type="submit" class="btn btn-deep-purple">Save Changes</button>
                    <button type="reset" class="btn btn-orange">Reset</button>
                </div>
            </div>
        </form>
      <div class="modal-footer d-flex justify-content-left">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $('.location_info').click(function(){  
    var location_id = $(this).data('id');
    // AJAX request
    $.ajax({
    url: '<?= base_url('admin/edit_location/'); ?>' + location_id,
    method: 'POST',
    dataType: 'JSON',
    data: {location_id: location_id},
      success: function(response){ 
        console.log(response);
        $('#location-id').val(response.id);
        $('#location-name').val(response.name);
        $('#province-name').val(response.province);
        // $('.edit-modal-body').html(response);
        // Display Modal
        $('#edit_location').modal('show'); 
      }
    });
  });
});
</script>
