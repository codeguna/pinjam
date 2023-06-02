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
                        <div class="w-100 p-1">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" placeholder="Cari data pinjaman">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Nama Peminjam</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Jumlah Peminjaman</th>
                                        <th>Persetujuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $loan)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>
                                                <i class="fas fa-user-check"></i>
                                                {{ $loan->studentParent->user->name }}
                                            </td>
                                            <td>
                                                <i class="fas fa-calendar"></i>
                                                {{ DateTime::createFromFormat('Y-m-d', $loan->loan_date)->format('d F Y') }}
                                            </td>
                                            <td>
                                                <span class="badge bg-success">
                                                    Rp. {{ number_format($loan->installment_amount) }}
                                                </span>
                                            </td>
                                            <td>
                                                @foreach ($loan->loanApproval as $approval)
                                                    @if ($approval->approved == 0)
                                                        <span class="badge bg-warning"
                                                            title="Belum Disetujui {{ $approval->name }}">
                                                            <i class="fas fa-times-circle"></i>
                                                            {{ $approval->name }}
                                                        </span>
                                                    @else
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check-circle"></i>
                                                            {{ $approval->name }}
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <a class="btn btn-sm btn-primary btn-sm"
                                                        href="{{ route('admin.loans.show', $loan->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success btn-sm"
                                                        href="{{ route('admin.loans.edit', $loan->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                    <form action="{{ route('admin.loans.destroy', $loan->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fa fa-fw fa-trash"></i></button>
                                                    </form>
                                                </div>
                                                {{-- <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary btn-xs dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-cog"></i> Aksi
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.loans.show', $loan->id) }}">
                                                            Lihat Detail
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.loans.edit', $loan->id) }}">
                                                            Edit Pinjaman
                                                        </a>
                                                        <form action="{{ route('admin.loans.destroy', $loan->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item">
                                                                Batalkan Pinjaman
                                                            </button>
                                                        </form>
                                                        <hr>
                                                    </div>
                                                </div> --}}
                                                {{-- <form action="{{ route('admin.loans.destroy', $loan->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('admin.loans.show', $loan->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('admin.loans.edit', $loan->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i></button>
                                                </form> --}}
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
