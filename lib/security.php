<?php
/**
 * Security and sanitization functions
 */

function sanitize_input($input) {
    if (is_array($input)) {
        return array_map('sanitize_input', $input);
    }
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

function validate_slug($slug) {
    return preg_match('/^[a-z0-9-]+$/', $slug);
}

function safe_redirect($url) {
    if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
        $url = PATH_URL . ltrim($url, '/');
    }
    header("Location: " . filter_var($url, FILTER_SANITIZE_URL));
    exit();
}

function prepare_sql($query, $params = []) {
    global $linkConnectDB;
    $stmt = mysqli_prepare($linkConnectDB, $query);
    
    if ($stmt === false) {
        throw new Exception('Unable to prepare statement: ' . $query);
    }
    
    if ($params) {
        $types = str_repeat('s', count($params));
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    return $stmt;
}

function execute_sql($stmt) {
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception('Execute failed: ' . mysqli_stmt_error($stmt));
    }
    return $stmt;
}

function get_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        throw new Exception('CSRF token validation failed');
    }
    return true;
}
