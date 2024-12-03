@extends('layouts.main')
@section('title', 'Edit Pengumuman')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Edit Pengumuman</h4>
                            <a href="{{ route('pengumuman-sekolah.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="card-body">
                            @include('partials.alert')
                            <form method="POST" action="{{ route('pengumuman-sekolah.update', $pengumuman->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="start_at">Tanggal Mulai</label>
                                    <input type="date" id="start_at" name="start_at"
                                        class="form-control @error('start_at') is-invalid @enderror"
                                        placeholder="Tanggal Mulai" value="{{ old('start_at', $pengumuman->start_at) }}">
                                </div>
                                <div class="form-group">
                                    <label for="end_at">Tanggal Selesai</label>
                                    <input type="date" id="end_at" name="end_at"
                                        class="form-control @error('end_at') is-invalid @enderror"
                                        placeholder="Tanggal Selesai" value="{{ old('end_at', $pengumuman->end_at) }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Deskripsi pengumuman" rows="4">{{ old('description', $pengumuman->description) }}</textarea>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i>
                                        &nbsp; Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
