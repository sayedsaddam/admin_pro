<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid d-print-none">
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
 
<div class="container my-3 py-3">
<!-- Section: report list -->
<section>
<div class="row">
<div class="col-lg-12 col-md-8 text-right">
          <a href="javascript:exportTableToExcel('items','Item  Records');" class="btn btn-outline-dark btn-sm d-print-none">Export</a>
          <a href="javascript:history.go(-1)" class="btn btn-outline-danger btn-sm d-print-none"><i class="fa fa-angle-left"></i> Back</a>
          </div>
      <div class="col-lg-12 col-md-12">
        <table class="table table-sm" id="items">
          <caption><?php if(empty($results)){ echo 'List of Assets'; }else{ echo 'Search Results'; } ?></caption>
          <thead>
            <tr>
                <th class="font-weight-bold">ID </th>
                <th class="font-weight-bold">Location</th>
                <th class="font-weight-bold">Category</th>
                <th class="font-weight-bold">Sub Category</th>
                <!-- <th class="font-weight-bold">Model</th> -->
                <th class="font-weight-bold">Product</th>
                <th class="font-weight-bold">Model</th>
                <th class="font-weight-bold">S:No</th>
                <th class="font-weight-bold">Supplier</th> 
                <th class="font-weight-bold">Price</th>
                <th class="font-weight-bold">Depreciation %</th>
                <th class="font-weight-bold">Status</th>
                <th class="font-weight-bold"> Date</th>  
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody id="myTable">
              <?php if(!empty($reports)): foreach($reports as $item): ?>
                <tr>
                  <td><?= 'CTC-0'.$item->id; ?></td>
                  <td><?= $item->name; ?></td>
                  <td><?= ucfirst($item->cat_name); ?></td>
                  <td><?= ucfirst($item->names); ?></td>
                   <td><?= ucfirst($item->type_name); ?></td>  
                  <td><?= ucfirst($item->model); ?></td>
                  <td><?= ucfirst($item->serial_number); ?></td>
                  <td><?= ucfirst($item->supplier); ?></td>  
                  <td><?= number_format(floatval($item->price)); ?></td>  
                  <td><?= $item->depreciation.' (%)'; ?></td>
                  <td><?= $status = $item->quantity > 0 ? '<span class="badge badge-success">Available</span>' : '<span class="badge badge-warning">Assigned</span>'; ?></td>
                  <td><?= date('M d, Y', strtotime($item->purchasedate)); ?></td> 
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
            </tbody>  
            
        <?php endif; ?>
        </table>
        <a href="#" class="btn btn-primary d-print-none" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>

      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <?php if(empty($results) AND !empty($items)){ echo $this->pagination->create_links(); } ?>
      </div>
    </div>
</div>
</section>
<!-- Section: report -->
</div>
<script>
  function exportTableToExcel(tableId, filename) {
    let dataType = 'application/vnd.ms-excel';
    let extension = '.xls';

    let base64 = function(s) {
        return window.btoa(unescape(encodeURIComponent(s)))
    };

    let template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';
    let render = function(template, content) {
        var r1 = template.replace(/{(\w+)}/g, function(m, p) { return content[p]; });
        var r2 = r1.replace(/{(\w+)}/g, function(m, p) { return content[p]; });
        return r2
    };

    let tableElement = document.getElementById(tableId);

    let tableExcel = render(template, {
        worksheet: filename,
        table: tableElement.innerHTML
    });

    filename = filename + extension;

    if (navigator.msSaveOrOpenBlob)
    {
        let blob = new Blob(
            [ '\ufeff', tableExcel ],
            { type: dataType }
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

