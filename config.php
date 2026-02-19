<?php
// ============================================
// НАСТРОЙКИ БАЗЫ ДАННЫХ
// Замените на ваши данные от хостинга
// ============================================
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database_name');   // ← Ваше имя БД
define('DB_USER', 'your_database_user');   // ← Ваш пользователь БД
define('DB_PASS', 'your_database_password'); // ← Ваш пароль БД
define('DB_CHARSET', 'utf8mb4');

define('SITE_NAME', 'STREAM MAX');
define('SITE_PHONE', '03-967-0865');
define('SITE_EMAIL', 'info@streammax.tv');

// ============================================
// ПОДКЛЮЧЕНИЕ К БД
// ============================================
function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            http_response_code(500);
            die(json_encode(['error' => 'Ошибка подключения к базе данных']));
        }
    }
    return $pdo;
}

// ============================================
// СЕССИИ И ХЕЛПЕРЫ
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

function currentUser(): ?array {
    if (!isLoggedIn()) return null;
    $stmt = db()->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch() ?: null;
}

function isAdmin(): bool {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function redirect(string $url): void {
    header("Location: $url");
    exit;
}

function jsonResponse(array $data, int $code = 200): void {
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function sanitize(string $str): string {
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}
