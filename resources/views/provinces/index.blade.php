@extends('centaur.layout')

@section('content')

    <div class="container">

        <h1 class="pull-left">Provinces</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('provinces.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($provinces->isEmpty())
            <div class="well text-center">No provinces found.</div>
        @else
            @include('provinces.table')
        @endif
        
    </div>
@endsection