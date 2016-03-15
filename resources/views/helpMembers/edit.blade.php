@extends('centaur.layout')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Create New help_members</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($helpMembers, ['route' => ['helpMembers.update', $helpMembers->id], 'method' => 'patch']) !!}

            @include('helpMembers.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection