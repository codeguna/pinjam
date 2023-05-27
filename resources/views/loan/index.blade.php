@extends('layouts.dashboard')

@section('title')
    Daftar Pinjaman
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Pemohon Pinjaman
                            </span>

                            <div class="float-right">
                                <a href="{{ route('admin.loans.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Parent Id</th>
                                        <th>Loan Date</th>
                                        <th>Loan Purpose</th>
                                        <th>Loan Amount</th>
                                        <th>Long Installment</th>
                                        <th>Installment Amount</th>
                                        <th>Account Number</th>
                                        <th>Attachment</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $loan)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $loan->parent_id }}</td>
                                            <td>{{ $loan->loan_date }}</td>
                                            <td>{{ $loan->loan_purpose }}</td>
                                            <td>{{ $loan->loan_amount }}</td>
                                            <td>{{ $loan->long_installment }}</td>
                                            <td>{{ $loan->installment_amount }}</td>
                                            <td>{{ $loan->account_number }}</td>
                                            <td>{{ $loan->attachment }}</td>

                                            <td>
                                                <form action="{{ route('admin.loans.destroy', $loan->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('admin.loans.show', $loan->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('admin.loans.edit', $loan->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $loans->links() !!}
            </div>
        </div>
    </div>
@endsection
