<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', 'Default:') !!}
    <div class="form-check">
        <input class="form-check-input" name="is_default" type="checkbox" value="1" id="flexCheckDefault"
            {{ isset($account) && $account->is_default == 1 ? 'checked' : '' }}>
        <label class="form-check-label" for="flexCheckDefault">

        </label>
    </div>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
