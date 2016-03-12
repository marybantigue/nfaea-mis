<table class="table table-responsive">
    <thead>
    <th>Id</th>
			<th>Member Id</th>
			<th>Invoice Id</th>
			<th>Paid</th>
			<th>Created At</th>
			<th>Updated At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($invoiceMembers as $invoiceMember)
        <tr>
            <td>{!! $invoiceMember->id !!}</td>
			<td>{!! $invoiceMember->member_id !!}</td>
			<td>{!! $invoiceMember->invoice_id !!}</td>
			<td>{!! $invoiceMember->paid !!}</td>
			<td>{!! $invoiceMember->created_at !!}</td>
			<td>{!! $invoiceMember->updated_at !!}</td>
            <td>
                <a href="{!! route('invoiceMembers.edit', [$invoiceMember->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('invoiceMembers.delete', [$invoiceMember->id]) !!}" onclick="return confirm('Are you sure wants to delete this InvoiceMember?')">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>