<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="YAUP - Yet Another Upload Platform" />
    <meta name="author" content="Worty, xanhacks" />
    <title>YAUP - Yet Another Upload Platform</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="/">Yet Another Upload Platform</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/upload">Upload</a></li>
                        <li class="nav-item"><a class="nav-link" href="/files">Files</a></li>
                        <li class="nav-item"><a class="nav-link" href="/download">Download</a></li>
                        <li class="nav-item"><a class="nav-link" href="/report">Report</a></li>
                        <?php
                        if (is_authenticated()) {
                            echo '<li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="/login">Login</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="/register">Register</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="content">
            <?
            $flash = flash_now();

            foreach (array('danger', 'success') as $type) {
                if (isset($flash[$type])) {
                    echo '<div class="container mt-3">';
                    echo '<div class="alert alert-' . htmlspecialchars($type) . '" role="alert">';
                    echo htmlspecialchars($flash[$type]);
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
            <?php echo $content; ?>
        </div>
    </main>
    <!-- Footer-->
    <footer class="bg-dark py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white">Copyright &copy; Yet Another Upload Platform 2024</div>
                </div>
                <div class="col-auto">
                    <a class="link-light small" href="#">Privacy</a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="#">Terms</a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="#">Contact</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>