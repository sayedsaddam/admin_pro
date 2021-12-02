<div class="tile is-ancestor">
    <div class="tile is-parent">
        <div class="tile is-child box py-3 bg-secondary">
            <div class="columns">
                <div class="column is-flex is-justify-content-center is-flex-direction-column">
                    <div class="is-size-7">
                        <a href="<?= base_url('admin') ?>">Admin</a> 
                        <?php if(isset($breadcrumb)) : ?>
                            <?php foreach($breadcrumb as $index => $value ) : ?>
                                <?php if ($index === array_keys($breadcrumb)[count($breadcrumb)-1]) : ?>
                                    &raquo; <span class="has-text-weight-bold"><?= ucwords($value) ?></span>
                                <?php else: ?>
                                    &raquo; <a href="<?= isset($index) ? base_url($index) : '#' ?>"><?= ucwords($value) ?></a>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
                <div class="is-narrow column is-right is-flex is-justify-content-center is-flex-direction-column" id="top-menu-item">
                    <div class="dropdown is-hoverable is-right is-small">
                        <div class="dropdown-trigger">
                            <span class="icon is-small" aria-haspopup="true" aria-controls="dropdown-menu">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <?php if($this->session->userdata('user_role') == 1) : ?>
                                <a href="<?= base_url('/admin/acl') ?>" class="dropdown-item">Admin Controlled Logics</a>
                                <hr class="dropdown-divider">
                                <?php endif ?>
                                <a href="<?= base_url('/admin/dashboard') ?>" class="dropdown-item">Profile Information</a>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="toggle-darkmode column is-flex is-justify-content-center is-flex-direction-column is-narrow" id="top-menu-item">
                <i class="fas fa-adjust"></i>
                </div>
            </div>
        </div>
    </div>
</div>