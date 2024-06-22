@extends('layout.main')

@section('container')
    <div class="pagetitle">
        <h1>Pegawai</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPegawaiModal">
                    Tambah Data
                </button>

                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Umur</th>
                                <th>Posisi</th>
                                <th>CV</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $p)
                                <tr>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->email }}</td>
                                    <td>{{ $p->umur }}</td>
                                    <td>{{ $p->posisi->posisi }}</td>
                                    <td>
                                        @if ($p->cv)
                                            <a href="/storage/{{ $p->cv }}" target="_blank"
                                                class="btn btn-outline-primary btn-sm">View CV</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($p->image)
                                            <img src="/storage/{{ $p->image }}" alt="{{ $p->nama }}"
                                                class="img-thumbnail" style="max-width: 100px;">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pegawai.show', $p->id) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editPegawaiModal{{ $p->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('admin.pegawai.destroy', $p->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $p->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </section>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addPegawaiModal" tabindex="-1" aria-labelledby="addPegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPegawaiModalLabel">Tambah Data Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.pegawai.store') }}" method="POST" enctype="multipart/form-data"
                        id="addForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                id="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="text" class="form-control @error('umur') is-invalid @enderror" name="umur"
                                id="umur" value="{{ old('umur') }}">
                            @error('umur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <select class="form-control @error('posisi_id') is-invalid @enderror" name="posisi_id"
                                id="posisi">
                                <option value="">Pilih Posisi</option>
                                @foreach ($posisi as $p)
                                    <option value="{{ $p->id }}"
                                        {{ old('posisi_id') == $p->posisi ? 'selected' : '' }}>
                                        {{ $p->posisi }}</option>
                                @endforeach
                            </select>
                            @error('posisi_id')
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
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edit Data -->
    @foreach ($pegawai as $p)
        <div class="modal fade" id="editPegawaiModal{{ $p->id }}" tabindex="-1"
            aria-labelledby="editPegawaiModalLabel{{ $p->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPegawaiModalLabel{{ $p->id }}">Edit Data Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.pegawai.update', $p->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" value="{{ old('nama', $p->nama) }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" value="{{ old('email', $p->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="umur" class="form-label">Umur</label>
                                <input type="text" class="form-control @error('umur') is-invalid @enderror"
                                    name="umur" id="umur" value="{{ old('umur', $p->umur) }}">
                                @error('umur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="posisi" class="form-label">Posisi</label>
                                <select class="form-control @error('posisi') is-invalid @enderror" name="posisi"
                                    id="posisi">
                                    <option value="">Pilih Posisi</option>
                                    @foreach ($posisi as $pos)
                                        <option value="{{ $pos->id }}"
                                            {{ old('posisi', $p->posisi_id) == $pos->id ? 'selected' : '' }}>
                                            {{ $pos->posisi }}</option>
                                    @endforeach
                                </select>
                                @error('posisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cv" class="form-label">Masukkan CV</label>
                                <input type="file" class="form-control @error('cv') is-invalid @enderror"
                                    name="cv" id="cv">
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
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
