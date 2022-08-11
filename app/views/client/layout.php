<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="http://localhost:8000/css/base.css">
    <link rel="stylesheet" href="http://localhost:8000/css/main.css">
    <link rel="stylesheet" href="http://localhost:8000/css/grid.css">
    <link rel="stylesheet" href="http://localhost:8000/css/responsive.css">
    <link rel="stylesheet" href="http://localhost:8000/fonts/fontawesome-free-5.15.3-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="app">
        <header class="header">
            <div class="grid wide">
                <nav class="header__navbar hide-on-mobile-tablet">
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item">
                            <span class="header__navbar-title--no-pointer">Kết nối</span>
                            <a href="" class="header__navbar-icon-link">
                                <i class="header__navbar-icon fab fa-facebook"></i>
                            </a>
                            <a href="" class="header__navbar-icon-link">
                                <i class="header__navbar-icon fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="header__navbar-list">
                        <li class="header__navbar-item">
                            <a href="" class="header__navbar-item-link">
                                <i class="header__navbar-icon far fa-question-circle"></i> Trợ giúp
                            </a>
                        </li>
                        <?php
                        if (!isset($_SESSION['auth'])) :
                        ?>
                            <li class="header__navbar-item header__navbar-item--strong header__navbar-item--separate">
                                <a href="/register" class="header__navbar-item-link">
                                    Đăng ký
                                </a>
                            </li>
                        <?php
                        endif
                        ?>
                        <!-- User -->
                        <li class="header__navbar-item header__navbar-user">
                            <?php
                            if (isset($_SESSION['auth'])) :
                            ?>
                                <img src="/images/<?= $_SESSION['auth']->image != "" ? $_SESSION['auth']->image : "icon_user.png" ?>" alt="" class="header__navbar-user-img">
                            <?php
                            endif
                            ?>
                            <a href="<?= isset($_SESSION['auth']) ? "#" : "/login" ?>" class="header__navbar-item-link"><?= $_SESSION['auth']->name ?? "Đăng nhập" ?></a>
                            <?php
                            if (isset($_SESSION['auth'])) :
                            ?>
                                <ul class="header__navbar-user-menu">
                                    <?php
                                    if ($_SESSION['auth']->role > 0) :
                                    ?>
                                        <li class="header__navbar-user-item">
                                            <a href="/admin">Trang Quản Lí</a>
                                        </li>
                                    <?php
                                    endif
                                    ?>
                                    <li class="header__navbar-user-item">
                                        <a href="">Tài khoản của tôi</a>
                                    </li>
                                    <li class="header__navbar-user-item header__navbar-user-item--separate">
                                        <a href="/logout">Đăng xuất</a>
                                    </li>
                                </ul>
                            <?php
                            endif
                            ?>
                        </li>

                    </ul>
                </nav>

                <!-- Header with search -->
                <div class="header-with-search">
                    <label for="mobile-search-checkbox" class="header__mobile-search">
                        <i class="fas fa-search header__mobile-search-icon"></i>
                    </label>
                    <!-- Header Logo -->
                    <div class="header__logo hide-on-tablet">
                        <a href="/" class="header__logo-link">
                            Namtv
                        </a>
                    </div>

                    <input type="checkbox" hidden id="mobile-search-checkbox" class="header__search-checkbox">
                    <!-- Header Search -->
                    <form class="header__search" action="/#home-product" method="post">
                        <div class="header__search-input-wrap">
                            <input type="text" class="header__search-input" name="find" placeholder="Nhập để tìm kiếm sản phẩm">
                        </div>
                        <button class="header__search-btn">
                            <i class="header__search-btn-icon fas fa-search"></i>
                        </button>
                    </form>

                    <!-- Cart layout -->
                    <div class="header__cart">
                        <div class="header__cart-wrap">
                            <a href="/cart">
                                <i class="header-cart-icon fas fa-shopping-cart"></i>
                                <span class="header__cart-notice"><?= !isset($_SESSION['auth']) ? (isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0) : count($item_orders) ?></span>
                            </a>

                            <!-- No cart:header__cart-list--no-cart -->
                            <div class="header__cart-list">
                                <div src="" alt="" class="header__cart-no-cart-img"></div>
                                <span class="header__cart-list-no-cart-msg">
                                    Chưa có sản phẩm
                                </span>
                                <h4 class="header__cart-heading">Sản phẩm đã thêm</h4>
                                <ul class="header__cart-list-item">
                                    <?php
                                    foreach ($item_orders as $order) :
                                    ?>
                                        <li class="header__cart-item">
                                            <img src="/images/<?= $order->image ?>" alt="" class="header__cart-img">
                                            <div class="header__cart-item-info">
                                                <div class="header__cart-item-head">
                                                    <h5 class="header__cart-item-name"><?= $order->name ?></h5>
                                                    <div class="header__cart-item-price-wrap">
                                                        <span class="header__cart-item-price"><?= number_format($order->price) ?>đ</span>
                                                        <span class="header__cart-item-multiply">x</span>
                                                        <span class="header__cart-item-quanlity"><?= $order->quantity ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                    endforeach
                                    ?>
                                </ul>
                                <a href="/cart" class="header__cart-view-cart btn btn--primary fs-4">Xem giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <?php
        include_once $view;
        ?>

        <footer class="footer">
            <div class="grid wide footer__content">
                <div class="row">
                    <div class="col l-2-4 m-4 c-6">
                        <h3 class="footer__heading">Chăm sóc khách hàng</h3>
                        <ul class="footer__list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Trung tâm trợ giúp</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">F9-Shop Mall</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Hướng dẫn mua hàng</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l-2-4 m-4 c-6">
                        <h3 class="footer__heading">Giới thiệu</h3>
                        <ul class="footer__list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Giới thiệu</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Tuyển dụng</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Điều khoản</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l-2-4 m-4 c-6">
                        <h3 class="footer__heading">Danh mục</h3>
                        <ul class="footer__list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Trang điểm</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Quần áo</a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">Công nghệ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l-2-4 m-4 c-6">
                        <h3 class="footer__heading">Theo dõi</h3>
                        <ul class="footer__list">
                            <li class="footer-item">
                                <a href="" class="footer-item__link">
                                    <i class="footer-item__icon fab fa-facebook"></i> Facebook
                                </a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">
                                    <i class="footer-item__icon fab fa-instagram"></i> Instagram
                                </a>
                            </li>
                            <li class="footer-item">
                                <a href="" class="footer-item__link">
                                    <i class="footer-item__icon fab fa-linkedin"></i> Linkedin
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col l-2-4 m-8 c-12">
                        <h3 class="footer__heading">Vào cửa hàng trên ứng dụng</h3>
                        <div class="footer__download">
                            <img src="http://localhost:8000/images/qrcode.png" alt="QR code" class="footer__download-qr">
                            <div class="footer__download-apps">
                                <a href="" class="footer__download-app-link">
                                    <img src="http://localhost:8000/images/appstore.png" alt="Appstore" class="footer__download-app-img">
                                </a>
                                <a href="" class="footer__download-app-link">
                                    <img src="http://localhost:8000/images/chplay.png" alt="Ch Play" class="footer__download-app-img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__row">
                <div class="grid wide">
                    <div class="footer__column">
                        <p class="footer-company">Công ty TNHH LOVEONEX</p>
                        <div class="footer__info">
                            <p>Địa chỉ: Số 4A hẻm 25 ngách 93 ngõ 59 Mễ Trì. Tổng đài hỗ trợ: 0878409100 - Email: namtvph13226@fpt.edu.vn</p>
                            <p>Chịu Trách Nhiệm Quản Lý Nội Dung: Trần Văn Nam - Điện thoại liên hệ: 08 39551901</p>
                            <p>Bản quyền thuộc về Công ty TNHH LOVEONEX</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>