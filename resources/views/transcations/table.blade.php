<div class="table-responsive">
    <table class="table" id="transcations-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Account</th>
                <th>Category</th>
                <th>Mode </th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transcation)
            <tr>
                <!-- <td>{{ $transcation->id }}</td> -->
                <td>{{ date('d-M', strtotime($transcation->date)) }}</td>
                <td>{!! $transcation->type == "1" ? '<span class="badge badge-success">Income</span>' : '<span class="badge badge-danger">Expense</span>' !!}</td>
                <td>{{ $transcation->amount }}</td>
                <td>{{ $transcation->description }}</td>
                <td>{{ $transcation->account ? $transcation->account->name : "" }}</td>
                <td>{{ $transcation->category ? $transcation->category->name : "" }}</td>
                <td>{{ $transcation->mode ? $transcation->mode->name : "" }}</td>
                
                <td width="120">
                    {!! Form::open(['route' => ['transcations.destroy', $transcation->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('transcations.show', [$transcation->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('transcations.edit', [$transcation->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
            <tr>
                <th><span class="label label-success">Total Income: {{ $total_income }}</span></th>
                <th><span class="label label-danger">Total Expense: {{ $total_expense }}</span></th>
                <th><span class="label label-primary">Total Profit/Loss: {{ $total_income - $total_expense }}</span></th>
            </tr>
        </tbody>
    </table>
</div>
