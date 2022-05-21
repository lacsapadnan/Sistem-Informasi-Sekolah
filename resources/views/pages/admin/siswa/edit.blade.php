@extends('layouts.main')
@section('title', 'Edit Siswa')

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
                            <h4>Edit Siswa {{ $siswa->nama }}</h4>
                            <a href="{{ route('siswa.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('siswa.update', $siswa->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <img src="{{ asset('img/siswa/'.$siswa->foto) }}" style="width: 120px" alt="foto siswa">
                                <div class="form-group">
                                    <label for="foto">Foto Siswa</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="foto" type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto">
                                            <label class="custom-file-label" for="foto">Pilih file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Siswa</label>
                                    <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="{{ __('Nama Siswa') }}" value="{{ $siswa->nama }}">
                                </div>
                                <div class="d-flex">
                                    <div class="form-group">
                                        <label for="nis">NIS</label>
                                        <input type="text" id="nis" name="nis" class="form-control @error('nis') is-invalid @enderror" placeholder="{{ __('NIS Siswa') }}" value="{{ $siswa->nis }}">
                                    </div>
                                    <div class="form-group ml-4">
                                        <label for="telp">No. Telp</label>
                                        <input type="text" id="telp" name="telp" class="form-control @error('telp') is-invalid @enderror" placeholder="{{ __('No. TElp Siswa') }}" value="{{ $siswa->telp }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ __('Alamat') }}">{{ $siswa->alamat }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kelas_id">Kelas</label>
                                    <select id="kelas_id" name="kelas_id" class="select2bs4 form-control @error('kelas_id') is-invalid @enderror">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $data )
                                            <option value="{{ $data->id }}"
                                            @if ($siswa->kelas_id == $data->id)
                                                selected
                                            @endif
                                        >{{ $data->nama_kelas }}</option>
                                        @endforeach
                                    </select>
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
