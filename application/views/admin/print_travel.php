<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 text-center mb-3">
        <small>[CTC-HR&OPS-Transportation-F-7.4-a-1/1]<br>[Travel and Hotel Stay Request Form <?= date('F, Y'); ?>]</small>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <!-- Card -->
            <div class="card">
                <!-- Card content -->
                <div class="card-body">
                    <h1 class="font-weight-bold text-center mb-0">AH Group of Companies (Pvt.) Ltd.</h1>
                    <h2 class="font-weight-light text-center mb-0">Islamabad, 44000</h2>
                    <h4 class="font-weight-lighter text-center mb-5">Travel and Hotel Stay Request Form</h4>
                    <hr class="mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Request Number</p>
                        </div>
                        <div class="col-md-6">
                            <p><?='CTC-'.date('mY').'-'.$travel->id;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Requested By</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$travel->fullname;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Assignment</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$travel->assignment;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Place of Visit</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=ucfirst($travel->place_of_visit);?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Visit Start Date</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=date('M d, Y', strtotime($travel->visit_date_start)); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Visit End Date</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=date('M d, Y', strtotime($travel->visit_date_end)); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Charge To</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$travel->charge_to;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Request Type</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= ucwords($travel->request_type); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Stay Request Type</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= ucwords($travel->stay_request_type); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Staying At</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=ucfirst($travel->staying_at); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Check In</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=date('M d, Y', strtotime($travel->check_in)); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Check Out</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=date('M d, Y', strtotime($travel->check_out)); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Payment Mode</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=ucfirst($travel->payment_mode); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Approximate Cash</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=number_format($travel->approx_cash); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Status</p>
                        </div>
                        <div class="col-md-6">
                            <p><?php if($travel->travel_status == 0){ echo 'Pending...'; }elseif($travel->travel_status == 1){ echo 'Approved.'; }else{ echo 'Rejected.'; } ?></p>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <p>Requested On</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=date('M d, Y', strtotime($travel->created_at)); ?></p>
                        </div>
                    </div>
                    <div class="row mb-5 pt-5">
                        <div class="col-4">
                            _________________<br>Employee Signature
                        </div>
                        <div class="col-4 text-center">
                            __________________<br>Admin & Procurement
                        </div>
                        <div class="col-4 text-right">
                            _________________<br>Supervisor Signature
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12 text-right">
                            <p>Printed by: <?= $this->session->userdata('fullname').' on <strong>'.date('M d, Y').'</strong> at <strong>'.date('H:i:s').'</strong>'; ?></p>
                        </div>
                    </div>
                    <br><br>
                    <!-- Button -->
                    <a href="#" class="btn btn-primary d-print-none" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
                    <a href="javascript:history.go(-1)" class="btn btn-outline-danger d-print-none"><i class="fa fa-angle-left"></i> back</a>
                </div>
            </div>
            <!-- Card -->
        </div>
    </div>
</div>