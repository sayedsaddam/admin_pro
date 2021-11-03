<?php $session = $this->session->userdata('user_role'); ?>
<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" id="custom-sidebar">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section">
				<div class="columns">
					<div class="column">
						<?php $this->view('admin/commons/breadcrumb'); ?>
					</div>
				</div>

				<div class="columns is-hidden-touch">
					<div class="column is-hidden-print">
						<form action="<?= base_url('admin/search_employ') ?>" method="get">
							<div class="field has-addons">
								<div class="control has-icons-left is-expanded">
									<input class="input is-small is-fullwidth" name="search" id="myInput" type="search"
										placeholder="Search Employees"
										value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" required>
									<span class="icon is-small is-left">
										<i class="fas fa-search"></i>
									</span>
								</div>
								<div class="control">
									<button class="button is-small" type="submit"><span class="icon is-small">
											<i class="fas fa-arrow-right"></i>
										</span>
									</button>
								</div>
							</div>
						</form>
					</div>
					<div class="column is-hidden-print is-narrow">
						<div class="field has-addons">
							<p class="control">
								<a href="<?= base_url("admin/employee") ?>"
									class="button is-small <?= (isset($acl_page)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Access Control List</span>
								</a>
							</p>
						</div>
					</div>
				</div>
                <form class="card" method="POST" action="<?= base_url('admin/update_asset_access') ?>">
                    <header class="card-header">
                        <p class="card-header-title">
                        Assets Access
                        </p>
                        <button class="card-header-icon" aria-label="more options">
                        <span class="icon">
                            <i class="fas fa-angle-down" aria-hidden="true"></i>
                        </span>
                        </button>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <div class="columns">
                                <div class="column">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Read</th>
                                                <th>Write</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($assets_access_list as $key => $assets_access_list) : ?>
                                                <tr>
                                                <th><?= $assets_access_list->title ?></th>
                                                <td><input type="checkbox" name="read[<?= $assets_access_list->component ?>][<?= $key + 1 ?>]" <?= $assets_access_list->read == 1 ? 'checked' : '' ?> value="1"></td>
                                                <td><input type="checkbox" name="write[<?= $assets_access_list->component ?>][<?= $key + 1 ?>]" <?= $assets_access_list->write == 1 ? 'checked' : '' ?> value="1"></td>
                                                <td><input type="checkbox" name="update[<?= $assets_access_list->component ?>][<?= $key + 1 ?>]" <?= $assets_access_list->update == 1 ? 'checked' : '' ?> value="1"></td>
                                                <td><input type="checkbox" name="delete[<?= $assets_access_list->component ?>][<?= $key + 1 ?>]" <?= $assets_access_list->delete == 1 ? 'checked' : '' ?> value="1"></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer">
                        <button type="submit" class="button card-footer-item">Save</button>
                        <button type="reset" class="button card-footer-item">Reset</button>
                    </footer>
                </form>
				
</section>

<script>
    $(document).ready(function() {
        
    })
</script>