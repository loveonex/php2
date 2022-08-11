<a href="/admin/product/add" class="btn btn-success m-2">Thêm mới</a>
<table class='table align-middle mb-0 bg-white'>
    <thead class='bg-light'>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Ảnh</th>
            <th>Giá</th>
            <th colspan="2">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= $product->id ?></td>
                <td><?= $product->name ?></td>
                <td><img src="/images/<?= $product->image ?>" alt="" width="50px" height="50px"></td>
                <td><?= number_format($product->price) ?> VNĐ</td>
                <td>
                    <a href="/admin/product/edit?id=<?= $product->id ?>" class="btn btn-primary">Sửa</a>
                    <a href="/admin/product/status?id=<?= $product->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm <?= $product->name ?> không ?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>