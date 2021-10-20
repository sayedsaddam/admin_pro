<a href="<?= base_url('admin') ?>" class="has-text-black">Admin</a> 
<?php if(isset($breadcrumb)) : ?>
    <?php foreach($breadcrumb as $index => $value ) : ?>
        <?php if ($index === array_key_last($breadcrumb)) : ?>
            &raquo; <span class="has-text-black has-text-weight-bold"><?= ucwords($value) ?></span>
        <?php else: ?>
            &raquo; <a href="<?= base_url($index) ?>" class="has-text-black"><?= ucwords($value) ?></a>
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>