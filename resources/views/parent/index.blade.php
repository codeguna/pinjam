@extends('layouts.dashboard')

@section('title')
    Data Orang Tua dari Mahasiswa
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Daftar Data Orang Tua
                            </span>

                            @include('parent.modal')
                            <div class="float-right">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#parentModal">
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
                                        <th>Nama Orang Tua</th>
                                        {{-- <th>Anak dari Mahasiswa</th> --}}
                                        <th>Mobile</th>
                                        <th>Occupation</th>
                                        <th>Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parents as $parent)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $parent->user->name }}</td>
                                            {{-- <td>{{ $parent->student->name }}</td> --}}
                                            <td>{{ $parent->mobile }}</td>
                                            <td>{{ $parent->occupation }}</td>
                                            <td>{{ $parent->address }}</td>

                                            <td>
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('admin.parents.edit', $parent->id) }}"><i
                                                        class="fa fa-fw fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $parents->links() !!}
            </div>
        </div>
    </div>
@endsection
