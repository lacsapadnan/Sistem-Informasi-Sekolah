@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-hero">
                        <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h4>{{ $jumlahMateri }}</h4>
                        <div class="card-description">Materi Tersedia</div>
                        </div>
                        <div class="card-body p-0">
                        <div class="tickets-list">
                            @foreach ($materi as $data )
                                 <div class="ticket-item">
                                    <div class="ticket-title">
                                        <h4>{{ $data->judul }}</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div>{{ $data->guru->nama }}</div>
                                        <div class="bullet"></div>
                                        <div class="text-primary">{{ $data->guru->mapel->nama_mapel }}</div>
                                    </div>
                                </div>
                            @endforeach

                            <a href="{{ route('siswa.materi') }}" class="ticket-item ticket-more">
                            Lihat Semua <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
