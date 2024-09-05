<?php

require_once __DIR__ . '/../app/lib/limonade.php';

require_once __DIR__ . '/../app/utils.php';
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/controllers/auth_controller.php';
require_once __DIR__ . '/../app/controllers/download_controller.php';
require_once __DIR__ . '/../app/controllers/files_controller.php';
require_once __DIR__ . '/../app/controllers/home_controller.php';
require_once __DIR__ . '/../app/controllers/report_controller.php';
require_once __DIR__ . '/../app/controllers/upload_controller.php';


function configure() {
    global $pdo;

    $environment = getenv('APP_ENV') ?: 'development';
    $flag2 = getenv('FLAG_2') ?: 'F4J{flag_2}';

    option('base_uri', '/');
    option('app_dir', file_path(dirname(option('root_dir')), 'app'));
    option('lib_dir', file_path(dirname(option('root_dir')), 'lib'));
    option('views_dir', file_path(option('app_dir'), 'views'));
    option('controllers_dir', file_path(option('app_dir'), 'controllers'));

    if ($environment == 'development') {
        $pdo->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, username VARCHAR(255) UNIQUE NOT NULL, password VARCHAR(255) NOT NULL)');
        $pdo->exec('CREATE TABLE IF NOT EXISTS files (id INTEGER PRIMARY KEY, user_id INTEGER NOT NULL, filename VARCHAR(255) NOT NULL, key VARCHAR(255) UNIQUE NOT NULL, path VARCHAR(255) NOT NULL)');
        $pdo->exec('CREATE TABLE IF NOT EXISTS history (id INTEGER PRIMARY KEY, username VARCHAR(255) NOT NULL, file_id INTEGER NOT NULL, date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)');
    } else {
        $pdo->exec('CREATE TABLE IF NOT EXISTS users (id SERIAL PRIMARY KEY, username VARCHAR(255) UNIQUE NOT NULL, password VARCHAR(255) NOT NULL)');
        $pdo->exec('CREATE TABLE IF NOT EXISTS files (id SERIAL PRIMARY KEY, user_id INTEGER NOT NULL, filename VARCHAR(255) NOT NULL, key VARCHAR(255) UNIQUE NOT NULL, path VARCHAR(255) NOT NULL)');
        $pdo->exec('CREATE TABLE IF NOT EXISTS history (id SERIAL PRIMARY KEY, username VARCHAR(255) NOT NULL, file_id INTEGER NOT NULL, date TIMESTAMP DEFAULT NOW())');
    }

    if (!get_user_by_username('admin')) {
        $pdo->exec("INSERT INTO users (username, password) VALUES ('admin', '$flag2')");
        $pdo->exec("INSERT INTO files (user_id, filename, key, path) VALUES (1, 'empty', 'key', '/dev/null')");
    }
}

function before() {
    layout('layouts/default.html.php');
}


dispatch('/', 'home_page');

dispatch_get('/register', 'register_page');
dispatch_post('/register', 'register_user');

dispatch_get('/login', 'login_page');
dispatch_post('/login', 'login_user');

dispatch_get('/logout', 'logout_user');

dispatch_get('/upload', 'upload_page');
dispatch_post('/upload', 'upload_file');

dispatch_get('/files', 'files_page');
dispatch_delete('/files/:id', 'remove_file');

dispatch_get('/download', 'download_page');
dispatch_post('/download', 'download_file');

dispatch_get('/report', 'report_page');
dispatch_post('/report', 'report_bot');

run();