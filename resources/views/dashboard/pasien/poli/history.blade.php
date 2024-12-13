@extends('dashboard/master')
@section('title', 'Pasien | Detail Periksa Pasien')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.pasien.poli.index') }}">Daftar Poli</a></li>
                            <li class="breadcrumb-item active">Detail Pemeriksaan Anda</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            Nomor Antrian
                                        </th>
                                        <td>
                                            {{ $periksa->no_antrian }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Jadwal
                                        </th>
                                        <td>
                                            Hari : {{ $periksa->jadwal->hari == 1 ? 'Senin' : '' }}
                                            {{ $periksa->jadwal->hari == 2 ? 'Selasa' : '' }}
                                            {{ $periksa->jadwal->hari == 3 ? 'Rabu' : '' }}
                                            {{ $periksa->jadwal->hari == 4 ? 'Kamis' : '' }}
                                            {{ $periksa->jadwal->hari == 5 ? 'Jumat' : '' }}
                                            {{ $periksa->jadwal->hari == 6 ? 'Sabtu' : '' }}
                                            {{ $periksa->jadwal->hari == 7 ? 'Minggu' : '' }}
                                            <br>
                                            Jam : {{ date('H:i', strtotime($periksa->jadwal->jam_mulai)) }} s/d
                                            {{ date('H:i', strtotime($periksa->jadwal->jam_selesai)) }}
                                            <br>
                                            Tanggal : {{ Carbon\Carbon::parse($periksa->created_at)->format('d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Nama Dokter
                                        </th>
                                        <td>
                                            {{ $periksa->jadwal->dokter->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Nama Pasien
                                        </th>
                                        <td>
                                            {{ $periksa->pasien->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Nomor Rekam Medis
                                        </th>
                                        <td>
                                            {{ $periksa->pasien->no_rm }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Poli
                                        </th>
                                        <td>
                                            {{ $periksa->jadwal->dokter->poli->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Keluhan
                                        </th>
                                        <td>
                                            {{ $periksa->keluhan }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Status
                                        </th>
                                        <td>
                                            @php
                                                // ambil hari ini apakah senin, selasa, rabu, dst
                                                $day = \Carbon\Carbon::now()->format('N');
                                                $timeNow = \Carbon\Carbon::now()->format('H:i:s');
                                                $today = \Carbon\Carbon::now()->format('Y-m-d');
                                            @endphp
                                            @if ($periksa->status == 'waiting')
                                                <span class="badge badge-warning">Belum Diperiksa</span>
                                            @elseif($periksa->created_at->format('Y-m-d') != $today && $periksa->status == 'waiting')
                                                <span class="badge badge-danger">Telat</span>
                                            @elseif($periksa->status == 'done')
                                                <span class="badge badge-success">Sudah Diperiksa</span>
                                            @endif

                                            @if ($periksa->status == 'waiting')
                                                @if ($periksa->jadwal->hari == $day)
                                                    @if ($timeNow >= $periksa->jadwal->jam_mulai && $timeNow <= $periksa->jadwal->jam_selesai)
                                                        <span class="badge badge-primary">
                                                            Saatnya Periksa
                                                        </span>
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <br>
                                @if ($periksa->status == 'done' && $periksa->periksa != null)
                                    <h3>Hasil Periksa</h3>
                                    <h6>
                                        Diperiksa pada tanggal :
                                        {{ Carbon\Carbon::parse($periksa->periksa->tgl_periksa)->format('d F Y') }}
                                    </h6>
                                    <br>
                                    <h5>Obat</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                            </tr>
                                            @if ($periksa->periksa?->obatDetail == null)
                                                <tr>
                                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @else
                                                @foreach ($periksa->periksa->obatDetail as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->obat->name }}</td>
                                                        <td>1</td>
                                                        <td>
                                                            Rp.
                                                            {{ number_format($item->obat->harga, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </thead>
                                    </table>
                                    <br>
                                    <br>
                                    <h5>Catatan</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Catatan dari Dokter</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{ $periksa->periksa?->catatan }}
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                    <br>
                                    <h5>Total Pembayaran</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>
                                                Biaya Poli
                                            </th>
                                            <td>
                                                Rp. 150.000
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Biaya Obat
                                            </th>
                                            <td>
                                                Rp.
                                                {{ number_format($periksa->periksa?->biaya_periksa - 150000, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Total
                                            </th>
                                            <td>
                                                Rp. {{ number_format($periksa->periksa?->biaya_periksa, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </table>
                                @endif
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
