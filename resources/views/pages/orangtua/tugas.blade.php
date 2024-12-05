@extends('layouts.main')
@section('title', 'List User')

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Tugas</h4>
                    </div>
                    <div class="card-body">
                        @include('partials.alert')
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Tugas</th>
                                        <th>Mapel</th>
                                        <th>Siswa</th>
                                        <th>Mengerjakan</th>
                                        <th>Tgl Pengumpulan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tugas as $key => $tugas)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tugas['judul'] }}</td>
                                        <td>{{ $tugas['mapel'] }}</td>
                                        <td>{{ $tugas['siswa'] }}</td>
                                        <td>
                                            @if ($tugas['has_jawaban'])
                                                <span class="badge badge-success">Sudah mengumpulkan</span>
                                            @else
                                                <span class="badge badge-danger">Belum mengumpulkan</span>
                                            @endif
                                        </td>
                                        <td>{{ $tugas['tgl_pengumpulan'] ?? '-' }}</td>
                                    </tr>
                                    @empty

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
