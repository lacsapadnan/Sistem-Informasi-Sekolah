@extends('layouts.main')
@section('title', 'Pengaturan')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Pengaturan</h4>
                        </div>
                        <div class="card-body">
                            @include('partials.alert')
                            <form method="POST" action="{{ route('pengaturan.update', $pengaturan->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama_sekolah">Nama Sekolah</label>
                                    <input type="text" id="nama_sekolah" name="nama_sekolah"
                                        class="form-control @error('nama_sekolah') is-invalid @enderror"
                                        placeholder="{{ __('Nama Sekolah') }}" value="{{ $pengaturan->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo Sekolah</label>
                                    <div>
                                        <img src="{{ URL::asset($pengaturan->logo) ?? 'https://via.placeholder.com/300' }}"
                                            alt="Logo Sekolah" width="100" class="mb-2">
                                    </div>
                                    <input type="file" id="logo" name="logo"
                                        class="form-control @error('logo') is-invalid @enderror">
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
