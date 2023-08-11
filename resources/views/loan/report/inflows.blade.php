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
                            {{-- <div class="col-sm-12">
                                <h5>
                                    <strong>Filter:</strong>
                                </h5>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="filter" style="display: none;" value="all">
                                        <i class="fa fa-list" aria-hidden="true"></i> Semua
                                    </label>
                                    <label class="btn btn-outline-success">
                                        <input type="radio" name="filter" style="display: none;" value="success">
                                        <i class="fa fa-check-circle" aria-hidden="true"></i> Berhasil
                                    </label>
                                    <label class="btn btn-outline-warning">
                                        <input type="radio" name="filter" style="display: none;" value="process">
                                        <i class="fa fa-hourglass" aria-hidden="true"></i> Sedang Diproses
                                    </label>
                                    <label class="btn btn-outline-danger">
                                        <input type="radio" name="filter" style="display: none;" value="failed">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i> Gagal
                                    </label>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pilih Tanggal:</label>
                                    <select class="form-control" name="days" required>
                                        <option value="all">Semua Tanggal</option>
                                        <option value="today">Hari Ini</option>
                                        <option value="7">7 Hari Terakhir</option>
                                        <option value="30">30 Hari Terakhir</option>
                                        <option value="60">60 Hari Terakhir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-warning w-100" type="submit">
                                    <i class="fa fa-filter" aria-hidden="true"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                @forelse ($installment_payments as $payment)
                                    @php
                                        $dateString = $payment->updated_at;
                                        $timestamp = strtotime($dateString);
                                        $formattedDate = date('d F Y H:i', $timestamp);
                                    @endphp
                                    <div class="col-md-8">
                                        <h5>
                                            <strong>
                                                {{ ++$i }}. Pinjaman
                                            </strong>
                                        </h5>
                                        <h6>Pembayaran Pinjaman | <i class="fa fa-user-circle" aria-hidden="true"></i>
                                            {{ $payment->studentParent->user->name }}</h6>
                                        <p><i class="fas fa-clock"></i> {{ $formattedDate }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>
                                            Rp. {{ number_format($payment->loan->loan_amount) }}

                                        </h5>
                                        <h6>
                                            <i class="fa fa-check-circle text-success" aria-hidden="true"></i> Diterima
                                        </h6>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                            {!! $installment_payments->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
