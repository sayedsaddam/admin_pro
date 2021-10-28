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
									<span>Admin Controlled Logics</span>
								</a>
							</p>
						</div>
					</div>
				</div>
                <form class="card" method="POST" action="<?= base_url('admin/update_asset_access') ?>">
                    <header class="card-header">
                        <p class="card-header-title">
                        Assets Read/Write Access
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
                                    If you need to enable or disable the access for Assets, this is where you do it.
                                </div>                            
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <fieldset>
                                        <div class="field">
                                            <label class="label">Access for Users <span class="has-text-danger">*</span></label>
                                            <div class="control">
                                                <label class="radio">
                                                    <input type="radio" name="USER_ASSET_ACCESS" <?= $ACCESS["USER_ASSET_ACCESS"] == 1 ? 'checked' : '' ?> value=1>
                                                    Enable
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="USER_ASSET_ACCESS" <?= $ACCESS["USER_ASSET_ACCESS"] == 0 ? 'checked' : '' ?> value=0>
                                                    Disable
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="column">
                                    <fieldset>
                                        <div class="field">
                                            <label class="label">Access for Supervisors <span class="has-text-danger">*</span></label>
                                            <div class="control">
                                                <label class="radio">
                                                    <input type="radio" name="SUPERVISOR_ASSET_ACCESS" <?= $ACCESS["SUPERVISOR_ASSET_ACCESS"] == 1 ? 'checked' : '' ?> value=1>
                                                    Enable
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="SUPERVISOR_ASSET_ACCESS" <?= $ACCESS["SUPERVISOR_ASSET_ACCESS"] == 0 ? 'checked' : '' ?> value=0>
                                                    Disable
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="column">
                                    <fieldset>
                                        <div class="field">
                                            <label class="label">Access for Everyone <span class="has-text-danger">*</span></label>
                                            <div class="control">
                                                <label class="radio">
                                                    <input type="radio" name="EVERYONE_ASSET_ACCESS" <?= $ACCESS["USER_ASSET_ACCESS"] == 1 && $ACCESS["SUPERVISOR_ASSET_ACCESS"] == 1 ? 'checked' : '' ?> value=1>
                                                    Enable
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="EVERYONE_ASSET_ACCESS" <?= $ACCESS["USER_ASSET_ACCESS"] == 0 || $ACCESS["SUPERVISOR_ASSET_ACCESS"] == 0 ? 'checked' : '' ?> value=0>
                                                    Disable
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
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
        if ($('input:radio[name="USER_ASSET_ACCESS"][value=1]').is(":checked") && $('input:radio[name="SUPERVISOR_ASSET_ACCESS"][value=1]').is(":checked")) {
            $("input:radio[name='EVERYONE_ASSET_ACCESS']").prop('disabled',false);
            $("input:radio[name='EVERYONE_ASSET_ACCESS'][value=1]").prop('checked',true);
        } else if ($('input:radio[name="USER_ASSET_ACCESS"][value=0]').is(":checked") && $('input:radio[name="SUPERVISOR_ASSET_ACCESS"][value=0]').is(":checked")) {
            $("input:radio[name='EVERYONE_ASSET_ACCESS']").prop('disabled',false);
            $("input:radio[name='EVERYONE_ASSET_ACCESS'][value=1]").prop('checked',false);
                $("input:radio[name='USER_ASSET_ACCESS']").prop('disabled',true);
                $("input:radio[name='SUPERVISOR_ASSET_ACCESS']").prop('disabled',true);
        } else {
            $("input:radio[name='EVERYONE_ASSET_ACCESS']").prop('disabled',true);
            $("input:radio[name='EVERYONE_ASSET_ACCESS'][value=1]").prop('checked',false);
        };

        $('input:radio[name="EVERYONE_ASSET_ACCESS"]').change(function(){
            if ($('input:radio[name="EVERYONE_ASSET_ACCESS"][value=1]').is(":checked")) {
                $("input:radio[name='USER_ASSET_ACCESS'][value=1]").prop('checked',true);
                $("input:radio[name='SUPERVISOR_ASSET_ACCESS'][value=1]").prop('checked',true);
                $("input:radio[name='USER_ASSET_ACCESS']").prop('disabled',false);
                $("input:radio[name='SUPERVISOR_ASSET_ACCESS']").prop('disabled',false);
            } else {
                $("input:radio[name='USER_ASSET_ACCESS'][value=0]").prop('checked',true);
                $("input:radio[name='SUPERVISOR_ASSET_ACCESS'][value=0]").prop('checked',true);
                $("input:radio[name='USER_ASSET_ACCESS']").prop('disabled',true);
                $("input:radio[name='SUPERVISOR_ASSET_ACCESS']").prop('disabled',true);
            }
        });
        
        $('input:radio[name="USER_ASSET_ACCESS"]').change(function() {
            if ($('input:radio[name="USER_ASSET_ACCESS"][value=1]').is(":checked") && $('input:radio[name="SUPERVISOR_ASSET_ACCESS"][value=1]').is(":checked")) {
                $("input:radio[name='EVERYONE_ASSET_ACCESS'][value=1]").prop('checked',true);
                $("input:radio[name='EVERYONE_ASSET_ACCESS']").prop('disabled',false);
            } else {
                $("input:radio[name='EVERYONE_ASSET_ACCESS'][value=0]").prop('checked',true);
                $("input:radio[name='EVERYONE_ASSET_ACCESS']").prop('disabled',true);
            };
        })

        $('input:radio[name="SUPERVISOR_ASSET_ACCESS"]').change(function() {
            if ($('input:radio[name="SUPERVISOR_ASSET_ACCESS"][value=1]').is(":checked") && $('input:radio[name="USER_ASSET_ACCESS"][value=1]').is(":checked")) {    
                $("input:radio[name='EVERYONE_ASSET_ACCESS'][value=1]").prop('checked',true);
                $("input:radio[name='EVERYONE_ASSET_ACCESS']").prop('disabled',false);
            } else {
                $("input:radio[name='EVERYONE_ASSET_ACCESS'][value=0]").prop('checked',true);
                $("input:radio[name='EVERYONE_ASSET_ACCESS']").prop('disabled',true);
            };
        })
    })
</script>