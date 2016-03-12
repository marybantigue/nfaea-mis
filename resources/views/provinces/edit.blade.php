@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Create New province</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($province, ['route' => ['provinces.update', $province->id], 'method' => 'patch']) !!}

            @include('provinces.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection