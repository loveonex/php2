<div class="auth-form" style="width:600px; margin:50px auto; background: #ccc;">

    <div class="auth-form__container">
        <div class="auth-form__header">
            <h3 class="auth-form__heading">Đăng ký</h3>
            <a class="auth-form__switch-btn" href="/login">Đăng nhập</a>
        </div>

        <form action="/register" method="post" enctype="multipart/form-data">
            <div class="auth-form__form">
                <div class="auth-form__group">
                    <?php if (isset($errors['name'])) : ?>
                        <span id='error' class='text-danger fs-4'><?= $errors['name'] ?></span>
                    <?php endif ?>
                    <input type="text" name="name" class="auth-form__input" value="<?=$request['name'] ?? ""?>" placeholder="Tên của bạn">
                </div>
                <br>
                <div class="auth-form__group">
                    <?php if (isset($errors['email'])) : ?>
                        <span id='error' class='text-danger fs-4'><?= $errors['email'] ?></span>
                    <?php endif ?>
                    <?php if (isset($errors['fail'])) : ?>
                        <span id='error' class='text-danger fs-4'><?= $errors['fail'] ?></span>
                    <?php endif ?>
                    <input type="text" name="email" class="auth-form__input" value="<?=$request['email'] ?? ""?>" placeholder="Email của bạn">
                </div>
                <br>
                <div class="auth-form__group">
                    <?php if (isset($errors['password'])) : ?>
                        <span id='error' class='text-danger fs-4'><?= $errors['password'] ?></span>
                    <?php endif ?>
                    <input type="password" name="password" class="auth-form__input" placeholder="Mật khẩu của bạn">
                </div>
                <br>
                <div class="auth-form__group">
                    <?php if (isset($errors['re_password'])) : ?>
                        <span id='error' class='text-danger fs-4'><?= $errors['re_password'] ?></span>
                    <?php endif ?>
                    <input type="password" name="re_password" class="auth-form__input" placeholder="Nhập lại mật khẩu">
                </div>
                <br>
                <div class="auth-form__group">
                    <label for="" class="fs-3">Ảnh của bạn:</label><br>
                    <input type="file" name="image" class="auth-form__input">
                </div>
            </div>
            <div class="auth-form__controls">
                <button class="btn btn--primary btn-disabled">
                    ĐĂNG KÝ
                </button>
            </div>
        </form>

    </div>

    <div class="auth-form__socials">
        <a href="" class="auth-form__socials--facebook btn btn--size-s btn--with-icon">
            <i class="auth-form__socials-icon fab fa-facebook-square"></i>
            <span class="auth-form__socials-title">
                Kết nối với Facebook
            </span>
        </a>
        <a href="" class="auth-form__socials--google btn btn--size-s btn--with-icon">
            <i class="auth-form__socials-icon fab fa-google"></i>
            <span class="auth-form__socials-title">
                Kết nối với Google
            </span>
        </a>
    </div>
</div>