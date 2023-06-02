@extends('layouts.dashboard')

@section('title')
    Data Mahasiswa dengan Orang Tua
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Daftar Mahasiswa dengan Orang Tua
                            </span>
                            @include('student.modal')
                            <div class="float-right">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#studentModal">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Nama Mahasiswa</th>
                                        <th>Nama Orang Tua</th>
                                        <th>Nim</th>
                                        <th>Class Id</th>
                                        <th>Address</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        @php
                                            $parentName = \App\User::select('name')
                                                ->where('id', $student->studentParent->user_id)
                                                ->first();
                                        @endphp
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $student->name }}</td>
                                            <td>{{ $parentName->name }}</td>
                                            <td>{{ $student->nim }}</td>
                                            <td>{{ $student->classRoom->name }}</td>
                                            <td>{{ $student->address }}</td>

                                            <td>
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('admin.students.edit', $student->id) }}"><i
                                                        class="fa fa-fw fa-edit"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $students->links() !!}
            </div>
        </div>
    </div>
@endsection
