<aside class="section is-narrow-mobile is-hidden-mobile" id="categories">
	<p class="menu-label">
		General
	</p>
	<ul class="menu-list">
		<li><a href="<?= base_url('admin') ?>">Dashboard</a></li>
	</ul>
	<p class="menu-label">
		Procurement
	</p>
	<ul class="menu-list">
		<li><a href="<?= base_url('admin/suppliers') ?>">Suppliers</a></li>
	</ul>
	<ul class="menu-list">
		<li><a href="<?= base_url('admin/employ') ?>">Employees</a></li>
	</ul>
	<ul class="menu-list">
		<li><a href="<?= base_url('admin/categories') ?>">Categories</a></li>
	</ul>
	<ul class="menu-list">
		<li><a href="<?= base_url('admin/travels_info') ?>">Travels Info</a></li>
	</ul>
	<ul class="menu-list">
		<li><a href="<?= base_url('admin/locations') ?>">Locations</a></li>
	</ul>
	<ul class="menu-list">
		<li><a href="<?= base_url('admin/inventory') ?>">Inventory</a></li>
	</ul>
	<ul class="menu-list">
		<li><a href="<?= base_url('admin/users') ?>">Users</a></li>
	</ul>
	<ul class="menu-list">
		<li><a href="<?=  base_url('admin/invoices') ?>">Invoices</a></li>
	</ul>
	<ul class="menu-list">
		<li><a href="<?= base_url('/admin/projects') ?>">Projects</a></li>
	</ul>
	<ul class="menu-list">
		<li><button class="button is-primary has-text-weight-bold is-inverted" id="nav-category"
				style="background-color:#ebfffc;">Item Register</button>
			<ul id="sub-categories" style="display: none;">
				<li><a href="<?= base_url('admin/item_register'); ?>">Items List</a></li>
				<li><a href="<?= base_url('admin/available_item_list'); ?>">Available List</a></li>
				<li><a href="<?= base_url('admin/get_assign_item'); ?>">Assigned List</a></li>
				<li><a href="<?= base_url('admin/add_item'); ?>">Add New</a></li>
			</ul>
		</li>

	</ul>
	<ul class="menu-list">
		<li><a href="<?= base_url('Purchase/purchase_order_list') ?>">Purchase</a></li>
	</ul>
	<ul class="menu-list">
		<li><a href="<?= base_url('admin/asset_register') ?>">Asset Register</a></li>
	</ul>
	<ul class="menu-list">
		<li><a href="<?= base_url('admin/maintenance') ?>">Maintenance</a></li>
	</ul>
	<ul class="menu-list">
		<li><a href="<?= base_url('admin/contact_list') ?>">Contact List</a></li>
	</ul>
	<!-- <ul class="menu-list">
			<li><a><b class="has-text-grey">Travel</b> Requests <span class="tag is-info is-light">2</span></a></li>
		</ul> -->
</aside>
