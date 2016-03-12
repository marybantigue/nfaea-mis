@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">Statement of Accounts</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('invoices.create') !!}">Add New</a>

        <div class="clearfix"></div>
        

        @include('flash::message')

        <div class="clearfix"></div>
        
        @if($invoices->isEmpty())
            <div class="well text-center">No invoices found.</div>
        @else
            @include('invoices.table')
        @endif
        
    </div>
@endsection