<table class="table table-responsive">
    <thead>
    <th>Id</th>
			<th>Name</th>
			<th>Created At</th>
			<th>Updated At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($provinces as $province)
        <tr>
            <td>{!! $province->id !!}</td>
			<td>{!! $province->name !!}</td>
			<td>{!! $province->created_at !!}</td>
			<td>{!! $province->updated_at !!}</td>
            <td>
                <a href="{!! route('provinces.edit', [$province->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('provinces.delete', [$province->id]) !!}" onclick="return confirm('Are you sure wants to delete this province?')">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $provinces->links() !!}