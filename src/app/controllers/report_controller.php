<?php

function report_page() {
    if (!is_authenticated()) {
        flash('danger', 'You must be logged in to report URLs.');
        redir('/login');
    }

    return html('pages/report.html.php');
}

function report_bot() {
    $url = $_POST['url'];

    if (!isset($url) || empty($url)) {
        flash('danger', 'You must provide an URL.');
        redir('/report');
    }

    if (str_starts_with($url, 'http://') === false && str_starts_with($url, 'https://') === false) {
        flash('danger', 'The URL must start with http:// or https://.');
        redir('/report');
    }

    // Start bot in background
    system("HOME=/tmp MOZ_HEADLESS=1 python3 /bot.py " . escapeshellarg($url) . " &");

    flash('success', 'URL successfully reported.');
    redir('/report');
}