<?php

function get_user_by_username($username) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    return $stmt->fetch();
}

function is_valid_username($username) {
    $reserved_keywords = array('admin', 'copy', 'paste', 'insert', 'update', 'pg_ls_dir', 'pg_read_file');

    foreach ($reserved_keywords as $keyword) {
        if (stripos($username, $keyword) !== false) {
            return false;
        }
    }

    return preg_match('/^[a-zA-Z0-9_]+/', $username);
}

function is_authenticated() {
    return isset($_SESSION['user_id']);
}

function redir($uri) {
    header('Location: ' . $uri);
    exit;
}