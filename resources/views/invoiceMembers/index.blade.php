@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">InvoiceMembers</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('invoiceMembers.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($invoiceMembers->isEmpty())
            <div class="well text-center">No InvoiceMembers found.</div>
        @else
            @include('invoiceMembers.table')
        @endif
        
    </div>
@endsection