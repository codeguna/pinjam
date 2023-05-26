<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Data Orang Tua</h5>
                <div class="form-group">
                    <label>Nama Orang tua</label>
                    <input type="text" class="form-control" value="{{ $parents->user->name }}" readonly>
                    <small id="helpId" class="form-text text-danger">*nama tidak bisa diganti</small>
                </div>
                <div class="form-group">
                    <label>Nomor Handphone</label>
                    <input class="form-control" type="tel" name="mobile" maxlength="13"
                        value="{{ $parents->mobile }}">
                </div>
                <div class="form-group">
                    <label>Pekerjaan</label>
                    <input type="text" class="form-control" name="occupation" value="{{ $parents->occupation }}">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="address">{{ $parents->address }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Data Mahasiswa</h5>
                <div class="form-group">
                    <label>Nama Mahasiswa</label>
                    <input type="text" class="form-control" name="name" value="{{ $parents->name }}">
                    <small id="helpId" class="form-text text-danger">*isikan dengan nama
                        sebenar-benarnya</small>
                </div>
                <div class="form-group">
                    <label>Nim Mahasiswa</label>
                    <input type="text" class="form-control" name="nim" maxlength="10"
                        value="{{ $parents->nim }}">
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select class="form-control" name="class_id" required>
                        <option value="{{ $parents->class_id }}" selected>{{ $parents->student->class_id }}
                        </option>
                        @foreach ($classRooms as $value => $key)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="studentAddress">{{ $parents->address }}</textarea>
                </div>
            </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
