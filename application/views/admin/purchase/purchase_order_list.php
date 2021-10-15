<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" style="background-color:#fafafa;">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section">
				<div class="columns is-hidden-touch">
					<div class="column is-hidden-print">
						<form action="<?= base_url('Purchase/search_purchase_item'); ?>" method="GET">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" type="search"
										placeholder="Search Query">
									<span class="icon is-small is-left">
										<i class="fas fa-search"></i>
									</span>
								</div>
								<div class="control">
									<button class="button is-small" type="submit"><span class="icon is-small">
											<i class="fas fa-arrow-right"></i>
										</span>
									</button>
								</div>
							</div>
						</form>
					</div>
					<div class="column is-hidden-print">
						<div class="field has-addons">
							<p class="control">
								<button class="button is-small <?= (isset($product_report)) ? 'has-background-primary-light' : '' ?>" id="report-btn">
									<span class="icon is-small">
										<i class="fas fa-paperclip"></i>
									</span>
									<span>Report</span>
								</button>
							</p>   
							<p class="control">
								<button onclick="location.href='<?= base_url('Purchase/purchase_product'); ?>'"
									class="button is-small <?= (isset($add_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-plus"></i>
									</span>
									<span>Add New</span>
								</button>
							</p>
						</div>
					</div>
				</div>
				<div class="columns" style="display: grid">
					<div class="column table-container ">
          <table class="table is-hoverable is-narrow is-fullwidth" id="myTable">
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
                   <td><a href="<?= base_url('Purchase/pos/'.$item->purchase_id); ?>"><span class="tag"><?= ucfirst($item->sub_name); ?></span></a></td>     
                   <td><?= ucfirst($item->quantity); ?></td>     
                   <td> <?= date('M d, Y', strtotime($item->created_at)); ?> </td>
                   <?php $quotations = $this->admin_model->count_qutation($item->purchase_id); ?>
                   <td><?= $quotations; ?></td>
                  <?php if($item->status == 0) { ?>
                   <td ><span class="tag is-danger">Pending</span></td> 
                   <?php } elseif($item->status == 1 ){ ?>
                   <td><span class="tag is-warning">Process <span></td> 
                  <?php } else{ ?>
                    <td><span class="tag is-primary">Approved <span>
                    </td> 
                    <?php } ?>
                  <td>
      
      <?php $quotations = $this->purchase_model->count_po($item->purchase_id); $review = $item->review;  ?>  

    <!--manger order review approved or reject  -->
      <?php if($review == null && $quotations == 0){?>
    <a href="<?= base_url('Purchase/approved_po/'.$item->purchase_id); ?>" class="button is-small">
    <span class="icon is-small has-text-success"><i class="fa fa-check"></i></span></a>
    <a href="<?= base_url('Purchase/cancel_order/'.$item->purchase_id); ?>" class="button is-small">
    <span class="icon is-small has-text-danger"><i class="fa fa-times"></i></span></a>
    <?php } elseif($quotations <= 2 && $review == 1) {?>
        <a data-id="<?= $item->purchase_id.'/'.$item->loc_id; ?>" class="suppliers button is-small"> 
        <span class="icon is-small has-text-primary"> <i class="fas fa-forward"></i></span>  </a>
    <?php } else { ?>
        <a data-id="<?= $item->purchase_id; ?>" class="suppliers disabled button is-small">
        <span class="icon is-small has-text-danger"> <i class="fas fa-closed-captioning"></i></span> 
    <?php } ?>

                  <a href="<?= base_url('Purchase/order_detail/'.$item->purchase_id); ?>" class="button is-small">
                  <span class="icon is-small has-text-primary"> <i class="fas fa-eye"></i></span></a>
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
                  <a href="<?= base_url('Purchase/order_detail/'.$item->purchase_id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                  <a href="<?= base_url('Purchase/cancel_order/'.$item->purchase_id); ?>" class=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a> 
                  <td> 
                  </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
            </tbody>
        <?php endif; ?>
        </table>
					</div>
					<?php if(isset($product_report)) : ?>
					<div class="column has-text-right is-hidden-print">
						<div class="buttons is-pulled-right">
							<button onClick="window.print();" type="button" class="button is-small ">
								<span class="icon is-small">
									<i class="fas fa-print"></i>
								</span>
								<span>Print</span>
							</button>
							<a href="javascript:exportTableToExcel('myTable','Item  Records');" type="button"
								class="button is-small ">
								<span class="icon is-small">
									<i class="fas fa-file-export"></i>
								</span>
								<span>Export</span>
							</a>
						</div>
					</div>
					<?php endif ?>
					<div class="column is-hidden-print">
						<nav class="pagination is-small" role="navigation" aria-label="pagination"
							style="justify-content: center;">
							<?php if(empty($results) AND !empty($items)){ echo $this->pagination->create_links(); } ?>
						</nav>
					</div>
				</div>
			</div>
		</div>
  
    <!-- code to select supplier and send order start -->
    <div class="modal" id="modal-po-supplier">
    <div class="modal-background"></div>
    <form action="<?=base_url('Purchase/po_supplier_order');?>" method="post" class="md-form">
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Po Order Forward</p>
                <button class="delete" aria-label="close" id="exit-supplier-modal" type="button"></button>
            </header>
            <input type="hidden" name="purchaseid" id="purchaseid" value="">
            <section class="modal-card-body">
                <div class="columns">
                    <div class="column">
                        <div class="control">
                            <div class="select select is-small is-fullwidth">
                                <select name="location" id="supplier_location" class="browser-default custom-select ">
                                    <?php if(!empty($locations)): foreach($locations as $loc): ?>
                                    <option value="<?= $loc->id ?>"><?= ucfirst($loc->name); ?> </option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="column ">
                        <div class="select select is-small is-fullwidth">
                            <select name="supplier" id="supplier" class="browser-default custom-select">
                                <option value="" disabled selected>--Select Supplier--</option>
                            </select>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" type="submit">Apply</button>
                <button class="button" aria-label="close" id="close-supplier-modal" type="button">Cancel</button>

            </footer>
        </div>
    </form>
</div>
    <!-- code select supplier to send order end -->


<!-- filter report model -->
<div class="modal" id="modal-ter">
			<div class="modal-background"></div>
      <form action="<?= base_url('purchase/po_report'); ?>" method="get">
				<div class="modal-card">
					<header class="modal-card-head">
						<p class="modal-card-title">Filter Report</p>
						<button class="delete" aria-label="close" id="exit-report-modal" type="button"></button>
					</header>
					<section class="modal-card-body">
						<div class="columns">
							<div class="column">
								<p class="control">
									From:
									<input class="input" type="date" placeholder="From" name="from_date">
								</p>
							</div>
							<div class="column">
								<p class="control">
									To:
									<input class="input" type="date" placeholder="From" name="to_date">
								</p>
							</div>
						</div>
					</section>
					<footer class="modal-card-foot">
						<button class="button is-success" type="submit">Apply</button>
						<button class="button" aria-label="close" id="close-report-modal" type="button">Cancel</button>
					</footer>
				</div>
			</form>
		</div>
<!-- filter report model end --> 
	</div>
</section>

<script> 
	$(document).ready(function () {
		$('.return-btn').click(function () {
			var item_id = $(this).data('id');
			$('#item-id').val(item_id);
		});

		$("#nav-category").click(function () {
			$(this).siblings().toggle('fast');
		});

		$(".file-input").change(function () {
			$(".file-name").text(this.files[0].name);
		});
	});

	class BulmaModal {
		constructor(selector) {
			this.elem = document.querySelector(selector)
			this.close_data()
		}

		show() {
			this.elem.classList.toggle('is-active')
			this.on_show()
		}

		close() {
			this.elem.classList.toggle('is-active')
			this.on_close()
		}

		close_data() {
			var modalClose = this.elem.querySelectorAll("[data-bulma-modal='close'], .modal-background")
			var that = this
			modalClose.forEach(function (e) {
				e.addEventListener("click", function () {

					that.elem.classList.toggle('is-active')

					var event = new Event('modal:close')

					that.elem.dispatchEvent(event);
				})
			})
		}

		on_show() {
			var event = new Event('modal:show')

			this.elem.dispatchEvent(event);
		}

		on_close() {
			var event = new Event('modal:close')

			this.elem.dispatchEvent(event);
		}

		addEventListener(event, callback) {
			this.elem.addEventListener(event, callback)
		}
	}

	var btn1 = $("#report-btn")
	var btn3 = $("#exit-report-modal")
	var btn4 = $("#close-report-modal")

	var mdl = new BulmaModal("#modal-ter")

	btn1.click(function (ev) {
		mdl.show();
		ev.stopPropagation();
	});
	btn3.click(function (ev) {
		mdl.close();
		ev.stopPropagation();
	});
	btn4.click(function (ev) {
		mdl.close();
		ev.stopPropagation();
	});

	var sup1 = $("#exit-supplier-modal")
  var sup2 = $("#close-supplier-modal")
  var supmdl = new BulmaModal("#modal-po-supplier")
  sup1.click(function (ev) { 
		supmdl.close();
		ev.stopPropagation();
	});
	sup2.click(function (ev) { 
		supmdl.close();
		ev.stopPropagation();
	});

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
}); 
// code to open vendor send to apply
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
        supmdl.show();
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

// export report code below
function exportTableToExcel(tableId, filename) {
		let dataType = 'application/vnd.ms-excel';
		let extension = '.xls';

		let base64 = function (s) {
			return window.btoa(unescape(encodeURIComponent(s)))
		};

		let template =
			'<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';
		let render = function (template, content) {
			var r1 = template.replace(/{(\w+)}/g, function (m, p) {
				return content[p];
			});
			var r2 = r1.replace(/{(\w+)}/g, function (m, p) {
				return content[p];
			});
			return r2
		};

		let tableElement = document.getElementById(tableId);

		let tableExcel = render(template, {
			worksheet: filename,
			table: tableElement.innerHTML
		});

		filename = filename + extension;

		if (navigator.msSaveOrOpenBlob) {
			let blob = new Blob(
				['\ufeff', tableExcel], {
					type: dataType
				}
			);

			navigator.msSaveOrOpenBlob(blob, filename);
		} else {
			let downloadLink = document.createElement("a");

			document.body.appendChild(downloadLink);

			downloadLink.href = 'data:' + dataType + ';base64,' + base64(tableExcel);

			downloadLink.download = filename;

			downloadLink.click();
		}
	}
</script>