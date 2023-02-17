<!-- Type Field -->
<div class="form-group col-sm-4">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['1' => 'Income', '0' => 'Expense'], null, ['class' => 'form-control','placeholder' => 'Select a Type']); !!}
</div>


<!-- Amount Field -->
<div class="form-group col-sm-4">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Account Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('account_id', 'Account:') !!}
    {!! Form::select('account_id', $accounts->pluck('name', 'id'), null, ['class' => 'form-control custom-select','placeholder' => 'Select a Account']) !!}
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
            {!! Form::text('date', null, ['class' => 'form-control','id'=>'time']) !!}
        </div>
    </div>
    
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
        $('#time').datetimepicker({
            format: 'HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
        
    </script>
@endpush

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>