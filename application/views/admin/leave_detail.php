<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <!-- Card -->
            <div class="card">
                <!-- Card content -->
                <div class="card-body">
                    <h1 class="font-weight-bold text-center mb-0">CHIP Training & Consulting (Pvt.) Ltd.</h1>
                    <h2 class="font-weight-light text-center mb-0">Islamabad, 44000</h2>
                    <h3 class="font-weight-lighter text-center mb-5">Employee Leave Application</h3>
                    <hr class="mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <p>ID</p>
                        </div>
                        <div class="col-md-6">
                            <p><?= 'CTC-00-'.$leave->id;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Employee Name</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$leave->fullname;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>From</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=date('l, M d, Y', strtotime($leave->leave_from));?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>To</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=date('l, M d, Y', strtotime($leave->leave_to));?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>No. of Days</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$leave->no_of_days;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Reson for Leave</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$leave->leave_reason;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Supervisor Remarks</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$leave->sup_remarks;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Leave Status</p>
                        </div>
                        <div class="col-md-6">
                            <p><?php if($leave->leave_status == 1){echo 'Approved <i class="fas fa-check"></i>'; }else{ echo 'Rejected <i class="fas fa-times"></i>'; } ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Application Date</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=date('l, M d, Y', strtotime($leave->created_at));?></p>
                        </div>
                    </div>
                    <br><br><br><br>
                    <div class="row mb-5 pt-5 mt-5">
                        <div class="col-6">
                            <span>Verified By: ____________________<br> Sr. HR & Admin Officer</span>
                        </div>
                        <div class="col-6 text-right">

                            <span>Approved By: _____________________<br> Managing Director</span>
                        </div>
                    </div>
                    <!-- Button -->
                    <a href="#" class="btn btn-primary d-print-none" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
                    <a href="javascript:history.go(-1)" class="btn btn-outline-danger d-print-none"><i class="fa fa-angle-left"></i> back</a>
                </div>
            </div>
            <!-- Card -->
        </div>
    </div>
</div>