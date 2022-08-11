<div class="auth-form" style="width:600px; margin:50px auto; background: #ccc;">
    <div class="auth-form__container">
        <div class="auth-form__header">
            <h3 class="auth-form__heading">Đăng nhập</h3>
            <a class="auth-form__switch-btn" href="/register">Đăng ký</a>
        </div>
        <?php if (isset($errors['fail'])) : ?>
            <span id='error' class='text-danger fs-4'><?= $errors['fail'] ?></span><br>
        <?php endif ?>
        <form action="/login" method="post">
            <div class="auth-form__form">
                <div class="auth-form__group">
                    <?php if (isset($errors['email'])) : ?>
                        <span id='error' class='text-danger fs-4'><?= $errors['email'] ?></span><br>
                    <?php endif ?>
                    <input type="text" class="auth-form__input" name="email" value="<?= $request['email'] ?? '' ?>" placeholder="Email của bạn">
                </div>
                <div class="auth-form__group">
                    <?php if (isset($errors['password'])) : ?>
                        <span id='error' class='text-danger fs-4'><?= $errors['password'] ?></span><br>
                    <?php endif ?>
                    <input type="password" class="auth-form__input" name="password" placeholder="Mật khẩu của bạn">
                </div>
            </div>
            <div class="auth-form__controls">
                <button class="btn btn--primary">
                    ĐĂNG NHẬP
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