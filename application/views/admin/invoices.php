<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
        <h2 class="display-4 font-weight-bold">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text">Invoices | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <?php if($success = $this->session->flashdata('success')): ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="alert alert-success"><?=$success;?></div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row mb-4">
        <div class="col-lg-6 col-md-6">
            <form action="#0" method="get" class="md-form form-inline">
                <input type="text" name="search" id="" class="form-control md-form col-5">
                <label for="">Search Query</label>
                <input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
            </form>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
            <button data-toggle="modal" data-target="#add_invoice" class="btn btn-outline-info"><i class="fa fa-plus"></i> Add New</button>
            <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
        <table class="table table-sm">
            <caption>List of Invoices</caption>
            <thead>
            <tr>
                <th class="font-weight-bold">ID</th>
                <th class="font-weight-bold">Inv No.</th>
                <th class="font-weight-bold">Vendor</th>
                <th class="font-weight-bold">Region</th>
                <th class="font-weight-bold">Item</th>
                <th class="font-weight-bold">Amount</th>
                <th class="font-weight-bold">Date</th>
                <th class="font-weight-bold">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($invoices)): foreach($invoices as $inv): ?>
                <tr>
                <td><?= 'Inv-0'.$inv->id; ?></td>
                <td><?= $inv->inv_no; ?></td>
                <td><?= $inv->vendor; ?></td>
                <td><?= ucfirst($inv->region); ?></td>
                <td><?= $inv->item; ?></td>
                <td><?= number_format($inv->amount); ?></td>
                <td><?= date('M d, Y', strtotime($inv->created_at)); ?></td>
                <td>
                    <a href="<?=base_url('admin/print_invoice/'.$inv->id);?>"><span class="badge badge-primary"><i class="fa fa-print"></i></span></a>
                    <a href="<?=base_url('admin/delete_invoice/'.$inv->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                    <a href="<?= base_url('admin/invoice_detail/'.$inv->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                </td>
                </tr>
            <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='7'>No record found.</td></tr>"; endif; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>

<!-- Add invoice -->
<div class="modal fade" id="add_invoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Add Invoice</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('admin/add_invoice');?>" method="post" class="md-form">
            <div class="md-form mb-5">
                <input name="inv_no" type="text" id="form34" class="form-control validate">
                <label data-error="wrong" data-success="right" for="form34">Invoice number</label>
            </div>

            <div class="md-form mb-5">
                <input name="vendor_name" type="text" id="form34" class="form-control validate">
                <label data-error="wrong" data-success="right" for="form34">Vendor name</label>
            </div>

            <div class="md-form mb-5">
                <select name="" class="browser-default custom-select" id="selectList">
                  <option value="" disabled selected>--Select region--</option>
                  <option value="islamabad">Islamabad</option>
                  <option value="balochistan">Balochistan</option>
                  <option value="khyber PK">Khyber PK</option>
                  <option value="sindh">Sindh</option>
                </select>
            </div>

            <div class="md-form mb-5">
                <input name="item_name" type="text" id="form29" class="form-control validate">
                <label data-error="wrong" data-success="right" for="form29">Item</label>
            </div>

            <div class="md-form mb-5">
                <input name="amount" type="number" id="form32" class="form-control validate">
                <label data-error="wrong" data-success="right" for="form32">Amount</label>
            </div>

            <div class="md-form">
                <textarea name="inv_desc" type="text" class="md-textarea form-control" rows="3"></textarea>
                <label data-error="wrong" data-success="right" for="form8">Description</label>
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