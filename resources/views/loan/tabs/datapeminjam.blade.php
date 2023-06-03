<div class="row">
    <input type="hidden" name="loan_id" value="{{ $loan->id }}">
    <div class="col-md-6">
        <h5>Data Orang Tua</h5>
        <div class="form-group">
            <label>Nama Orang tua</label>
            <input type="text" class="form-control" value="{{ $loan->studentParent->user->name }}" readonly>
            <small class="form-text text-danger">*nama tidak bisa diganti</small>
        </div>
        <div class="form-group">
            <label>Nomor Handphone</label>
            <input class="form-control" type="tel" maxlength="13" value="{{ $loan->studentParent->mobile }}"
                readonly>
        </div>
        <div class="form-group">
            <label>Pekerjaan</label>
            <input type="text" class="form-control" value="{{ $loan->studentParent->occupation }}" readonly>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" readonly>{{ $loan->studentParent->address }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <h5>Data Mahasiswa</h5>
        <div class="form-group">
            <label>Nama Mahasiswa</label>
            <input type="text" class="form-control" value="{{ $loan->studentParent->student->name }}" readonly>
            <small id="helpId" class="form-text text-danger">*isikan dengan nama
                sebenar-benarnya</small>
        </div>
        <div class="form-group">
            <label>Nim Mahasiswa</label>
            <input type="text" class="form-control" maxlength="10" value="{{ $loan->studentParent->student->nim }}"
                readonly>
        </div>
        <div class="form-group">
            <label>Kelas</label>
            <input class="form-control" type="text" value="{{ $loan->studentParent->student->classRoom->name }}"
                readonly>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" readonly>{{ $loan->studentParent->student->address }}</textarea>
        </div>
    </div>
</div>
