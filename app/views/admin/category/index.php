<a href="/admin/category/add" class="btn btn-success m-2">Thêm mới</a>
<table class='table align-middle mb-0 bg-white'>
    <thead class='bg-light'>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Trạng Thái</th>
            <th colspan="2">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category) : ?>
            <tr>
                <td><?= $category->id ?></td>
                <td><?= $category->name ?></td>
                <td><a href="/admin/category/status?id=<?= $category->id ?>" class="btn btn-<?= $category->status == 0 ? "success" : "danger"?>"><?= $category->status == 0 ? "Hiển Thị" : "Ẩn"?></a></td>
                <td>
                    <a href="/admin/category/edit?id=<?= $category->id ?>" class="btn btn-primary">Sửa</a>
                    <a href="/admin/category/delete?id=<?= $category->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm <?= $category->name ?> không ?');">Xóa</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>