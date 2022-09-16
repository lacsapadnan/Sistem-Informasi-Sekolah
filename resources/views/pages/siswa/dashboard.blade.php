@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="{{ url(Storage::url($siswa->foto)) }}" class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">NIP</div>
                                <div class="profile-widget-item-value">{{ $siswa->nis }}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Telp</div>
                                <div class="profile-widget-item-value">{{ $siswa->telp }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-widget-description pb-0">
                        <div class="profile-widget-name">{{ $siswa->nama }}
                            <div class="text-muted d-inline font-weight-normal">
                                <div class="slash"></div> siswa {{ $siswa->kelas->nama_kelas }}
                            </div>
                        </div>
                        <label for="alamat">Alamat</label>
                        <p>{{ $siswa->alamat }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-7">
                <div class="card card-hero" style="margin-top: 36px">
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
