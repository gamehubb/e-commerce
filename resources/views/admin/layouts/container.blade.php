<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/auth/dashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
    </div>

    <div class="row mb-3">
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Products</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$products}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Annual) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Orders</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$orders}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-shopping-cart fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- New User Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">User</div>
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$users}}</div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <span class="text-muted mr-2">Vendors: {{$vendors}}</span>
                </div>
              </div>
              
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Verifications</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending}}</div>

              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Area Chart -->
      <div class="col-xl-8 col-lg-7">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
            <div class="dropdown no-arrow">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Dropdown Header:</div>
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myAreaChart"></canvas>
            </div>
          </div>
        </div>
      </div>
      <!-- Pie Chart -->
      <div class="col-xl-4 col-lg-5">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
            {{-- <div class="dropdown no-arrow">
              <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Month <i class="fas fa-chevron-down"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Select Periode</div>
                <a class="dropdown-item" href="#">Today</a>
                <a class="dropdown-item" href="#">Week</a>
                <a class="dropdown-item active" href="#">Month</a>
                <a class="dropdown-item" href="#">This Year</a>
              </div>
            </div> --}}
          </div>
          <div class="card-body">
            @foreach($sold_products as $s_d)
              <div class="mb-3">
                <div class="small text-gray-500">{{$s_d->products->name}}
                  <div class="small float-right"><b>{{$s_d->quantity}}</b></div>
                </div>
                <div class="progress" style="height: 12px;">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: {{$s_d->quantity}}%" aria-valuenow={{$s_d->quantity}}
                    aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            @endforeach
           
          </div>
          {{-- <div class="card-footer text-center">
            <a class="m-0 small text-primary card-link" href="#">View More <i
                class="fas fa-chevron-right"></i></a>
          </div> --}}
        </div>
      </div>
      <!-- Invoice Example -->
      <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
            <a class="m-0 float-right btn btn-danger btn-sm" href="{{route('user.orders')}}">View More <i
                class="fas fa-chevron-right"></i></a>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Voucher</th>
                  <th>Customer</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($order_data as $order)
                  <tr>
                    <td><a href="#">{{$order->voucher_code}}</a></td>
                    <td>{{$order->del_name}}</td>
                    <td>{{number_format($order->total_amount)}}</td>
                    <td>
                    @switch($order->status)
                      @case('1')
                          <span class="text-light badge badge-primary">Pending</span>
                          @break
                      @case('2')
                          <span class="text-info">Approved</span>
                          @break
                      @case('3')
                          <span class="text-success">Completed</span>
                          @break
                      @case('4')
                          <span class="text-warning">Declined</span>
                          @break
                      @case('5')
                          <span class="text-danger">Cancelled</span>
                          @break
                  
                      @default
                    @endswitch<br>
                    <small class="text-muted">{{$order->updated_at->diffForHumans()}}</small>
                    </td>
                    <td><a href="{{route('user.order',[$order->id])}}" class="btn btn-sm btn-primary">Detail</a></td>
                  </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
      <!-- Message From Customer-->
      {{-- <div class="col-xl-4 col-lg-5 ">
        <div class="card">
          <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-light">Message From Customer</h6>
          </div>
          <div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Hi there! I am wondering if you can help me with a
                  problem I've been having.</div>
                <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok · 58m</div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a href="#">
                <div class="text-truncate message-title">But I must explain to you how all this mistaken idea
                </div>
                <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                </div>
                <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau · 25m</div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">At vero eos et accusamus et iusto odio dignissimos
                  ducimus qui blanditiis
                </div>
                <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang · 54m</div>
              </a>
            </div>
            <div class="card-footer text-center">
              <a class="m-0 small text-primary card-link" href="#">View More <i
                  class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </div>
      </div> --}}
      {{-- <span id="months_data">{{json_encode($monthly_amount['months'])}}</span>
      <span id="chart_data">{{json_encode($monthly_amount['data'])}}</span> --}}

    </div>

    @foreach ($monthly_amount as $i => $ma)
      
      <?php $months = str_replace('"','',json_encode($monthly_amount[$i]['months'])); ?>

      <?php $data = str_replace('"','',json_encode($monthly_amount[$i]['data'])); ?>

      <span id="months" hidden><?php echo $months.','; ?></span>

      <span id="data" hidden><?php echo $data.','; ?></span>

    @endforeach
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