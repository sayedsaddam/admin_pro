
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
                <!-- <th class="font-weight-bold">Supplier</th>  -->
                <th class="font-weight-bold">Location</th>
                <!-- <th class="font-weight-bold">Category</th> -->
                <th class="font-weight-bold">Product</th>   
                <th class="font-weight-bold">Quantity</th>   
                <th class="font-weight-bold"> Date</th> 
                <th class="font-weight-bold"> Quotation</th> 
                <th class="font-weight-bold">Status</th> 
                <th class="font-weight-bold">Action</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody id="myTable">
              <?php if(!empty($items)): foreach($items as $item): ?>
                <tr>
                  <td><?= 'CTC-0'.$item->purchase_id; ?></td>
                  <!-- <td><?= $item->sup_name.', <a href="mailto:'.$item->email.'">'.$item->email.'</a>'; ?></td> -->
                  <td><?= ucfirst('<span id="location">'.$item->loc_name.'</span>'); ?></td>
                  <!-- <td><?= ucfirst($item->cat_name); ?></td> -->
                   <td><a href="<?= base_url('Purchase/pos/'.$item->purchase_id); ?>"><span style="color:cadetblue"><?= ucfirst($item->sub_name); ?></span></a></td>     
                   <td><?= ucfirst($item->quantity); ?></td>     
                   <td> <?= date('M d, Y', strtotime($item->created_at)); ?> </td>
                   <?php $quotations = $this->admin_model->count_qutation($item->purchase_id); ?>
                   <td><?= $quotations; ?></td>
                  <?php if($item->status == 0) { ?>
                   <td ><span class="badge badge-danger">Pending</span></td> 
                   <?php } elseif($item->status == 1 ){ ?>
                   <td><span class="badge badge-warning">Process <span></td> 
                  <?php } else{ ?>
                    <td><span class="badge badge-success">Approved <span></td> 
                    <?php } ?>
                  <td>
      
      <?php $quotations = $this->purchase_model->count_po($item->purchase_id); $review = $item->review;  ?>  

    <!--manger order review approved or reject  -->
      <?php if($review == null && $quotations == 0){?>
    <a href="<?= base_url('Purchase/approved_po/'.$item->purchase_id); ?>" class=""><span class="badge badge-success"><i class="fa fa-check"></i></span></a>
    <a href="<?= base_url('Purchase/cancel_order/'.$item->purchase_id); ?>" class=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
    <?php } elseif($quotations <= 2 && $review == 1) {?>
        <a data-id="<?= $item->purchase_id.'/'.$item->loc_id; ?>" class="suppliers"><span class="badge badge-primary"><i class="fas fa-door-open"></i></span></a>
    <?php } else { ?>
        <a data-id="<?= $item->purchase_id; ?>" class="suppliers disabled"><span class="badge badge-danger" ><i class="fas fa-door-open"></i></span></a>
    <?php } ?>

                  <a href="<?= base_url('Purchase/order_detail/'.$item->purchase_id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
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
                  <td><?php if($item->status == 0) { ?></td>
                   <td ><span class="badge badge-danger">Pending</span></td> 
                   <?php } elseif($item->status == 1 ){ ?>
                   <td><span class="badge badge-warning">Process <span></td> 
                  <?php } else{ ?>
                    <td><span class="badge badge-success">Approved <span></td> 
                    <?php } ?>
                  <td>
                  <!-- <a href="<?= base_url('admin/edit_order/'.$item->purchase_id); ?>"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a> <a href="<?= base_url('admin/view_order/'.$item->purchase_id); ?>"><span class="badge badge-info"><i class="fa fa-check"></i></span></a> -->
                  <a href="<?= base_url('Purchase/order_detail/'.$item->purchase_id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                  <a href="<?= base_url('Purchase/cancel_order/'.$item->purchase_id); ?>" class=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
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
<!-- vendor model to send order -->
<div class="modal fade" id="po_supplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Po Order Forward</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body edit-modal-body mx-3">
        <form action="<?=base_url('Purchase/po_supplier_order');?>" method="post" class="md-form">
          <input type="hidden" name="purchaseid" id="purchaseid" value=""> 
          <div class="md-form mb-5">  
            <select name="location" id="supplier_location" class="browser-default custom-select">
               <?php if(!empty($locations)): foreach($locations as $loc): ?>
                <option value="<?= $loc->id ?>"><?= ucfirst($loc->name); ?> </option> 
              <?php endforeach; endif; ?>  
            </select>
          </div>
<!-- email is hidden for sending email to supplier -->
          <select name="supplier" id="supplier_email" class="browser-default custom-select" style="display: none;"> 
          </select>
          <div class="md-form mb-5">
            <select name="supplier" id="supplier" class="browser-default custom-select">
              <option value="" disabled selected>--Select Supplier--</option>
            </select>
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
<!-- vendor model end -->
<script> 
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
}); 

// code top open vendor send to apply
$(document).ready(function(){
  $('.suppliers').click(function(){  
    var val = $(this).data('id').split('/');
    var po_id = val[0];
    var loc_id = val[1];
    $("#supplier_location").val(loc_id); 
    // AJAX request
    $.ajax({
    url: '<?= base_url('Purchase/po_supplier/'); ?>' + po_id,
    method: 'POST',
    dataType: 'JSON',
    data: {po_id: po_id},
      success: function(response){ 
        console.log(response); 
        $('#purchaseid').val(response.id);  
        $('#location').val(response.location_id);
        $('#supplier').val(response.supplier);
        $('#product').val(response.sub_category_id);  
        $('#quantity').val(response.quantity);
        $('#remarks').val(response.description);  
        // $('.edit-modal-body').html(response);
        // Display Modal
        $('#po_supplier').modal('show'); 
      }
    });
  });
});

// load supplier against location
$(document).ready(function(){
 // City change
 $('#supplier_location').on('click', function(){
   var location = $(this).val();  
   // AJAX request
   $.ajax({
     url:'<?=base_url('Purchase/supplier_against_location/')?>' + location,
     method: 'post',
     data: {location: location},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#supplier').find('option').not(':first').remove();
       $('#supplier_email').find('option').not(':first').remove();
       // Add options
       $.each(response,function(index, data){
        $('#supplier').append('<option value="'+data['id']+'">'+data['name']+'</option>'); 
        $('#supplier_email').append('<option value="'+data['id']+'">'+data['email']+'</option>'); 
       });
     }
  });
});
});
</script>