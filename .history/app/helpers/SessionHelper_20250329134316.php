<?php
class SessionHelper {
    public static function isLoggedIn() {
        return isset($_SESSION['username']);
    }

    if (!empty($_COOKIE['jwtToken'])) {
        $jwt = $_COOKIE['jwtToken'];
        $decoded = JWTHandler::verifyToken($jwt);
        if ($decoded) {
            $_SESSION['username'] = $decoded->username; // Lưu vào session
            return true;
        }
    }

    return false;
    }
}
?>