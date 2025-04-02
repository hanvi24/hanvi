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
            $jwtHandler = new JWTHandler();
            $$decoded = $jwtHandler->decode($_COOKIE['jwtToken']);
            if ($decoded) {
                $_SESSION['username'] = $decoded->username; // Lưu vào session để sử dụng tiếp
                return true;
            }
        }

        return false;
    }
}
