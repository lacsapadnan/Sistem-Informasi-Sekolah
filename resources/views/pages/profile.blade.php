@extends('layouts.main')

@section('title', 'Profile')

@section('content')
    <div class="section">
        <div class="section-body">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-sm-6 col-lg-6">
                    @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                                </button>
                                {{ $message }}
                            </div>
                        </div>
                    @endif
                    <div class="card profile-widget">
                        @if (Auth::user()->roles == 'guru')
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-header d-flex justify-content-between">
                                            <h4>Edit Profile</h4>
                                            <a href="{{ route('ubah-password') }}" class="btn btn-primary"><i class="nav-icon fas fa-lock"></i>&nbsp; Ubah password</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Nama</label>
                                                    <input name="nama" type="text" class="form-control" value="{{ $guru->nama ?? '' }}" required>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>NIP</label>
                                                    <input name="nip" type="text" class="form-control" value="{{ $guru->nip ?? '' }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Email</label>
                                                    <input name="email" type="email" class="form-control" value="{{ auth()->user()->email ?? '' }}" required="">
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>No. Telp</label>
                                                    <input name="no_telp" type="tel" class="form-control" value="{{ $guru->no_telp ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="form-group col-12">
                                                <label>Alamat</label>
                                                <textarea name="alamat" class="form-control">{{ $guru->alamat ?? '' }}</textarea>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                        <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @elseif (Auth::user()->roles == 'siswa')
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-header d-flex justify-content-between">
                                            <h4>Edit Profile</h4>
                                            <a href="{{ route('ubah-password') }}" class="btn btn-primary"><i class="nav-icon fas fa-lock"></i>&nbsp; Ubah password</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Nama</label>
                                                    <input name="nama" type="text" class="form-control" value="{{ $siswa->nama ?? '' }}" required>
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>NIS</label>
                                                    <input name="nis" type="text" class="form-control" value="{{ $siswa->nis ?? '' }}" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label>Email</label>
                                                    <input name="email" type="email" class="form-control" value="{{ auth()->user()->email ?? '' }}" required="">
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label>No. Telp</label>
                                                    <input name="telp" type="tel" class="form-control" value="{{ $siswa->telp ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                            <div class="form-group col-12">
                                                <label>Alamat</label>
                                                <textarea name="alamat" class="form-control">{{ $siswa->alamat ?? '' }}</textarea>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                        <button class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
