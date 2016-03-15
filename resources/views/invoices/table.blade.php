<table class="table table-responsive">
    <thead>
    <th>Id</th>
			<th>Total Amount</th>
			<th>Account Type</th>
			<th>Status</th>
            <th>Province</th>
			<th>Created At</th>
			<th>Updated At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
         @foreach($invoice->province as $invoiceprov)
        <tr>
            <td>{{ $invoiceprov->pivot->id }}</td>
			<td>{!! $invoice->total_amount !!}</td>
			<td>{!! $invoice->account_type !!}</td>
			<td>{!! $invoiceprov->pivot->status !!}</td>
			<td>{!! $invoiceprov->name !!}</td>
            <td>{!! $invoice->created_at !!}</td>
			<td>{!! $invoice->updated_at !!}</td>
            <td>
                    
                <a href="{!! route('invoices.editFromProvince', [$invoice->id, $invoiceprov->pivot->province_id ]) !!}"><i class="glyphicon glyphicon-edit"></i></a>

                 @if (Sentinel::inRole('main'))
                <a href="{!! route('invoices.delete', [$invoice->id]) !!}" onclick="return confirm('Are you sure wants to delete this invoice?')">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
                @endif
            </td>
        </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
