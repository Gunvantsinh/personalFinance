<div class="table-responsive">
    <table class="table" id="accounts-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Default</th>
                <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr>
                <td>{{ $account->id }}</td>
                <td>{{ $account->name }}</td>
                <td>{{ $account->is_default == '1' ? 'Yes' : 'No' }}</td>
                <td>{{ $account->description }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['accounts.destroy', $account->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accounts.show', [$account->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('accounts.edit', [$account->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
