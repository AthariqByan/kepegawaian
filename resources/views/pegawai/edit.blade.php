@extends('layout.main')
@section('container')
    <div class="card m-3">
        <div class="card-body">
            <div class="card-title">
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="card-title text-center">Edit Data Pegawai</h1>

                            <!-- Edit Data -->
                            <form action=""{{ route('pegawai.update', $pegawai->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        name="nama" id="nama" value="{{ old('nama') }}">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="umur" class="form-label">Umur</label>
                                    <input type="text" class="form-control @error('umur') is-invalid @enderror"
                                        name="umur" id="umur" value="{{ old('umur') }}">
                                    @error('umur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="posisi" class="form-label">Posisi</label>
                                    <input type="text" class="form-control @error('posisi') is-invalid @enderror"
                                        name="posisi" id="posisi" value="{{ old('posisi') }}">
                                    @error('posisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="cv" class="form-label">Masukkan CV</label>
                                    <input type="file" class="form-control @error('cv') is-invalid @enderror"
                                        name="cv" id="cv" value="{{ old('cv') }}">
                                    @error('cv')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <input type="button" class="btn btn-dark" style="background-color: #EE7879;"
                                        value="Kembali" onclick="window.history.go(-1)">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </form><!-- End Tambah Data-->
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>
@endsection
