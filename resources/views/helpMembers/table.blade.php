<table class="table table-responsive">
    <thead>
    <th>Id</th>
			<th>Member Id</th>
			<th>Invoice Id</th>
			<th>Amount</th>
			<th>Created At</th>
			<th>Updated At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($helpMembers as $helpMembers)
        <tr>
            <td>{!! $helpMembers->id !!}</td>
			<td>{!! $helpMembers->member_id !!}</td>
			<td>{!! $helpMembers->invoice_id !!}</td>
			<td>{!! $helpMembers->amount !!}</td>
			<td>{!! $helpMembers->created_at !!}</td>
			<td>{!! $helpMembers->updated_at !!}</td>
            <td>
                <a href="{!! route('helpMembers.edit', [$helpMembers->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('helpMembers.delete', [$helpMembers->id]) !!}" onclick="return confirm('Are you sure wants to delete this help_members?')">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>