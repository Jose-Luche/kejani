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
                <h3 class="box-title">Receipts Dashboard</h3>
                <a href="{{ route('receipt.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Add Receipt</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>
                              
                              <th>ID No</th>
                              <th>Name</th>
                              <th>Amount</th>
                              <th>Date</th>
                              
                              
                              
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($allData as $key=> $value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                
                                <td>{{ $value->tenant->id_no }}</td>
                                <td>{{ $value->tenant->name }}</td>
                                <td>{{ $value->amount }}</td>
                                <td>{{ date('d-m-Y', strtotime($value->regDate)) }}</td>
                                  
                            </tr>   
                          @endforeach
                          
                          
                      </tbody>
                      
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