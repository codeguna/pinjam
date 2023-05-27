<div class="row">
    <div class="col-md-12">
        <div class="form-gorup">
            <label>Tanggal Peminjaman</label>
            <input type="date" class="form-control" name="loan_date" required>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Pengajuan untuk Keperluan</label>
            <textarea class="form-control" name="loan_purpose" rows="3" required></textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Nominal Pinjaman</label>
            <input type="number" min="0" class="form-control" name="installment_amount" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Lama Cicilan</label>
            <input type="number" class="form-control" name="long_installment" placeholder="bulan"
                onchange="calculateLoanAmount()" required>
            <small class="form-text text-danger">*satuan Bulan</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Jumlah Cicilan</label>
            <input type="number" class="form-control" name="loan_amount" placeholder="rupiah" readonly required>
            <small class="form-text text-danger">*satuan Rupiah</small>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Nomor Rekening</label>
            <input type="number" min="0" maxlength="10" class="form-control" name="account_number" required>
            <small class="form-text text-info">*Bank BNI</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Upload Kartu Keluarga</label>
            <input type="file" class="form-control-file" name="attachment_kk" required>
            <small class="form-text text-danger">*file .jpg, .jpeg, .png</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Upload KTP Orang Tua</label>
            <input type="file" class="form-control-file" name="attachment_ktp_orang_tua" required>
            <small class="form-text text-danger">*file .jpg, .jpeg, .png</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Upload KTP Mahasiswa</label>
            <input type="file" class="form-control-file" name="attachment_ktp_mahasiswa" required>
            <small class="form-text text-danger">*file .jpg, .jpeg, .png</small>
        </div>
    </div>
    <div class="col-md-12">
        <p>
            <small>
                Bilamana sampai kelulusan anak saya masih ada tunggakan yang belum diselesaikan, maka ijazah
                anak saya akan ditahan dan dititipkan di <strong>IOM POLMAN</strong>, hingga pinjaman tsb
                dilunasi.
            </small>

        </p>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="agreement" value="1" required>
                Saya Menyetujuinya
            </label>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        function calculateLoanAmount() {
            var installmentAmount = parseFloat(document.getElementsByName("installment_amount")[0].value);
            var loanDuration = parseFloat(document.getElementsByName("long_installment")[0].value);
            var loanAmountInput = document.getElementsByName("loan_amount")[0];

            var loanAmount = installmentAmount / loanDuration;
            loanAmountInput.value = loanAmount.toFixed(2);
        }
    </script>
@endsection
