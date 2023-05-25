@extends('layouts.dashboard')

@section('template_title')
    {{ $loan->name ?? "{{ __('Show') Loan" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Loan</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.loans.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Parent Id:</strong>
                            {{ $loan->parent_id }}
                        </div>
                        <div class="form-group">
                            <strong>Loan Date:</strong>
                            {{ $loan->loan_date }}
                        </div>
                        <div class="form-group">
                            <strong>Loan Purpose:</strong>
                            {{ $loan->loan_purpose }}
                        </div>
                        <div class="form-group">
                            <strong>Loan Amount:</strong>
                            {{ $loan->loan_amount }}
                        </div>
                        <div class="form-group">
                            <strong>Long Installment:</strong>
                            {{ $loan->long_installment }}
                        </div>
                        <div class="form-group">
                            <strong>Installment Amount:</strong>
                            {{ $loan->installment_amount }}
                        </div>
                        <div class="form-group">
                            <strong>Account Number:</strong>
                            {{ $loan->account_number }}
                        </div>
                        <div class="form-group">
                            <strong>Attachment:</strong>
                            {{ $loan->attachment }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
