<table class='table align-middle mb-0 bg-white'>
    <thead class='bg-light'>
        <tr>
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th colspan="2">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($receipts as $receipt) : ?>
            <tr>
                <td><?= $receipt->user_name ?></td>
                <td><?= $receipt->user_email ?></td>
                <td>
                    <a href="/admin/receipt/detail?user_email=<?= $receipt->user_email ?>" class="btn btn-primary">Chi Tiết</a>
                    <a href="/admin/receipt/status?user_email=<?= $receipt->user_email ?>" class="btn btn-<?=$receipt->status == 0 ? "danger": "success"?>" onclick="return confirm('Khách hàng <?= $receipt->user_name ?> <?=$receipt->status == 0 ? 'Đã': 'Chưa'?> thanh toán ?');"><?=$receipt->status == 0 ? "Chưa": "Đã"?> Thanh Toán</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>