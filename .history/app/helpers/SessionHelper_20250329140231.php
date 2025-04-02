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
            $decoded = $jwtHandler->decode($_COOKIE['jwtToken']);
            if ($decoded && isset($decoded['username'])) {
                $_SESSION['username'] = $decoded['username']; // Lưu vào session
                return true;
            }
        }

        return false;
    }
    public static function isAdmin()
    {
        return isset($_SESSION['username']) && isset($_SESSION['user_role']) === 'admin';
    }
}
