@extends('layouts.main')

@section('title', 'Profile')

@section('content')
    <div class="section">
        <div class="section-body">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-sm-6 col-lg-6">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    @if($errors)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    {{ $errors }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="card profile-widget">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <form action="{{ route('update-password') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="card-header d-flex justify-content-between">
                                        <h4>Edit Password</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-12 {{ $errors->has('current-password') ? 'has-error' : '' }}">
                                                <label>Password lama</label>
                                                <input name="current-password" type="password" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12 {{ $errors->has('new-password') ? 'has-error' : '' }}">
                                                <label>Password baru</label>
                                                <input name="new-password" type="password" class="form-control" required>
                                            </div>
                                            {{-- <div class="form-group col-md-6 col-12">
                                                <label>Konfirmasi password</label>
                                                <input name="new-password-confirmation" type="password" class="form-control" required>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                    <button class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
