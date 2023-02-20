
@extends('user.main')
@section('title', 'My vCard - vCards.pk')

@section('styles')
@endsection

@push('css')
@endpush



@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">My Card</h4>
                            </div>
                        </div>
                        <div class="iq-card-body px-4">

                         

                            <div class="table-responsive">
                            
                                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Status</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                            
                                        <tr>
                                            <td>Card</td>
                                            <td>{{ auth()->user()->order?'Applied':'Not Applied' }}</td>
                                          
                                        </tr>
                                       
                                    
                                      
                                    </tbody>
                                </table>
                            </div>

                         
                             
                           
                                <div class="row text-right">
                                    @if(!auth()->user()->order)
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Apply Now</button>
                                   
                                    </div>
                                    @endif

                                </div>
                           
                        </div>
                    </div>
                </div>




                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Card Status</h4>
                            </div>
                        </div>
                        <div class="iq-card-body px-4">



                            <div class="table-responsive">
                            
                                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                            @if (auth()->user()->order)
                            @foreach(auth()->user()->order->comments as $comment)
                            <tr>
                                <td>{{$comment->comment}}</td>
                                <td>{{ $comment->status}}</td>
                                <td>{{ date('Y-m-d H:i:s',strtotime($comment->created_at))}} </td>
                              
                            </tr>
                           @endforeach
                            @endif
                                        
                                    
                                      
                                    </tbody>
                                </table>
                            </div>

                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <form action="{{route('order.place')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                       <h5 class="modal-title">Card Application</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                       </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                          <div class="col-md-6 col-sm-12 mb-3">
                              <label for="first_name" class="required">First Name</label>
                              <input type="text" required class="form-control required" id="first_name" name="first_name"
                                  placeholder="John" value="{{auth()->user()->last_name}}">
                          </div>
              
                          <div class="col-md-6 col-sm-12 mb-3">
                              <label for="last_name" class="required">Last Name</label>
                              <input type="text" required class="form-control required" id="last_name" name="last_name"
                                  placeholder="Doe" value="{{auth()->user()->last_name}}">
                          </div>
                          <div class="col-md-6 col-sm-12 mb-3">
                              <label for="email" class="required">Email</label>
                              <input type="text" required class="form-control required" id="email" name="email"
                                  placeholder="Doe" value="{{auth()->user()->email}}">
                          </div>
      
                          <div class="col-md-6 col-sm-12 mb-3">
                              <label for="phone" class="required">Phone</label>
                              <input type="text" required class="form-control required" id="phone" name="phone"
                                  placeholder="+92 311 1122334" value="{{auth()->user()->profile->phone}}">
                          </div>
      
                          <div class="col-md-6 col-sm-12 mb-3">
                              <label for="type" class="required">Card Type</label>
                             <select name="type" id="" class="form-control">
                              <option value="Normal">Normal</option>
                              <option value="Metal">Metal</option>
                              <option value="Custom">Custom</option>
                             </select>
                          </div>
                          
                      </div>
                      <div class="row">
                          <div class="col-md-12 col-sm-12 mb-3">
                          <label for="phone" class="required">Delivery Address</label>
                          <textarea  required class="form-control required" id="delivery_address" name="delivery_address"
                              placeholder="Delivery Address"></textarea>
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-primary">Place Order</button>
                    </div>
                 </div>
            </form>
         
        </div>
     </div>
@endsection


@section('scripts')

@endsection

@push('js')
@endpush
