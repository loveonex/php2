<form class='col-md-5' action="/admin/category/edit" method="post" enctype="multipart/form-data">
    <div class='form-group'>
        <?php if (isset($errors['name'])) : ?>
            <span id='error' class='text-danger'><?= $errors['name'] ?></span><br>
        <?php endif ?>
        <label>Tên:</label>
        <input type='text' name='name' value="<?= $request['name'] ?? $category->name ?>" class='form-control' />
    </div>
    <br>
    <input type="hidden" name="id" value="<?=$category->id?>">
    <div class='form-group'>
        <button class='btn btn-success'>Sửa</button>
    </div>
</form>