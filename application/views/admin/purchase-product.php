<?php 
/*
* Filename: add_items.php
* Author: Saddam
*/
?>
<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light" style="">
  <div class="container-fluid">
    <div class="row">
     <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid">
      </div>
      <div class="col-lg-7 col-md-7">
        <h2 class="display-4 font-weight-bold mb-0">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-dark">AH Group of Companies (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in...">
          <?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Asset Detail | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12 text-right">   
        <a href="<?= base_url('admin/suppliers'); ?>" data-target="#add_supplier" class="btn btn-outline-info"><i class="fa fa-plus"></i> Add Supplier </a>
            <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
          </div>

<section class="secMainWidth container mt-4 mb-4">
  <section class="secFormLayout">
    <div class="mainInputBg">
      <div class="row">
        <div class="col-lg-12">
          <h3><?php if(empty($edit)){ echo "Purchase Product"; }else{ echo "Update purchase"; } ?></h3><hr>
          <?php if($success = $this->session->flashdata('success')): ?>
            <div class="alert alert-success text-center">
              <?php echo $success; ?>
            </div>
          <?php endif; ?>
          <form action="<?php if(empty($edit)){ echo base_url('admin/purchase_order_save'); }else{ echo base_url('admin/modify_purchase_order'); } ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
            <div class="row">
              <div class="col-lg-6">    

            <select name="location" id="location" class="browser-default custom-select" required>
            <option value="" disabled selected>--select Location--</option>
              <?php if(!empty($locations)): foreach($locations as $loc): ?>
                <option value="<?= $loc->id; ?>" <?php if(!empty($edit) && $edit->location_id == $loc->id){ echo 'selected'; } ?>><?= $loc->name; ?></option>
              <?php endforeach; endif; ?>
            </select>  
            <br><br>
            <select name="category" id="category" class="browser-default custom-select">
              <option value="" disabled selected>--select category--</option>
              <?php if(!empty($categories)): foreach($categories as $cat): ?>
                <option value="<?= $cat->id; ?>" <?php if(!empty($edit) && $edit->purchase_id == $cat->id){ echo 'selected'; } ?>><?= $cat->cat_name; ?></option>
              <?php endforeach; endif; ?>
            </select>  
                
            <label>Order Number</label>
                <input type="text" name="order_number" class="form-control" placeholder="order number ...s" value="<?php if(!empty($edit)){ echo $edit->order_number; } ?>"> 
                
                <label>Purchase Date</label>
                <input type="date" name="purchasedate" class="form-control" placeholder="purchase_date" value="<?php if(!empty($edit)){ echo $edit->purchasedate; } ?>">  
              </div>
              <div class="col-lg-6">   
            <select name="supplier" id="supplier" class="browser-default custom-select">
              <option value="" disabled selected>--select Suplier--</option>
              <?php if(!empty($supplier)): foreach($supplier as $sup): ?>
                <option value="<?= $sup->id; ?>" <?php if(!empty($edit) && $edit->supplier_id == $sup->id){ echo 'selected'; } ?>><?= $sup->name; ?></option>
              <?php endforeach; endif; ?>
            </select> 
                <!-- <label>Type Name</label>  
                <input type="text" name="type_name" class="form-control" required placeholder="plz enter type...">
                 -->     
            <label for="">Sub Category <small>(optional)</small></label>
             <select name="sub_category" id="item_name" class="browser-default custom-select">
             <option value="" disabled selected>--select sub category--</option>
             </select> 

             <label for="">Order Date </label>
            <input Type="date" name="order_date" id="order_date" value="<?php if(!empty($edit)){ echo $edit->order_date; } ?>" class="form-control">
 
              
              </div>
            </div><br>
            --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            <div class="row">
<div class="col-sm-12" >
<!-- item roew start --> 
              <div id="saman-row">
              <table class="table-responsive tfr my_stripe">
   <thead>
        <tr class="item_header">
              <th class="">Item Type</th>
              <th class="">Model</th>
              <th class="">Serial Number</th>
              <th id="qntyName" >Quantity</th>
              <th  >Price/unit</th>
              <th style="display: none;">Tax(%)</th> 
              <th style="display: none;">Discount</th>
              <th> Amount (PKR)</th>
              <th  class="text-center"><?php echo $this->lang->line('Action') ?></th>
       </tr>
    </thead>
    <tbody>
         <tr>
              <td><input type="text" class="form-control" name="product_name"
              placeholder="Enter Product name" value="<?php if(!empty($edit)){ echo $edit->item_type; } ?>" id='productname-0'>
              <input type="hidden" name="product_id" id="product_id-0">
              </td>
              <td>
              <input type="text" class="form-control req" name="model" id="model-0"
              onkeypress=""  placeholder="Enter model" value="<?php if(!empty($edit)){ echo $edit->model; } ?>" onkeyup="rowTotal('0'), billUpyog()"
              autocomplete="off" value=""> 
              </td>
              <td>
              <input type="text" class="form-control req" name="serial_number" id="serial_number-0"
              onkeypress="" placeholder="Enter Serial number" value="<?php if(!empty($edit)){ echo $edit->serial_number; } ?>" onkeyup="rowTotal('0'), billUpyog()"
              autocomplete="off" value="">
            </td>
              <td>
              <input type="text" class="form-control req amnt" name="product_qty" value="<?php if(!empty($edit)){ echo $edit->quantity; } ?>" id="quantity-0" onkeyup="getNewVal()"
              autocomplete="off" value="">
            </td>
            <td><input type="text" class="form-control req prc" name="product_price" value="<?php if(!empty($edit)){ echo $edit->unit_price; } ?>" id="price" onkeyup="getNewVal()"
              autocomplete="off"></td>
            <td style="display: none;"><input type="text" class="form-control vat " name="product_tax" id="vat-0"
              autocomplete="off"></td>
              <td style="display: none;" class="text-center" id="texttaxa-0">0</td>
              <td style="display: none;"><input type="text" class="form-control discount" name="product_discount" id="discount-0" autocomplete="off"></td>
              <td colspan="8" ><span class="currenty">
                </span>
              <strong><input type="text" class="form-control" name="total_val" id="total_val"
              autocomplete="off"value="<?php if(!empty($edit)){ echo $edit->amount; } ?>"></strong></td>
              <td class="text-center"> 
              </td>
              <input type="hidden" name="taxa[]" id="taxa-0" value="0">
              <input type="hidden" name="disca[]" id="disca-0" value="0">
              <input type="hidden" class="ttInput" name="product_subtotal[]" id="total-0" value="0">
              <input type="hidden" class="pdIn" name="pid[]" id="pid-0" value="0">
              </tr> <tr><td colspan="9"><textarea id="dpid-0" class="form-control" name="product_description[]" placeholder="<?php echo $this->lang->line('Enter Product description'); ?>" autocomplete="off"></textarea><br></td></tr>

              <tr class="last-item-row">
              <td class="add-row">
              <!-- <button type="button" class="btn btn-success" aria-label="Left Align" data-toggle="tooltip"
              data-placement="top" title="Add product row" id="addproduct">
              <i class="icon-plus-square"></i>Add Row</button> -->
              </td>
              <td colspan="7"></td>
              </tr>  
              <tr class="sub_c" style="display: table-row;">
              <td colspan="6" align="right">
              <strong>Shipping</strong></td>
              <td align="left" colspan="2">
                <input type="text" class="form-control shipVal" onkeyup="getNewVal()" id="shipVal" placeholder="Value" name="shipping" autocomplete="off" value="<?php if(!empty($edit)){ echo $edit->shipping; } ?>"></td>
              </tr> 
              <tr class="sub_c" style="display: table-row;">
              <td colspan="6" align="right">
              <strong>Discount</strong></td>
              <td align="left" colspan="2">
              <input id="discountTotal" type="text" onkeyup="getNewVal()" class="form-control" placeholder="Value"  name="discountTotal" autocomplete="off" value="<?php if(!empty($edit)){ echo $edit->discount; } ?>">
              </td>
              </tr>
              <tr class="sub_c" style="display: table-row;">
              <td colspan="6" align="right">
                <strong>Grand Total (PKR)</strong>
              </td>
              <td align="left" colspan="2"><input type="text" name="total" value="<?php if(!empty($edit)){ echo $edit->grand_total; } ?>" class="form-control"
              id="grandtotal" readonly="">

              </td>
              </tr>
              <tr class="sub_c" style="display: table-row;">
              <td colspan="2"><?php echo $this->lang->line('Payment Terms') ?> <select name="pterms"
                                            class="selectpicker form-control"><?php foreach ($terms as $row) {
              echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
              } ?>

              </select></td>
              <td colspan="2">
              <div>
              <label><?php echo $this->lang->line('Update Stock') ?></label>
              <div class="input-group">
              <label class="display-inline-block custom-control custom-radio ml-1">
              <input type="radio" name="update_stock" class="custom-control-input"
              value="yes" checked="">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description ml-0"><?php echo $this->lang->line('Yes') ?></span>
              </label>
              <label class="display-inline-block custom-control custom-radio">
              <input type="radio" name="update_stock" class="custom-control-input"
              value="no">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description ml-0"><?php echo $this->lang->line('No') ?></span>
              </label>
              </div>
              </div>
              </td>
              <td align="right" colspan="4">
              <a href="javascript:history.go(-1);" class="btn btn-danger">Back</a>
                <?php if(empty($edit)): ?>
                  <button type="submit" class="btn btn-default" id="submit-data" data-loading-text="Creating...">Generate Order</button>
                <?php else: ?>
                  <button type="submit" class="btn btn-default">Save Changes</button>
                <?php endif; ?>  
              </td>
    </tr> 
    </tbody>
    </table>
    </div>
<!-- item row end here -->
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>  
    </div>
  </section>
</section>
<script>

// item type auto load against item
$(document).ready(function(){

 // City change
 $('#category').on('change', function(){
   var category = $(this).val();  
   // AJAX request
   $.ajax({
     url:'<?=base_url('admin/get_item_sub_categories/')?>' + category,
     method: 'post',
     data: {category: category},
     dataType: 'json',
     success: function(response){
      console.log(response);
       // Remove options 
       $('#item_name').find('option').not(':first').remove();

       // Add options
       $.each(response,function(index, data){
        $('#item_name').append('<option value="'+data['id']+'">'+data['name']+'</option>'); 
       });
     }
  });
});
});

 


// code for calculation start
$(document).ready(function(){

});
// code for calculation end
// add row code below

function getNewVal()
{
 var price = $('.prc').val();
 var quantity = $('.amnt').val();
 var totals = (quantity*price); 
 var total_val = totals; 
 $('#total_val').val(total_val); 
 var shipping = $('#shipVal').val();

          if (shipping !== undefined || !isNaN(shipping)) {
          $('#shipval').val(0); 
          } 
 var total_shipment = parseInt(totals) + parseInt(shipping); 
 var result = total_shipment;
 var grand = $('#grandtotal').val(result); 
          if (grand !== undefined || !isNaN(grand)) 
          {
          $('#total_val').val(total_val); 
          }

var discount = $('#discountTotal').val();

if (discount !== undefined || !isNaN(discount)) {
$('#discount').val(0); 
} 
var total_discount = parseInt($('#grandtotal').val()) - parseInt(discount); 

var result = total_discount;
var grand = $('#grandtotal').val(result); 
if (grand == '') 
{
$('#grandtotal').val(total_val); 
}


}
function getNewValShiping()
{
//  var shipping = $('#shipVal') .val();  
//   var total_val = $('#total_val').val();  
//   alert(total_val) 
//  var totals = parseInt(total_val) + parseInt(shipping);  
//  var total_val = totals; 
//   $('#total_val').val(total_val); 
//   $('#grandtotal').val(total_val); 
}
 
$(document).ready(function(){
		$('#add_row').click(function(){
			var tr = $('#item-clone tr').clone()
			$('#item-list tbody').append(tr)
			_autocomplete(tr)
			tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress',function(e){
				calculate()
			})
			$('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress',function(e){
				calculate()
			})
		})
		if($('#item-list .po-item').length > 0){
			$('#item-list .po-item').each(function(){
				var tr = $(this)
				_autocomplete(tr)
				tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress',function(e){
					calculate()
				})
				$('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress',function(e){
					calculate()
				})
				tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('keypress')
			})
		}else{
		$('#add_row').trigger('click')
		}
        $('.select2').select2({placeholder:"Please Select here",width:"relative"})
		$('#po-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			$('.err-msg').remove();
			$('[name="po_no"]').removeClass('border-danger')
			if($('#item-list .po-item').length <= 0){
				alert_toast(" Please add atleast 1 item on the list.",'warning')
				return false;
			}
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_po",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = "./?page=purchase_orders/view_po&id="+resp.id;
					}else if((resp.status == 'failed' || resp.status == 'po_failed') && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: 0 }, "fast");
                            end_loader()
							if(resp.status == 'po_failed'){
								$('[name="po_no"]').addClass('border-danger').focus()
							}
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

        
	})

</script>