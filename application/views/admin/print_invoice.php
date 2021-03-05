<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <!-- Card -->
            <div class="card">
                <!-- Card content -->
                <div class="card-body">
                    <h1 class="font-weight-bold text-center mb-0">CHIP Training & Consulting (Pvt.) Ltd.</h1>
                    <h2 class="font-weight-light text-center mb-0">Islamabad, 44000</h2>
                    <h3 class="font-weight-lighter text-center mb-5">Invoice</h3>
                    <hr class="mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Invoice Number</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$invoice->inv_no;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Project</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$invoice->project;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Vendor Name</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$invoice->vendor;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Region</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=ucfirst($invoice->region);?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Item Name</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$invoice->item;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Amount</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=number_format($invoice->amount);?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Description</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=$invoice->inv_desc;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Invoice Date</p>
                        </div>
                        <div class="col-md-6">
                            <p><?php if($invoice->inv_date){echo date('F d, Y', strtotime($invoice->inv_date)); }else{ echo '--/--/--'; } ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Invoice Status</p>
                        </div>
                        <div class="col-md-6">
                            <p><?php if($invoice->status == 0){echo "<span class='badge badge-warning'>pending</span>"; }else{ echo "<span class='badge badge-success'>cleared</span>"; } ?></p>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <p>Entry Date</p>
                        </div>
                        <div class="col-md-6">
                            <p><?=date('F d, Y', strtotime($invoice->created_at));?></p>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12 text-right">
                            <p>Printed by: <?= $this->session->userdata('fullname'); ?><br>************************</p>
                        </div>
                    </div>
                    <br><br><br><br><br>
                    <!-- Button -->
                    <a href="#" class="btn btn-primary d-print-none" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</a>
                    <a href="javascript:history.go(-1)" class="btn btn-outline-danger d-print-none"><i class="fa fa-angle-left"></i> back</a>
                </div>
            </div>
            <!-- Card -->
        </div>
    </div>
</div>