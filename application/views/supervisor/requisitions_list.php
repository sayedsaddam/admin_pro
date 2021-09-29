<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light d-print-none">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid">
      </div>
      <div class="col-lg-7 col-md-7">
        <h2 class="display-4 font-weight-bold mb-0">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-light">AH Group of Companies (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Employee Dashboard <i class="fa fa-chart-bar"></i><span class="font-weight-light"><br>Requisitions List</span> | <a href="<?=base_url('users');?>" class="text-light">Home</a></h4>
      </div>
    </div>
  </div>
</div>

<div class="container my-3 py-3">

  <!-- Section: Requisitions list -->
  <section>
    <div class="row">
      <div class="col-12">
      	<div class="card card-list">
          <div class="card-header white d-flex justify-content-between align-items-center py-3">
            <p class="h5-responsive font-weight-bold mb-0">Recent Requisitions | <small class="d-print-none"><a href="<?= base_url('/supervisor') ?>" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small></p>
            <div class="col col-md-6 text-right d-print-none">
              <button data-toggle="modal" data-target="#filter-requisitions" class="btn btn-outline-dark btn-sm">Filter</button>
              <?=($this->input->post('filter')) ? '<a href="' . base_url('supervisor/view_all_requisitions') . '" class="btn btn-outline-danger btn-sm">Clear Filter</a>' : '' ?>
              <a href="javascript:exportTableToExcel('requisitions_table','Item Requisition Records');" class="btn btn-outline-dark btn-sm">Export</a>
            </div>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-sm" id="requisitions_table">
                <thead>
                    <tr>
                        <th class="font-weight-bold">Order ID</th>
                        <th class="font-weight-bold">Employee</th>
                        <th class="font-weight-bold">Item</th>
                        <th class="font-weight-bold">Category</th>
                        <th class="font-weight-bold">Quantity</th>
                        <th class="font-weight-bold">Description</th>
                        <th class="font-weight-bold">Requested</th>
                        <th class="font-weight-bold">Status</th>
                        <th class="font-weight-bold d-print-none">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($requisitions)): foreach($requisitions as $req): ?>
                    <tr>
                        <td><?= 'AHG-'.$req->id; ?></td>
                        <td><?= $req->fullname; ?></td>
                        <td><?= ucfirst($req->sub_cat_name); ?></td>
                        <td><?= ucfirst($req->cat_name); ?></td>
                        <td><?= $req->item_qty; ?></td>
                        <td title="<?= $req->item_desc; ?>"><?= substr($req->item_desc, 0, 10).' &hellip;'; ?></td>
                        <td><?= date('M d, Y', strtotime($req->created_at)); ?></td>
                        <td>
                        <?php if($req->status == 0){ echo "<span class='badge badge-warning'>pending</span>"; }elseif($req->status == 1){ echo "<span class='badge badge-success'>approved</span>"; }else{ echo "<span class='badge badge-danger'>rejected</span>"; } ?>
                        </td>
                        <td class="d-print-none">
                        <a href="<?= base_url('supervisor/approve_request/'.$req->id); ?>" class="badge badge-primary" title="Approve request..." onclick="javascript: return confirm('Are you sure to perform this action?');"><i class="fa fa-check"></i></a>
                        <a href="<?= base_url('supervisor/reject_request/'.$req->id); ?>" class="badge badge-danger" title="Reject request..." onclick="javascript: return confirm('Are you sure to perform this action?');"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; else: echo '<tr class="table-danger"><td colspan="15" align="center">No record found.</td></tr>'; endif; ?>
                </tbody>
            </table>
          </div>
          <div class="card-footer white py-3 d-flex justify-content-between">
            <?= $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Requisitions -->

  <!-- Full Height Modal Right > Export Travels Data -->
<div class="modal fade left" id="filter-requisitions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
  aria-hidden="true">
  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-xl modal-right" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title w-100" id="myModalLabel">Exporting Requisition Records</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <!-- Form -->
              <form action="<?= base_url('supervisor/view_all_requisitions'); ?>" method="post">
                  <input type="hidden" name="filter" value="true">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="visit_start">From</label>
                        <input type="date" name="date_from" class="form-control">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="check_out">To</label>
                        <input type="date" name="date_to" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="submit" class="btn btn-primary" value="Submit Request">
                      <input type="reset" class="btn btn-danger" value="clear form">
                    </div>
                  </div>
              </form>
              <!-- Form -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<!-- Full Height Modal Right -->
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