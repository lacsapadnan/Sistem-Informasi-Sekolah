@extends('layouts.main')
@section('title', 'List Pengumuman')

@section('content')
    <section class="section custom-section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>List Mata Pelajaran</h4>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                                    class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data Pengumuman</button>
                        </div>
                        <div class="card-body">
                            @include('partials.alert')
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Pengumuman</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pengumumans as $result => $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->start_at }}</td>
                                                <td>{{ $data->end_at }}</td>
                                                <td>{{ $data->description }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('pengumuman-sekolah.edit', Crypt::encrypt($data->id)) }}"
                                                            class="btn btn-success btn-sm"><i
                                                                class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                                                        <form method="POST"
                                                            action="{{ route('pengumuman-sekolah.destroy', $data->id) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-sm show_confirm"
                                                                data-toggle="tooltip" title='Delete'
                                                                style="margin-left: 8px"><i
                                                                    class="nav-icon fas fa-trash-alt"></i> &nbsp;
                                                                Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Pengumuman</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('pengumuman-sekolah.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="start_at">Tanggal Mulai</label>
                                                <input type="date" id="start_at" name="start_at"
                                                    class="form-control @error('start_at') is-invalid @enderror"
                                                    placeholder="Tanggal Mulai" value="{{ old('start_at') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="end_at">Tanggal Selesai</label>
                                                <input type="date" id="end_at" name="end_at"
                                                    class="form-control @error('end_at') is-invalid @enderror"
                                                    placeholder="Tanggal Selesai" value="{{ old('end_at') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Deskripsi</label>
                                                <input type="text" id="description" name="description"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    placeholder="{{ __('Deskripsi pengumuman') }}" value="{{ old('description') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer br">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Yakin ingin menghapus data ini?`,
                    text: "Data akan terhapus secara permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endpush
