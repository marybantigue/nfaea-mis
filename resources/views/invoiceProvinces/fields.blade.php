<!--- Id Field --->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
</div>

<!--- Invoice Id Field --->
<div class="form-group col-sm-6">
    {!! Form::label('invoice_id', 'Invoice Id:') !!}
    {!! Form::number('invoice_id', null, ['class' => 'form-control']) !!}
</div>

<!--- Province Id Field --->
<div class="form-group col-sm-6">
    {!! Form::label('province_id', 'Province Id:') !!}
    {!! Form::number('province_id', null, ['class' => 'form-control']) !!}
</div>

<!--- Created At Field --->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    {!! Form::date('created_at', null, ['class' => 'form-control']) !!}
</div>

<!--- Updated At Field --->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    {!! Form::date('updated_at', null, ['class' => 'form-control']) !!}
</div>

<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('invoiceProvinces.index') !!}" class="btn btn-default">Cancel</a>
</div>
