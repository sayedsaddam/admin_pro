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
            <form action="<?= base_url('Purchase/search_purchase_item'); ?>" method="get" class="md-form form-inline">
                <input type="text" name="search" id="myInput" class="form-control md-form col-5">
                <label for="">Search Query</label>
                <input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
            </form>
        </div>
         <div class="col-lg-8 col-md-8 text-right">
        <!-- <a href="<?= base_url('admin/get_assign_item'); ?>" data-target="#assign_list" class="btn btn-outline-danger"><i class="fa fa-sub"></i> Assign List</a> -->
        <a href="<?= base_url('Purchase/purchase_product'); ?>" data-target="#add_supplier" class="btn btn-outline-info"><i class="fa fa-plus"></i> Purchase Order</a>
            <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
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
                <th class="font-weight-bold">Product</th>   
                <th class="font-weight-bold">Quantity</th>   
                <th class="font-weight-bold"> Date</th> 
                <th class="font-weight-bold"> Price</th> 
                <th class="font-weight-bold"> Quotation</th> 
                <th class="font-weight-bold">Status</th> 
                <th class="font-weight-bold">Action</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody id="myTable"> 
              <?php if(!empty($items)):  $lowest_price = array_column($items, 'price'); foreach($items as $item): ?>
                <?php if($item->qut_status == 'rejected'){ ?>
                <tr style="display: none;"  class="<?php if(min($lowest_price) == $item->price){ echo 'table-success text-dark'; } ?>">
                  <td><?= 'CTC-0'.$item->purchase_id; ?></td>
                  <td><?= ucfirst($item->sup_name); ?></td> 
                  <td><?= $item->name;?></td>
                   <td><?= ucfirst($item->product); ?></span></td>     
                   <td><?= ucfirst($item->quantity); ?></td>     
                   <td> <?= date('M d, Y', strtotime($item->created_at)); ?> </td>
                   <td> <?= $item->price; ?> </td>
                   <td> <?= $item->description; ?> </td>
                  <?php if($item->qut_status == 1) { ?>
                   <td ><span class="badge badge-success">Approved</span></td> 
                   <?php } elseif($item->qut_status == null ){ ?>
                   <td><span class="badge badge-secondary">Pending <span></td> 
                   <?php } elseif($item->qut_status == 'rejected'){ ?>
                    <td><span class="badge badge-danger"><?=$item->qut_status; ?>  <span></td> 
                  <?php } elseif($item->qut_status == 0){ ?>
                      <td><span class="badge badge-warning">process <span></td> 
                    <?php } ?>
           <td>
           <?php "<span id='qutation'>".$quotations = $this->admin_model->count_qutation($item->purchase_id)."</span>"; ?>  
           <?php if($quotations < 3) { ?>
                <a data-id="<?= $item->purchase_id.'/'.$item->sup_id; ?>" class="add_qutations"><span class="badge badge-primary"><i class="fas fa-check"></i></span></a>
<?php } else { ?>
  <?php   $quotations; ?>

  <a data-id="<?= $item->purchase_id.'/'.$item->sup_id; ?>" class="add_qutations disabled"><span class="badge badge-danger"><i class="fas fa-check"></i></span></a>
  <!-- echo "qutation is completed"; -->
<?php } ?>
          <a href="<?= base_url('Purchase/order_detail/'.$item->purchase_id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>  
          </td>
          </tr>
          <?php } else{ ?>
            <tr class="<?php if(min($lowest_price) == $item->price){ echo 'table-success text-dark'; } ?>">
                  <td><?= 'CTC-0'.$item->purchase_id; ?></td>
                  <td><?= ucfirst($item->sup_name); ?></td> 
                  <td><?= $item->name;?></td>
                   <td><?= ucfirst($item->product); ?></span></td>     
                   <td><?= ucfirst($item->quantity); ?></td>     
                   <td> <?= date('M d, Y', strtotime($item->created_at)); ?> </td>
                   <td> <?= $item->price; ?> </td>
                   <td> <?= $item->description; ?> </td>
                  <?php if($item->qut_status == 1) { ?>
                   <td ><span class="badge badge-success">Approved</span></td> 
                   <?php } elseif($item->qut_status == null ){ ?>
                   <td><span class="badge badge-secondary">Pending <span></td> 
                   <?php } elseif($item->qut_status == 'rejected'){ ?>
                    <td><span class="badge badge-danger"><?=$item->qut_status; ?>  <span></td> 
                  <?php } elseif($item->qut_status == 0){ ?>
                      <td><span class="badge badge-warning">process <span></td> 
                    <?php } ?>
                  <td>
                     <?php "<span id='qutation'>".$quotations = $this->admin_model->count_qutation($item->purchase_id)."</span>"; ?> 
                     <?php if($quotations < 3) { ?>
                <a data-id="<?= $item->purchase_id.'/'.$item->sup_id; ?>" class="add_qutations"><span class="badge badge-primary"><i class="fas fa-check"></i></span></a>
                      <?php } else { ?>
                     <?php   $quotations; ?>
              <a data-id="<?= $item->purchase_id.'/'.$item->sup_id; ?>" class="add_qutations disabled"><span class="badge badge-danger"><i class="fas fa-check"></i></span></a>
              <!-- echo "qutation is completed"; -->
                      <?php } ?>
          <a href="<?= base_url('Purchase/order_detail/'.$item->purchase_id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
          </td>
          </tr>
          <?php } ?>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
            </tbody>  
            <!-- code to show alert -->
<!-- <?php $quotations = $this->admin_model->count_qutation($item->purchase_id); 
   if($quotations == 3) { ?>
   <h3 style="color: red;">
     Qutation range is completed
     <?php } ?> -->
   </h3>
        <?php endif; ?>
        </table>
     
      </div>
    </div> 
</div>
 
 <!-- add qutation model start below-->
<div class="modal fade" id="add_qutations" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Add Qutations</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body edit-modal-body mx-3">
    <form action="<?= base_url('Purchase/add_qutation'); ?>" method="post"> 
    <input type="hidden" name="purchase_id" id="purchase_id" value="">

          <div class="md-form mb-5">
            <input type="text" name="price" id="orangeForm-name" class="form-control validate">
            <label data-error="wrong" data-success="right" for="orangeForm-name">&nbsp price</label>
          </div>
          <div class="md-form mb-5">
            <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
            <label data-error="wrong" data-success="right" for="orangeForm-name" class="">&nbsp Quotation . . .</label>
          </div>
          <div class="md-form">
            <button type="submit" class="btn btn-deep-purple">Save Changes</button>
            <button type="reset" class="btn btn-orange">Reset</button>
          </div>
      </div>
      </form> 
      <div class="modal-footer d-flex justify-content-right">
        <button class="btn btn-unique" data-dismiss="modal" aria-label="Close">Close <i class="fas fa-paper-plane-o ml-1"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- add qutation model end -->

<script>
// code to add qutations
$(document).ready(function(){
  $('.add_qutations').click(function(){  
    var po_id = $(this).data('id'); 
  $('#purchase_id').val(po_id); 
  $('#add_qutations').modal('show'); 
  });
});
// code to show range completion message
$(document).ready(function(){ 
  var a = $('#qutation').val(); 
  // alert(a);
});
</script>