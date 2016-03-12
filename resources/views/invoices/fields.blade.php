<div class="container">
    <div class="row">
        <div class="form-group col-sm-3">
            {!! Form::label('account_type', 'Account Type:') !!}
            {!! Form::select('account_type', [
                'HELP' => 'HELP', 
                'Annual Dues' => 'Annual Dues', 
                'Monthly Dues' => 'Monthly Dues'
            ], null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div id="help-options">
        <div class="row">
            <div class="col-xs-4">
                <button class="add_member_button btn btn-warning">Add More Members</button>
            </div>
        </div>
        <div class="help-members-container">
          
            <div class="row form-group help-members-row">
                <div class="col-xs-4">
                    {!! Form::select('helpmember[0][member_id]',[null=>''] + $members, null, ['id' => 'member_id','class' => 'member_select form-control']) !!}
                </div>
                <div class="col-xs-2">
                    {!! Form::number('helpmember[0][amount]', null, ['class' => 'form-control input-sm', 'placeholder' => '0.00']) !!}
                </div>
            </div> 
         
        </div>
    </div>
<div class="form-group col-sm-6">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    {!! Form::number('total_amount', null, ['class' => 'form-control']) !!}
</div>
 

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('invoices.index') !!}" class="btn btn-default">Cancel</a>
</div>

</div>