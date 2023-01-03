@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>

     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      

      <!-- Main content -->
      <section class="content">
        <div class="row"> 
          
          <div class="col-12">
            <div class="box bb-3 border-warning">
              <div class="box-header">
              <h4 class="box-title">Add <strong>Tenant Fee</strong></h4>
              </div>
    
              <div class="box-body"> <!-- Search option Form -->
                  
                    <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                              <h5>Apartment<span class="text-danger"></span></h5>
                              <div class="controls">
                                  <select name="branch_id" id="branch_id" required="" class="form-control">
                                      <option value="" selected="" disabled="">Select Year</option>
                                      
                                      @foreach ($branches as $branch)
                                          <option value="{{ $branch->id }}" >{{ $branch->name }}</option> 
                                      @endforeach
                                      
                                      
                                      
                                      
                                  </select>
                              </div>
                          </div>

                        </div>    
                      

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Unit<span class="text-danger"></span></h5>
                                <div class="controls">
                                    <select name="unit_id" id="unit_id" required="" class="form-control">
                                        <option value="" selected="" disabled="">Select Unit</option>
                                        @foreach ($units as $unit) <!-- Displaying search parameters on screen -->
                                            <option value="{{ $unit->id }}" >{{ $unit->name }}</option>  
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>   

                        

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Fee Category<span class="text-danger"></span></h5>
                                <div class="controls">
                                    <select name="fee_category_id" id="fee_category_id" required="" class="form-control">
                                        <option value="" selected="" disabled="">Select Fee Category</option>
                                        @foreach ($fee_categories as $fee) <!-- Displaying search parameters on screen -->
                                            <option value="{{ $fee->id }}" >{{ $fee->name }}</option>  
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Date <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="date" id="date" class="form-control" required=""  > 
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>  
                        
                        <div class="col-md-3" style="padding-top: 25px;">
                          <a  id="search" class="btn btn-primary" name="search">Search</a>
                        </div> 
                        
                                       
                                        
                           
                    </div>
                    <!-- Marks Entry table -->
                                        
                    <div class="row">
                      <div class="col-md-12">
                        <div id="DocumentResults"> <!-- ID to be used to load handlejs -->
                            <script id="document-template" type="text/x-handlebars-template">
                                <form action="{{ route('receipt.store')}}" method="POST">
                                @csrf
                                <table class="table table-bordered table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            @{{{thsource}}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @{{#each this}}
                                        <tr>
                                            @{{{tdsource}}}
                                        </tr>

                                        @{{/each}}
                                    </tbody>

                                </table>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <h5>Date <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="regDate"  class="form-control" required="" > 
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <h5>Payment options <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="payMode" id="payMode" required="" class="form-control">
                                                    <option value="" selected="" disabled="">Select option</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Mobile Payment">Mobile Payment</option>
                                                    <option value="Cheque">Cheque</option>
                                                       
                                                </select>
                                            </div>
                                        </div>  
                                    </div>

                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <h5>Account<span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <select name="ledgerId" id="ledgerId" required="" class="form-control">
                                                    <option value="" selected="" disabled="">Select Account</option>
                                                    
                                                        @foreach ($ledgers as $ledger) <!-- Displaying search parameters on screen -->
                                                            <option value="{{ $ledger->id }}" >{{ $ledger->accName }}</option>  
                                                        @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>  
                                    
                                       

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <h5>Reference <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="reference"  class="form-control"   > 
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>  
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Narration <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="narration" id="textarea" class="form-control" required="" placeholder="Fee Payment..."></textarea>
                                            <div class="help-block"></div></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="recId" value="">
                                    <input type="hidden" name="acst_id" value="">
                                    <input type="hidden" name="allocDate" value="">
                                    <input type="hidden" name="amount" value="">
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-top: 10px">Submit</button>
                                </form>
                            </script>
                        </div>
                          
                      </div>
                        
                    </div> 

                    
                 
              </div>
            </div>
          </div>

          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>
<!-- Get Registration Fee Method -->
<script type="text/javascript">
    $(document).on('click', '#search', function(){
        var branch_id = $('#branch_id').val();
        var unit_id = $('#unit_id').val();
        var fee_category_id = $('#fee_category_id').val();
        var date = $('#date').val();
        
        $.ajax({
            url: "{{ route('get.member.fee')}}",
            type: "get",
            data: {'branch_id':branch_id,'unit_id':unit_id,'fee_category_id':fee_category_id,'date':date},
            beforeSend:function() {

            },
            success:function(data) {
                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var html = template(data);
                $('#DocumentResults').html(html);
                $('[data-toggle = "tooltip"]').tooltip();
            }
        });
    });

</script>



@endsection
