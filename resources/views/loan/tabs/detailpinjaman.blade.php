<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Tanggal Pinjaman</label>
            <input type="text" class="form-control"
                value="{{ DateTime::createFromFormat('Y-m-d', $loan->loan_date)->format('d F Y') }}" readonly>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Jumlah Pinjaman</label>
            <input type="text" class="form-control" value="Rp. {{ number_format($loan->installment_amount) }}"
                readonly>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Lama Pinjaman</label>
            <input type="text" class="form-control" value="{{ $loan->long_installment }} bulan" readonly>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Cicilan Pinjaman</label>
            <input type="text" class="form-control" value="Rp. {{ number_format($loan->loan_amount) }}" readonly>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Keperluan Pinjaman</label>
            <textarea class="form-control" cols="20" rows="10" readonly>{{ $loan->loan_purpose }}</textarea>
        </div>
    </div>
    <div class="col-md-12">
        <h5 class="text-center">
            Kelengkapan Dokumen
        </h5>
        <div class="row justify-content-md-center">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fas fa-id-card"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Kartu Keluarga</span>
                        <span class="info-box-number">
                            <a href="{{ url('/data_kk/' . $loan->attachment_kk) }}" target="_blank">
                                <i class="fas fa-external-link-alt"></i> Cek Lampiran
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-id-card"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Kartu KTP Orang Tua</span>
                        <span class="info-box-number">
                            <a href="{{ url('/data_ktp_ortu/' . $loan->attachment_ktp_orang_tua) }}" target="_blank">
                                <i class="fas fa-external-link-alt"></i> Cek Lampiran
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-id-card"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">KTP Mahasiswa</span>
                        <span class="info-box-number">
                            <a href="{{ url('/data_ktp_mahasiswa/' . $loan->attachment_ktp_mahasiswa) }}"
                                target="_blank">
                                <i class="fas fa-external-link-alt"></i> Cek Lampiran
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
