@extends('user.main')
@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-3">
             <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-body iq-box-relative">
                   <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-primary">
                      <i class="ri-focus-2-line"></i>
                   </div>
                   <p class="text-secondary">Total Sales</p>
                   <div class="d-flex align-items-center justify-content-between">
                      <h4><b>$18 378</b></h4>
                      <div id="iq-chart-box1"></div>
                      <span class="text-primary"><b> +14% <i class="ri-arrow-up-fill"></i></b></span>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
             <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-body iq-box-relative">
                   <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-danger">
                      <i class="ri-pantone-line"></i>
                   </div>
                   <p class="text-secondary">Sales Today</p>
                   <div class="d-flex align-items-center justify-content-between">
                      <h4><b>$190</b></h4>
                      <div id="iq-chart-box2"></div>
                      <span class="text-danger"><b> -6% <i class="ri-arrow-down-fill"></i></b></span>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
             <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-body iq-box-relative">
                   <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-success">
                      <i class="ri-database-2-line"></i>
                   </div>
                   <p class="text-secondary">Total Classon</p>
                   <div class="d-flex align-items-center justify-content-between">
                      <h4><b>45</b></h4>
                      <div id="iq-chart-box3"></div>
                      <span class="text-success"><b> +0.36% <i class="ri-arrow-up-fill"></i></b></span>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3">
             <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-body iq-box-relative">
                   <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-warning">
                      <i class="ri-pie-chart-2-line"></i>
                   </div>
                   <p class="text-secondary">Total Profit</p>
                   <div class="d-flex align-items-center justify-content-between">
                      <h4><b>60</b></h4>
                      <div id="iq-chart-box4"></div>
                      <span class="text-warning"><b> +0.45% <i class="ri-arrow-up-fill"></i></b></span>
                   </div>
                </div>
             </div>
          </div>
          
       </div>
    </div>
 </div>
@endsection