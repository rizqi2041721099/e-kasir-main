@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Kategori Barang</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('product-category.create') }}" class="btn btn-sm btn-success"><i class="fas fa-sm fa-plus"></i> Tambah</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table" id="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('product-category.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                            <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $category->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $('.btn-delete').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'question',
                    title: 'Yakin untuk hapus data ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((res) => {
                    if (res.isConfirmed) {
                        let id = $(this).data('id');
                        let url = '{{ route('product-category.delete', ':id') }}';
                        url = url.replace(':id', id);
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                Swal.fire({
                                    icon: 'success',
                                    title: res.alert
                                }).then(function() {
                                    location.reload();
                                });
                            },
                            error: function(err) {
                                toastr.error('Hapus data gagal, terdapat masalah pada server!');
                            }
                        })
                    }
                })
            });
        </script>
    @endpush
@endsection
