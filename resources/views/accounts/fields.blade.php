<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- <div class="form-group col-sm-6">
    {!! Form::label('name', 'Type:') !!}
    {!! Form::select('type', ['Online' => 'Online', 'Cash' => 'Cash'], null, ['class' => 'form-control','placeholder' => 'Select a Type']); !!}
</div> -->

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>