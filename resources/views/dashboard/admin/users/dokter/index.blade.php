@extends('dashboard/master')
@section('title', 'Dokter')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dokter</li>
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
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">Data Dokter</h3>
                            </div>
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalTambah">
                                    <i class="fas fa-file"></i> Tambah Data
                                </button>
                                {{-- message error validation --}}
                                @if ($errors->any())
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
                                @endif
                                <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="modalTambahLabel">Tambah Data Dokter Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('dashboard.admin.users.dokter.store') }}" enctype="multipart/form-data" id="formTambah">
                                                @csrf
                                                <div class="modal-body">
                                                    {{-- Email --}}
                                                    <div class="form-group">
                                                        <label for="email">Email <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control rounded-0 @error('email') is-invalid @enderror"
                                                            id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email...">
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                
                                                    {{-- Nama --}}
                                                    <div class="form-group">
                                                        <label for="name">Nama <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control rounded-0 @error('name') is-invalid @enderror"
                                                            id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama...">
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                
                                                    {{-- No Telp --}}
                                                    <div class="form-group">
                                                        <label for="no_hp">No Telp <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control rounded-0 @error('no_hp') is-invalid @enderror"
                                                            id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="Masukkan no telp...">
                                                        @error('no_hp')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                
                                                    {{-- Alamat --}}
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                                        <textarea class="form-control rounded-0 @error('alamat') is-invalid @enderror"
                                                            id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat...">{{ old('alamat') }}</textarea>
                                                        @error('alamat')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                
                                                    {{-- Password --}}
                                                    <div class="form-group">
                                                        <label for="password">Password <span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control rounded-0 @error('password') is-invalid @enderror"
                                                            id="password" name="password" placeholder="Masukkan password...">
                                                        @error('password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                
                                                    {{-- Poli --}}
                                                    <div class="form-group">
                                                        <label for="poli_id">Poli <span class="text-danger">*</span></label>
                                                        <select name="poli_id" id="poli_id" class="form-control @error('poli_id') is-invalid @enderror">
                                                            <option value="" disabled selected>Pilih poli...</option>
                                                            @foreach ($polis as $item)
                                                                <option value="{{ $item->id }}" {{ old('poli_id') == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('poli_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead class="bg-gradient-primary text-white">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Poli</th>
                                            <th>Email</th>
                                            <th>Nama</th>
                                            <th>Phone</th>
                                            <th>Alamat</th>
                                            <th>Jadwal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dokters as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->poli->name }}</td>
                                                <td>{{ $item->user->email }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->no_hp }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>
                                                    @if ($item->jadwalPeriksa)
                                                        <p>
                                                            Hari :
                                                            {{ $item->jadwalPeriksa->hari == 1 ? 'Senin' : '' }}
                                                            {{ $item->jadwalPeriksa->hari == 2 ? 'Selasa' : '' }}
                                                            {{ $item->jadwalPeriksa->hari == 3 ? 'Rabu' : '' }}
                                                            {{ $item->jadwalPeriksa->hari == 4 ? 'Kamis' : '' }}
                                                            {{ $item->jadwalPeriksa->hari == 5 ? 'Jumat' : '' }}
                                                            {{ $item->jadwalPeriksa->hari == 6 ? 'Sabtu' : '' }}
                                                            {{ $item->jadwalPeriksa->hari == 7 ? 'Minggu' : '' }}
                                                            <br>
                                                            Jam Mulai :
                                                            {{ $item->jadwalPeriksa->jam_mulai }}
                                                            <br>
                                                            Jam Selesai :
                                                            {{ $item->jadwalPeriksa->jam_selesai }}
                                                        </p>
                                                    @else
                                                        Dokter belum mengatur jadwal
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->user->is_active == 1)
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit-{{ $item->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapus-{{ $item->user->id }}">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{ route('dashboard.admin.users.dokter.update', $item->user->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal fade" id="modalEdit-{{ $item->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Data : {{ $item->name }}</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="email">Email <span class="text-danger">*</span></label>
                                                                            <input type="email"
                                                                                class="form-control rounded-0 @error('email') is-invalid @enderror"
                                                                                id="email" name="email"
                                                                                value="{{ $item->user->email }}"
                                                                                placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nama">No Telp <span class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('no_hp') is-invalid @enderror"
                                                                                id="no_hp" name="no_hp"
                                                                                value="{{ $item->no_hp }}"
                                                                                placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nama">Nama <span class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('name') is-invalid @enderror"
                                                                                id="name" name="name"
                                                                                value="{{ $item->name }}"
                                                                                placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nama">Alamat <span class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('alamat') is-invalid @enderror"
                                                                                id="alamat" name="alamat"
                                                                                value="{{ $item->alamat }}"
                                                                                placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nama">Hari <span class="text-danger">*</span></label>
                                                                            <select name="hari" id="hari"
                                                                                class="form-control">
                                                                                <option value="1"
                                                                                    {{ $item->hari == 1 ? 'selected' : '' }}>
                                                                                    Senin</option>
                                                                                <option value="2"
                                                                                    {{ $item->hari == 2 ? 'selected' : '' }}>
                                                                                    Selasa</option>
                                                                                <option value="3"
                                                                                    {{ $item->hari == 3 ? 'selected' : '' }}>
                                                                                    Rabu</option>
                                                                                <option value="4"
                                                                                    {{ $item->hari == 4 ? 'selected' : '' }}>
                                                                                    Kamis</option>
                                                                                <option value="5"
                                                                                    {{ $item->hari == 5 ? 'selected' : '' }}>
                                                                                    Jumat</option>
                                                                                <option value="6"
                                                                                    {{ $item->hari == 6 ? 'selected' : '' }}>
                                                                                    Sabtu</option>
                                                                                <option value="7"
                                                                                    {{ $item->hari == 7 ? 'selected' : '' }}>
                                                                                    Minggu</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nama">Poli <span class="text-danger">*</span></label>
                                                                            <select name="poli_id" id="poli_id"
                                                                                class="form-control">
                                                                                @foreach ($polis as $poli)
                                                                                    <option
                                                                                        value="{{ $poli->id }}">
                                                                                        {{ $poli->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nama">Is Active <span class="text-danger">*</span></label>
                                                                            <select name="is_active" id="is_active"
                                                                                class="form-control"
                                                                                value={{ $item->user->is_active }}>
                                                                                <option value="1">Active</option>
                                                                                <option value="0">Non Active
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-warning">Update</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form method="POST" action="{{ route('dashboard.admin.users.dokter.destroy', $item->user->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal fade" id="modalHapus-{{ $item->user->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Hapus Data</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Anda yakin akan menghapus <span class="text-bold">{{ $item->name }}</span>?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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
