@extends('layout.main')
@section('container')
    <div class="pagetitle">
        <h1>Posisi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container mt-5">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahPosisiModal">Tambah Posisi</button>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Posisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posisi as $posisis)
                        <tr id="posisiRow{{ $posisis->id }}">
                            <td>{{ $posisis->id }}</td>
                            <td>{{ $posisis->posisi }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editPosisiModal" data-id="{{ $posisis->id }}"
                                    data-posisi="{{ $posisis->posisi }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm delete-btn"
                                    data-id="{{ $posisis->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tambah Posisi Modal -->
    <div class="modal fade" id="tambahPosisiModal" tabindex="-1" aria-labelledby="tambahPosisiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.posisi.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahPosisiModalLabel">Tambah Posisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tambahPosisi" class="form-label">Posisi</label>
                            <input type="text" class="form-control" id="tambahPosisi" name="posisi" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Posisi Modal -->
    <div class="modal fade" id="editPosisiModal" tabindex="-1" aria-labelledby="editPosisiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editPosisiForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPosisiModalLabel">Edit posisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editPosisi" class="form-label">Posisi</label>
                            <input type="text" class="form-control" id="editPosisi" name="posisi" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Script to handle edit modal
        var editPosisiModal = document.getElementById('editPosisiModal');
        editPosisiModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var posisi = button.getAttribute('data-posisi');

            var editPosisi = editPosisiModal.querySelector('#editPosisi');
            var editForm = editPosisiModal.querySelector('#editPosisiForm');

            var modalTitle = editPosisiModal.querySelector('.modal-title');
            modalTitle.textContent = 'Edit Posisi: ' + posisi;
            editPosisi.value = posisi;
            editForm.action = '{{ route('admin.posisi.update', ':id') }}'.replace(':id', id);
        });

        // Handle delete button click
        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            var token = $('meta[name="csrf-token"]').attr('content');

            if (confirm('Apakah Anda yakin ingin menghapus posisi ini?')) {
                $.ajax({
                    url: '/admin/posisi/' + id,
                    type: 'DELETE',
                    data: {
                        "_token": token,
                    },
                    success: function(response) {
                        $('#posisiRow' + id).remove();
                        alert('Posisi berhasil dihapus');
                    },
                    error: function(response) {
                        alert('Terjadi kesalahan. Posisi gagal dihapus.');
                    }
                });
            }
        });
    </script>
@endsection
