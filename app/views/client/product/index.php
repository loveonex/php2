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
                                    <h4 class="home-product-item__name fs-3 text-center"><?= $product->name ?></h4>
                                    <div class="home-product-item__price">
                                        <!-- <span class="home-product-item__price-old">4.500.000đ</span> -->
                                        <span class="home-product-item__price-new"><?= number_format($product->price) ?> VNĐ</span>
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
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">4</a>
                    </li>
                    <li class="pagination-item">
                        <a href="" class="pagination-item__link">5</a>
                    </li>
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