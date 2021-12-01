<div class="tile is-ancestor">
    <div class="tile is-parent">
        <div class="tile is-child box py-3">
            <div class="columns">
                <div class="column is-flex is-justify-content-center is-flex-direction-column">
                    <div class="bc">
                        <a href="<?= base_url('admin') ?>" class="has-text-black">Admin</a> 
                        <?php if(isset($breadcrumb)) : ?>
                            <?php foreach($breadcrumb as $index => $value ) : ?>
                                <?php if ($index === array_keys($breadcrumb)[count($breadcrumb)-1]) : ?>
                                    &raquo; <span class="has-text-black has-text-weight-bold"><?= ucwords($value) ?></span>
                                <?php else: ?>
                                    &raquo; <a href="<?= isset($index) ? base_url($index) : '#' ?>" class="has-text-black"><?= ucwords($value) ?></a>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
                <div class="is-narrow column is-right is-flex is-justify-content-center is-flex-direction-column">
                    <div class="dropdown is-hoverable is-right is-small">
                        <div class="dropdown-trigger">
                            <button class="button is-small is-white" aria-haspopup="true" aria-controls="dropdown-menu4">
                            <span><?= ucwords($this->session->userdata('fullname')) ?></span>
                            <span class="icon is-small">
                                <i class="fas fa-angle-down" aria-hidden="true"></i>
                            </span>
                            </button>
                        </div>
                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                            <div class="dropdown-content">
                                <a href="<?= base_url('/admin/acl') ?>" class="dropdown-item">Admin Controlled Logics</a>
                                <hr class="dropdown-divider">
                                <a href="<?= base_url('#') ?>" class="dropdown-item">Profile Information</a>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>