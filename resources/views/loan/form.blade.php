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
                    <input class="form-control" type="tel" maxlength="13" value="{{ $parents->mobile }}" readonly>
                </div>
                <div class="form-group">
                    <label>Pekerjaan</label>
                    <input type="text" class="form-control" value="{{ $parents->occupation }}" readonly>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" readonly>{{ $parents->address }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Data Mahasiswa</h5>
                <div class="form-group">
                    <label>Nama Mahasiswa</label>
                    <input type="text" class="form-control" value="{{ $parents->student->name }}" readonly>
                    <small id="helpId" class="form-text text-danger">*isikan dengan nama
                        sebenar-benarnya</small>
                </div>
                <div class="form-group">
                    <label>Nim Mahasiswa</label>
                    <input type="text" class="form-control" maxlength="10" value="{{ $parents->student->nim }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    @php
                        $className = App\Models\ClassRoom::select('name')
                            ->where('id', $parents->student->class_id)
                            ->first();
                    @endphp
                    <select class="form-control" readonly>
                        <option value="{{ $parents->student->class_id }}" selected>{{ $className->name }}
                        </option>
                        @foreach ($classRooms as $value => $key)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" readonly>{{ $parents->student->address }}</textarea>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <br>
    @include('loan.additionalform')
</div>
<br>
<hr>
<div class="box-footer mt20">
    <button type="submit" class="btn btn-primary">
        <i class="fa fa-check-circle" aria-hidden="true"></i>
        Submit
    </button>
</div>
