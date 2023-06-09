@extends('layouts.dashboard')

@section('title')
    Daftar Pinjaman
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Pemohon Pinjaman
                            </span>

                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Nama Peminjam</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Jumlah Peminjaman</th>
                                        <th>Status Pembayaran</th>
                                        <th>Persetujuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loans as $loan)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>
                                                <i class="fas fa-user-check"></i>
                                                {{ $loan->studentParent->user->name }}
                                            </td>
                                            <td>
                                                <i class="fas fa-calendar"></i>
                                                {{ DateTime::createFromFormat('Y-m-d', $loan->loan_date)->format('d F Y') }}
                                            </td>
                                            <td>
                                                <span class="badge bg-success">
                                                    Rp. {{ number_format($loan->installment_amount) }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $jumlahCicilan = $loan->installmentPayment->count();
                                                    $jumlahLunas = $loan->installmentPayment->where('isPay', 1)->count();
                                                    $persentase = ($jumlahLunas / $jumlahCicilan) * 100;
                                                @endphp
                                                <i class="fas fa-check"></i> {{ number_format($persentase, 2, ',', '.') }}%
                                                Pembayaran Lunas
                                            </td>
                                            <td>
                                                @foreach ($loan->loanApproval as $approval)
                                                    @if ($approval->approved == 0)
                                                        <span class="badge bg-warning"
                                                            title="Belum Disetujui {{ $approval->name }}">
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
                                            </td>
                                            <td>
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <a class="btn btn-sm btn-primary btn-sm"
                                                        href="{{ route('admin.loans.show', $loan->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    @can('edit_pinjaman')
                                                        <a class="btn btn-sm btn-success btn-sm"
                                                            href="{{ route('admin.loans.edit', $loan->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i></a>
                                                    @endcan


                                                    @can('delete_pinjaman')
                                                        <form action="{{ route('admin.loans.destroy', $loan->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-fw fa-trash"></i></button>
                                                        </form>
                                                    @endcan

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- {!! $loans->links() !!} --}}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
