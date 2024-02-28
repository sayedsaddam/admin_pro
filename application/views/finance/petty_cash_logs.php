<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8">
				<h2 class="display-4 font-weight-bold" title="Human resource Information Management">HRIM</h2>
        <h3 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Finance Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light">Petty Cash Logs</span> | <a href="<?=base_url('finance');?>" class="text-light">Home</a></h4>
      </div>
    </div>
  </div>
</div>

<div class="container my-3 py-3">

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
            <p class="h5-responsive font-weight-bold mb-0">Petty Cash Logs | <small><a href="javascript:history.go(-1)" class="grey-text"><i class="fa fa-angle-left"></i> Back</a></small></p>
            <ul class="list-unstyled d-flex align-items-center mb-0">
              <li><i class="far fa-window-minimize fa-sm pl-3"></i></li>
              <li><i class="fas fa-times fa-sm pl-3"></i></li>
            </ul>
          </div>
          <div class="card-body">
            <table class="table table-sm">
            <caption>Petty Cash Logs</caption>
                <thead>
                    <tr>
                        <th class="font-weight-bold">ID</th>
                        <th class="font-weight-bold">Amount</th>
                        <th class="font-weight-bold">Issued By</th>
                        <th class="font-weight-bold">Location</th>
                        <th class="font-weight-bold">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($cash_logs)): foreach($cash_logs as $log): ?>
                    <tr>
                        <td scope="row"><?= 'CTC-'.$log->id; ?></td>
                        <td><?= number_format($log->amount); ?></td>
                        <td><?= ucfirst($log->fullname); ?></td>
                        <td><?= $log->name; ?></td>
                        <td><?= date('M d, Y', strtotime($log->created_at)); ?></td>
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
