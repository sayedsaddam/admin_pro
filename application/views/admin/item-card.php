 
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
                    <h3 class="font-weight-lighter text-center mb-5">Item Record</h3>
                    <hr class="mb-5"> 
                    <?php if(!empty($items)): ?>

                    <div class="row">
                    <div class="col-md-6">
                    <p>Location</p>
                    </div>
                    <div class="col-md-6">
                    <p><?=$items[0]->name;?></p>
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
            <p>Type</p>
            </div>
            <div class="col-md-6">
            <p>      <?=$items[0]->type_name."(".$items[0]->quantity.")";?>    </p>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <p>Imei Number</p>
            </div>
            <div class="col-md-6">
            <p>      <?=ucfirst($items[0]->serial_number);?>    </p>
            </div>
            </div>

            <div class="row">
            <div class="col-md-6">
            <p>Model</p>
            </div>
            <div class="col-md-6">
            <p>     <?=$items[0]->model;?>   </p>
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
            <p>Price</p>
            </div>
            <div class="col-md-6">
            <!-- <p>      <?= number_format($items[0]->price);?>    </p> -->
            <p>      <?= $items[0]->price;?>    </p>
            </div>
            </div>

            <div class="row">
            <div class="col-md-6">
            <p>Depreciation</p>
            </div>
            <div class="col-md-6">
            <p>       <?php echo $items[0]->depreciation . " (%)"; ?>   </p>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <p>Current Value</p>
            </div>
            <div class="col-md-6"><p>
                     <?php if($items[0]->depreciation > 0){ 
                     $depreciation = ($items[0]->price*$items[0]->depreciation / 100) ; 
                    //  echo number_format(floatval($items[0]->price - $depreciation));
                     echo $items[0]->price - $depreciation;
                    
                    }
                     ?>
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
                     
                    <?php if(!empty($items)): foreach($items as $item): ?>
                        <!-- below some php code writen for available data which is not assign to someone -->
                        <?php if(empty($item->assign_date)){
                        ?><div class="col-sm-12 text-center"> <strong>Availabe Still Not Assignd</strong> </div>
                        <?php 
                        }
                        else{
                    ?>        
            <div class="row">
            <div class="col-sm-12 text-center">
            <label>Assigned to </label>
                    <?php $returned_date = $item->return_back_date;
                        $returned_date = ($returned_date) ? date('M d, Y', strtotime($item->return_back_date)) : ' Still In custody';
                    ?>
           <span>
                    <?= ucfirst($item->supplier)?> <?php 
                        if(!empty($item->assign_date))
                        {echo "  on  : <strong>".date('M d, Y', strtotime($item->assign_date)).'</strong>';} 
                        else{
                        echo "<span'> - - - - - </span>";}
                    ?>
                    <?php
                        if(!empty($item->return_back_date))
                        {echo " Return back on  : <strong>".date('M d, Y', strtotime($item->return_back_date)).'</strong>';} 
                        else{
                        echo "<span style='font-weight:bold'> Still In custody </span>";}
                    ?>
                </span>
                </div>
                </div>
<?php } ?>


                    <?php endforeach;  ?>
     
                    
                    <div class="row mt-3">
                    <a href="<?= base_url('admin/item_detail/'.$item->id); ?>"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>&nbsp
                      <a href="<?= base_url('admin/assign_item_list/'.$item->id); ?>"><span class="badge badge-info"><i class="fa fa-check"></i></span></a>&nbsp
                      <a href="<?=base_url('admin/delete_item/'.$item->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                  </div> 

<?php 
 endif;
?>
                    <div class="row mb-1">
                        <div class="col-md-12 text-right">
                            <p>Printed by: <?= $this->session->userdata('fullname'); ?><br>************************</p>
                        </div>
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