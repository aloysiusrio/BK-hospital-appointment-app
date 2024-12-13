@extends('dashboard/master')
@section('title', 'Obat')
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
                            <li class="breadcrumb-item active">Obat</li>
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
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">Data Obat</h3>
                            </div>
                            <div class="card-header">
                                <!-- Button Tambah -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalTambah">
                                    <i class="fas fa-file"></i> Tambah Data
                                </button>
                                <!-- End Button Tambah -->
                                <!-- Modal Tambah -->
                                <form method="POST" action="{{ route('dashboard.admin.obat.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal fade" id="modalTambah">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h4 class="modal-title">Tambah Data Obat</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">                                                    
                                                    <div class="form-group">
                                                        <label for="name">Nama <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control rounded-0 @error('name') is-invalid @enderror"
                                                            id="name" name="name" value=""
                                                            placeholder="Nama Obat....">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kemasan">Satuan Kemasan <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control rounded-0 @error('kemasan') is-invalid @enderror"
                                                            id="kemasan" name="kemasan" value=""
                                                            placeholder="Kemasan...">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga">Harga <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number"
                                                            class="form-control rounded-0 @error('harga') is-invalid @enderror"
                                                            id="harga" name="harga" value=""
                                                            placeholder="Harga...">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                </form>
                                <!-- Modal Tambah End -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead class="bg-gradient-primary text-white">
                                        <tr class="text-center">
                                            <th>No</th>                                            
                                            <th>Nama</th>
                                            <th>Satuan Kemasan</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($obats as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>                                                
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->kemasan }}</td>
                                                <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                                <td>
                                                    <div class="text-center">
                                                        <!-- Button -->
                                                        <button type="button" class="btn btn-warning"
                                                            data-toggle="modal"
                                                            data-target="#modalEdit-{{ $item->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#modalHapus-{{ $item->id }}">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Modal Edit -->
                                                    <form method="POST" action="{{ route('dashboard.admin.obat.update',$item->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal fade" id="modalEdit-{{ $item->id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Data :
                                                                            {{ $item->nama }}</h4>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">                                                                        
                                                                        <div class="form-group">
                                                                            <label for="name">Nama <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('name') is-invalid @enderror"
                                                                                id="name" name="name" value="{{ $item->name }}"
                                                                                placeholder="Nama Obat....">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="kemasan">Satuan Kemasan <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text"
                                                                                class="form-control rounded-0 @error('kemasan') is-invalid @enderror"
                                                                                id="kemasan" name="kemasan" value="{{ $item->kemasan }}"
                                                                                placeholder="Kemasan...">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="harga">Harga <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="number"
                                                                                class="form-control rounded-0 @error('harga') is-invalid @enderror"
                                                                                id="harga" name="harga" value="{{ $item->harga }}"
                                                                                placeholder="Harga...">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-warning">Update
                                                                            Data</button>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.modal -->
                                                    </form>
                                                    <!-- Modal Edit End -->

                                                    <!-- Modal Hapus -->
                                                    <form method="POST"
                                                        action="{{ route('dashboard.admin.obat.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal fade" id="modalHapus-{{ $item->id }}">
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
                                                                        <p>Anda yakin akan menghapus data :
                                                                            {{ $item->name }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Hapus Data</button>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.modal -->
                                                    </form>
                                                    <!-- Modal Hapus End -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                            <!-- /.card -->

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
                <!-- /.container-fluid -->
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
@endsection
