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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text"><?php if(empty($results)){ echo 'Contact List'; }else{ echo 'Search Results'; } ?> | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
    <?php if($success = $this->session->flashdata('success')): ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="alert alert-success"><?=$success;?></div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row mb-4">
        <div class="col-lg-6 col-md-6">
            <form action="<?= base_url('admin/search_contact_list'); ?>" method="get" class="md-form form-inline">
                <input type="text" name="search" id="" class="form-control md-form col-5">
                <label for="">Search Query</label>
                <input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
            </form>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
            <a href="<?= base_url('admin/add_asset'); ?>" data-target="#add_supplier" class="btn btn-outline-info"><i class="fa fa-plus"></i> Add New</a>
            <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <table class="table table-sm">
          <caption><?php if(empty($results)){ echo 'List of Assets'; }else{ echo 'Search Results'; } ?></caption>
          <thead>
            <tr>
                <th class="font-weight-bold">ID</th>
                <th class="font-weight-bold">Name</th>
                <th class="font-weight-bold">Designation</th>
                <th class="font-weight-bold">Project</th>
                <th class="font-weight-bold">District</th>
                <th class="font-weight-bold">Province</th>
                <th class="font-weight-bold">Gender</th>
                <th class="font-weight-bold">CNIC</th>
                <th class="font-weight-bold">Personal Contact</th>
                <th class="font-weight-bold">Official Contact</th>
                <th class="font-weight-bold">Grader</th>
                <th class="font-weight-bold">Supervisor</th>
                <th class="font-weight-bold">DoB</th>
                <th class="font-weight-bold">DoJ</th>
            </tr>
          </thead>
          <?php if(empty($results)): ?>
            <tbody>
              <?php if(!empty($assets)): foreach($assets as $asset): ?>
                <tr>
                  <td><?= 'CTC-0'.$asset->id; ?></td>
                  <td><?= $asset->year; ?></td>
                  <td><?= ucfirst($asset->project); ?></td>
                  <td><?= ucfirst($asset->item); ?></td>
                  <td><?= ucfirst($asset->model); ?></td>
                  <td><?= ucfirst($asset->asset_code); ?></td>
                  <td><?= ucfirst($asset->serial_number); ?></td>
                  <td><?= ucfirst($asset->custodian_location); ?></td>
                  <td><?= ucfirst($asset->designation); ?></td>
                  <td><?= ucfirst($asset->department); ?></td>
                  <td><?= date('M d, Y', strtotime($asset->purchase_date)); ?></td>
                  <td>
                    <?php $recDate = date('Y-m-d', strtotime($asset->purchase_date));
                          $today = date("Y-m-d"); // Today's date
                          $diff = date_diff(date_create($recDate), date_create($today));
                          echo $diff->format('%yyr %mm %dd'); ?> 
                  </td>
                  <td></td>
                  <td></td>
                  <td>
                      <a href="<?= base_url('admin/asset_detail/'.$asset->id); ?>"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                      <a href="<?=base_url('admin/delete_asset/'.$asset->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                  </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='14'>No record found.</td></tr>"; endif; ?>
            </tbody> 
          <?php else: ?>
            <tbody>
              <?php if(!empty($results)): foreach($results as $res): ?>
                <tr>
                  <td><?= 'CTC-0'.$res->id; ?></td>
                  <td><?= $res->year; ?></td>
                  <td><?= ucfirst($res->project); ?></td>
                  <td><?= ucfirst($res->item); ?></td>
                  <!-- <td><?= ucfirst($res->model); ?></td> -->
                  <td><?= ucfirst($res->asset_code); ?></td>
                  <td><?= ucfirst($res->serial_number); ?></td>
                  <td><?= ucfirst($res->custodian_location); ?></td>
                  <td><?= ucfirst($res->designation); ?></td>
                  <td><?= ucfirst($res->department); ?></td>
                  <td><?= date('M d, Y', strtotime($res->purchase_date)); ?></td>
                  <td>
                    <?php $recDate = date('Y-m-d', strtotime($res->purchase_date));
                          $today = date("Y-m-d"); // Today's date
                          $diff = date_diff(date_create($recDate), date_create($today));
                          echo $diff->format('%yyr %mm %dd'); ?> 
                  </td>
                  <td>
                      <a href="<?= base_url('admin/asset_detail/'.$res->id); ?>"><span class="badge badge-primary"><i class="fa fa-edit"></i></span></a>
                      <a href="<?=base_url('admin/delete_asset/'.$res->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                  </td>
                </tr>
              <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='12'>No record found.</td></tr>"; endif; ?>
            </tbody>
        <?php endif; ?>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <?php if(empty($results) AND !empty($assets)){ echo $this->pagination->create_links(); } ?>
      </div>
    </div>
</div>