@extends('admin.admin_master')
@section('admin')
    <div class="content-wrapper">
        
        <div class="container-full">
        <!-- Content Header (Page header) -->
        <section class="content">

            <!-- Basic Forms -->
             <div class="box">
               <div class="box-header with-border">
                 <h4 class="box-title">Edit Unit</h4>
                 
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="POST" action="{{ route('unit.update',$editData->id)}}">
                        @csrf
                         <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>House Number <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name"  class="form-control" required="" value="{{$editData->name}}"  > 
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Type<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="cat_id"  required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Type</option>
                                            
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{($editData->cat_id == $category->id)?'selected':''}}>{{ $category->name }}</option> 
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Apartment<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="branch_id"  required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Type</option>
                                            
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}" {{($editData->branch_id == $branch->id)?'selected':''}}>{{ $branch->name }}</option> 
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Rent <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="rent"  class="form-control" required="" value="{{$editData->rent}}"  > 
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>  
                            </div>
                                 
                           <div class="text-xs-right">
                               <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
                               
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