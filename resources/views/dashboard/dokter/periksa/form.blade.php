@extends('dashboard/master')
@section('title', 'Dokter | Periksa Pasien')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.dokter.periksa.index') }}">Daftar Pasien</a></li>
                            <li class="breadcrumb-item active">Periksa Pasien</li>
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
                            {{-- Error Message --}}
                            @if ($errors->any())
                                <div class="card-header">
                                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            {{-- Card Header --}}
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title">Form Pemeriksaan Pasien</h3>
                            </div>

                            {{-- Card Body --}}
                            <div class="card-body">
                                <form
                                    action="{{ $daftar->periksa ? route('dashboard.dokter.periksa.update', $daftar->id) : route('dashboard.dokter.periksa', $daftar->id) }}"
                                    method="POST">
                                    @csrf
                                    @if ($daftar->periksa)
                                        @method('PUT')
                                    @endif

                                    <div class="mb-3">
                                        <label for="pasien" class="form-label">Nama Pasien</label>
                                        <input type="text" id="pasien" class="form-control" value="{{ $daftar->pasien->name }}" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
                                        <input type="date" id="tgl_periksa" name="tgl_periksa"
                                            class="form-control @error('tgl_periksa') is-invalid @enderror"
                                            value="{{ old('tgl_periksa', $daftar->periksa?->tgl_periksa) }}">
                                        @error('tgl_periksa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="catatan" class="form-label">Catatan Dokter</label>
                                        <textarea id="catatan" name="catatan" rows="3"
                                            class="form-control @error('catatan') is-invalid @enderror"
                                            placeholder="Catatan pemeriksaan">{{ old('catatan', $daftar->periksa?->catatan) }}</textarea>
                                        @error('catatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="obats" class="form-label">Obat yang Diberikan</label>
                                        <select id="obats" name="obats[]" class="form-select js-example-basic-multiple" multiple="multiple">
                                            @foreach ($obats as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $daftar->periksa && in_array($item->id, $daftar->periksa->obatDetail->pluck('obat_id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $item->name }} - Rp. {{ number_format($item->harga, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="text-end">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
    <!-- DataTables & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
