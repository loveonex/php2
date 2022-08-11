<div>
    <p class='text-success m-2'>Thông tin khách hàng</p>
    <form class='col-md-8'>
        <div class='form-group'>
            <label>Tên: <?=$inforUser->user_name?></label>
        </div>
        <div class='form-group'>
            <label>Email: <?=$inforUser->user_email?></label>
        </div>
        <div class='form-group'>
            <label>Địa chỉ: <?=$inforUser->user_address?></label>
        </div>
    </form>
</div>
</div>
<table class='table align-middle mb-0 bg-white'>
    <thead class='bg-light'>
        <tr>
            <th>STT</th>
            <th>Tên Sản Phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $count = 0;
        foreach ($orders as $order) :
            $count += $order->price;
        ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $order->name ?></td>
                <td><?= $order->quantity ?></td>
                <td><?= number_format($order->price) ?> VNĐ</td>
            </tr>
        <?php
            $i++;
        endforeach
        ?>
        <tr>
            <td colspan="3" class="text-center fs-3">Tổng</td>
            <td class="fs-2"><?= number_format($count) ?> VNĐ</td>
        </tr>
    </tbody>
</table>