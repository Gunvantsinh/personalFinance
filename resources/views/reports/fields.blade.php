<!-- Type Field -->
<div class="form-group col-sm-4">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['1' => 'Income', '0' => 'Expense'], null, ['class' => 'form-control','placeholder' => 'Select a Type']); !!}
</div>


<!-- Amount Field -->
<div class="form-group col-sm-4">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control','step' => '0.01']) !!}
</div>

<!-- Account Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('account_id', 'Account:') !!}
    <select name="account_id" id="" class="form-control custom-select">
        <option value="">Select a Account</option>
        @isset($transcation)
            @foreach($accounts as $account)
            <option value="{{ $account->id }}" {{ $account->id == $transcation->account_id  ? 'selected' : ''}}> {{ $account->name }}</option>
            @endforeach
        @else
        @foreach($accounts as $account)
        <option value="{{ $account->id }}" {{ $account->is_default == 1  ? 'selected' : ''}}> {{ $account->name }}</option>
        @endforeach
        @endif
    </select>
</div>


<!-- Category Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', $categories->pluck('name', 'id'), null, ['class' => 'form-control custom-select','placeholder' => 'Select a Category']) !!}
</div>


<!-- Mode Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('mode_id', 'Mode:') !!}
    {!! Form::select('mode_id', $modes->pluck('name', 'id'), null, ['class' => 'form-control custom-select','placeholder' => 'Select a Mode']) !!}
</div>

<!-- Date Time Field -->
<div class="form-group col-sm-4">
    {!! Form::label('date_time', 'Date & Time:') !!}
    <div class="row">
        <div class="col-7">
            {!! Form::text('date', null, ['class' => 'form-control','id'=>'date']) !!}
        </div>
        <div class="col-5">
            {!! Form::text('time', null, ['class' => 'form-control','id'=>'time']) !!}
        </div>
    </div>
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true,
            icons: {
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        })
        $('#time').datetimepicker({
            format: 'hh:mm A',
            useCurrent: true,
            sideBySide: true,
            icons: { 
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-check',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        })
        
    </script>
@endpush

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>