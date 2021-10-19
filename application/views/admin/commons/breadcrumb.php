<a href="<?= base_url('admin') ?>" class="has-text-black">Dashboard</a> &raquo;
<?php if ($this->uri->segment(2) == 'categories') : ?>
<span class="has-text-black has-text-weight-bold">Categories List</span>
<?php elseif ($this->uri->segment(2) == 'sub_categories' && !empty($sub_categories)) : ?>
    <a href="<?= base_url("admin/categories") ?>" class="has-text-black">Categories List</a> > <span class="has-text-weight-bold"><?= ucwords($sub_categories[0]->cat_name) ?></span>
    <a href="<?= base_url("admin/categories") ?>" class="has-text-black">Categories List</a> &raquo; <span class="has-text-weight-bold"><?= ucwords($sub_categories[0]->cat_name) ?></span>
 <?php elseif ($this->uri->segment(2) == 'item_register') : ?>
<span class="has-text-black has-text-weight-bold">Items List</span>
<?php elseif ($this->uri->segment(2) == 'available_item_list') : ?>
<span class="has-text-black has-text-weight-bold">Available List</span>
<?php elseif ($this->uri->segment(2) == 'get_assign_item') : ?>
<span class="has-text-black has-text-weight-bold">Assigned List</span>
<?php elseif ($this->uri->segment(2) == 'add_item') : ?>
<a href="<?= base_url('admin/item_register') ?>" class="has-text-black">Items List</a> &raquo; <span
	class="has-text-black has-text-weight-bold">Add New</span>
<?php elseif ($this->uri->segment(2) == 'item_detail') : ?>
<a href="<?= base_url('admin/item_register') ?>" class="has-text-black">Items List</a> &raquo; <span
	class="has-text-black has-text-weight-bold">Edit Item</span>
<?php elseif ($this->uri->segment(2) == 'product_report') : ?>
<span class="has-text-black has-text-weight-bold">Report</span>
<?php elseif ($this->uri->segment(2) == 'search_item') : ?>
<span class="has-text-black has-text-weight-bold">Search</span>
<?php elseif ($this->uri->segment(2) == 'assign_item') : ?>
    <a href="<?= base_url('admin/item_register') ?>" class="has-text-black">Items List</a> &raquo; <span class="has-text-black has-text-weight-bold">Assign Item (<?= ucwords($returning_items->names) ?>)</span>
<?php elseif ($this->uri->segment(2) == 'employ') : ?>
<a href="<?= base_url('admin/employ') ?>" class="has-text-black has-text-weight-bold">Employees List</a>
<?php elseif ($this->uri->segment(2) == 'suppliers') : ?>
<a href="<?= base_url('admin/suppliers') ?>" class="has-text-black">Suppliers List</a>
<?php endif ?>
