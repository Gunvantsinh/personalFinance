<div class="table-responsive">
    <table class="table" id="modes-table">
        <thead>
        <tr>
            <th>Id</th>
        <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($modes as $mode)
            <tr>
                <td>{{ $mode->id }}</td>
            <td>{{ $mode->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['modes.destroy', $mode->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('modes.show', [$mode->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('modes.edit', [$mode->id]) }}"
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
