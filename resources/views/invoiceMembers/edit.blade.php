@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Create New InvoiceMember</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($invoiceMember, ['route' => ['invoiceMembers.update', $invoiceMember->id], 'method' => 'patch']) !!}

            @include('invoiceMembers.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection