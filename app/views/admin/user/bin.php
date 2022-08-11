<table class='table align-middle mb-0 bg-white'>
    <thead class='bg-light'>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th colspan="2">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td>
                    <a href="/admin/user/status?id=<?= $user->id ?>" class="btn btn-success" onclick="return confirm('Bạn có chắc chắn muốn khôi phục user <?= $user->name ?> không ?');">Khôi Phục</a>
                    <a href="/admin/user/bin/delete?id=<?= $user->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn XÓA VĨNH VIỄN user <?= $user->name ?> không ?');">Xóa Vĩnh Viễn</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>