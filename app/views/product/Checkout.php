<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1>Thanh toán</h1>

    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['flash_message']; ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <form method="POST" action="/Product/processCheckout">
        <div class="form-group">
            <label for="name">Họ tên:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <textarea id="address" name="address" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Thanh toán</button>
    </form>

    <a href="/Product/cart" class="btn btn-secondary mt-2">Quay lại giỏ hàng</a>
</div>

<?php include 'app/views/shares/footer.php'; ?>