@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Edit Barang</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('product') }}" class="btn btn-sm btn-secondary"><i class="fas fa-sm fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <div class="card col-md-12">
        <div class="card-body">
            <form enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="oldImage" value="{{ $product->image }}">
                <div class="row">
                    <div class="col-md-2">
                        <div class="text-center mb-3 mb-md-0">
                            @if ($product->image)
                                <img src="{{ asset('img/products/' . $product->image) }}" alt="Image" class="border img-preview" style="object-fit: cover;max-width: 200px;width: 100%">
                            @else
                                <img src="{{ asset('img/default.png') }}" alt="Image" class="border img-preview" style="object-fit: cover;max-width: 200px;width: 100%">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <div class="mb-2">
                                <label for="image">Gambar</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                            <div class="mt-2">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}"> 
                            </div>
                            <div class="mt-2">
                                <label for="name">Stock</label>
                                <input type="text" class="form-control" name="stock" id="stock" value="{{ $product->stock }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label for="category_id">Kategori</label>
                            <select class="form-select" name="category_id" id="category_id">
                                <option value="">Pilih kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="mt-2">
                                <label for="price">Harga</label>
                                <input type="text" class="form-control" name="price" id="price" value="{{ $product->price }}">
                            </div>
                            <div class="mt-2">
                                <label for="price">Expired</label>
                                <input type="date" class="form-control" name="expired" id="expired" value="{{ $product->expired }}">
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success float-end"><i class="fas fa-sm fa-floppy-disk"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $('form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('product.update') }}",
                    method: "POST",
                    data: formData,
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: res.alert
                        }).then(function() {
                            location.href = "/product";
                        });
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

            $('input[name="image"]').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('.img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        </script>
    @endpush
@endsection
