@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Tambah Pengguna</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('user') }}" class="btn btn-sm btn-secondary"><i class="fas fa-sm fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <div class="card col-md-5">
        <div class="card-body">
            <form>
                @csrf
                <div class="mb-2">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="mb-2">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="mb-2">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="mb-2">
                    <label for="username">Saldo Awal</label>
                    <input type="text" class="form-control" name="saldo_awal" id="saldo_awal" value="{{ old('aldo_awal') }}">
                </div>
                <div class="mb-2">
                    <label for="username">Saldo Akhir</label>
                    <input type="text" class="form-control" name="saldo_keluar" id="saldo_keluar" value="{{ ('saldo_keluar') }}">
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="col">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                    </div>
                </div>
                <button type="submit" class="btn btn-success float-end"><i class="fas fa-sm fa-floppy-disk"></i> Simpan</button>
            </form>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $('form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('user.create') }}",
                    method: "POST",
                    data: formData,
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: res.alert
                        }).then(function() {
                            $('form')[0].reset();
                        })
                    },
                    error: function(err) {
                        $.each(err.responseJSON.errors, function(key, value) {
                            toastr.error(value);
                        });
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        </script>
    @endpush
@endsection
