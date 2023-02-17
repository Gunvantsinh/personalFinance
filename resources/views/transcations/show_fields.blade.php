<!-- Id Field -->
<div class="col-sm-3">
    {!! Form::label('id', 'Id:') !!}
    <span>{{ $transcation->id }}</span>
</div>

<!-- Type Field -->
<div class="col-sm-3">
    {!! Form::label('type', 'Type:') !!}
    <span>{!! $transcation->type == "1" ? '<span class="badge badge-success">Income</span>' : '<span class="badge badge-danger">Expense</span>' !!}</span>
</div>

<!-- Amount Field -->
<div class="col-sm-3">
    {!! Form::label('amount', 'Amount:') !!}
    <span>{{ $transcation->amount }}</span>
</div>

<!-- Account Id Field -->
<div class="col-sm-3">
    {!! Form::label('account_id', 'Account:') !!}
    <span>{{  $transcation->account ? $transcation->account->name : "" }}</span>
</div>
</br>
</br>
<!-- Category Id Field -->
<div class="col-sm-3">
    {!! Form::label('category_id', 'Category:') !!}
    <span>{{ $transcation->category ? $transcation->category->name : ""}}</span>
</div>

<!-- Mode Id Field -->
<div class="col-sm-3">
    {!! Form::label('mode_id', 'Mode:') !!}
    <span>{{ $transcation->mode ? $transcation->mode->name : "" }}</span>
</div>

<!-- Date Time Field -->
<div class="col-sm-3">
    {!! Form::label('date_time', 'Date Time:') !!}
    <span>{{ $transcation->date_time }}</span>
</div>

<!-- Description Field -->
<div class="col-sm-3">
    {!! Form::label('description', 'Description:') !!}
    <span>{{ $transcation->description }}</span>
</div>
</br>
</br>
<!-- Created At Field -->
<div class="col-sm-3">
    {!! Form::label('created_at', 'Created At:') !!}
    <span>{{ $transcation->created_at }}</span>
</div>

<!-- Updated At Field -->
<div class="col-sm-3">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <span>{{ $transcation->updated_at }}</span>
</div>

