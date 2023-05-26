@extends('layouts.dashboard')

@section('title')
    Form Pinjaman
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Loan</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.loans.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('loan.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
