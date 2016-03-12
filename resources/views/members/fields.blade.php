<!--- First Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<!--- Last Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!--- Province Field -->
<div class="form-group col-sm-4">
    {!! Form::label('province_id', 'Province:') !!}
    <!-- {!! Form::text('province_id', null, ['class' => 'form-control']) !!} -->
    {!! Form::select('province_id', $provinces, null, ['id' => 'province_id', 'class' => 'form-control']) !!}
</div>

<!--- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('members.index') !!}" class="btn btn-default">Cancel</a>
</div>
