@extends('centaur.layout')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Member</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($member, ['route' => ['members.update', $member->id], 'method' => 'patch']) !!}

            @include('members.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection