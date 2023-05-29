<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('mobile') }}
                    {{ Form::text('mobile', $parent->mobile, ['class' => 'form-control' . ($errors->has('mobile') ? ' is-invalid' : ''), 'placeholder' => 'Mobile']) }}
                    {!! $errors->first('mobile', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('occupation') }}
                    {{ Form::text('occupation', $parent->occupation, ['class' => 'form-control' . ($errors->has('occupation') ? ' is-invalid' : ''), 'placeholder' => 'Occupation']) }}
                    {!! $errors->first('occupation', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('address') }}
                    {{ Form::text('address', $parent->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Address']) }}
                    {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
