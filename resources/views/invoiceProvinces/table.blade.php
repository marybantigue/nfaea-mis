<table class="table table-responsive">
    <thead>
    <th>Id</th>
			<th>Invoice Id</th>
			<th>Province Id</th>
			<th>Created At</th>
			<th>Updated At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($invoiceProvinces as $invoiceProvince)
        <tr>
            <td>{!! $invoiceProvince->id !!}</td>
			<td>{!! $invoiceProvince->invoice_id !!}</td>
			<td>{!! $invoiceProvince->province_id !!}</td>
			<td>{!! $invoiceProvince->created_at !!}</td>
			<td>{!! $invoiceProvince->updated_at !!}</td>
            <td>
                <a href="{!! route('invoiceProvinces.edit', [$invoiceProvince->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('invoiceProvinces.delete', [$invoiceProvince->id]) !!}" onclick="return confirm('Are you sure wants to delete this InvoiceProvince?')">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>