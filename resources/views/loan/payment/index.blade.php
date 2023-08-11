@extends('layouts.dashboard')

@section('title')
    Pembayaran
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h3>
                            Jumlah yang harus dibayar
                        </h3>
                        <div class="btn-group" role="group">
                            <input class="form-control" type="text" id="loan_amount"
                                value="{{ number_format($installmentPayment->loan->loan_amount) }}" readonly>
                            <button type="button" class="btn btn-sm btn-outlined" onclick="clipboardAmount()">
                                <i class="fas fa-copy    "></i>
                            </button>
                        </div>
                        <p>
                            <small class="text-muted">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                Saat melakukan pembayaran, mohon pastikan agar nominal pembayaran sesuai dengan jumlah yang
                                harus dibayar
                            </small>
                        </p>

                        <form action="{{ route('admin.loans.paymentprocess') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="loan_id" value="{{ $installmentPayment->id }}">
                            <div class="form-group">
                                <label>Saya sudah melunasi</label>
                                <input type="file" class="form-control-file bg-primary" name="attachment_payment"
                                    required>
                                <small class="form-text text-muted">*Upload bukti pembayaran</small>
                            </div>
                            <div class="container py-1 mt-3">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-12">
                                        <p>
                                            Rekening Pembayaran
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card rounded-3">
                                            <div class="card-body mx-1 my-2">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <img src="https://i0.wp.com/febi.uinsaid.ac.id/wp-content/uploads/2020/11/Logo-BRI-Bank-Rakyat-Indonesia-PNG-Terbaru.png?ssl=1"
                                                            height="50px">
                                                    </div>
                                                    <div>
                                                        <p class="d-flex flex-column ml-3 mb-0">
                                                            <b>Bank BRI</b><span class="small text-muted">0748 0501 2891
                                                                222 <button type="button" class="btn btn-sm btn-outlined"
                                                                    onclick="clipboardAmount()">
                                                                    <i class="fas fa-copy"></i>
                                                                </button></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card rounded-3">
                                            <div class="card-body mx-1 my-2">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <img src="data:image/png;base64,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"
                                                            height="50px">
                                                    </div>
                                                    <div>
                                                        <p class="d-flex flex-column ml-3 mb-0">
                                                            <b>Bank BNI</b><span class="small text-muted">9884 4808 2542
                                                                7711 <button type="button" class="btn btn-sm btn-outlined"
                                                                    onclick="clipboardAmount()">
                                                                    <i class="fas fa-copy    "></i>
                                                                </button></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>
                                            <strong>Cara Pembayaran:</strong>
                                        </h6>
                                        <ol>
                                            <li>Pilih nomor rekening di atas, lalu salin Kode Rekening di atas ke kode
                                                pembayaran.</li>
                                            <li>Jika sudah melakukan transfer, tekan tombol "Saya sudah melunasi" lalu klik
                                                Bayar.</li>
                                            <li>Kembali ke halaman utama untuk melihat tanggal jatuh tempo, jika tanggal
                                                berubah
                                                maka proses pembayaran telah selesai.</li>
                                        </ol>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-warning" type="submit">
                                            <i class="fas fa-check-circle"></i> Bayar
                                        </button>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        function clipboardAmount() {
            // Get the text field
            var copyText = document.getElementById("loan_amount");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Nominal pembayaran berhasil disalin: " + copyText.value);
        }
    </script>
@endsection
