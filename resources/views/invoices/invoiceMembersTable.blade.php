<table class="form-group table table-responsive">
    <caption><h4>MEMBERS IN YOUR PROVINCE</h4></caption>
    <thead>
			<th>Name</th>
			<th>Paid</th>
			<th>Updated At</th>
    </thead>
    <tbody>
    @foreach($invoice->members as $invoiceMember)
        <tr>
            <td>{!! $invoiceMember->getFullNameAttribute() !!}</td>
			<td>
            {{ Form::hidden('invoiceMember['.$invoiceMember->id.'][paid]', 0) }}
            {!! Form::checkbox('invoiceMember['.$invoiceMember->id.'][paid]', 1,  $invoiceMember->pivot->paid) !!}</td>
			<td>{!! $invoiceMember->updated_at !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>