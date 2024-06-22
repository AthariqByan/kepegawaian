@extends('layout.main')

@section('container')
    <div class="container mt-5"> <!-- Tambahkan mt-5 untuk margin top -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Detail Pegawai</h1>
            </div>
            <div class="card-body d-flex flex-column">
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Nama :</div>
                    <div class="col-md-9">{{ $pegawai->nama }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Email :</div>
                    <div class="col-md-9">{{ $pegawai->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Umur :</div>
                    <div class="col-md-9">{{ $pegawai->umur }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 font-weight-bold">Posisi :</div>
                    <div class="col-md-9">{{ $pegawai->posisi->posisi }}</div>
                </div>
                @if ($pegawai->cv)
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">CV :</div>
                        <div class="col-md-9">
                            <a href="{{ Storage::url($pegawai->cv) }}" target="_blank"
                                class="btn btn-outline-primary btn-sm">View CV</a>
                        </div>
                    </div>
                @endif
                @if ($pegawai->image)
                    <div class="row mb-3">
                        <div class="col-md-3 font-weight-bold">Foto :</div>
                        <div class="col-md-9">
                            <img src="{{ Storage::url($pegawai->image) }}" alt="{{ $pegawai->nama }}" class="img-thumbnail"
                                style="max-width: 200px;">
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.pegawai.index') }}" class="btn btn-secondary">Kembali</a>
                <div>
                    <button type="button" class="btn btn-warning mr-2" data-bs-toggle="modal"
                        data-bs-target="#editPegawaiModal">Ubah
                    </button>
                    <form action="{{ route('admin.pegawai.destroy', $pegawai->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete this employee?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Data Pegawai -->
    <div class="modal fade" id="editPegawaiModal" tabindex="-1" aria-labelledby="editPegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editPegawaiModalLabel">Ubah Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.pegawai.update', $pegawai->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" value="{{ old('nama', $pegawai->nama) }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email', $pegawai->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="text" class="form-control @error('umur') is-invalid @enderror" name="umur"
                                id="umur" value="{{ old('umur', $pegawai->umur) }}">
                            @error('umur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <input type="text" class="form-control @error('posisi') is-invalid @enderror" name="posisi"
                                id="posisi" value="{{ old('posisi', $pegawai->posisi) }}">
                            @error('posisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cv" class="form-label">Masukkan CV</label>
                            <input type="file" class="form-control @error('cv') is-invalid @enderror" name="cv"
                                id="cv">
                            @error('cv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Masukkan Gambar</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                name="image" id="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
