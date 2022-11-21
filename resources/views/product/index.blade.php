@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Barang</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('product.create') }}" class="btn btn-sm btn-success"><i class="fas fa-sm fa-plus"></i> Tambah</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table" id="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Stock</th>
                    <th>Expired</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('img/products/' . $product->image) }}" alt="Product Image" class="border" style="object-fit: cover; max-width: 80px; width: 100%">
                            @else
                                <img src="{{ asset('img/default.png') }}" alt="Product Image" class="border" style="object-fit: cover; max-width: 80px; width: 100%">
                            @endif
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{  \Carbon\Carbon::parse($product->expired)->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($product->price) }}</td>
                        <td>
                            <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                            @if( \Carbon\Carbon::parse($product->expired)->format('d-m-Y') >= \Carbon\Carbon::now()->format('d-m-Y'))
                                <button type="button" class="btn btn-sm btn-danger btn-delete" title="expired" data-id="{{ $product->id }}"><i class="fas fa-trash"></i></button>
                            @endif
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
                        let url = '{{ route('product.delete', ':id') }}';
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
