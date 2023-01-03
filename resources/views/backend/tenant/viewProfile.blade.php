@extends('admin.admin_master')
@section('admin')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      

      <!-- Main content -->
      <section class="content">
        <div class="row">  

          <div class="col-12">

            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" >
                  <h3 class="widget-user-username">{{ $tenant->name }}</h3>
                  <h6 class="widget-user-desc"></h6>
                  <a href="{{route('profile.edit')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Edit Profile</a>
                </div>
                <div class="widget-user-image">
                    <!-- Condition for image upload or applying default -->
                  <img style="width: 90px; height: 90px;" class="rounded-circle" src="{{ (!empty($tenant->image))? url('upload/tenant_images/'.$tenant->image):url('upload/no_image.jpg') }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Mobile No.</h5>
                        <span class="description-text">{{ $tenant->mobile }}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 br-1 bl-1">
                      <div class="description-block">
                        <h5 class="description-header">Occupation</h5>
                        <span class="description-text">{{ $tenant->occupation }}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Email</h5>
                        <span class="description-text">{{ $tenant->email }}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>

              <div class="col-12">
                <div class="box">
                    <div class="box-header">
                      <a href="" style="float: right; margin-right:4px;"  class="btn btn-rounded btn-success mb-5">STATEMENT</a>
                      <a href="{{url('accounts/make_payment/'.$tenant->id)}}" style="float: right; margin-right:4px;" class="btn btn-rounded btn-success mb-5">RECEIPT</a>
                      <a href="" style="float: right; margin-right:4px;" class="btn btn-rounded btn-success mb-5">DOCUMENTS</a>
                      <a href="" style="float: right; margin-right:4px;" class="btn btn-rounded btn-success mb-5">INVOICE</a> 
                    </div>
                    <div class="box-body">

                      <table id="example1" class="table table-bordered table-striped">
                          <h5>Bills</h5>
                          <thead>
                              <tr>
                                  <th width="5%">SL</th>
                                  <th>Date</th>
                                  <th>Fee Type</th>
                                  <th>Bill Amount</th> 
                                  <th>Amount Paid</th>
                                  <th>Amount Due</th>
                                    
                              </tr>
                          </thead>
                          <tbody>
                              @if ($tenant->bills != null)
                                  @foreach ($tenant->bills as $key => $value)

                                  <tr>
                                      <td><a href="{{url('accounts/make_payment/'.$value->tenant_id)}}">{{ $key+1 }}</a></td> <!-- Use tenant/member id to access all the unpaid bills -->
                                      <td>{{ date('M-Y', strtotime($value->date)) }}</td> 
                                      <td> @if ($value->type == "other")
                                            @if($value->category != null)
                                              {{$value->category->name}}
                                            @endif
                                            @elseif ($value->type == "rent")
                                            Rent
                                          @endif
                                    </td>
                                      <td>{{ $value->amount }}</td>
                                      <td>{{ $value->totalAmountPaid($value->id) }}</td>
                                      <td>{{ $value->projectionBalance($value->id) }}</td>
                                      
                                      
                                  </tr> 
                                      
                                  @endforeach
                              
                                  
                              @endif
 
                              
                          </tbody>
                          
                        </table>
                      
                      <table id="example1" class="table table-bordered table-striped">
                          <h5>Receipts</h5>
                          <thead>
                              <tr>
                                  <th>Payment Mode</th>
                                  <th>Reference</th>
                                  <th>Date</th>
                                  <th>Amount</th> 
                                  <th>Document</th>
                                  
                              </tr>
                          </thead>
                          <tbody>
                              @if ($tenant->receipts != null)
                                  @foreach($tenant->receipts as $value)
                                      <!-- Add Receipt table -->
                                      <tr>
                                          
                                          <td>{{ $value->payMode }}</td>
                                          <td>{{ $value->reference }}</td>
                                          <td>{{ $value->regDate }}</td>
                                          <td>{{ $value->amount }}</td> 
                                          <td><a class="btn btn-sm btn-success"
                                              title = "Payslip" target = "_blank" href="{{url('tenant/receipts/'.$value->id)}}"
                                              >Receipt</a>
                                          </td>    
                                      </tr>   
                                  @endforeach
                              @endif
                              
                              
                              
                          </tbody>
                          
                        </table>
                    </div>
                </div>  
            </div>

           

            
            <!-- /.box -->          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>
<!-- /.content-wrapper -->
@endsection