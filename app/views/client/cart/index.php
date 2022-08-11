<h1 class="text-center" style="margin: 30px auto;">Giỏ Hàng Của Bạn</h1>
<table class="table container p-5 fs-4" style="margin: 30px auto;">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Sản Phẩm</th>
      <th scope="col">Số Lượng</th>
      <th scope="col">Giá</th>
      <th scope="col">Thao Tác</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $count = 0;
    $i = 1;
    foreach ($orders as $order) :
      $count += $order->price;
    ?>
      <tr>
        <td><?= $i ?></td>
        <td><?= $order->name ?></td>
        <td>
          <form action="/cart/update" method="post">
            <input type="number" name="quantity" value="<?= $order->quantity ?>" class="fs-4" style="width:60px">
            <input type="hidden" name="product_id" value="<?= $order->id ?>">
            <button style="width:50px; border:2px solid green;border-radius:5px ;background:green; color:#fff;">Lưu</button>
          </form>
        </td>
        <td><?= number_format($order->price) ?> VNĐ</td>
        <td>
          <a href="/cart/delete?<?= !isset($_SESSION['auth']) ? ("product_id=" . $order->id) : ("product_id=$order->id&user_id=" . $_SESSION['auth']->id) ?>" class="btn btn-danger fs-4" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm <?= $order->name ?> khỏi đơn hàng không ?');">Xóa</a>
        </td>
      </tr>
    <?php
      $i++;
    endforeach
    ?>
    <tr>
      <td colspan="3" class="text-center fs-2">Tổng</td>
      <td class="fs-2" colspan="2"><?= number_format($count) ?> VNĐ</td>
    </tr>
  </tbody>
</table>
<?php
if($orders) :
?>
<div class="row container ">
  <div class="col-7"></div>
  <div class="col-5" style="margin-bottom:20px">
  <h3>Thông tin khách hàng</h3>
    <form action="/cart/pay" method="post">
      <div class="auth-form__form">
        <div class="auth-form__group">
          <?php if (isset($errors['user_name'])) : ?>
            <span id='error' class='text-danger fs-4'><?= $errors['user_name'] ?></span>
          <?php endif ?>
          <input type="text" name="user_name" class="auth-form__input" value="<?= !isset($request['user_name']) ? (isset($_SESSION['auth']) ? $_SESSION['auth']->name : '') : $request['user_name'] ?>" placeholder="Tên của bạn">
        </div>
        <br>
        <div class="auth-form__group">
          <?php if (isset($errors['user_email'])) : ?>
            <span id='error' class='text-danger fs-4'><?= $errors['user_email'] ?></span>
          <?php endif ?>
          <?php if (isset($errors['fail'])) : ?>
            <span id='error' class='text-danger fs-4'><?= $errors['fail'] ?></span>
          <?php endif ?>
          <input type="text" name="user_email" class="auth-form__input" value="<?= !isset($request['user_email']) ? (isset($_SESSION['auth']) ? $_SESSION['auth']->email : '') : $request['user_email'] ?>" placeholder="Email của bạn">
        </div>
        <br>
        <div class="auth-form__group">
          <?php if (isset($errors['user_address'])) : ?>
            <span id='error' class='text-danger fs-4'><?= $errors['user_address'] ?></span>
          <?php endif ?>
          <input type="text" name="user_address" class="auth-form__input" value="<?= $request['user_address'] ?? "" ?>" placeholder="Địa chỉ của bạn">
        </div>
      </div>
      <div class="auth-form__controls">
        <button onclick="return confirm('Bạn chắc chắn muốn thanh toán đơn hàng ?')" class="btn btn--primary btn-disabled fs-4">
          Đặt hàng
        </button>
      </div>
    </form>
  </div>
</div>
<?php
endif
?>