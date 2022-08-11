<a href="/admin/user/add" class="btn btn-success m-2">Thêm mới</a>
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
                    <?php
                    if($_SESSION['auth']->id == $user->id) :
                    ?>
                    <a href="/infor?id=<?= $user->id ?>" class="btn btn-primary">Sửa</a>
                    <?php
                    else :
                    ?>
                    <a href="/admin/user/status?id=<?= $user->id ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa user <?= $user->name ?> không ?');">Xóa</a>
                    <?php
                    endif
                    ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>