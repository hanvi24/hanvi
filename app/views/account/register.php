<?php include 'app/views/shares/header.php'; ?>

<div class="container">
    <div class="card mt-4">
        <div class="card-body p-5 text-center">
            <h2 class="mb-4">Đăng ký tài khoản</h2>

            <!-- Hiển thị lỗi nếu có -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger text-left">
                    <ul>
                        <?php foreach ($errors as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form đăng ký -->
            <form class="user" action="/account/save" method="post">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3">
                        <input type="text" class="form-control form-control-user"
                               id="username" name="username" placeholder="Tên đăng nhập"
                               required>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user"
                               id="fullname" name="fullname" placeholder="Họ và tên"
                               required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 mb-3">
                        <input type="password" class="form-control form-control-user"
                               id="password" name="password" placeholder="Mật khẩu"
                               required autocomplete="off">
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user"
                               id="confirmpassword" name="confirmpassword" placeholder="Xác nhận mật khẩu"
                               required autocomplete="off">
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-icon-split p-3">
                        Đăng ký
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
