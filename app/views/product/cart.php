<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center mb-4">🛒 Giỏ hàng của bạn</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <div class="alert alert-warning text-center">
            🛍 Giỏ hàng của bạn đang trống. <a href="/product">Mua sắm ngay!</a>
        </div>
    <?php else: ?>
        <form action="/Product/updateCart" method="post">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã hàng</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $totalPrice = 0;
                        foreach ($_SESSION['cart'] as $id => $item): 
                            $itemTotal = $item['price'] * $item['quantity'];
                            $totalPrice += $itemTotal;

                            if (!isset($item['cartItemId'])) {
                                $item['cartItemId'] = generateUniqueCartItemId($_SESSION['cart']);
                                $_SESSION['cart'][$id]['cartItemId'] = $item['cartItemId'];
                            }
                    ?>
                        <tr>
                            <td><?= $item['cartItemId']; ?></td>
                            <td><img src="/<?= $item['image']; ?>" width="60" alt="Ảnh sản phẩm"></td>
                            <td><?= htmlspecialchars($item['name']); ?></td>
                            <td><strong class="text-danger"><?= number_format($item['price']); ?> VND</strong></td>
                            <td>
                                <input type="number" name="quantities[<?= $id; ?>]" value="<?= $item['quantity']; ?>" min="1" class="form-control w-50 quantity-input" data-id="<?= $id; ?>" data-price="<?= $item['price']; ?>">
                            </td>
                            <td class="item-total"><strong class="text-success"><?= number_format($itemTotal); ?> VND</strong></td>
                            <td>
                                <a href="/Product/removeFromCart/<?= $id; ?>" class="btn btn-danger btn-sm">🗑 Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center">
                <h4>Tổng tiền: <strong class="text-danger total-price"><?= number_format($totalPrice); ?> VND</strong></h4>
                <div>
                    <button type="submit" class="btn btn-primary">🔄 Cập nhật</button>
                    <a href="/Product/checkout" class="btn btn-success">💳 Thanh toán</a>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php
function generateUniqueCartItemId($cart) {
    do {
        $cartItemId = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    } while (array_key_exists($cartItemId, array_flip(array_column($cart, 'cartItemId'))));
    return $cartItemId;
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const totalPriceElement = document.querySelector('.total-price');

        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                const id = this.dataset.id;
                const price = parseFloat(this.dataset.price);
                const quantity = parseInt(this.value);
                const itemTotalElement = this.parentElement.parentElement.querySelector('.item-total strong');

                const itemTotal = price * quantity;
                itemTotalElement.textContent = new Intl.NumberFormat().format(itemTotal) + ' VND';

                calculateTotalPrice();
            });
        });

        function calculateTotalPrice() {
            let totalPrice = 0;
            quantityInputs.forEach(input => {
                const price = parseFloat(input.dataset.price);
                const quantity = parseInt(input.value);
                totalPrice += price * quantity;
            });
            totalPriceElement.textContent = new Intl.NumberFormat().format(totalPrice) + ' VND';
        }

        calculateTotalPrice();
    });
</script>
<?php include 'app/views/shares/footer.php'; ?>