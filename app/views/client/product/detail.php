<div class="app_container ">
    <div class="grid wide">
        <div class="app__container--detail">
            <div class="col-2">
                <nav class="category">
                    <h3 class="category__heading">
                        Danh mục
                    </h3>
                    <ul class="category-list">
                        <?php foreach ($categories as $category) : ?>
                            <li class="category-item">
                                <a href="/product?id=<?= $category->id ?>" class="category-item__link"><?= $category->name ?></a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </nav>
            </div>
            <div class="product__detail">
                <img src="/images/<?= $product->image ?>" class="product__detail--img" alt="">
            </div>
            <div class="product__info">
                <h2 class="product__info--title"><?= $product->name ?>
                    <a href=""></a>
                </h2>
                <div class="grid-664">
                    <div class="product__price">
                        <span class="product__price--number"><?= number_format($product->price) ?> VNĐ</span>
                    </div>
                    <div class="product__transport">
                        <p class="product__transport--text">Vận Chuyển</p>
                        <ul class="product__transport--list">
                            <li class="product__transport--item">
                                <div class="product__transport--item--choice">
                                    <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/1cdd37339544d858f4d0ade5723cd477.png" width="25" height="15" class="_2geN66">
                                    <span class="product__transport--item--choice--text">Miễn phí vận
                                        chuyển</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <form action="/cart" method="post">
                        <div class="product__quanlity product__transport">
                            <span class="product__quanlity--text">Số lượng</span>
                            <div class="product__quanlity--table">
                                <input type="number" name="quantity" value="1" class="fs-4" style="width:115px">
                                <input type="hidden" name="product_id" value="<?=$product->id?>">
                            </div>
                        </div>
                        <div class="product__cart product__transport">
                            <button class="product__cart--box product__cart--add">
                                <i class="fas fa-shopping-cart product__cart--add--icon"></i>
                                <p class="product__cart--add--text">Thêm vào giỏ hàng</p>
                            </button>
                        </div>
                    </form>
                </div>
                <div>
                    <h2 class="text-center my-2">Mô tả</h2>
                    <p class="fs-4">- <?= $product->description ?></p>
                </div>
            </div>
        </div>
    </div>
</div>