@extends('layouts.main')

@section('title', 'Profile Guru')

@section('content')
    <div class="section">
        <div class="section-body">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-sm-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{ url(Storage::url($guru->foto)) }}" class="rounded-circle profile-widget-picture">
                            <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">NIP</div>
                                <div class="profile-widget-item-value">{{ $guru->nip }}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Telp</div>
                                <div class="profile-widget-item-value">{{ $guru->no_telp }}</div>
                            </div>
                            </div>
                        </div>
                        <div class="profile-widget-description pb-0">
                            <div class="profile-widget-name">{{ $guru->nama }}
                                <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> Guru {{ $guru->mapel->nama_mapel }}
                                </div>
                            </div>
                            <label for="alamat">Alamat</label>
                            <p>{{ $guru->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
