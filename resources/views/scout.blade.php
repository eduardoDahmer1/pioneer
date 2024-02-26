@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Laravel 10 Scout Full Text Search Example With Algolia- Laravelia</div>
                 <div class="card-body">
                    <form action="{{ route('product.scout') }}" method="get">
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="search" name="q">
                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="form-control mb-3" value="Search">
                            </div>
                        </div>
                    </form>
                    <table style="width: 100%">
                        <thead>
                            <th>#</th>
                            <th style="width:500px">Name</th>
                            <th>Slug</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Brand</th>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td style="width:500px">{{ $product->name }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->status == 1 ? 'Active' : 'Inactive'}}</td>
                                    <td>{{ $product->brand->name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <center class="mt-5">
                        {{  $products->withQueryString()->links() }}
                    </center> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection