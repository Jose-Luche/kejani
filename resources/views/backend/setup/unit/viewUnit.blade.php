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
                <h3 class="box-title">Units</h3>
                <a href="{{ route('unit.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Add Unit</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>
                              
                              <th>Apartment</th>
                              <th>House No</th>
                              <th>Category</th>
                              <th>Rent</th>
                              
                              <th width="25%">Action</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($allData as $key=> $unit)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                
                                <td>{{ $unit->branch->name }}</td>
                                <td>{{ $unit->name }}</td>
                                <td>{{ $unit->category->name }}</td>
                                <td>{{ $unit->rent }}</td>
                                
                                <td>
                                    <a href="{{route('unit.edit',$unit->id)}}" class="btn btn-info" >Edit</a>
                                    <a href="{{route('unit.delete',$unit->id)}}" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                                
                            </tr>   
                          @endforeach
                          
                          
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>SL</th>
                            
                            <th>Apartment</th>
                            <th>House No</th>
                            <th>Category</th>
                            <th>Rent</th>
                            
                            <th>Action</th>
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