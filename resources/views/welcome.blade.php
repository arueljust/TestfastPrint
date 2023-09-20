@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="container">
                <div class="card-header d-flex justify-content-between">
                    <div class="container">
                        <div>
                            <h5 class="mt-2"><strong>Data Product</strong></h5>
                        </div>
                        <div>
                            <a href="{{url('create-product')}}" class="btn btn-outline-secondary float-end"><strong>Tambah</strong></a>
                            <a href="{{url('/in-stock')}}" class="btn btn-outline-warning float-end mx-2"> <strong>Product Yang Bisa Dijual</strong></a>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-3">
                    @if (session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div><br />
                    @endif
                    <table class="table table-striped table-bordered" id="dataTables">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>ID Product</th>
                                <th>Nama Product</th>
                                <th>Harga</th>
                                <th>kategory</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $item->product_id }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>Rp. {{ number_format($item->price,0,',','.'),00 }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->status }}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary" href="{{ url('/edit-product',$item->product_id) }}"><i class="bi-pencil-square"></i></a>
                                </td>
                                <td class="text-center">
                                    <form class="form-inline" action="{{ url('/delete-product',$item->product_id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" onclick="return confirm('Yakin Hapus Data ?')" type="submit"><i class="bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTables').DataTable();
    });
</script>
@endsection
