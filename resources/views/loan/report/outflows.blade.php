@extends('layouts.dashboard')

@section('title')
    Riwayat Pembayaran
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5>
                                    <strong>Filter:</strong>
                                </h5>
                                <form action="{{ route('admin.loans.outflows.search') }}" method="GET">
                                    @csrf

                                    {{-- <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="filter" style="display: none;" value="all">
                                            <i class="fa fa-list" aria-hidden="true"></i> Semua
                                        </label>
                                        <label class="btn btn-outline-success">
                                            <input type="radio" name="filter" style="display: none;" value="1">
                                            <i class="fa fa-check-circle" aria-hidden="true"></i> Berhasil
                                        </label>
                                        <label class="btn btn-outline-warning">
                                            <input type="radio" name="filter" style="display: none;" value="process">
                                            <i class="fa fa-hourglass" aria-hidden="2"></i> Sedang Diproses
                                        </label>
                                        <label class="btn btn-outline-danger">
                                            <input type="radio" name="filter" style="display: none;" value="failed">
                                            <i class="fa fa-times-circle" aria-hidden="0"></i> Gagal
                                        </label>
                                    </div> --}}
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pilih Tanggal:</label>
                                    <select class="form-control" name="days" required>
                                        <option disabled>== Pilih Tanggal
                                            ==</option>
                                        <option value="all" @if (request('days') === 'all') selected @endif>Semua
                                            Tanggal</option>
                                        <option value="today" @if (request('days') === 'today') selected @endif>Hari
                                            Ini
                                        </option>
                                        <option value="7" @if (request('days') === '7') selected @endif>7 Hari
                                            Terakhir</option>
                                        <option value="30" @if (request('days') === '30') selected @endif>30 Hari
                                            Terakhir</option>
                                        <option value="60" @if (request('days') === '60') selected @endif>60 Hari
                                            Terakhir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-warning w-100" type="submit">
                                    <i class="fa fa-filter" aria-hidden="true"></i> Submit
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                @forelse ($loans as $loan)
                                    @php
                                        $dateString = $loan->updated_at;
                                        $timestamp = strtotime($dateString);
                                        $formattedDate = date('d F Y H:i', $timestamp);
                                    @endphp
                                    <div class="col-md-8">
                                        <h5>
                                            <strong>
                                                {{ ++$i }}. Pinjaman
                                            </strong>
                                        </h5>
                                        <h6>Pengajuan Pinjaman | <i class="fa fa-user-circle" aria-hidden="true"></i>
                                            {{ $loan->studentParent->user->name }}</h6>
                                        <p><i class="fas fa-clock"></i> {{ $formattedDate }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>
                                            Rp. {{ number_format($loan->installment_amount) }}

                                        </h5>
                                        <h6>
                                            @php
                                                $lastApproved = null;
                                            @endphp
                                            @foreach ($loan->loanApproval as $approval)
                                                @php
                                                    $lastApproved = $approval->approved;
                                                @endphp
                                            @endforeach
                                            @if ($lastApproved == 1)
                                                <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                                <strong>Disetujui</strong>
                                            @else
                                                <i class="fa fa-times-circle text-danger" aria-hidden="true"></i>
                                                <strong>Belum Disetujui</strong>
                                            @endif
                                        </h6>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                @empty
                                    <div class="col-md-12">
                                        <h3>
                                            <i class="fa fa-info-circle" aria-hidden="true"></i> Belum ada Dana Keluar
                                        </h3>
                                    </div>
                                @endforelse
                            </div>
                            {!! $loans->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
