<?php $session = $this->session->userdata('user_role'); ?>
<section class="columns is-gapless mb-0 pb-0">
	<div class="column is-narrow is-fullheight is-hidden-print" id="custom-sidebar">
		<?php $this->view('admin/commons/sidebar'); ?>
	</div>
	<div class="column">
		<div class="columns">
			<div class="column section py-5">
				<div class="columns">
					<div class="column">
						<?php $this->view('admin/commons/breadcrumb'); ?>
					</div>
				</div>

				<div class="columns is-hidden-touch">
                    <div class="column"></div>
					<div class="column is-hidden-print is-narrow">
						<div class="field has-addons">
							<p class="control">
								<a href="<?= base_url("admin/acl_component/") ?>"
								class="button is-small <?= (isset($acl_component)) ? 'has-background-primary-light' : '' ?>">
									<span class="icon is-small">
										<i class="fas fa-list"></i>
									</span>
									<span>Add Component</span>
								</a>
							</p>
						</div>
					</div> 
					<div class="column is-hidden-print is-narrow">
						<div class="field has-addons">
							<p class="control">
								<a href="<?= base_url("admin/acl/") ?>"
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

<!-- form  -->

<form action="<?php echo base_url('admin/add_component');?>" method="post">
					<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
					<div class="columns">
						<div class="column">
							<fieldset>
								<div class="field">
									<label class="label is-small">Title <span
											class="has-text-danger">*</span></label>
									<div class="control has-icons-left">
										<input type="text" name="title" id="" class="input is-small"
											value="" type="text"
											placeholder="Title ..." required="">
										<span class="icon is-small is-left">
											<i class="fas fa-pen"></i>
										</span>
									</div>
								</div>
							</fieldset>
						</div>
						<div class="column">
							<div class="control">
								<label class="label is-small">Type <span class="has-text-danger">*</span></label>
								<div class="control has-icons-left">
                                <input class="input is-small is-fullwidth" name="type" type="text"
										placeholder="component Type">
                                        <span class="icon is-small is-left">
										<i class="fas fa-random"></i>
									</span>
								</div>
							</div>
						</div> 

					</div>
                    
					<div class="columns">
						<div class="column has-text-right">
							<div class="buttons is-pulled-right">
								<?php if(!isset($edit_item)): ?>
								<button class="button is-danger is-small is-outlined" type="reset">Reset Form</button>
								<?php endif ?>
								<p class="control">
									<button class="button is-small is-success" type="submit"
										<?= isset($edit) && $AssetsAccess->update == 0 || $AssetsAccess->write == 0 ? 'disabled' : '' ?>>
										<span><?= !isset($edit_item) ? 'Save and continue' : 'Save Changes' ?></span>
										<span class="icon is-small">
											<i class="fas fa-arrow-right"></i>
										</span>
									</button>
								</p>
							</div>
						</div>
					</div>
				</form>
 
</section>

<style>
    .card-header-icon {
        transition:all 0.5s;    
    }   
    .card-content {
        display: none;
    }
    .rotate-90 {
        transform: rotate(180deg);
    }
</style>