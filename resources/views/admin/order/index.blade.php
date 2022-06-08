@extends ('admin.layouts.main')

@section ('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">All Orders</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Orders Tables</li>
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Voucher Number</th>
                  <th>Name</th>
                  {{-- <th>Email</th> --}}
                  <th>Date</th>
                  
                  <th>Order Status</th>
                  <th>Payment Status</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>View</th>
                </tr>
              </thead>
              <tbody>
                @if(count($orders) > 0)
                @foreach($orders as $key=>$order)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$order->voucher_code}}</td>
                  {{-- <td>{{$order->user->name}}</td> --}}
                  {{-- <td>{{$order->user->email}}</td> --}}
                  <td>{{date('d-M-y',strtotime($order->created_at))}}</td>
                  <td>
                    <input type="hidden" value="{{$order->id}}" id="order_id">
                    <select class="form-select form-select-sm" name="order_status" id="order_status" aria-label=".form-select-sm example">
                      <option value="" disabled selected>Select Status</option>
                      @if($order->status == 1)
                        <option value="1" selected> Pending </option>
                        <option value="2">Completed</option>
                        <option value="3">Approved</option>
                        <option value="4">Declined</option>
                        <option value="5">Cancelled</option>
                      @elseif($order->status == 2)
                        <option value="2" selected>Completed</option>
                        <option value="1"> Pending </option>
                        <option value="3">Approved</option>
                        <option value="4">Declined</option>
                        <option value="5">Cancelled</option>
                      @elseif($order->status == 3)
                        <option value="3" selected>Approved</option>
                        <option value="1"> Pending </option>
                        <option value="2">Completed</option>
                        <option value="4">Declined</option>
                        <option value="5">Cancelled</option>
                        @elseif($order->status == 4)
                        <option value="4" selected>Declined</option>
                        <option value="1"> Pending </option>
                        <option value="2">Completed</option>
                        <option value="3">Approved</option>
                        <option value="5">Cancelled</option>
                        @elseif($order->status == 5)
                        <option value="5" selected>Cancelled</option>
                        <option value="1"> Pending </option>
                        <option value="2">Completed</option>
                        <option value="3">Approved</option>
                        <option value="4">Declined</option>
                      @endif 
                    </select>
                  </td>
                  <td>
                    <input type="hidden" value="{{$order->id}}" id="order_id_forpayment">
                    <select class="form-select form-select-sm" name="payment_status" id="payment_status" aria-label=".form-select-sm example">
                      <option value="" disabled selected>Select Status</option>
                      @if($order->payment->status == 1)
                        <option value="1" selected> Partial Paid</option>
                        <option value="2">Full Paid</option>
                        <option value="3">Cash On</option>
                      @elseif($order->payment->status == 2)
                        <option value="1"> Partial Paid</option>
                        <option value="2" selected>Full Paid</option>
                        <option value="3">Cash On</option>
                      @elseif($order->payment->status == 3)
                        <option value="1"> Partial Paid</option>
                        <option value="2">Full Paid</option>
                        <option value="3" selected>Cash On</option>
                       @endif 
                    </select>
                  </td>
                  <td>
                    @if($order->payment->payment_type == '1_k')
                    <p>KPAY</p>
                    @elseif($order->payment->payment_type == '2_w')
                    <p>WAVEPAY</p>
                    @elseif($order->payment->payment_type == '3_c')
                    <p>COD</p>
                    @endif
                  </td>
                  <td>
                    {{$order->payment->total_amount}}
                  </td>
                  <td><a href="{{route('user.order',[$order->user_id,$order->id])}}"><button class="btn btn-info">View Order</button></a></td>
                  
                </tr>
                @endforeach
                @else
                  <td>No Orders to show.</td>
                @endif
               
                    
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
    <!--Row-->

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to logout?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
            <a href="login.html" class="btn btn-primary">Logout</a>
          </div>
        </div>
      </div>
    </div>

  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                } 
            });
    $('select[name="order_status"]').on('change',function(){
      var status = $(this).val();
      var orderid =$("#order_id").val();
      if(orderid && status){
        $.ajax({
          url: '/auth/orderstatus/'+orderid+'/'+status,
          type: "GET",
          dataType: "json",
          success:function(data){  
          alert('Status Changed');
          // notify()->success('Status Changed');
        }
        });
      }
    })
    $('select[name="payment_status"]').on('change',function(){
      var statuspayment = $(this).val();
      var orderidforpayment =$("#order_id_forpayment").val();
      if(orderidforpayment && statuspayment){
        $.ajax({
          url: '/auth/paymentstatus/'+orderidforpayment+'/'+statuspayment,
          type: "GET",
          dataType: "json",
          success:function(data){  
          alert('Status Changed');
          // notify()->success('Status Changed');
        }
        });
      }
    })
  });
</script>
@endsection
