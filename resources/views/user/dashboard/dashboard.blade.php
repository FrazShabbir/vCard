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
                   <p class="text-secondary">Total Reach</p>
                   <div class="d-flex align-items-center justify-content-between">
                      <h4><b>{{auth()->user()->reach}}</b></h4>
                      {{-- <div id="iq-chart-box1"></div> --}}
                      {{-- <span class="text-primary"><b> +14% <i class="ri-arrow-up-fill"></i></b></span> --}}
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
                   <p class="text-secondary">Visitors</p>
                   <div class="d-flex align-items-center justify-content-between">
                      <h4><b>{{auth()->user()->count}}</b></h4>
                      {{-- <div id="iq-chart-box2"></div>
                      <span class="text-danger"><b> -6% <i class="ri-arrow-down-fill"></i></b></span> --}}
                   </div>
                </div>
             </div>
          </div>
          @if (auth()->user()->vcard)
             
         
          <div class="col-sm-6 col-md-6 col-lg-3">
             <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                <div class="iq-card-body iq-box-relative">
                   <div class="iq-box-absolute icon iq-icon-box rounded-circle iq-bg-success">
                      <i class="ri-database-2-line"></i>
                   </div>
                   <p class="text-secondary">Card Number</p>
                   <div class="d-flex align-items-center justify-content-between">
                      <h4><b>{{auth()->user()->vcard[0]->card_number}}</b></h4>
                      {{-- <div id="iq-chart-box3"></div>
                      <span class="text-success"><b> +0.36% <i class="ri-arrow-up-fill"></i></b></span> --}}
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
                   <p class="text-secondary">Card Expiry</p>
                   <div class="d-flex align-items-center justify-content-between">
                      <h4><b>{{date('d-M-Y',strtotime(auth()->user()->vcard[0]->expiry))}}</b></h4>
                      {{-- <div id="iq-chart-box4"></div>
                      <span class="text-warning"><b> +0.45% <i class="ri-arrow-up-fill"></i></b></span> --}}
                   </div>
                </div>
             </div>
          </div>

        

          @endif
          
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
               <div class="iq-card-body iq-box-relative">
             
                  <p class="text-secondary">My QR</p>
                  <div class="d-flex align-items-center justify-content-between text-center">
                     {!! QrCode::eye('circle')->size(200)->generate(env('APP_URL').auth()->user()->username); !!}
                  </div>
               </div>
            </div>
         </div>
       </div>
    </div>
 </div>
@endsection