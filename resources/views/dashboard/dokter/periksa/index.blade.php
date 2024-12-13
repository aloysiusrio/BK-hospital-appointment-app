@extends('dashboard/master')
@section('title', 'Dokter | Daftar Pasien')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Daftar Pasien</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            {{-- Message Error Validation --}}
                            @if ($errors->any())
                                <div class="card-header">
                                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">Daftar Pasien</h3>
                            </div>

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover text-center">
                                    <thead class="bg-gradient-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>No Antrian</th>
                                            <th>Pasien</th>
                                            <th>Keluhan</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($daftar as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->no_antrian }}</td>
                                                <td>{{ $item->pasien->name }}</td>
                                                <td>{{ $item->keluhan }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d h:i:s') }}</td>
                                                <td>
                                                    @php
                                                        $today = \Carbon\Carbon::now()->format('Y-m-d');
                                                    @endphp
                                                    @if ($item->status == 'waiting')
                                                        <span class="badge bg-warning">
                                                            <i class="fas fa-hourglass-half"></i> Menunggu
                                                        </span>
                                                    @elseif($item->created_at->format('Y-m-d') != $today && $item->status == 'waiting')
                                                        <span class="badge bg-danger">
                                                            <i class="fas fa-exclamation-triangle"></i> Telat
                                                        </span>
                                                    @elseif($item->status == 'done')
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check-circle"></i> Selesai
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status == 'waiting')
                                                        <a href="{{ route('dashboard.dokter.periksa.form', $item->id) }}"
                                                           class="btn btn-sm btn-primary">
                                                            <i class="fas fa-stethoscope"></i> Periksa
                                                        </a>
                                                    @endif

                                                    @if ($item->status == 'done')
                                                        <a href="{{ route('dashboard.dokter.periksa.form', $item->id) }}"
                                                           class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
