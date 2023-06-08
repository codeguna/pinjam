@extends('layouts.dashboard')

@section('title')
    {{ __('Update') }} Loan - {{ $loan->studentParent->user->name }}
@endsection

@section('content')
    <section class="content container-fluid">
        @includeif('partials.errors')
        <div class="card card-default">
            <div class="card-header">
                <span class="card-title">Perbarui Peminjaman</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.loans.update', $loan->id) }}" role="form"
                    enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-gorup">
                                <label>Tanggal Peminjaman</label>
                                <input type="date" class="form-control" name="loan_date" value="{{ $loan->loan_date }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pengajuan untuk Keperluan</label>
                                <textarea class="form-control" name="loan_purpose" rows="3">{{ $loan->loan_purpose }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nominal Pinjaman</label>
                                <input type="number" min="0" class="form-control" name="installment_amount"
                                    onchange="calculateLoanAmount()" value="{{ $loan->installment_amount }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lama Cicilan</label>
                                <input type="number" class="form-control" name="long_installment" placeholder="bulan"
                                    onchange="calculateLoanAmount()" value="{{ $loan->long_installment }}">
                                <small class="form-text text-danger">*satuan Bulan</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah Cicilan</label>
                                <input type="number" class="form-control" name="loan_amount" placeholder="rupiah" readonly
                                    value="{{ $loan->loan_amount }}">
                                <small class="form-text text-danger">*satuan Rupiah</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nomor Rekening</label>
                                <input type="number" min="0" maxlength="10" class="form-control"
                                    name="account_number" value="{{ $loan->account_number }}">
                                <small class="form-text text-info">*Bank BNI</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Upload Kartu Keluarga</label>
                                <input type="file" class="form-control-file" name="attachment_kk">
                                <small class="form-text text-info">
                                    <a href="{{ url('/data_kk/' . $loan->attachment_kk) }}" target="_blank">
                                        {{ $loan->attachment_kk }}
                                    </a>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Upload KTP Orang Tua</label>
                                <input type="file" class="form-control-file" name="attachment_ktp_orang_tua">
                                <small class="form-text text-info">
                                    <a href="{{ url('/data_ktp_ortu/' . $loan->attachment_ktp_orang_tua) }}"
                                        target="_blank">
                                        {{ $loan->attachment_ktp_orang_tua }}
                                    </a>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Upload KTP Mahasiswa</label>
                                <input type="file" class="form-control-file" name="attachment_ktp_mahasiswa">
                                <small class="form-text text-info">
                                    <a href="{{ url('/data_ktp_mahasiswa/' . $loan->attachment_ktp_mahasiswa) }}"
                                        target="_blank">
                                        {{ $loan->attachment_ktp_mahasiswa }}
                                    </a>
                                </small>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="sub">
                            <i class="fas fa-check"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function calculateLoanAmount() {
            var installmentAmount = document.getElementsByName("installment_amount")[0].value;
            var loanDuration = document.getElementsByName("long_installment")[0].value;
            var loanAmountInput = document.getElementsByName("loan_amount")[0];

            var loanAmount = installmentAmount / loanDuration;
            loanAmountInput.value = loanAmount.toFixed(2);
        }
    </script>
@endsection
