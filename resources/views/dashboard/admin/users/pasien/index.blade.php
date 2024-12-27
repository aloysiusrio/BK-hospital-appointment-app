@extends('dashboard/master')
@section('title', 'Pasien')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Pasien</li>
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
                                <h3 class="card-title">Data Pasien</h3>
                            </div>
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalTambah">
                                    <i class="fas fa-file"></i> Tambah Pasien
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
                                <div class="modal fade" id="modalTambah">
                                    <div class="modal-dialog">
                                        <div class="modal-content" id="modalTambah">
                                            <div class="modal-header bg-primary text-white">
                                                <h4 class="modal-title">Tambah Data Pasien Baru</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST"
                                                action="{{ route('dashboard.admin.users.pasien.store') }}"
                                                enctype="multipart/form-data" id="formTambah">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="email">Email <span class="text-danger">*</span></label>
                                                        <input type="email"
                                                            class="form-control rounded-0 @error('email') is-invalid @enderror"
                                                            id="email" name="email" value=""
                                                            placeholder="Email....">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Nama <span class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control rounded-0 @error('name') is-invalid @enderror"
                                                            id="name" name="name" value=""
                                                            placeholder="Nama....">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="no_hp">No Telp <span class="text-danger">*</span></label>
                                                        <input type="number"
                                                            class="form-control rounded-0 @error('no_hp') is-invalid @enderror"
                                                            id="no_hp" name="no_hp" value=""
                                                            placeholder="No Telp....">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="no_ktp">KTP <span class="text-danger">*</span></label>
                                                        <input type="number"
                                                            class="form-control rounded-0 @error('no_ktp') is-invalid @enderror"
                                                            id="no_ktp" name="no_ktp" value=""
                                                            placeholder="No KTP....">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control rounded-0 @error('alamat') is-invalid @enderror"
                                                            id="alamat" name="alamat" value=""
                                                            placeholder="Alamat...">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama">Password <span class="text-danger">*</span></label>
                                                        <input type="password"
                                                            class="form-control rounded-0 @error('password') is-invalid @enderror"
                                                            id="password" name="password" value=""
                                                            placeholder="Password...">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama">Confirm Password <span class="text-danger">*</span></label>
                                                        <input type="password"
                                                            class="form-control rounded-0 @error('password_confirmation') is-invalid @enderror"
                                                            id="password_confirmation" name="password_confirmation"
                                                            value="" placeholder="Confirm Password...">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
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
                                            <th>User ID</th>
                                            <th>No. RM</th>
                                            <th>No. KTP</th>
                                            <th>Email</th>
                                            <th>Nama</th>
                                            <th>No. HP</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pasiens as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->user_id }}</td>
                                                <td>{{ $item->no_rm }}</td>
                                                <td>{{ $item->no_ktp }}</td>
                                                <td>{{ $item->user->email }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->no_hp }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-warning"
                                                            data-toggle="modal"
                                                            data-target="#modalEdit-{{ $item->user_id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#modalHapus-{{ $item->user_id }}">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <form method="POST"
                                                        action="{{ route('dashboard.admin.users.pasien.update', $item->user_id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal fade" id="modalEdit-{{ $item->user_id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Data</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="no_ktp">No. KTP <span class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('no_ktp') is-invalid @enderror"
                                                                                id="no_ktp" name="no_ktp"
                                                                                value="{{ $item->no_ktp }}"
                                                                                placeholder="">
                                                                        </div><div class="form-group">
                                                                            <label for="email">Email <span class="text-danger">*</span></label>
                                                                            <input type="email"
                                                                                class="form-control rounded-0 @error('email') is-invalid @enderror"
                                                                                id="email" name="email"
                                                                                value="{{ $item->user->email }}"
                                                                                placeholder="">
                                                                        </div><div class="form-group">
                                                                            <label for="name">Nama <span class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('name') is-invalid @enderror"
                                                                                id="name" name="name"
                                                                                value="{{ $item->name }}"
                                                                                placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="no_hp">No. Hp <span class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('no_hp') is-invalid @enderror"
                                                                                id="no_hp" name="no_hp"
                                                                                value="{{ $item->no_hp }}"
                                                                                placeholder="">
                                                                        </div>                                                                        
                                                                        <div class="form-group">
                                                                            <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('alamat') is-invalid @enderror"
                                                                                id="alamat" name="alamat"
                                                                                value="{{ $item->alamat }}"
                                                                                placeholder="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-warning">Update</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form method="POST"
                                                        action="{{ route('dashboard.admin.users.pasien.destroy', $item->user_id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal fade" id="modalHapus-{{ $item->user_id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Hapus Data</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Anda yakin akan menghapus data <span class="text-bold">{{ $item->name }}</span>?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Hapus</button>
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
