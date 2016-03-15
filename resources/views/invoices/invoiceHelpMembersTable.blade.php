
<div class="row">

        <table class="table table-responsive table-condensed table-bordered">
            <caption class="text-center"><h5>MEMBERS FOR HELP</h5></caption>
            <thead>
        			<th>Name</th>
        			<th class="text-right">Amount</th>
            </thead>
            <tbody>
            @foreach($help_members as $invoiceHelpMember)
                <tr>
                    <td>{!! $invoiceHelpMember->getFullNameAttribute() !!}</td>
                    <td class="text-right">{{ $invoiceHelpMember->pivot->amount }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $help_members->links() !!}
</div>