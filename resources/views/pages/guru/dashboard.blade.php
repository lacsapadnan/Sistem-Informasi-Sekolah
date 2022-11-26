@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Selamat datang pak/bu {{ Auth::user()->name }}</h1>
    </div>

    <div class="section-body">
        <div class="row ">
            {{-- Jadwal --}}
            <div class="col-12 col-sm-12 col-lg-4">
                <div class="card card-hero">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <h4>Jadwal Mengajar</h4>
                        <div class="card-description">Berikut list jadwal kelas tempat mengajaar anda</div>
                    </div>
                    <div class="card-body p-0">
                        <div class="tickets-list">
                            @foreach ($jadwal as $data )
                            @if($data->hari == $hari)
                            <div class="ticket-item">
                                <div class="ticket-title">
                                    <h4>{{ $data->kelas->nama_kelas }}</h4>
                                </div>
                                <div class="ticket-info">
                                    <div class="text-primary">Pada jam {{ $data->dari_jam }}</div>
                                </div>
                            </div>
                            @else
                            <div class="ticket-item">
                                <div class="ticket-title">
                                    <h4>Tidak ada jadwal mengajar hari ini</h4>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Materi Diajarkan</h4>
                        </div>
                        <div class="card-body">
                            {{ $materi }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jumlah Tugas diberikan</h4>
                        </div>
                        <div class="card-body">
                            {{ $tugas }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
@endsection
