<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center mb-4">Danh sách sản phẩm</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <?php if (SessionHelper::isAdmin()): ?>
            <a href="/Product/add" class="btn btn-success">➕ Thêm sản phẩm mới</a>
        <?php endif; ?>
        <a href="/Product/cart" class="btn btn-success">🛒 Giỏ hàng của bạn</a>
    </div>

    <?php $selectedCategory = $_GET['category'] ?? 'all'; ?>

    <div class="categories mb-4">
        <ul class="nav nav-pills justify-content-center">
            <?php
            $categories = [
                'all' => 'Tất cả',
                'Điện thoại' => 'Điện thoại',
                'Laptop' => 'Laptop',
                'Máy tính bảng' => 'Máy tính bảng',
                'Phụ kiện' => 'Phụ kiện',
                'Thiết bị âm thanh' => 'Thiết bị âm thanh'
            ];

            foreach ($categories as $key => $value) : ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($selectedCategory === $key) ? 'active' : '' ?>" href="?category=<?= $key; ?>">
                        <?= $value; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <ul id="product-list" class="list-group"></ul>
        <?php foreach ($products as $product) : ?>
            <?php if ($selectedCategory === 'all' || $product->category_name === $selectedCategory) : ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="/<?= $product->image ?: 'images/no-image.png'; ?>" class="card-img-top" alt="Product Image" style="height: 300px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="/Product/show/<?= $product->id; ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted small">
                                Giá: <strong class="text-danger"><?= number_format($product->price, 0, ',', '.'); ?> VND</strong>
                            </p>
                            <p class="card-text small">
                                Danh mục: <span class="badge bg-primary"><?= htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></span>
                            </p>
                            <div class="d-flex justify-content-center">
                                <?php if (SessionHelper::isAdmin()): ?>
                                    <a href="/Product/edit/<?= $product->id; ?>" class="btn btn-warning btn-sm mx-1">✏️ Sửa</a>
                                    <a href="/Product/delete/<?= $product->id; ?>" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');"> Xóa</a>
                                <?php endif; ?>
                                <a href="/Product/addToCart/<?= $product->id; ?>" class="btn btn-primary btn-sm mx-1">🛒 Giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .categories .nav-link {
        font-size: 16px;
        font-weight: 500;
        padding: 10px 15px;
    }

    .categories .nav-link.active {
        background-color: #007bff;
        color: #fff;
    }
</style>

<?php include 'app/views/shares/footer.php'; ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const token = localStorage.getItem('jwtToken');
        if (!token) {
            alert('Vui lòng đăng nhập');
            location.href = '/account/login';
            return;
        }

        fetch('/api/product', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Không thể lấy danh sách sản phẩm');
                return response.json();
            })
            .then(data => {
                const productList = document.getElementById('product-list');
                productList.innerHTML = ''; // Xóa danh sách cũ trước khi thêm mới

                data.forEach(product => {
                    const productItem = document.createElement('li');
                    productItem.id = `product-${product.id}`;
                    productItem.className = 'list-group-item';
                    productItem.innerHTML = `
                <h2><a href="/Product/show/${product.id}">${product.name}</a></h2>
                <p>${product.description}</p>
                <p>Giá: ${product.price.toLocaleString('vi-VN')} VND</p>
                <p>Danh mục: ${product.category_name}</p>
                <a href="/Product/edit/${product.id}" class="btn btn-warning">Sửa</a>
                <button class="btn btn-danger" onclick="deleteProduct(${product.id})">Xóa</button>
            `;
                    productList.appendChild(productItem);
                });
            })
            .catch(error => alert(error.message));
    });

    function deleteProduct(id) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
            fetch(`/api/product/${id}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Product deleted successfully') {
                        document.getElementById(`product-${id}`).remove(); // Xóa ngay trên giao diện
                    } else {
                        alert('Xóa sản phẩm thất bại');
                    }
                });
        }
    }
</script>