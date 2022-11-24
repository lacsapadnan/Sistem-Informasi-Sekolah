@extends('layouts.main')
@section('title', 'Edit Jadwal')

@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@endpush


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
                        <h4>Edit jadwal mapel {{ $jadwal->mapel->nama_mapel }} pada hari {{ $jadwal->hari }}</h4>
                        <a href="{{ route('jadwal.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('jadwal.update', $jadwal->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="mapel_id">Mata Pelajaran</label>
                                <select id="mapel_id" name="mapel_id" class="select2 form-control ">
                                    @foreach ($mapel as $data)
                                    <option value="{{ $data->id ?? '' }}">{{ $data->nama_mapel ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kelas_id">Kelas</label>
                                <select id="kelas_id" name="kelas_id" class="select2 form-control ">
                                    @foreach ($kelas as $data)
                                    <option value="{{ $data->id ?? '' }}">{{ $data->nama_kelas ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="hari">Hari</label>
                                <select id="hari" name="hari" class="select2 form-control ">
                                    @foreach($hari as $item)
                                    <option value="{{ $item }}" {{$jadwal->hari == $item  ? 'selected' : ''}}>{{ Str::ucfirst($item) }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dari_jam">Mulai dari jam</label>
                                <input class="form-control" type="text" name="dari_jam" id="time1" @error('dari_jam') is-invalid @enderror" placeholder="{{ __('Jam mulai pelajaran') }}" value="{{ $jadwal->dari_jam ?? '' }}" />

                            </div>
                            <div class="form-group">
                                <label for="sampai_jam">Sampai dari jam</label>
                                <input class="form-control" type="text" name="sampai_jam" id="time2" @error('sampai_jam') is-invalid @enderror" placeholder="{{ __('Nama Jurusan') }}" value="{{ $jadwal->sampai_jam ?? '' }}" />
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
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<script>
    $('#time1').datetimepicker({
        format: 'HH:mm:ss'
    });

</script>

<script>
    $('#time2').datetimepicker({
        format: 'HH:mm:ss'
    });

</script>

@endpush
