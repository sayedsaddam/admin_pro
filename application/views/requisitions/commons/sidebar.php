<div class="is-flex is-justify-content-center">
	<div class="mx-5 my-2">
		<img src="https://s2smark.com/assets/img/logo/s2s-logo-1.png" class="logo">
	</div>
</div>
<aside class="section py-4 is-narrow-mobile is-hidden-mobile" id="categories">
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
		<li><a class="<?= $this->uri->segment(2) == 'dashboard' ? 'is-primary is-inverted' : '' ?>"
				href="<?= base_url('requisitions/dashboard') ?>"
				<?= $this->uri->segment(2) == 'dashboard' ? 'style="background-color:#f1f1f1;"' : '' ?>>Dashboard</a>
		</li>
	</ul>
	<p class="menu-label">
		Requisition
	</p>
	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'request_list' || $this->uri->segment(2) == 'add_request' ? 'is-primary is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'request_list' || $this->uri->segment(2) == 'add_request' ? 'style="background-color:#f1f1f1;"' : '' ?>>Requests</a>
			<ul class="sub-categories"
				style="<?= $this->uri->segment(2) == 'request_list' || $this->uri->segment(2) == 'add_request' ? '' : 'display: none;' ?>">
				<li
					class="is-size-7 <?= $this->uri->segment(2) == 'request_list' ? 'has-text-weight-bold' : '' ?>">
					<a href="<?= base_url('requisitions/request_list'); ?>"><i class="fas fa-list mr-1"></i>
						Request List</a></li>
				<li
					class="is-size-7 <?= $this->uri->segment(2) == 'add_request' ? 'has-text-weight-bold' : '' ?>">
					<a href="<?= base_url('requisitions/add_request'); ?>"><i class="fas fa-plus mr-1"></i>
						Add Request</a></li>
			</ul>
		</li>
	</ul>
	
	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'approval_list' ? 'is-primary is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'approval_list' ? 'style="background-color:#f1f1f1;"' : '' ?>>Approval</a>
			<ul class="sub-categories"
				style="<?= $this->uri->segment(2) == 'approval_list' ? '' : 'display: none;' ?>">
				<li
					class="is-size-7 <?= $this->uri->segment(2) == 'approval_list' ? 'has-text-weight-bold' : '' ?>">
					<a href="<?= base_url('requisitions/approval_list'); ?>"><i class="fas fa-list mr-1"></i>
						Approval List</a></li>

					<li class="is-size-7 <?= $this->uri->segment(2) == 'quotation_list' ? 'has-text-weight-bold' : '' ?>">
					<a href="<?= base_url('requisitions/quotation_list'); ?>"><i class="fa fa-question-circle mr-1" aria-hidden="true"></i>
						Qutotation</a></li>			
			</ul>
		</li>
	</ul>

	<ul class="menu-list">
		<li><a class="<?= $this->uri->segment(2) == 'user_asset_list' ? 'is-primary is-inverted' : '' ?> nav-category"
				<?= $this->uri->segment(2) == 'user_asset_list' ? 'style="background-color:#f1f1f1;"' : '' ?>>My Assets</a>
			<ul class="sub-categories"
				style="<?= $this->uri->segment(2) == 'user_asset_list' || $this->uri->segment(2) == 'Asset List' ? '' : 'display: none;' ?>">
				<li
					class="is-size-7 <?= $this->uri->segment(2) == 'user_asset_list' ? 'has-text-weight-bold' : '' ?>">
					<a href="<?= base_url('requisitions/user_asset_list'); ?>"><i class="fas fa-list mr-1"></i>
						Asset List</a></li>
			</ul>
		</li>
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
