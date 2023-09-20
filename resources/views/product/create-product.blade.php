@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="mt-2">Tambah Data Product</h5><a href="{{ url('/') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

                <form method="POST" action="{{ url('store-product') }}">
                    <div class="card-body">
                        <div class="row">
                            @csrf
                            <div class="row mb-2">
                                <label for="product_name" class="col-md-2 col-form-label">Nama Product : </label>

                                <div class="col-md-8">
                                    <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" required autocomplete="name" placeholder="Masukkan nama product">

                                    @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="price" class="col-md-2 col-form-label">Harga : </label>

                                <div class="col-md-4">
                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" placeholder="Rp. ">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="category_id" class="col-md-2 col-form-label">Kategori : </label>

                                <div class="col-md-8">
                                    <select name="category_id" class="col-md-12">
                                        @foreach ($satuanData as $sad)
                                        <option value="{{$sad->id}}">{{$sad->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="status_id" class="col-md-2 col-form-label">Status : </label>

                                <div class="col-md-8">
                                    <select name="status_id" class="col-md-12">
                                        @foreach ($statusData as $std)
                                        <option value="{{$std->id}}">{{$std->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary float-end">
                                    Simpan
                                </button>
                                <a href="{{ url('/') }}" class="btn btn-secondary float-end mx-2">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
