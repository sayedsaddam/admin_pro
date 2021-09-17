 
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
                    <p>Category</p>
                    </div>
                    <div class="col-md-6">
                    <p><?=$items[0]->cat_name;?></p>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                    <p>Sub Category</p>
                    </div>
                    <div class="col-md-6">
                    <p><?= ucfirst($items[0]->names); ?></p>
                    </div>
                    </div>  
                <div class="row">
                <div class="col-md-6">
                    <p>Order Number</p>
                    </div>
                    <div class="col-md-6"> 
                    <p>      <?= $items[0]->order_number;?>    </p>
                </div>
                </div>
            <div class="row">
            <div class="col-md-6">
            <p>Purchase Date</p>
            </div>
            <div class="col-md-6">
            <p>      <?= date('M d, Y', strtotime($items[0]->purchasedate)); ?>     </p>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <p>Order Date</p>
            </div>
            <div class="col-md-6"><p> 
                     <?= date('M d, Y', strtotime($items[0]->order_date)); ?> 
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
                    <p><?= ucfirst($item->names); ?></p>
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
            <div class="row">
            <div class="col-md-6">
            <p>Imei Number</p>
            </div>
            <div class="col-md-6">
            <p>      <?=ucfirst($item->serial_number);?>    </p>
            </div>
            </div>

            <div class="row">
            <div class="col-md-6">
            <p>Model</p>
            </div>
            <div class="col-md-6">
            <p>     <?=$item->model;?>   </p>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <p>Purchase Date</p>
            </div>
            <div class="col-md-6">
            <p>      <?= date('M d, Y', strtotime($item->purchasedate)); ?>     </p>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <p>Price</p>
            </div>
            <div class="col-md-6">
            <!-- <p>      <?= number_format($item->price);?>    </p> -->
            <p>      <?= $item->price;?>    </p>
            </div>
            </div>

            <div class="row">
            <div class="col-md-6">
            <p>Depreciation</p>
            </div>
            <div class="col-md-6">
            <p>       <?php echo $item->depreciation . " (%)"; ?>   </p>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <p>Current Value</p>
            </div>
            <div class="col-md-6"><p>
                     <?php  
                     error_reporting(0);
                     if($item->depreciation > 0){ 
                     $depreciation = ($item->price*$item->depreciation / 100) ; 
                    //  echo number_format(floatval($items[0]->price - $depreciation));
                     echo $item->price - $depreciation;
                    
                    }
                     ?>
            </p>
            </div>
            </div>
            <span style='color: red;font-weight: bold'>This item still not assign to any emplye </span> 
                

            <?php endif; ?>
____________________________________________________________________________________________________________________________________________________
                <table class="table table-sm">
                <tr>
                <thead> 
                <th>Serial : </th>
                <th>product type </th>
                <th>Model </th>
                <th>Serial Number</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Amount</th>
                <th>Shipping</th>
                <th>Discount</th>
                <th>Grand Total</th> 
                </thead>
                </tr>
        <tr>
                        <?php $id = 1; ?>
                <?php if(!empty($items)): foreach($items as $item): ?>
                   
                <tr>
                <!-- below code is used to show multiple record against single order number -->
                        <?php if(empty($item->purchase_id)){
                        ?>
                        <!-- <div class="col-sm-12 text-center"> <strong>Order in Progress</strong> </div> -->
                        <?php 
                }
                else{
                ?>     
                        <?php //$returned_date = $item->purchase_id;
                        // $returned_date = ($returned_date) ? date('M d, Y', strtotime($item->purchase_id)) : ' Still In custody';
                ?> 
                <span>
                    <td>
                        <?php echo $id++; ?>
                    </td> 
                        <td>
                        <span style="color: brown;font-weight: bold"> <?= ucfirst($item->item_type)?></span> </td>  
                        <td>
                        <span style="color: brown;font-weight: bold"> <?= ucfirst($item->model)?></span> </td>  
                        <td> 
                        <span style="color: brown;font-weight: bold"> <?= ucfirst($item->serial_number)?></span> </td>  
                        <td> 
                        <span style="color: brown;font-weight: bold"> <?= ucfirst($item->quantity)?></span> </td>  
                        <td> 
                        <span style="color: brown;font-weight: bold"> <?= ucfirst($item->unit_price)?></span> </td>  
                        <td> 
                        <span style="color: brown;font-weight: bold"> <?= ucfirst($item->amount)?></span> </td>  
                        <td> 
                        <span style="color: brown;font-weight: bold"> <?= ucfirst($item->shipping)?></span> </td>  
                        <td> 
                        <span style="color: brown;font-weight: bold"> <?= ucfirst($item->discount)?></span> </td>  
                        <td>  
                        <span style="color: brown;font-weight: bold"> <?= ucfirst($item->grand_total)?></span> </td>  
              
                
                </strong> 
                </span> 
                <?php } ?>
                </tr>


                    <?php endforeach;  ?>
                        </table>     
                    
                    <div class="row mt-3">
                    <!-- <a href="<?= base_url('admin/item_detail/'.$item->id); ?>"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>&nbsp
                      <a href="<?= base_url('admin/assign_item_list/'.$item->id); ?>"><span class="badge badge-info"><i class="fa fa-check"></i></span></a>&nbsp
                      <a href="<?=base_url('admin/delete_item/'.$item->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a> -->
                  </div> 

<?php 
 endif;
?>
                    <div class="row mb-1">
                        <!-- <div class="col-md-12 text-right">
                            <p>Printed by: <?= $this->session->userdata('fullname'); ?><br>************************</p>
                        </div> -->
                    </div>
                    <br><br><br><br><br>
                    <!-- Button -->
                    <a href="#" class="btn btn-primary d-print-none" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
                    <a href="javascript:history.go(-1)" class="btn btn-outline-danger d-print-none"><i class="fa fa-angle-left"></i> back</a>
                </div>

            </div>
            <!-- Card -->
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
        </script>