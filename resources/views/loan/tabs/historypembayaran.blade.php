<div class="row">
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Status</th>
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loan->installmentPayment as $payment)
                    <tr>
                        <td>
                            Angsuran ke- {{ $payment->installment }}
                        </td>
                        <td>
                            @if ($payment->payment_date == null)
                                <span class="badge bg-warning">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    Belum ada pembayaran
                                </span>
                            @else
                                <span class="badge bg-info">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    {{ DateTime::createFromFormat('Y-m-d', $payment->payment_date)->format('d F Y') }}
                                </span>
                            @endif
                        </td>
                        <td>
                            @if ($payment->isPay == 0)
                                <span class="badge bg-danger">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    Belum Lunas
                                </span>
                            @elseif ($payment->isPay == 2)
                                <span class="badge bg-warning">
                                    <i class="fa fa-inbox" aria-hidden="true"></i>
                                    Pembayaran Diterima
                                </span> <br>
                                <small class="text-danger">*Lakukan verifikasi pembayaran</small>
                            @else
                                <span class="badge bg-success">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    Lunas
                                </span>
                            @endif
                        </td>
                        <td>
                            @if ($payment->attachment == null)
                                <i class="fa fa-times-circle"></i> Belum ada bukti pembayaran
                            @else
                                <a href="#" target="_blank">
                                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($payment->isPay == 0)
                                @can('approval_pembayaran_bendahara')
                                    <a class="btn btn-success"
                                        href="{{ route('admin.loans.paymentapprove', $payment->id) }}">
                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                    </a>
                                @endcan
                            @else
                                @can('reject_pembayaran_bendahara')
                                    <a class="btn btn-warning"
                                        href="{{ route('admin.loans.paymentreject', $payment->id) }}">
                                        <i class="fa fa-undo" aria-hidden="true"></i>
                                    </a>
                                @endcan
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
