<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid" width="200">
      </div>
      <div class="col-lg-7 col-md-7">
        <h2 class="display-4 font-weight-bold mb-0">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-light">AH Group of Companies (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text"><?php if(empty($results)){ echo 'Asset Register'; }else{ echo 'Search Results'; } ?> | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
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
            <!-- <form action="<?= base_url('admin/search_assign_items'); ?>" method="get" class="md-form form-inline"> -->
            <form action="#" method="get" class="md-form form-inline">
                <input type="text" name="search" id="myInput" class="form-control md-form col-5">
                <label for="">Search Query</label>
                <input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
            </form>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
            <a href="<?= base_url('admin/assign_item'); ?>" data-target="#" class="btn btn-outline-info"><i class="fa fa-plus"></i> Assign Item</a>
            <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <table class="table table-sm">
          <caption><?php if(empty($results)){ echo 'List of Assets'; }else{ echo 'Search Results'; } ?></caption>
          <thead>
            <tr>
                <th class="font-weight-bold">ID</th>
                <th class="font-weight-bold">Assign By</th>
                <th class="font-weight-bold">Assign To</th>
                <th class="font-weight-bold">Item</th>
                <th class="font-weight-bold">Item Type</th>
                <!-- <th class="font-weight-bold">Model</th> -->
                <th class="font-weight-bold">Description</th>
                <th class="font-weight-bold">Item Status</th>
                <th class="font-weight-bold">Status</th>
                <th class="font-weight-bold">Assignd Date</th> 
                <th class="font-weight-bold">Action</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody id="myTable">
              <?php if(!empty($items)): foreach($items as $item): ?>
                <tr>
                  <td><?= 'CTC-0'.$item->item_ids; ?></td>
                  <td><?= $item->assignd_by; ?></td>
                  <td><?= ucfirst($item->fullname); ?></td>
                  <td><?= ucfirst($item->sub_cat_name); ?></td>
                  <td><?= ucfirst($item->type_name); ?></td>
                   <td><?= ucfirst($item->description); ?></td>  
                   <td><?= ucfirst($item->item_status); ?></td>  
                  <td><?php if($item->status == 1){ echo "<span class='btn btn-danger btn btn-sm'>Assignd</span>";}else{echo "<span class='btn btn-success btn btn-sm'>Available</span>";} ?></td>
                  <td><?= date('M d, Y', strtotime($item->created_at)); ?></td>
                  
                  <td>
                      <a href="<?= base_url('admin/assign_item/'.$item->item_ids); ?>"><span class="badge badge-info"><i class="fa fa-check"></i></span></a>
                      <a href="<?= base_url('admin/return_item/'.$item->item_ids); ?>"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a> 
                  </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
            </tbody> 
          <?php else: ?>
            <tbody>
              <?php if(!empty($results)): foreach($results as $res): ?>
                <tr>
                  <td><?= 'CTC-0'.$res->id; ?></td>
                  <td><?= $res->assignd_by; ?></td>
                  <td><?= ucfirst($res->fullname); ?></td>
                  <td><?= ucfirst($res->sub_cat_name); ?></td>
                   <td><?= ucfirst($res->description); ?></td>  
                   <td><?= ucfirst($res->item_status); ?></td>  
                  <td><?php if($res->status == 1){ echo "<span class='btn btn-success btn btn-sm'>Assignd</span>";}else{echo "<span class='btn btn-danger btn btn-sm'>Available</span>";} ?></td>
                  <td><?= ucfirst($res->created_at); ?></td>  
                  <td>
                      <a href="<?= base_url('admin/assign_item/'.$res->id); ?>"><span class="badge badge-info"><i class="fa fa-check"></i></span></a>
                      <a href="<?= base_url('admin/return_item/'.$res->id); ?>"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a> 
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
        <?php if(empty($results) AND !empty($items)){ echo $this->pagination->create_links(); } ?>
      </div>
    </div>
</div>

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