@extends('layouts.dashboard')

@section('title')
    Welcome
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @can('create_pinjaman')
                @php
                    $getId = Auth::user()->id;
                @endphp
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Update Profil</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">Sebelum mengajukan pinjaman, silahkan update profil terlebih dahulu!</h6>

                            <p class="card-text">Bisa akses secara mudah melalui tombol dibawah ini.</p>
                            <a href="{{ route('admin.parent.get-profile', $getId) }}" class="btn btn-warning"><i
                                    class="fas fa-pencil-alt"></i> Update Profil</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Pinjaman</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">Ajukan pinjaman sekarang!</h6>

                            <p class="card-text">Bisa akses secara mudah melalui tombol dibawah ini.</p>
                            <a href="{{ route('admin.loans.create') }}" class="btn btn-primary"><i
                                    class="fas fa-paper-plane"></i> Ajukan Pinjaman</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            @endcan


        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('scripts')
    @parent
@endsection
