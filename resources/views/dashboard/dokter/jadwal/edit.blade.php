@extends('dashboard.master')
@section('title', 'Edit Jadwal')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Jadwal</h1>
    </section>
    <section class="content">
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
    </section>
</div>
@endsection
