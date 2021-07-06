<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-md-1">
        <img src="<?= base_url('assets/img/favicon.ico'); ?>" alt="admin-and-procurement" class="img-fluid" width="200">
      </div>
      <div class="col-lg-7 col-md-7">
        <h2 class="display-4 font-weight-bold">Admin & Procurement</h2>
        <h3 class="font-weight-bold text-light">AH Group of Companies (Pvt.) Ltd.</h3>
      </div>
      <div class="col-lg-4 col-md-4 text-right">
        <button class="btn btn-outline-light font-weight-bold" title="Currently logged in..."><?php echo $this->session->userdata('fullname'); ?></button>
        <a href="<?= base_url('login/logout'); ?>" class="btn btn-dark font-weight-bold" title="Logout...">Logout <i class="fa fa-sign-out-alt"></i></a>
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text"><?php if(empty($results)){ echo 'Inventory'; }else{ echo 'Search Results'; } ?> | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>
