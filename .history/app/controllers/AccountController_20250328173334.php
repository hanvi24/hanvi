<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController {
    private AccountModel $accountModel;
    private PDO $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    public function register(): void {
        include_once 'app/views/account/register.php';
    }

    public function login(): void {
        include_once 'app/views/account/login.php';
    }

    public function save(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $fullName = trim($_POST['fullname'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $errors = [];

            // Kiểm tra đầu vào
            if (empty($username)) {
                $errors['username'] = "Vui lòng nhập username!";
            }
            if (empty($fullName)) {
                $errors['fullname'] = "Vui lòng nhập họ tên!";
            }
            if (empty($password)) {
                $errors['password'] = "Vui lòng nhập mật khẩu!";
            }
            if ($password !== $confirmPassword) {
                $errors['confirmPass'] = "Mật khẩu và xác nhận chưa đúng!";
            }

            // Kiểm tra username đã tồn tại chưa
            if ($this->accountModel->getAccountByUsername($username)) {
                $errors['account'] = "Tài khoản này đã có người đăng ký!";
            }

            if (!empty($errors)) {
                include_once 'app/views/account/register.php';
                return;
            }

            // Mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            // Lưu tài khoản
            if ($this->accountModel->save($username, $fullName, $hashedPassword)) {
                header('Location: /account/login');
                exit;
            }
        }
    }

    public function logout(): void {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /product');
        exit;
    }

    public function checkLogin(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
    
            $account = $this->accountModel->getAccountByUsername($username);
    
            if ($account && password_verify($password, $account->password)) {
                session_start();
                $_SESSION['username'] = $account->username;
                $_SESSION['user_role'] = $account->role; // Lưu vai trò vào session
                header('Location: /product');
                exit;
            } else {
                echo "Sai tài khoản hoặc mật khẩu!";
            }
        }
    }
}
