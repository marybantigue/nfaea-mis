@extends('centaur.layout')

@section('content')
    <div class="container">

        @include('core-templates::common.errors')
        {!! Form::model($invoice, ['route' => ['invoices.updateFromProvince', $invoice->id, $invoice->province->first()->id], 'method' => 'patch']) !!}

        <div class="row">
            <div class="col-sm-3">
                

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <div class="panel-title"><h4>STATEMENT OF ACCOUNTS</h4></div>
                    </div>
                    <div class="panel-body">
                        
                            <div class="form-inline">
                              <label>Invoice ID: </label>
                              {{ $invoice->province->first()->pivot->id }}  
                            </div>
                            
                            <div class="form-inline">
                              <label>Account: </label>  
                              {{ $invoice->account_type}}
                            </div>
                            <div class="form-inline">
                              <label>Province: </label>  
                              {{ $invoice->province->first()->name }}
                            </div>
                            <div class="form-inline">
                                <label>Total Amount:</label>  
                                {{ $invoice->total_amount}}
                            </div>
                            
                            <div class="form-inline">
                               <label>Date: </label> 
                                {{ $invoice->created_at->format('M j, Y - h:m a')}} 
                            </div>
                        @if(!$help_members->isEmpty())
                            @include('invoices.invoiceHelpMembersTable')
                        @endif
                        
                    </div>

                </div> 


            </div>
            <div class="col-sm-9">
                @if($invoice->province->first()->pivot->status == "Done" )   
                    <div class="well text-center" style="background-color: rgb(214, 233, 198); color: #000000;">All members paid</div>
                @else    
                    @if($members->isEmpty())
                        <div class="well text-center">No members found.</div>
                    @else
                        @include('invoices.invoiceMembersTable')
                    @endif
                @endif
                <div class="row form-group">
                    <div class="col-sm-2">
                       <label>Deposit Details</label>  
                    </div>
                    <div class="col-sm-6">
                        @if($invoice->province->first()->pivot->status == "Done" )
                            {!! $invoice->province->first()->pivot->remarks !!}
                        @else
                            {!! Form::textarea('remarks', $invoice->province->first()->pivot->remarks, ['class' => 'form-control', 'rows' => 4]) !!}
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    @if($invoice->province->first()->pivot->status == "Done" )   
                        <a href="{!! route('invoices.index') !!}" class="btn btn-default">Back</a>
                    @else
                        {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                        <a href="{!! route('invoices.index') !!}" class="btn btn-default">Cancel</a>
                    @endif

                </div>

            </div>
        </div>



        

        
        





            
        
        

        {!! Form::close() !!}
    </div>
@endsection