<?php

function register_page() {
    return html('pages/register.html.php');
}

function register_user() {
    global $pdo;

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!isset($username) || !isset($password) || empty($username) || empty($password)) {
        flash('danger', 'Username and password are required');
        redir('/register');
    }

    if (!is_valid_username($username)) {
        flash('danger', 'Invalid username');
        redir('/register');
    }

    $user = get_user_by_username($username);
    if ($user) {
        flash('danger', 'Username already taken');
        redir('/register');
    }

    $query = 'INSERT INTO users (username, password) VALUES (?, ?)';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username, $password]);

    $user_id = $pdo->lastInsertId();
    $_SESSION['user_id'] = intval($user_id);
    $_SESSION['username'] = $username;
    flash('success', 'You are successfully registered');
    redir('/');
}

function login_page() {
    return html('pages/login.html.php');
}

function login_user() {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!isset($username) || !isset($password) || empty($username) || empty($password)) {
        flash('danger', 'Username and password are required');
        redir('/login');
    }

    if ($username === 'admin' && in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) === false) {
        flash('danger', 'You can only log in as admin from localhost');
        redir('/login');
    }

    $user = get_user_by_username($username);
    if ($user && $password === $user['password']) {
        $_SESSION['user_id'] = intval($user['id']);
        $_SESSION['username'] = $username;
        flash('success', 'You are now logged in');
        redir('/');
    } else if ($user) {
        flash('danger', 'Invalid username or password');
        redir('/login');
    } else {
        flash('danger', 'Invalid username or password');
        redir('/login');
    }
}

function logout_user() {
    session_destroy();

    flash('success', 'You are now logged out');
    redir('/');
}