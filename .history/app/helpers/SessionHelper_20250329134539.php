<?php
class SessionHelper
{
    public static function isLoggedIn()
    {
        // Kiểm tra session trước
        if (!empty($_SESSION['username'])) {
            return true;
        }

        // Kiểm tra JWT token nếu không có session
        if (!empty($_COOKIE['jwtToken'])) {
            require_once 'app/helpers/JWTHandler.php'; // Đảm bảo file chứa hàm xử lý JWT được nạp vào

            $jwt = $_COOKIE['jwtToken'];
            $decoded = JWTHandler::verifyToken($jwt);
            if ($decoded) {
                $_SESSION['username'] = $decoded->username; // Lưu vào session để sử dụng tiếp
                return true;
            }
        }

        return false;
    }
}
