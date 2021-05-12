<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Patient Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                     <div class="auth-logo">
                <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo"></a>
            </div>
                    <h4 class="auth-title" style="margin-top: -50px; font-size:3rem;">Log In</h4>
                    <p class="auth-subtitle mb-5">Be a part of the synergy</p>

                    <form class="form form-vertical" style="margin-top:-30px;" action="function.php" method="post">
                        <input type="hidden" name="command" value="CHECK_USER">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Username" id="first-name-icon" name="username" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" class="form-control" placeholder="Password" id="password-id-icon" name="password" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class='form-check'>
                                        <div class="checkbox mt-2">
                                            <input type="checkbox" id="remember-me-v" class='form-check-input' checked>
                                            <label for="remember-me-v">Keep me logged in</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                                </div>
                                <div class="">
                                    <br><br>

                                    <p>Don't have an account? <a href="auth-register.php" class="font-bold">Sign
                                            up</a>.</p>
                                    <p><a class="font-bold" href="#">Forgot password?</a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" style="text-align: center;">
                    <center>
                        <img src="doc.jpg" class="card-img-top img-fluid" alt="singleminded" style="height: auto;max-width: 50%;margin-top: 10%;">
                    </center>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
