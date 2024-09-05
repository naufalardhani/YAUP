<?php

function upload_page() {
    if (!is_authenticated()) {
        flash('danger', 'You must be logged in to upload a file.');
        redir('/login');
    }

    return html('pages/upload.html.php');
}

function upload_file() {
    global $pdo;

    if (!is_authenticated()) {
        flash('danger', 'You must be logged in to upload a file.');
        return html('pages/login.html.php');
    }

    if (!isset($_FILES['file'])) {
        flash('danger', 'Please choose a file to upload.');
        redir('/upload');
    }

    if (!isset($_POST['filename']) || empty($_POST['filename'])) {
        flash('danger', 'Please enter a file name.');
        redir('/upload');
    }

    $file_name = $_POST['filename'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');

    if (!in_array($file_extension, $allowed_extensions)) {
        flash('danger', 'Only PNG/JPG/GIF files are allowed.');
        redir('/upload');
    }

    if ($file_size > 2 * 1024 * 1024) {
        flash('danger', 'The file is too large. Please choose a file smaller than 2 MB.');
        redir('/upload');
    }

    if (strpos($file_name, "..") !== false || strpos($file_name, "/") !== false) {
        flash('danger', 'Forbidden characters in file name.');
        redir('/upload');
    }

    $upload_path = '/var/uploads/' . uniqid($file_name . '-' . bin2hex(random_bytes(13)));
    $key_for_download = substr($upload_path, -13);

    if (!move_uploaded_file($file_tmp, $upload_path)) {
        flash('danger', 'An error occurred while uploading the file.');
        redir('/upload');
    }

    $sql = 'INSERT INTO files (user_id, filename, key, path) VALUES (?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id'], $file_name, $key_for_download, $upload_path]);

    flash('success', 'File uploaded successfully.');
    redir('/upload');
}