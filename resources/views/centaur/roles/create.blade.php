@extends('Centaur::layout')

@section('title', 'Create New Role')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create New Role</h3>
            </div>
            <div class="panel-body">
                <form accept-charset="UTF-8" role="form" method="post" action="{{ route('roles.store') }}">
                <fieldset>
                    <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Name" name="name" type="text" value="{{ old('name') }}" />
                        {!! ($errors->has('name') ? $errors->first('name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group {{ ($errors->has('slug')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="slug" name="slug" type="text" value="{{ old('slug') }}" />
                        {!! ($errors->has('slug') ? $errors->first('slug', '<p class="text-danger">:message</p>') : '') !!}
                    </div>

                    <h5>Permissions:</h5>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[users.create]" value="1">
                            users.create
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[users.update]" value="1">
                            users.update
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[users.view]" value="1">
                            users.view
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[users.destroy]" value="1">
                            users.destroy
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[roles.create]" value="1">
                            roles.create
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[roles.update]" value="1">
                            roles.update
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[roles.view]" value="1">
                            roles.view
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[roles.delete]" value="1">
                            roles.delete
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[invoices.create]" value="1">
                            invoices.create
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[invoices.update]" value="1">
                            invoices.update
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[invoices.view]" value="1">
                            invoices.view
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[invoices.delete]" value="1">
                            invoices.delete
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[invoices.editFromProvince]" value="1">
                            invoices.editFromProvince
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[invoices.updateFromProvince]" value="1">
                            invoices.updateFromProvince
                        </label>
                    </div>


                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[provinces.create]" value="1">
                            provinces.create
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[provinces.update]" value="1">
                            provinces.update
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[provinces.view]" value="1">
                            provinces.view
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[provinces.delete]" value="1">
                            provinces.delete
                        </label>
                    </div>


                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[members.create]" value="1">
                            members.create
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[members.update]" value="1">
                            members.update
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[members.view]" value="1">
                            members.view
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permissions[members.delete]" value="1">
                            members.delete
                        </label>
                    </div>

                    

                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Create">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop