<form class='col-md-5' action="/admin/category/add" method="post" enctype="multipart/form-data">
    <div class='form-group'>
        <?php if (isset($errors['name'])) : ?>
            <span id='error' class='text-danger'><?= $errors['name'] ?></span><br>
        <?php endif ?>
        <label>Tên:</label>
        <input type='text' name='name' value="<?= $request['name'] ?? '' ?>" class='form-control' />
    </div>
    <br>
    <div class='form-group'>
        <button class='btn btn-success'>Thêm</button>
    </div>
</form>