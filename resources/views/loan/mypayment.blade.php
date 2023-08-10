@extends('layouts.dashboard')

@section('title')
    Daftar Pembayaran
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="alert alert-primary" role="alert">
                            <strong>
                                <i class="fa fa-info-circle" aria-hidden="true"></i> Lakukan Pembayaran, dengan klik
                                tombol berwarna hijau
                            </strong>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-striped">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Status Pembayaran</th>
                                        <th>Jumlah Rp.</th>
                                        <th>Bayar Cicilan ke-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($loans as $loan)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                <i class="fas fa-calendar    "></i>
                                                {{ date('m-d-Y', strtotime($loan->loan_date)) }}
                                            </td>
                                            <td align="center">
                                                @foreach ($loan->installmentPayment as $payment)
                                                    @if ($payment->isPay == 1)
                                                        <span class="badge badge-pill badge-success w-100">
                                                            <i class="fa fa-hashtag" aria-hidden="true">
                                                                {{ $loop->iteration }}
                                                            </i> Sudah Lunas
                                                        </span>
                                                    @elseif($payment->isPay == 2)
                                                        <span class="badge badge-pill badge-warning w-100">
                                                            <i class="fa fa-hashtag" aria-hidden="true">
                                                                {{ $loop->iteration }}
                                                            </i> Menunggu Verifikasi
                                                        </span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger w-100">
                                                            <i class="fa fa-hashtag" aria-hidden="true">
                                                                {{ $loop->iteration }}
                                                            </i> Belum Lunas
                                                        </span>
                                                    @endif
                                                    <br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($loan->installmentPayment as $payment)
                                                    <strong>Rp. {{ number_format($loan->loan_amount) }}</strong><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($loan->installmentPayment as $payment)
                                                    @if ($payment->isPay == 0)
                                                        <a href="{{ route('admin.loans.paymentpage', $payment->id) }}"
                                                            class="btn btn-sm btn-success w-100 m-1">
                                                            <i class="fas fa-paper-plane"></i> Cicilan ke-
                                                            {{ $loop->iteration }}
                                                        </a>
                                                    @else
                                                        <button class="btn btn-sm btn-secondary w-100 m-1" disabled>
                                                            <i class="fa fa-check-square" aria-hidden="true"></i> Sudah
                                                            Dilakukan Pembayaran
                                                        </button>
                                                    @endif
                                                    <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @empty
                                        <tr align="center">
                                            <td colspan="4">
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>
                                                        <i class="fa fa-info" aria-hidden="true"></i>
                                                        Pembayaran dapat dilakukan setelah disetujui oleh Bendahara/Ketua
                                                    </strong>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
