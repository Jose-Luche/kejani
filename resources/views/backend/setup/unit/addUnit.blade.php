@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        
        <div class="container-full">
        <!-- Content Header (Page header) -->
        <section class="content">

            <!-- Basic Forms -->
             <div class="box">
               <div class="box-header with-border">
                 <h4 class="box-title">Add Unit Category</h4>
                 
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="POST" action="{{ route('unit.store')}}">
                        @csrf
                         <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>House Number <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name"  class="form-control" required=""  > 
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Type<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="cat_id"  required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Type</option>
                                            
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option> 
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Apartment<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="branch_id"  required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Apartment</option>
                                            
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option> 
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Rent <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="rent"  class="form-control" required="" > 
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>  
                            </div>
                                 
                           <div class="text-xs-right">
                               <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
                               
                           </div>
                       </form>
   
                   </div>
                   <!-- /.col -->
                 </div>
                 <!-- /.row -->
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
   
           </section>

        
        
        </div>
    </div>
@endsection