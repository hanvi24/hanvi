<?php include 'app/views/shares/header.php'; ?>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card text-white" style="border-radius: 1rem; background-color: #871F78;">
                    <div class="card-body p-5 text-center">
                        <form action="/account/checklogin" method="post">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-4">Please enter your login and password!</p>
                                <p id="error-message" class="text-danger"></p>

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

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control form-control-lg"
                                        required autocomplete="off">
                                </div>

                                <div class="form-outline form- mb-4">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg"
                                        required autocomplete="off">
                                </div>

                                <p class="small mb-5 pb-lg-2">
                                    <a class="text-white-50" href="#!">Forgot password?</a>
                                </p>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                    <a href="#!" class="text-white mx-2"><i class="fab fa-facebook-f fa-lg"></i></a>
                                    <a href="#!" class="text-white mx-2"><i class="fab fa-twitter fa-lg"></i></a>
                                    <a href="#!" class="text-white mx-2"><i class="fab fa-google fa-lg"></i></a>
                                </div>
                            </div>

                            <div>
                                <p class="mb-0">
                                    Don't have an account?
                                    <a href="/account/register" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn chặn reload trang

        const formData = new FormData(this);
        const jsonData = {};

        formData.forEach((value, key) => {
            jsonData[key] = value;
        });

        fetch('/account/checklogin', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(jsonData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    localStorage.setItem('jwtToken', data.token); // Lưu token vào LocalStorage
                    location.href = '/product'; // Chuyển hướng đến trang sản phẩm
                } else {
                    document.getElementById('error-message').textContent = 'Đăng nhập thất bại!';
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>