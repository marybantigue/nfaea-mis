@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">Members</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('members.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($members->isEmpty())
            <div class="well text-center">No Members found.</div>
        @else
            @include('members.table')
        @endif
        
    </div>
@endsection