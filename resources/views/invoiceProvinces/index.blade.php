@extends('centaur.layout')

@section('content')

    <div class="container">

        <h1 class="pull-left">InvoiceProvinces</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('invoiceProvinces.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($invoiceProvinces->isEmpty())
            <div class="well text-center">No InvoiceProvinces found.</div>
        @else
            @include('invoiceProvinces.table')
        @endif
        
    </div>
@endsection