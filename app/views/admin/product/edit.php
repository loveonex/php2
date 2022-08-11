<form class='col-md-5' action="/admin/product/edit" method="post" enctype="multipart/form-data">
    <div class='form-group'>
        <?php if (isset($errors['name'])) : ?>
            <span id='error' class='text-danger'><?= $errors['name'] ?></span><br>
        <?php endif ?>
        <label>Tên:</label>
        <input type='text' name='name' value="<?= $request['name'] ?? $product->name ?>" class='form-control' />
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
        <select class="form-control" name="cate_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category->id ?>" <?= isset($request['cate_id'])  ? ($request['cate_id'] == $category->id ? 'selected' : '') : ($product->cate_id == $category->id ? 'selected' : '') ?>><?= $category->name ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <br>
    <div class='form-group'>
        <?php if (isset($errors['price'])) : ?>
            <span id='error' class='text-danger'><?= $errors['price'] ?></span><br>
        <?php endif ?>
        <label>Giá:</label>
        <input type='number' name='price' value="<?= $request['price'] ?? $product->price ?>" class='form-control' />
    </div>
    <br>
    <div class='form-group'>
    <?php if (isset($errors['description'])) : ?>
            <span id='error' class='text-danger'><?= $errors['description'] ?></span><br>
        <?php endif ?>
        <label>Mô tả</label>
        <textarea name="description" class="form-control" id="" cols="30" rows="10"><?= $request['description'] ?? $product->description ?></textarea>
    </div>
    <br>
    <input type="hidden" name="id" value="<?=$product->id?>">
    <div class='form-group'>
        <button class='btn btn-success'>Sửa</button>
    </div>
</form>