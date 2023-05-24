@extends('layouts.app')

@section('template_title')
    {{ $student->name ?? "{{ __('Show') Student" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Student</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.students.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $student->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Nim:</strong>
                            {{ $student->nim }}
                        </div>
                        <div class="form-group">
                            <strong>Class Id:</strong>
                            {{ $student->class_id }}
                        </div>
                        <div class="form-group">
                            <strong>Address:</strong>
                            {{ $student->address }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
