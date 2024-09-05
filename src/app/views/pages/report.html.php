<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="text-center mt-5">
            <h1 class="fw-bolder">Report</h1>
            <p class="lead fw-normal text-muted mb-0">A file does not respect the condition, report it!</p>
        </div>

        <form class="container form-inline" action="/report" method="POST">
            <div class="input-group mb-3 mt-4 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="bi bi-flag-fill"></i></div>
                </div>
                <input type="text" class="form-control" name="url" placeholder="Enter an URL...">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Report</button>
            </div>
        </form>
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