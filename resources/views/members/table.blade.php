<table class="table table-responsive">
    <thead>
    <th>Id</th>
			<th>First Name</th>
			<th>Last Name</th>

            <th>Province</th>
			<th>Created At</th>
			<th>Updated At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($members as $member)
        <tr>
            <td>{!! $member->id !!}</td>
			<td>{!! $member->first_name !!}</td>
			<td>{!! $member->last_name !!}</td>
            <td>{!! $member->province()->first()->name !!}</td>
			<td>{!! $member->created_at !!}</td>
			<td>{!! $member->updated_at !!}</td>
            <td>
                <a href="{!! route('members.edit', [$member->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('members.delete', [$member->id]) !!}" onclick="return confirm('Are you sure wants to delete this Member?')">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $members->links() !!}