<a href="<?= base_url('admin') ?>" class="has-text-black">Dashboard</a> &raquo;
<?php if ($this->uri->segment(2) == 'categories') : ?>
<span class="has-text-black has-text-weight-bold">Categories List</span>
<?php elseif ($this->uri->segment(2) == 'sub_categories' && !empty($parent_category)) : ?>
<a href="<?= base_url("admin/categories") ?>" class="has-text-black">Categories List</a> &raquo; <span
	class="has-text-weight-bold"><?= ucwords($parent_category[0]->cat_name) ?></span>
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
<a href="<?= base_url('admin/item_register') ?>" class="has-text-black">Items List</a> &raquo; <span
	class="has-text-black has-text-weight-bold">Search</span>:
<?= isset($_GET["search"]) ? filter_var($_GET["search"], FILTER_SANITIZE_STRING) : '' ?>
<?php elseif ($this->uri->segment(2) == 'assign_item') : ?>
<a href="<?= base_url('admin/item_register') ?>" class="has-text-black">Items List</a> &raquo; <span
	class="has-text-black has-text-weight-bold">Assign Item (<?= ucwords($returning_items->names) ?>)</span>
<?php elseif ($this->uri->segment(2) == 'employ') : ?>
<span class="has-text-black has-text-weight-bold">Employees List</span>
<?php elseif ($this->uri->segment(2) == 'search_employ') : ?>
<a href="<?= base_url('admin/employ') ?>" class="has-text-black">Employees List</a> &raquo; <span
	class="has-text-black has-text-weight-bold">Employees Search</span>:
<?= isset($_GET["search"]) ? filter_var($_GET["search"], FILTER_SANITIZE_STRING) : '' ?>
<?php elseif ($this->uri->segment(2) == 'suppliers') : ?>
<span class="has-text-black has-text-weight-bold">Suppliers List</span>
<?php endif ?>
