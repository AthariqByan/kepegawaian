@extends('layout.main')
@section('container')
    <div class="card m-3">
        <div class="card-body">
            <div class="card-title">
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="card-title text-center">Tambah Data Pegawai</h1>

                            <!-- Tambah Data Mahasiswa -->
                            <form action="{{ route('pegawai.store') }}" method="POST">
                                {{-- ketika membuat form wajib menambahkan @csrf, untuk mencegah adanya form dari luar --}}
                                @csrf
                                {{-- value OLD digunakan untuk mendapatkan data lama --}}
                                {{-- @error digunakan untuk memberikan pesan eror pencarian ada di "validation eror" --}}
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" id="nama" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Umur</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('umur') is-invalid @enderror"
                                            name="umur" id="umur" value="{{ old('umur') }}">
                                        @error('umur')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Posisi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('posisi') is-invalid @enderror"
                                            name="posisi" id="posisi" value="{{ old('posisi') }}">
                                        @error('posisi')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Masukkan CV</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control @error('cv') is-invalid @enderror"
                                            name="cv" id="cv" value="{{ old('cv') }}">
                                        @error('cv')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <input type="button" class="btn btn-dark" style="background-color: #EE7879;"
                                        value="Kembali" onclick="window.history.go(-1)">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </form><!-- End Tambah Data-->
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>
@endsection
