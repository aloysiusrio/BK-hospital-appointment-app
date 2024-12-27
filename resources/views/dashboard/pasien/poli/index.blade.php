@extends('dashboard/master')
@section('title', 'Pasien | Daftar Poli')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Daftar Poli</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            @if ($errors->any())
                                <div class="card-header">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Whoops!</strong> Terjadi kesalahan input data yang anda
                                        masukan.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }} </li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert"
                                                aria-label="close">
                                            <span aria-hidden="true"> &times; </span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">Daftar Poli</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 mx-auto">
                                        <form method="POST" action="{{ route('dashboard.pasien.poli.store') }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="no_rm">Nomor Rekam Medis</label>
                                                    <input type="no_rm"
                                                           class="form-control rounded-0 @error('jam_mulai') is-invalid @enderror"
                                                           value="{{ Auth::user()->pasien->no_rm }}" readonly>
                                                </div>
                                                <label for="nama">Pilih Poli <span class="text-danger">*</span></label>
                                                <select name="poli_id" id="poli_id" class="form-control">
                                                    <option value="">-- Pilih Poli --</option>
                                                    @foreach ($polis as $poli)
                                                        <option value="{{ $poli->id }}">
                                                            {{ $poli->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Pilih Jadwal <span class="text-danger">*</span></label>
                                                <select name="jadwal_id" id="jadwal_id" class="form-control">
                                                    <option value="">-- Pilih Jadwal --</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Keluhan <span class="text-danger">*</span></label>
                                                <textarea id="" cols="30" rows="3" class="form-control" name="keluhan" placeholder="Keluhan">{{ old('keluhan') }}</textarea>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mx-auto">
                                        <table id="example1" class="table table-bordered table-hover">
                                            <thead class="bg-gradient-primary text-white">
                                            <tr class="text-center">
                                                <th>No Antrian</th>
                                                <th>Poli</th>
                                                <th>Dokter</th>
                                                <th>Keluhan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($daftarPoli as $item)
                                                <tr>
                                                    <td>{{ $item->no_antrian }}</td>
                                                    <td>
                                                        {{ $item->jadwal->dokter->poli->name }}
                                                        <br>
                                                        {{ $item->jadwal->hari == 1 ? 'Senin' : '' }}
                                                        {{ $item->jadwal->hari == 2 ? 'Selasa' : '' }}
                                                        {{ $item->jadwal->hari == 3 ? 'Rabu' : '' }}
                                                        {{ $item->jadwal->hari == 4 ? 'Kamis' : '' }}
                                                        {{ $item->jadwal->hari == 5 ? 'Jumat' : '' }}
                                                        {{ $item->jadwal->hari == 6 ? 'Sabtu' : '' }}
                                                        {{ $item->jadwal->hari == 7 ? 'Minggu' : '' }}
                                                        <br> Jam {{ $item->jadwal->jam_mulai }} s/d
                                                        {{ $item->jadwal->jam_selesai }}
                                                        <br>
                                                    </td>
                                                    <td>
                                                        {{ $item->jadwal->dokter->name }}
                                                    </td>
                                                    <td>{{ $item->keluhan }}</td>
                                                    <td>
                                                        @php
                                                            // ambil hari ini apakah senin, selasa, rabu, dst
                                                            $day = \Carbon\Carbon::now()->format('N');
                                                            $timeNow = \Carbon\Carbon::now()->format('H:i:s');
                                                            $today = \Carbon\Carbon::now()->format('Y-m-d');
                                                        @endphp
                                                        @if ($item->status == 'waiting')
                                                            <span class="badge badge-warning">Belum Diperiksa</span>
                                                        @elseif($item->created_at->format('Y-m-d') != $today && $item->status == 'waiting')
                                                            <span class="badge badge-danger">Telat</span>
                                                        @elseif($item->status == 'done')
                                                            <span class="badge badge-success">Sudah Diperiksa</span>
                                                        @endif

                                                        @if ($item->status == 'waiting')
                                                            @if ($item->jadwal->hari == $day)
                                                                @if ($timeNow >= $item->jadwal->jam_mulai && $timeNow <= $item->jadwal->jam_selesai)
                                                                    <span class="badge badge-primary">
                                                                        Saatnya Periksa
                                                                    </span>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('dashboard.pasien.poli.show', $item->id) }}"
                                                           class="btn btn-sm btn-info">
                                                            Detail Periksa
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('poli_id').addEventListener('change', function () {
                var selectedPoli = this.value;

                var jadwalDropdown = document.getElementById('jadwal_id');
                jadwalDropdown.innerHTML = '<option value="">-- Pilih Jadwal --</option>';

                @foreach ($jadwals as $item)
                if ("{{ $item->dokter->poli->id }}" === selectedPoli) {
                    var option = document.createElement('option');
                    option.value = "{{ $item->id }}";
                    const dokterName = "{{ $item->dokter->name }}"
                    const name = dokterName.split(' ');

                    option.text = `dr. ${name[0]} - ` +
                        '{{ $item->hari == 1 ? 'Senin' : '' }}' +
                        '{{ $item->hari == 2 ? 'Selasa' : '' }}' +
                        '{{ $item->hari == 3 ? 'Rabu' : '' }}' +
                        '{{ $item->hari == 4 ? 'Kamis' : '' }}' +
                        '{{ $item->hari == 5 ? 'Jumat' : '' }}' +
                        '{{ $item->hari == 6 ? 'Sabtu' : '' }}' +
                        '{{ $item->hari == 7 ? 'Minggu' : '' }}' +
                        ' - {{ date('H:i', strtotime($item->jam_mulai)) }} s/d {{ date('H:i', strtotime($item->jam_selesai)) }}';
                    jadwalDropdown.appendChild(option);
                }
                @endforeach

                jadwalDropdown.style.display = 'block';
            });
        });
    </script>
@endsection
