@extends('layouts.dashboard')

@section('template_title')
    {{ $parent->name ?? "{{ __('Show') Parent" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Parent</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.parents.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $parent->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Mobile:</strong>
                            {{ $parent->mobile }}
                        </div>
                        <div class="form-group">
                            <strong>Occupation:</strong>
                            {{ $parent->occupation }}
                        </div>
                        <div class="form-group">
                            <strong>Address:</strong>
                            {{ $parent->address }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
