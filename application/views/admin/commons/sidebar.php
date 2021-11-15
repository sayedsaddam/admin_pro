<aside class="section is-narrow-mobile is-hidden-mobile" id="categories">
	<p class="menu-label">
		General
	</p>
	<ul class="menu-list">
		<!-- <li><a class="<?= $this->uri->segment(2) == 'dashboard' ? 'is-primary is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'dashboard' ? 'style="background-color:#f1f1f1;"' : '' ?>>Dashboard</a>
			<ul class="sub-categories"
				style="<?= $this->uri->segment(2) == 'dashboard' ? '' : 'display: none;' ?>">
			</ul>
		</li> -->
		<li><a class="<?= $this->uri->segment(2) == 'dashboard' ? 'is-primary is-inverted' : '' ?>" href="<?= base_url('admin/dashboard') ?>" <?= $this->uri->segment(2) == 'dashboard' ? 'style="background-color:#f1f1f1;"' : '' ?>>Dashboard</a></li>
	</ul>
	<p class="menu-label">
		Procurement
	</p>
	<?php if($AssetsAccess->read == 1) : ?>
	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'asset_register' || $this->uri->segment(2) == 'asset_detail' || $this->uri->segment(2) == 'search_asset_register' || $this->uri->segment(2) == 'add_asset' ? 'is-primary is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'asset_register' || $this->uri->segment(2) == 'asset_detail' || $this->uri->segment(2) == 'search_asset_register' || $this->uri->segment(2) == 'add_asset' ? 'style="background-color:#f1f1f1;"' : '' ?>>Assets</a>
			<ul class="sub-categories"
				style="<?= $this->uri->segment(2) == 'asset_register' || $this->uri->segment(2) == 'asset_detail' || $this->uri->segment(2) == 'search_asset_register' || $this->uri->segment(2) == 'add_asset' ? '' : 'display: none;' ?>">
				<li class="is-size-7 <?= $this->uri->segment(2) == 'asset_register' || $this->uri->segment(2) == 'asset_detail' || $this->uri->segment(2) == 'search_asset_register' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/asset_register'); ?>"><i class="fas fa-list mr-1"></i>
						Assets List</a></li>
				<?php if($AssetsAccess->write == 1) : ?>
				<li class="is-size-7 <?= $this->uri->segment(2) == 'add_asset' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/add_asset'); ?>"><i class="fas fa-plus mr-1"></i>
						Add New</a></li>
				<?php endif ?>
			</ul>
		</li>
	</ul>
	<?php endif ?>
	<?php if($SuppliersAccess->read == 1) : ?>
	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'suppliers' || $this->uri->segment(2) == 'search_suppliers' || $this->uri->segment(2) == 'add_supplier' || $this->uri->segment(2) == 'edit_supplier' ? 'is-primary is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'suppliers' || $this->uri->segment(2) == 'search_suppliers' || $this->uri->segment(2) == 'add_supplier' || $this->uri->segment(2) == 'edit_supplier' ? 'style="background-color:#f1f1f1;"' : '' ?>>Suppliers</a>
			<ul class="sub-categories"
				style="<?= $this->uri->segment(2) == 'suppliers' || $this->uri->segment(2) == 'search_suppliers' || $this->uri->segment(2) == 'add_supplier' || $this->uri->segment(2) == 'edit_supplier' ? '' : 'display: none;' ?>">
				<li class="is-size-7 <?= $this->uri->segment(2) == 'suppliers' || $this->uri->segment(2) == 'search_suppliers' || $this->uri->segment(2) == 'edit_supplier' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/suppliers'); ?>"><i class="fas fa-list mr-1"></i>
						Suppliers List</a></li>
				<?php if($SuppliersAccess->write == 1) : ?>
				<li class="is-size-7 <?= $this->uri->segment(2) == 'add_supplier' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/add_supplier'); ?>"><i class="fas fa-plus mr-1"></i>
						Add New</a></li>
				<?php endif ?>
			</ul>
		</li>
	</ul>
	<?php endif ?>
	<?php if($EmployeesAccess->read == 1) : ?>
	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'employee' || $this->uri->segment(2) == 'search_employ' || $this->uri->segment(2) == 'add_employee' || $this->uri->segment(2) == 'edit_employ' ? 'is-primary is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'employee' || $this->uri->segment(2) == 'search_employ' || $this->uri->segment(2) == 'add_employee' || $this->uri->segment(2) == 'edit_employ' ? 'style="background-color:#f1f1f1;"' : '' ?>>Employees</a>
			<ul class="sub-categories"
				style="<?= $this->uri->segment(2) == 'employee' || $this->uri->segment(2) == 'search_employ' || $this->uri->segment(2) == 'add_employee' || $this->uri->segment(2) == 'edit_employ' ? '' : 'display: none;' ?>">
				<li class="is-size-7 <?= $this->uri->segment(2) == 'employee' || $this->uri->segment(2) == 'search_employ' || $this->uri->segment(2) == 'edit_employ' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/employee'); ?>"><i class="fas fa-list mr-1"></i>
						Employees List</a></li>
				<li class="is-size-7 <?= $this->uri->segment(2) == 'add_employee' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/add_employee'); ?>"><i class="fas fa-plus mr-1"></i>
						Add New</a></li>
			</ul>
		</li>
	</ul>
	<?php endif ?>
	<?php if($CategoriesAccess->read == 1) : ?>
	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'categories' || $this->uri->segment(2) == 'sub_categories' || $this->uri->segment(2) == 'search_sub_categories' || $this->uri->segment(2) == 'search_categories' ? 'is-primary is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'categories' || $this->uri->segment(2) == 'sub_categories' || $this->uri->segment(2) == 'search_sub_categories' || $this->uri->segment(2) == 'search_categories' ? 'style="background-color:#f1f1f1;"' : '' ?>>Item
				Categories</a>
			<ul class="sub-categories"
				style="<?= $this->uri->segment(2) == 'categories' || $this->uri->segment(2) == 'sub_categories' || $this->uri->segment(2) == 'search_sub_categories' || $this->uri->segment(2) == 'search_categories' ? '' : 'display: none;' ?>">
				<li class="is-size-7 <?= $this->uri->segment(2) == 'categories' || $this->uri->segment(2) == 'sub_categories' || $this->uri->segment(2) == 'search_sub_categories' || $this->uri->segment(2) == 'search_categories' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/categories'); ?>"><i class="fas fa-list mr-1"></i>
						Categories List</a></li>
			</ul>
		</li>
	</ul>
	<?php endif ?>
	<?php if($RegisterAccess->read == 1) : ?>
	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'get_assign_item' || $this->uri->segment(2) == 'available_item_list' || $this->uri->segment(2) == 'item_register' || $this->uri->segment(2) == 'product_report' || $this->uri->segment(2) == 'add_item' || $this->uri->segment(2) == 'search_item' || $this->uri->segment(2) == 'item_detail' || $this->uri->segment(2) == 'damaged_item'  || $this->uri->segment(2) == 'assign_item' ? 'is-primary is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'get_assign_item' || $this->uri->segment(2) == 'available_item_list' || $this->uri->segment(2) == 'item_register' || $this->uri->segment(2) == 'product_report' || $this->uri->segment(2) == 'add_item' || $this->uri->segment(2) == 'search_item' || $this->uri->segment(2) == 'item_detail'|| $this->uri->segment(2) == 'damaged_item' || $this->uri->segment(2) == 'assign_item' ? 'style="background-color:#f1f1f1;"' : '' ?>>Item
				Register</a>
			<ul class="sub-categories"
				style="<?= $this->uri->segment(2) == 'get_assign_item' || $this->uri->segment(2) == 'available_item_list' || $this->uri->segment(2) == 'item_register' || $this->uri->segment(2) == 'product_report' || $this->uri->segment(2) == 'add_item' || $this->uri->segment(2) == 'damaged_item' || $this->uri->segment(2) == 'search_item' || $this->uri->segment(2) == 'item_detail' || $this->uri->segment(2) == 'assign_item' ? '' : 'display: none;' ?>">
				<li class="is-size-7 <?= $this->uri->segment(2) == 'item_register' || $this->uri->segment(2) == 'product_report' || $this->uri->segment(2) == 'damaged_item' || $this->uri->segment(2) == 'search_item' || $this->uri->segment(2) == 'item_detail' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/item_register'); ?>"><i class="fas fa-list mr-1"></i>
						Items List</a></li>
				<li class="is-size-7 <?= $this->uri->segment(2) == 'available_item_list' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/available_item_list'); ?>"><i
							class="far fa-list-alt mr-1"></i> Available List</a></li>
				<li class="is-size-7 <?= $this->uri->segment(2) == 'get_assign_item' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/get_assign_item'); ?>"><i
							class="fas fa-bars mr-1"></i> Assigned List</a></li>
				<li class="is-size-7 <?= $this->uri->segment(2) == 'damaged_item' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/get_damaged_item'); ?>"><i
							class="fas fa-unlink mr-1"></i> Damaged Item</a></li>
				<li class="is-size-7 <?= $this->uri->segment(2) == 'add_item' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/add_item'); ?>"><i class="fas fa-plus mr-1"></i> Add
						New</a></li>
			</ul>
		</li>
	</ul>
	<?php endif ?> 

	<?php if($RegisterAccess->read == 1) : ?>
	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'projects' || $this->uri->segment(2) == 'search_project' || $this->uri->segment(2) == 'add_project' || $this->uri->segment(2) == 'edit_project' ? 'is-primary is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'projects' || $this->uri->segment(2) == 'search_project' || $this->uri->segment(2) == 'add_project' || $this->uri->segment(2) == 'edit_project' ? 'style="background-color:#f1f1f1;"' : '' ?>>Projects</a>
			<ul class="sub-categories"
				style="<?= $this->uri->segment(2) == 'projects' || $this->uri->segment(2) == 'search_project' || $this->uri->segment(2) == 'add_project' || $this->uri->segment(2) == 'edit_project' ? '' : 'display: none;' ?>">
				<li class="is-size-7 <?= $this->uri->segment(2) == 'projects' || $this->uri->segment(2) == 'search_project' || $this->uri->segment(2) == 'edit_project' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/projects'); ?>"><i class="fas fa-list mr-1"></i>
						Projects List</a></li>
				<li class="is-size-7 <?= $this->uri->segment(2) == 'add_project' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/add_project'); ?>"><i class="fas fa-plus mr-1"></i>
						Add New</a></li>
			</ul>
		</li>
	</ul>
	<?php endif ?>


	<?php if($AssetsAccess->read == 1) : ?>
	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'add_invoice' || $this->uri->segment(2) == 'invoices' || $this->uri->segment(2) == 'search_invoice' || $this->uri->segment(2) == 'add_invoice' ? 'is-primary is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'add_invoice' || $this->uri->segment(2) == 'invoices' || $this->uri->segment(2) == 'search_invoice' || $this->uri->segment(2) == 'invoices' ? 'style="background-color:#f1f1f1;"' : '' ?>>Invoices</a>
			<ul class="sub-categories"
				style="<?= $this->uri->segment(2) == 'add_invoice' || $this->uri->segment(2) == 'invoices' || $this->uri->segment(2) == 'search_invoice' || $this->uri->segment(2) == 'add_asset' ? '' : 'display: none;' ?>">
				<li class="is-size-7 <?= $this->uri->segment(2) == 'add_invoice' || $this->uri->segment(2) == 'invoices' || $this->uri->segment(2) == 'search_invoice' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/invoices'); ?>"><i class="fas fa-list mr-1"></i>
						Invoices</a></li>
				<?php if($AssetsAccess->write == 1) : ?>
				<li class="is-size-7 <?= $this->uri->segment(2) == 'add_invoice' ? 'has-text-weight-bold' : '' ?>"><a href="<?= base_url('admin/add_invoice'); ?>"><i class="fas fa-plus mr-1"></i>
						Add New</a></li>
				<?php endif ?>
			</ul>
		</li>
	</ul>
	<?php endif ?>

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
		<li><a href="<?= base_url('login/logout') ?>" data-no-instant>Logout</a></li>
	</ul>
	<!-- <ul class="menu-list">
			<li><a><b class="has-text-grey">Travel</b> Requests <span class="tag is-info is-light">2</span></a></li>
		</ul> -->
</aside>
