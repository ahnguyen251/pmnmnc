<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm mới sản phẩm</title>
</head>
<body>

<h2>Thêm mới sản phẩm</h2>

<form method="post" action="#">
    <table cellpadding="6">
        <tr>
            <td>Mã sản phẩm</td>
            <td>
                <input type="text" name="MaSanPham" required>
            </td>
        </tr>

        <tr>
            <td>Tên sản phẩm</td>
            <td>
                <input type="text" name="TenSanPham" required>
            </td>
        </tr>

        <tr>
            <td>Giá</td>
            <td>
                <input type="number" name="Gia" min="0" required>
            </td>
        </tr>

        <tr>
            <td>Số lượng</td>
            <td>
                <input type="number" name="SoLuong" min="0" required>
            </td>
        </tr>

        <tr>
            <td>Trạng thái</td>
            <td>
                <select name="TrangThai">
                    <option value="1">Còn hàng</option>
                    <option value="0">Hết hàng</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Mô tả</td>
            <td>
                <textarea name="MoTa" rows="4" cols="30"></textarea>
            </td>
        </tr>

        <tr>
           <td colspan="2" align="center">
                <button type="button" onclick="window.location.href='{{ route('product.index') }}'">Lưu</button>

                <button type="button" onclick="window.location.href='{{ route('product.index') }}'">
                    Hủy
                </button>
            </td>
        </tr>       
    </table>
</form>

</body>
</html>
