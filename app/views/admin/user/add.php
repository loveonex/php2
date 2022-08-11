<form class='col-md-5' action="/admin/user/add" method="post" enctype="multipart/form-data">
    <div class='form-group'>
        <?php if (isset($errors['name'])) : ?>
            <span id='error' class='text-danger'><?= $errors['name'] ?></span><br>
        <?php endif ?>
        <label>Tên:</label>
        <input type='text' name='name' value="<?= $request['name'] ?? '' ?>" class='form-control' />
    </div>
    <br>
    <div class='form-group'>
        <?php if (isset($errors['email'])) : ?>
            <span id='error' class='text-danger'><?= $errors['email'] ?></span><br>
        <?php endif ?>
        <?php if (isset($errors['fail'])) : ?>
            <span id='error' class='text-danger'><?= $errors['fail'] ?></span><br>
        <?php endif ?>
        <label>Email:</label>
        <input type='text' name='email' value="<?= $request['email'] ?? '' ?>" class='form-control' />
    </div>
    <br>
    <div class='form-group'>
        <?php if (isset($errors['password'])) : ?>
            <span id='error' class='text-danger'><?= $errors['password'] ?></span><br>
        <?php endif ?>
        <label>Mật khẩu:</label>
        <input type='password' name='password' value="<?= $request['password'] ?? '' ?>" class='form-control' />
    </div>
    <br>
    <div class='form-group'>
        <?php if (isset($errors['re_password'])) : ?>
            <span id='error' class='text-danger'><?= $errors['re_password'] ?></span><br>
        <?php endif ?>
        <label>Nhắc lại mật khẩu:</label>
        <input type='password' name='re_password' value="<?= $request['re_password'] ?? '' ?>" class='form-control' />
    </div>
    <br>
    <div class='form-group'>
        <?php if (isset($errors['image'])) : ?>
            <span id='error' class='text-danger'><?= $errors['image'] ?></span><br>
        <?php endif ?>
        <?php if (isset($errors['image_size'])) : ?>
            <span id='error' class='text-danger'><?= $errors['image_size'] ?></span><br>
        <?php endif ?>
        <label>Ảnh:</label>
        <input type='file' name='image' class='form-control' />
    </div>
    <br>
    <div class='form-group'>
        <label>Danh mục:</label>
        <select class="form-control" name="role">
            <option value="0" <?= isset($request['cate_id'])  ? ($request['cate_id'] == 0 ? 'selected' : '') : '' ?>>Khách Hàng</option>
            <option value="1" <?= isset($request['cate_id'])  ? ($request['cate_id'] == 1 ? 'selected' : '') : '' ?>>Quản Trị Viên</option>
        </select>
    </div>
    <br>
    <div class='form-group'>
        <button class='btn btn-success'>Thêm</button>
    </div>
</form>