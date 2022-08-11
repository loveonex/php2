<div id="carouselExampleIndicators" class="carousel slide container p-5" style="width:1260px; height:560px" data-bs-ride="carousel">
    <div class="carousel-indicators" id="home-product">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img style="max-width:100%" src="https://png.pngtree.com/thumb_back/fw800/back_our/20190617/ourmid/pngtree-atmospheric-e-commerce-banner-design-poster-image_124818.jpg" class="d-block w-100" alt="...">
        </div>
        <?php
        foreach($banners as $banner) :
        ?>
        <div class="carousel-item">
            <img style="max-width:100%" src="<?=$banner->image?>" class="d-block w-100" alt="...">
        </div>
        <?php endforeach ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="app__container">
    <div class="grid wide">
        <div class="row sm-gutter app__content">
            <div class="col-12">
                <div class="home-filter hide-on-mobile-tablet">
                    <span class="home-filter__label">Sắp xếp theo</span>
                    <button class="home-filter__btn btn fs-4">Phổ biến</button>
                    <button class="home-filter__btn btn btn--primary fs-4">Mới nhất</button>
                    <button class="home-filter__btn btn fs-4">Bán chạy</button>
                    <div class="select-input">
                        <span class="select-input__label">Danh Mục</span>
                        <i class="select-input__icon fas fa-angle-down"></i>

                        <!-- List option -->
                        <ul class="select-input__list">
                            <?php foreach ($categories as $category) : ?>
                            <li class="select-input__item">
                                <a href="/product?id=<?=$category->id?>" class="select-input__link"><?= $category->name ?></a>
                            </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="select-input">
                        <span class="select-input__label">Giá</span>
                        <i class="select-input__icon fas fa-angle-down"></i>

                        <!-- List option -->
                        <ul class="select-input__list">
                            <li class="select-input__item">
                                <a href="/?price=asc#home-product" class="select-input__link">Thấp đến cao</a>
                            </li>
                            <li class="select-input__item">
                                <a href="/?price=desc#home-product" class="select-input__link">Cao đến thấp</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="home-product">
                    <div class="row sm-gutter">
                        <?php foreach ($products as $product) : ?>
                            <div class="col-2">
                                <a class="home-product-item" href="/detail?id=<?= $product->id ?>">
                                    <div class="home-product-item__img" style="background-image: url(/images/<?= $product->image ?>); max-width:100%"></div>
                                    <h4 class="home-product-item__name  fs-3 text-center"><?= $product->name ?></h4>
                                    <div class="home-product-item__price">
                                        <!-- <span class="home-product-item__price-old">4.500.000đ</span> -->
                                        <span class="home-product-item__price-new text-center">Giá: <?= number_format($product->price) ?> VNĐ</span>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

                <ul class="pagination home-product__pagination">
                    <li class="pagination-item">
                        <a href="index_2.html" class="pagination-item__link">
                            <i class="pagination-item__icon fas fa-angle-left"></i>
                        </a>
                    </li>
                    <li class="pagination-item pagination-item--active">
                        <a href="" class="pagination-item__link">1</a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">2</a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">3</a>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">...</a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">14</a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">
                            <i class="pagination-item__icon fas fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>