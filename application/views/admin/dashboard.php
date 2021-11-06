<style>
  .footer-hover {
    background-color: rgba(0, 0, 0, 0.1);
    -webkit-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out
  }

  .footer-hover:hover {
    background-color: rgba(0, 0, 0, 0.2)
  }

  .text-black-40 {
    color: rgba(0, 0, 0, 0.4)
  }
  img{
    height: 150px;
  }
</style>
<div class="jumbotron jumbotron-fluid blue-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/chip.png'); ?>" alt="admin-and-procurement" class="img-thumbnail" width="200">
      </div>
      <div class="col-lg-7 col-md-7">
        <h1 class="font-weight-bold">Admin & Procurement</h1>
        <h5 class="font-weight-bold text-dark">CHIP Training & Consulting (Pvt.) Ltd.</h5>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <a href="<?= base_url('users/profile'); ?>" class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></a>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text"><?='<small>Annual Exp. </small>'.number_format($annual_expense->annual_expenses);?></span></h4>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid my-3 py-3">
  <div class="row">
    <div class="col-lg-2 col-md-2">
      <ul class="list-group list-group-flush">
        <ul class="list-group">
          <li class="list-group-item">
            <a href="<?= base_url('admin/suppliers'); ?>" class="text-white btn-floating btn-fb btn-sm"><i class="fas fa-truck-moving"></i></a> Suppliers
          </li>
          <li class="list-group-item">
            <a href="<?= base_url('admin/leaves_info'); ?>" class="text-white btn-floating btn-tw btn-sm"><i class="fas fa-sign"></i></a>Attd. & Leaves
          </li>
          <li class="list-group-item">
            <a href="<?= base_url('admin/travels_info'); ?>" class="text-white btn-floating btn-fb btn-sm"><i class="fas fa-plane"></i></a>Travels Info
          </li>
          <li class="list-group-item">
            <a href="<?= base_url('admin/locations'); ?>" class="text-white btn-floating btn-slack btn-sm"><i class="fas fa-map-marker"></i></a>Locations
          </li>
          <li class="list-group-item">
            <a href="<?= base_url('admin/inventory'); ?>" class="btn-floating btn-tw btn-sm"><i class="fas fa-warehouse"></i></a>Inventory
          </li>
          <li class="list-group-item">
            <a href="<?= base_url('admin/users'); ?>" class="text-white btn-floating btn-li btn-sm"><i class="fas fa-users-cog"></i></a>Users
          </li>
          <li class="list-group-item">
            <a href="<?= base_url('admin/invoices'); ?>" class="text-white btn-floating btn-slack btn-sm"><i class="fas fa-receipt"></i></a>Invoices
          </li>
          <li class="list-group-item">
            <a href="<?= base_url('admin/projects'); ?>" class="text-white btn-floating btn-tw btn-sm"><i class="fas fa-project-diagram"></i></a>Projects
          </li>
          <li class="list-group-item">
            <a href="<?=base_url('admin/asset_register');?>" class="text-white btn-floating btn-yt btn-sm"><i class="fas fa-book"></i></a>Asset Register
          </li>
          <li class="list-group-item">
            <a href="<?= base_url('admin/maintenance'); ?>" class="text-white btn-floating btn-li btn-sm"><i class="fas fa-cog"></i></a>Maintenance
          </li>
          <li class="list-group-item">
            <a href="<?= base_url('admin/contact_list'); ?>" class="text-white btn-floating btn-fb btn-sm"><i class="fas fa-phone"></i></a>Contact List
          </li>
        </ul>
      </ul>
    </div>
    <div class="col-lg-10 col-md-10">
      <!-- Section: Block Content -->
      <section>
        <?php if($success = $this->session->flashdata('success')): ?>
          <!-- Grid row -->
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="alert alert-success">
                <?= $success; ?>
              </div>
            </div>
          </div>
          <!-- Grid row -->
        <?php endif; ?>
        <!-- Grid row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card-deck">
              <div class="card mb-4">
                <div class="view overlay">
                  <img class="card-img-top" src="<?= base_url('assets/img/head_office.jpeg'); ?>"
                    alt="Islamabad-stats">
                  <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>
                <div class="card-body text-center text-light" style="background-color: #607D8B;">
                  <h4 class="card-title font-weight-bold text-light">Islamabad</h4>
                  <div class="row">
                    <div class="col-md-6">CTC Own</div>
                    <div class="col-md-6"><?=number_format($ctc_own_isbd->ctc_own_isbd);?></div>
                  </div>
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">Projects</div>
                    <div class="col-md-6"><?=number_format($total_isbd->isbd_total);?></div>
                  </div>
                  <!-- <button type="button" class="btn btn-outline-light btn-md">Read more</button> -->
                </div>
              </div>
              <div class="card mb-4">
                <div class="view overlay">
                  <img class="card-img-top" src="<?= base_url('assets/img/kp.jpeg'); ?>"
                    alt="Card image cap">
                  <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>
                <div class="card-body text-center text-light" style="background-color: #607D8B;">
                  <h4 class="card-title font-weight-bold">Khyber PK</h4>
                  <div class="row">
                    <div class="col-md-6">CTC Own</div>
                    <div class="col-md-6"><?=number_format($ctc_own_kp->ctc_own_kp);?></div>
                  </div>
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">Projects</div>
                    <div class="col-md-6"><?=number_format($total_kp->kp_total);?></div>
                  </div>
                  <!-- <button type="button" class="btn btn-outline-light btn-md">Read more</button> -->
                </div>
              </div>
              <div class="card mb-4">
                <div class="view overlay">
                  <img class="card-img-top" src="<?= base_url('assets/img/bln.jpeg'); ?>"
                    alt="Card image cap">
                  <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>
                <div class="card-body text-center text-light" style="background-color: #607D8B;">
                  <h4 class="card-title font-weight-bold">Balochistan</h4>
                  <div class="row">
                    <div class="col-md-6">CTC Own</div>
                    <div class="col-md-6"><?=number_format($ctc_own_bln->ctc_own_bln);?></div>
                  </div>
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">Projects</div>
                    <div class="col-md-6"><?=number_format($total_bln->bln_total);?></div>
                  </div>
                  <!-- <button type="button" class="btn btn-outline-light btn-md">Read more</button> -->
                </div>
              </div>
              <div class="card mb-4">
                <div class="view overlay">
                  <img class="card-img-top" src="<?= base_url('assets/img/punjab.jpeg'); ?>"
                    alt="Card image cap">
                  <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>
                <div class="card-body text-center text-light" style="background-color: #607D8B;">
                  <h4 class="card-title font-weight-bold">Punjab</h4>
                  <div class="row">
                    <div class="col-md-6">CTC Own</div>
                    <div class="col-md-6"><?=number_format($ctc_own_punjab->ctc_own_punjab);?></div>
                  </div>
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">Projects</div>
                    <div class="col-md-6"><?=number_format($total_punjab->punjab_total);?></div>
                  </div>
                  <!-- <button type="button" class="btn btn-outline-light btn-md">Read more</button> -->
                </div>
              </div>
              <div class="card mb-4">
                <div class="view overlay">
                  <img class="card-img-top" src="<?= base_url('assets/img/sindh.jpeg'); ?>"
                    alt="Card image cap">
                  <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                  </a>
                </div>
                <div class="card-body text-center text-light" style="background-color: #607D8B;">
                  <h4 class="card-title font-weight-bold">Sindh</h4>
                  <div class="row">
                    <div class="col-md-6">CTC Own</div>
                    <div class="col-md-6"><?=number_format($ctc_own_sindh->ctc_own_sindh);?></div>
                  </div>
                  <div class="row mt-2 mb-4">
                    <div class="col-md-6">Projects</div>
                    <div class="col-md-6"><?=number_format($total_sindh->sindh_total);?></div>
                  </div>
                  <!-- <button type="button" class="btn btn-outline-light btn-md">Read more</button> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Section: Block Content -->
      <hr>
      <!-- Section: tasks list -->
      <section>
        <div class="row no-gutters">

          <!-- Grid column -->
          <div class="col-lg-4 col-md-12 mb-4">

            <!-- Panel -->
            <div class="card">

              <div class="card-header white-text primary-color">
                <div class="row">
                  <div class="col-lg-8 col-md-8">
                    Pending Requests <span class="badge badge-light"><?= $pending; ?></span>
                  </div>
                  <div class="col-lg-4 col-md-4 text-right">
                    <a href="<?= base_url('admin/pending_requests'); ?>" class="badge badge-dark text-uppercase">view <i class="fa fa-eye"></i></a>
                  </div>
                </div>
              </div>

              <div class="card-body text-center px-4">
                <table class="table table-sm">
                  <thead class="black white-text">
                    <tr>
                      <th>ID</th>
                      <th>By</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($pending_requisitions)): foreach($pending_requisitions as $pen_req): ?>
                      <tr>
                        <td><?= 'CTC-0'.$pen_req->id; ?></td>
                        <td><?= $pen_req->fullname; ?></td>
                        <td><?= date('M d, Y', strtotime($pen_req->created_at)); ?></td>
                        <td>
                          <a href=""><span class="badge badge-primary"><i class="fa fa-check"></i></span></a>
                          <a href=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                          <a href="<?= base_url('admin/request_detail/'.$pen_req->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                        </td>
                      </tr>
                    <?php endforeach; else: echo "<tr class='table-danger'><td colspan='4'>No requisitions yet.</td></tr>"; endif;  ?>
                  </tbody>
                </table>
              </div>

            </div>
            <!-- Panel -->

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-lg-4 col-md-6 mb-4">

            <!-- Panel -->
            <div class="card">

              <div class="card-header white-text primary-color">
                <div class="row">
                  <div class="col-lg-8 col-md-8">
                    Approved Requests <span class="badge badge-light"><?= $approved; ?></span>
                  </div>
                  <div class="col-lg-4 col-md-4 text-right">
                    <a href="<?= base_url('admin/approved_requests'); ?>" class="badge badge-dark text-uppercase">view <i class="fa fa-eye"></i></a>
                  </div>
                </div>
              </div>

              <div class="card-body text-center px-4">
              <table class="table table-sm">
                  <thead class="black white-text">
                    <tr>
                      <th>ID</th>
                      <th>By</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($approved_requisitions)): foreach($approved_requisitions as $app_req): ?>
                      <tr>
                        <td><?= 'CTC-0'.$app_req->id; ?></td>
                        <td><?= $app_req->fullname; ?></td>
                        <td><?= date('M d, Y', strtotime($app_req->created_at)); ?></td>
                        <td>
                          <a href=""><span class="badge badge-primary"><i class="fa fa-check"></i></span></a>
                          <a href=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                          <a href="<?= base_url('admin/request_detail/'.$app_req->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                        </td>
                      </tr>
                    <?php endforeach; else: echo "<tr class='table-danger'><td colspan='4'>No requisitions yet.</td></tr>"; endif; ?>
                  </tbody>
                </table>
              </div>

            </div>
            <!-- Panel -->

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-lg-4 col-md-6 mb-4">

            <!-- Panel -->
            <div class="card">

              <div class="card-header white-text primary-color">
                <div class="row">
                  <div class="col-lg-8 col-md-8">
                    Rejected Requests <span class="badge badge-light"><?= $rejected; ?></span>
                  </div>
                  <div class="col-lg-4 col-md-4 text-right">
                    <a href="<?= base_url('admin/rejected_requests'); ?>" class="badge badge-dark text-right text-uppercase">view <i class="fa fa-eye"></i></a>
                  </div>
                </div>
              </div>

              <div class="card-body text-center px-4">
              <table class="table table-sm">
                  <thead class="black white-text">
                    <tr>
                      <th>ID</th>
                      <th>By</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($rejected_requisitions)): foreach($rejected_requisitions as $rej_req): ?>
                      <tr>
                        <td><?= 'CTC-0'.$rej_req->id; ?></td>
                        <td><?= $rej_req->fullname; ?></td>
                        <td><?= date('M d, Y', strtotime($rej_req->created_at)); ?></td>
                        <td>
                          <a href=""><span class="badge badge-primary"><i class="fa fa-check"></i></span></a>
                          <a href=""><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                          <a href="<?= base_url('admin/request_detail/'.$rej_req->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                        </td>
                      </tr>
                    <?php endforeach; else: echo "<tr class='table-danger'><td colspan='4'>No requisitions yet.</td></tr>"; endif; ?>
                  </tbody>
                </table>
              </div>

            </div>
            <!-- Panel -->

          </div>
          <!-- Grid column -->

        </div>
      </section>
      <!-- Section -->
    </div>
  </div>
  
</div>