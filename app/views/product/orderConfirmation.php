<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1>Xác nhận đơn hàng</h1>

    <?php if (isset($_SESSION['flash_message']) && $_SESSION['flash_message'] === "Đặt hàng thành công!"): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['flash_message']; ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <p>Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xử lý thành công.</p>

    <?php if (isset($order)): ?>
        <p><strong>Mã đơn hàng:</strong> <?php echo $order->id; ?></p>
        <p><strong>Tên người nhận:</strong> <?php echo htmlspecialchars($order->name); ?></p>
        <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($order->phone); ?></p>
        <p><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($order->address); ?></p>

        <h3>Sản phẩm đã mua:</h3>
        <ul>
            <?php foreach ($orderDetails as $item): ?>
                <li>
                    <?php echo htmlspecialchars($item->product_name); ?> - Số lượng: <?php echo $item->quantity; ?> - Giá: <?php echo number_format($item->price, 0, ',', '.'); ?> VND
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <a href="/Product/list" class="btn btn-primary mt-2">Tiếp tục mua sắm</a>
</div>

<?php include 'app/views/shares/footer.php'; ?>