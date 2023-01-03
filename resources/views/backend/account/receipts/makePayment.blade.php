@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="content-wrapper">
        
        <div class="container-full">
        <!-- Content Header (Page header) -->
        <section class="content">

            <!-- Basic Forms -->
             <div class="box">
               <div class="box-header with-border">
                 <h4 class="box-title">Make Payment</h4>
                 
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="POST" action="{{ route('make.payment.store',['id'=>$id])}}" enctype="multipart/form-data">
                    @csrf
                <div class="table-responsive">
                    <table class="table mb-0">
                        
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th>Date</th>
                                <th>Fee Type</th>
                                <th>Bill Amount</th> 
                                <th>Amount Paid</th> 
                                <th>Amount Due</th> 
                                <th>Pay</th>   
                            </tr>
                        </thead>
                        <tbody>
                            @if ($tenant->bills != null)
                                @foreach ($tenant->bills as $key => $value)

                                <!-- Only receipt for bills that are greater than 0 -->
                                @if ($value->projectionBalance($value->id) > 0)
                                    <tr>
                                        <td>{{ $key+1 }}
                                            <input type="hidden" name="contId[{{ $value->id }}]" value="{{ $value->id }}">
                                        </td>
                                        <td>{{ date('M Y', strtotime($value->date)) }}</td> 
                                        <td>@if ($value->type == "other")
                                            @if($value->category != null)
                                              {{$value->category->name}}
                                            @endif
                                            @elseif ($value->type == "rent")
                                            Rent
                                          @endif
                                        
                                        </td>
                                        <td >{{ $value->amount }}</td>
                                        <td >{{ $value->totalAmountPaid($value->id) }}</td><!-- id is specific to the projection -->
                                        <td class="countable">
                                            {{ $value->projectionBalance($value->id) }}
                                        </td>
                                        <td>
                                            <input type="text" name="paid[{{ $value->id }}]" class="paid">
                                        </td>  
                                        
                                    </tr>  
                                @endif

                                
                                    
                                @endforeach
                            
                                
                            @endif  
                            
                        </tbody>
                        <tfoot>
                            
                                <tr id="summation">
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td align="right"><b>Total :</b></td>
                                    <td><b><span id="sum">0</span></b>
                                        <input type="hidden" name="totals" id="totals" value="0">
                                    </td>
                                </tr>  
                            
                        </tfoot>
                        
                      </table>
                </div>
                <script type="text/javascript">
                   
                    $(document).ready(function(){
                        $(".paid").each(function(){
                            $(this).keyup(function(){
                                calculateSum();
                            });
                        });
                    });

                    function calculateSum(){
                        var sum = 0;
                        $(".paid").each(function(){
                            if(!isNaN(this.value) && this.value.length!=0){
                                sum += parseFloat(this.value);
                            }
                        });
                        $("#sum").html(sum.toFixed(2));
                        var result = document.getElementById('summation');
                        var totals = document.getElementById('totals');
                        totals.value = sum;
                        result.value = sum;
                        
                    }

                </script>


                 <div class="row">
                   <div class="col">
                       
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
                                            <option value="">Select Account</option>
                                                @foreach ($accounts as $row)
                                                    <option value="{{$row->id}}">{{$row->accName}}</option>
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
                            <input type="hidden" name="projId" value="">
                            <input type="hidden" name="allocDate" value="">
                            <input type="hidden" name="amount" value="">
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

    <!-- Changing on screen images for viewing before update -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

        
    </script>
@endsection