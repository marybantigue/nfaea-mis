@extends('centaur.layout')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Create New InvoiceProvince</h1>
        </div>
    </div>

    @include('core-templates::common.errors')

    <div class="row">
        {!! Form::open(['route' => 'invoiceProvinces.store']) !!}

            @include('invoiceProvinces.fields')

        {!! Form::close() !!}
    </div>
</div>
@endsection