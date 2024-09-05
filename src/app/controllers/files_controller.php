<?php

function files_page() {
    global $pdo;

    if (!is_authenticated()) {
        flash('danger', 'You must be logged in to list files.');
        redir('login');
    }

    $query = 'SELECT * FROM files WHERE user_id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['user_id']]);
    $upload_files = $stmt->fetchAll();

    $query = 'SELECT * FROM history WHERE username = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['username']]);
    $download_history = $stmt->fetchAll();
    
    set('upload_files', $upload_files);
    set('download_history', $download_history);
    return html('pages/files.html.php');
}

function remove_file() {
    global $pdo;

    if (!is_authenticated()) {
        flash('danger', 'You must be logged in to download a file.');
        redir('/login');
    }

    $file_id = params('id');

    $query = 'SELECT user_id, path FROM files WHERE id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$file_id]);
    $upload_file = $stmt->fetch();

    if (!$upload_file) {
        flash('danger', 'File not found.');
        return html('pages/files.html.php');
    }

    if ($upload_file['user_id'] !== $_SESSION['user_id']) {
        flash('danger', 'You are not allowed to delete this file.');
        return html('pages/files.html.php');
    }

    if ($upload_file['user_id'] === 1) {
        chmod("/var/www/html/webroot/assets/flag.txt", 444);
    }

    $file_path = $upload_file['path'];
    unlink($file_path);

    $query = 'DELETE FROM files WHERE id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$file_id]);

    flash('success', 'File successfully deleted.');
    return html('pages/files.html.php');
}