<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
</head>
<body>
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
<h2>Danh sách sản phẩm</h2>
<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>SP001</td>
            <td>Giày Sneaker Nam ABC</td>
            <td>1.200.000</td>
            <td>15</td>
            <td>Còn hàng</td>
        </tr>
        <tr>
            <td>2</td>
            <td>SP002</td>
            <td>Giày Thể Thao Nữ XYZ</td>
            <td>950.000</td>
            <td>0</td>
            <td>Hết hàng</td>
        </tr>
        <tr>
            <td>3</td>
            <td>SP003</td>
            <td>Dép Sandal Thời Trang</td>
            <td>350.000</td>
            <td>20</td>
            <td>Còn hàng</td>
        </tr>
        

    </tbody>
</table>
<div>
<button type="button" onclick="window.location.href='{{ route('product.add')}}'">
    Thêm sản phẩm
</button>
</div>
</body>
</html>
