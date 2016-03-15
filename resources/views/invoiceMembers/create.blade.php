@extends('centaur.layout')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Create New InvoiceMember</h1>
        </div>
    </div>

    @include('core-templates::common.errors')

    <div class="row">
        {!! Form::open(['route' => 'invoiceMembers.store']) !!}

            @include('invoiceMembers.fields')

        {!! Form::close() !!}
    </div>
</div>
@endsection