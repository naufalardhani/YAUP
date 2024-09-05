<?php

function download_page() {
    if (!is_authenticated()) {
        flash('danger', 'You must be logged in to download files.');
        redir('login');
    }

    return html('pages/download.html.php');
}

function download_file() {
    global $pdo;

    if (!is_authenticated()) {
        flash('danger', 'You must be logged in to download a file.');
        redir('/login');
    }

    if (!isset($_POST['key']) || empty($_POST['key'])) {
        flash('danger', 'Please enter a key.');
        redir('/download');
    }

    $key = $_POST['key'];
    $username = $_SESSION['username'];

    if (!is_valid_username($username)) {
        flash('danger', 'Invalid username.');
        redir('/download');
    }

    $query = 'SELECT * FROM files WHERE key = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$key]);
    $upload_file = $stmt->fetch();

    if (!$upload_file) {
        flash('danger', 'File not found with this key.');
        redir('/download');
    }

    $upload_file_id = intval($upload_file['id']);
    $insert = "INSERT INTO history (username, file_id) VALUES ('$username', '$upload_file_id')";
    $success = $pdo->exec($insert);

    if ($success !== 1) {
        flash('danger', 'Unable to update history.');
        redir('/download');
    }

    $file_path = $upload_file['path'];
    $file_name = urlencode($upload_file['filename']);
    $file_size = filesize($file_path);

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $file_name);
    header('Content-Length: ' . $file_size);

    return readfile($file_path);
}
