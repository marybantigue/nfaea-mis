@extends('centaur.layout')

@section('content')

    <div class="container">

        <h1 class="pull-left">help_members</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('helpMembers.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($helpMembers->isEmpty())
            <div class="well text-center">No help_members found.</div>
        @else
            @include('helpMembers.table')
        @endif
        
    </div>
@endsection