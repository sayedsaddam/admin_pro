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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text"><?php if(empty($results)){ echo ' Asset List'; }else{ echo 'Search Results'; } ?> | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
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
        <div class="col-lg-4 col-md-4">
            <form action="<?= base_url('admin/search_purchase_item'); ?>" method="get" class="md-form form-inline">
                <input type="text" name="search" id="myInput" class="form-control md-form col-5">
                <label for="">Search Query</label>
                <input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
            </form>
        </div>
         <div class="col-lg-8 col-md-8 text-right">
        <!-- <a href="<?= base_url('admin/get_assign_item'); ?>" data-target="#assign_list" class="btn btn-outline-danger"><i class="fa fa-sub"></i> Assign List</a> -->
        <a href="<?= base_url('admin/purchase_product'); ?>" data-target="#add_supplier" class="btn btn-outline-info"><i class="fa fa-plus"></i> Purchase Order</a>
            <a href="<?= base_url('admin/'); ?>" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
          </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <table class="table table-sm">
          <caption><?php if(empty($results)){ echo 'List of Assets'; }else{ echo 'Search Results'; } ?></caption>
          <thead>
            <tr>
              <!-- <?php echo phpinfo(); ?> -->
                <th class="font-weight-bold">ID </th>
                <th class="font-weight-bold">Supplier</th> 
                <th class="font-weight-bold">Location</th>
                <!-- <th class="font-weight-bold">Category</th> -->
                <th class="font-weight-bold">Sub Category</th>   
                <th class="font-weight-bold"> Date</th> 
                <th class="font-weight-bold">Status</th> 
                <th class="font-weight-bold">Action</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody id="myTable">
              <?php if(!empty($items)): foreach($items as $item): ?>
                <tr>
                  <td><?= 'CTC-0'.$item->purchase_id; ?></td>
                  <td><?= $item->sup_name; ?></td>
                  <td><?= ucfirst($item->loc_name); ?></td>
                  <!-- <td><?= ucfirst($item->cat_name); ?></td> -->
                   <td><?= ucfirst($item->sub_name); ?></td>     
                   <td> <?= date('M d, Y', strtotime($item->created_at)); ?> </td>
                  <?php if($item->status == 0) { ?>
                   <td ><span class="badge badge-danger">Pending</span></td> 
                   <?php } elseif($item->status == 1 ){ ?>
                   <td><span class="badge badge-warning">Process <span></td> 
                  <?php } else{ ?>
                    <td><span class="badge badge-success">Approved <span></td> 
                    <?php } ?>
                  <td>
                  <!-- <a href="<?= base_url('admin/edit_order/'.$item->purchase_id); ?>"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> <a href="<?= base_url('admin/view_order/'.$item->purchase_id); ?>"><span class="badge badge-info"><i class="fa fa-check"></i></span></a> -->
                  <a href="<?= base_url('admin/order_detail/'.$item->purchase_id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                  <a href="<?= base_url('admin/cancel_order/'.$item->purchase_id); ?>" class=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                  <!-- <a href="<?= base_url('admin/approved_order/'.$item->purchase_id); ?>" class=""><span class="badge badge-success"><i class="fa fa-check"></i></span></a> -->
                  <td> 
                  </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
            </tbody> 
          <?php else: ?>
            <tbody>
              <?php if(!empty($results)): foreach($results as $item): ?>
                <tr>
                  <td><?= 'CTC-0'.$item->purchase_id; ?></td>
                  <td><?= $item->sup_name; ?></td>
                  <td><?= ucfirst($item->loc_name); ?></td>
                  <!-- <td><?= ucfirst($item->cat_name); ?></td> -->
                   <td><?= ucfirst($item->sub_name); ?></td>     
                  <td> <?= date('M d, Y', strtotime($item->created_at)); ?> </td>
                  <?php if($item->status == 0) { ?>
                   <td class="badge badge-danger">pending</td> 
                   <?php } else { ?>
                   <td class="badge badge-success">approved</td> 
                  <?php } ?>
                  <td>
                  <!-- <a href="<?= base_url('admin/edit_order/'.$item->purchase_id); ?>"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> <a href="<?= base_url('admin/view_order/'.$item->purchase_id); ?>"><span class="badge badge-info"><i class="fa fa-check"></i></span></a> -->
                  <a href="<?= base_url('admin/order_detail/'.$item->purchase_id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                  <a href="<?= base_url('admin/cancel_order/'.$item->purchase_id); ?>" class=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                  <!-- <a href="<?= base_url('admin/approved_order/'.$item->purchase_id); ?>" class=""><span class="badge badge-success"><i class="fa fa-check"></i></span></a> -->
                  <td> 
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