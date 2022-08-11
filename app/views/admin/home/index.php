<div>
    <h2 class="text-center">Home Admin</h2>
    <div class="row">
        <a href="/admin/product" class="btn btn-default col-3">There are <span class="text-danger"><?= count($products)?></span> Product</a>
        <a href="/admin/category" class="btn btn-default col-3">There are <span class="text-danger"><?= count($categories)?></span> Category</a>
        <a href="/admin/user" class="btn btn-default col-3">There are <span class="text-danger"><?= count($users)?></span> User</a>
        <a href="" class="btn btn-default col-3">Banner</a>
    </div>
</div>