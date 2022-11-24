@extends('layouts.main')
@section('title', 'Edit Jurusan')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        @foreach ($errors->all() as $error )
                        {{ $error }}
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Edit Jurusan {{ $jurusan->nama_jurusan }}</h4>
                        <a href="{{ route('jurusan.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('jurusan.update', $jurusan->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_jurusan">Nama jurusan</label>
                                <input type="text" id="nama_jurusan" name="nama_jurusan" class="form-control @error('nama_jurusan') is-invalid @enderror" placeholder="{{ __('Nama Jurusan') }}" value="{{ $jurusan->nama_jurusan ?? '' }}">
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
