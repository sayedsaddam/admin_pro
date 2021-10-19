<a href="<?= base_url('admin') ?>" class="has-text-black">Dashboard</a> >
<?php if ($this->uri->segment(2) == 'item_register') : ?>
<span class="has-text-black has-text-weight-bold">Items List</span>
<?php elseif ($this->uri->segment(2) == 'available_item_list') : ?>
<span class="has-text-black has-text-weight-bold">Available List</span>
<?php elseif ($this->uri->segment(2) == 'get_assign_item') : ?>
<span class="has-text-black has-text-weight-bold">Assigned List</span>
<?php elseif ($this->uri->segment(2) == 'add_item') : ?>
<a href="<?= base_url('admin/item_register') ?>" class="has-text-black">Items List</a> > <span
	class="has-text-black has-text-weight-bold">Add New</span>
<?php elseif ($this->uri->segment(2) == 'item_detail') : ?>
<a href="<?= base_url('admin/item_register') ?>" class="has-text-black">Items List</a> > <span
	class="has-text-black has-text-weight-bold">Edit Item</span>
<?php elseif ($this->uri->segment(2) == 'product_report') : ?>
<span class="has-text-black has-text-weight-bold">Report</span>
<?php elseif ($this->uri->segment(2) == 'search_item') : ?>
<span class="has-text-black has-text-weight-bold">Search</span>
<?php endif ?>
