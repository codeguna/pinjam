@extends('layouts.dashboard')

@section('title')
    Update Profile
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card text-start">
            <div class="card-body">
                <form action="{{ route('admin.parent.update-profile') }}" method="POST">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $students->id }}">
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
                                <input type="text" class="form-control" name="occupation"
                                    value="{{ $parents->occupation }}">
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
                                <input type="text" class="form-control" name="name" value="{{ $students->name }}">
                                <small id="helpId" class="form-text text-danger">*isikan dengan nama
                                    sebenar-benarnya</small>
                            </div>
                            <div class="form-group">
                                <label>Nim Mahasiswa</label>
                                <input type="text" class="form-control" name="nim" maxlength="10"
                                    value="{{ $students->nim }}">
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-control" name="class_id" required>
                                    <option value="{{ $students->class_id }}" selected>{{ $students->classRoom->name }}
                                    </option>
                                    @foreach ($classRooms as $value => $key)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="studentAddress">{{ $students->address }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-check-circle" aria-hidden="true"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
