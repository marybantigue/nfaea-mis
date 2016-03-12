<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Province Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('province_id', 'Province:') !!}
    {!! Form::select('province_id', $provinces, old('province_id'), ['class' => 'form-control']) !!}
</div>
<!-- Province Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role[0][role_id]', 'Role:') !!}
    {!! Form::select('role[0][role_id]', $roles, ['id' => 'role_id' ], ['class' => 'form-control']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
