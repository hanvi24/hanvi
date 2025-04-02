<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #F5F5F5;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar .navbar-brand,
        .navbar .nav-link {
            color: #fff !important;
        }

        .navbar .nav-link:hover {
            text-decoration: underline;
        }

        .banner img {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .container {
            margin-top: 20px;
        }

        .product-image {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const token = localStorage.getItem('jwtToken');

        if (token) {
            document.getElementById('nav-login').style.display = 'none';
            document.getElementById('nav-logout').style.display = 'block';
        } else {
            document.getElementById('nav-login').style.display = 'block';
            document.getElementById('nav-logout').style.display = 'none';
        }
    });

    function logout() {
        localStorage.removeItem('jwtToken');
        window.location.href = "/account/login"; // Chuyển hướng về trang đăng nhập
    }
</script>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="/product">Quản lý sản phẩm</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-1" action="/Product/search" method="GET">
                        <input class="form-control mr-sm-2" type="search" name="keyword"
                            placeholder="Tìm kiếm" aria-label="Search">
                        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Tìm</button>
                    </form>
                </li>

                <!-- Thêm phần kiểm tra trạng thái đăng nhập -->
                <li class="nav-item" id="nav-login">
                    <a class='nav-link text-white' href='/account/login'>Đăng nhập</a>";
                </li>

                <li class="nav-item" id="id=" nav-logout" style="display: none;">
                    <a class="nav-link text-white" href="#" onclick="logout()">Đăng xuất</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class=" container">
        <div class="banner mb-4">
            <img src="/images/banner1.jpg" class="img-fluid w-100" alt="Banner">
        </div>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>