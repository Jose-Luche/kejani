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
                <h3 class="box-title">Tenant List</h3>
                <a href="{{ route('tenant.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Add Tenant</a>
                <a href="{{ route('tenant.excel')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">EXCEL</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                
                                <th>Name</th>
                                <th>ID No</th>
                                <th>Unit No</th>
                                <th>Apartment</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                
                                <th width="25%">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key=> $tenant)
                              <tr>
                                  <td>{{ $key+1 }}</td>

                                  <td><a href="{{url('tenant/profile/'.$tenant->id)}}">{{ $tenant->name }}</a></td>
                                  <td>{{$tenant->id_no}}</td>
                                  <td>{{$tenant->unit->name}}</td>
                                  <td>{{$tenant->apartment->name}}</td>
                                  <td>{{$tenant->email}}</td>
                                  <td>{{$tenant->mobile}}</td>
                                  
                                  
                                  <td>
                                      <a href="{{route('tenant.edit',$tenant->id)}}" class="btn btn-info" ><i class="fa fa-edit"></i></a>
    
                                      <a target="_blank" href="" class="btn btn-danger" ><i class="fa fa-eye"></i></a>
                                  </td>
                                  
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
