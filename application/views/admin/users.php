<div class="jumbotron jumbotron-fluid morpheus-den-gradient text-light">
  <div class="container-fluid">
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
        <h4 class="font-weight-bold orange-text mt-2">Admin Dashboard <i class="fa fa-chart-bar"></i><br><span class="font-weight-light orange-text"><?php if(empty($results)){ echo 'Users'; }else{ echo 'Search Results'; } ?> | <a href="<?=base_url('admin');?>" class="text-light font-weight-bold">Home</a></span></h4>
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
            <form action="<?= base_url('admin/search_users'); ?>" method="get" class="md-form form-inline">
                <input type="text" name="search" id="" class="form-control md-form col-5">
                <label for="">Search Query</label>
                <input type="submit" value="go &raquo;" class="btn btn-outline-primary rounded-pill">
            </form>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
            <a href="<?=base_url('login/signup');?>" class="btn btn-outline-info"><i class="fa fa-plus"></i> Add New</a>
            <a href="javascript:history.go(-1)" class="btn btn-outline-danger"><i class="fa fa-angle-left"></i> Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table table-sm">
                <caption><?php if(empty($results)){ echo 'List of Users'; }else{ echo 'Search Results'; } ?></caption>
                <thead>
                <tr>
                    <th class="font-weight-bold">ID</th>
                    <th class="font-weight-bold">Name</th>
                    <th class="font-weight-bold">Email</th>
                    <th class="font-weight-bold">Username</th>
                    <th class="font-weight-bold">Location</th>
                    <th class="font-weight-bold">Role</th>
                    <th class="font-weight-bold">Date</th>
                    <th class="font-weight-bold">Action</th>
                </tr>
                </thead>
                <?php if(empty($results)): ?>
                <tbody>
                    <?php if(!empty($users)): foreach($users as $user): ?>
                        <tr>
                            <td><?= 'CTC-0'.$user->id; ?></td>
                            <td><?= $user->fullname; ?></td>
                            <td><?= $user->email; ?></td>
                            <td><?= $user->username; ?></td>
                            <td><?= $user->location; ?></td>
                            <td><?php if($user->user_role == 'user'){ echo "Staff"; }else{ echo "Adminstrator"; } ?></td>
                            <td><?= date('M d, Y', strtotime($user->created_at)); ?></td>
                            <td>
                                <a href=""><span class="badge badge-primary"><i class="fa fa-check"></i></span></a>
                                <a href="<?=base_url('admin/delete_user/'.$user->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                                <a href="<?= base_url('admin/user_detail/'.$user->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                            </td>
                        </tr>
                    <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='8'>No record found.</td></tr>"; endif; ?>
                    </tbody>
                <?php else: ?>
                    <tbody>
                    <?php if(!empty($results)): foreach($results as $res): ?>
                        <tr>
                            <td><?= 'CTC-0'.$res->id; ?></td>
                            <td><?= $res->fullname; ?></td>
                            <td><?= $res->email; ?></td>
                            <td><?= $res->username; ?></td>
                            <td><?= $res->location; ?></td>
                            <td><?php if($res->user_role == 'user'){ echo "Staff"; }else{ echo "Adminstrator"; } ?></td>
                            <td><?= date('M d, Y', strtotime($res->created_at)); ?></td>
                            <td>
                                <a href=""><span class="badge badge-primary"><i class="fa fa-check"></i></span></a>
                                <a href="<?=base_url('admin/delete_user/'.$res->id);?>" onclick="javascript:return confirm('Are you sure to delete this record. This can not be undone. Click OK to continue!');"><span class="badge badge-danger"><i class="fa fa-times"></i></span></a>
                                <a href="<?= base_url('admin/user_detail/'.$res->id); ?>"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                            </td>
                        </tr>
                    <?php endforeach; else: echo "<tr class='table-danger text-center'><td colspan='8'>No record found.</td></tr>"; endif; ?>
                    </tbody>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>