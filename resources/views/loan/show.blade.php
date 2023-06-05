@extends('layouts.dashboard')

@section('title')
    Data Detail Peminjam | {{ $loan->studentParent->user->name }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <a class="btn btn-primary" href="{{ route('admin.loans.index') }}">
                                <i class="fas fa-home"></i>
                                Kembali</a>
                        </div>
                        <div class="float-right">
                            <div class="dropdown dropleft">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    @can('approval_pinjaman_bendahara')
                                        <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="level" value="1">
                                            <input type="hidden" name="approved" value="1">
                                            @if ($ketuaApproved->approved == 1)
                                                <button class="dropdown-item" type="submit" disabled>Setujui Pinjaman
                                                    (Bendahara)</button>
                                            @else
                                                <button class="dropdown-item" type="submit">Setujui Pinjaman
                                                    (Bendahara)</button>
                                            @endif
                                        </form>
                                    @endcan
                                    @can('approval_pinjaman_ketua')
                                        <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="level" value="2">
                                            <input type="hidden" name="approved" value="1">
                                            @if ($bendaharaApproved->approved == 1)
                                                <button class="dropdown-item" type="submit">Setujui Pinjaman (Ketua)</button>
                                            @else
                                                <button class="dropdown-item" type="submit" disabled>Setujui Pinjaman
                                                    (Ketua)</button>
                                            @endif
                                        </form>
                                    @endcan

                                    <hr>
                                    @can('reject_pinjaman_bendahara')
                                        <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="level" value="1">
                                            <input type="hidden" name="approved" value="0">
                                            @if ($ketuaApproved->approved == 1)
                                                <button class="dropdown-item" type="submit" disabled>Tolak Pinjaman
                                                    (Bendahara)</button>
                                            @else
                                                <button class="dropdown-item" type="submit">Tolak Pinjaman (Bendahara)</button>
                                            @endif

                                        </form>
                                    @endcan
                                    @can('reject_pinjaman_ketua')
                                        <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="level" value="2">
                                            <input type="hidden" name="approved" value="0">

                                            @if ($bendaharaApproved->approved == 1)
                                                <button class="dropdown-item" type="submit">Tolak Pinjaman (Ketua)</button>
                                            @else
                                                <button class="dropdown-item" type="submit" disabled>Tolak Pinjaman
                                                    (Ketua)</button>
                                            @endif

                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <!-- Tabs navs -->
                                <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="ex1-tab-1" data-toggle="tab" href="#ex1-tabs-1"
                                            role="tab" aria-controls="ex1-tabs-1" aria-selected="false"><i
                                                class="fas fa-user-check"></i> Data
                                            Peminjam</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="ex1-tab-2" data-toggle="tab" href="#ex1-tabs-2"
                                            role="tab" aria-controls="ex1-tabs-2" aria-selected="true"><i
                                                class="fas fa-money-check"></i> Detail
                                            Pinjaman</a>
                                    </li>
                                </ul>
                                <!-- Tabs navs -->
                                {{-- Tabs Content --}}
                                <div class="tab-content" id="ex1-content">
                                    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel"
                                        aria-labelledby="ex1-tab-1">
                                        @include('loan.tabs.datapeminjam')
                                    </div>
                                    <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                        @include('loan.tabs.detailpinjaman')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h4>Status Persetujuan:
                            @foreach ($loan->loanApproval as $approval)
                                @if ($approval->approved == 0)
                                    <span class="badge bg-warning" title="Belum Disetujui {{ $approval->name }}">
                                        <i class="fas fa-times-circle"></i>
                                        {{ $approval->name }}
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle"></i>
                                        {{ $approval->name }}
                                    </span>
                                @endif
                            @endforeach
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
