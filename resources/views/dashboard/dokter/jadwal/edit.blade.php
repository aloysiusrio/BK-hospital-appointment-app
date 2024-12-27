@extends('dashboard.master')
@section('title', 'Edit Jadwal')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.dokter.jadwal.index') }}">Jadwal Praktek</a></li>
                        <li class="breadcrumb-item active">Edit Jadwal Praktek</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Edit Jadwal Praktek</h3>
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
                    <form method="POST" action="{{ route('dashboard.dokter.jadwal.update', $jadwal->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Hari</label>
                            <select name="hari" class="form-control">
                                <option value="1" {{ $jadwal->hari == 1 ? 'selected' : '' }}>Senin</option>
                                <option value="2" {{ $jadwal->hari == 2 ? 'selected' : '' }}>Selasa</option>
                                <option value="3" {{ $jadwal->hari == 3 ? 'selected' : '' }}>Rabu</option>
                                <option value="4" {{ $jadwal->hari == 4 ? 'selected' : '' }}>Kamis</option>
                                <option value="5" {{ $jadwal->hari == 5 ? 'selected' : '' }}>Jumat</option>
                                <option value="6" {{ $jadwal->hari == 6 ? 'selected' : '' }}>Sabtu</option>
                                <option value="7" {{ $jadwal->hari == 7 ? 'selected' : '' }}>Minggu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}">
                        </div>
                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}">
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
</section>
</div>
@endsection
