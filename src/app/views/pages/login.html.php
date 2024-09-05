<section class="py-5">
    <div class="container px-5">
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                <h1 class="fw-bolder">Login</h1>
                <p class="lead fw-normal text-muted mb-0">Welcome back!</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <form id="loginForm" method="POST" action="/login">
                        <div class="form-floating mb-3">
                            <input class="form-control" name="username" type="text" placeholder="Enter your username..." />
                            <label for="username">Username</label>
                            <div class="invalid-feedback">A username is required.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" name="password" type="password" placeholder="Enter your password..." />
                            <label for="password">Password</label>
                            <div class="invalid-feedback">A password is required.</div>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary btn-lg" id="submitButton" type="submit">Login</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>