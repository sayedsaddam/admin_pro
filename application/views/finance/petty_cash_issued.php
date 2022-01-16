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
        <h4 class="font-weight-bold orange-text mt-2">Finance Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light">Petty Cash Issued</span> | <a href="<?=base_url('users');?>" class="text-light">Home</a></h4>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid my-3 py-3">

  <!-- Section: Leaves record -->
  <section>
  <?php if($success = $this->session->flashdata('success')): ?>
      <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="alert alert-success">
                  <?= $success; ?>
              </div>
          </div>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-12">
      	<div class="card card-list">
          <div class="card-header white d-flex justify-content-between align-items-center py-3">
            <p class="h5-responsive font-weight-bold mb-0">Petty Cash Issued | <small><a href="javascript:history.go(-1)" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small> &raquo; <small class="font-weight-light">Cash in hand is the total cash the region currently has.</small></p>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
              <li><i class="fas fa-times fa-sm pl-3"></i></li>
            </ul>
          </div>
          <div class="card-body">
            <table class="table table-sm">
            <caption>Petty Cash Issued</caption>
                <thead>
                    <tr>
                        <th class="font-weight-bold">ID</th>
                        <th class="font-weight-bold">Cash in Hand</th>
                        <th class="font-weight-bold">Issued By</th>
                        <th class="font-weight-bold">Location</th>
                        <th class="font-weight-bold">Remarks</th>
                        <th class="font-weight-bold">Date</th>
												<th class="font-weight-bold">Logs</th>
												<th class="font-weight-bold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($cash_issued)): foreach($cash_issued as $ci): ?>
                    <tr>
                        <td scope="row"><?= 'CTC-'.$ci->id; ?></td>
                        <td><?= number_format($ci->amount_issued); ?></td>
                        <td><?= ucfirst($ci->fullname); ?></td>
                        <td><?= $ci->location_name; ?></td>
                        <td><?= ucfirst($ci->remarks); ?></td>
                        <td><?= date('M d, Y', strtotime($ci->created_at)); ?></td>
												<td><a href="<?= base_url('finance/logs_by_location/'.$ci->location_id); ?>">view logs</a></td>
                        <td>
                            <a data-id="<?= $ci->id; ?>" class="badge badge-primary edit_cash_issuance" title="Edit..."><i class="fa fa-check"></i></a>
                            <a data-id="<?= $ci->id; ?>" class="badge badge-danger reject_leave" title="Delete..."><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; else: echo '<tr class="table-danger"><td colspan="7" align="center">No record found.</td></tr>'; endif; ?>
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
  <!-- Section: Leaves record -->
</div>

<!-- cash issuance -->
<div class="modal fade" id="edit_cash_issuance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100 font-weight-bold">Cash Issuance</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form action="<?=base_url('finance/update_petty_cash_issued');?>" method="post" class="md-form">
			<input type="hidden" name="id" class="id">
            <div class="md-form mb-5">
              <input name="amount_issued" type="number" id="form34" class="form-control validate amount_issued">
              <label data-error="wrong" data-success="right" for="form34">Amount Issued</label>
            </div>

			<div class="md-form mb-5">
              <select name="location" id="location" class="browser-default custom-select">
                <option value="" disabled selected>--Select location--</option>
                <?php if(!empty($locations)): foreach($locations as $loc): ?>
                  <option value="<?= $loc->id ?>"><?= $loc->name; ?></option>
                <?php endforeach; endif; ?>
              </select>
            </div>

            <div class="md-form">
              <textarea name="remarks" type="text" class="md-textarea form-control remarks" rows="3"></textarea>
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

<script>
$(document).ready(function(){
  $('.edit_cash_issuance').click(function(){  // Leave approval modal will be displayed.
    var id = $(this).data('id');
    // AJAX request
    $.ajax({
    url: '<?= base_url('finance/edit_petty_cash_issued/'); ?>' + id,
    method: 'POST',
    dataType: 'JSON',
    data: {id: id},
      success: function(response){ 
        console.log(response);
        $('.id').val(response.id);
        $('.amount_issued').val(response.amount_issued);
        $('#location').val(response.location);
		$('.remarks').val(response.remarks);
        // Display Modal
        $('#edit_cash_issuance').modal('show'); 
      }
    });
  });
});
</script>
