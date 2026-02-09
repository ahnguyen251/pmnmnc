@extends('layout.admin')
@section('content') 
<h1>{{ $title }}</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product['id'] }}</td>
            <td>{{ $product['name'] }}</td>
            <td>{{ number_format($product['price'], 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection