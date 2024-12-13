@extends('dashboard/master')
@section('title', 'Dokter | Jadwal')
@section('content')
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Jadwal Praktek</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Tambah Jadwal Praktek</h3>
                    </div>
                    <div class="card-body">
                        <!-- Error Handling -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Whoops!</strong> Terjadi kesalahan input data:
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Form Input -->
                        <form method="POST" action="{{ route('dashboard.dokter.jadwal.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="hari" class="form-label">Hari <span class="text-danger">*</span></label>
                                    <select name="hari" id="hari" class="form-control @error('hari') is-invalid @enderror">
                                        <option value="">-- Pilih Hari --</option>
                                        <option value="1">Senin</option>
                                        <option value="2">Selasa</option>
                                        <option value="3">Rabu</option>
                                        <option value="4">Kamis</option>
                                        <option value="5">Jumat</option>
                                        <option value="6">Sabtu</option>
                                        <option value="7">Minggu</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="jam_mulai" class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror"
                                           id="jam_mulai" name="jam_mulai">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="jam_selesai" class="form-label">Jam Selesai <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror"
                                           id="jam_selesai" name="jam_selesai">
                                </div>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="active" name="active" value="1">
                                <label class="form-check-label" for="active">Jadikan Sebagai Jadwal Aktif</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>

                <!-- Tabel Jadwal Praktek -->
                <div class="card mt-4 shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Jadwal Praktek Sekarang</h3>
                    </div>
                    <div class="card-body">
                        @if ($jadwal)
                            <table class="table table-hover">
                                <thead class="table">
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jadwal as $item)
                                        <tr>
                                            <td>
                                                @switch($item->hari)
                                                    @case(1) Senin @break
                                                    @case(2) Selasa @break
                                                    @case(3) Rabu @break
                                                    @case(4) Kamis @break
                                                    @case(5) Jumat @break
                                                    @case(6) Sabtu @break
                                                    @case(7) Minggu @break
                                                @endswitch
                                            </td>
                                            <td>{{ date('H:i', strtotime($item->jam_mulai)) }}</td>
                                            <td>{{ date('H:i', strtotime($item->jam_selesai)) }}</td>
                                            <td>
                                                <span class="badge {{ $item->active ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $item->active ? 'Aktif' : 'Nonaktif' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('dashboard.dokter.jadwal.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>                                                
                                                <form action="{{ route('dashboard.dokter.jadwal.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                                @if (!$item->active)
                                                    <form action="{{ route('dashboard.dokter.jadwal.toggleActive', $item->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary btn-sm">Aktifkan</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada jadwal</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @else
                            <p class="text-center mt-3">Anda belum memiliki jadwal praktek. Atur jadwal di form atas.</p>
                        @endif
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
