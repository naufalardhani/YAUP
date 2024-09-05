<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="text-center mb-4">
            <h1 class="fw-bolder">Files</h1>
            <p class="lead fw-normal text-muted mb-0">Download and remove your files</p>
        </div>
        <h2 class="fw-bolder mb-3">Your Files</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Key</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($upload_files as $file) {
                    echo '<tr>';
                    echo '<th scope="row">' . $file['id'] . '</th>';
                    echo '<td>' . htmlspecialchars($file['filename']) . '</td>';
                    echo '<td>' . htmlspecialchars($file['key']) . '</td>';
                    echo '<td><button class="btn btn-sm btn-danger"><i class="bi bi-trash-fill" onclick="deleteFile(' . $file['id']  . ')"></i></td></button>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <div class="text-center mb-4 mt-5">
            <h1 class="fw-bolder">History</h1>
            <p class="lead fw-normal text-muted mb-0">Your history of download</p>
        </div>
        <h2 class="fw-bolder mb-3">Your History</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">File ID</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($download_history as $history) {
                    echo '<tr>';
                    echo '<th scope="row">' . $history['id'] . '</th>';
                    echo '<td>' . htmlspecialchars($history['username']) . '</td>';
                    echo '<td>' . htmlspecialchars($history['file_id']) . '</td>';
                    echo '<td>' . htmlspecialchars($history['date']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        <div class="card border-0 bg-light mt-xl-5 " style="max-width: 500px;">
            <div class="card-body p-4 py-lg-5 mx-5">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <div class="h6 fw-bolder">Have more questions?</div>
                        <p class="text-muted mb-4">
                            Contact us at
                            <br />
                            <a href="#!">support@yaup.com</a>
                        </p>
                        <div class="h6 fw-bolder">Follow us</div>
                        <a class="fs-5 px-2 link-dark" href="#"><i class="bi-twitter"></i></a>
                        <a class="fs-5 px-2 link-dark" href="#"><i class="bi-facebook"></i></a>
                        <a class="fs-5 px-2 link-dark" href="#"><i class="bi-linkedin"></i></a>
                        <a class="fs-5 px-2 link-dark" href="#"><i class="bi-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function deleteFile(fileId) {
        fetch(`/files/${fileId}`, {
            method: 'DELETE',
            credentials: 'include'
        }).then(resp => {
            window.location.reload();
        });
    }
</script>