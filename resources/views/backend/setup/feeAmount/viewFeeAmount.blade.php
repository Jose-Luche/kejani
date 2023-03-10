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

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Fee Category Amount List</h3>
                <a href="{{ route('fee.amount.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Add Fee Amount</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1"  class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>
                              
                              <th>Apartment</th>
                              <th>Fee Category</th>
                              <th>Amount</th>
                              
                              
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($allData as $key=> $amount)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                
                                <td>{{$amount->branch->name}}</td>
                                <td>{{$amount->feeCategory->name}}</td> <!-- Displaying the name from related tables -->
                                <td>{{$amount->amount}}</td>
                                
                                
                            </tr>   
                          @endforeach
                          
                          
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>SL</th>
                            
                            <th>Apartment</th>
                            <th>Fee Category</th>
                            <th>Amount</th>
                            
                            
                          </tr>
                      </tfoot>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

            
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
