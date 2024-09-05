<section class="py-5">
    <div class="container px-5">
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-cloud-arrow-up-fill"></i></div>
                <h1 class="fw-bolder">Upload</h1>
                <p class="lead fw-normal text-muted mb-0">Upload your files securely</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <form id="uploadForm" method="POST" action="/upload" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input id="filenameInput" class="form-control" name="filename" type="text" placeholder="File name..." />
                            <label for="filename">Filename</label>
                            <div class="invalid-feedback">A filename is required.</div>
                        </div>
                        <div class="mb-3">
                            <input id="fileInput" type="file" class="form-control" name="file" placeholder="File..." />
                            <div class="invalid-feedback">A file is required.</div>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" id="submitButton" type="submit">Upload</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    const filenameInput = document.getElementById('filenameInput');
    const fileInput = document.getElementById('fileInput');

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            filenameInput.value = fileInput.files[0].name;
        }
    });
</script>