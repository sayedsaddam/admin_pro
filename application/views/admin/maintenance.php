<div class="jumbotron jumbotron-fluid blue-gradient text-light d-print-none">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
				<h2 class="display-4 font-weight-bold" title="Human resource Information Management">HRIM</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text"><?php if(empty($results)){ echo 'Equipment Maintenance'; }else{ echo 'Search Results'; } ?> | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
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
  <div class="row mb-4 d-print-none">
    <div class="col-lg-6 col-md-6">
      <form action="<?= base_url('admin/search_equip_maintenance'); ?>" method="get" class="md-form form-inline">
        <input type="text" name="search" id="" class="form-control md-form col-5">
        <label for="">Search Query</label>
        <input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
      </form>
    </div>
    <div class="col-lg-6 col-md-6 text-right">
      <button data-toggle="modal" data-target="#add_maintenance" class="btn btn-outline-info"><i class="fa fa-plus"></i> Add New</button>
      <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
      <button class="btn btn-primary d-print-none" onclick="javascript:window.print();">Print</button>
    </div>
  </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2 class="d-none d-print-block mb-3">Maintenance Report</h2>
        <table class="table table-sm">
          <caption class="d-print-none"><?php if(empty($results)){ echo 'List of Equipment Maintenance'; }else{ echo 'Search Results'; } ?></caption>
          <thead>
            <tr>
              <th class="font-weight-bold">ID</th>
              <th class="font-weight-bold">Region</th>
              <th class="font-weight-bold">Date</th>
              <th class="font-weight-bold">Category</th>
              <th class="font-weight-bold">Description</th>
              <th class="font-weight-bold">Vendor</th>
              <th class="font-weight-bold">Qty/Size</th>
              <th class="font-weight-bold">Price</th>
              <th class="font-weight-bold">Amount</th>
              <th class="font-weight-bold">Remarks</th>
              <th class="font-weight-bold d-print-none">Action</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody>
              <?php if(!empty($maintenance_items)): foreach($maintenance_items as $item): ?>
                <tr>
                  <td><?= 'CTC-0'.$item->id; ?></td>
                  <td><?= ucfirst($item->region); ?></td>
                  <td><?= date('M d, Y', strtotime($item->maint_date)); ?></td>
                  <td><?= $item->maint_cat; ?></td>
                  <td><?= ucfirst($item->maint_desc); ?></td>
                  <td><?= $item->vendor; ?></td>
                  <td><?= $item->qty_size; ?></td>
                  <td><?= number_format($item->unit_price); ?></td>
                  <td><?= number_format($item->total_amount); ?></td>
                  <td><?= ucfirst($item->maint_remarks); ?></td>
                  <td class="d-print-none">
                      <a href="<?=base_url('admin/print_record/'.$item->id);?>"><span class="badge badge-primary"><i class="fa fa-print"></i></span></a>
                      <a href="<?=base_url('admin/delete_record/'.$item->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                      <!-- <a href="<?= base_url('admin/invoice_status/'.$item->id); ?>"><span class="badge badge-success"><i class="fa fa-check"></i></span></a> -->
                  </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='10'>No record found.</td></tr>"; endif; ?>
            </tbody>
          <?php else: ?>
            <tbody>
              <?php if(!empty($results)): $total = 0; foreach($results as $res): ?>
                <tr>
                  <td><?= 'CTC-0'.$res->id; ?></td>
                  <td><?= ucfirst($res->region); ?></td>
                  <td><?= date('M d, Y', strtotime($res->maint_date)); ?></td>
                  <td><?= $res->maint_cat; ?></td>
                  <td><?= ucfirst($res->maint_desc); ?></td>
                  <td><?= $res->vendor; ?></td>
                  <td><?= $res->qty_size; ?></td>
                  <td><?= number_format($res->unit_price); ?></td>
                  <td><?= number_format($res->total_amount); $total += $res->total_amount; ?></td>
                  <td><?= ucfirst($res->maint_remarks); ?></td>
                  <td class="d-print-none">
                      <a href="<?=base_url('admin/print_record/'.$res->id);?>"><span class="badge badge-primary"><i class="fa fa-print"></i></span></a>
                      <a href="<?=base_url('admin/delete_record/'.$res->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                      <!-- <a href="<?= base_url('admin/invoice_status/'.$res->id); ?>"><span class="badge badge-success"><i class="fa fa-check"></i></span></a> -->
                  </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='10'>No record found.</td></tr>"; endif; ?>
              <tr class="table-success">
                <td class="font-weight-bold" colspan="8">Total</td>
                <td class="font-weight-bold" colspan="3"><?= number_format($total); ?></td>
              </tr>
            </tbody>
          <?php endif; ?>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <?php if(empty($results) AND !empty($maintenance_items)){ echo $this->pagination->create_links(); } ?>
      </div>
    </div>
</div>

<!-- Add maintenance record -->
<div class="modal fade" id="add_maintenance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Add Maintenance Record</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('admin/add_maintenance');?>" method="post" class="md-form">
            <div class="md-form mb-5">
              <select name="maint_region" class="browser-default custom-select" id="selectList">
                <option value="" disabled selected>--Select region--</option>
                <?php foreach($locations as $loc): ?>
                  <option value="<?= $loc->name; ?>"><?= ucfirst($loc->name); ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="md-form mb-5">
              <input name="maint_date" type="date" id="form34" class="form-control validate">
              <label data-error="wrong" data-success="right" for="form34">Date</label>
            </div>

            <div class="md-form mb-5">
              <input name="maint_cat" type="text" id="form34" class="form-control validate">
              <label data-error="wrong" data-success="right" for="form34">Category</label>
            </div>

            <div class="md-form mb-5">
              <input name="maint_desc" type="text" id="form34" class="form-control validate">
              <label data-error="wrong" data-success="right" for="form34">Description</label>
            </div>

            <div class="md-form mb-5">
              <input name="vendor" type="text" id="form34" class="form-control validate">
              <label data-error="wrong" data-success="right" for="form34">Vendor</label>
            </div>

            <div class="md-form mb-5">
              <input name="qty_size" type="text" id="form34" class="form-control validate">
              <label data-error="wrong" data-success="right" for="form34">Quantity / Size</label>
            </div>

            <div class="md-form mb-5">
              <input name="unit_price" type="text" id="form29" class="form-control validate">
              <label data-error="wrong" data-success="right" for="form29">Unit price</label>
            </div>

            <div class="md-form mb-5">
              <input name="total_amount" type="number" id="form32" class="form-control validate">
              <label data-error="wrong" data-success="right" for="form32">Total amount</label>
            </div>

            <div class="md-form">
              <textarea name="remarks" type="text" class="md-textarea form-control" rows="3"></textarea>
              <label data-error="wrong" data-success="right" for="form8">Remarks</label>
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
