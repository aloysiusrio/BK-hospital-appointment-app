@extends('dashboard/master')
@section('title', 'Dokter | Detail Riwayat Pasien')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.dokter.riwayat.index') }}">Riwayat Pasien</a></li>
                            <li class="breadcrumb-item active">Detail Riwayat Pasien</li>
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
                            {{-- Pesan Validasi --}}
                            @if ($errors->any())
                                <div class="card-header">
                                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                        <strong>Whoops!</strong> Ada beberapa masalah pada input Anda.<br><br>
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
                                <h3 class="card-title">Detail Riwayat Pasien</h3>
                            </div>

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover text-center">
                                    <thead class="bg-gradient-primary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Periksa</th>
                                            <th>Nama Pasien</th>
                                            <th>Keluhan</th>
                                            <th>Catatan</th>
                                            <th>Obat</th>
                                            <th>Rincian Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($periksa as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->periksa?->tgl_periksa }}</td>
                                                <td>{{ $item->pasien->name }}</td>                                                
                                                <td>{{ $item->keluhan }}</td>
                                                <td>{{ $item->periksa->catatan }}</td>
                                                <td>
                                                    @foreach ($item->periksa->obatDetail as $obat)
                                                        <span class="badge badge-info">{{ $obat->obat->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <table class="table table-sm text-left">
                                                        <tr>
                                                            <td>Biaya Poli:</td>
                                                            <td>Rp. 150.000</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Biaya Obat:</td>
                                                            <td>Rp. {{ number_format($item->periksa->biaya_periksa - 150000, 0, ',', '.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Total Biaya:</strong></td>
                                                            <td><strong>Rp. {{ number_format($item->periksa->biaya_periksa, 0, ',', '.') }}</strong></td>
                                                        </tr>
                                                    </table>
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
