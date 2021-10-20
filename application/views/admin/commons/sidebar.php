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
		<li><a class="<?= $this->uri->segment(2) == 'suppliers' ? 'is-primary has-text-weight-bold is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'suppliers' ? 'style="background-color:#ebfffc;"' : '' ?>>Suppliers</a>
			<ul class="sub-categories" style="<?= $this->uri->segment(2) == 'suppliers' ? '' : 'display: none;' ?>">
				<li class="is-size-7"><a href="<?= base_url('admin/suppliers'); ?>"><i class="fas fa-user mr-1"></i> Suppliers List</a></li>
			</ul>
		</li>

	</ul>
	<ul class="menu-list">
	<li><a class="<?= $this->uri->segment(2) == 'employ' ? 'is-primary has-text-weight-bold is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'employ' ? 'style="background-color:#ebfffc;"' : '' ?>>Employees</a>
			<ul class="sub-categories" style="<?= $this->uri->segment(2) == 'employ' ? '' : 'display: none;' ?>">
				<li class="is-size-7"><a href="<?= base_url('admin/employ'); ?>"><i class="fas fa-user-tie mr-1"></i> Employees List</a></li>
			</ul>
		</li>
	</ul>
	<?php if($this->session->userdata('user_role') == 'admin') : ?>
	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'categories' || $this->uri->segment(2) == 'sub_categories' || $this->uri->segment(2) == 'search_sub_categories' || $this->uri->segment(2) == 'search_categories' ? 'is-primary has-text-weight-bold is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'categories' || $this->uri->segment(2) == 'sub_categories' || $this->uri->segment(2) == 'search_sub_categories' || $this->uri->segment(2) == 'search_categories' ? 'style="background-color:#ebfffc;"' : '' ?>>Item
				Categories</a>
			<ul class="sub-categories" style="<?= $this->uri->segment(2) == 'categories' || $this->uri->segment(2) == 'sub_categories' || $this->uri->segment(2) == 'search_sub_categories' || $this->uri->segment(2) == 'search_categories' ? '' : 'display: none;' ?>">
				<li class="is-size-7"><a href="<?= base_url('admin/categories'); ?>"><i class="fas fa-hashtag mr-1"></i> Categories List</a></li>
			</ul>
		</li>
	</ul>
	<?php endif ?>
	<ul class="menu-list">
		<!-- <li><a href="<?= base_url('admin/travels_info') ?>">Travels Info</a></li> -->
	</ul>
	<ul class="menu-list">
		<!-- <li><a href="<?= base_url('admin/locations') ?>">Locations</a></li> -->
	</ul>
	<ul class="menu-list">
		<!-- <li><a href="<?= base_url('admin/inventory') ?>">Inventory</a></li> -->
	</ul>
	<ul class="menu-list">
		<!-- <li><a href="<?= base_url('admin/users') ?>">Users</a></li> -->
	</ul>
	<ul class="menu-list">
		<!-- <li><a href="<?=  base_url('admin/invoices') ?>">Invoices</a></li> -->
	</ul>
	<ul class="menu-list">
		<!-- <li><a href="<?= base_url('/admin/projects') ?>">Projects</a></li> -->
	</ul>
	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'get_assign_item' || $this->uri->segment(2) == 'available_item_list' || $this->uri->segment(2) == 'item_register' || $this->uri->segment(2) == 'product_report' || $this->uri->segment(2) == 'add_item' || $this->uri->segment(2) == 'search_item' || $this->uri->segment(2) == 'item_detail' || $this->uri->segment(2) == 'assign_item' ? 'is-primary has-text-weight-bold is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'get_assign_item' || $this->uri->segment(2) == 'available_item_list' || $this->uri->segment(2) == 'item_register' || $this->uri->segment(2) == 'product_report' || $this->uri->segment(2) == 'add_item' || $this->uri->segment(2) == 'search_item' || $this->uri->segment(2) == 'item_detail' || $this->uri->segment(2) == 'assign_item' ? 'style="background-color:#ebfffc;"' : '' ?>>Item
				Register</a>
			<ul class="sub-categories" style="<?= $this->uri->segment(2) == 'get_assign_item' || $this->uri->segment(2) == 'available_item_list' || $this->uri->segment(2) == 'item_register' || $this->uri->segment(2) == 'product_report' || $this->uri->segment(2) == 'add_item' || $this->uri->segment(2) == 'search_item' || $this->uri->segment(2) == 'item_detail' || $this->uri->segment(2) == 'assign_item' ? '' : 'display: none;' ?>">
				<li class="is-size-7"><a href="<?= base_url('admin/item_register'); ?>"><i class="fas fa-list mr-1"></i> Items List</a></li>
				<li class="is-size-7"><a href="<?= base_url('admin/available_item_list'); ?>"><i class="far fa-list-alt mr-1"></i> Available List</a></li>
				<li class="is-size-7"><a href="<?= base_url('admin/get_assign_item'); ?>"><i class="fas fa-bars mr-1"></i> Assigned List</a></li>
				<li class="is-size-7"><a href="<?= base_url('admin/add_item'); ?>"><i class="fas fa-plus mr-1"></i> Add New</a></li>
			</ul>
		</li>

	</ul>
	<ul class="menu-list">
		<!-- <li><a href="<?= base_url('Purchase/purchase_order_list') ?>">Purchase</a></li> -->
	</ul>
	<ul class="menu-list">
		<!-- <li><a href="<?= base_url('admin/asset_register') ?>">Asset Register</a></li> -->
	</ul>
	<ul class="menu-list">
		<!-- <li><a href="<?= base_url('admin/maintenance') ?>">Maintenance</a></li> -->
	</ul>
	<ul class="menu-list">
		<!-- <li><a href="<?= base_url('admin/contact_list') ?>">Contact List</a></li> -->
	</ul>
	<p class="menu-label">
		Control
	</p>
	<ul class="menu-list">
		<!-- <li><a href="<?= base_url('admin') ?>">Dashboard</a></li> -->
		<li><a href="<?= base_url('login/logout') ?>">Logout</a></li>
	</ul>
	<!-- <ul class="menu-list">
			<li><a><b class="has-text-grey">Travel</b> Requests <span class="tag is-info is-light">2</span></a></li>
		</ul> -->
</aside>
