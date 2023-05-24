<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('parent_id') }}
            {{ Form::text('parent_id', $loan->parent_id, ['class' => 'form-control' . ($errors->has('parent_id') ? ' is-invalid' : ''), 'placeholder' => 'Parent Id']) }}
            {!! $errors->first('parent_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('loan_date') }}
            {{ Form::text('loan_date', $loan->loan_date, ['class' => 'form-control' . ($errors->has('loan_date') ? ' is-invalid' : ''), 'placeholder' => 'Loan Date']) }}
            {!! $errors->first('loan_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('loan_purpose') }}
            {{ Form::text('loan_purpose', $loan->loan_purpose, ['class' => 'form-control' . ($errors->has('loan_purpose') ? ' is-invalid' : ''), 'placeholder' => 'Loan Purpose']) }}
            {!! $errors->first('loan_purpose', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('loan_amount') }}
            {{ Form::text('loan_amount', $loan->loan_amount, ['class' => 'form-control' . ($errors->has('loan_amount') ? ' is-invalid' : ''), 'placeholder' => 'Loan Amount']) }}
            {!! $errors->first('loan_amount', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('long_installment') }}
            {{ Form::text('long_installment', $loan->long_installment, ['class' => 'form-control' . ($errors->has('long_installment') ? ' is-invalid' : ''), 'placeholder' => 'Long Installment']) }}
            {!! $errors->first('long_installment', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('installment_amount') }}
            {{ Form::text('installment_amount', $loan->installment_amount, ['class' => 'form-control' . ($errors->has('installment_amount') ? ' is-invalid' : ''), 'placeholder' => 'Installment Amount']) }}
            {!! $errors->first('installment_amount', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('account_number') }}
            {{ Form::text('account_number', $loan->account_number, ['class' => 'form-control' . ($errors->has('account_number') ? ' is-invalid' : ''), 'placeholder' => 'Account Number']) }}
            {!! $errors->first('account_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('attachment') }}
            {{ Form::text('attachment', $loan->attachment, ['class' => 'form-control' . ($errors->has('attachment') ? ' is-invalid' : ''), 'placeholder' => 'Attachment']) }}
            {!! $errors->first('attachment', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>