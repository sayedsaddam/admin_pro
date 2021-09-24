 
<!-- -----------------------------------item card start----------------------------- -->
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <!-- Card -->
                    <div class="card">
                    <!-- Card content -->
                    <div class="card-body">
                    <h1 class="font-weight-bold text-center mb-0">AH Group of Companies (Pvt.) Ltd.</h1>
                    <h2 class="font-weight-light text-center mb-0">Islamabad, 44000</h2>
                    <h3 class="font-weight-lighter text-center mb-5">Purchase Order Record</h3>
                    <hr class="mb-5"> 
                    <?php if(!empty($items)): ?>

                    <div class="row">
                    <div class="col-md-6">
                    <p>Location</p>
                    </div>
                    <div class="col-md-6">
                    <p><?=$items[0]->loc_name;?></p>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <p>Supplier</p>
                    </div>
                    <div class="col-md-6">
                    <p>       <?php echo $items[0]->sup_name; ?>   </p>
                    </div>
                    </div>  
                    <div class="row">
                    <div class="col-md-6">
                    <p>Product</p>
                    </div>
                    <div class="col-md-6">
                    <p><?= ucfirst($items[0]->sub_name); ?></p>
                    </div>
                    </div>  
                <div class="row">
                <div class="col-md-6">
                    <p>Order Number</p>
                    </div>
                    <div class="col-md-6"> 
                    <p> <?= $items[0]->order_number;?> </p>
                </div>
                </div>
            
            <div class="row">
            <div class="col-md-6">
            <p>Date</p>
            </div>
            <div class="col-md-6"><p> 
                     <?= date('M d, Y', strtotime($items[0]->po_date)); ?> 
            </p>
            </div>
            </div>
            <?php else : ?> 

          <div class="row">
              <div class="col-md-6">
              <p>Location</p>
              </div>
              <div class="col-md-6">
              <p><?=$item->name;?></p>
              </div>
              </div>

              <div class="row">
              <div class="col-md-6">
              <p>Category</p>
              </div>
              <div class="col-md-6">
              <p><?=$item->cat_name;?></p>
              </div>
              </div> 

              <div class="row">
              <div class="col-md-6">
              <p>Sub Category</p>
              </div>
              <div class="col-md-6">
              <p><?php if(!empty($item->sub_name)){ echo ucfirst($item->sub_name);} else{echo "- - - -";} ?></p>
              </div>
              </div>

      <div class="row">
      <div class="col-md-6">
      <p>Type</p>
      </div>
      <div class="col-md-6">
      <p>      <?=$item->type_name."(".$item->quantity.")";?>    </p>
      </div>
      </div>    
      <?php endif; ?>
____________________________________________________________________________________________________________________________________________________
<?php if(!empty($items[0]->po_id)) : ?>
<?php  $pos_id = $this->uri->segment(3);  if($items[0]->po_id == $pos_id) : ?>    
  <?php endif; ?>           
<table class="table table-sm">
                <tr>
                <thead> 
                <th>Serial : </th>
                <th>Product </th>
                <th>Requested By </th>
                <th>Supplier</th>
                <th>price</th>
                <th>Quotation</th>
                <th>Remarks</th>
                <th>Date</th>  
                <th>Status</th>  
                <th>Action</th>  
                </thead>
                </tr>
        <tr>
                <?php $id = 1; ?>
                <?php if(!empty($items)): $lowest_price = array_column($items, 'price'); foreach($items as $item): ?>
                <tr class="<?php if(min($lowest_price) == $item->price){ echo 'table-success text-dark'; } ?>"> 
                <span>
                    <td>
                        <?php echo $id++; ?>
                    </td> 
                        <td>
                        <?= ucfirst($item->sub_name)?></span> </td>  
                        <td> <?= ucfirst($item->fname)?></span> </td>  
                       <td> 
                        <?= ucfirst($item->sup_name)?></span> </td>  
                          <td> 
                        <?= number_format($item->price)?></span> </td>  
                        <td>   
                        <?= ucfirst($item->description)?></span> </td>   
                        <td>   
                        <?= ucfirst($item->remarks)?></span> 
                      </td>  
                        <td> 
                         <?= date('M d, Y', strtotime($items[0]->po_date)); ?> </span> 
                        </td> 
                      <?php if($item->qut_status != 'rejected') { ?>  
                      <?php if($item->qut_status == 0) { ?> 
                        <td > <span class="badge badge-secondary waves-effect waves-light">pending</span></td> 
                      <?php } else { ?> 
                       <td> <span class="badge badge-success">Aproved</span></td> 
                      <?php } ?> 

                     <?php } else { ?> 
                      <td> <span class="badge badge-danger">Rejected</span></td> 
                      <?php } ?>  
<?php  
if(!$this->session->userdata('user_role') == 'admin'){ ?>
                     <?php if($item->price >= 1000000) { ?> 
                      <td>  
                      <span class="badge badge-warning waves-effect waves-light ">budget is too high</span>
                     </td>  
                     <?php } elseif($count_reult == 1) { ?> 
                      <td></td>
                      <?php } else{ ?>                      
                      <td>
                      <a data-id="<?= $item->qut_id.'/'.$item->purchase_id; ?>" class="return_item"><span class="badge badge-success"><i class="fa fa-check"></i></span></a>
                     </td>
                     <?php } ?> <!--/first if end for user role -->
               <?php } else { ?> 
              <?php if($count_reult == 1) { ?> 
                      <td></td>
                      <?php } else{ ?>                      
                      <td>
                      <a data-id="<?= $item->qut_id.'/'.$item->purchase_id; ?>" class="return_item"><span class="badge badge-success"><i class="fa fa-check"></i></span></a>
                     </td>
                     <?php } ?>
                     <?php } ?>
                </strong> 
                </span>  
                </tr>
                    <?php endforeach;  ?>
  
                        </table>  
      <?php 
      endif; 
      ?>    
                    <div class="row mt-3">
                    <!-- <a href="<?= base_url('admin/item_detail/'.$item->id); ?>"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>&nbsp
                      <a href="<?= base_url('admin/assign_item_list/'.$item->id); ?>"><span class="badge badge-info"><i class="fa fa-check"></i></span></a>&nbsp
                      <a href="<?=base_url('admin/delete_item/'.$item->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a> -->
                  </div> 

<?php 
 endif; 
?> <br>
    <!-- Button -->
    <?php if($count < 3) { ?>
    <a data-toggle="modal" data-target="#add_qutation" class="btn btn-outline-info"><i class="fa fa-plus"></i> Add New</a>
   <?php } else { ?>
    <h3 class="text-danger">Quotation range is completed</h3>
    <a data-toggle="modal" data-target="#add_qutation" class="btn btn-outline-danger disabled"><i class="fa fa-plus"></i> Add New</a>

    <?php } ?>
    <a href="#" class="btn btn-primary d-print-none" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
    <a href="<?= base_url('admin/purchase_order_list'); ?>" class="btn btn-outline-danger d-print-none"><i class="fa fa-angle-left"></i> back</a>
     
</div> 
            </div>
            <!-- Card -->
        </div>
    </div>
</div> 
<!-- Modal to add qutation -->
<div class="modal fade" id="add_qutation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Add Quotation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?= base_url('admin/add_qutation'); ?>" method="post">

<input type="hidden" name="requested_by" value="<?=$items[0]->requested_by;?>" >
<input type="hidden" name="supplier_id" value="<?=$items[0]->supplier_id;?>" >
<input type="hidden" name="purchase_id" value="<?=$items[0]->purchase_id;?>" >

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
      <div class="modal-footer d-flex justify-content-left">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  <!-- Modal for approved qutation -->
  <div class="modal fade" id="item_return" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title w-100 font-weight-bold">Approve Quotation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
          <form action="<?= base_url('admin/approved_order'); ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" id="item_id" value=""> 

                  <div class="md-form mb-5">
                    <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control"></textarea> 
                  <label data-error="wrong" data-success="right" for="orangeForm-name">Approvel Remarks</label>
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


<!-- ----------------------------------------item card end ----------------------------------- -->

        <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });

        
  $(document).ready(function(){
    $('.return_item').click(function(){  
      var item_id = $(this).data('id');  
      // AJAX request
      
          $('#item_id').val(item_id); 
          $('#item_return').modal('show'); 
      
    });
  });
        </script>