@extends('layouts.main')
@section('title', 'List Tugas')

@section('content')
    <section class="section custom-section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Tugas {{ $tugas->judul }}</h4>
                            <a class="btn btn-primary btn-sm" href="{{ route('tugas.index') }}">Kembali</a>
                        </div>
                        <div class="card-body">
                            <h5>Deskripsi</h5>
                            <p>{{ $tugas->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </section>
@endsection
